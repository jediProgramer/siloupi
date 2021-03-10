<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('auth'));
		}

		$this->autoloader_psr4->register();
		$this->autoloader_psr4->addNamespace('Psr\SimpleCache', APPPATH . 'third_party/SimpleCache');
		$this->autoloader_psr4->addNamespace('MyCLabs\Enum', APPPATH . 'third_party/MyCLabs');
		$this->autoloader_psr4->addNamespace('ZipStream', APPPATH . 'third_party/ZipStream');
		$this->autoloader_psr4->addNamespace('PhpOffice\PhpSpreadsheet', APPPATH . 'third_party/PhpSpreadsheet');
		
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(array('form','url'));
		$this->load->helper('text');
		$this->load->model('model_siloupi');
		$this->load->model('model_laporan');
		// Load default language
		$this->lang->load('text_lang', 'indonesia');
	}

    function index()
	{
        $data['menuname'] = "Laporan Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idplo'] = "";
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
        $data['years'] = $this->graduation_year();
        //$data['lo']=$this->model_laporan->seluruh_lo_mhs()->result();
		$data['content'] = 'laporan/laporan';
		$data['meta'] = 'laporan/meta';
		$data['css'] = 'laporan/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}
    
    function graduation_year()
	{
		$graduation_year= $this->model_laporan->periode_wisuda_tahun()->result();
		$show="<select id='years' name='graduation_date' class='form-control' onchange='graduation_id(this.value)'>";
		$show.="<option value='0'>".lang('graduation_date')."</option>";
		foreach($graduation_year as $d)
		{
            $show.="<option value='$d->year_graduation'>$d->year_graduation</option>";
		}
		$show.="</select>";	
		return $show;
    }

	function graduation_id($year)
	{
		$graduation_date= $this->model_laporan->periode_wisuda($year)->result();
		$show="<label for='years'>".lang('graduate_name')."</label>";
		$show.="<select id='period' name='idgraduation' class='form-control'>";
		$show.="<option value='0'>".lang('graduate_name')."</option>";
		foreach($graduation_date as $d)
		{
			$show.="<option value='$d->idgraduation'>$d->graduation_name</option>";
		}
		$show.="<option value='0'>Seluruh Periode Wisuda</option>";
		$show.="</select>";	
		echo $show;
    }
	
	function graduation_name($year)
	{
		$graduation_name= $this->model_laporan->periode_wisuda($year)->result();
		$show ="<option value='0'>".lang('graduation_name')."</option>";
		foreach($graduation_name as $d)
		{
            $show.="<option value='$d->graduation_name'>$d->graduation_name</option>";
		}
		return $show;
    }

    function periode_wisuda()
	{
        $data['menuname'] = "Laporan Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idplo'] = "";
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['show_lo']=$this->model_laporan->show_lo()->result();
        $date['idgrad'] = $this->input->post('graduation_name');
        $date['dategrad'] = $this->input->post('graduation_date');
        $data['idgrad'] = $this->input->post('graduation_name');
        $data['dategrad'] = $this->input->post('graduation_date');
        $data['years'] = $this->graduation_year();
        if($date['dategrad'] == 0 || $date['dategrad'] == ""){
			$this->session->set_flashdata('message', 'Pilih tahun dan periode wisuda terlebih dahulu!');
            redirect(site_url("laporan"));
        }else if($date['idgrad'] == 0 || $date['idgrad'] == "") {
			$data['datawisuda'] = "Wisuda Seluruh Gelombang Tahun ".$date['dategrad'];
			$data['jenis'] = "seluruh";
			$data['lo']=$this->model_laporan->seluruh_lo_mhs_by_year($date['dategrad'])->result();
        }else{
			$datawisuda = $this->model_laporan->periode_wisuda_by_id($date['idgrad'])->row();
			$data['datawisuda'] = $datawisuda->graduation_name." Tahun ".$datawisuda->year_graduation;
			$data['jenis'] = "periode";
			$data['lo']=$this->model_laporan->seluruh_lo_mhs_by_id($date['idgrad'])->result();
		}
		$data['content'] = 'laporan/periode_wisuda';
		$data['meta'] = 'laporan/meta';
		$data['css'] = 'laporan/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}

	function export($id_grad)
	{
		$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet(); // instantiate Spreadsheet

		$objset = $spreadsheet->setActiveSheetIndex(0); //inisiasi set object
		$objget = $spreadsheet->getActiveSheet();  //inisiasi get object
		$objget->setTitle('Laporan LO'); //sheet title
		$style = array(
			'font' => array(
				'bold'  => true,
			)
		);

		$cols = array("A","B","C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");


		$val = $this->model_laporan->show_lo()->result();
		//$val = array("No ","NIS","Nama","Kelas","Mata Pelajaran","Nilai");

		$objset->setCellValue("A3", "No");
		$objget->getStyle('A3')->applyFromArray($style);
		$objget->getColumnDimension('A')->setWidth(6);
		$objset->setCellValue("B3", "NIM");
		$objget->getStyle('B3')->applyFromArray($style);
		$objget->getColumnDimension('B')->setWidth(20);
		$objset->setCellValue("C3", "Nama");
		$objget->getStyle('C3')->applyFromArray($style);
		$objget->getColumnDimension('C')->setWidth(40);
		$objset->setCellValue("D3", "Periode Wisuda");
		$objget->getStyle('D3')->applyFromArray($style);
		$objget->getColumnDimension('D')->setWidth(30);
		$objset->setCellValue("E3", "IPK");
		$objget->getStyle('E3')->applyFromArray($style);

		$a = 5;
		$b_arr= array();
		foreach($val as $value){
			array_push($b_arr, $value->idlo);
			$objset->setCellValue($cols[$a].'3', "LO_".$value->idlo);
			$objget->getStyle($cols[$a].'3')->applyFromArray($style);
			$a++; 
		}

		$objset->setCellValue($cols[$a].'3', "Posisi Akademik");
		$objget->getStyle($cols[$a].'3')->applyFromArray($style);
		$objget->getColumnDimension($cols[$a])->setWidth(30);

		$objset->setCellValue($cols[$a+1].'3', "Ranking");
		$objget->getStyle($cols[$a+1].'3')->applyFromArray($style);
		$objget->getColumnDimension($cols[$a+1])->setWidth(30);

		
		$rata_tmp = array();
		$rata_arr = array();
		$idcurricullum 	= $this->model_laporan->getcurriculum($this->session->userdata('idinstitution'))->row();
		$lo				= $this->model_laporan->seluruh_lo_mhs_by_id($id_grad)->result();
		$baris = 4;
		foreach($lo as $d){
			$b = 0;
			$objset->setCellValue($cols[$b].$baris, $baris-3);
			$b++;
			$objset->setCellValue($cols[$b].$baris, $d->nim);
			$b++;
			$objset->setCellValue($cols[$b].$baris, $d->name);
			$b++;
			$objset->setCellValue($cols[$b].$baris, $d->graduation_name);
			$b++;
			$objset->setCellValue($cols[$b].$baris, $d->gpa);
			$b++;
			$nilai_lo = $this->model_laporan->nilai_lo($d->nim, $idcurricullum->idcurriculum)->result();
			$jumlah_lo = 0;
			$rata2 = array();
			$k=0;
			for($j=0 ; $a-5>$j; $j++){ 
				$nilailo = 0;
				
				if(isset($nilai_lo[$k]->idlo)){
					if($nilai_lo[$k]->idlo == $b_arr[$j]){
						$nilailo = number_format($nilai_lo[$k]->nilai_lo, 2, '.', '');
						$objset->setCellValue($cols[$b].$baris, $nilailo);
						$b++;
						$k++;
					}
				}
				array_push($rata2, $nilailo);
			}
			
			if(isset($d->gpa)){
				$kuartil = $this->model_laporan->hitung_quartil($d->id_grad,$d->nim);
				$objset->setCellValue($cols[$b].$baris, $kuartil[0]);
				$objset->setCellValue($cols[$b+1].$baris, $kuartil[1]);
			}

			//$objPHPExcel->getActiveSheet()->getStyle("A".$)->applyFromArray($style);
			array_push($rata_tmp, $rata2);
			$baris++;
		}

		//judul
		$datawisuda = $this->model_laporan->periode_wisuda_by_id($id_grad)->row();
		$objset->setCellValue("A1", "Data LO Tahun ".$datawisuda->year_graduation." ".$datawisuda->graduation_name); 
		$objset->mergeCells('A1:'.$cols[$b].'1');
		$objget->getStyle('A1')->applyFromArray($style);
		
		$objset->setCellValue("A".$baris, "Rata-Rata LO"); 
		$objset->mergeCells('A'.$baris.':E'.$baris);
		$objget->getStyle('A'.$baris)->applyFromArray($style);

		$p=0;
		while($p < count($val)){
			$q = 0; $a = 0;
			while($q < count($rata_tmp)){
				$a = $a + $rata_tmp[$q][$p];
				$q++;
			}
			if($a != 0){
				array_push($rata_arr, number_format($a/$q, 2, '.', ''));
				$objset->setCellValue($cols[$p+5].$baris, number_format($a/$q, 2, '.', '')); 
				$objget->getStyle($cols[$p+5].$baris)->applyFromArray($style);
			}else{
				$objget->getStyle($cols[$p+5].$baris)->applyFromArray($style);
			}
			$p++;
		}

		
		$objget->setTitle('Laporan LO');
		
		$objset;  
		$filename = "LO_".$datawisuda->year_graduation."_".$datawisuda->graduation_name.".xlsx";
		
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-type: application/vnd.ms-excel');
		//header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		$objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
//		ob_end_clean();                
		$objWriter->save('php://output');

	}


	function export_seluruh($year)
	{
		$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet(); // instantiate Spreadsheet

		$objset = $spreadsheet->setActiveSheetIndex(0); //inisiasi set object
		$objget = $spreadsheet->getActiveSheet();  //inisiasi get object
		$objget->setTitle('Laporan LO'); //sheet title
		$style = array(
			'font' => array(
				'bold'  => true,
			)
		);

		$cols = array("A","B","C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");


		$val = $this->model_laporan->show_lo()->result();
		//$val = array("No ","NIS","Nama","Kelas","Mata Pelajaran","Nilai");

		$objset->setCellValue("A3", "No");
		$objget->getStyle('A3')->applyFromArray($style);
		$objget->getColumnDimension('A')->setWidth(6);
		$objset->setCellValue("B3", "NIM");
		$objget->getStyle('B3')->applyFromArray($style);
		$objget->getColumnDimension('B')->setWidth(20);
		$objset->setCellValue("C3", "Nama");
		$objget->getStyle('C3')->applyFromArray($style);
		$objget->getColumnDimension('C')->setWidth(40);
		$objset->setCellValue("D3", "Periode Wisuda");
		$objget->getStyle('D3')->applyFromArray($style);
		$objget->getColumnDimension('D')->setWidth(30);
		$objset->setCellValue("E3", "IPK");
		$objget->getStyle('E3')->applyFromArray($style);

		$a = 5;
		$b_arr= array();
		foreach($val as $value){
			array_push($b_arr, $value->idlo);
			$objset->setCellValue($cols[$a].'3', "LO_".$value->idlo);
			$objget->getStyle($cols[$a].'3')->applyFromArray($style);
			$a++; 
		}

		$objset->setCellValue($cols[$a].'3', "Posisi Akademik");
		$objget->getStyle($cols[$a].'3')->applyFromArray($style);
		$objget->getColumnDimension($cols[$a])->setWidth(30);

		$objset->setCellValue($cols[$a+1].'3', "Ranking");
		$objget->getStyle($cols[$a+1].'3')->applyFromArray($style);
		$objget->getColumnDimension($cols[$a+1])->setWidth(30);

		
		$rata_tmp = array();
		$rata_arr = array();
		$idcurricullum 	= $this->model_laporan->getcurriculum($this->session->userdata('idinstitution'))->row();
		$lo				= $this->model_laporan->seluruh_lo_mhs_by_year($year)->result();
		$baris = 4;
		foreach($lo as $d){
			$b = 0;
			$objset->setCellValue($cols[$b].$baris, $baris-3);
			$b++;
			$objset->setCellValue($cols[$b].$baris, $d->nim);
			$b++;
			$objset->setCellValue($cols[$b].$baris, $d->name);
			$b++;
			$objset->setCellValue($cols[$b].$baris, $d->graduation_name);
			$b++;
			$objset->setCellValue($cols[$b].$baris, $d->gpa);
			$b++;
			$nilai_lo = $this->model_laporan->nilai_lo($d->nim, $idcurricullum->idcurriculum)->result();
			$jumlah_lo = 0;
			$rata2 = array();
			$k=0;
			for($j=0 ; $a-5>$j; $j++){ 
				$nilailo = 0;
				
				if(isset($nilai_lo[$k]->idlo)){
					if($nilai_lo[$k]->idlo == $b_arr[$j]){
						$nilailo = number_format($nilai_lo[$k]->nilai_lo, 2, '.', '');
						$objset->setCellValue($cols[$b].$baris, $nilailo);
						$b++;
						$k++;
					}
				}
				array_push($rata2, $nilailo);
			}
			
			if(isset($d->gpa)){
				$kuartil = $this->model_laporan->hitung_quartil($d->id_grad,$d->nim);
				$objset->setCellValue($cols[$b].$baris, $kuartil[0]);
				$objset->setCellValue($cols[$b+1].$baris, $kuartil[1]);
			}

			//$objPHPExcel->getActiveSheet()->getStyle("A".$)->applyFromArray($style);
			array_push($rata_tmp, $rata2);
			$baris++;
		}

		//judul
		$objset->setCellValue("A1", "Data LO Tahun ".$year); 
		$objset->mergeCells('A1:'.$cols[$b].'1');
		$objget->getStyle('A1')->applyFromArray($style);
		
		$objset->setCellValue("A".$baris, "Rata-Rata LO"); 
		$objset->mergeCells('A'.$baris.':E'.$baris);
		$objget->getStyle('A'.$baris)->applyFromArray($style);

		$p=0;
		while($p < count($val)){
			$q = 0; $a = 0;
			while($q < count($rata_tmp)){
				$a = $a + $rata_tmp[$q][$p];
				$q++;
			}
			if($a != 0){
				array_push($rata_arr, number_format($a/$q, 2, '.', ''));
				$objset->setCellValue($cols[$p+5].$baris, number_format($a/$q, 2, '.', '')); 
				$objget->getStyle($cols[$p+5].$baris)->applyFromArray($style);
			}else{
				$objget->getStyle($cols[$p+5].$baris)->applyFromArray($style);
			}
			$p++;
		}

		
		$objget->setTitle('Laporan LO');
		
		$objset;  
		$filename = "LO_".$year.".xlsx";
		
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");
		//header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-type: application/vnd.ms-excel');
		//header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		$objWriter = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
//		ob_end_clean();                
		$objWriter->save('php://output');

	}


	function ranking(){
		$numbers = array( 101, 201, 301, 301, 401, 401, 401, 501, 501, 501, 501);
		rsort($numbers);

		$arrlength = count($numbers);
		$rank = 1;
		$prev_rank = $rank;

		for($x = 0; $x < $arrlength; $x++) {
			if ($x==0) {
				echo $numbers[$x]."-". ($rank) ."/". $arrlength;
			}else if ($numbers[$x] != $numbers[$x-1]) {
				$rank++;
				$prev_rank = $rank;
				echo $numbers[$x]."-". ($rank) ."/". $arrlength;
			}else{
				echo $numbers[$x]."-".$prev_rank."/". $arrlength;
			}
			echo "<br>";
		}
	}

	function haha(){
		$lo = $this->model_laporan->seluruh_lo_mhs_by_id(1)->result();
		$rataarr = array();
		$i = 0;
		
		foreach($lo as $d){
			$ratarata = array($d->gpa, $i, $d->nim);
			array_push($rataarr, $ratarata);
			$i++;
		}

		rsort($rataarr);

		$arrlength = count($rataarr);
		$rank = 1;
		$prev_rank = $rank;

		for($x = 0; $x < $arrlength; $x++) {
			if ($x==0) {
				echo $rataarr[$x][0]."-". ($rank) ."/". $arrlength;
			}else if ($rataarr[$x][0] != $rataarr[$x-1][0]) {
				$rank++;
				$prev_rank = $rank;
				echo $rataarr[$x][0]."-". ($rank) ."/". $arrlength;
			}else{
				echo $rataarr[$x][0]."-".$prev_rank."/". $arrlength;
			}
			echo "<br>";
		}

	}

	

}