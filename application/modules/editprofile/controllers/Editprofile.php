<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editprofile extends CI_Controller {

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
		$data['menuname'] = "Edit Profile";
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
		$data['content'] = 'editprofile/content';
		$data['meta'] = 'editprofile/meta';
		$data['css'] = 'editprofile/css';
		$data['js'] = 'editprofile/js';
		$this->load->view('template/template',$data);
	}
	
	public function updateusers()
    {
		$idusers=$this->input->post('idusers');
		if($this->input->post('password')!="")
		{
			$data=array(		
					'fullname'=>$this->input->post('fullname'),
					'password'=>md5($this->input->post('password')),
					'email'=>$this->input->post('email'),
					'phoneno'=>$this->input->post('phoneno'),
			);
		}	
		else
		{
			$data=array(		
					'fullname'=>$this->input->post('fullname'),
					'email'=>$this->input->post('email'),
					'phoneno'=>$this->input->post('phoneno')
			);	
		}
		$clause=array('idusers'=>$idusers);
		$this->model_siloupi->update($this->db->dbprefix('users'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message')
		);	
		echo json_encode($msg);
	}
	
	public function savesprofilepicture()
    {
		$idusers = $this->session->userdata('idusers');
		
		$config['upload_path'] = './assets/files/users/';
		$config['allowed_types'] = 'png|jpg|jpeg';
		$config['max_size'] = '20480';
		$image = $_FILES['image']['name'];
		$this->load->library('upload', $config);
			
		if (!$this->upload->do_upload('image'))
		{
			$msg=array(	
				'msg'=>'false',
				'msg_error'=>lang('error_message_profilepicture')
			);
			echo json_encode($msg);
		}
		else
		{	
			$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$idusers."'");
			$row = $queryimg->row();
			if($row->profilepicture!="")
			{
				$picturepath="./assets/files/users/".$row->profilepicture;	
				unlink($picturepath);
			}
			
			$data=array(	
			'profilepicture'=>$image
			);
			
			$clause=array('idusers'=>$idusers);
			$this->model_siloupi->update($this->db->dbprefix('users'),$data,$clause);
			$msg=array(	
					'msg'=>'true',
					'msg_success'=>lang('success_message_profilepicture')
			);	
			echo json_encode($msg);
		}	
	}
	
}
