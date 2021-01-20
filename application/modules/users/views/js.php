<!-- START: Template JS-->
<script src="<?php echo base_url();?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/moment/moment.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
<!-- END: Template JS-->

<!-- START: APP JS-->
<script src="<?php echo base_url();?>assets/dist/js/app.js"></script>
<!-- END: APP JS-->

<!-- START: Page Vendor JS-->
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/jszip/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/datatable/buttons/js/buttons.print.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()?>assets/dist/vendors/select2/js/select2.full.min.js"></script>
<!-- END: Page Vendor JS-->


<!-- Sweet Alert & Form Validation JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/js/additional-methods.min.js"></script>

<!-- bs-custom-file-input -->
<script src="<?php echo base_url()?>assets/dist/vendors/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- Script bs-custom-file-input -->
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<!-- Script dataTables -->
<script type="text/javascript">
  $(function () {
    $("#data").DataTable({
		 "language": {
            "lengthMenu": "<?php echo lang('display');?> _MENU_ <?php echo lang('records_per_page');?>",
            "zeroRecords": "<?php echo lang('zeroRecords');?>",
            "info": "<?php echo lang('showing_page');?> _PAGE_ <?php echo lang('showing_page_of');?> _PAGES_",
            "infoEmpty": "<?php echo lang('infoEmpty');?>",
            "infoFiltered": "(<?php echo lang('infoFiltered_form');?> _MAX_ <?php echo lang('infoFiltered_record');?>)",
			"search": "<?php echo lang('search');?>:",
			"paginate": {
				  "previous": "<?php echo lang('previous');?>",
				  "next": "<?php echo lang('next');?>",
				}
		 }	
	});
  });
</script>

<!--Initialize Select2 Elements -->
<script type="text/javascript">
(function ($) {
    "use strict";
   $('select').each(function () {
    $(this).select2({
      theme: 'bootstrap4',
      width: 'style',
      placeholder: $(this).attr('placeholder'),
      allowClear: Boolean($(this).data('allow-clear')),
    });
  });
})(jQuery);
</script>

<!-- Script jquery-validation -->
<script type="text/javascript">
$(document).ready(function () {

$('#addUsers').validate({
	rules: {
	  nip: {
		required: true
	  },
	  fullname: {
		required: true
	  },
	  lecturercode: {
		required: true
	  },
	  email: {
			required: true,
			email: true,
	  },
	},
	messages: {
	  nip: {
		required: "<?php echo lang('nip_empty_msg');?>"
	  },
	  fullname: {
		required: "<?php echo lang('fullname_error_msg');?>"
	  },
	  lecturercode: {
		required: "<?php echo lang('lecturercode_error_msg');?>"
	  },
	  email: {
		required: "<?php echo lang('email_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var nip = $('#nip').val();
		var fullname = $('#fullname').val();
		var lecturercode = $('#lecturercode').val();
		var email = $('#email').val();
		var roles = $('#idroles').val();
		var active = $('input[name="active"]:checked').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('users/saveusers')?>",
			dataType : "JSON",
			beforeSend :function () {
					swal({
						title: "<?php echo lang('waiting');?>",
						html: "<?php echo lang('data_prossecing');?>",
						onOpen: () => {
						  swal.showLoading()
						}
					  })      
			},
			data : {nip:nip, fullname:fullname, lecturercode:lecturercode, email:email, roles:roles, active:active},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('add_users');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url()?>users";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('add_users');?>",
					  text: value.msg_error,
					  confirmButtonColor: '#1e3d73',
					});
				}
			}
		});
		return false;
	},
	errorElement: 'span',
	errorPlacement: function (error, element) {
	  error.addClass('invalid-feedback');
	  element.closest('.col-sm-10').append(error);
	},
	highlight: function (element, errorClass, validClass) {
	  $(element).addClass('is-invalid');
	},
	unhighlight: function (element, errorClass, validClass) {
	  $(element).removeClass('is-invalid');
	}
  });
  
$('#editUsers').validate({
	rules: {
	  nip: {
		required: true
	  },
	  fullname: {
		required: true
	  },
	  lecturercode: {
		required: true
	  },
	  email: {
			required: true,
			email: true,
	  },
	},
	messages: {
	  nip: {
		required: "<?php echo lang('nip_empty_msg');?>"
	  },
	  fullname: {
		required: "<?php echo lang('fullname_error_msg');?>"
	  },
	  lecturercode: {
		required: "<?php echo lang('lecturercode_error_msg');?>"
	  },
	  email: {
		required: "<?php echo lang('email_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var idusersweb = $('#idusersweb').val();
		var nip = $('#nip').val();
		var fullname = $('#fullname').val();
		var lecturercode = $('#lecturercode').val();
		var email = $('#email').val();
		var roles = $('#idroles').val();
		var active = $('input[name="active"]:checked').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('users/saveseditusers')?>",
			dataType : "JSON",
			beforeSend :function () {
					swal({
						title: "<?php echo lang('waiting');?>",
						html: "<?php echo lang('data_prossecing');?>",
						onOpen: () => {
						  swal.showLoading()
						}
					  })      
			},
			data : {idusersweb:idusersweb, nip:nip, fullname:fullname, lecturercode:lecturercode, email:email, roles:roles, active:active},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('edit_users');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url()?>users";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('edit_users');?>",
					  text: value.msg_error,
					  confirmButtonColor: '#1e3d73',
					});
				}
			}
		});
		return false;
	},
	errorElement: 'span',
	errorPlacement: function (error, element) {
	  error.addClass('invalid-feedback');
	  element.closest('.col-sm-10').append(error);
	},
	highlight: function (element, errorClass, validClass) {
	  $(element).addClass('is-invalid');
	},
	unhighlight: function (element, errorClass, validClass) {
	  $(element).removeClass('is-invalid');
	}
  });
  
  $('#institutionUsers').validate({
	submitHandler: function (form) {
		var idusersweb = $('#idusersweb').val();
		var idinstitution = $('#idinstitution').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('users/savesinstitutitonusers')?>",
			dataType : "JSON",
			beforeSend :function () {
					swal({
						title: "<?php echo lang('waiting');?>",
						html: "<?php echo lang('data_prossecing');?>",
						onOpen: () => {
						  swal.showLoading()
						}
					  })      
			},
			data : {idusersweb:idusersweb, idinstitution:idinstitution},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('institution_users');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url()?>users";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('institution_users');?>",
					  text: value.msg_error,
					  confirmButtonColor: '#1e3d73',
					});
				}
			}
		});
		return false;
	},
	errorElement: 'span',
	errorPlacement: function (error, element) {
	  error.addClass('invalid-feedback');
	  element.closest('.col-sm-10').append(error);
	},
	highlight: function (element, errorClass, validClass) {
	  $(element).addClass('is-invalid');
	},
	unhighlight: function (element, errorClass, validClass) {
	  $(element).removeClass('is-invalid');
	}
  });
  
});
</script>