<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Param extends CI_Controller {

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
	
	public function graduationperiod()
	{
		$data['menuname'] = "Kelola Param Gel. Wisuda";
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
		$data['dataparamgraduation']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('graduation_period'),'idgraduation');
		$data['content'] = 'param/listgraduationperiod';
		$data['meta'] = 'param/meta';
		$data['css'] = 'param/css';
		$data['js'] = 'param/js';
		$this->load->view('template/template',$data);
	}
	
	public function addgraduationperiod()
	{
		$data['menuname'] = "Tambah Kelola Param Gel. Wisuda";
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
		$data['content'] = 'param/addgraduationperiod';
		$data['meta'] = 'param/meta';
		$data['css'] = 'param/css';
		$data['js'] = 'param/js';
		$this->load->view('template/template',$data);
	}
	
	public function editgraduationperiod($idgraduation)
	{
		$data['menuname'] = "Edit Menu Utama";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idgraduation'] = $idgraduation;
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datagraduationperiod']=$this->model_siloupi->ambildataById($this->db->dbprefix('graduation_period'),'idgraduation',$data['idgraduation']);
		$data['content'] = 'param/editgraduationperiod';
		$data['meta'] = 'param/meta';
		$data['css'] = 'param/css';
		$data['js'] = 'param/js';
		$this->load->view('template/template',$data);
	}
	
	public function savegraduationperiod()
    {
		$data=array(	
			'graduation_name'=>$this->input->post('graduate_name'),
			'month_graduation'=>$this->input->post('month_graduationperiod'),
			'year_graduation'=>$this->input->post('years')
		);
		$this->model_siloupi->simpandata($this->db->dbprefix('graduation_period'),$data);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_save')
		);	
		echo json_encode($msg);
	}

	public function updategraduationperiod()
    {
		$idgraduation=$this->input->post('idgraduation');
		$data=array(	
			'graduation_name'=>$this->input->post('graduate_name'),
			'month_graduation'=>$this->input->post('month_graduationperiod'),
			'year_graduation'=>$this->input->post('years')
		);
		$clause=array('idgraduation'=>$idgraduation);
		$this->model_siloupi->update($this->db->dbprefix('graduation_period'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_edit')
		);	
		echo json_encode($msg);
	}	
	
	function deletegraduationperiod()
    {
        $idgraduation=$this->input->post('idgraduation');
		$this->db->where('idgraduation', $idgraduation);
        $this->db->delete($this->db->dbprefix('graduation_period'));
        $msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_delete')
		);	
		echo json_encode($msg);
    }

}
