<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'Home_Controller';
$route['404_override'] = 'errors/error404';
$route['translate_uri_dashes'] = TRUE;
$route['sitemap\.xml']  = 'sitemap';
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';
//================================= Front 모듈 ========================================

//--- 정보 페이지 : 
//$route['courses/(:any)'] = 'Home_Controller/courses/$1';
$route['campground/(:any)'] = 'Contents_Controller/campground/$1';
//$route['campground'] = 'Contents_Controller/campground';
$route['courses/(:any)'] = 'Contents_Controller/lecture_subcate/$1';

//--- 마이 페이지
$route['mypage'] = 'History_Controller/mypage';
$route['my/study'] = 'History_Controller/user_study_data';
$route['my/study/(:any)'] = 'History_Controller/user_study_data/$1';
$route['my/payments'] = 'History_Controller/user_payment_data';
$route['user/reset-my-password/(:any)'] = 'User/reset_password_form/$1';

//--- Contents 페이지
$route['blogs'] = 'Blog_Controller/index';
$route['blog/(:any)'] = 'Blog_Controller/detail/$1';
$route['blog/list/(:any)'] = 'Blog_Controller/list/$1';
$route['blog/list/(:any)/(:any)'] = 'Blog_Controller/list/$1/$2';
$route['cgrounds/(:any)'] = 'Contents_Controller/cgrounds/$1';
$route['cgrounds/(:any)/(:any)'] = 'Contents_Controller/cgrounds/$1/$2';
$route['serieses/(:any)'] = 'Contents_Controller/serieses/$1';

//--- 일반 (LMS)
//$route['all-categories'] = 'Quiz_Controller/all_category';
//$route['parcat/(:any)'] = 'Course_Controller/parentcategory/$1';
//$route['category/(:any)'] = 'Course_Controller/category/$1';
//$route['category/(:any)/(:any)'] = 'Course_Controller/category/$1/$2';
//$route['search'] = 'Search_Controller/index';
//$route['search/(:any)'] = 'Search_Controller/index/$1';
//$route['prev-exam/(:any)'] = 'Exam_Controller/exam_category/$1';
//$route['prev-exam/(:any)/(:any)'] = 'Exam_Controller/exam_category/$1/$2';
//$route['lecture/(:any)'] = 'Course_Controller/lecture_subcate/$1';
//$route['ad-course/(:any)'] = 'Ext_Controller/ad_course_show/$1';
//$route['ad-course/(:any)/(:any)'] = 'Ext_Controller/ad_course_show/$1/$2';

//--- 학습

$route['study-content/(:any)'] = 'Course_Controller/study_details_show/$1';
$route['study-material-detail/(:any)/(:any)'] = 'Course_Controller/index/$1/$2';
$route['study-material/(:any)']  = 'Course_Controller/study_details/$1';
$route['study-material/(:any)/(:num)'] = 'Course_Controller/study_details/$1/$2';
$route['preview-material/(:any)'] = 'Course_Controller/preview_details/$1';
$route['preview-material/(:any)/(:num)'] = 'Course_Controller/preview_details/$1/$2';
$route['lesson-view'] = 'Course_Controller/lesson_view';

//--- 퀴즈
$route['quiz/(:any)'] = 'Quiz_Controller/quiz_detail_by_slug/$1';
$route['quiz-detail/(:any)/(:any)'] = 'Quiz_Controller/quiz_detail/$1/$2';
$route['instruction/(:any)/(:any)'] = 'Quiz_Controller/instruction/$1/$2';
$route['test/(:num)/(:num)'] = 'Test_Controller/test/$1/$2';
$route['play/(:num)'] = 'Play_Controller/play/$1';
$route['practice/(:num)'] = 'Play_Controller/practice/$1';
$route['start-test/(:num)'] = 'Test_Controller/set_test_session/$1';
$route['result/(:num)'] = 'Test_Controller/test_result/$1';
$route['test-submit-request'] = 'Test_Controller/test_submit_request';


//$route['admin/extcourse'] = 'Blog_Controller/index';
$route['admin/extcourse'] = 'admin/Ext_Course/index';
$route['admin/extcourse/list'] = 'admin/Ext_Course/list';
$route['admin/extcourse/add'] = 'admin/Ext_Course/add';
$route['admin/extcourse/update/(:any)'] = 'admin/Ext_Course/update/$1';
$route['admin/extcourse/copy/(:any)'] = 'admin/Ext_Course/copy/$1';
$route['admin/extcourse/delete/(:any)'] = 'admin/Ext_Course/delete/$1';

$route['admin/extcourse/material-file/(:any)']      		= 'admin/Ext_Course/material_file/$1';
$route['admin/extcourse/import/(:num)'] 		 			= 'admin/Excel_import/extcourse_data_import/$1';
$route['admin/extcourse/contents-delete/(:num)']    		= 'admin/Ext_Course/contents_delete/$1';


