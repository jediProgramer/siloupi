<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto">
						<h4 class="mb-0"><?php echo $menuname;?></h4> 
					</div>
					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item active"><?php echo lang($namespace.'_hallo');?></li>
					</ol>
				</div>
			</div>
		</div>
		<!-- END: Breadcrumbs-->
		
		<!-- START: Card Data-->
		<div class="row">
			
			<div class="col-12 mt-3">
                <div class="card">
					<div class="card-header "> 
						<div align="right">
							<a class="btn btn-success btn-sm" href="<?php echo base_url($namespace.'/export')?>"><i class="fas fa-print">&nbsp;</i><?php echo lang('export');?></a>
							<a class="btn btn-secondary btn-sm" href="<?php echo base_url($namespace.'/addcsv')?>"><i class="fas fa-file">&nbsp;</i><?php echo lang('add_csv');?></a>
						</div>	
					</div>
                    <div class="card-body">
						<div class="table-responsive">
							<table id="data" class="display table dataTable table-striped table-bordered" >
								<thead >
									<tr>
										<th><?php echo lang($namespace.'_idcoursescategory');?></th>
										<th><?php echo lang($namespace.'_idcurriculum');?></th>
										<th><?php echo lang($namespace.'_coursescategory');?></th>
										<th style="text-align:center"><?php echo lang('action');?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									$i = 0;										
									foreach($data as $d)
									{ 
									$i++;
								?>	
									<tr>
									  <td><?php echo $d["idcoursescategory"];?></td>
									  <td><?php echo $d["idcurriculum"];?></td>
									  <td><?php echo $d["coursescategory"];?></td>
									  <td style="text-align:center">
									  <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-delete-<?php echo $i;?>"><i class="fa fa-trash">&nbsp;</i><?php echo lang('delete');?></a></td>
									</tr>

									<!-- Modal -->
									<div class="modal fade" id="modal-delete-<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
										<form id="deleteRoles<?php echo $i;?>">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modalDelete"><?php echo lang('delete_menu');?></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<?php echo lang('delete_info');?>, <?php echo $d["idcoursescategory"];?> - <?php echo strip_tags($d["coursescategory"]);?> <?php echo lang('riddle');?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('close');?></button>
													<button type="button" class="btn btn-primary delete" data-idc="<?php echo $d["idcurriculum"];?>"  data-id="<?php echo $d["idcoursescategory"];?>"><?php echo lang('delete');?></button>
												</div>
											</div>
										</div>
										</form>
									</div>		

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
        
