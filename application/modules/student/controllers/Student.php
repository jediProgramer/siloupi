<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student extends CI_Controller {
	private $namespace = 'student';
	private $model_name = 'student_model'; 

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
		$data = $this->initView("Entri Data Mahasiswa");
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
		$data = $this->initView("Impor Data Mahasiswa");
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
        $sheet->setCellValue('A1', 'nim'); 
        $sheet->setCellValue('B1', 'idprograme'); 
        $sheet->setCellValue('C1', 'name');
        $sheet->setCellValue('D1', 'status');
        $sheet->setCellValue('E1', 'class_generation');
        $sheet->setCellValue('F1', 'idlevel');
        $sheet->setCellValue('G1', 'idfaculty');
        $sheet->setCellValue('H1', 'graduation_date');
        $sheet->setCellValue('I1', 'gpa');

		$i = 2;
		foreach ($data as $d) {
			$sheet->setCellValue('A'.$i, $d['nim']); 
			$sheet->setCellValue('B'.$i, $d['idprograme']); 
			$sheet->setCellValue('C'.$i, $d['name']);
			$sheet->setCellValue('D'.$i, $d['status']);
			$sheet->setCellValue('E'.$i, $d['class_generation']);
			$sheet->setCellValue('F'.$i, $d['idlevel']);
			$sheet->setCellValue('G'.$i, $d['idfaculty']);
			$sheet->setCellValue('H'.$i, $d['graduation_date']);
			$sheet->setCellValue('I'.$i, $d['gpa']);
			$i++;
		}
        
        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = $this->namespace; // set filename for excel file to be exported
 
        header('Content-Type: application/excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 
	}

	function template()
	{
		$spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet(); // instantiate Spreadsheet
        $sheet = $spreadsheet->getActiveSheet();

        // manually set table data value
        $sheet->setCellValue('A1', 'nim'); 
        $sheet->setCellValue('B1', 'idprograme'); 
        $sheet->setCellValue('C1', 'name');
        $sheet->setCellValue('D1', 'status');
        $sheet->setCellValue('E1', 'class_generation');
        $sheet->setCellValue('F1', 'idlevel');
        $sheet->setCellValue('G1', 'idfaculty');

        $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet); // instantiate Xlsx
 
        $filename = 'template_'.$this->namespace; // set filename for excel file to be exported
 
        header('Content-Type: application/excel'); // generate excel file
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');	// download file 
	}
	
	function import(){
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

			try{
				if($sheetData[0][0] == 'nim'){
					for ($i=1; $i < count($sheetData); $i++) { 
						$data=array(	
							'nim' => $sheetData[$i][0],
							'idprograme' => $sheetData[$i][1],
							'name' => $sheetData[$i][2],
							'status' => $sheetData[$i][3],
							'class_generation' => $sheetData[$i][4],
							'idlevel' => $sheetData[$i][5],
							'idfaculty' => $sheetData[$i][6],
							'graduation_date' => $sheetData[$i][7],
							'gpa' => $sheetData[$i][8]
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
			}catch(\Exception $th){
				$msg=array(	
					'msg'=>'false',
					'msg_error'=>lang('error_message_format')
				);
				echo json_encode($msg);	
			}
			

		}
	}

	function getapi(){
		header('X-Accel-Buffering: no');
		set_time_limit(0);
		// $cmd = "java -jar ETLMahasiswa.jar";
		$cmd = "java -jar Debug.jar 7";

		// CARA 1 (SERVER ONLY)
			$descriptorspec = array(
			   0 => array("pipe", "r"),   // stdin is a pipe that the child will read from
			   1 => array("pipe", "w"),   // stdout is a pipe that the child will write to
			   2 => array("pipe", "w")    // stderr is a pipe that the child will write to
			);
			flush();
			$process = proc_open($cmd, $descriptorspec, $pipes, realpath('./'), array());
			echo "<pre>";
			if (is_resource($process)) {
				while ($s = fgets($pipes[1])) {
					print $s;
					flush();
				}
			}
			echo "</pre>";
		
		// CARA 2
			// while (@ ob_end_flush()); // end all output buffers if any

			// $proc = popen($cmd, 'r');
			// echo '<pre>';
			// while (!feof($proc))
			// {
			// 	echo fread($proc, 4096);
			// 	@ flush();
			// }
			// echo '</pre>';
		// CARA 3 (SERVER ONLY)
			// $result = $this->shell->liveExecuteCommand($cmd);
			// if($result['exit_status'] === 0){
			//  } else {
			// 	echo '<br><p id="success">Program Tidak Berhasil</p>';
			//  }
		echo '<br><p id="success">Program Berhasil</p>';

	}

	function phpini(){
		phpinfo();
	}
}
