<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('plo_mapping_hallo');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard"><?php echo lang('dashboard');?></a></li>
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
					<div class="card-header  justify-content-between align-items-center"> 
					</div>
                    <div class="card-body">
						<div class="table-responsive">
							<table id="data" class="display table dataTable table-striped table-bordered" >
								<thead >
									<tr>
										<th><?php echo lang('curriculum_code');?></th>
										<th><?php echo lang('level');?></th>
										<th><?php echo lang('curriculum');?></th>
										<th style="text-align:center"><?php echo lang('action');?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									$i = 0;										
									foreach($datacurriculum as $d)
									{ 
										$query = $this->db->query("SELECT level FROM ".$this->db->dbprefix('level')." WHERE idlevel='".$d['idlevel']."'");
										$row = $query->row();
										$level = $row->level;	
										
										//Tampilkan Total LO
										$querylo = $this->db->query("SELECT COUNT(*)AS totallo FROM ".$this->db->dbprefix('lo')." a, ".$this->db->dbprefix('plo')." b WHERE a.idplo=b.idplo AND b.idcurriculum='".$d["idcurriculum"]."' AND b.active=1");
										$rowlo = $querylo->row();
										$totallo = $rowlo->totallo;
										//echo "total lo - ".$i." : ".$totallo."\n";
										// End

										//Tampilkan Total Courses
										$querycourses = $this->db->query("SELECT COUNT(*)AS totalcourses FROM ".$this->db->dbprefix('courses')." WHERE idcurriculum='".$d["idcurriculum"]."'");
										$rowcourses = $querycourses->row();
										$totalcourses = $rowcourses->totalcourses;
										//echo "total kursus - ".$i." : ".$totalcourses."\n";
										// End

									$i++;
									?>	
									<tr>
									  <td><?php echo $d["idcurriculum"];?></td>
									  <td><?php echo $level;?></td>
									  <td><?php echo $d["curriculum"];?></td>
									  <td style="text-align:center">
									  <a <?php if(($totallo!=0) && ($totalcourses!=0)){ ?>class="btn btn-primary btn-sm"<?php }else{ ?>class="btn disabled"<?php } ?> href="<?php echo base_url()?>entrydata/addmappingplo/<?php echo $d["idcurriculum"];?>"><i class="fas fa-map">&nbsp;</i><?php echo lang('mapping');?></a> &nbsp; 
									  <!-- export xls  -->
									<a class="btn btn-success btn-sm float-right" style="margin-bottom:10px;" href="<?php echo site_url('entrydata/export_mappingplo/'. $d["idcurriculum"]); ?>"><i class="fas fa-print"></i> Export XLS</a>  
									<!-- title  -->
									</tr>
									
								<?php
									}
								?>
								</tbody>
							</table>
						</div>
                    </div>
				</div>	
            </div>

		</div>
		<!-- END: Card DATA-->
	</div>
</main>
<!-- END: Content-->
        
