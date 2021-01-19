<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo $menuname;?></h4> <p><?php echo lang('lostudentprograme_hallo');?></p></div>

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
                    <div class="card-body">
					<form class="form-horizontal" action="<?php echo base_url()?>reports/lostudentsprogrameresult" method="post" id="filterloForm" name="filterloForm">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="years"><?php echo lang('class_generation');?></label>
								<?php echo $years;?>
							</div>
							<div class="form-group col-md-6">
								<label for="studentnim"><?php echo lang('student_name');?></label>
								<select class="form-control select2" id="studentnim" name="studentnim">
								</select>
							</div>
						</div>
						<div class="form-group row">
								<div class="col-sm-10">
									<button type="submit" class="btn btn-primary"><i class="fa 
fa-search">&nbsp;</i>&nbsp;<?php echo lang('search');?></button>
								</div>
						</div>
						</form>
                    </div>
				</div>	
            </div>
		</div>
		<!-- END: Card DATA-->
	</div>
</main>
<!-- END: Content-->
        
