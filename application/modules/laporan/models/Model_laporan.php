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
			$query=$this->db->query("select year_graduation from siloupi_graduation_period group by year_graduation order by year_graduation asc");
			return $query;
		}
		
		public function periode_wisuda_by_id($id)
		{
			$query=$this->db->query("select * from siloupi_graduation_period where idgraduation = '$id'");
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

		public function seluruh_lo_mhs_by_id($id_grad)
		{
			$id_user = $this->session->userdata('idinstitution');
			$query=$this->db->query("select a.*,b.graduation_name  from siloupi_student a, siloupi_graduation_period b where a.id_grad = '$id_grad' and a.id_grad = b.idgraduation and idprograme = '$id_user' ORDER BY a.gpa DESC");
			return $query;
		}

		public function seluruh_lo_mhs_by_year($year)
		{
			$id_user = $this->session->userdata('idinstitution');
			$query=$this->db->query("select a.*,b.graduation_name  from siloupi_student a, siloupi_graduation_period b where b.year_graduation = '$year' and a.id_grad = b.idgraduation and idprograme = '$id_user' ORDER BY a.gpa DESC");
			return $query;
		}
		
		public function show_lo()
		{
			$id_user = $this->session->userdata('idinstitution');
			$idcurriculum = $this->session->userdata('idinstitution')."18";
			$query=$this->db->query("SELECT distinct a.idlo from siloupi_lo a join siloupi_plo b on a.idplo = b.idplo where b.idprograme = '$id_user' order by a.idlo asc");
			return $query;
		}
		
		public function nilai_lo($nim, $idcurricullum)
		{
			$id_user = $this->session->userdata('idinstitution');
			//$query=$this->db->query("select idlo, ((avg(DISTINCT quality))*25) as nilai_lo from view_all_lo_crosstab_d055 where nim = '$nim' AND idprograme ='$id_user' AND idcurriculum = '$idcurricullum' GROUP BY idlo ORDER BY idlo asc ");
			$query=$this->db->query("select idlo, ((avg(DISTINCT quality))*25) as nilai_lo from view_all_lo_crosstab_d055 where nim = '$nim' AND idlo in (SELECT distinct a.idlo from siloupi_lo a join siloupi_plo b on a.idplo = b.idplo where b.idprograme = '$id_user' order by a.idlo asc) GROUP BY idlo ORDER BY idlo asc ");
			return $query;
		}

		public function getcurriculum($idprogram){
			$query=$this->db->query("select idcurriculum from siloupi_curriculum where idprograme = '$idprogram' ORDER BY idcurriculum DESC limit 1");
			return $query;
		}

		function hitung_quartil($date, $nim){
			$lo = $this->model_laporan->seluruh_lo_mhs_by_id($date)->result();
			$rataarr = array();
			$i = 0;
			foreach($lo as $d){
				$ratarata = array($d->gpa, $i, $d->nim);
				array_push($rataarr, $ratarata);
				$i++;
			}

			sort($rataarr);

			$arrlength = count($rataarr);
			$rank = 1;
			$prev_rank = $rank;

			// Mengganti Fungsi Jika > 4, Jika < 4, tidak hitung kuartil
			if($arrlength > 4){
				if($arrlength % 2 == 0){
					$q1 = 0.25 * ($arrlength + 2);
					$q2 = 0.5 * (($arrlength / 2)+ (($arrlength / 2) + 1));
					$q3 = 0.75 * (($arrlength +2) - 1 );
				}else{
					$q1 = 0.25 * (count($rataarr) + 1);
					$q2 = (($arrlength+1)/2);
					$q3 = 0.75 * ($arrlength + 1);
				}
	
				for($a = 0; $a < $arrlength ; $a++){
					if($a > $q3-1){
						array_push($rataarr[$a], "R4 (".$rataarr[floor($q3)][0]." - 4)");
					}else if($a<=$q3-1 && $a>$q2-1){
						array_push($rataarr[$a], "R3 (".$rataarr[floor($q2)][0]." - ".$rataarr[floor($q3)][0].")");
					}else if($a<=$q2-1 && $a>$q1-1){
						array_push($rataarr[$a], "R2 (".$rataarr[floor($q1)][0]." - ".$rataarr[floor($q2)][0].")");
					}else{
						array_push($rataarr[$a], "R1 (0 - ".$rataarr[floor($q1)][0].")");
					}
				}
			}else{
				for($a = 0; $a < $arrlength ; $a++){
					array_push($rataarr[$a], "R (0 - 4)");
				}
			}

			rsort($rataarr);
			
			for($x = 0; $x < $arrlength; $x++) {
				if ($x==0) {
					array_push($rataarr[$x], ($rank) ."/". $arrlength);
				}else if ($rataarr[$x][0] != $rataarr[$x-1][0]) {
					$rank++;
					$prev_rank = $rank;
					array_push($rataarr[$x], ($rank) ."/". $arrlength);
				}else{
					array_push($rataarr[$x], ($rank) ."/". $arrlength);
				}
			}

			$hasil = array();
			foreach($rataarr as $r){
				if($r[2] == $nim){
					array_push($hasil, $r[3], $r[4]);
				}
			}

			return $hasil;
		}
	}
?>
