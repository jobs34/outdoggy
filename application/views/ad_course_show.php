<?php 
    $s_m_id = $ad_course_data->id;
    $category_id = $category_data->id;
    $category_title = $category_data->category_title;
    $category_url = base_url('category/').$category_id;
    if($gubun_param=="lecture")
    {
        $category_det_url = base_url('lecture/ctp01');
    }
    else{
        $category_det_url = $category_url;
    }

    $current_sm_image = $ad_course_data->image ? $ad_course_data->image : "default_ext_course.jpg";
    $current_detail_image = base_url("assets/images/studymaterial/").$current_sm_image;
    if(!is_file(FCPATH."assets/images/studymaterial/".$current_sm_image))
    {
        $current_detail_image = base_url("assets/images/studymaterial/default_ext_course.jpg"); 
    } 
    $study_m_title = $ad_course_data->title;
    $origin_price = number_format($ad_course_data->origin_price)."원";
    $real_price = $ad_course_data->real_price;
    $view_real_url = $ad_course_data->url;
    $ins_title = $inst_data->title;
    $ins_image = (isset($inst_data->logo) && !empty($inst_data->logo) ? base_url('assets/images/institution/'.$inst_data->logo) : base_url('assets/images/institution/default_logo.jpg'));
    $ins_address = $inst_data->address;
    $ins_description = $inst_data->description;

?>
<!-- 빵조각 -->
<div class="container-lg px-3 pt-2 pt-lg-3 pb-3 pb-lg-4">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="bread-anc">홈</a></li>
        <li class="breadcrumb-item"><a href="<?php echo $category_det_url; ?>" class="bread-anc"><?php echo $category_title; ?></a></li>
        <li class="breadcrumb-item active" aria-current="page">국비지원 강좌 소개</li>
      </ol>
    </nav>
