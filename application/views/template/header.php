<!DOCTYPE html>
<html lang="en">
    <!-- START: Head-->
    <head>
		<?php $this->load->view($meta); ?>
        <?php $this->load->view($css); ?>
    </head>
    <!-- END Head-->

    <!-- START: Body-->
    <body id="main-container" class="default semi-dark horizontal-menu">
		
		<?php 
			if($this->session->flashdata('msg_success')){
				
			}
			else
			{
		?>
		<!-- START: Pre Loader-->
        <div class="se-pre-con">
            <div id="loader" class="loader"></div>
        </div>
        <!-- END: Pre Loader-->
		<?php 
			}
		?>