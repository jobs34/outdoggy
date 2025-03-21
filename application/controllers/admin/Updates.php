<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    class Updates extends Admin_Controller 
    {
        function __construct() 
        {
            parent::__construct();
            $this->add_css_theme('all.css');
            $this->add_js_theme('jquery.multi-select.min.js');
            $this->add_js_theme('backup_restore.js');
            $this->add_js_theme('plugin/taginput/bootstrap-tagsinput.min.js');
            $this->add_css_theme('plugin/taginput/bootstrap-tagsinput.css');
            $this->load->model('BackupModel');
            $this->load->library('form_validation');
            $this->load->helper('file');
            $this->load->library('zip');
            $this->load->helper('directory');
            $this->load->helper('file');


            if(is_loged_in_user_is_subadmin() == TRUE)
            {
                $this->session->set_flashdata('error', lang('you_dont_have_permission_to_access_this_page'));
                return redirect(base_url('admin/dashboard'));
            }
        
        }

        function index()
        {
            $api_url = "https://projects.ishalabs.com/updates/api/";            
            $this->add_css_theme('sweetalert.css')
                ->add_js_theme('sweetalert-dev.js')
                ->add_js_theme('bootstrap-notify.min.js')
                ->add_js_theme('update.js')
                ->add_css_theme('sweetalert.css')
                ->add_js_theme('sweetalert-dev.js')
                ->add_js_theme('bootstrap-notify.min.js')
                ->set_title(lang('Updates'));

            $update_info_value  = get_setting_value_by_name('update_info');
            $update_info_json = $update_info_value ? $update_info_value : json_encode(array());
            $update_info_obj = json_decode($update_info_json);
            $update_info_array = json_decode(json_encode($update_info_obj), true);
            
            $purchase_code_updated = isset($update_info_obj->purchase_code_updated) ? $update_info_obj->purchase_code_updated : FALSE;
            $update_info_message = isset($update_info_obj->message) ? $update_info_obj->message : FALSE;
            $update_info_message = isset($update_info_obj->message) ? $update_info_obj->message : FALSE;
            $next_version_name = isset($update_info_obj->next_version_name) ? $update_info_obj->next_version_name : FALSE;
            $next_version_description = isset($update_info_obj->next_version_description) ? $update_info_obj->next_version_description : FALSE;
            $next_version_all_in_one_zip = (isset($update_info_obj->next_version_all_in_one_zip) && $update_info_obj->next_version_all_in_one_zip) ? $update_info_obj->next_version_all_in_one_zip : "";


            if($purchase_code_updated) 
            {
                $up_info_site_update_token = $update_info_array['purchase_code'];
                $update_version_url = $api_url."verify_purchase_code.php?purchase_token=$up_info_site_update_token&project_slug=quiz";
                $api_response = array();
                $api_response_json = $this->get_web_page($update_version_url);
                $api_response = json_decode($api_response_json);
                $api_response = json_decode(json_encode($api_response), true);
                if($api_response && is_array($api_response))
                {
                    $update_info_array['purchase_code_updated'] = FALSE;
                    $update_info_array['last_updated'] = date("Y-m-d H:i:s");
                    $update_info_array['is_verified'] = $api_response['is_verify'];
                    $update_info_array['message'] = $api_response['message'];
                } else
                {
                    $update_info_array['purchase_code_updated'] = FALSE;
                    $update_info_array['last_updated'] = date("Y-m-d H:i:s");
                    $update_info_array['is_verified'] = FALSE;
                    $update_info_array['message'] = lang("Purchase code not verified!");
                }
                $setting_update_info['value'] = json_encode($update_info_array);
                $this->db->where('name','update_info')->update('settings',$setting_update_info);
            }

            $purchase_code_is_verified = isset($update_info_array['is_verified']) ? $update_info_array['is_verified'] : FALSE;

            $is_copy_working = FALSE;
            $temp_copy_path = "./assets/uploads";
            $file_url_copy_from = "https://projects.ishalabs.com/updates/api/favicon.png";
            $file_copy_to_url = $temp_copy_path."/test.png";
            $local_current_version_code = $this->settings->site_version_code;

            try 
            {
                $test_copy_status = @copy($file_url_copy_from , $file_copy_to_url);
                if($test_copy_status == TRUE)
                {
                   $is_copy_working = TRUE;
                }
            }
            catch(Exception $e) 
            {
                $is_copy_working = FALSE;
            }



            $next_version_zip_urls = (isset($update_info_obj->next_version_zip_urls) && $update_info_obj->next_version_zip_urls) ? $update_info_obj->next_version_zip_urls : "[]";
            //$next_version_zip_urls_array = json_decode($next_version_zip_urls);
            $next_version_zip_urls_array = $next_version_zip_urls;

            $next_version_zip_urls_array = json_decode(json_encode($next_version_zip_urls_array), true);
            $next_version_zip_urls_array = is_array($next_version_zip_urls_array) ? $next_version_zip_urls_array : array();

            if($this->input->post('download'))
            {
                if($is_copy_working == TRUE && $next_version_zip_urls_array)
                {

                    foreach ($next_version_zip_urls_array as $link) 
                    {

                        $temp_update_folder_path = "./assets/uploads/temp_update_folder";

                        try 
                        {
                            if(is_dir($temp_update_folder_path)) 
                            {
                                delete_files($temp_update_folder_path, true);
                            } 

                            if (!is_dir($temp_update_folder_path)) 
                            {
                                mkdir($temp_update_folder_path, 0775, TRUE);
                            }

                            $file_copy_from = $link;
                            $file_copy_to = $temp_update_folder_path."/updates.zip";
                            $copy_status = copy($file_copy_from , $file_copy_to);

                            if($copy_status == FALSE)
                            {
                                $is_copy_working = FALSE;
                                $this->session->set_flashdata('error', lang("Error During Copying Updates Files To Server !"));
                                redirect(base_url('admin/updates')); 
                            }

                            if(!is_file($temp_update_folder_path.'/updates.zip'))
                            {
                                $this->session->set_flashdata('error', lang("Updates Files Not Copyped To Server !"));
                                redirect(base_url('admin/updates')); 
                            } 
                                 
                        } 
                        catch(Exception $e) 
                        {
                            $this->session->set_flashdata('error', $e->getMessage());
                            redirect(base_url('admin/updates'));
                        }

                        try
                        { 

                            $unzip = new ZipArchive;
                            if ($unzip->open($temp_update_folder_path."/updates.zip") === TRUE) 
                            {
                                $sss = $unzip->extractTo(FCPATH);
                                if(!$sss)
                                {
                                    $this->session->set_flashdata('error', lang('Please Enable ZipArchive!'));
                                    redirect(base_url('admin/updates'));  
                                }
                                $unzip->close();
                                unlink($temp_update_folder_path."/updates.zip");
                                delete_files($temp_update_folder_path, true);
                            }
                            else
                            {
                                $this->session->set_flashdata('error', 'Can Not Read File From '.$temp_update_folder_path);
                                redirect(base_url('admin/updates'));  
                            }
                        }
                        catch(Exception $e) 
                        {
                            $this->session->set_flashdata('error', $e->getMessage());
                            redirect(base_url('admin/updates')); 
                        }
                                
                    }

                    $this->session->set_flashdata('message', lang('Update Downloaded And Verify Successfully'));
                   
                } 
                else
                {
                    $this->session->set_flashdata('error', "This action is not allowed !");
                }
                redirect(base_url('admin/updates'));
            }


            $response = $update_info_array;
            $data = $this->includes;
            $content_data = array('response' => $response,'is_copy_working' => $is_copy_working,'purchase_code_updated' => $purchase_code_updated, 'purchase_code_is_verified' => $purchase_code_is_verified, 'update_info_message' => $update_info_message, 'next_version_name' => $next_version_name, 'next_version_description' => $next_version_description, "next_version_all_in_one_zip" => $next_version_all_in_one_zip);
            // load views
            $data['content'] = $this->load->view('admin/update/list', $content_data, TRUE);
            $this->load->view($this->template, $data);
        }




        function get_web_page($url) 
        {
            try
            {

                $options = array(
                    CURLOPT_RETURNTRANSFER => true,   // return web page
                    CURLOPT_HEADER         => false,  // don't return headers
                    CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                    CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                    CURLOPT_ENCODING       => "",     // handle compressed
                    // CURLOPT_USERAGENT      => $_SERVER['HTTP_HOST'], // name of client
                    CURLOPT_USERAGENT      => base_url(), // name of client
                    CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                    CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                    CURLOPT_TIMEOUT        => 120,    // time-out on response
                    CURLOPT_REFERER        => base_url(),    // 'https://m.facebook.com/', 
                );  

                $ch = curl_init($url);
                curl_setopt_array($ch, $options);

                $content  = curl_exec($ch);

                curl_close($ch);

                return $content;
            }
            catch(Exception $e) 
            {
                return json_encode(array());
            }
        }


}