</div>
<!-- Page content-->
<div class="pb-4 min-h-60vh">
    <div class="container px-0">
        <div class="detail-content row">
            <div class="course-detail col-lg-8 col-md-12 col-12 pt-0 pt-lg-3 mb-4 mb-lg-0 pl-0 pr-0 pr-lg-6">
                <!-- 강의 이미지 -->
                <div class="bg-dark-secondary">
                    <div class="row no-gutters">
                        <div class="col-12 col-md-4 px-12 px-md-0 py-0 text-center">
                            <img src="<?php echo $current_detail_image; ?>" alt="" class="w-75 rounded pt-5 pb-4"/>
                        </div>
                        <div class="col-12 col-md-8">
                            <!--PC--> 
                            <div class="mb-1 pt-3 px-1 d-none d-md-block">
                                <div class="pt-3 pb-0 text-light-gray">
                                    <?php echo $is_premium; ?>
                                </div>  
                                <div class="pt-0 pb-3 pr-2 text-white display-6" style="word-break:keep-all;">
                                    <?php echo $study_m_title; ?>
                                </div>
                                <div class="pt-0 pb-4 text-white">
                                    <a href="<?php echo xss_clean($view_real_url); ?>" target="_blank" class="btn btn-primary py-2"><span class="px-0">강좌 보러가기</span><span class="ml-2 mdi mdi-open-in-new"></span></a> 
                                </div>
                            </div>
                            <!--모바일--> 
                            <div class="mb-0 pt-2 pb-3 px-1 text-center d-block d-md-none">  
                                <div class="pb-3 pr-2 text-white display-7 font-weight-bold">
                                    <?php echo $study_m_title; ?>
                                </div>
                                <div class="pt-0 pb-2">
                                    <a href="<?php echo xss_clean($view_real_url); ?>" target="_blank" class="btn btn-primary py-1"><span class="px-0">강좌 보러가기</span><span class="ml-2 mdi mdi-open-in-new"></span></a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>               
                <!-- Description -->
                <div class="mb-4 pt-6 px-3 list_title_btmbar">
                    <div class="pt-0 pb-4">
                        <span class="display-7 font-weight-bold">훈련기관/ 내일배움카드 국비지원</span>
                    </div>
                    <div class="mb-7 course-info-page">    
                        <div class="row">    
                            <div class="col-auto mr-2">    
                                <img src="<?php echo $ins_image; ?>" alt="<?php echo $ins_title; ?>" class="p-3 card" style="max-width:95px;"/>
                            </div>
                            <div class="col text-medium-gray font-size-sm">
                                <div class="pt-0 pb-0 text-dark-gray font-weight-bold">
                                    <?php echo $ins_title; ?>
                                </div>  
                                <div class="pt-1 pb-1">
                                    <?php echo $ins_address; ?>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 mb-0 pl-2 pl-md-3 text-black ">
                            <div class="pt-3">
                                <div class="d-flex mb-1">
                                    <div class="ml-1 mr-1">
                                        <img src="<?php echo base_url("assets/images/svg/credit-card.svg");  ?>" class="w-80 p-0"/>
                                    </div>
                                    <div class="">
                                    기본 훈련비<span class="pl-4 text-dark-gray font-weight-bold"><?php echo $origin_price; ?></span>
                                    </div>
                                </div>
                            </div> 
                            <div class="pt-2">
                                <div class="d-flex mb-1">
                                    <div class="ml-1 mr-1">
                                        <img src="<?php echo base_url("assets/images/svg/credit-card.svg");  ?>" class="w-80 p-0"/>
                                    </div>
                                    <div class="">
                                    자비 부담금<span class="pl-4 text-dark-gray font-weight-bold"><?php echo $real_price; ?></span>
                                    </div>
                                </div>
                            </div>                              
                        </div> 
                    </div>
                    <div class="pt-0 pb-2">
                        <span class="display-7 font-weight-bold">강좌 정보</span>
                    </div>
                    <div class="mb-10 course-info-page pl-1 pl-md-2">    
                        <?php echo $ad_course_data->description; ?>
                    </div>
                    <div class="pt-0 pb-2">
                        <span class="display-6 font-weight-bold">국비지원 방법</span>
                    </div>
                    <div class="accordion mb-8" id="accordionNebeca">
                        <div class="card">
                            <div class="card-header p-2" id="headingOne">
                            <h6 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <span class="text-black font-size-sm">Step 1. 국민내일배움카드 발급</span>
                                </button>
                            </h6>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionNebeca">
                            <div class="card-body p-3">
                                <p>국비지원을 받기 위해서는 고용노동부에서 운영하는 직업훈련포털 HRD-Net의 회원가입과 국민내일배움카드 발급이 필요합니다. 자세한 내용은 아래의 링크를 통해 확인하시면 됩니다.</p>
                                <p><a href="https://www.hrd.go.kr/hrdp/hg/phgao/PHGAO0108T.do?currentTab=1&subTab=108" target="_blank" class="ext_link url font-size-sm">HRD-Net 활용가이드:국민내일배움카드 발급하기</a></p>
                                
                            </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-2" id="headingTwo">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <span class="text-black font-size-sm">Step 2. HRD-Net에서 1차 신청</span>
                                </button>
                            </h5>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionNebeca">
                            <div class="card-body p-3">
                                <p>원하는 과정을 HRD-Net에서 온라인으로 1차 신청을 합니다. 훈련생들은 대체로 특정한 훈련기관에서 원하는 과정을 먼저 선택한 이후 HRD-Net에서 직접 과정을 검색하는 방법을 많이 택합니다.</p> 
                                <p>구직자(실업자)와 근로자는 지원되는 금액이나 방식이 다르므로 반드시 구분해서 신청을 해야 합니다.한국이러닝협회에서 운영하는 잡고 사이트에서는 온라인으로 구직자와 근로자 과정을 모두 수강할 수 있어 아래에 해당 사이트의 신청방법을 안내합니다.</p>
                                <p><a href="https://jobgo.ne.kr/bbs/apply.php?types=certificate&seq=0" target="_blank" class="ext_link url font-size-sm">한국이러닝협회: HRD-Net 신청 안내</a></p>
                            </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header p-2" id="headingThree">
                            <h5 class="mb-0">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <span class="text-black font-size-sm">Step 3. 훈련기관에서 2차 신청(마무리)</span>
                                </button>
                            </h5>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionNebeca">
                            <div class="card-body p-3">
                                <p>HRD-Net에서 신청을 완료한 강의는 훈련기관 사이트에서 자부담금을 결제하고 2차 신청을 마무리해야 합니다. 자부담금 결제는 국민내일배움카드로 해야 합니다.</p>
                                <p>저소득 구직자, 청년 실업자, 경력단절여성, 중장년층 등 취업취약계층을 대상으로 취업지원서비스와 생계지원을 함께 제공하는 국민취업제도를 적극 활용하면 무료로 수강을 하거나 구직촉진수당 등의 지원금까지 추가로 받을 수 있습니다.</p>
                                <p><a href="https://jobgo.ne.kr/about/study_01.php" target="_blank" class="ext_link url font-size-sm">한국이러닝협회: 국민취업지원제도 안내</a></p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="pt-0 pb-3">
                        <span class="display-7 text-medium-gray font-weight-bold">확인해주세요</span>
                    </div>
                    <div class="mb-2 text-medium-gray font-size-sm">    
                        <ul>
                            <li>본 사이트에서는 학습자들에게 도움이 되는 외부의 강좌를 소개해드립니다.</li>
                            <li>본 페이지에 소개된 강좌는 단순 하이퍼 링크를 통해서만 연결됩니다.</li>
                            <li>소유권 및 저작권은 강좌가 서비스되는 해당 사이트에 있습니다.</li>
                        </ul>
                    </div>
                </div>
                <!-- BackList/BookMark -->
                <div class="px-3 mb-6">
                    <div class="pt-2 pb-2">
                        <a href="<?php echo $category_det_url; ?>" class="btn btn-outline-secondary py-2"><span class="px-0">&lt; 목록으로 돌아가기</span></a> 
                    </div>
                </div>
            </div>
            <div class="course-sidebar col-lg-4 col-md-12 col-12 pt-3">
                <!-- Card S-->
                <div class="card mb-4 mx-2 mx-md-0">
                    <!-- Card body S-->
                    <div class="card-body pt-4 pb-4">   
                        <!-- 소개 항목 S -->
                        <div class="pb-2 list_title_btmbar">
                            <div class="d-flex mb-1 text-black font-weight-medium">
                                <div class="ml-1 mr-2">
                                    <img src="<?php echo base_url("assets/images/svg/credit-card.svg");  ?>" class="w-100"/>
                                </div>
                                <div class="d-grid">
                                    <span class="text-black">내일배움카드 국비지원 강좌</span>
                                </div>
                            </div>
                        </div>
                        <div class="pt-2 pb-0 px-2">
                            <div class="text-medium-gray font-size-sm">
                            국민내일배움카드를 활용하면 최신의 수준 높은 온라인 강좌를 무료 혹은 일부의 비용만 부담하고 수강할 수 있습니다.
                            </div>
                             <div class="mt-3 mb-3">
                                <button type="button" class="btn btn-sm btn-primary py-2 px-4" data-toggle="modal" data-target="#GuideModal2">장단점 살펴 보기</button>
                            </div>                                                                        
                        </div>
                        <!-- 소개 항목 E -->
                    </div>
                     <!-- Card body E-->
                </div>
                <!-- Card E-->
                <div class="mb-4 mx-2 mx-md-0 bg-light-primary">
                    <div class="card-body pt-3 pb-2"> 
                        <div class="pt-2 pb-0 px-1">
                            <div class="text-center text-dark-gray">
                                <p class="font-weight-bolder display-8 lead py-0 my-0">구직자(실업자) vs. 근로자  대상</p>
                            </div>
                             <div class="mt-3 mb-3 px-2">
                             <button type="button" class="btn btn-sm btn-white btn-block py-2" data-toggle="modal" data-target="#GuideModal3">차이점 알아보기</button>
                            </div>                                                                        
                        </div>
                    </div>
                </div>
                <!-- ////  오른쪽 사각 광고 card S //// -->
                <div class="mb-4">

                </div>
                <!-- ////  오른쪽 사각 광고 card E //// -->                  
            </div>
        </div>                
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="GuideModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <span class="modal-title pt-1 pl-2 display-8" id="myModalLabel">평생학습포털 무료 강좌</span>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body body-data">
                <p>전국 지자체에서 운영하는 평생학습포털에서는 교양,취미,자격증 등의 강좌들을 무료로 볼 수 있습니다. 인기 좋은 유료 강의 수준은 아니지만 퀄리티가 그리 나쁘지도 않습니다.</p>
                <p>아쉬운 점은 과거에는 국가나 여러 군데의 지자체가 다양한 평생학습포털을 활발히 운영했지만, 요즘은 경기도나 서울시 정도를 제외하면 무료 온라인 강의를 보기 힘든 것 같습니다.</p>
                <h4 class="mt-6 display-8">장점</h4>
                <ul>
                <li>강의 수강 자체는 전액 무료</li>
                <li>수강에 특별한 조건이 없음</li>
                <li>회원 가입이나 로그인을 하지 않아도 수강 가능한 경우가 많음</li>
                </ul>
                <h4 class="mt-6 display-8">단점</h4>
                <ul>
                <li>평생학습포털에서 제공하는 강좌가 제한적</li>
                <li>교재가 필요한 경우 따로 구매</li>
                <li>최신 강의로 업데이트되는 주기가 느린 편</li>
                </ul>
            </div>
            <div class="modal-footer px-2 px-lg-4 py-2 py-lg-3 bg-gray">
                <button type="button" class="btn btn-primary py-2" data-dismiss="modal">창 닫기</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="GuideModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <span class="modal-title pt-1 pl-2 display-8" id="myModalLabel">국민내일배움카드 국비지원 강좌</span>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body body-data">
                <p>국민 스스로 직업능력을 개발할 수 있게 국가에서 교육비를 지원하는 제도가 국민내일배움카드 입니다. 구직자, 실업자, 재직 중인 직장인까지 거의 모든 국민이 누구나 신청이 가능합니다.</p><p>국민내일배움카드를 활용하면 최신의 온라인 강좌를 무료 혹은 일부의 비용만 부담하고 수강할 수 있습니다.</p>
                <h4 class="mt-6 display-8">장점</h4>
                <ul>
                <li>최신의 수준 높은 강좌를 국비로 지원받아 수강 가능</li>
                <li>수강료에 교재가 포함되는 경우가 대부분</li>
                <li>교육업체를 통해 수강 관리와 학습 지원을 받을 수 있음</li>
                </ul>
                <h4 class="mt-6 display-8">단점</h4>
                <ul>
                <li>경우에 따라 본인이 수강료의 일부를 부담해야 함</li>
                <li>정해진 기간 내에 수료 조건을 지켜야 비용 지원이 가능</li>
                </ul>
            </div>
            <div class="modal-footer px-2 px-lg-4 py-2 py-lg-3 bg-gray">
                <button type="button" class="btn btn-primary py-2" data-dismiss="modal">창 닫기</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="GuideModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
               <span class="modal-title pt-1 pl-2 display-8" id="myModalLabel">실업자(구직자) vs. 근로자  대상</span>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body body-data">
                <p class="pb-1 mb-0"><span class="badge badge-danger font-size-md">구직자(실업자) 대상</span></p>
                <p class="pl-1 mb-3">말 그대로 현재 구직중이거나 실직 상태의 대상자입니다.</p>
                <p class="pl-1 mb-3">국가에서는 저소득 구직자, 청년 실업자, 경력단절여성, 중장년층 등 취업 취약계층을 대상으로 국민취업지원제도를 시행하고 있습니다. 대상에 해당되면 취업 지원서비스와 생계지원 서비스를 같이 받을 수 있고, 대체로 일반 훈련생에 비해 교육 훈련 정부 지원금이 더 많아 자비 부담금이 줄어들게 됩니다.</p> 
                <p class="pl-1 mb-5">실업자를 대상으로 온라인 훈련 과정을 운영하는 사이트는 한국이러닝연합회 잡고를 포함해 극소수이므로 신청 시 주의하셔야 합니다.</p>
                <p class="pb-1 mb-0"><span class="badge badge-success font-size-md">근로자 대상</span></p>
                <p class="pl-1">현재 직장에 재직중인 경우에 해당합니다. 근로자 대상 온라인 훈련은 직업능력개발훈련을 실시하는 대부분의 훈련기관에서 진행하고 있으니 비교해서 신청하시면 됩니다.</p>
            </div>
            <div class="modal-footer px-2 px-lg-4 py-2 py-lg-3 bg-gray">
                <button type="button" class="btn btn-primary py-2" data-dismiss="modal">창 닫기</button>
            </div>
        </div>
    </div>
</div>