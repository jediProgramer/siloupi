<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
        <meta charset="UTF-8">
        <title><?php echo lang('website_name');?> - <?php echo lang('login');?></title>
        <link rel="shortcut icon" href="<?php echo base_url();?>assets/dist/images/logo-upi.png" />
        <meta name="viewport" content="width=device-width,initial-scale=1"> 

        <!-- START: Template CSS-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.theme.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/simple-line-icons/css/simple-line-icons.css">        
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/flags-icon/css/flag-icon.min.css"> 

        <!-- END Template CSS-->     

        <!-- START: Page CSS-->   
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/vendors/social-button/bootstrap-social.css"/>   
		
        <!-- END: Page CSS-->
		
		<!-- Sweet Alert CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.css">

        <!-- START: Custom CSS-->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/main.css">
		
        <!-- END: Custom CSS-->
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default">
        <!-- START: Main Content-->
        <div class="container">
            <div class="row vh-100 justify-content-between align-items-center">
                <div class="col-12">
                    <form id="webloginForm" class="row row-eq-height lockscreen  mt-5 mb-5">
                        <div class="lock-image col-12 col-sm-5">
						<center>
						<img src="<?php echo base_url();?>assets/dist/images/upi_white.png">
						<br/>
						<br/>
						<?php echo lang('website_name');?>
						</center>
						</div>
                        <div class="login-form col-12 col-sm-7">
                            <div class="form-group col-sm-12">
                                <label for="emailaddress"><?php echo lang('nip');?></label>
								<input class="form-control" type="text" id="nip" name="nip" required placeholder="<?php echo lang('entry_nip');?>">
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="password"><?php echo lang('password');?></label>
                                <input class="form-control" type="password" id="password"  name="password" required placeholder="<?php echo lang('entry_password');?>">
                            </div>

                            <div class="form-group col-sm-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked="">
                                    <label class="custom-control-label" for="checkbox-signin"><?php echo lang('remember_me');?></label>
                                </div>
                            </div>

                            <div class="form-group col-sm-12">
                                <button class="btn btn-primary" type="submit"><?php echo lang('login');?></button>
                            </div>
                            <div class="col-sm-10"><?php echo lang('dont_have_account');?> <a href="page-register.html"><?php echo lang('create_account');?></a></div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <!-- END: Content-->

        <!-- START: Template JS-->
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
		<!-- Sweet Alert JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/moment/moment.js"></script>
        <script src="<?php echo base_url();?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
        <script src="<?php echo base_url();?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
		
		<script src="<?php echo base_url()?>assets/dist/js/jquery.validate.min.js"></script>
		<script src="<?php echo base_url()?>assets/dist/js/additional-methods.min.js"></script>
		
		<script type="text/javascript">
		$(document).ready(function () {
		  $('#webloginForm').validate({
			rules: {
			  nip: {
				required: true
			  },
			  password: {
				required: true
			  },
			},
			messages: {
			  nip: {
				required: "<?php echo lang('nip_error_msg');?>"
			  },
			  password: {
				required: "<?php echo lang('password_error_msg');?>"
			  },
			},
			submitHandler: function (form) {
				var nip = $('#nip').val();
				var password = $('#password').val();
				$.ajax({
					type : "POST",
					url  : "<?php echo site_url('auth/loginprocess')?>",
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
					data : {nip:nip, password:password},
					success: function(value){
						if (value.msg == 'true') {
							swal({
							  type: "success",
							  title: "<?php echo lang('login');?>",
							  text: value.msg_success,
							  timer: 1000,
							  showCancelButton: false,
							  showConfirmButton: false
							}).then(function() {
							// Redirect the user
								window.location.href = "<?php echo base_url() ?>dashboard";
							});
						}
						else
						{
							swal({
							  type: "error",
							  title: "<?php echo lang('login');?>",
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
			  element.closest('.col-sm-12').append(error);
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

        <!-- END: Template JS-->  
    </body>
    <!-- END: Body-->
</html>
