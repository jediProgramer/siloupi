<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('rolessettings_add_hallo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>roles"><?php echo lang('rolessettings');?></a></li>
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
                                            <form id="addRoles">
													<div class="form-group row">
														<label for="idposition" class="col-sm-2 col-form-label"><?php echo lang('position');?></label>
														<div class="col-sm-10">
															<select class="form-control" id="idposition" name="idposition">
															<?php
																foreach($dataposition as $dp)
																{
															?>
															  <option value="<?php echo $dp["idposition"];?>"><?php echo $dp["position"];?></option>
															<?php
																}
															?>  
															</select>
														</div>
													</div>
													<div class="form-group row">
														<label for="menu" class="col-sm-2 col-form-label"><?php echo lang('roles');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="roles" id="roles" placeholder="<?php echo lang('roles');?>" required>
														</div>
													</div>											
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
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
        
