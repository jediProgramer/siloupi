<!-- START: Main Content-->
<main>
	<div class="container-fluid site-width">
		<!-- START: Breadcrumbs-->
		<div class="row">
			<div class="col-12  align-self-center">
				<div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
					<div class="w-sm-100 mr-auto"><h4 class="mb-0"><?php echo lang('404_header_bc');?></h4> <p><?php echo lang('msg_404_header');?></p></div>

					<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>dashboard"><?php echo lang('dashboard');?></a></li>
						<li class="breadcrumb-item active"><?php echo lang('404_header_bc');?></li>
					</ol>
				</div>
			</div>
		</div>
		<!-- END: Breadcrumbs-->

		<!-- START: Card Data-->
		<div class="row">

			<div class="col-12  mt-3">
				<div  class="lockscreen  mt-5 mb-5">
					<div class="jumbotron mb-0 text-center theme-background rounded">
						<h1 class="display-3 font-weight-bold"> <?php echo lang('404_header');?></h1>
						<h5><i class="ion ion-alert pr-2"></i><?php echo lang('404_alert');?></h5>
						<p><?php echo lang('404_msg');?></p>
						<a href="<?php echo base_url();?>dashboard" class="btn btn-primary"><?php echo lang('404_gd');?></a>
					</div>
				</div>
			</div>
			
		</div>
		<!-- END: Card DATA-->
	</div>
</main>
<!-- END: Content-->
        
