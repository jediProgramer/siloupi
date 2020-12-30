<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('add_lo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>entrydata/detailplo/<?php echo $idplo;?>"><?php echo lang('lo_hallo');?></a></li>
						<li class="breadcrumb-item active"><?php echo $menuname;?></li>
					</ol>
				</div>
			</div>
		</div>
		<!-- END: Breadcrumbs-->

		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?php echo lang('upload_csv_lo_info');?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">×</span>
			</button>
		</div>

		<!-- START: Card Data-->
		<div class="row">
			
			<div class="col-12 mt-3">
                        <div class="card">
                            <div class="card-header">                               
                                <h4 class="card-title"><?php echo $menuname;?></h4>                                
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">                                           
                                        <div class="col-12">
                                            <form id="addLOCSV">	
													<div class="form-group row">
														<label for="lo" class="col-sm-2 col-form-label"><?php echo lang('file_csv');?></label>
														<div class="col-sm-10">
															<div class="custom-file overflow-hidden">
																<input id="filelo" name="filelo" type="file" class="custom-file-input">
																<label for="csv" class="custom-file-label"><?php echo lang('chosefile_csv');?></label>
															</div>
														</div>
													</div>
													<div class="form-group row">
														<div class="col-sm-10">
															<input type="hidden" class="form-control" id="idplo" name="idplo" value="<?php echo $idplo;?>">
															<button type="submit" class="btn btn-primary"><?php echo lang('submit');?></button>
														</div>
													</div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

		</div>
		<!-- END: Card DATA-->
	</div>
</main>
<!-- END: Content-->
        
