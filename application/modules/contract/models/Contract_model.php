<?php
	require_once APPPATH."models/Model_siloupi.php";
    class Contract_model extends Model_siloupi
	{
		private $table = 'contract';
		private $primary = 'nim';

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

		public function getAllDataByProdi($prodi)
		{
			$data = parent::ambildataOrderById($this->db->dbprefix($this->table),$this->primary,'idprograme', $prodi);
			return $data;
		}

		public function save($data)
		{
			parent::simpandata($this->db->dbprefix($this->table),$data);
		}

		public function createOrUpdate($data){
			$sql = 'INSERT INTO siloupi_contract(idcourses, nim, grade, idprograme, quality, idcurriculum, courses) '.
				   'VALUES (?, ?, ?, ?, ?, ?, ?) '.
				   'ON CONFLICT(idcourses, nim, courses) DO UPDATE SET '.
				   'idprograme=EXCLUDED.idprograme, grade=EXCLUDED.grade, quality=EXCLUDED.quality, idcurriculum=EXCLUDED.idcurriculum';
			$this->db->query($sql, $data);
		}

		public function delete($key_1, $value_1, $key_2, $value_2, $key_3, $value_3)
		{
			$this->db->where($key_1, $value_1);
			$this->db->where($key_2, $value_2);
			$this->db->where($key_3, $value_3);
			$this->db->delete($this->db->dbprefix($this->table));
		}

		public function deleteById($id)
		{
		}
	}
?>
