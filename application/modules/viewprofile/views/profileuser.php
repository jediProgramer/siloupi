<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('user_profile_hallo');?></p></div>

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
					<a class="btn btn-primary btn-sm float-right" href="<?php echo base_url()?>editprofile"><i class="fa fa-pencil-alt">&nbsp;</i><?php echo lang('edit_profile');?></a>
                    </div>
                    <div class="card-body">
						<div class="table-responsive">
							<?php
								foreach($datauser as $du)
								{
						    ?>	
							<table class="table">
								<tr>
									<th width="10%" ><img src="<?php if($profilepicture!=""){ echo base_url();?>assets/files/users/<?php echo $profilepicture; }else{ echo base_url();?>assets/files/users/default_user.png<?php } ?>" width="150px" height="200px"></th>
									<td valign="center"><br/><br/><br/><h1><b><?php echo $du["fullname"]; ?></b></h1></td>
								</tr>
							</table>
							<?php
								}
							?>
							
							<table class="table">
							<?php
								foreach($datauser as $d)
								{
						    ?>		
								  <tr>
									<th style="width:30%"><?php echo lang('nip');?></th>
									<td><?php echo $d["nip"]; ?></td>
								  </tr>
								  <tr>
									<th><?php echo lang('lecturercode');?></th>
									<td><?php echo $d["lecturercode"]; ?></td>
								  </tr>
								  <tr>
									<th><?php echo lang('fullname');?></th>
									<td><?php echo $d["fullname"]; ?></td>
								  </tr>
								  <tr>
									<th><?php echo lang('phoneno');?></th>
									<td><?php echo $d["phoneno"]; ?></td>
								  </tr>
								  <tr>
									<th><?php echo lang('email');?></th>
									<td><?php echo $d["email"]; ?></td>
								  </tr>
								  <tr>
									<th><?php echo lang('institution');?></th>
									<td><?php echo $d["institution"]; ?></td>
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
        
