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
        $data['years'] = $this->graduation_date();
        $data['lo']=$this->model_laporan->seluruh_lo_mhs()->result();
		$data['content'] = 'laporan/laporan';
		$data['meta'] = 'laporan/meta';
		$data['css'] = 'laporan/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}
    
    function graduation_date()
	{
		$graduation_date= $this->model_laporan->periode_wisuda()->result();
		$show="<select id='years' name='graduation_date' class='form-control'>";
		$show.="<option value='0'>".lang('graduation_date')."</option>";
		foreach($graduation_date as $d)
		{
            $show.="<option value='$d->graduation_date'>$d->graduation_date</option>";
		}
        $show.="<option value='0'>Seluruh Periode Wisuda</option>";
		$show.="</select>";	
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
        $date = $this->input->post('graduation_date');
        $data['years'] = $this->graduation_date();
        if($date == 0 || $date == ""){
            $data['lo']=$this->model_laporan->seluruh_lo_mhs()->result();
        }else{
            $data['lo']=$this->model_laporan->seluruh_lo_mhs_by_date($date)->result();
        }
		$data['content'] = 'laporan/periode_wisuda';
		$data['meta'] = 'laporan/meta';
		$data['css'] = 'laporan/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}
	
}