$route['admin/adproduct'] = 'admin/AdProduct/index';
$route['admin/adproduct/list'] = 'admin/AdProduct/list';
$route['admin/adproduct/add'] = 'admin/AdProduct/add';
$route['admin/adproduct/update/(:any)'] = 'admin/AdProduct/update/$1';
$route['admin/adproduct/copy/(:any)'] = 'admin/AdProduct/copy/$1';
$route['admin/adproduct/delete/(:any)'] = 'admin/AdProduct/delete/$1';

// 안쓰기
//$route['admin/adcourse'] = 'admin/Ad_Course/index';
//$route['admin/adcourse/list'] = 'admin/Ad_Course/list';
//$route['admin/adcourse/add'] = 'admin/Ad_Course/add';
//$route['admin/adcourse/update/(:any)'] = 'admin/Ad_Course/update/$1';
//$route['admin/adcourse/copy/(:any)'] = 'admin/Ad_Course/copy/$1';
//$route['admin/adcourse/delete/(:any)'] = 'admin/Ad_Course/delete/$1';

//================================= 결제 모듈 ========================================
$route['apply/free-enroll/(:any)'] = 'Payment_NewController/free_enroll/$1';
$route['apply/payment-mode/(:any)/(:any)'] = 'Payment_NewController/payment_mode/$1/$2';
$route['apply/bank-transfer-insert'] = 'Payment_NewController/save_bank_transfer';
$route['apply/bank-transfer-success/(:any)/(:any)'] = 'Payment_NewController/bank_transfer_success/$1/$2';
$route['apply/bank-transfer-error/(:any)/(:any)'] = 'Payment_NewController/bank_transfer_error/$1/$2';
$route['apply/bank-transfer-update'] = 'Payment_NewController/update_bank_transfer';
$route['apply/card-pay'] = 'Payment_NewController/save_card_pay';
$route['apply/card-proc/(:any)/(:any)'] = 'Payment_NewController/update_card_pay/$1/$2';
$route['apply/card-pay-success/(:any)/(:any)/(:any)'] = 'Payment_NewController/card_success/$1/$2/$3';
$route['apply/card-pay-error/(:any)/(:any)/(:any)'] = 'Payment_NewController/card_error/$1/$2/$3';
$route['apply/card-pay-fin/(:any)/(:any)/(:any)'] = 'Payment_NewController/card_finish_detail/$1/$2/$3';
$route['apply/cancel-card/(:any)/(:any)/(:any)'] = 'Payment_NewController/cancel_card_pay/$1/$2/$3';
$route['view-payment-detail']  = 'Profile/view_payment_detail';
$route['invoice/(:any)']  = 'Profile/invoice/$1';
$route['membership'] = 'Membership_Controller/index';
$route['apply/free1'] = 'Payment_NewController/free1';
//############ 페이팔 모듈은 참조용으로 
//$route['paypal/payment/quiz-pay/(:any)/(:any)']         = 'payment/create_payment/$1/$2';
//$route['paypal/quiz-pay/pay-successfuly/(:any)/(:any)'] = 'payment/success_payment/$1/$2';
//$route['paypal/quiz-pay/payment-fail/(:any)/(:any)']    = 'payment/cancel/$1/$2';
//$route['paypal/quiz-pay/payment-status/(:any)/(:any)/(:any)']  = 'payment/paypal_payment_view/$1/$2/$3';

