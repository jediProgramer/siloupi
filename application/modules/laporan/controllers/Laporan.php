<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('auth'));
		}
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
        $data['lo']=$this->model_laporan->seluruh_lo_mhs()->result();
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
        $date = $this->input->post('graduation_name');
        $data['years'] = $this->graduation_year();
        if($date == 0 || $date == ""){
			$this->session->set_flashdata('message', 'Pilih tahun dan periode wisuda terlebih dahulu!');
            redirect(site_url("laporan"));
        }else{
            $data['lo']=$this->model_laporan->seluruh_lo_mhs_by_date($date)->result();
        }
		$data['content'] = 'laporan/periode_wisuda';
		$data['meta'] = 'laporan/meta';
		$data['css'] = 'laporan/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
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