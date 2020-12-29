<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		$data['menuname'] = "Pengguna";
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
		$data['listusers']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('users'),'roles');
		$data['content'] = 'users/listusers';
		$data['meta'] = 'users/meta';
		$data['css'] = 'users/css';
		$data['js'] = 'users/js';
		$this->load->view('template/template',$data);
	}
	
	public function addusers()
	{
		$data['menuname'] = "Tambah Pengguna";
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
		$data['content'] = 'users/addusers';
		$data['meta'] = 'users/meta';
		$data['css'] = 'users/css';
		$data['js'] = 'users/js';
		$this->load->view('template/template',$data);
	}
	
	public function editusers($idusersweb)
	{
		$data['menuname'] = "Edit Pengguna";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idusersweb'] = $idusersweb;
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datauserweb']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusersweb']);
		$data['dataroles']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('roles'),'idroles');
		$data['content'] = 'users/editusers';
		$data['meta'] = 'users/meta';
		$data['css'] = 'users/css';
		$data['js'] = 'users/js';
		$this->load->view('template/template',$data);
	}
	
	public function institutionusers($idusersweb)
	{
		$data['menuname'] = "Home Base Pengguna";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idusersweb'] = $idusersweb;
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datauserweb']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusersweb']);
		$data['datafaculty']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('faculty'),'idfaculty');
		$data['datadepartement']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('departement'),'iddepartement');
		$data['dataprograme']=$this->model_siloupi->ambildataOrder($this->db->dbprefix('programe'),'idprograme');
		$data['content'] = 'users/institutionusers';
		$data['meta'] = 'users/meta';
		$data['css'] = 'users/css';
		$data['js'] = 'users/js';
		$this->load->view('template/template',$data);
	}
	
	public function saveusers()
    {
		$addby = $this->session->userdata('idusers');
		$tgl=date('y-m-d');
		$pieces= explode("-",$tgl);
		$rand = substr(md5(microtime()),rand(0,26),5);
		$idusers="u".$pieces[0].$pieces[1].$rand;
		
		$querypostion = $this->db->query("SELECT idposition FROM ".$this->db->dbprefix('roles')." WHERE idroles='".$this->input->post('roles')."'");
		$row = $querypostion->row();
		$idposition= $row->idposition;
		
		$queryjobs = $this->db->query("SELECT position FROM ".$this->db->dbprefix('position')." WHERE idposition='".$idposition."'");
		$row = $queryjobs->row();
		$jobs= $row->position;
		
		$data=array(
			'idusers'=>$idusers,		
			'nip'=>$this->input->post('nip'),
			'fullname'=>$this->input->post('fullname'),
			'lecturercode'=>$this->input->post('lecturercode'),
			'email'=>$this->input->post('email'),
			'password'=>md5('12345'),
			'jobs'=>$jobs,
			'active'=>$this->input->post('active'),
			'roles'=>$this->input->post('roles'),
			'addby'=>$addby,
		);
		$this->model_siloupi->simpandata($this->db->dbprefix('users'),$data);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_save')
		);
		echo json_encode($msg);		
	}	
	
	public function saveseditusers()
    {
		$idusersweb=$this->input->post('idusersweb');
		$addby = $this->session->userdata('idusers');
		
		$querypostion = $this->db->query("SELECT idposition FROM ".$this->db->dbprefix('roles')." WHERE idroles='".$this->input->post('roles')."'");
		$row = $querypostion->row();
		$idposition= $row->idposition;
		
		$queryjobs = $this->db->query("SELECT position FROM ".$this->db->dbprefix('position')." WHERE idposition='".$idposition."'");
		$row = $queryjobs->row();
		$jobs= $row->position;
		
		$data=array(
			'nip'=>$this->input->post('nip'),
			'fullname'=>$this->input->post('fullname'),
			'lecturercode'=>$this->input->post('lecturercode'),
			'email'=>$this->input->post('email'),
			'jobs'=>$jobs,
			'active'=>$this->input->post('active'),
			'roles'=>$this->input->post('roles'),
			'addby'=>$addby,
		);
		$clause=array('idusers'=>$idusersweb);
		$this->model_siloupi->update($this->db->dbprefix('users'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_edit')
		);	
		echo json_encode($msg);
	}	
	
	public function savesinstitutitonusers()
    {
		$idusersweb=$this->input->post('idusersweb');
		$addby = $this->session->userdata('idusers');
		
		$queryjobs = $this->db->query("SELECT jobs FROM ".$this->db->dbprefix('users')." WHERE idusers='".$idusersweb."'");
		$row = $queryjobs->row();
		$jobs= $row->jobs;
		
		if($jobs=="Admin Web SILO")
		{
			$institution="Direktorat TIK Universitas Pendidikan Indonesia";
			$idinstitution=777777;
		}
		else if($jobs=="Manajemen Rektorat")
		{
			$institution="Universitas Pendidikan Indonesia";
			$idinstitution=000001;
		}
		else if($jobs=="Manajemen Fakultas")
		{
			$queryinstitution = $this->db->query("SELECT faculty FROM ".$this->db->dbprefix('faculty')." WHERE idfaculty='".$this->input->post('idinstitution')."'");
			$row = $queryinstitution->row();
			$institution= $row->faculty;
			$idinstitution=$this->input->post('idinstitution');
		}
		else if($jobs=="Manajemen Departemen")
		{
			$queryinstitution = $this->db->query("SELECT departement FROM ".$this->db->dbprefix('departement')." WHERE iddepartement='".$this->input->post('idinstitution')."'");
			$row = $queryinstitution->row();
			$institution= $row->departement;
			$idinstitution=$this->input->post('idinstitution');
		}
		else if(($jobs=="Manajemen Prodi") || ($jobs=="Tenaga Pengajar"))
		{
			$queryinstitution = $this->db->query("SELECT programe FROM ".$this->db->dbprefix('programe')." WHERE idprograme='".$this->input->post('idinstitution')."'");
			$row = $queryinstitution->row();
			$institution= $row->programe;
			$idinstitution=$this->input->post('idinstitution');
		}
		
		$data=array(
			'institution'=>$institution,
			'idinstitution'=>$idinstitution,
			'addby'=>$addby,
		);
		$clause=array('idusers'=>$idusersweb);
		$this->model_siloupi->update($this->db->dbprefix('users'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_institution')
		);	
		echo json_encode($msg);
	}	
	
}
