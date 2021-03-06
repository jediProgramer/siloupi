<!-- START: Header-->
        <div id="header-fix" class="header fixed-top">
            <div class="site-width">
                <nav class="navbar navbar-expand-lg  p-0">
                    <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
						<a href="<?php echo base_url();?>dashboard" class="horizontal-logo text-left">
						<img src="<?php echo base_url();?>assets/dist/images/logo-upi.svg" width="25" height="25" alt="Logo SILO" style="filter: invert(100%) sepia(0%) saturate(7241%) hue-rotate(333deg) brightness(113%) contrast(105%) opacity(80%)">
                            </svg> <span class="h4 font-weight-bold align-self-center mb-0 ml-auto"><?php echo lang('apps_name');?></span>
                        </a>
                    </div>
                    <div class="navbar-header h4 mb-0 text-center h-100 collapse-menu-bar">
                        <a href="#" class="sidebarCollapse" id="collapse"><i class="icon-menu"></i></a>
                    </div>
                    <div class="navbar-right ml-auto h-100">
                        <ul class="ml-auto p-0 m-0 list-unstyled d-flex top-icon h-100">
                            <li class="dropdown user-profile align-self-center d-inline-block">
                                <a href="#" class="nav-link py-0" data-toggle="dropdown" aria-expanded="false">
                                    <div class="media">
                                        <img src="<?php if($profilepicture!=""){ echo base_url();?>assets/files/users/<?php echo $profilepicture; }else{ echo base_url();?>assets/files/users/default_user.png<?php } ?>" alt="" class="d-flex img-fluid rounded-circle" width="29">
                                    </div>
                                </a>

                                <div class="dropdown-menu border dropdown-menu-right p-0">
                                    <a href="<?php echo base_url();?>viewprofile" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-user mr-2 h6 mb-0"></span><?php echo lang('view_profile');?></a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?php echo base_url();?>assets/files/guide/panduan.pdf" class="dropdown-item px-2 align-self-center d-flex">
                                        <span class="icon-support mr-2 h6  mb-0"></span><?php echo lang('guide');?></a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?php echo base_url();?>auth/logout" class="dropdown-item px-2 text-danger align-self-center d-flex">
                                        <span class="icon-logout mr-2 h6  mb-0"></span><?php echo lang('sign_out');?></a>
                                </div>

                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- END: Header-->
		
		<!-- START: Main Menu-->
        <div class="sidebar">
            <div class="site-width">

                <!-- START: Menu-->
                <ul id="side-menu" class="sidebar-menu">
					<?php 
					$query1 = $this->db->query("SELECT DISTINCT a.idnavcategory, a.menu, a.link, a.icon, a.short FROM ".$this->db->dbprefix('navcategory')." a, ".$this->db->dbprefix('permissions')." b WHERE  a.idnavcategory=b.idnavcategory AND b.users_access=1 AND b.idroles=".$roles." ORDER BY a.short");
					$datanavcat=$query1->result(); 
					foreach ($datanavcat as $dn)
					{
					?>
						<li class=" <?php if($dn->menu==$menuname){ echo "active";}?>"><a href="<?php if($dn->link!=""){echo base_url(); echo $dn->link;}else{echo "#";}?>">
						<i class="<?php echo $dn->icon;?>"></i><?php echo $dn->menu;?></a>
						
						<?php
						$query2 = $this->db->query("SELECT DISTINCT a.idnavigation, a.navigation, a.icon, a.link, a.short, b.users_access FROM ".$this->db->dbprefix('navigation')." a, ".$this->db->dbprefix('permissions')." b WHERE a.idnavcategory=b.idnavcategory AND a.idnavcategory='$dn->idnavcategory' AND b.users_access='1' AND a.idnavigation=b.idnavigation AND b.idroles='$roles' ORDER BY a.short");
						if ($query2->num_rows() >= 1)
						{
						?>
						<ul>
							<?php
								$datanav=$query2->result(); 
								foreach ($datanav as $dnv)
								{
							?>
								
								<?php
									$query3 = $this->db->query("SELECT DISTINCT a.idsubnavigation, a.subnavigation, a.icon, a.link, a.short, b.users_access FROM ".$this->db->dbprefix('subnavigation')." a, ".$this->db->dbprefix('permissions')." b WHERE a.idnavigation='$dnv->idnavigation' AND b.users_access='1' AND a.idnavigation=b.idnavigation AND a.idsubnavigation=b.idsubnavigation AND b.idroles='$roles' ORDER By a.short");
									if ($query3->num_rows() >= 1)
									{
								?>
									<li class="dropdown"><a href="<?php echo base_url();?><?php echo $dnv->link;?>"><i class="<?php echo $dnv->icon;?>"></i><?php echo $dnv->navigation;?></a>
									<ul class="sub-menu">
										<?php
											$datanav=$query3->result(); 
											foreach ($datanav as $dnvv)
											{
										?>
											<li><a href="<?php echo base_url();?><?php echo $dnvv->link;?>"><i class="<?php echo $dnvv->icon;?>"></i><?php echo $dnvv->subnavigation;?></a></li>
										<?php
											}
										?>
									</ul>
								<?php
									}
									else
									{	
								?>
									<li ><a href="<?php echo base_url();?><?php echo $dnv->link;?>"><i class="<?php echo $dnv->icon;?>"></i><?php echo $dnv->navigation;?></a>
									</li>
								<?php
									}
								?>
							<?php
								}
							?>
						</ul>
						<?php	
						}	
						?>
						</li>
					<?php	
					}	
					?>
                </ul>
                <!-- END: Menu-->
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
                    <li class="breadcrumb-item">Selamat datang <b><?php echo $fullname;?></b></li>
                </ol>
            </div>
        </div>
        <!-- END: Main Menu-->