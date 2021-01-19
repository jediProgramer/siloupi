<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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

	function years()
	{
		$now=date('Y');
		$show="<select id='years' name='years' class='form-control'>";
		$show.="<option value='0'>".lang('chose_year')."</option>";
		for ($a=2018;$a<=$now;$a++)
		{
			$show.="<option value='$a'>$a</option>";
		}
		$show.="</select>";	
		return $show;
	}
	
	function searchlookupstudents()
	{
		if (isset($_GET['term'])) {
		  	$result = $this->model_siloupi->search_students($_GET['term']);
			if (count($result) > 0) 
			{
		    	foreach ($result as $row)
		     	$arr_result[] = array(
					'label'=> ucwords(strtolower($row->name)),
				);
		     	echo json_encode($arr_result);
		   	}
		}
	}

	function getstudents()
	{
		// Tampilkan Profile
		$idusers = $this->session->userdata('idusers');
		$queryimg = $this->db->query("SELECT institution FROM ".$this->db->dbprefix('users')." WHERE idusers='".$idusers."'");
		$row = $queryimg->row();
		$institution = $row->institution;

		// Tampilkan ID Departement
		$queryprograme = $this->db->query("SELECT idprograme FROM ".$this->db->dbprefix('programe')." WHERE programe='".$institution."'");
		$rowprograme = $queryprograme->row();
		$idprograme = $rowprograme->idprograme;
		

		$years = $this->input->post('years',TRUE);
		$data = $this->model_siloupi->get_data($years,$idprograme,$this->db->dbprefix('student'),'class_generation','idprograme');
        if (count($data) > 0) 
		{
			foreach ($data as $row)
			$arr_result[] = array(
				'nim'=> $row->nim,
				'name'=> ucwords(strtolower($row->name)),
			);
			echo json_encode($arr_result);
		}
    }
	
	public function lostudentsprograme()
	{
		$data['menuname'] = "Laporan Learning Outcomes Mahasiswa";
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
		$data['years'] = $this->years();
		$data['content'] = 'reports/reportlostudents';
		$data['meta'] = 'reports/meta';
		$data['css'] = 'reports/css';
		$data['js'] = 'reports/js_reportlostudents';
		$this->load->view('template/template',$data);
	}

	public function loclassgenerationprograme()
	{
		$data['menuname'] = "Laporan Learning Outcomes Perangkatan";
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
		$data['years'] = $this->years();
		$data['content'] = 'reports/reportloclassgeneration';
		$data['meta'] = 'reports/meta';
		$data['css'] = 'reports/css';
		$data['js'] = 'reports/js_reportloclassgeneration';
		$this->load->view('template/template',$data);
	}

	public function lostudentsprogrameresult()
	{
		$data['nim']=$this->input->post('studentnim');
		$data['menuname'] = "Laporan Learning Outcomes Mahasiswa";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');

		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture, institution FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		$data['institution'] = $row->institution;

		// Tampilkan ID Departement
		$queryprograme = $this->db->query("SELECT idprograme FROM ".$this->db->dbprefix('programe')." WHERE programe='".$data['institution']."'");
		$rowprograme = $queryprograme->row();
		$data['idprograme'] = $rowprograme->idprograme;

		// Tampilkan ID PLO
		$queryplo = $this->db->query("SELECT idplo FROM ".$this->db->dbprefix('plo')." WHERE idprograme='".$data['idprograme']."'");
		$rowplo = $queryplo->row();
		$data['idplo'] = $rowplo->idplo;

		// Tampilkan ID Curriculum
		$querycurriculum = $this->db->query("SELECT idcurriculum FROM ".$this->db->dbprefix('curriculum')." WHERE idprograme='".$data['idprograme']."'");
		$rowcurriculum = $querycurriculum->row();
		$data['idcurriculum'] = $rowcurriculum->idcurriculum;

		// Tampilkan Total LO
		$querytlo = $this->db->query("SELECT COUNT(*) AS totallo FROM ".$this->db->dbprefix('lo')." WHERE idplo='".$data['idplo']."'");
		$rowtlo = $querytlo->row();
		$data['totallo'] = $rowtlo->totallo;

		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datastudent']=$this->model_siloupi->ambildataById($this->db->dbprefix('student'),'nim',$data['nim']);
		$data['datalo']=$this->model_siloupi->ambildataOrderById($this->db->dbprefix('lo'),'idlo','idplo',$data['idplo']);
		$data['years'] = $this->years();
		$data['content'] = 'reports/reportlostudents_result';
		$data['reportlostudentscharts'] = 'reports/reportlostudents_charts';
		$data['meta'] = 'reports/meta';
		$data['css'] = 'reports/css';
		$data['js'] = 'reports/js_reportlostudents_result';
		$this->load->view('template/template',$data);
	}

	public function loclassgenerationprogrameresult()
	{
		$data['class_generation']=$this->input->post('years');
		$data['menuname'] = "Laporan Learning Outcomes Perangkatan";
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');

		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture, institution FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		$data['institution'] = $row->institution;

		// Tampilkan ID Departement
		$queryprograme = $this->db->query("SELECT idprograme FROM ".$this->db->dbprefix('programe')." WHERE programe='".$data['institution']."'");
		$rowprograme = $queryprograme->row();
		$data['idprograme'] = $rowprograme->idprograme;

		// Tampilkan ID PLO
		$queryplo = $this->db->query("SELECT idplo FROM ".$this->db->dbprefix('plo')." WHERE idprograme='".$data['idprograme']."'");
		$rowplo = $queryplo->row();
		$data['idplo'] = $rowplo->idplo;

		// Tampilkan ID Curriculum
		$querycurriculum = $this->db->query("SELECT idcurriculum FROM ".$this->db->dbprefix('curriculum')." WHERE idprograme='".$data['idprograme']."'");
		$rowcurriculum = $querycurriculum->row();
		$data['idcurriculum'] = $rowcurriculum->idcurriculum;

		// Tampilkan Total LO
		$querytlo = $this->db->query("SELECT COUNT(*) AS totallo FROM ".$this->db->dbprefix('lo')." WHERE idplo='".$data['idplo']."'");
		$rowtlo = $querytlo->row();
		$data['totallo'] = $rowtlo->totallo;

		// End
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		$data['datauser']=$this->model_siloupi->ambildataById($this->db->dbprefix('users'),'idusers',$data['idusers']);
		$data['datalo']=$this->model_siloupi->ambildataOrderById($this->db->dbprefix('lo'),'idlo','idplo',$data['idplo']);
		$data['years'] = $this->years();
		$data['content'] = 'reports/reportloclassgeneration_result';
		$data['reportloclassgenerationcharts'] = 'reports/reportloclassgeneration_charts';
		$data['meta'] = 'reports/meta';
		$data['css'] = 'reports/css';
		$data['js'] = 'reports/js_reportloclassgeneration_result';
		$this->load->view('template/template',$data);
	}
	
}
