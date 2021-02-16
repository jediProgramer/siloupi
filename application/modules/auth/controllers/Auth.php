<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->helper(array('form','url'));
		$this->load->helper('text');
		$this->load->model('model_login');
		$this->load->model('model_siloupi');
		// Load default language
		$this->lang->load('text_lang', 'indonesia');
	}
	
	public function index()
	{
		//print_r($this->session->all_userdata());
		$this->load->view('login');
	}
	
	public function loginprocess()
	{
		$this->load->library('user_agent');
		$nip=$this->input->post('nip');
		$password=md5($this->input->post('password'));
		
		$this->load->model('model_login','',TRUE);
		$cekdata=$this->model_login->ceklogin($this->db->dbprefix('users'),$nip,$password,'1');
		if($cekdata)
		{
			foreach ($cekdata as $datalogin)
			{
				$idusers=$datalogin['idusers'];
				$fullname=$datalogin['fullname'];
				$nip=$datalogin['nip'];
				$idinstitution=$datalogin['idinstitution'];
				$email=$datalogin['email'];
				$roles=$datalogin['roles'];
				$profilepicture=$datalogin['profilepicture'];
			}
			
			$dlogin=array(
				'idusers'=>$idusers,
				'nip'=>$nip,
				'fullname'=>$fullname,
				'roles'=>$roles,
				'email'=>$email,
				'profilepicture'=>$profilepicture,
				'session_id'=>date('Y-m-d H:i:s'),				
				'login_time'=>date('Y-m-d H:i:s'),
				'logged_in'=>true,
				'last_act_time'=>date('Y-m-d H:i:s')
			);
			
			$this->user_logs=array(
				'idusers'=>$idusers,					
				'nip'=>$nip,					
				'session_id'=>date('Y-m-d H:i:s'),
				'browser'=>$this->agent->browser(),
				'log_addr'=>$this->input->ip_address(),					
				'login_time'=>date('Y-m-d H:i:s'),
				'last_act_time'=>date('Y-m-d H:i:s')
			);
			$this->model_siloupi->simpandata($this->db->dbprefix('userlogs'),$this->user_logs);
			$clause=array('idusers'=>$idusers);
			$data=array(
				'login'=>'1'
			);
			$this->model_siloupi->update($this->db->dbprefix('users'),$data,$clause);
			
			$datainstitution=array(
				'idinstitution'=>$idinstitution
			);

			$this->session->set_userdata($datainstitution);
			$this->session->set_userdata($dlogin);
			//redirect(site_url('dashboard'));
			
			$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_login')
			);
			echo json_encode($msg);
		}
		else
		{
			//$this->session->set_flashdata('msg1','Username dan password salah');
			//redirect(site_url('auth'));
			$msg=array(	
				'msg'=>'false',
				'msg_error'=>lang('error_message_login')
			);
			echo json_encode($msg);
		}	
	}
	
	public function logout()
	{
		$idusers=$this->session->userdata('idusers');
		$clause=array('idusers'=>$idusers);
		$data=array(
			'login'=>'0'
		);
		$this->model_siloupi->update($this->db->dbprefix('users'),$data,$clause);
		
		$dlogin=array(
					'idusers'=>'',
					'nip'=>'',
					'fullname'=>'',
					'roles'=>'',
					'email'=>'',
					'profilepicture'=>'',
					'session_id'=>'',				
					'login_time'=>'',
					'logged_in'=>false,
					'last_act_time'=>''
				);
		$session_id=$this->session->userdata('session_id');
		$data=array('logout_time'=>date('Y-m-d H:i:s'),'session_id'=>$session_id);
		$clause=array('session_id'=>$session_id);
		if($this->model_siloupi->update($this->db->dbprefix('userlogs'),$data,$clause))
		{		
			$this->session->unset_userdata($dlogin);
			$this->session->sess_destroy();
			$this->session->set_flashdata('msg3','Anda telah keluar dari sistem');			
			redirect(site_url('auth'));
		}	
	}
	
}
