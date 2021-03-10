<div class="row">
			
			<div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header">
						<h5 class="float-left"><?php echo $datawisuda; ?></h5>
						<?php if($jenis == 'periode'){ ?>
						<a class="btn btn-success float-right" style="margin-bottom:10px;" href="<?php echo site_url('laporan/export/'.$idgrad); ?>"><i class="fas fa-print"></i> Export XLS</a>
						<?php }else{ ?>
						<a class="btn btn-success float-right" style="margin-bottom:10px;" href="<?php echo site_url('laporan/export_seluruh/'.$dategrad); ?>"><i class="fas fa-print"></i> Export XLS</a>
						<?php } ?>
                    </div>
                    <div class="card-body">
						
						<div class="table-responsive">
							<table id="data" class="display table dataTable table-striped table-bordered" >
								<thead >
									<tr>
										<th>No</th>
										<th>NIM</th>
										<th>Nama</th>
										<th>Periode Wisuda</th>
										<th>IPK</th>
										<?php 
										$a=0;
										$b= array();
										foreach($show_lo as $d){ ?>
										<th>LO 
										<?php 
											array_push($b, $d->idlo);
											echo $d->idlo; 
											?>
										</th>
										<?php $a++; } ?>
										<th>Posisi Akademik</th>
										<th>Ranking</th>
									</tr>
								</thead>
								<tbody>
                                <?php 
								$i = 1;
								$rata_tmp = array();
								$rata_arr = array();
								$idcurricullum = $this->model_laporan->getcurriculum($this->session->userdata('idinstitution'))->row();
                                foreach($lo as $d){ ?>
                                    <tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $d->nim; ?></td>
										<td><?php echo $d->name; ?></td>
										<td><?php echo $d->graduation_name; ?></td>
										<td>
											<?php
												$ipk = $d->gpa;  
												echo $d->gpa; 
											?>
										</td>
										<?php 
										$nilai_lo = $this->model_laporan->nilai_lo($d->nim, $idcurricullum->idcurriculum)->result();
										$jumlah_lo = 0;
										$rata2 = array();
										$k = 0;
										for($j=0 ; $a>$j; $j++){ 
										?>
										<td>
											<?php
												$nilailo = 0;
												//echo array_search("A1", $nilai_lo[$j]);
												if(isset($nilai_lo[$k]->idlo)){
													if($nilai_lo[$k]->idlo == $b[$j]){
														$nilailo = number_format($nilai_lo[$k]->nilai_lo, 2, '.', '');
														echo $nilailo;
														$k++;
													}
												}
												?>
										</td>
										<?php 
											array_push($rata2, $nilailo);
										} 
										
										// while($a > $j){
										// 	echo "<td></td>";
										// 	array_push($rata2, '0');
										// 	$j++;
										// }
										?>
										<td>
											<?php
												if(isset($d->gpa)){
													$kuartil_rank = $this->model_laporan->hitung_quartil($d->id_grad,$d->nim);
													echo $kuartil_rank[0];
												}
												?>
										</td>
										<td>
											<?php
												if(isset($d->gpa)){
													echo $kuartil_rank[1];
												}
											?>
										</td>
									</tr>
                                <?php 
								array_push($rata_tmp, $rata2);
                                $i++;
                                } 
                                ?>
								</tbody>
								<tfoot>
									<tr>
										<th colspan="5" text-align='center'>Rata-rata LO</th>
										
										<?php 
											$i=0;
											while($i < count($show_lo)){
												$j = 0; $a = 0;
												while($j < count($rata_tmp)){
													$a = $a + $rata_tmp[$j][$i];
													$j++;
												}
												if($a != 0){
													array_push($rata_arr, number_format($a/$j, 2, '.', ''));
													echo "<th>".number_format($a/$j, 2, '.', '')."</th>";
												}else{
													echo '<th></th>';
												}
												$i++;
											}

											
										?>

										<th>
										<?php //print_r($rata_arr); ?>
										</th>
									</tr>
								</tfoot>
							</table>
						</div>
                    </div>
				</div>	
            </div>

		</div>