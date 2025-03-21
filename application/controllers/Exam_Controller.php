<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Exam_Controller extends Public_Controller {

    /**
     * Constructor
     */
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('HomeModel');
        $this->load->model('TestModel');
        $this->add_css_theme('quiz_box.css');
        $this->add_css_theme('set2.css');
        $this->load->library('Ratting');
        $this->add_js_theme('perfect-scrollbar.min.js');
        $this->add_css_theme('table-main.css');
        $this->add_css_theme('perfect-scrollbar.css');
    }

    function exam_category($id=NULL, $page_no=NULL)
    {
        $category_id = $id;
        //$category_id = "3";
        $quiz_data_array = $this->HomeModel->get_quiz_by_category($category_id);

        $count_quiz = count($quiz_data_array);
        $this->load->library('pagination');

        $config['base_url'] = base_url('prev-exam/') . $category_id;
        $config['total_rows'] = $count_quiz;
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
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
        $page = $this->uri->segment(3) > 0 ? (($this->uri->segment(3) - 1) * $pro_per_page) : $this->uri->segment(3);
        $page_links = $this->pagination->create_links();
        $filter_by = 'added';

        $quiz_data = $this->HomeModel->get_category_quiz_per_page($category_id, $pro_per_page, $page, $filter_by);
        // 연관 포스트 불러오기    
        //$rel_post_data = $this->HomeModel->get_category_rel_post($category_id);
        // 연관 강의 불러오기
        //$rel_material_data_array = $this->HomeModel->get_category_study_material($category_id);
        //$content_data = array('quiz_data' => $quiz_data, 'count_quiz' => $count_quiz, 'pagination' => $page_links,'rel_post_data' => $rel_post_data, 'rel_material_data_array' => $rel_material_data_array);

        $content_data = array('quiz_data' => $quiz_data, 'count_quiz' => $count_quiz, 'pagination' => $page_links);
        
        $data = $this->includes;

        $data['content'] = $this->load->view('prevexam', $content_data, TRUE);
        $this->load->view($this->template, $data);

    }

    function lecture_category($id=NULL, $page_no=NULL)
    {
        $category_id = $id;
        //$category_id = "3";
        $category_study_material_data = $this->HomeModel->get_category_study_material($category_id);    
        $count_lecture = count($category_study_material_data);
        $this->load->library('pagination');

        $config['base_url'] = base_url('lecture/') . $category_id;
        $config['total_rows'] = $count_lecture;
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
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
        $page = $this->uri->segment(3) > 0 ? (($this->uri->segment(3) - 1) * $pro_per_page) : $this->uri->segment(3);
        $page_links = $this->pagination->create_links();
        $filter_by = 'added';

        $lecture_data = $this->HomeModel->get_category_study_material_per_page($category_id, $pro_per_page, $page, $filter_by);
        $rel_post_data = $this->HomeModel->get_category_rel_post($category_id);

        $content_data = array('lecture_data' => $lecture_data, 'count_lecture' => $count__lecture, 'pagination' => $page_links,'rel_post_data' => $rel_post_data);

        $data = $this->includes;
        $data['content'] = $this->load->view('lecture', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }    

    function howto()
    {
        $data['content'] = $this->load->view('categories', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }

}
