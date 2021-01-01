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
		$data['idplo'] = "";
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['dataplo']=$this->model_siloupi->ambildataOrderById($this->db->dbprefix('plo'),'idplo','idusers',$data['idusers']);
		$data['content'] = 'entrydata/listplo';
		$data['meta'] = 'entrydata/meta';
		$data['css'] = 'entrydata/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}
	
	public function mappingplo()
	{
		$data['menuname'] = "Pemetaan Data Program Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idplo'] = "";
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture, idinstitution FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		$data['idinstitution'] = $row->idinstitution;
		// End
		//Tampilkan Total LO
		$queryplo = $this->db->query("SELECT COUNT(*)AS totalplo FROM ".$this->db->dbprefix('plo')." WHERE idprograme='".$data['idinstitution']."' AND active=1");
		$rowplo = $queryplo->row();
		$data['totalplo'] = $rowplo->totalplo;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datacurriculum']=$this->model_siloupi->ambildataOrderById($this->db->dbprefix('curriculum'),'idcurriculum','idprograme',$data['idinstitution']);
		$data['content'] = 'entrydata/listmappingplo';
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
		$data['idplo'] = "";
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepictureFROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
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

	public function addmappingplo()
	{
		$data['menuname'] = "Tambah Pemetaan Data Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture, idinstitution FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		$data['idinstitution'] = $row->idinstitution;
		// End
		//Tampilkan PLO
		$queryplo = $this->db->query("SELECT idplo FROM ".$this->db->dbprefix('plo')." WHERE idprograme='".$data['idinstitution']."' AND active=1");
		$rowplo = $queryplo->row();
		$data['idplo'] = $rowplo->idplo;
		//End
		//Tampilkan Total LO
		$querylo = $this->db->query("SELECT COUNT(*)AS totallo FROM ".$this->db->dbprefix('lo')." WHERE idplo='".$data['idplo']."'");
		$rowlo = $querylo->row();
		$data['totallo'] = $rowlo->totallo;
		//End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		//Tampilkan ID Curriculum
		$queryc = $this->db->query("SELECT idcurriculum FROM ".$this->db->dbprefix('curriculum')." WHERE idprograme='".$data['idinstitution']."'");
		$rowc = $queryc->row();
		$data['idcurriculum'] = $rowc->idcurriculum;
		//End
		$data['datalo']=$this->model_siloupi->ambildataOrderById($this->db->dbprefix('lo'),'idlo','idplo',$data['idplo']);

		$data['content'] = 'entrydata/addmappingplo';
		$data['meta'] = 'entrydata/meta';
		$data['css'] = 'entrydata/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}

	public function addlo($idplo)
	{
		$data['menuname'] = "Tambah Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idplo'] = $idplo;
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['content'] = 'entrydata/addlo';
		$data['meta'] = 'entrydata/meta';
		$data['css'] = 'entrydata/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}

	public function addlocsv($idplo)
	{
		$data['menuname'] = "Tambah Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['idplo'] = $idplo;
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['content'] = 'entrydata/addlocsv';
		$data['meta'] = 'entrydata/meta';
		$data['css'] = 'entrydata/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}

	public function editplo($idplo)
	{
		$data['menuname'] = "Edit Program Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['idplo'] = $idplo;
		$data['fullname'] = $this->session->userdata('fullname');
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['dataplo']=$this->model_siloupi->ambildataById($this->db->dbprefix('plo'),'idplo',$data['idplo']);
		$data['content'] = 'entrydata/editplo';
		$data['meta'] = 'entrydata/meta';
		$data['css'] = 'entrydata/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}

	public function editlo($idplo,$idlo)
	{
		$data['menuname'] = "Edit Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['idplo'] = $idplo;
		$data['idlo'] = $idlo;
		$data['fullname'] = $this->session->userdata('fullname');
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datalo']=$this->model_siloupi->ambildataById($this->db->dbprefix('lo'),'idlo',$data['idlo']);
		$data['content'] = 'entrydata/editlo';
		$data['meta'] = 'entrydata/meta';
		$data['css'] = 'entrydata/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}

	public function detailplo($idplo)
	{
		$data['menuname'] = "Detail Program Learning Outcomes";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['idplo'] = $idplo;
		$data['fullname'] = $this->session->userdata('fullname');
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datalo']=$this->model_siloupi->ambildataOrderById($this->db->dbprefix('lo'),'idlo','idplo',$data['idplo']);
		$data['content'] = 'entrydata/listlo';
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

	public function savelo()
    {
		$data=array(	
			'idlo'=>$this->input->post('idlo'),
			'lo'=>strip_tags($this->input->post('lo')),
			'idplo'=>$this->input->post('idplo')
		);
		$this->model_siloupi->simpandata($this->db->dbprefix('lo'),$data);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_save')
		);
		echo json_encode($msg);		
	}
	
	public function savelocsv()
    {
		$max_row_size = 4096; 
		$separator = ';'; 
		$file = $_FILES['filelo']['tmp_name'];
		// Medapatkan ekstensi file csv yang akan diimport.
		$ekstensi  = explode('.', $_FILES['filelo']['name']);

		// Validasi apakah file yang diupload benar-benar file csv.
		if (strtolower(end($ekstensi)) === 'csv' && $_FILES["filelo"]["size"] > 0) {

			$i = 0;
			$handle = fopen($file, "r");
			while (($row = fgetcsv($handle, $max_row_size, $separator))) {
				$i++;
				if ($i == 1) continue;

				$data=array(	
					'idlo'=>$row[0],
					'lo'=>$row[1],
					'idplo'=>$this->input->post('idplo')
				);
				$this->model_siloupi->simpandata($this->db->dbprefix('lo'),$data);
			}

			fclose($handle);
			$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_save')
			);
			echo json_encode($msg);	

		} else {
			$msg=array(	
				'msg'=>'false',
				'msg_error'=>lang('error_message_csv')
			);
			echo json_encode($msg);
		}
	}

	public function updateplo()
    {
		$idplo=$this->input->post('idplo');
		$data=array(	
			'plo'=>$this->input->post('plo')
		);
		$clause=array('idplo'=>$idplo);
		$this->model_siloupi->update($this->db->dbprefix('plo'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_edit')
		);	
		echo json_encode($msg);
	}

	public function updatelo()
    {
		$idlo=$this->input->post('idlo');
		$data=array(	
			'lo'=>strip_tags($this->input->post('lo'))
		);
		$clause=array('idlo'=>$idlo);
		$this->model_siloupi->update($this->db->dbprefix('lo'),$data,$clause);
		$msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_edit')
		);	
		echo json_encode($msg);
	}

	public function activeplo()
    {
		$idplo=$this->input->post('idplo');
		$query = $this->db->query("SELECT active FROM ".$this->db->dbprefix('plo')." WHERE idplo='".$idplo."'");
		$row = $query->row();
		$active = $row->active;
		if($active==1)
		{	
			$data=array(	
				'active'=>0
			);
			$clause=array('idplo'=>$idplo);
			$this->model_siloupi->update($this->db->dbprefix('plo'),$data,$clause);
			$msg=array(	
					'msg'=>'true',
					'msg_success'=>lang('success_message_deactive_plo')
			);	
			echo json_encode($msg);
		}
		else
		{
			$data=array(	
				'active'=>1
			);
			$clause=array('idplo'=>$idplo);
			$this->model_siloupi->update($this->db->dbprefix('plo'),$data,$clause);
			$msg=array(	
					'msg'=>'true',
					'msg_success'=>lang('success_message_active_plo')
			);	
			echo json_encode($msg);
		}
	}

	function deletelo()
    {
        $idlo=$this->input->post('idlo');
		$this->db->where('idlo', $idlo);
        $this->db->delete($this->db->dbprefix('lo'));
        $msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_delete')
		);	
		echo json_encode($msg);
    }	

}
