(function ($) {
  "use strict";
 
	$(document).ready(function () {
		$('.select_dropdown').select2();

		var table;
		//datatables
	    table = $("#table").DataTable({
	      language: {
	        info: table_showing +
	          " _START_ " +
	          table_to +
	          " _END_ " +
	          table_of +
	          " _TOTAL_ " +
	          table_entries,
	        paginate: {
	          previous: table_previous,
	          next: table_next,
	        },
	        sLengthMenu: table_show + " _MENU_ " + table_entries,
	        sSearch: table_search,
	      },

	      processing: true, //Feature control the processing indicator.
	      serverSide: true, //Feature control DataTables' server-side processing mode.
	      order: [],
	      ajax: {
	        url: BASE_URL + "admin/extcourse/list",
	        type: "POST",
	      },

	      //Set column definition initialisation properties.
	      columnDefs: [{
	        targets: [0], //first column / numbering column
	        orderable: false, //set not orderable
	      }, ],
	    });

	  //package and related package quiz delete with sweetalert
	  $("body").on("click", ".common_delete", function (e) {
	    var link = $(this).attr("href");

	    e.preventDefault(false);
	    swal({
	        title: are_you_sure,
	        text: permanently_deleted,
	        type: "warning",
	        showCancelButton: true,
	        confirmButtonColor: "#3085d6",
	        cancelButtonColor: "#d33",
	        confirmButtonText: yes_delere_it,
	      },
	      function (isConfirm) {
	        if (isConfirm == true) {
	          window.location.href = link;
	        }
	      }
	    );
	  });

	  var table;
	  var ext_course_id = $('.ext_course_id').val();
		//datatables
	    table = $("#materialfiletable").DataTable({
	      language: {
	        info: table_showing +
	          " _START_ " +
	          table_to +
	          " _END_ " +
	          table_of +
	          " _TOTAL_ " +
	          table_entries,
	        paginate: {
	          previous: table_previous,
	          next: table_next,
	        },
	        sLengthMenu: table_show + " _MENU_ " + table_entries,
	        sSearch: table_search,
	      },

	      processing: true, //Feature control the processing indicator.
	      serverSide: true, //Feature control DataTables' server-side processing mode.
	      order: [],
	      ajax: {
	        url: BASE_URL + "admin/study/material-file-list/"+study_material_id,
	        type: "POST",
	      },

	      //Set column definition initialisation properties.
	      columnDefs: [{
	        targets: [0], //first column / numbering column
	        orderable: false, //set not orderable
	      }, ],
	    });

	    $(document).on("click", ".is_premium", function (e) 
	    {
	       if($(this).prop("checked")==true)
	       {
	       		$('.input_price').attr('readonly', true);
	       }
	       else
	       {
	        	$('.input_price').attr('readonly', false);
	       }
	    });

	});





})(jQuery);