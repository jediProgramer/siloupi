<?php
	require_once APPPATH."models/Model_siloupi.php";
    class Courses_model extends Model_siloupi
	{
		private $table = 'courses';
		private $primary = 'idcourses';

		function __construct()
		{
			parent::__construct();
		}
		
		// New Function Here!
		
		public function getUserData($idUser)
		{
			$dataUser = parent::ambildataById($this->db->dbprefix('users'), 'idusers', $idUser);
			return $dataUser;
		} 

		public function getCurriculum($prodi){
			$this->db->select('idcurriculum');
			$this->db->distinct();
			$this->db->where('idprograme', $prodi);
			$this->db->from($this->db->dbprefix('curriculum'));
			$database = $this->db->get()->result_array();
			
			$data = array_map (function($value){
				return $value['idcurriculum'];
			}, $database);
			return $data;
		}

		public function getAllDataByProdi($prodi)
		{
			$curriculum = $this->getCurriculum($prodi);
			$this->db->select('*');
			$this->db->from($this->db->dbprefix($this->table));
			$this->db->where_in('idcurriculum', $curriculum);
			$data = $this->db->get()->result_array();
			return $data;
		}

		public function save($data)
		{
			parent::simpandata($this->db->dbprefix($this->table),$data);
		}

		public function delete($key_1, $value_1, $key_2, $value_2)
		{
			$this->db->where($key_1, $value_1);
			$this->db->where($key_2, $value_2);
			$this->db->delete($this->db->dbprefix($this->table));
		}

		public function deleteById($id)
		{
		}
	}
?>
