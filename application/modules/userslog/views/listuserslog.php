<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('userslog_hallo');?></p></div>

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
								<thead>
								<tr>
								  <th><?php echo lang('no');?></th>
								  <th><?php echo lang('nip');?></th>
								  <th><?php echo lang('browser');?> </th>
								  <th><?php echo lang('login_time');?> </th>
								  <th><?php echo lang('last_login_time');?> </th>
								  <th><?php echo lang('logout_time');?> </th>
								</tr>
								</thead>
								<tbody>
								<?php
									$i = 0;										
									foreach($datauserslog as $dul)
									{ 
									$i++;
								?>	
								<tr>
									<td class="a-center">
									<?php echo $i;?>
									</td>
									<td class="a-center"><?php echo $dul["nip"];?></td>
									<td class="a-center"><?php echo $dul["browser"];?></td>
									<td class="a-center"><?php echo $dul["login_time"];?></i></td>
									<td class="a-center"><?php echo $dul["last_act_time"];?></td>
									<td class="a-center"><?php echo $dul["logout_time"];?></td>
								</tr>
								<?php
									}
								?>
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
        
