<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('userssettings_edit_hallo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>users"><?php echo lang('userssettings');?></a></li>
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
												foreach($datauserweb as $du)
												{
											?>
                                            <form id="editUsers">
													<div class="form-group row">
														<label for="nip" class="col-sm-2 col-form-label"><?php echo lang('nip');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="nip" id="nip" placeholder="<?php echo lang('nip');?>"  value="<?php echo $du["nip"];?>" required>
														</div>
													</div>
													<div class="form-group row">
														<label for="fullname" class="col-sm-2 col-form-label"><?php echo lang('fullname');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="fullname" id="fullname" placeholder="<?php echo lang('fullname');?>"  value="<?php echo $du["fullname"];?>" required>
														</div>
													</div>
													<div class="form-group row">
														<label for="lecturercode" class="col-sm-2 col-form-label"><?php echo lang('lecturercode');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="lecturercode" id="lecturercode" placeholder="<?php echo lang('lecturercode');?>"  value="<?php echo $du["lecturercode"];?>" required>
														</div>
													</div>
													<div class="form-group row">
														<label for="email" class="col-sm-2 col-form-label"><?php echo lang('email');?></label>
														<div class="col-sm-10">
															<input type="email" class="form-control" name="email" id="email" placeholder="<?php echo lang('email');?>" value="<?php echo $du["email"];?>" required>
														</div>
													</div>
													<div class="form-group row">
															<label for="idroles" class="col-sm-2 col-form-label"><?php echo lang('roles');?></label>
															<div class="col-sm-10">
																<select class="form-control" id="idroles" name="idroles">
																<?php 
																foreach($dataroles as $dr)
																{ 
																	if($dr["idroles"]==$du["roles"])
																	{
																?>
																		<option value="<?php echo $dr["idroles"]; ?>" selected ><?php echo $dr["roles"];?></option>
																<?php
																	}
																	else
																	{
																?>
																		<option value="<?php echo $dr["idroles"]; ?>" ><?php echo $dr["roles"];?></option>
																<?php
																	}
																}
																?>  
																</select>
															</div>
													</div>	
													<div class="form-group row">
													<label for="inputStatus" class="col-sm-2 col-form-label"><?php echo lang('active');?></label>
													<div class="col-sm-10">
														<div class="form-check">
														  <input class="form-check-input" type="radio" id="active" name="active" value="1" <?php if($du["active"]=="1"){?>checked="true"<?php }else {?><?php }?>>
														  <label class="form-check-label"><?php echo lang('active');?></label>
														  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														  <input class="form-check-input" type="radio" id="active" name="active" value="0" <?php if($du["active"]=="0"){?>checked="true"<?php }else {?><?php }?>>
														  <label class="form-check-label"><?php echo lang('not');?></label>
														</div>
													</div>
												    </div>													
													<div class="form-group row">
                                                    <div class="col-sm-10">
														<input type="hidden" class="form-control" id="idusersweb" name="idusersweb" value="<?php echo $du["idusers"];?>">
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
        
