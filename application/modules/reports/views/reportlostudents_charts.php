<div class="col-12 mt-3">
	<div class="card">
		<div class="card-header  justify-content-between align-items-center"> 
		<h6 class="card-title"><?php echo lang('barchartlo');?></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
			<table class="table">
			<?php
				foreach($datastudent as $d)
				{

					$queryfaculty = $this->db->query("SELECT faculty FROM ".$this->db->dbprefix('faculty')." WHERE idfaculty='".$d["idfaculty"]."'");
					$rowfaculty = $queryfaculty->row();
					$faculty=$rowfaculty->faculty;

					$queryprograme = $this->db->query("SELECT programe FROM ".$this->db->dbprefix('programe')." WHERE idprograme='".$d["idprograme"]."'");
					$rowprograme = $queryprograme->row();
					$programe=$rowprograme->programe;
			?>		
					<tr>
					<th style="width:30%"><?php echo lang('nim');?></th>
					<td><?php echo $d["nim"]; ?></td>
					</tr>
					<tr>
					<th><?php echo lang('name');?></th>
					<td><?php echo ucwords(strtolower($d["name"])); ?></td>
					</tr>
					<tr>
					<th><?php echo lang('faculty');?></th>
					<td><?php echo $faculty; ?></td>
					</tr>
					<tr>
					<th><?php echo lang('programe');?></th>
					<td><?php echo $d["idprograme"]." - ".$programe." - ".$d["idlevel"]; ?></td>
					</tr>
					<tr>
					<th><?php echo lang('class_generation');?></th>
					<td><?php echo $d["class_generation"]; ?></td>
					</tr>
					<tr>
					<th><?php echo lang('status');?></th>
					<td><?php echo ucwords(strtolower($d["status"])); ?></td>
					</tr>
			<?php
				}
			?>	
			</table>
			</div>
			<div id="lo-bar"></div>
		</div>
	</div>	
</div>	
        
