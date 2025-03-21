<?php defined('BASEPATH') OR exit('No direct script access allowed');
   if($this->session->flashdata('success')) {
      echo '<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" aria-label="close" data-dismiss="alert">&times;</button>
      <strong>Success!</strong> '.$this->session->flashdata("success").'
      </div>';
   }

?>
<div class="panel panel-default">
   
   <div class="table-responsive">
   <table id="table" class="display table table-striped table-bordered" cellspacing="0" width="100%">
      <thead>
         <tr>
            <th>No</th>
            <th class="w-auto">이름</th>
            <th class="w-auto">ID</th>
            <th class="w-auto">종류</th>
            <th class="w-auto">상품명</th>
            <th class="w-auto">금액</th>
            <th class="w-auto">수단</th>
            <th class="w-auto">결제상태</th>
            <th class="w-auto">자세히</th>
         </tr>
      </thead>
      <tbody>
      </tbody> 
   </table>
   </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
               <h4 class="modal-title" id="myModalLabel">결제 상세 정보</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body payment-data"></div>
            <div class="modal-footer">
                <a target="_blank" class="btn btn-info invoice-bill">명세서 보기</a>
                <button type="button" class="btn btn-default" data-dismiss="modal">닫기</button>
            </div>
        </div>
    </div>
</div>