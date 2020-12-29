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
<script src="<?php echo base_url();?>assets/dist/vendors/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/morris/morris.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/starrr/starrr.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.canvaswrapper.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.colorhelpers.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.saturated.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.browser.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.drawSeries.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.uiConstants.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.legend.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/chartjs/Chart.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-de-merc.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/jquery-jvectormap/jquery-jvectormap-us-aea.js"></script>
<script src="<?php echo base_url();?>assets/dist/vendors/apexcharts/apexcharts.min.js"></script>
<!-- Sweet Alert & Form Validation JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/js/additional-methods.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url()?>assets/dist/vendors/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- START: Page JS-->
<script src="<?php echo base_url();?>assets/dist/js/home.script.js"></script>
<!-- END: Page JS-->

<!-- Script bs-custom-file-input -->
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<!-- Script jquery-validation -->
<script type="text/javascript">
$(document).ready(function () {

$('#webprofilepictureForm').validate({
	rules: {
	  image: {
		required: true
	  },
	},
	messages: {
	  image: {
		required: "<?php echo lang('image_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var formData = new FormData(form);
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('editprofile/savesprofilepicture')?>",
			dataType : "JSON",
			data: formData,
			processData:false,
			contentType:false,
			cache:false,
			beforeSend :function () {
					swal({
						title: "<?php echo lang('waiting');?>",
						html: "<?php echo lang('data_prossecing');?>",
						onOpen: () => {
						  swal.showLoading()
						}
					  })      
			},
			success: function(data){
				if (data.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('fotoprofile');?>",
					  text: data.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.reload();
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('fotoprofile');?>",
					  text: data.msg_error,
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
	
$('#webprofileaccountForm').validate({
	rules: {
	  fullname: {
		required: true
	  },
	  email: {
			required: true,
			email: true,
	  },
	  old_password: {
		required: true
	  },
	  password: {
		equalTo: "#oldpassword"
	  },
	  phoneno: {
		required: true
	  },
	},
	messages: {
	  fullname: {
		required: "<?php echo lang('fullname_error_msg');?>"
	  },
	  email: {
		required: "<?php echo lang('email_error_msg');?>"
	  },
	  old_password: {
		required: "<?php echo lang('oldpassword_error_msg');?>"
	  },
	  password: {
		required: "<?php echo lang('password_error_msg');?>"
	  },
	  phoneno: {
		required: "<?php echo lang('phoneno_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var idusers = $('#idusers').val();
		var fullname = $('#fullname').val();
		var email = $('#email').val();
		var old_password = $('#old_password').val();
		var password = $('#password').val();
		var phoneno = $('#phoneno').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('editprofile/updateusers')?>",
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
			data : {idusers:idusers, fullname:fullname, email:email, old_password:old_password, password:password, phoneno:phoneno},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('edit_profile');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url()?>viewprofile";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('edit_profile');?>",
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