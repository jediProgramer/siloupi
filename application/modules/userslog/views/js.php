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


<!-- Script jquery-validation -->
<script type="text/javascript">
$(document).ready(function () {

$('#addRoles').validate({
	rules: {
	  roles: {
		required: true
	  },
	},
	messages: {
	  roles: {
		required: "<?php echo lang('roles_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var idposition = $('#idposition').val();
		var roles = $('#roles').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('roles/saveroles')?>",
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
			data : {roles:roles, idposition:idposition},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('add_roles');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url()?>roles";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('add_roles');?>",
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
  
$('#editRoles').validate({
	rules: {
	  roles: {
		required: true
	  },
	},
	messages: {
	  roles: {
		required: "<?php echo lang('roles_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var idroles = $('#idroles').val();
		var idposition = $('#idposition').val();
		var roles = $('#roles').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('roles/updateroles')?>",
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
			data : {idroles:idroles, roles:roles, idposition:idposition},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('edit_roles');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url() ?>roles";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('edit_roles');?>",
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
  
$('.deleteRoles').on('click',function(){
	$.ajax({
		type : "POST",
		url  : "<?php echo site_url('roles/deleteroles')?>",
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
		data : {idroles:$(this).attr("data-id")},
		success: function(value){
			if (value.msg == 'true') {				
				swal({
				  type: "success",
				  title: "<?php echo lang('delete_roles');?>",
				  text: value.msg_success,
				  confirmButtonColor: '#1e3d73',
				});
				$('.swal2-confirm').click(function(){
					window.location.href = "<?php echo base_url() ?>roles";
				});
			}
			else
			{
				swal({
				  type: "error",
				  title: "<?php echo lang('delete_roles');?>",
				  text: value.msg_error,
				  confirmButtonColor: '#1e3d73',
				});
			}
		}
	});
	return false;
 });
 
});
</script>