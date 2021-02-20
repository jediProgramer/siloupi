<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('userssettings_hallo');?></p></div>

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
						<a class="btn btn-primary btn-sm float-right" href="<?php echo base_url()?>users/addusers"><i class="fas fa-plus">&nbsp;</i><?php echo lang('add');?></a>
                    </div>
                    <div class="card-body">
						<div class="table-responsive">
							<table id="data" class="display table dataTable table-striped table-bordered" >
								<thead>
									<tr>
										<th><?php echo lang('no');?></th>
										<th><?php echo lang('nip');?></th>
										<th><?php echo lang('fullname');?></th>
										<th><?php echo lang('roles');?></th>
										<th><?php echo lang('active');?></th>
										<th style="text-align:center"><?php echo lang('action');?></th>
									</tr>
								</thead>
								<tbody>
								<?php
									$i = 0;										
									foreach($listusers as $d)
									{ 
									$i++;
									
									$querykategori = $this->db->query("SELECT roles FROM ".$this->db->dbprefix('roles')." WHERE idroles =".$d["roles"]."");
									$row = $querykategori->row();
									$roles=$row->roles;
									
									
									?>	
									<tr>
									  <td><?php echo $i;?></td>
									  <td><?php echo $d["nip"];?></td>
									  <td><?php echo substr($d["fullname"],0,50);?></td>
									  <td><?php echo $roles;?></td>
									  <td><?php if($d["active"]=="1"){ echo lang('active'); }else{ echo lang('no'); }?></td>
									  <td style="text-align:center">
									  <a class="btn btn-primary btn-sm" href="<?php echo base_url()?>users/editusers/<?php echo $d["idusers"];?>"><i class="fa fa-pencil-alt">&nbsp;</i><?php echo lang('edit');?></a>&nbsp;|&nbsp;<a class="btn btn-info btn-sm" href="<?php echo base_url()?>users/institutionusers/<?php echo $d["idusers"];?>"><i class="fa fa-pencil-alt">&nbsp;</i><?php echo lang('institution');?></a></td>
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
        
