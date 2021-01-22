<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('plo_hallo');?></p></div>

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
						<a class="btn btn-primary btn-sm float-right" href="<?php echo base_url()?>entrydata/addplo"><i class="fas fa-plus">&nbsp;</i><?php echo lang('add');?></a>
                    </div>
                    <div class="card-body">
						<div class="table-responsive">
							<table id="data" class="display table dataTable table-striped table-bordered" >
								<thead >
									<tr>
										<th><?php echo lang('lo_code');?></th>
										<th><?php echo lang('plo');?></th>
										<th style="text-align:center"><?php echo lang('action');?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									$i = 0;										
									foreach($dataplo as $d)
									{ 
									$i++;
									?>	
									<tr>
									  <td><?php echo $i;?></td>
									  <td><?php echo $d["plo"];?></td>
									  <td style="text-align:center">
									  <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>entrydata/editplo/<?php echo $d["idplo"];?>"><i class="fa fa-pencil-alt">&nbsp;</i><?php echo lang('edit');?></a> &nbsp; 
									  | &nbsp; <a class="btn btn-info btn-sm" href="<?php echo base_url()?>entrydata/detailplo/<?php echo $d["idplo"];?>"><i class="fa fa-eye">&nbsp;</i><?php echo lang('detail_plo');?></a>&nbsp; 
									  <?php 
										  if($d["active"]==0)
										  {
									  ?>
									  | &nbsp;<a class="btn btn-danger btn-sm activePLO" href="#" data-toggle="modal" data-id="<?php echo $d["idplo"];?>"><i class="fa fa-check">&nbsp;</i><?php echo lang('activate_plo');?></a></td>
									  <?php 
										  }
										  else
										  {
									  ?>
									  | &nbsp;<a class="btn btn-info btn-sm activePLO" href="#" data-toggle="modal" data-id="<?php echo $d["idplo"];?>"><i class="fa fa-check">&nbsp;</i><?php echo lang('deactive_plo');?></a></td>
									  <?php 
										  }
									  ?>   	
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
        
