<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Blog_Controller extends Public_Controller {
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('BlogModel');
        $this->add_css_theme('set2.css');
        $this->add_css_theme('quiz_box.css');
        $this->add_js_theme('blog.js');
    }

    function index($page_no=NULL)
    {
        return redirect("blog/list/all");
    }
    function list($category_slug=NULL, $page_no=NULL)
    {
        if($category_slug == 'all' OR $category_slug == 'ALL')
        {
            $category_id = NULL;
        }
        else
        {
            $blog_category_data = $this->BlogModel->get_blog_category_by_slug($category_slug);
            if(empty($blog_category_data))
            {
                return redirect(base_url("404_override"));
            }
            $category_id = $blog_category_data->id;
        }

    	$blog_data_array = $this->BlogModel->get_blog_total_record($category_id);

    	$count_blog_post = count($blog_data_array);

    	$this->load->library('pagination');

        $config['base_url'] = base_url('blog/list/').$category_slug;
        $config['total_rows'] = $count_blog_post;
        $config['per_page'] = 12;
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $config['page_query_string'] = FALSE;
        $config['reuse_query_string'] = TRUE;
        $config['first_link'] = 'First';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['attributes'] = ['class' => 'page-link'];
        $config['first_link'] = false;
        $config['last_link'] = false;
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a href="#" class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $this->pagination->initialize($config);
        $pro_per_page = $config['per_page'];

        $page = $this->uri->segment(4) > 0 ? (($this->uri->segment(4) - 1) * $pro_per_page) : $this->uri->segment(4);
        $page_links = $this->pagination->create_links();

        $blog_post_data = $this->BlogModel->get_blog_post_per_page($category_id, $pro_per_page, $page);

        $blog_category = $this->BlogModel->all_blog_category();
        $title = $category_id ?  $blog_category_data->title : "전체";
        $meta_title_tmp = "즐거운 인생2막 취미 - ".$title." 리스트";
        $meta_description_tmp = $this->settings->site_name." ".$title." 에 도움이 되는 글 모음입니다.";
        $page_title = $title;
    	$this->set_title($page_title);

        $meta_data = array('meta_title' => $meta_title_tmp, 'meta_keyword' => $meta_title_tmp, 'meta_description' =>  $meta_description_tmp);

        $content_data = array('page_title' => $page_title,'category_slug' => $category_slug,'pagination' => $page_links, 'blog_post_data' => $blog_post_data, 'blog_category' => $blog_category);

        $data = $this->includes;
        $data['content'] = $this->load->view('blog_list', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        $this->load->view($this->template, $data);
    }

    function detail($post_slug = NULL)
    {
    	$post_detail_data = $this->BlogModel->get_post_by_slug($post_slug);

        if(empty($post_detail_data))
        {
           $this->session->set_flashdata('error', 'Sorry Wrong Uri Paramiter This Blog Is Not Exist ...!');
           redirect(base_url());
        }

        $current_date = date('Y-m-d');

        $page_title = $post_detail_data->post_title;
        $rel_study = $post_detail_data->rel_study;
        if (isset($rel_study) && !empty($rel_study)){
            $lecture_category = $this->BlogModel->get_rel_study_by_id($rel_study);
            $related_post = $this->BlogModel->get_relstudy_post($rel_study, $post_detail_data->id);
        }  
        else{
            $related_post = $this->BlogModel->get_relcategory_post($post_detail_data->blog_category_id, $post_detail_data->id);
        }      
        $this->set_title($page_title);
        $meta_data = array('meta_title' => $post_detail_data->meta_title, 'meta_keyword' => $post_detail_data->meta_keywords, 'meta_description' =>  $post_detail_data->meta_description,'title' => $post_detail_data->post_title,'description' => $post_detail_data->post_description,'image' => $post_detail_data->post_image);

        $content_data = array('Page_message' => $page_title, 'page_title' => $page_title,'post_detail_data' => $post_detail_data,'related_post' => $related_post,'lecture_category' => $lecture_category);

        $data = $this->includes;
        $data['content'] = $this->load->view('post_detail', $content_data, TRUE);
        $data['meta_data'] = $meta_data;
        $this->load->view($this->template, $data);
    }

    function like_or_unlike_post()
    {
        $response = [];
        $response['status'] = 'error';
        $response['msg'] = 'Please Login First Required';
        $response['action'] = NULL;

        $user_id = isset($this->user['id']) && $this->user['id'] ? $this->user['id'] : NULL;
        if($this->session->userdata('logged_in') OR $user_id)
        {
            $post_id = (isset($_POST['post_id']) && $_POST['post_id']) ? $_POST['post_id'] : NULL;

            if(empty($post_id))
            {
                $response['msg'] = 'Post Id Is Required';
                echo json_encode($response);
                exit;
            }

            $post_like_data = $this->db->where('post_id',$post_id)->where('user_id',$user_id)->get('post_like')->row();
            $status = NULL;
            if($post_like_data)
            {
                $status = $this->BlogModel->delete_like_post_through_postid($post_id, $user_id);
                $response['action'] = "unlike";
            }
            else
            {
                $save_post_like['post_id'] = $post_id;
                $save_post_like['user_id'] = $user_id;
                $status = $this->BlogModel->insert_post_like($save_post_like);
                $response['action'] = "like";
            }


            if($status)
            {
                $total_like = $this->db->select('count(id) as total_like')->where('post_id',$post_id)->get('post_like')->row('total_like');
                $response['total_like'] = $total_like;
                $response['status']     = 'success';
                $response['msg']        = ucfirst($response['action']).' Blog Successfully';
            }
            else
            {
                $response['msg'] = "Something Went Wrong ...! ";
            }
        }
        else
        {
            $response['status'] = 'redirect';
        }

        echo json_encode($response);
        exit;
    }


}
