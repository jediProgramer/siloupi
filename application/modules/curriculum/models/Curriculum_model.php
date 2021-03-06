<?php
	require_once APPPATH."models/Model_siloupi.php";
    class Curriculum_model extends Model_siloupi
	{
		private $table = 'curriculum';
		private $primary = 'idcurriculum';

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

		public function createOrUpdate($data){
			$sql = 'INSERT INTO siloupi_curriculum(idcurriculum, idlevel, curriculum, idprograme) '.
			'VALUES (?, ?, ?, ?) '.
			'ON CONFLICT(idcurriculum) DO UPDATE SET '.
			'idlevel=EXCLUDED.idlevel, curriculum=EXCLUDED.curriculum, idprograme=EXCLUDED.idprograme';
			$this->db->query($sql, $data);
		}

		public function deleteById($id)
		{
			$this->delete($this->primary, $id);
		}
	}
?>
