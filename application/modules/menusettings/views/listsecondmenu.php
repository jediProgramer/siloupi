<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('menusettings_second_hallo');?></p></div>

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
						<a class="btn btn-primary btn-sm float-right" href="<?php echo base_url()?>menusettings/addsecondmenu"><i class="fas fa-plus">&nbsp;</i><?php echo lang('add');?></a>
                    </div>
                    <div class="card-body">
						<div class="table-responsive">
							<table id="data" class="display table dataTable table-striped table-bordered" >
								<thead>
									<tr>
										<th><?php echo lang('no');?></th>
										<th><?php echo lang('menu_name');?></th>
										<th><?php echo lang('menusecond_name');?></th>
										<th style="text-align:center"><?php echo lang('action');?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									$i = 0;										
									foreach($datanavigation as $d)
									{ 
									$i++;
									
									$querykategori = $this->db->query("SELECT menu FROM ".$this->db->dbprefix('navcategory')." WHERE idnavcategory =".$d["idnavcategory"]."");
									$row = $querykategori->row();
									$kategori=$row->menu;
									
									?>	
									<tr>
									  <td><?php echo $i;?></td>
									  <td><?php echo $kategori;?></td>
									  <td><?php echo $d["navigation"];?></td>
									  <td style="text-align:center">
									  <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>menusettings/editsecondmenu/<?php echo $d["idnavigation"];?>"><i class="fa fa-pencil-alt">&nbsp;</i><?php echo lang('edit');?></a>&nbsp; | &nbsp;<a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#modal-delete-<?php echo $i;?>"><i class="fa fa-trash">&nbsp;</i><?php echo lang('delete');?></a></td>
									</tr>
									
									<!-- Modal -->
									<div class="modal fade" id="modal-delete-<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="modalDelete" aria-hidden="true">
										<form id="deleteMenu<?php echo $i;?>">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="modalDelete"><?php echo lang('delete_menu');?></h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<?php echo lang('delete_info');?> <?php echo $d["navigation"];?> <?php echo lang('riddle');?>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('close');?></button>
													<button type="button" class="btn btn-primary deleteMenuSecond" data-id="<?php echo $d["idnavigation"];?>"><?php echo lang('delete');?></button>
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
        
