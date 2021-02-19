<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('add_plo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>entrydata/plo"><?php echo lang('plo_hallo');?></a></li>
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
												foreach($datauser as $du)
												{
											?>
                                            <form id="addPLO">
													<div class="form-group row">
														<label for="fullname" class="col-sm-2 col-form-label"><?php echo lang('institution');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="institution" id="institution" placeholder="<?php echo lang('institution');?>" value="<?php echo $du["institution"];?>" disabled>
														</div>
													</div>
													<div class="form-group row">
														<label for="idcurriculum" class="col-sm-2 col-form-label"><?php echo lang('curriculum');?></label>
														<div class="col-sm-10">
															<select class="form-control" id="idcurriculum" name="idcurriculum">
															<?php
																foreach($datacurriculum as $dc)
																{
															?>
															  <option value="<?php echo $dc["idcurriculum"];?>"><?php echo $dc["curriculum"];?></option>
															<?php
																}
															?>  
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="menu" class="col-sm-2 col-form-label"><?php echo lang('plo');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="plo" id="plo" placeholder="<?php echo lang('plo');?>" required>
														</div>
													</div>											
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
													    <input type="hidden" class="form-control" id="idinstitution" name="idinstitution" value="<?php echo $du["idinstitution"];?>">
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
        
