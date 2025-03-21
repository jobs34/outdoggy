<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Base Private Class - used for all private pages
 */
class Private_Controller extends MY_Controller {
    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();


        $is_mainteness_mode_on = (isset($this->settings->is_mainteness_mode_on) && $this->settings->is_mainteness_mode_on == "YES") ? "YES": "NO";
        if($is_mainteness_mode_on == "YES")
        {   if (current_url() != base_url())
            {
                return redirect(base_url());
            }
            $this->load->view('maintenance_view',array());
            die();
        }


        // must be logged in
        if (!$this->user) {
            if (current_url() != base_url()) {
                // store requested URL to session - will load once logged in
                $data = array('redirect' => current_url());
                $this->session->set_userdata($data);
            }
            redirect('login');
        }
        // prepare theme name
        $this->settings->theme = strtolower($this->config->item('public_theme'));
        // set up global header data
        //    $this->add_css_theme("{$this->settings->theme}.css");
        //    $this->add_js_theme("{$this->settings->theme}.min.js", TRUE);
            $this->add_js_theme("{$this->settings->theme}_i18n.js", TRUE);
        //    $this->add_css_theme("custom.css");
            $this->add_js_theme('jquery.simple.timer.js');

        $this->add_external_css(array(
        //    base_url("/assets/themes/admin/css/dataTables.bootstrap4.min.css"),
        //    base_url("/assets/themes/admin/css/select2.min.css"),
        //    base_url("/assets/themes/admin/css/all.min.css"),
        //    base_url("/assets/themes/quizzy/css/cookiealert.css"),
        //    base_url("/assets/themes/quizzy/css/component.css"),
        base_url("/assets/themes/quizzy/css/noty.css"),
        base_url("/assets/themes/admin/css/sweetalert.css"),
        ));

        $this->add_external_js(array(
        //    base_url("/assets/themes/admin/js/jquery.dataTables.min.js"),
        //    base_url("/assets/themes/admin/js/dataTables.bootstrap4.min.js"),
            base_url("/assets/themes/admin/js/select2.min.js"),
            base_url("/assets/themes/quizzy/js/noty.min.js"),
            base_url("/assets/themes/quizzy/js/commonjs.js"),
        //    base_url("/assets/themes/quizzy/js/jquery-ui.min.js"),
        //    base_url("/assets/themes/quizzy/js/cookiealert.js"),
            base_url("/assets/themes/admin/js/sweetalert-dev.js"),
        //    base_url("/assets/themes/quizzy/js/modernizr.custom.js"),
            base_url("/assets/themes/quizzy/js/jquery.dlmenu.js"),
            base_url("/assets/themes/quizzy/js/bootstrap-notify.min.js"),
        ));


        $this->load->helper("my_menu_item_helper");
        $this->load->helper("my_admin_setting_helper");
        $this->load->model("MenuItemModel");
        $this->load->model("AdminSettingModel");
        // declare main template
        $this->template = "../../{$this->settings->themes_folder}/{$this->settings->theme}/template.php";
    }
}
