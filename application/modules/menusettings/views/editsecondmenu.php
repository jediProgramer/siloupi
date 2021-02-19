<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('menusettings_second_edit_hallo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>menusettings/secondmenu"><?php echo lang('menusettings_second');?></a></li>
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
											foreach($datanavigation as $dn)
											{
									   ?>
                                            <form id="editMenuSecond">
											<div class="card-body">
													<div class="form-group row">
													  <label for="idnavcategory" class="col-sm-2 col-form-label"><?php echo lang('menu_name');?></label>
														<div class="col-sm-10">
														<select class="form-control" id="idnavcategory" name="idnavcategory">
														<?php
															foreach($datanavcategory as $dnc)
															{
																if($dnc["idnavcategory"]==$dn["idnavcategory"])
																{	
														?>
																<option value="<?php echo $dnc["idnavcategory"];?>" selected><?php echo $dnc["menu"];?></option>
														<?php
																}
																else
																{
														?>			
																<option value="<?php echo $dnc["idnavcategory"];?>"><?php echo $dnc["menu"];?></option>
														<?php		
																}
															}
														?>  
														</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="navigation" class="col-sm-2 col-form-label"><?php echo lang('menusecond_name');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="navigation" id="navigation" placeholder="<?php echo lang('menusecond_name');?>" value="<?php echo $dn["navigation"];?>" required>
														</div>
													</div>
													<div class="form-group row">
														<label for="icon" class="col-sm-2 col-form-label"><?php echo lang('icon');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="icon" id="icon" placeholder="<?php echo lang('icon');?>" value="<?php echo $dn["icon"];?>" required>
														</div>
													</div>	
													<div class="form-group row">
														<label for="link" class="col-sm-2 col-form-label"><?php echo lang('link');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="link" id="link" placeholder="<?php echo lang('link');?>" value="<?php echo $dn["link"];?>">
														</div>
													</div>	
													<div class="form-group row">
														<label for="short" class="col-sm-2 col-form-label"><?php echo lang('short');?></label>
														<div class="col-sm-10">
															<input type="number" class="form-control" name="short" id="short" placeholder="<?php echo lang('short');?>" value="<?php echo $dn["short"];?>" required>
														</div>
													</div>												
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
														<input type="hidden" class="form-control" id="idnavigation" name="idnavigation" value="<?php echo $dn["idnavigation"];?>">
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
        
