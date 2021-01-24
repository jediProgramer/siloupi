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

									$i++;
									?>	
									<tr>
									  <td><?php echo $d["idcurriculum"];?></td>
									  <td><?php echo $level;?></td>
									  <td><?php echo $d["curriculum"];?></td>
									  <td style="text-align:center">
									  <a <?php if($totalplo==0){ ?>class="btn disabled"<?php }else{ ?>class="btn btn-primary btn-sm"<?php } ?> href="<?php echo base_url()?>entrydata/addmappingplo/<?php echo $d["idcurriculum"];?>"><i class="fas fa-map">&nbsp;</i><?php echo lang('mapping');?></a> &nbsp; 
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
        