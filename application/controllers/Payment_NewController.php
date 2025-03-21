<?php
class Payment_NewController extends Public_Controller { // CI_Controller 
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library("paypal");
        $this->load->model('PaymentModel');
        $this->load->model('StudyModel');
        $this->load->helper("url");
        $user_id = isset($this->user['id']) ? $this->user['id'] : 0;
        if($user_id < 0)
        {
            $this->session->set_flashdata('error', 'Plz Login First');
            return redirect(base_url("login"));
        }
    }

    public function free1()
    {
        
        $content_data = "";
        $data = $this->includes;
        $data['content'] = $this->load->view('free1', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
    
    
    public function free_enroll($item_id)
    {
        $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        
        if(empty($user_id))
        {
            $this->session->set_flashdata('error', lang('please_login_first'));
            return redirect(base_url('login'));
        }
        $quiz_last_enroll_status = $this->PaymentModel->get_last_enroll_status($item_id);
        if($quiz_last_enroll_status)
        {
            $this->session->set_flashdata('error', "이미 신청하신 강좌입니다.");
            return redirect(base_url("study-material-detail/$item_id"));
        }
        else{
            
            $item_data = array();
            $item_data = $this->StudyModel->get_study_material_by_id($item_id);            
            if(empty($item_data))
            {
                $this->session->set_flashdata('error', 'Invalid Uri Arguments... !');
                return redirect(base_url());
            }
            $enroll_date_tmp = date("Y-m-d H:i:s");
            
            $enroll_data['user_id'] = $user_id;
            $enroll_data['study_material_id'] = $item_id;
            $enroll_data['enroll_date'] = $enroll_date_tmp;
            $this->db->insert('study_material_user_histry',$enroll_data);
            $insert_id = $this->db->insert_id();
            if($insert_id)
            {
                $enroll_status = TRUE;
            }
            else
            {
                $enroll_status = FALSE;
            }
        }
    
        $content_data = array('item_id' => $item_id, 'item_data' => $item_data, 'enroll_status' => $enroll_status, 'enroll_date' => $enroll_date_tmp);
        $data = $this->includes;
        $data['content'] = $this->load->view('free_enroll', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
    
    public function payment_mode($purchases_type,$quiz_id)
    {
        $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $this->session->set_flashdata('error', lang('please_login_first'));
            return redirect(base_url('login'));
        }
        $item_data = array();
        if($purchases_type == 'quiz')
        {
            $item_data =  $this->PaymentModel->get_paid_quiz_by_id($quiz_id);
        }
        elseif($purchases_type == 'material')
        {
            $item_data = $this->PaymentModel->get_paid_material_by_id($quiz_id);
        }
        elseif($purchases_type == 'membership')
        {
            $item_data = $this->PaymentModel->get_paid_membership_by_id($quiz_id);
        }
    
        if(empty($item_data))
        {
            $this->session->set_flashdata('error', 'Invalid Uri Arguments... !');
            return redirect(base_url());
        }
    
        if($purchases_type == 'membership')
        {
            $membership_data = $item_data;
            //check if membership is free
            if($membership_data->price < 1)
            {
                $is_user_has_membership = $this->PaymentModel->get_free_membership($quiz_id,$user_id);
                if(isset($is_user_has_membership) && $is_user_has_membership)
                {
                    $this->session->set_flashdata('error', lang('already_purchase_this_membership'));
                    return redirect(base_url("membership"));		
                }
                $this->free_membership_payment($purchases_type,$quiz_id,$membership_data);
            }
        }
        
        $quiz_last_payment_status = $this->PaymentModel->get_last_payment_status($purchases_type,$quiz_id);
        if($quiz_last_payment_status)
        {
            if($purchases_type == 'quiz')
            {
                $this->session->set_flashdata('error', "You Have Already Pay For This Quiz... !");
                return redirect(base_url("instruction/$purchases_type/$quiz_id"));
            }
            if($purchases_type == 'material')
            {
                $this->session->set_flashdata('error', "이미 구매하신 강좌입니다.");
                return redirect(base_url("study-material-detail/$purchases_type/$quiz_id"));
            }
        }
    
        $payment_pending_status = $this->PaymentModel->get_payment_pending_status($quiz_id,$user_id,$purchases_type);
    
        $this->set_title(sprintf(lang('Payment Mode'), $this->settings->site_name));
        //$this->add_external_js(base_url("/assets/themes/admin/js/payment_custome_script.js"));
        //$this->add_external_js(base_url("/assets/themes/quizzy/js/payment_script.js"));
        $this->add_external_js(base_url("/assets/js/paybank_script.js"));
        $this->add_external_js(base_url("/assets/js/paycard_script.js"));
    
        $content_data = array('Page_message' => lang('Payment Mode'), 'page_title' => lang('Payment Mode'),'quiz_id' => $quiz_id, 'item_data' => $item_data,'payment_pending_status'=>$payment_pending_status,'purchases_type' => $purchases_type);
    
        $data = $this->includes;
    
        $data['content'] = $this->load->view('payment_method', $content_data, TRUE);
        //$data['content'] = $this->load->view('payment_method2', $content_data, TRUE);
            
        $this->load->view($this->template, $data);
    }

    
    public function save_bank_transfer()
    {
        $response['msg'] = '';
        $response['status'] = 'error';
        $get_max_invoice = $this->PaymentModel->find_max_invoice_no();
        $invoice_no = get_admin_setting('invoice_start_number')+1;
        if($get_max_invoice)
        {
            $max_nvoice_no = $get_max_invoice[0]->invoice_no+1;
            $invoice_no = $max_nvoice_no < $invoice_no ? $invoice_no : $max_nvoice_no;		    	
        }
    
        $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $response['msg'] =  lang('please_login_first');
            echo json_encode($response);
            exit;
        }
    
        $transaction_no = (isset($_POST['transaction_no']) && $_POST['transaction_no']) ? $_POST['transaction_no'] : NULL ;
        $payer_name = (isset($_POST['payer_name']) && $_POST['payer_name']) ? $_POST['payer_name'] : NULL ;
        $quiz_id = (isset($_POST['quiz_id']) && $_POST['quiz_id']) ? $_POST['quiz_id'] : NULL ;
        $purchases_type = (isset($_POST['purchases_type']) && $_POST['purchases_type']) ? $_POST['purchases_type'] : NULL ;
        $purchases_type = trim($purchases_type);
    
        if(empty($transaction_no ) OR empty($quiz_id) OR empty($purchases_type))
        {
            $response['msg'] =  lang('required_information_is_missing');
            echo json_encode($response);
            exit;
        }
    
        $item_data = FALSE;
        
        if($purchases_type =="quiz")
        {
            $item_data = $this->db->where('id',$quiz_id)->get('quizes')->row();
        }
        //추가 material 빠져있었음
        if($purchases_type =="material")
        {
            $item_data = $this->db->select('title, price')->where('id',$quiz_id)->get('study_material')->row();
        }
    
        if($purchases_type == 'membership')
        {
            $item_data = $this->db->select('title, amount as price')->where('id',$quiz_id)->get('membership')->row();
        }
        
        if(empty($item_data))
        {
            $response['msg'] =  "결제에 문제가 있습니다.";
            echo json_encode($response);
            exit;
        }
    
        $transaction_data = array();
        $transaction_data['user_id'] = $user_id;
        $transaction_data['item_id'] = $quiz_id;
        $transaction_data['token_no'] = $transaction_no;
        $transaction_data['payer_name'] = $payer_name;
        $transaction_data['name'] = $this->user['first_name'];
        $transaction_data['email'] = $this->user['email'];
        $transaction_data['item_name'] = $item_data->title;
        $transaction_data['item_price'] = $item_data->price;
        $transaction_data['item_price_currency'] = $this->settings->paid_currency;
        $transaction_data['payment_status'] = 'pending';
        $transaction_data['created'] = date("Y-m-d H:i:s");
        $transaction_data['modified'] = date("Y-m-d H:i:s");
        $transaction_data['payment_gateway'] = 'bank';
        $transaction_data['invoice_no'] = $invoice_no;
        $transaction_data['purchases_type'] = $purchases_type;
        
        $inserted_id = $this->PaymentModel->insertTransaction($transaction_data);
        
        if($inserted_id)
        {
            //$this->session->set_flashdata('message', "무통장 입금 신청이 완료되었습니다.");
            //$response['msg'] = "무통장 입금 신청이 완료되었습니다.";
            $response['status'] = 'success';
        }
        else
        {
            //$response['msg'] = "이런, 결제가 제대로 진행되지 않았습니다. ";
            $response['status'] = 'error';
        }
        echo json_encode($response);
        exit;
    }
    
   public function bank_transfer_success($purchases_type,$item_id)
    {        
        $item_data = array();
        $item_data = $this->StudyModel->get_study_material_by_id($item_id);
        
        $content_data = array('item_id' => $item_id, 'item_data' => $item_data );
        $data = $this->includes;
        $data['content'] = $this->load->view('bank_transfer_success', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }
    
    public function bank_transfer_error($purchases_type,$item_id)
    {        
        $content_data = array('item_id' => $item_id );
        $data = $this->includes;
        $data['content'] = $this->load->view('bank_transfer_error', $content_data, TRUE);
        $this->load->view($this->template, $data);
    }  
     public function save_card_pay()
    {
        $response['msg'] = '';
        $response['status'] = 'error';
        $get_max_invoice = $this->PaymentModel->find_max_invoice_no();
        $invoice_no = get_admin_setting('invoice_start_number')+1;
        if($get_max_invoice)
        {
            $max_nvoice_no = $get_max_invoice[0]->invoice_no+1;
            $invoice_no = $max_nvoice_no < $invoice_no ? $invoice_no : $max_nvoice_no;		    	
        }
    
        $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $response['msg'] =  lang('please_login_first');
            echo json_encode($response);
            exit;
        }
    
        $transaction_no = (isset($_POST['transaction_no']) && $_POST['transaction_no']) ? $_POST['transaction_no'] : NULL ;
        $payer_name = (isset($_POST['payer_name']) && $_POST['payer_name']) ? $_POST['payer_name'] : NULL ;
        $quiz_id = (isset($_POST['quiz_id']) && $_POST['quiz_id']) ? $_POST['quiz_id'] : NULL ;
        $purchases_type = (isset($_POST['purchases_type']) && $_POST['purchases_type']) ? $_POST['purchases_type'] : NULL ;
        $purchases_type = trim($purchases_type);
    
        if(empty($transaction_no ) OR empty($quiz_id) OR empty($purchases_type))
        {
            $response['msg'] =  lang('required_information_is_missing');
            echo json_encode($response);
            exit;
        }
    
        $item_data = FALSE;
        
        if($purchases_type =="quiz")
        {
            $item_data = $this->db->where('id',$quiz_id)->get('quizes')->row();
        }
        //추가 material 빠져있었음
        if($purchases_type =="material")
        {
            $item_data = $this->db->select('title, price')->where('id',$quiz_id)->get('study_material')->row();
        }
    
        if($purchases_type == 'membership')
        {
            $item_data = $this->db->select('title, amount as price')->where('id',$quiz_id)->get('membership')->row();
        }
        
        if(empty($item_data))
        {
            $response['msg'] =  "결제에 문제가 있습니다.";
            echo json_encode($response);
            exit;
        }
    
        $transaction_data = array();
        $transaction_data['user_id'] = $user_id;
        $transaction_data['item_id'] = $quiz_id;
        $transaction_data['token_no'] = $transaction_no;
        $transaction_data['payer_name'] = $payer_name;
        $transaction_data['name'] = $this->user['first_name'];
        $transaction_data['email'] = $this->user['email'];
        $transaction_data['item_name'] = $item_data->title;
        $transaction_data['item_price'] = $item_data->price;
        $transaction_data['item_price_currency'] = $this->settings->paid_currency;
        $transaction_data['payment_status'] = 'pending';
        $transaction_data['created'] = date("Y-m-d H:i:s");
        $transaction_data['modified'] = date("Y-m-d H:i:s");
        $transaction_data['payment_gateway'] = 'card';
        $transaction_data['invoice_no'] = $invoice_no;
        $transaction_data['purchases_type'] = $purchases_type;
        
        $inserted_id = $this->PaymentModel->insertTransaction($transaction_data);
        
        if($inserted_id)
        {
            $response['status'] = 'success';
            $response['payment_id'] = $inserted_id;
        }
        else
        {
            $response['status'] = 'error';
        }
        echo json_encode($response);
        exit;
    }    
    
    public function update_card_pay($payment_id,$transaction_no)
    {
        $item_data = array();
        $item_data = $this->PaymentModel->get_payment_detail_by_id($payment_id);
 
         if(empty($item_data))
        {
            $this->session->set_flashdata('error', '해당하는 결제 정보가 없습니다.');
            return redirect(base_url());
        }
        
         if($transaction_no!=$item_data->token_no)
        {
            $this->session->set_flashdata('error', '잘못된 접근입니다.');
            return redirect(base_url());
        }        
        
        $content_data = array('payment_id' => $payment_id, 'transaction_no' => $transaction_no, 'item_data' => $item_data );
        $data = $this->includes;
        $data['content'] = $this->load->view('card_payment', $content_data, TRUE);
        $this->load->view($this->template, $data);        
    }    
    
    public function card_success($payment_id,$transaction_no,$imp_id)
    {        
        $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $this->session->set_flashdata('error', lang('please_login_first'));
            return redirect(base_url('login'));
        }
        
        $item_data = array();
        $item_data = $this->PaymentModel->get_payment_detail_by_id($payment_id);
 
         if(empty($item_data))
        {
            $this->session->set_flashdata('error', '해당하는 결제 정보가 없습니다.');
            return redirect(base_url());
        }
        
         if($transaction_no!=$item_data->token_no)
        {
            $this->session->set_flashdata('error', '잘못된 접근입니다.');
            return redirect(base_url());
        } 
        // 필요한 정보 뽑아 오기
        $item_id = $item_data->relation_id;
        
        //-- Payments 업데이트 처리
        $transaction_data = array();
        $transaction_data['customer_id'] = $imp_id;
        $transaction_data['modified'] = date("Y-m-d H:i:s");
        $transaction_data['status'] = "succeeded";
        $update_id = $this->PaymentModel->update_card_status($payment_id,$user_id,$transaction_data);
        //-- Enroll 데이터 생성
        $enroll_data['user_id'] = $user_id;
        $enroll_data['study_material_id'] = $item_id;
        $enroll_data['enroll_date'] = date("Y-m-d H:i:s");
        $this->db->insert('study_material_user_histry',$enroll_data);
        $insert_id = $this->db->insert_id();
        
        if ($update_id && $insert_id)
        {
            $card_rtn_url = base_url("apply/card-pay-fin/3907/").$payment_id."/".$item_id;
        }
        else
        {
            $card_rtn_url = base_url("apply/card-pay-fin/6302/").$payment_id."/".$item_id;
        }
        return redirect($card_rtn_url);
    }
    
    public function card_error($payment_id,$transaction_no,$item_id)
    {        
        $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        $transaction_data = array();
        $transaction_data['customer_id'] = "카드결제 에러";
        $transaction_data['modified'] = date("Y-m-d H:i:s");
        $transaction_data['status'] = "fail";
        $update_id = $this->PaymentModel->update_card_status($payment_id,$user_id,$transaction_data);
        
        $card_rtn_url = base_url("apply/card-pay-fin/6302/").$payment_id."/".$item_id;
        return redirect($card_rtn_url);
    } 
    
    public function card_finish_detail($success_code,$payment_id,$item_id)
    {        
        $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        if(empty($user_id))
        {
            $this->session->set_flashdata('error', lang('please_login_first'));
            return redirect(base_url('login'));
        }
        
        $item_data = array();
        $item_data = $this->PaymentModel->get_payment_detail_by_id($payment_id);
 
         if(empty($item_data))
        {
            $this->session->set_flashdata('error', '해당하는 결제 정보가 없습니다.');
            return redirect(base_url());
        }
        
        // 성공/실패 식별 코드
        if ($success_code=="3907"){
            $success_status = TRUE;
        }
        else{
            $success_status = FALSE;
        }
        $content_data = array('payment_id' => $payment_id, 'success_status' => $success_status, 'item_data' => $item_data );
        $data = $this->includes;
        $data['content'] = $this->load->view('card_pay_detail', $content_data, TRUE);
        $this->load->view($this->template, $data);        
    } 
    
    public function cancel_card_pay($payment_id,$item_id,$transaction_no)
    {        
        $user_id = isset($this->user['id']) ? $this->user['id'] : NULL;
        $pay_rtn_url = base_url("study-content/").$item_id;
        //-- Payments 삭제 처리
        $this->PaymentModel->delete_payment_detail($payment_id,$transaction_no,$user_id);
        redirect($pay_rtn_url);
    } 
    

}