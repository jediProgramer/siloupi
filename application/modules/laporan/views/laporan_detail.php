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
										<th>LO A1</th>
										<th>LO A2</th>
										<th>LO C1</th>
										<th>LO C2</th>
										<th>LO C3</th>
										<th>LO C4</th>
										<th>LO K1</th>
										<th>LO K2</th>
										<th>LO S1</th>
										<th>Posisi Akademik</th>
									</tr>
								</thead>
								<tbody>
                                <?php 
                                $i = 1;$a1 = 0;$a2 = 0;$c1 = 0;$c2 = 0;$c3 = 0;$c4 = 0;$k1 = 0;$k2 = 0;$s1 = 0;
                                foreach($lo as $d){ ?>
                                    <tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $d->nim; ?></td>
										<td><?php echo $d->name; ?></td>
										<td><?php echo $d->graduation_date; ?></td>
										<td><?php echo $d->gpa; ?></td>
										<td><?php $a1 = $a1+$d->_a1;echo $d->_a1; ?></td>
										<td><?php $a2 = $a2+$d->_a2;echo $d->_a2; ?></td>
										<td><?php $c1 = $c1+$d->_c1;echo $d->_c1; ?></td>
										<td><?php $c2 = $c2+$d->_c2;echo $d->_c2; ?></td>
										<td><?php $c3 = $c3+$d->_c3;echo $d->_c3; ?></td>
										<td><?php $c4 = $c4+$d->_c4;echo $d->_c4; ?></td>
										<td><?php $k1 = $k1+$d->_k1;echo $d->_k1; ?></td>
										<td><?php $k2 = $k2+$d->_k2;echo $d->_k2; ?></td>
										<td><?php $s1 = $s1+$d->_s1;echo $d->_s1; ?></td>
										<td></td>
									</tr>
                                <?php 
                                $i++;
                                } 
                                ?>
								</tbody>
							</table>
						</div>
                    </div>
				</div>	
            </div>

		</div>