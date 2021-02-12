<?php
	require_once APPPATH."models/Model_siloupi.php";
    class Student_model extends Model_siloupi
	{
		private $table = 'student';
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
			$sql = 'INSERT INTO siloupi_student(nim, idprograme, "name", "status", class_generation, idlevel, idfaculty, graduation_date, gpa) '.
				   'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) '.
				   'ON CONFLICT(nim) DO UPDATE SET '.
				   'idprograme=EXCLUDED.idprograme, "name"=EXCLUDED."name", "status"=EXCLUDED."status", class_generation=EXCLUDED.class_generation, idlevel = EXCLUDED.idlevel, idfaculty = EXCLUDED.idfaculty, graduation_date = EXCLUDED.graduation_date, gpa = EXCLUDED.gpa';
			$this->db->query($sql, $data);
		}

		public function delete($key, $value)
		{
			$this->db->where($key, $value);
			$this->db->delete($this->db->dbprefix($this->table));
		}

		public function deleteById($id)
		{
			$this->delete($this->primary, $id);
		}
	}
?>
