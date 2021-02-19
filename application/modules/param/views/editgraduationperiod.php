<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('param_graduationperiod_edit_hallo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>param/graduationperiod"><?php echo lang('param_graduationperiod');?></a></li>
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
												foreach($datagraduationperiod as $dgp)
												{
										   ?>
                                            <form id="editGraduationPeriod">
													<div class="form-group row">
														<label for="years" class="col-sm-2 col-form-label"><?php echo lang('class_generation');?></label>
														<div class="col-sm-10">
															<select class="form-control" id="years" name="years">
																<option value='0'><?php echo lang('chose_year');?></option>
																<?php
																	$now=date('Y');
																	for ($a=2018;$a<=$now;$a++)
																	{
																?>
																  <option value="<?php echo $a;?>" <?php if($dgp["year_graduation"]==$a){ echo "selected";}?>><?php echo $a;?></option>
																<?php
																	}
																?>  
																</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="graduate_name" class="col-sm-2 col-form-label"><?php echo lang('graduate_name');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="graduate_name" id="graduate_name" placeholder="<?php echo lang('graduate_name');?>" value="<?php echo $dgp["graduation_name"];?>">
														</div>
													</div>	
													<div class="form-group row">
														<label for="month_graduationperiod" class="col-sm-2 col-form-label"><?php echo lang('month_graduationperiod');?></label>
														<div class="col-sm-10">
															<input type="number" class="form-control" name="month_graduationperiod" id="month_graduationperiod" placeholder="<?php echo lang('month_graduationperiod');?>" value="<?php echo $dgp["month_graduation"];?>" required>
														</div>
													</div>												
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
														<input type="hidden" class="form-control" id="idgraduation" name="idgraduation" value="<?php echo $dgp["idgraduation"];?>">
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
        
