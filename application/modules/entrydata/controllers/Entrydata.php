<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Entrydata extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('logged_in')) {
			redirect(base_url('auth'));
		}
		$this->autoloader_psr4->register();
		$this->autoloader_psr4->addNamespace('Psr\SimpleCache', APPPATH . 'third_party/SimpleCache');
		$this->autoloader_psr4->addNamespace('MyCLabs\Enum', APPPATH . 'third_party/MyCLabs');
		$this->autoloader_psr4->addNamespace('ZipStream', APPPATH . 'third_party/ZipStream');
		$this->autoloader_psr4->addNamespace('PhpOffice\PhpSpreadsheet', APPPATH . 'third_party/PhpSpreadsheet');
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
		$queryimg = $this->db->query("SELECT profilepicture, idinstitution FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		$data['idinstitution'] = $row->idinstitution;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datacurriculum']=$this->model_siloupi->ambildataOrderById($this->db->dbprefix('curriculum'),'idcurriculum','idprograme',$data['idinstitution']);
		$data['content'] = 'entrydata/addplo';
		$data['meta'] = 'entrydata/meta';
		$data['css'] = 'entrydata/css';
		$data['js'] = 'entrydata/js';
		$this->load->view('template/template',$data);
	}

	public function addmappingplo($idcurriculum)
	{
		
		//Tampilkan ID Curriculum
		$data['idcurriculum'] = $idcurriculum;
		//END
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
		$queryplo = $this->db->query("SELECT idplo FROM ".$this->db->dbprefix('plo')." WHERE idprograme='".$data['idinstitution']."' AND idcurriculum='".$data['idcurriculum']."' AND active=1");
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
		$queryimg = $this->db->query("SELECT profilepicture, idinstitution FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		$data['idinstitution'] = $row->idinstitution;
		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['dataplo']=$this->model_siloupi->ambildataById($this->db->dbprefix('plo'),'idplo',$data['idplo']);
		$data['datacurriculum']=$this->model_siloupi->ambildataOrderById($this->db->dbprefix('curriculum'),'idcurriculum','idprograme',$data['idinstitution']);
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
		$data['datalo']=$this->model_siloupi->ambildataByIdTwo($this->db->dbprefix('lo'),'idlo',$data['idlo'],'idplo',$data['idplo']);
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
			'idcurriculum'=>$this->input->post('idcurriculum'),
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
	
	function savelocsv()
	{
		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(isset($_FILES['filelo']['name']) && in_array($_FILES['filelo']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['filelo']['name']);
			$extension = end($arr_file);
			if('csv' == $extension){
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet = $reader->load($_FILES['filelo']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			
			if($sheetData[0][0] == 'idlo'){
				for ($i=1; $i < count($sheetData); $i++) { 
					$data=array(	
						'idlo' => $sheetData[$i][0],
						'lo' => $sheetData[$i][1],
						'idplo'=>$this->input->post('idplo')
					);
					$this->model_siloupi->simpandata($this->db->dbprefix('lo'),$data);
				}
				$msg=array(	
					'msg'=>'true',
					'msg_success'=>lang('success_message_save')
				);
			}else{
				$msg=array(	
					'msg'=>'false',
					'msg_error'=>lang('msg_error')
				);
			}

			echo json_encode($msg);	
		}
	}

	public function savemappingplo()
    {
		//echo "<pre>";
		//print_r($_POST);
		//print_r(array_count_values($_POST));
		//echo "</pre>";
		//exit();
		$idcurriculum=$this->input->post('idcurriculum');
		$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('mappingplo')." WHERE idcurriculum='".$idcurriculum."'");
		if ($query->num_rows() >= 1)
		{
			$this->db->where('idcurriculum', $idcurriculum);
       		$this->db->delete($this->db->dbprefix('mappingplo'));
		}
		$datalo=$this->input->post("lo");
		foreach ($datalo as $dlo)
		{
			$pieces= explode("-",$dlo);
				$data=array(	
					'idcourses'=>$pieces[0],
					'idlo'=>$pieces[1],
					'idcurriculum'=>$idcurriculum
				);
				$this->model_siloupi->simpandata($this->db->dbprefix('mappingplo'),$data);
		}
		$msg=array(	
			'msg'=>'true',
			'msg_success'=>lang('success_message_save')
		);
		echo json_encode($msg);	
	}

	public function updateplo()
    {
		$idplo=$this->input->post('idplo');
		$data=array(	
			'plo'=>$this->input->post('plo'),
			'idcurriculum'=>$this->input->post('idcurriculum')
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
		$idplo=$this->input->post('idplo');
		$idlo=$this->input->post('idlo');
		$data=array(	
			'lo'=>strip_tags($this->input->post('lo'))
		);
		$clause=array('idlo'=>$idlo,'idplo'=>$idplo);
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
        $idplo=$this->input->post('idplo');
		$idlo=$this->input->post('idlo');
		$this->db->where('idlo', $idlo);
		$this->db->where('idplo', $idplo);
        $this->db->delete($this->db->dbprefix('lo'));
        $msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_delete')
		);	
		echo json_encode($msg);
    }	

}
