<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('add_mapping_plo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>entrydata/mappingplo"><?php echo lang('plo_add_mapping_hallo');?></a></li>
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
											<form class="form-horizontal" method="post" enctype="multipart/form-data" >
											<div class="table-wrapper-scroll-y my-custom-scrollbar text-nowrap">
											<table class="table table-bordered">
												<?php
												//Query Courses Category
												$i=0;
												$querycc = $this->db->query("SELECT * FROM ".$this->db->dbprefix('coursescategory')." WHERE idcurriculum='".$idcurriculum."' ORDER BY idcurriculum");
												$datacc=$querycc->result();
												foreach ($datacc as $dcc)
												{
													$i++;
												?>
												<thead> 
													<tr>
														<td colspan="4"><b><?php echo $i." - ".$dcc->coursescategory;?></b></td>
														<td colspan="<?php echo $totallo;?>" align="center"><b><?php echo lang('learning_outcomes');?></b></td>
													</tr>                 
													<tr>
														<td><b><?php echo strtoupper(lang('no'));?></b></td>
														<td><b><?php echo strtoupper(lang('courses_code'));?></b></td>
														<td><b><?php echo strtoupper(lang('courses'));?></b></td>
														<td><b><?php echo strtoupper(lang('credit'));?></b></td>
												<?php
													//Query LO
													foreach($datalo as $dlo)
													{
												?>
													<td align="center"><b><?php echo $dlo["idlo"];?></b></td>
												<?php
													}
													//End Query LO
													?>
													</tr>
													<?php 
														//Query Courses
														$y=0;
														$querycourses = $this->db->query("SELECT * FROM ".$this->db->dbprefix('courses')." WHERE idcoursescategory='".$dcc->idcoursescategory."' AND idcurriculum='".$idcurriculum."' AND idcoursessubcategory IS NULL ORDER BY idcourses");
														$datacourses=$querycourses->result();
														foreach ($datacourses as $dcourses)
														{
															$y++;
													?>	
														<tr>
															<td><?php echo $y;?></td>
															<td><?php echo $dcourses->idcourses;?></td>
															<td><?php echo $dcourses->courses;?></td>
															<td><?php echo $dcourses->credit;?></td>
															<?php
																//Query LO
																foreach($datalo as $dlo)
																{
															?>
																<td align="center">
																<?php	
																$querymp = $this->db->query("SELECT * FROM ".$this->db->dbprefix('mappingplo')." WHERE idcourses='".$dcourses->idcourses."' AND idcurriculum='".$idcurriculum."' AND idlo='".$dlo["idlo"]."'");
																?>
																<input type="checkbox" class="lo" id="lo[]" name="lo[]" value="<?php echo $dcourses->idcourses;?>_<?php echo $dlo["idlo"];?>" <?php if ($querymp->num_rows() >= 1){ echo "checked";}?>>
																</td>
															<?php
																}
																//End Query LO
																//Total SKS Per Category
																$quertotalsks = $this->db->query("SELECT SUM(credit) AS totalcredits FROM ".$this->db->dbprefix('courses')." WHERE idcoursescategory='".$dcc->idcoursescategory."' AND idcurriculum='".$idcurriculum."' AND idcoursessubcategory IS NULL");
																$rowtotalsks = $quertotalsks->row();
																$totalsks = $rowtotalsks->totalcredits;
															?>
														</tr>
													<?php 
														}
														//End Query Courses
													?>
													<tr>
														<td colspan="3" align="center"><b><?php echo strtoupper(lang('credit_total'));?></b></td>
														<td><?php echo $totalsks;?></td>
														<?php
															for($lo=1;$lo<=$totallo;$lo++)
															{
														?>
														<td></td>
														<?php
															}
														?>
													</tr> 
												<?php
													//Cek Sub Category
													$querycsc = $this->db->query("SELECT * FROM ".$this->db->dbprefix('coursessubcategory')." WHERE idcoursescategory='$dcc->idcoursescategory' AND idcurriculum='".$idcurriculum."' ORDER BY idcoursessubcategory");
													if ($querycsc->num_rows() >= 1)
													{
														//Query Sub Category
														$datacsc=$querycsc->result();
														foreach ($datacsc as $dcsc)
														{
												?>
													<tr>
														<td colspan="4"><b><?php echo $dcsc->coursessubcategory;?></b></td>
														<td colspan="<?php echo $totallo;?>" align="center"><b><?php echo lang('learning_outcomes');?></b></td>
													</tr>                 
													<tr>
														<td><b><?php echo strtoupper(lang('no'));?></b></td>
														<td><b><?php echo strtoupper(lang('courses_code'));?></b></td>
														<td><b><?php echo strtoupper(lang('courses'));?></b></td>
														<td><b><?php echo strtoupper(lang('credit'));?></b></td>
												<?php	
															//Cek LO
															foreach($datalo as $dlo)
															{
															?>
																<td align="center"><b><?php echo $dlo["idlo"];?></b></td>
															<?php	
															}
															//End Query LO	
													?>
													</tr>
													<?php 
															//Query Courses
															$z=0;
															$querycoursessc = $this->db->query("SELECT * FROM ".$this->db->dbprefix('courses')." WHERE idcoursescategory='".$dcc->idcoursescategory."' AND idcurriculum='".$idcurriculum."' AND idcoursessubcategory='".$dcsc->idcoursessubcategory."' ORDER BY idcourses");
															$datacoursessc=$querycoursessc->result();
															foreach ($datacoursessc as $dcoursessc)
															{
															$z++;
													?>	
														<tr>
															<td><?php echo $z;?></td>
															<td><?php echo $dcoursessc->idcourses;?></td>
															<td><?php echo $dcoursessc->courses;?></td>
															<td><?php echo $dcoursessc->credit;?></td>
															<?php
																//Query LO
																foreach($datalo as $dlo)
																{
															?>
																<td align="center">
																<?php	
																$querymp = $this->db->query("SELECT * FROM ".$this->db->dbprefix('mappingplo')." WHERE idcourses='".$dcoursessc->idcourses."' AND idcurriculum='".$idcurriculum."' AND idlo='".$dlo["idlo"]."'");
																?>
																<input type="checkbox" class="lo" id="lo[]" name="lo[]" value="<?php echo $dcoursessc->idcourses;?>_<?php echo $dlo["idlo"];?>" <?php if ($querymp->num_rows() >= 1){ echo "checked";}?>>
																</td>
															<?php
																}
																//End Query LO
																?>
														</tr>
													<?php 
															}
															//End Query Courses
															//Total SKS Per SubCategory
															$quertotalskssc = $this->db->query("SELECT SUM(credit) AS totalcredits FROM ".$this->db->dbprefix('courses')." WHERE idcoursescategory='".$dcc->idcoursescategory."' AND idcurriculum='".$idcurriculum."' AND idcoursessubcategory='".$dcsc->idcoursessubcategory."'");
															$rowtotalskssc = $quertotalskssc->row();
															$totalskssc = $rowtotalskssc->totalcredits;
													?>	
														<tr>
														<td colspan="3" align="center"><b><?php echo strtoupper(lang('credit_total'));?></b></td>
														<td><?php echo $totalskssc;?></td>
														<?php
															for($lo=1;$lo<=$totallo;$lo++)
															{
														?>
														<td></td>
														<?php
															}
														?>
														</tr> 	
													<?php
														}
														//End Query Sub Courses Category
														//Total SKS Per Category
														$quertotalsks = $this->db->query("SELECT SUM(credit) AS totalcredits FROM ".$this->db->dbprefix('courses')." WHERE idcoursescategory='".$dcc->idcoursescategory."' AND idcurriculum='".$idcurriculum."'");
														$rowtotalsks = $quertotalsks->row();
														$totalsks = $rowtotalsks->totalcredits;
													?>		
														<tr>
														<td colspan="3" align="center"><b><?php echo strtoupper(lang('credit_total'));?></b></td>
														<td><?php echo $totalsks;?></td>
														<?php
															for($lo=1;$lo<=$totallo;$lo++)
															{
														?>
														<td></td>
														<?php
															}
														?>
														</tr> 
												<?php
													}
													//End Cek Sub Category
													?>
												</thead>
												<?php
													}
													//End Query Category
												?>
											</table>	
											</div>
											<br/>						
												<div class="form-group row">
													<div class="col-sm-10">
														<input type="hidden" class="form-control" id="idcurriculum" name="idcurriculum" value="<?php echo $idcurriculum; ?>">
														<button type="submit" id="mappingploForm" class="btn btn-primary"><?php echo lang('submit');?></button>
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
        