//================================= Admin Routes ========================================
$route['admin']                					= 'admin/dashboard';
$route['tutor']                					= 'tutor/dashboard/index';
//================================= Admin 모듈 ========================================
$route['admin/login']                			= 'Admin_login_Controller/login';
$route['admin/logout']               			= 'Admin_login_Controller/logout';
$route['admin/admin-setting']  					= 'Admin_setting_Controller/index';
$route['admin/template'] 		 						= 'admin/Template_Controller/index';
$route['admin/template/email_list'] 		 			= 'admin/Template_Controller/email_template_list';
$route['admin/template/update/(:any)'] 		 			= 'admin/Template_Controller/update/$1';
$route['admin/db-backup-list']                			= 'admin/Backup/index';
$route['admin/db-backup'] 							= 'admin/Backup/db_backup';
$route['admin/quiz']                			= 'admin/QuizController/index';
$route['admin/quiz/import'] 							= 'admin/Excel_import/index';
$route['admin/quiz/import/(:num)'] 		 				= 'admin/Excel_import/index/$1';
$route['admin/quiz/bulk_import']                = 'admin/Excel_import/bulk_import';
$route['admin/quiz/quiz-reports']               = 'admin/QuizController/quiz_reports';
$route['admin/quiz/add']                		= 'admin/QuizController/add';
$route['admin/quiz/update/(:any)']           	= 'admin/QuizController/update/$1';
$route['admin/quiz/copy/(:any)']           		= 'admin/QuizController/copy/$1';
$route['admin/quiz/delete/(:any)']           	= 'admin/QuizController/delete/$1';
$route['admin/quiz/dropzone-file']    			= 'admin/QuizController/quiz_upload_file';
$route['admin/quiz/dropzone-file-remove']    	= 'admin/QuizController/dropzone_quiz_file_remove';
$route['admin/quiz/delete-image/(:any)']    	= 'admin/QuizController/delete_featured_image/$1';
$route['admin/quiz/image-resize/(:any)']    	= 'admin/QuizController/image_resize_library/$1';
$route['admin/quiz/question-list/(:any)']    	= 'admin/QuizController/question_list/$1';
$route['admin/quiz/questions/(:any)'] 			= 'admin/QuizController/questions/$1';
$route['admin/quiz/translate-quiz/(:any)'] 		= 'admin/QuizController/translate_quiz/$1';
$route['admin/quiz-grading'] 						= 'admin/GradingController/index';
$route['admin/quiz-grading-list'] 					= 'admin/GradingController/ajax_list';
$route['admin/quiz-grading-add'] 					= 'admin/GradingController/add';
$route['admin/quiz-grading-update/(:num)'] 			= 'admin/GradingController/update/$1';
$route['admin/quiz-grading-delete/(:num)'] 			= 'admin/GradingController/delete/$1';
$route['admin/sp/get-sp-list'] 					= 'admin/sponsors/admin_sp_list';
$route['admin/report/(:any)'] 					= 'admin/ReportController/index/$1';
$route['admin/report/(:any)'] 					= 'admin/ReportController/index/$1';
$route['admin/report/summary/(:any)'] 			= 'admin/ReportController/summary/$1';
$route['admin/report/delete/(:any)/(:any)'] 	= 'admin/ReportController/delete/$1/$2';
$route['admin/rating/(:any)/(:num)'] 			= 'admin/RatingController/index/$1/$2';
$route['admin/payment'] 					    = 'admin/Payment_Controller/index';
$route['admin/payment/payment-list'] 		    = 'admin/Payment_Controller/payment_list';
$route['admin/payment/update-status'] 		    = 'admin/Payment_Controller/update_status';
$route['admin/payment/payment-detail']   		= 'admin/Payment_Controller/payment_detail';
$route['admin/payment/invoice/(:any)']   		= 'admin/Payment_Controller/invoice/$1';
$route['admin/questions']                				= 'admin/QuestionController/index';
$route['admin/questions/add/(:any)']                	= 'admin/QuestionController/add/$1';
$route['admin/questions/update/(:any)/(:any)']          = 'admin/QuestionController/update/$1/$2';
$route['admin/questions/copy/(:any)/(:any)']           	= 'admin/QuestionController/copy/$1/$2';
$route['admin/questions/delete/(:any)/(:any)']          = 'admin/QuestionController/delete/$1/$2';
$route['admin/questions/dropzone-file']    				= 'admin/QuestionController/questions_upload_file';
$route['admin/questions/dropzone-file-remove']    		= 'admin/QuestionController/dropzone_questions_file_remove';
$route['admin/questions/delete-image/(:any)']    		= 'admin/QuestionController/delete_questions_image/$1';
$route['admin/questions/get-questions-field/(:any)'] 	= 'admin/QuestionController/get_questions_fields/$1';
$route['admin/questions/translate-questions/(:any)'] 	= 'admin/QuestionController/translate_questions/$1';
$route['admin/study']                					= 'admin/Study_Material/index';
$route['admin/study/add']                 				= 'admin/Study_Material/add';
$route['admin/study/study-material-list']               = 'admin/Study_Material/study_material_list';
$route['admin/study/update/(:any)']               		= 'admin/Study_Material/study_material_update/$1';
$route['admin/study/copy/(:any)']               		= 'admin/Study_Material/copy/$1';
$route['admin/study/delete-study-material/(:any)']      = 'admin/Study_Material/study_material_delete/$1';
$route['admin/study/material-file/(:any)']      		= 'admin/Study_Material/material_file/$1';
$route['admin/study/add-material-file/(:num)/(:any)']   = 'admin/Study_Material/add_material_file/$1/$2';
$route['admin/study/material-file-list/(:any)']      	= 'admin/Study_Material/material_file_list/$1';
$route['admin/study/update-material-content/(:num)']   	= 'admin/Study_Material/update_study_material_content/$1';
$route['admin/study/delete-material-content/(:num)']   	= 'admin/Study_Material/delete_study_material_content/$1';
$route['admin/study/section/(:num)']    						= 'admin/Study_Material/section/$1';
$route['admin/study/section-update/(:num)']    					= 'admin/Study_Material/section_update/$1';
$route['admin/study/section-delete/(:num)']    					= 'admin/Study_Material/section_delete/$1';
$route['admin/study-data/import'] 							= 'admin/Excel_import/study_data_import';
$route['admin/study-data/import/(:num)'] 		 			= 'admin/Excel_import/study_data_import/$1';