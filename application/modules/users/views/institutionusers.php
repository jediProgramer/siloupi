<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('userssettings_institution_hallo');?></p></div>

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
                                            <form id="institutionUsers">
													<div class="form-group row">
														<label for="nip" class="col-sm-2 col-form-label"><?php echo lang('nip');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="nip" id="nip" placeholder="<?php echo lang('nip');?>"  value="<?php echo $du["nip"];?>" disabled required>
														</div>
													</div>
													<div class="form-group row">
														<label for="fullname" class="col-sm-2 col-form-label"><?php echo lang('fullname');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="fullname" id="fullname" placeholder="<?php echo lang('fullname');?>"  value="<?php echo $du["fullname"];?>" disabled required>
														</div>
													</div>
													<div class="form-group row">
														<label for="email" class="col-sm-2 col-form-label"><?php echo lang('email');?></label>
														<div class="col-sm-10">
															<input type="text" class="form-control" name="email" id="email" placeholder="<?php echo lang('email');?>" value="<?php echo $du["email"];?>" disabled required>
														</div>
													</div>
													<?php
													if($du["jobs"]=="Manajemen Fakultas")
													{
													?>
													<div class="form-group row">
															<label for="idinstitution" class="col-sm-2 col-form-label"><?php echo lang('faculty');?></label>
															<div class="col-sm-10">
																<select class="form-control select2" id="idinstitution" name="idinstitution">
																<?php 
																foreach($datafaculty as $df)
																{ 
																	if($df["idfaculty"]==$du["idinstitution"])
																	{
																?>
																		<option value="<?php echo $df["idfaculty"]; ?>" selected ><?php echo $df["idfaculty"];?> - <?php echo $df["faculty"];?></option>
																<?php
																	}
																	else
																	{
																?>
																		<option value="<?php echo $df["idfaculty"]; ?>" ><?php echo $df["idfaculty"];?> - <?php echo $df["faculty"];?></option>
																<?php
																	}
																}
																?>  
																</select>
															</div>
													</div>
													<?php
													}
													else if($du["jobs"]=="Manajemen Prodi")
													{
													?>
													<div class="form-group row">
															<label for="idinstitution" class="col-sm-2 col-form-label"><?php echo lang('departement');?></label>
															<div class="col-sm-10">
																<select class="form-control select2" id="idinstitution" name="idinstitution">
																<?php 
																foreach($datadepartement as $dd)
																{ 
																	if($dd["iddepartement"]==$du["idinstitution"])
																	{
																?>
																		<option value="<?php echo $dd["iddepartement"]; ?>" selected ><?php echo $dd["iddepartement"];?> - <?php echo $dd["departement"];?></option>
																<?php
																	}
																	else
																	{
																?>
																		<option value="<?php echo $dd["iddepartement"]; ?>" ><?php echo $dd["iddepartement"];?> - <?php echo $dd["departement"];?></option>
																<?php
																	}
																}
																?>  
																</select>
															</div>
													</div>
													<?php
													}													
													else if($du["jobs"]=="Tenaga Pengajar")
													{
													?>
													<div class="form-group row">
															<label for="idinstitution" class="col-sm-2 col-form-label"><?php echo lang('programe');?></label>
															<div class="col-sm-10">
																<select class="form-control select2" id="idinstitution" name="idinstitution">
																<?php 
																foreach($dataprograme as $dp)
																{ 
																	if($dp["idprogramme"]==$du["idinstitution"])
																	{
																?>
																		<option value="<?php echo $dp["idprograme"]; ?>" selected ><?php echo $dp["idprograme"];?> - <?php echo $dp["programe"];?></option>
																<?php
																	}
																	else
																	{
																?>
																		<option value="<?php echo $dp["idprograme"]; ?>" ><?php echo $dp["idprograme"];?> - <?php echo $dp["programe"];?></option>
																<?php
																	}
																}
																?>  
																</select>
															</div>
													</div>
													<?php
													}	
													?>													
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
        
