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

<!-- START: Datatables -->
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

<!-- Summernote -->
<script src="<?php echo base_url()?>assets/dist/vendors/summernote/summernote-bs4.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- Sweet Alert & Form Validation JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.28.1/sweetalert2.all.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url()?>assets/dist/js/additional-methods.min.js"></script>

<!-- bs-custom-file-input -->
<script src="<?php echo base_url()?>assets/dist/vendors/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- END: Page Vendor JS-->

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

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
	$('.delete').on('click',function(){
		$.ajax({
			type : "POST",
			url  : "<?php echo site_url('curriculum/delete')?>",
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
			data : {id: $(this).attr("data-id")},
			success: function(value){
				if (value.msg == 'true') {				
					swal({
						type: "success",
						title: "<?php echo lang('curriculum_delete');?>",
						text: value.msg_success,
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
						title: "<?php echo lang('curriculum_delete');?>",
						text: value.msg_error,
						confirmButtonColor: '#1e3d73',
					});
				}
			}
		});
		return false;
	});

	$('#import').validate({
		rules: {
			file: {
				required: true
			},
		},
		messages: {
			file: {
				required: "<?php echo lang('csv_error_msg');?>"
			},
		},
		submitHandler: function (form) {
			var formData = new FormData(form);
			$.ajax({
				type : "POST",
				url  : "<?php echo site_url('curriculum/import')?>",
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
						title: "<?php echo lang('curriculum_add');?>",
						text: data.msg_success,
						confirmButtonColor: '#1e3d73',
						});
						$('.swal2-confirm').click(function(){
							window.location.href = "<?php echo base_url()?>curriculum";
						});
					}
					else
					{
						swal({
						type: "error",
						title: "<?php echo lang('curriculum_add');?>",
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
});
</script>
