<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends CI_Controller {

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
		$data['menuname'] = "Kelola Hak Akses";
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
		$data['content'] = 'permissions/listpermissions';
		$data['meta'] = 'permissions/meta';
		$data['css'] = 'permissions/css';
		$data['js'] = 'permissions/js';
		$this->load->view('template/template',$data);
	}
	
	public function addpermissions($idroles)
	{
		$data['menuname'] = "Tambah Peran";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idroles'] = $idroles;
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datarolesglobal']=$this->model_siloupi->ambildataById($this->db->dbprefix('roles'),'idroles',$data['idroles']);
		$data['content'] = 'permissions/addpermissions';
		$data['meta'] = 'permissions/meta';
		$data['css'] = 'permissions/css';
		$data['js'] = 'permissions/js';
		$this->load->view('template/template',$data);
	}
	
	public function savepermissions() 
	{
		$idroles=$this->input->post('idroles');
		$queryz = $this->db->query("SELECT * FROM ".$this->db->dbprefix('permissions')." WHERE idroles='".$idroles."'");
		if ($queryz->num_rows() >= 1)
		{
			$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('navigation')."");
			$datanav=$query->result();
			foreach ($datanav as $dn)
			{
				$queryz = $this->db->query("SELECT * FROM ".$this->db->dbprefix('subnavigation')." WHERE idnavigation='$dn->idnavigation'");
				if ($queryz->num_rows() >= 1)
				{
					
					$datasubnav=$queryz->result();
					foreach ($datasubnav as $dsn)
					{
						$data=array(	
						'idnavcategory'=>$this->input->post("idnavcategorysparent$dn->idnavigation"),
						'idnavigation'=>$this->input->post("idnavigationsparent$dn->idnavigation"),
						'idsubnavigation'=>$this->input->post("idsunavigationchild$dsn->idsubnavigation"),
						'users_access'=>$this->input->post("permissionschild$dsn->idsubnavigation")
						);
						$clause=array('idsubnavigation'=>$dsn->idsubnavigation,'idroles'=>$idroles);
						$this->model_siloupi->update($this->db->dbprefix('permissions'),$data,$clause);
					}
				}
				else
				{	
					$data=array(	
						'idnavcategory'=>$this->input->post("idnavcategorysparent$dn->idnavigation"),
						'idnavigation'=>$this->input->post("idnavigationsparent$dn->idnavigation"),
						'idsubnavigation'=>0,
						'users_access'=>$this->input->post("permissionsparent$dn->idnavigation")
					);
					$clause=array('idnavigation'=>$dn->idnavigation,'idroles'=>$idroles);
					$this->model_siloupi->update($this->db->dbprefix('permissions'),$data,$clause);
				}	
			}
		}
		else
		{
			
			//Add Dahboard Menu
			$data=array(	
				'idroles'=>$idroles,
				'idnavcategory'=>1,
				'idnavigation'=>0,
				'idsubnavigation'=>0,
				'users_access'=>1
			);
			$this->model_siloupi->simpandata($this->db->dbprefix('permissions'),$data);
			
			$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('navigation')."");
			$datanav=$query->result();
			foreach ($datanav as $dn)
			{
				$queryz = $this->db->query("SELECT * FROM ".$this->db->dbprefix('subnavigation')." WHERE idnavigation='$dn->idnavigation'");
				if ($queryz->num_rows() >= 1)
				{
					
					$datasubnav=$queryz->result();
					foreach ($datasubnav as $dsn)
					{
						$data=array(	
						'idroles'=>$idroles,
						'idnavcategory'=>$this->input->post("idnavcategorysparent$dn->idnavigation"),
						'idnavigation'=>$this->input->post("idnavigationsparent$dn->idnavigation"),
						'idsubnavigation'=>$this->input->post("idsunavigationchild$dsn->idsubnavigation"),
						'users_access'=>$this->input->post("permissionschild$dsn->idsubnavigation")
						);
						$this->model_siloupi->simpandata($this->db->dbprefix('permissions'),$data);
					}
				}
				else
				{	
					$data=array(	
						'idroles'=>$idroles,
						'idnavcategory'=>$this->input->post("idnavcategorysparent$dn->idnavigation"),
						'idnavigation'=>$this->input->post("idnavigationsparent$dn->idnavigation"),
						'idsubnavigation'=>0,
						'users_access'=>$this->input->post("permissionsparent$dn->idnavigation")
					);
					$this->model_siloupi->simpandata($this->db->dbprefix('permissions'),$data);
				}	
			}
		}
		$this->session->set_flashdata('msg_success',lang('success_message_save'));	
		redirect(site_url('permissions'));
	}
	
}
