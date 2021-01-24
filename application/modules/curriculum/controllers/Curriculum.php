<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Curriculum extends CI_Controller {

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
	
	public function index()
	{
		$data['menuname'] = "Entri Data Kurikulum";
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
		
		$prodi = $data['datauser'][0]['idinstitution'];

		$data['data'] = $this->model_siloupi->ambildataOrderById($this->db->dbprefix('curriculum'),'idcurriculum','idprograme', $prodi);
		$data['content'] = 'curriculum/listcurriculum';
		$data['meta'] = 'curriculum/meta';
		$data['css'] = 'curriculum/css';
		$data['js'] = 'curriculum/js';
		$this->load->view('template/template',$data);
	}

	public function addcurriculumcsv()
	{
		$data['menuname'] = "Tambah Data Kurikulum";
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
		$data['content'] = 'curriculum/addcurriculumcsv';
		$data['meta'] = 'curriculum/meta';
		$data['css'] = 'curriculum/css';
		$data['js'] = 'curriculum/js';
		$this->load->view('template/template',$data);
	}

	public function savecurriculumcsv()
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

	function deletecurriculum()
    {
        $idcurriculum = $this->input->post('idcurriculum');
		$this->db->where('idcurriculum', $idcurriculum);
        $this->db->delete($this->db->dbprefix('curriculum'));
        $msg=array(	
				'msg'=>'true',
				'msg_success'=>lang('success_message_delete')
		);	
		echo json_encode($msg);
    }	

	function export()
	{
		$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet(); // instantiate Spreadsheet

        $sheet = $spreadsheet->getActiveSheet();

        // manually set table data value
        $sheet->setCellValue('A1', 'Gipsy Danger'); 
        $sheet->setCellValue('A2', 'Gipsy Avenger');
        $sheet->setCellValue('A3', 'Striker Eureka');
        
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = 'list-of-jaegers'; // set filename for excel file to be exported
 
        header('Content-Type: application/vnd.ms-excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 
	}
	
	function import(){
		$inputFileName = (APPPATH) . '/01simple.xlsx';
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
		// method two
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		echo json_encode($sheetData);
		// $this->dumper->dd($sheetData);
	}

	function debug(){
		$data = $this->model_siloupi->ambildataOrderById($this->db->dbprefix('curriculum'),'idcurriculum','idprograme', 'D055');
		echo json_encode($data);
	}

	function cek(){
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
			// array_push($sheetData,['Data 1' => $sheetData[0][1], 'Data 2' => $sheetData[1][0] ]);
			echo json_encode($sheetData);
		}
	}
}
