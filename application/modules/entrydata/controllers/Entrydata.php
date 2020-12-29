<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrydata extends CI_Controller {

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
		// Load default language
		$this->lang->load('text_lang', 'indonesia');
	}
	
	public function plo()
	{
		$data['menuname'] = "Entri Data Program Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['dataplo']=$this->model_siloupi->ambildataOrderById($this->db->dbprefix('plo'),'idplo','idusers',$data['idusers']);
		$data['content'] = 'entrydata/listlearningoutcomes';
		$data['meta'] = 'entrydata/meta';
		$data['css'] = 'entrydata/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}
	
	public function addplo()
	{
		$data['menuname'] = "Tambah Program Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['content'] = 'entrydata/addplo';
		$data['meta'] = 'entrydata/meta';
		$data['css'] = 'entrydata/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}
	
	public function saveplo()
    {
		$tgl=date('y-m-d');
		$pieces= explode("-",$tgl);
		$rand = substr(md5(microtime()),rand(0,26),5);
		$idplo="PLO".$pieces[0].$pieces[1].$rand;
		$idusers = $this->session->userdata('idusers');
		$data=array(	
			'idplo'=>$idplo,
			'idusers'=>$idusers,
			'plo'=>$this->input->post('plo'),
			'idprograme'=>$this->input->post('idinstitution'),
			'active'=>0
		);
		$this->model_siloupi->simpandata($this->db->dbprefix('plo'),$data);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_save')
		);
		echo json_encode($msg);		
	}	
}
