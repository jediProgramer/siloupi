<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('edit_profile_hallo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>viewprofile"><?php echo lang('view_profile');?></a></li>
						<li class="breadcrumb-item active"><?php echo $menuname;?></li>
					</ol>
				</div>
			</div>
		</div>
		<!-- END: Breadcrumbs-->
		
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<?php echo lang('edit_profile_info');?>
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
											<?php
												foreach($datauser as $du)
												{
											?>
                                            <form id="webprofileaccountForm" >
                                                <div class="form-group row">
                                                    <label for="fullname" class="col-sm-2 col-form-label"><?php echo lang('nip');?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="<?php echo lang('nip');?>" value="<?php echo $du["nip"];?>" disabled>
                                                    </div>
                                                </div>
												<div class="form-group row">
														<label for="lecturercode" class="col-sm-2 col-form-label"><?php echo lang('lecturercode');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="lecturercode" id="lecturercode" placeholder="<?php echo lang('lecturercode');?>"  value="<?php echo $du["lecturercode"];?>" disabled>
														</div>
												</div>
												<div class="form-group row">
                                                    <label for="fullname" class="col-sm-2 col-form-label"><?php echo lang('fullname');?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="fullname" id="fullname" placeholder="<?php echo lang('fullname');?>" value="<?php echo $du["fullname"];?>" required>
                                                    </div>
                                                </div>
												<div class="form-group row">
                                                    <label for="phoneno" class="col-sm-2 col-form-label"><?php echo lang('phoneno');?></label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" name="phoneno" id="phoneno" maxlength="12" placeholder="<?php echo lang('phoneno');?>" value="<?php echo $du["phoneno"];?>" required>
                                                    </div>
                                                </div>	
                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-2 col-form-label"><?php echo lang('email');?></label>
                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="<?php echo lang('email');?>" value="<?php echo $du["email"];?>" required>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="oldpassword" class="col-sm-2 col-form-label"><?php echo lang('password');?></label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="oldpassword" id="oldpassword" placeholder="<?php echo lang('password');?>" required>
                                                    </div>
                                                </div>     
												<div class="form-group row">
                                                    <label for="password" class="col-sm-2 col-form-label"><?php echo lang('retype_password');?></label>
                                                    <div class="col-sm-10">
                                                        <input type="password" class="form-control" name="password" id="password" placeholder="<?php echo lang('retype_password');?>" required>
                                                    </div>
                                                </div> 		
												<div class="form-group row">
                                                    <label for="profilepicture" class="col-sm-2 col-form-label"><?php echo lang('fotoprofile');?></label>
                                                    <div class="col-sm-10">
													   <?php if($du["profilepicture"]!="")
															{  
													    ?>
														<img src="<?php echo base_url()?>assets/files/users/<?php echo $du["profilepicture"];?>" class="img-fluid d-flex mr-2 mt-1" width="200" height="200">
														 <?php
															}
															else
															{	
														 ?>
														 <img src="<?php echo base_url()?>assets/files/users/default_user.png" class="img-fluid d-flex mr-2 mt-1" width="200" height="200">
														 <?php
															}	
														 ?>
														<br/>
														<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPicture">
															<?php echo lang('chosefile');?>
														</button>
                                                    </div>
                                                </div>														
                                                <div class="form-group row">
                                                    <div class="col-sm-10">
													<input type="hidden" class="form-control" name="idusers" id="idusers" value="<?php echo $du["idusers"];?>" >
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
														
		<!-- Modal -->
		<div class="modal fade" id="modalPicture" tabindex="-1" role="dialog" aria-labelledby="modalPictureTtitle1" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalPictureTtitle1"><?php echo lang('fotoprofile');?></h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form class="form-horizontal" enctype="multipart/form-data"  id="webprofilepictureForm">
					<div class="modal-body">
						<div class="custom-file overflow-hidden">
							<input id="image" name="image" type="file" class="custom-file-input">
							<label for="profilepicture" class="custom-file-label"><?php echo lang('chosefile_picture');?></label>
							<input type="hidden" class="form-control" name="idusers" id="idusers" value="<?php echo $idusers;?>" >
						</div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('close');?></button>
						<button type="submit" class="btn btn-primary"><?php echo lang('submit');?></button>
					</div>
					</form>
				</div>
			</div>
		</div>
		
	</div>
</main>
<!-- END: Content-->
        
