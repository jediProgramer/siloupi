<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('menusettings_edit_hallo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>menusettings/mainmenu"><?php echo lang('menusettings');?></a></li>
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
												foreach($datanavcategory as $dnc)
												{
										   ?>
                                            <form id="editMenu">
													<div class="form-group row">
														<label for="menu" class="col-sm-2 col-form-label"><?php echo lang('menu_name');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="menu" id="menu" placeholder="<?php echo lang('menu_name');?>" value="<?php echo $dnc["menu"];?>" required>
														</div>
													</div>
													<div class="form-group row">
														<label for="icon" class="col-sm-2 col-form-label"><?php echo lang('icon');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="icon" id="icon" placeholder="<?php echo lang('icon');?>" value="<?php echo $dnc["icon"];?>" required>
														</div>
													</div>	
													<div class="form-group row">
														<label for="short" class="col-sm-2 col-form-label"><?php echo lang('short');?></label>
														<div class="col-sm-10">
															<input type="number" class="form-control" name="short" id="short" placeholder="<?php echo lang('short');?>" value="<?php echo $dnc["short"];?>" required>
														</div>
													</div>												
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
														<input type="hidden" class="form-control" id="idnavcategory" name="idnavcategory" value="<?php echo $dnc["idnavcategory"];?>">
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
        
