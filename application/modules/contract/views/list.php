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
							<a <?php if($roles!="1"){?>class="btn disabled"<?php }else{ ?>class="btn btn-secondary btn-sm"<?php } ?> href="<?php echo base_url($namespace.'/addcsv')?>"><i class="fas fa-file">&nbsp;</i><?php echo lang('add_csv');?></a>
						</div>	
					</div>
                    <div class="card-body">
						<div class="table-responsive">
							<table id="data" class="display table dataTable table-striped table-bordered" >
								<thead >
									<tr>
										<th><?php echo lang('idcourses');?></th>
										<th><?php echo lang('nim');?></th>
										<th><?php echo lang('grade');?></th>
										<th><?php echo lang('idprograme');?></th>
										<th><?php echo lang('quality');?></th>
									</tr>
								</thead>
								<tbody>
									<tr>
									  <td><?php echo lang('idcourses');?></td>
									  <td><?php echo lang('nim');?></td>
									  <td><?php echo lang('grade');?></td>
									  <td><?php echo lang('idprograme');?></td>
									  <td><?php echo lang('quality');?></td>
									</tr>	
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
        
