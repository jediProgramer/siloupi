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
								$i = 1; //$j = 1;$a1 = 0;$a2 = 0;$c1 = 0;$c2 = 0;$c3 = 0;$c4 = 0;$k1 = 0;$k2 = 0;$s1 = 0;$s2 = 0;$s3 = 0;
								
								// foreach($lo as $d){
								// 	$a1 = $a1+$d->_a1;
								// 	$a2 = $a2+$d->_a2;
								// 	$c1 = $c1+$d->_c1;
								// 	$c2 = $c2+$d->_c2;
								// 	$c3 = $c3+$d->_c3;
								// 	$c4 = $c4+$d->_c4;
								// 	$k1 = $k1+$d->_k1;
								// 	$k2 = $k2+$d->_k2;
								// 	$s1 = $s1+$d->_s1;
								// 	$s2 = $s1+$d->_s2;
								// 	$s3 = $s1+$d->_s3;
                                // 	$j++;
								// }

								// $r_a1 = number_format($a1/$j, 2, '.', '');
								// $r_a2 = number_format($a2/$j, 2, '.', '');
								// $r_c1 = number_format($c1/$j, 2, '.', '');
								// $r_c2 = number_format($c2/$j, 2, '.', '');
								// $r_c3 = number_format($c3/$j, 2, '.', '');
								// $r_c4 = number_format($c4/$j, 2, '.', '');
								// $r_k1 = number_format($k1/$j, 2, '.', '');
								// $r_k2 = number_format($k2/$j, 2, '.', '');
								// $r_s1 = number_format($s1/$j, 2, '.', '');
								// $r_s2 = number_format($s2/$j, 2, '.', '');
								// $r_s3 = number_format($s3/$j, 2, '.', '');

								// $quartil = array(
								// 	$r_a1,
								// 	$r_a2,
								// 	$r_c1,
								// 	$r_c2,
								// 	$r_c3,
								// 	$r_c4,
								// 	$r_k1,
								// 	$r_k2,
								// 	$r_s1,
								// 	$r_s2,
								// 	$r_s3
								// );

								// sort($quartil);

								// if(count($quartil) % 2 == 0){
								// 	$q1 = 0.25 * (count($quartil)+2);
								// 	$q2 = 0.5 * ((count($quartil)/2)+ ((count($quartil)/2)+1));
								// 	$q3 = 0.75 * ((count($quartil)+2)-1);
								// }else{
								// 	$q1 = 0.25 * (count($quartil)+1);
								// 	$q2 = ((count($quartil)+1)/2);
								// 	$q3 = 0.75 * (count($quartil)+1);
								// }

								// for($a = 0; $a < count($quartil) ; $a++){
								// 	if($a <= $q1-1){
								// 		$quartil[$a][$a] = "a";
								// 	}else if($a<$q3-1 && $a>$q1-1){
								// 		$quartil[$a][$a] = "b";
								// 	}else{
								// 		$quartil[$a][$a] = "c";
								// 	}
								// }
								$rata_tmp = array();
								$rata_arr = array();
                                foreach($lo as $d){ ?>
                                    <tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $d->nim; ?></td>
										<td><?php echo $d->name; ?></td>
										<td><?php echo $d->graduation_name; ?></td>
										<td><?php echo $d->gpa; ?></td>
										<?php 
										$nilai_lo = $this->model_laporan->nilai_lo($d->nim)->result();
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
											echo $this->model_laporan->hitung_quartil($d->id_grad,$d->nim);
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
												array_push($rata_arr, number_format($a/$j, 2, '.', ''));
												echo "<th>".number_format($a/$j, 2, '.', '')."</th>";
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