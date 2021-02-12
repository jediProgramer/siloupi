<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Curriculum extends CI_Controller {
	private $namespace = 'curriculum';
	private $model_name = 'curriculum_model'; 

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
		$this->load->model($this->model_name,'model');
		// Load default language
		$this->lang->load('text_lang', 'indonesia');
	}

	private function initView($menuname)
	{
		$data['menuname'] = $menuname;
		$data['idusers'] = $this->session->userdata('idusers');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['nip'] = $this->session->userdata('nip');
		$data['roles'] = $this->session->userdata('roles');
		// Tampilkan Profile Picture
		$queryimg = $this->db->query("SELECT profilepicture FROM ".$this->db->dbprefix('users')." WHERE idusers='".$data['idusers']."'");
		$row = $queryimg->row();
		$data['profilepicture'] = $row->profilepicture;
		// End
		$data['namespace'] = $this->namespace;

		return $data;
	}
	
	public function index()
	{
		$data = $this->initView("Entri Data Kurikulum");
		$data['datauser'] = $this->model->getUserData($data['idusers']);
		
		$prodi = $data['datauser'][0]['idinstitution'];

		$data['data'] = $this->model->getAllDataByProdi($prodi);
		$data['content'] = $this->namespace.'/list';
		$data['meta'] = $this->namespace.'/meta';
		$data['css'] = $this->namespace.'/css';
		$data['js'] = $this->namespace.'/js';
		$this->load->view('template/template',$data);
	}

	public function addcsv()
	{
		$data = $this->initView("Impor Data Kurikulum");
		$data['datauser'] = $this->model->getUserData($data['idusers']);

		$data['content'] = $this->namespace.'/import';
		$data['meta'] = $this->namespace.'/meta';
		$data['css'] = $this->namespace.'/css';
		$data['js'] = $this->namespace.'/js';
		$this->load->view('template/template',$data);
	}

	function delete()
    {
        $id = $this->input->post('id');
		$this->model->deleteById($id);

        $msg=array(	
			'msg'=>'true',
			'msg_success'=>lang('success_message_delete')
		);	
		echo json_encode($msg);
    }	

	function export()
	{
		$idusers = $this->session->userdata('idusers');
		$datauser = $this->model->getUserData($idusers);
		$prodi = $datauser[0]['idinstitution'];

		$data = $this->model->getAllDataByProdi($prodi);

		$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet(); // instantiate Spreadsheet
        $sheet = $spreadsheet->getActiveSheet();

        // manually set table data value
        $sheet->setCellValue('A1', 'idcurriculum'); 
        $sheet->setCellValue('B1', 'idlevel');
        $sheet->setCellValue('C1', 'curriculum');
		$sheet->setCellValue('D1', 'idprograme');
		$i = 2;
		foreach ($data as $d) {
			$sheet->setCellValue('A'.$i, $d['idcurriculum']); 
			$sheet->setCellValue('B'.$i, $d['idlevel']);
			$sheet->setCellValue('C'.$i, $d['curriculum']);
			$sheet->setCellValue('D'.$i, $d['idprograme']);
			$i++;
		}
        
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = $this->namespace; // set filename for excel file to be exported
 
        header('Content-Type: application/excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 
	}
	
	function import(){
		$idusers = $this->session->userdata('idusers');
		$datauser = $this->model->getUserData($idusers);

		$prodi = $datauser[0]['idinstitution'];

		$file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
			$arr_file = explode('.', $_FILES['file']['name']);
			$extension = end($arr_file);
			if('csv' == $extension){
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet = $reader->load($_FILES['file']['tmp_name']);
			$sheetData = $spreadsheet->getActiveSheet()->toArray();
			
			if($sheetData[0][0] == 'idcurriculum'){
				for ($i=1; $i < count($sheetData); $i++) { 
					$data=array(	
						'idcurriculum' => $sheetData[$i][0],
						'idlevel' => $sheetData[$i][1],
						'curriculum' => $sheetData[$i][2],
						'idprograme' => $sheetData[$i][3]
					);
					$this->model->createOrUpdate($data);
				}
				$msg=array(	
					'msg'=>'true',
					'msg_success'=>lang('success_message_save')
				);
			}else{
				$msg=array(	
					'msg'=>'false',
					'msg_error'=>lang('error_message_format')
				);
			}

			echo json_encode($msg);	
		}
	}
}
