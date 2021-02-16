<?php
    class Model_laporan extends CI_Model
	{
		//var $tabel='meowcms_users';
		
		
		function __construct()
		{
			parent::__construct();
		}
		
		public function periode_wisuda_tahun()
		{
			$query=$this->db->query("select year_graduation from siloupi_graduation_period group by year_graduation");
			return $query;
		}
		
		public function periode_wisuda($year)
		{
			$query=$this->db->query("select * from siloupi_graduation_period where year_graduation = '$year' order by graduation_name asc");
			return $query;
		}

		public function seluruh_lo_mhs()
		{
			$query=$this->db->query("select * from view_lo_report_d055");
			return $query;
		}

		public function seluruh_lo_mhs_by_date($id_grad)
		{
			$query=$this->db->query("select a.*,b.graduation_name  from siloupi_student a, siloupi_graduation_period b where a.id_grad = '$id_grad' and a.id_grad = b.idgraduation");
			return $query;
		}
		
		public function show_lo()
		{
			$id_user = $this->session->userdata('idinstitution');
			$query=$this->db->query("SELECT a.idlo from siloupi_lo a, siloupi_plo b where a.idplo = b.idplo and b.idprograme = '$id_user' order by idlo asc");
			return $query;
		}
		
		public function nilai_lo($nim)
		{
			$id_user = $this->session->userdata('idinstitution');
			$query=$this->db->query("select idlo, ((avg(DISTINCT quality))*25) as nilai_lo from view_all_lo_crosstab_d055 where nim = '$nim' AND idprograme ='D055' AND idcurriculum = 'D05518' GROUP BY idlo ORDER BY idlo asc ");
			return $query;
		}

		function hitung_quartil($date, $nim){
			$count_lo = $this->model_laporan->show_lo()->num_rows();
			$lo = $this->model_laporan->seluruh_lo_mhs_by_date($date)->result();
			$rataarr = array();
			$i = 0;
			foreach($lo as $d){
				$jumlahlo = 0;
				$j = 0;
				$nilailo = $this->model_laporan->nilai_lo($d->nim)->result();
				$rata2lo = array();
				foreach($nilailo as $e){ 
					$nilai_lo = number_format($e->nilai_lo, 2, '.', '');
					$jumlahlo = $jumlahlo + $nilai_lo;
					$j++;
				}
				
				$rata2lo = number_format($jumlahlo / $count_lo, 2, '.', '');
				if($d->nim == $nim){
					$ratarata = array($rata2lo, $i, $nim);
				}else{
					$ratarata = array($rata2lo, $i, 0);
				}
				array_push($rataarr, $ratarata);
				$i++;
			}

			sort($rataarr);

			if(count($rataarr) % 2 == 0){
				$q1 = 0.25 * (count($rataarr)+2);
				$q2 = 0.5 * ((count($rataarr)/2)+ ((count($rataarr)/2)+1));
				$q3 = 0.75 * ((count($rataarr)+2)-1);
			}else{
				$q1 = 0.25 * (count($rataarr)+1);
				$q2 = ((count($rataarr)+1)/2);
				$q3 = 0.75 * (count($rataarr)+1);
			}

			for($a = 0; $a < count($rataarr) ; $a++){
				if($a <= $q1-1){
					array_push($rataarr[$a], "Q1");
				}else if($a<$q3-1 && $a>$q1-1){
					array_push($rataarr[$a], "Q2");
				}else{
					array_push($rataarr[$a], "Q3");
				}
			}
			$hasil = 0;
			foreach($rataarr as $r){
				if($r[2] == $nim){
					$hasil = $r[3];
				}
			}
			return $hasil;
		}
	}
?>