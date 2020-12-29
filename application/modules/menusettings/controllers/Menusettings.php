<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menusettings extends CI_Controller {

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
	
	public function mainmenu()
	{
		$data['menuname'] = "Kelola Menu Utama";
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
		$data['datanavcategory']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('navcategory'),'idnavcategory');
		$data['content'] = 'menusettings/listmainmenu';
		$data['meta'] = 'menusettings/meta';
		$data['css'] = 'menusettings/css';
		$data['js'] = 'menusettings/js';
		$this->load->view('template/template',$data);
	}
	
	public function secondmenu()
	{
		$data['menuname'] = "Kelola Menu Kedua";
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
		$data['datanavigation']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('navigation'),'idnavigation');
		$data['content'] = 'menusettings/listsecondmenu';
		$data['meta'] = 'menusettings/meta';
		$data['css'] = 'menusettings/css';
		$data['js'] = 'menusettings/js';
		$this->load->view('template/template',$data);
	}
	
	public function thirdmenu()
	{
		$data['menuname'] = "Kelola Menu Ketiga";
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
		$data['datasubnavigation']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('subnavigation'),'idsubnavigation');
		$data['content'] = 'menusettings/listthirdmenu';
		$data['meta'] = 'menusettings/meta';
		$data['css'] = 'menusettings/css';
		$data['js'] = 'menusettings/js';
		$this->load->view('template/template',$data);
	}
	
	public function addmainmenu()
	{
		$data['menuname'] = "Tambah Menu Utama";
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
		$data['content'] = 'menusettings/addmainmenu';
		$data['meta'] = 'menusettings/meta';
		$data['css'] = 'menusettings/css';
		$data['js'] = 'menusettings/js';
		$this->load->view('template/template',$data);
	}
	
	public function addsecondmenu()
	{
		$data['menuname'] = "Tambah Menu Kedua";
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
		$data['datanavcategory']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('navcategory'),'idnavcategory');
		$data['content'] = 'menusettings/addsecondmenu';
		$data['meta'] = 'menusettings/meta';
		$data['css'] = 'menusettings/css';
		$data['js'] = 'menusettings/js';
		$this->load->view('template/template',$data);
	}
	
	public function addthirdmenu()
	{
		$data['menuname'] = "Tambah Menu Ketiga";
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
		$data['datanavigation']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('navigation'),'idnavigation');
		$data['content'] = 'menusettings/addthirdmenu';
		$data['meta'] = 'menusettings/meta';
		$data['css'] = 'menusettings/css';
		$data['js'] = 'menusettings/js';
		$this->load->view('template/template',$data);
	}
	
	public function editmainmenu($idnavcategory)
	{
		$data['menuname'] = "Edit Menu Utama";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idnavcategory'] = $idnavcategory;
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datanavcategory']=$this->model_siloupi->ambildataById($this->db->dbprefix('navcategory'),'idnavcategory',$data['idnavcategory']);
		$data['content'] = 'menusettings/editmainmenu';
		$data['meta'] = 'menusettings/meta';
		$data['css'] = 'menusettings/css';
		$data['js'] = 'menusettings/js';
		$this->load->view('template/template',$data);
	}
	
	public function editsecondmenu($idnavigation)
	{
		$data['menuname'] = "Edit Menu Kedua";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idnavigation'] = $idnavigation;
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datanavcategory']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('navcategory'),'idnavcategory');
		$data['datanavigation']=$this->model_siloupi->ambildataById($this->db->dbprefix('navigation'),'idnavigation',$data['idnavigation']);
		$data['content'] = 'menusettings/editsecondmenu';
		$data['meta'] = 'menusettings/meta';
		$data['css'] = 'menusettings/css';
		$data['js'] = 'menusettings/js';
		$this->load->view('template/template',$data);
	}
	
	public function editthirdmenu($idsubnavigation)
	{
		$data['menuname'] = "Edit Menu Kedua";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idsubnavigation'] = $idsubnavigation;
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datanavigation']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('navigation'),'idnavigation');
		$data['datasubnavigation']=$this->model_siloupi->ambildataById($this->db->dbprefix('subnavigation'),'idsubnavigation',$data['idsubnavigation']);
		$data['content'] = 'menusettings/editthirdmenu';
		$data['meta'] = 'menusettings/meta';
		$data['css'] = 'menusettings/css';
		$data['js'] = 'menusettings/js';
		$this->load->view('template/template',$data);
	}
	
	public function savenavkategori()
    {
		$idusers = $this->session->userdata('idusers');
		$data=array(	
			'idusers'=>$idusers,
			'menu'=>$this->input->post('menu'),
			'icon'=>$this->input->post('icon')
		);
		$this->model_siloupi->simpandata($this->db->dbprefix('navcategory'),$data);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_save')
		);	
		echo json_encode($msg);
	}

	public function updatenavkategori()
    {
		$idnavcategory=$this->input->post('idnavcategory');
		$data=array(	
			'menu'=>$this->input->post('menu'),
			'icon'=>$this->input->post('icon')
		);
		$clause=array('idnavcategory'=>$idnavcategory);
		$this->model_siloupi->update($this->db->dbprefix('navcategory'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_edit')
		);	
		echo json_encode($msg);
	}	
	
	function deletenavkategori()
    {
        $idnavcategory=$this->input->post('idnavcategory');
		$this->db->where('idnavcategory', $idnavcategory);
        $this->db->delete($this->db->dbprefix('navcategory'));
        $msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_delete')
		);	
		echo json_encode($msg);
    }

	public function savenavigasi()
    {
		$idusers = $this->session->userdata('idusers');
		$data=array(	
			'idusers'=>$idusers,
			'idnavcategory '=>$this->input->post('idnavcategory'),
			'navigation'=>$this->input->post('navigation'),
			'icon'=>$this->input->post('icon'),
			'link'=>$this->input->post('link')
		);
		$this->model_siloupi->simpandata($this->db->dbprefix('navigation'),$data);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_save')
		);	
		echo json_encode($msg);
	}	

	public function updatenavigasi()
    {
		$idnavigation=$this->input->post('idnavigation');
		$idusers = $this->session->userdata('idusers');
		$data=array(	
			'idusers'=>$idusers,
			'idnavcategory '=>$this->input->post('idnavcategory'),
			'navigation'=>$this->input->post('navigation'),
			'icon'=>$this->input->post('icon'),
			'link'=>$this->input->post('link')
		);
		$clause=array('idnavigation'=>$idnavigation);
		$this->model_siloupi->update($this->db->dbprefix('navigation'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_edit')
		);	
		echo json_encode($msg);
	}	
	
	function deletenavigasi()
    {
        $idnavigation=$this->input->post('idnavigation');
		$this->db->where('idnavigation', $idnavigation);
        $this->db->delete($this->db->dbprefix('navigation'));
        $msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_delete')
		);	
		echo json_encode($msg);
    }
	
	public function savesubnavigasi()
    {
		$idusers = $this->session->userdata('idusers');
		$data=array(	
			'idusers'=>$idusers,
			'idnavigation'=>$this->input->post('idnavigation'),
			'subnavigation'=>$this->input->post('subnavigation'),
			'icon'=>$this->input->post('icon'),
			'link'=>$this->input->post('link')
		);
		$this->model_siloupi->simpandata($this->db->dbprefix('subnavigation'),$data);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_save')
		);	
		echo json_encode($msg);
	}
	
	public function updatesubnavigasi()
    {
		$idsubnavigation=$this->input->post('idsubnavigation');
		$idusers = $this->session->userdata('idusers');
		$data=array(	
			'idusers'=>$idusers,
			'idnavigation'=>$this->input->post('idnavigation'),
			'subnavigation'=>$this->input->post('subnavigation'),
			'icon'=>$this->input->post('icon'),
			'link'=>$this->input->post('link')
		);
		$clause=array('idsubnavigation'=>$idsubnavigation);
		$this->model_siloupi->update($this->db->dbprefix('subnavigation'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_edit')
		);	
		echo json_encode($msg);
	}
	
	function deletesubnavigasi()
    {
        $idsubnavigation=$this->input->post('idsubnavigation');
		$this->db->where('idsubnavigation', $idsubnavigation);
        $this->db->delete($this->db->dbprefix('subnavigation'));
        $this->session->set_flashdata('msg_success',lang('delete_success'));			
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_delete')
		);	
		echo json_encode($msg);
    }
	
}
