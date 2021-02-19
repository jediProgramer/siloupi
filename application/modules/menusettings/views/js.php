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

$('#addMenu').validate({
	rules: {
	  menu: {
		required: true
	  },
	  icon: {
		required: true
	  },
	},
	messages: {
	  menu: {
		required: "<?php echo lang('menu_error_msg');?>"
	  },
	  icon: {
		required: "<?php echo lang('icon_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var menu = $('#menu').val();
		var icon = $('#icon').val();
		var link = $('#link').val();
		var short = $('#short').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('menusettings/savenavkategori')?>",
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
			data : {menu:menu, link:link, icon:icon, short:short},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('add_menu');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url() ?>menusettings/mainmenu";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('add_menu');?>",
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
  
$('#editMenu').validate({
	rules: {
	  menu: {
		required: true
	  },
	  icon: {
		required: true
	  },
	},
	messages: {
	  menu: {
		required: "<?php echo lang('menu_error_msg');?>"
	  },
	  icon: {
		required: "<?php echo lang('icon_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var menu = $('#menu').val();
		var icon = $('#icon').val();
		var link = $('#link').val();
		var short = $('#short').val();
		var idnavcategory = $('#idnavcategory').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('menusettings/updatenavkategori')?>",
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
			data : {menu:menu, icon:icon, link:link, short:short, idnavcategory:idnavcategory},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('edit_menu');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url() ?>menusettings/mainmenu";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('edit_menu');?>",
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
  
$('.deleteMenu').on('click',function(){
	$.ajax({
		type : "POST",
		url  : "<?php echo site_url('menusettings/deletenavkategori')?>",
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
		data : {idnavcategory:$(this).attr("data-id")},
		success: function(value){
			if (value.msg == 'true') {				
				swal({
				  type: "success",
				  title: "<?php echo lang('delete_menu');?>",
				  text: value.msg_success,
				  confirmButtonColor: '#1e3d73',
				});
				$('.swal2-confirm').click(function(){
					window.location.href = "<?php echo base_url() ?>menusettings/mainmenu";
				});
			}
			else
			{
				swal({
				  type: "error",
				  title: "<?php echo lang('delete_menu');?>",
				  text: value.msg_error,
				  confirmButtonColor: '#1e3d73',
				});
			}
		}
	});
	return false;
 });
 
 $('#addMenuSecond').validate({
	rules: {
	  navigation: {
		required: true
	  },
	  icon: {
		required: true
	  },
	},
	messages: {
	  navigation: {
		required: "<?php echo lang('menusecond_error_msg');?>"
	  },
	  icon: {
		required: "<?php echo lang('icon_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var idnavcategory = $('#idnavcategory').val();
		var navigation = $('#navigation').val();
		var icon = $('#icon').val();
		var link = $('#link').val();
		var short = $('#short').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('menusettings/savenavigasi')?>",
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
			data : {idnavcategory:idnavcategory, navigation:navigation, icon:icon, link:link, short:short},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('add_secondmenu');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url() ?>menusettings/secondmenu";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('add_secondmenu');?>",
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
  
  $('#editMenuSecond').validate({
	rules: {
	  navigation: {
		required: true
	  },
	  icon: {
		required: true
	  },
	},
	messages: {
	  navigation: {
		required: "<?php echo lang('menusecond_error_msg');?>"
	  },
	  icon: {
		required: "<?php echo lang('icon_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var idnavigation = $('#idnavigation').val();
		var idnavcategory = $('#idnavcategory').val();
		var navigation = $('#navigation').val();
		var icon = $('#icon').val();
		var link = $('#link').val();
		var short = $('#short').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('menusettings/updatenavigasi')?>",
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
			data : {idnavigation:idnavigation, idnavcategory:idnavcategory, navigation:navigation, icon:icon, link:link, short:short},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('edit_secondmenu');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url() ?>menusettings/secondmenu";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('edit_secondmenu');?>",
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
  
  $('.deleteMenuSecond').on('click',function(){
	$.ajax({
		type : "POST",
		url  : "<?php echo site_url('menusettings/deletenavigasi')?>",
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
		data : {idnavigation:$(this).attr("data-id")},
		success: function(value){
			if (value.msg == 'true') {				
				swal({
				  type: "success",
				  title: "<?php echo lang('delete_secondmenu');?>",
				  text: value.msg_success,
				  confirmButtonColor: '#1e3d73',
				});
				$('.swal2-confirm').click(function(){
					window.location.href = "<?php echo base_url() ?>menusettings/secondmenu";
				});
			}
			else
			{
				swal({
				  type: "error",
				  title: "<?php echo lang('delete_secondmenu');?>",
				  text: value.msg_error,
				  confirmButtonColor: '#1e3d73',
				});
			}
		}
	});
	return false;
 });
 
 $('#addMenuThird').validate({
	rules: {
	  subnavigation: {
		required: true
	  },
	  icon: {
		required: true
	  },
	},
	messages: {
	  subnavigation: {
		required: "<?php echo lang('menuthird_error_msg');?>"
	  },
	  icon: {
		required: "<?php echo lang('icon_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var idnavigation = $('#idnavigation').val();
		var subnavigation = $('#subnavigation').val();
		var icon = $('#icon').val();
		var link = $('#link').val();
		var short = $('#short').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('menusettings/savesubnavigasi')?>",
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
			data : {idnavigation:idnavigation, subnavigation:subnavigation, icon:icon, link:link, short:short},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('add_thirdmenu');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url() ?>menusettings/thirdmenu";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('add_thirdmenu');?>",
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
  
  $('#editMenuThird').validate({
	rules: {
	  subnavigation: {
		required: true
	  },
	  icon: {
		required: true
	  },
	},
	messages: {
	  subnavigation: {
		required: "<?php echo lang('menuthird_error_msg');?>"
	  },
	  icon: {
		required: "<?php echo lang('icon_error_msg');?>"
	  },
	},
	submitHandler: function (form) {
		var idsubnavigation = $('#idsubnavigation').val();
		var idnavigation = $('#idnavigation').val();
		var subnavigation = $('#subnavigation').val();
		var icon = $('#icon').val();
		var link = $('#link').val();
		var short = $('#short').val();
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('menusettings/updatesubnavigasi')?>",
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
			data : {idsubnavigation:idsubnavigation, idnavigation:idnavigation, subnavigation:subnavigation, icon:icon, link:link, short:short},
			success: function(value){
				if (value.msg == 'true') {
					swal({
					  type: "success",
					  title: "<?php echo lang('edit_thirdmenu');?>",
					  text: value.msg_success,
					  confirmButtonColor: '#1e3d73',
					});
					$('.swal2-confirm').click(function(){
						window.location.href = "<?php echo base_url() ?>menusettings/thirdmenu";
					});
				}
				else
				{
					swal({
					  type: "error",
					  title: "<?php echo lang('edit_thirdmenu');?>",
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
  
  $('.deleteMenuthird').on('click',function(){
	$.ajax({
		type : "POST",
		url  : "<?php echo site_url('menusettings/deletesubnavigasi')?>",
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
		data : {idsubnavigation:$(this).attr("data-id")},
		success: function(value){
			if (value.msg == 'true') {				
				swal({
				  type: "success",
				  title: "<?php echo lang('delete_thirdmenu');?>",
				  text: value.msg_success,
				  confirmButtonColor: '#1e3d73',
				});
				$('.swal2-confirm').click(function(){
					window.location.href = "<?php echo base_url() ?>menusettings/thirdmenu";
				});
			}
			else
			{
				swal({
				  type: "error",
				  title: "<?php echo lang('delete_thirdmenu');?>",
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