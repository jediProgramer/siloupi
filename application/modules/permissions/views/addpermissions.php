<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('permissionssettings_add_hallo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>permissions"><?php echo lang('permissionssettings');?></a></li>
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
												$queryz = $this->db->query("SELECT * FROM ".$this->db->dbprefix('permissions')." WHERE idroles='".$idroles."'");
												if ($queryz->num_rows() >= 1)
												{
											?>
											<form class="form-horizontal" action="<?php echo base_url()?>permissions/savepermissions" method="post" enctype="multipart/form-data" id="webrolesForm">
												<?php
												$queryx = $this->db->query("SELECT * FROM ".$this->db->dbprefix('roles')." WHERE idroles='$idroles'");
												if ($queryx->num_rows() >= 1)
												{
												?>
												<table class="table table-bordered">
												  <thead>                  
													<tr>
													  <th><?php echo lang('menu');?></th>
													  <?php 
														foreach($datarolesglobal as $drg)
														{ 
													   ?>	
													  <th><?php echo lang('permissionssettings');?> - <?php echo $drg["roles"];?></th>
													 <?php
														}
													 ?> 
													</tr>
												  </thead>
												  <tbody>
												  <?php
													$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('navigation')." ORDER BY idnavigation");
													$datanav=$query->result();
													foreach ($datanav as $dn)
													{
														$queryz = $this->db->query("SELECT * FROM ".$this->db->dbprefix('subnavigation')." WHERE idnavigation='$dn->idnavigation' ORDER BY idsubnavigation");
														if ($queryz->num_rows() >= 1)
														{
												   ?>
													<tr>
														<td><?php echo $dn->navigation;?></td>
														<?php 
															foreach($datarolesglobal as $drg)
															{ 
														?>	
														<td>
															<input type="hidden" id="permissionsparent<?php echo $dn->idnavigation;?>" name="permissionsparent<?php echo $dn->idnavigation;?>" value="1">
															<input type="hidden" id="idnavigationsparent<?php echo $dn->idnavigation;?>" name="idnavigationsparent<?php echo $dn->idnavigation;?>" value="<?php echo $dn->idnavigation;?>">
															<input type="hidden" id="idnavcategorysparent<?php echo $dn->idnavigation;?>" name="idnavcategorysparent<?php echo $dn->idnavigation;?>" value="<?php echo $dn->idnavcategory;?>">
														</td>
														<?php
															}
														?>	
													</tr>
													<?php 		
															$datasubnav=$queryz->result();
															foreach ($datasubnav as $dsn)
															{
													?>		
													<tr>
													<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dsn->subnavigation;?></td>
													<?php 
																foreach($datarolesglobal as $drg)
																{ 
																	$queryuac = $this->db->query("SELECT users_access FROM ".$this->db->dbprefix('permissions')." WHERE idroles=".$drg["idroles"]." AND idnavigation = $dn->idnavigation AND idsubnavigation= $dsn->idsubnavigation");
																	$row = $queryuac->row();
																	if(!empty($row->users_access))
																	{
																		$users_access=$row->users_access;	
																	}	
																	else
																	{
																		$users_access="";	
																	}
													?>		
																<td>
																<input type="hidden" id="permissionschild<?php echo $dsn->idsubnavigation;?>" name="permissionschild<?php echo $dsn->idsubnavigation;?>" value="0">
																<input type="checkbox" id="permissionschild<?php echo $dsn->idsubnavigation;?>" name="permissionschild<?php echo $dsn->idsubnavigation;?>" value="1" <?php if($users_access==1){ echo "checked";}?>>
																<input type="hidden" id="idsunavigationchild<?php echo $dsn->idsubnavigation;?>" name="idsunavigationchild<?php echo $dsn->idsubnavigation;?>" value="<?php echo $dsn->idsubnavigation;?>">
																</td>
													<?php
																}
													?>	
													</tr>
													<?php
															}
														}
														else
														{
													?>
													<tr>
														<td><?php echo $dn->navigation;?></td>
														<?php 
																foreach($datarolesglobal as $drg)
																{
																	$queryua = $this->db->query("SELECT users_access FROM ".$this->db->dbprefix('permissions')." WHERE idroles=".$drg["idroles"]." AND idnavigation=$dn->idnavigation");
																	$row = $queryua->row();
																	$users_access=$row->users_access;		
														?>		
																<td>
																<input type="hidden" id="permissionsparent<?php echo $dn->idnavigation;?>" name="permissionsparent<?php echo $dn->idnavigation;?>" value="0">
																<input type="checkbox" id="permissionsparent<?php echo $dn->idnavigation;?>" name="permissionsparent<?php echo $dn->idnavigation;?>" value="1" <?php if($users_access==1){ echo "checked";}?>>
																<input type="hidden" id="idnavigationsparent<?php echo $dn->idnavigation;?>" name="idnavigationsparent<?php echo $dn->idnavigation;?>" value="<?php echo $dn->idnavigation;?>">
																<input type="hidden" id="idnavcategorysparent<?php echo $dn->idnavigation;?>" name="idnavcategorysparent<?php echo $dn->idnavigation;?>" value="<?php echo $dn->idnavcategory;?>">
																</td>
															<?php
																}
															?>	
														</tr>
													<?php   }	
													}
													?>
												  </tbody>
												</table>
												<!-- /.card-body -->
													<div class="form-group row">
														<div class="col-sm-10">
															<input type="hidden" id="idroles" name="idroles" value="<?php echo $idroles;?>">
															<button type="submit" class="btn btn-primary"><?php echo lang('submit');?></button>
														</div>
													</div>
												</div>
												<!-- /.card-footer -->
											</form> 
											<?php		
												}
												else
												{
											?>
													<br/>
													<br/>
													<br/>
													<br/>
													<br/>
													<br/>
													&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center><?php echo lang('no_data_found');?></center>
													<br/>
													<br/>
													<br/>
													<br/>
													<br/>
													<br/>
											<?php 
												}	
											?>
											<?php
											}
											else
											{	
											?>	
												<form class="form-horizontal" action="<?php echo base_url()?>permissions/savepermissions" method="post" enctype="multipart/form-data" id="webrolesForm">
													<?php
													$queryx = $this->db->query("SELECT * FROM ".$this->db->dbprefix('roles')." WHERE idroles='$idroles'");
													if ($queryx->num_rows() >= 1)
													{
													?>
													<table class="table table-bordered">
													<thead>
														<tr>
															<th><?php echo lang('menu');?></th>
													<?php 
														foreach($datarolesglobal as $drg)
														{ 
													?>		
															<th><?php echo lang('permissionssettings');?> - <?php echo $drg["roles"];?></th>
													<?php
														}
													?>		
														</tr>
													</thead>
													<tbody>
													<?php
														$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('navigation')." ORDER BY idnavigation");
														$datanav=$query->result();
														foreach ($datanav as $dn)
														{
															$queryz = $this->db->query("SELECT * FROM ".$this->db->dbprefix('subnavigation')." WHERE idnavigation='$dn->idnavigation' ORDER BY idsubnavigation");
															if ($queryz->num_rows() >= 1)
															{
													?>
																<tr>
																<td><?php echo $dn->navigation;?></td>
													<?php 
																foreach($datarolesglobal as $drg)
																{ 
													?>		
																<td>
																<input type="hidden" id="permissionsparent<?php echo $dn->idnavigation;?>" name="permissionsparent<?php echo $dn->idnavigation;?>" value="1">
																<input type="hidden" id="idnavigationsparent<?php echo $dn->idnavigation;?>" name="idnavigationsparent<?php echo $dn->idnavigation;?>" value="<?php echo $dn->idnavigation;?>">
																<input type="hidden" id="idnavcategorysparent<?php echo $dn->idnavigation;?>" name="idnavcategorysparent<?php echo $dn->idnavigation;?>" value="<?php echo $dn->idnavcategory;?>">
																</td>
													<?php
																}
													?>	
																</tr>	
													<?php 		$datasubnav=$queryz->result();
																foreach ($datasubnav as $dsn)
																{
													?>			
																<tr>
																	<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $dsn->subnavigation;?></td>
													<?php 
																	foreach($datarolesglobal as $drg)
																	{ 
													?>		
																	<td>
																	<input type="hidden" id="permissionschild<?php echo $dsn->idsubnavigation;?>" name="permissionschild<?php echo $dsn->idsubnavigation;?>" value="0">
																	<input type="checkbox" id="permissionschild<?php echo $dsn->idsubnavigation;?>" name="permissionschild<?php echo $dsn->idsubnavigation;?>" value="1">
																	<input type="hidden" id="idsunavigationchild<?php echo $dsn->idsubnavigation;?>" name="idsunavigationchild<?php echo $dsn->idsubnavigation;?>" value="<?php echo $dsn->idsubnavigation;?>">
																	</td>
													<?php
																	}
													?>	
																</tr>
													<?php
																}
															}
															else
															{
													?>
																<tr>
																<td><?php echo $dn->navigation;?></td>
													<?php 
																	foreach($datarolesglobal as $drg)
																	{ 
													?>		
																	<td>
																	<input type="hidden" id="permissionsparent<?php echo $dn->idnavigation;?>" name="permissionsparent<?php echo $dn->idnavigation;?>" value="0">
																	<input type="checkbox" id="permissionsparent<?php echo $dn->idnavigation;?>" name="permissionsparent<?php echo $dn->idnavigation;?>" value="1">
																	<input type="hidden" id="idnavigationsparent<?php echo $dn->idnavigation;?>" name="idnavigationsparent<?php echo $dn->idnavigation;?>" value="<?php echo $dn->idnavigation;?>">
																	<input type="hidden" id="idnavcategorysparent<?php echo $dn->idnavigation;?>" name="idnavcategorysparent<?php echo $dn->idnavigation;?>" value="<?php echo $dn->idnavcategory;?>">
																	</td>
													<?php
																	}
													?>	
																</tr>
													<?php   }	
														}
													?>
													  </tbody>
													</table>
													
													<!-- /.card-body -->
													<div class="form-group row">
														<div class="col-sm-10">
															<input type="hidden" id="idroles" name="idroles" value="<?php echo $idroles;?>">
															<button type="submit" class="btn btn-primary"><?php echo lang('submit');?></button>
														</div>
													</div>
												</div>	
												<!-- /.card-footer -->
												</form>
													<?php		
													}
													else
													{
													?>
														<br/>
														<br/>
														<br/>
														<br/>
														<br/>
														<br/>
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<center><?php echo lang('no_data_found');?></center>
														<br/>
														<br/>
														<br/>
														<br/>
														<br/>
														<br/>
													<?php 
													}	
													?>
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
        
