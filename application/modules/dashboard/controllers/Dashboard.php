<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
		//print_r($this->session->all_userdata());
		$data['menuname'] = "Dashboard";
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
		$data['content'] = 'dashboard/content';
		$data['meta'] = 'dashboard/meta';
		$data['css'] = 'dashboard/css';
		$data['js'] = 'dashboard/js';
		$this->load->view('template/template',$data);
	}
	
}
