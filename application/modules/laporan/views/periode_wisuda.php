<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard"><?php echo lang('dashboard');?></a></li>
						<li class="breadcrumb-item active"><?php echo $menuname;?></li>
					</ol>
				</div>
			</div>
		</div>
		<!-- END: Breadcrumbs-->
		
        <div class="row">	
			<div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <form class="form-horizontal" action="<?php echo base_url()?>laporan/periode_wisuda" method="post" id="filterloForm" name="filterloForm">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="years"><?php echo lang('graduate_generation');?></label>
								<?php echo $years;?>
							</div>
							<div class="form-group col-md-6">
								<label for="years"><?php echo lang('graduate_name');?></label>
								<select id='id_grad' name='graduation_name' class='form-control'>
									<option value='0'><?php echo lang('graduation_name');?></option>
								</select>
							</div>
						</div>
						<div class="form-group row">
								<div class="col-sm-10">
									<button type="submit" class="btn btn-primary"><i class="fa fa-search">&nbsp;</i>&nbsp;<?php echo lang('search');?></button>
								</div>
						</div>
						</form>
                    </div>
                </div>
            </div>
        </div>
		
        <div id="detail">
            <?php $this->load->view("laporan/laporan_detail"); ?>
	    </div>
	</div>
</main>
<!-- END: Content-->

<script>
	function graduation_id(x){
		$('#id_grad').load("<?php echo site_url('laporan/graduation_id')?>"+"/" + x);
	}
</script>
        
