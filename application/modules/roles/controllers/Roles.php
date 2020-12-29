<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

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
	
	public function index()
	{
		$data['menuname'] = "Kelola Peran";
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
		$data['dataroles']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('roles'),'idroles');
		$data['content'] = 'roles/listroles';
		$data['meta'] = 'roles/meta';
		$data['css'] = 'roles/css';
		$data['js'] = 'roles/js';
		$this->load->view('template/template',$data);
	}
	
	public function addroles()
	{
		$data['menuname'] = "Tambah Peran";
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
		$data['dataposition']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('position'),'idposition');
		$data['content'] = 'roles/addroles';
		$data['meta'] = 'roles/meta';
		$data['css'] = 'roles/css';
		$data['js'] = 'roles/js';
		$this->load->view('template/template',$data);
	}
	
	public function editroles($idroles)
	{
		$data['menuname'] = "Tambah Peran";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['idroles'] = $idroles;
		$data['fullname'] = $this->session->userdata('fullname');
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['dataroles']=$this->model_siloupi->ambildataById($this->db->dbprefix('roles'),'idroles',$data['idroles']);
		$data['dataposition']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('position'),'idposition');
		$data['content'] = 'roles/editroles';
		$data['meta'] = 'roles/meta';
		$data['css'] = 'roles/css';
		$data['js'] = 'roles/js';
		$this->load->view('template/template',$data);
	}
	
	public function saveroles()
    {
		$idusers = $this->session->userdata('idusers');
		$data=array(	
			'idusers'=>$idusers,
			'roles'=>$this->input->post('roles'),
			'idposition'=>$this->input->post('idposition')
		);
		$this->model_siloupi->simpandata($this->db->dbprefix('roles'),$data);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_save')
		);
		echo json_encode($msg);		
	}	
	
	public function updateroles()
    {
		$idroles=$this->input->post('idroles');
		$idusers = $this->session->userdata('idusers');
		$data=array(	
			'idusers'=>$idusers,
			'roles'=>$this->input->post('roles'),
			'idposition'=>$this->input->post('idposition')
		);
		$clause=array('idroles'=>$idroles);
		$this->model_siloupi->update($this->db->dbprefix('roles'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_edit')
		);	
		echo json_encode($msg);
	}
	
	function deleteroles()
    {
        $idroles=$this->input->post('idroles');
		$this->db->where('idroles', $idroles);
        $this->db->delete($this->db->dbprefix('roles'));
        $msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_delete')
		);	
		echo json_encode($msg);
    }	
	
}
