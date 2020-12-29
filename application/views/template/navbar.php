<!-- START: Header-->
        <div id="header-fix" class="header fixed-top">
            <div class="site-width">
                <nav class="navbar navbar-expand-lg  p-0">
                    <div class="navbar-header  h-100 h4 mb-0 align-self-center logo-bar text-left">
                        <a href="index.html" class="horizontal-logo text-left">
                            <svg height="20pt" preserveAspectRatio="xMidYMid meet" viewBox="0 0 512 512" width="20pt" xmlns="http://www.w3.org/2000/svg">
                            <g transform="matrix(.1 0 0 -.1 0 512)" fill="#1e3d73">
                            <path d="m1450 4481-1105-638v-1283-1283l1106-638c1033-597 1139-654 1139-619 0 4-385 674-855 1489-470 814-855 1484-855 1488 0 8 1303 763 1418 822 175 89 413 166 585 190 114 16 299 13 408-5 100-17 231-60 314-102 310-156 569-509 651-887 23-105 23-331 0-432-53-240-177-460-366-651-174-175-277-247-738-512-177-102-322-189-322-193s104-188 231-407l231-400 46 28c26 15 360 207 742 428l695 402v1282 1282l-1105 639c-608 351-1107 638-1110 638s-502-287-1110-638z"/><path d="m2833 3300c-82-12-190-48-282-95-73-36-637-358-648-369-3-3 580-1022 592-1034 5-5 596 338 673 391 100 69 220 197 260 280 82 167 76 324-19 507-95 184-233 291-411 320-70 11-89 11-165 0z"/>
                            </g>
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
					$query1 = $this->db->query("SELECT DISTINCT a.idnavcategory, a.menu, a.icon FROM ".$this->db->dbprefix('navcategory')." a, ".$this->db->dbprefix('permissions')." b WHERE  a.idnavcategory=b.idnavcategory AND b.users_access=1 AND b.idroles=".$roles." ORDER BY a.idnavcategory");
					$datanavcat=$query1->result(); 
					foreach ($datanavcat as $dn)
					{
					?>
						<li class="dropdown <?php if($dn->menu==$menuname){ echo "active";}?>"><a href="#">
						<i class="<?php echo $dn->icon;?>"></i><?php echo $dn->menu;?></a>
						
						<?php
						$query2 = $this->db->query("SELECT DISTINCT a.idnavigation, a.navigation, a.icon, a.link, b.users_access FROM ".$this->db->dbprefix('navigation')." a, ".$this->db->dbprefix('permissions')." b WHERE a.idnavcategory=b.idnavcategory AND a.idnavcategory='$dn->idnavcategory' AND b.users_access='1' AND a.idnavigation=b.idnavigation AND b.idroles='$roles' ORDER BY a.idnavigation");
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
									$query3 = $this->db->query("SELECT DISTINCT a.idsubnavigation, a.subnavigation, a.icon, a.link, b.users_access FROM ".$this->db->dbprefix('subnavigation')." a, ".$this->db->dbprefix('permissions')." b WHERE a.idnavigation='$dnv->idnavigation' AND b.users_access='1' AND a.idnavigation=b.idnavigation AND a.idsubnavigation=b.idsubnavigation AND b.idroles='$roles' ORDER By a.idsubnavigation");
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