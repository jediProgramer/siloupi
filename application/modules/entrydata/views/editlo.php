<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('edit_lo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>entrydata/detailplo/<?php echo $idplo;?>"><?php echo lang('lo_hallo');?></a></li>
						<li class="breadcrumb-item active"><?php echo $menuname;?></li>
					</ol>
				</div>
			</div>
		</div>
		<!-- END: Breadcrumbs-->

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
											<?php
												foreach($datalo as $d)
												{
											?>
                                            <form id="editLO">
													<div class="form-group row">
														<label for="idlo" class="col-sm-2 col-form-label"><?php echo lang('lo_code');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="idlo" id="idlo" placeholder="<?php echo lang('lo_code');?>" value="<?php echo $d["idlo"];?>" disabled>
														</div>
													</div>	
													<div class="form-group row">
														<label for="lo" class="col-sm-2 col-form-label"><?php echo lang('lo');?></label>
														<div class="col-sm-10">
															<textarea class="textarea" placeholder="<?php echo lang('lo');?>" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" id="lo" name="lo">
															<?php echo $d["lo"];?>
															</textarea>
														</div>
													</div>
													<div class="form-group row">
														<div class="col-sm-10">
															<input type="hidden" class="form-control" id="idplo" name="idplo" value="<?php echo $idplo;?>">	
															<input type="hidden" class="form-control" id="idlo" name="idlo" value="<?php echo $d["idlo"];?>">
															<button type="submit" class="btn btn-primary"><?php echo lang('submit');?></button>
														</div>
													</div>
											</form>
											<?php
												}
											?>
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
        
