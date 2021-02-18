<div class="row">
			
			<div class="col-12 mt-3">
                <div class="card">
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
										foreach($show_lo as $d){ ?>
										<th>LO <?php echo $d->idlo; ?></th>
										<?php $a++; } ?>
										<th>Posisi Akademik</th>
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
										<td><?php echo $d->gpa; ?></td>
										<?php 
										$nilai_lo = $this->model_laporan->nilai_lo($d->nim, $idcurricullum->idcurriculum)->result();
										$j=0;
										$jumlah_lo = 0;
										$rata2 = array();
										foreach($nilai_lo as $e){ 
										?>
										<td>
											<?php
												$nilai_lo = number_format($e->nilai_lo, 2, '.', '');
												echo $nilai_lo;
												?>
										</td>
										<?php 
											array_push($rata2, $nilai_lo);
											$j++; 
										} 
										
										while($a > $j){
											echo "<td></td>";
											array_push($rata2, '0');
											$j++;
										}
										?>
										<td><?php
											echo $this->model_laporan->hitung_quartil($d->id_grad,$d->nim, $idcurricullum->idcurriculum);
											?></td>
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
													$a = $a + $rata_tmp[$j][$i]." ";
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