<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap"
      rel="stylesheet"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
      integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
      crossorigin="anonymous"
    />
	
	<!-- Font Awesome CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />

	<!-- Sweet Alert CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.css">
	
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/auth/css/auth.css" />

	<title><?php echo lang('website_name');?> - <?php echo lang('login');?></title>
	
	<link rel="shortcut icon" href="<?php echo base_url();?>assets/dist/images/logo-upi.png" />
  </head>
  <body>
    <!-- Navbar -->
    <nav
      class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top"
    >
      <a class="navbar-brand" href="<?php echo base_url();?>">
        <img
          src="<?php echo base_url();?>assets/auth/img/logo.png"
          alt="logo"
          width="30"
          height="30"
          class="d-inline-block align-top"
          loading="lazy"
        />
        <span class="font-weight-bold"><?php echo lang('apps_name');?></span>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-lg-4">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#myAbout"><?php echo lang('about');?></a>
          </li>
          <li class="nav-item mr-lg-4">
            <a class="nav-link" href="#" data-toggle="modal" data-target="#myFAQ"><?php echo lang('faq');?></a>
          </li>
          <li class="nav-item">
            <a class="btn btn-siloupi font-weight-bold px-3 py-2" href="<?php echo base_url();?>assets/files/guide/panduan.pdf">
              <i class="fa fa-question-circle" aria-hidden="true"></i> <?php echo lang('guide');?>
            </a>
          </li>
        </ul>
      </div>
    </nav>

	<!-- Modal About-->
	<div class="modal fade" id="myAbout" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p align="justify"><?php echo lang('about_apps');?></p>
        </div>
      </div>
      
    </div>
  	</div>
	<!-- End Modal About-->

	<!-- Modal FAQ'S-->
	<div class="modal fade" id="myFAQ" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p align="justify"><?php echo lang('faq_apps');?></p>
		  <p align="justify"><i class="fa fa-whatsapp"></i> <a href="https://wa.me/<?php echo lang('no_helpdesk1');?>"><?php echo lang('helpdesk1');?></a></p>
		  <p align="justify"><i class="fa fa-whatsapp"></i> <a href="https://wa.me/<?php echo lang('no_helpdesk2');?>"><?php echo lang('helpdesk2');?></a></p>
        </div>
      </div>
      
    </div>
  	</div>
	<!-- End Modal FAQ'S-->

    <!-- Jumbotron -->
    <div class="jumbotron bg-white">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 order-1 order-lg-1">
            <h1 class="display-4 font-weight-bold">
			<?php echo lang('website_name');?>
            </h1>
            <p class="lead" align="justify">
			<?php echo lang('website_title_hallo');?>
            </p>
            <hr class="my-4" />
          </div>
          <div class="col-lg-6 order-2 order-lg-2">
		  <h1 class="display-7 font-weight-bold">
              <i class="fa fa-sign-in" aria-hidden="true"></i>
			  <?php echo lang('login');?>
          </h1>
		  <hr class="my-4" />
            <form id="webloginForm">
    <div class="form-group">
      <label for="nip" class="required-label"><b><?php echo lang('nip');?></b></label>
      <input type="nip" class="form-control" id="nip" placeholder="<?php echo lang('entry_nip');?>" name="nip" required>
    </div>
    <div class="form-group">
      <label for="pwd" class="required-label"><b><?php echo lang('password');?></b></label>
      <input type="password" class="form-control" id="password" placeholder="<?php echo lang('entry_password');?>" name="password" required>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> <?php echo lang('remember_me');?></label>
    </div>
    <button type="submit" class="btn btn-siloupi font-weight-bold px-3 py-2 btn-block"><i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo lang('login');?></button>
  </form>  
          </div>
        </div>
      </div>
    </div>

    <!-- START: Template JS-->
	<script src="<?php echo base_url();?>assets/dist/vendors/jquery/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/vendors/jquery-ui/jquery-ui.min.js"></script>
	<!-- Sweet Alert & Validate JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url();?>assets/dist/vendors/moment/moment.js"></script>
    <script src="<?php echo base_url();?>assets/dist/vendors/bootstrap/js/bootstrap.bundle.min.js"></script>    
    <script src="<?php echo base_url();?>assets/dist/vendors/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?php echo base_url()?>assets/dist/js/jquery.validate.min.js"></script>
	<script src="<?php echo base_url()?>assets/dist/js/additional-methods.min.js"></script>

    <!-- Custom Javascript -->
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
				required: "<?php echo lang('entry_nip');?>"
			  },
			  password: {
				required: "<?php echo lang('entry_password');?>"
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
			  element.closest('.form-group').append(error);
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
  </body>
</html>