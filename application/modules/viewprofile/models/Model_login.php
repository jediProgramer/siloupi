<?php
    class Model_login extends CI_Model
	{
		//var $tabel='meowcms_users';
		
		
		function __construct()
		{
			parent::__construct();
		}
		
		public function ceklogin($tabel,$nip,$password,$active)
		{
			$this->db->where('nip',$nip);
			$this->db->where('password',$password);
			$this->db->where('active',$active);
			$query=$this->db->get($tabel);
			if($query->num_rows()>0)
			{
				return $query->result_array();
			}
		}
		
	}
?>