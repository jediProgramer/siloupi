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
