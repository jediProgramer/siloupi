<?php
    class Model_laporan extends CI_Model
	{
		//var $tabel='meowcms_users';
		
		
		function __construct()
		{
			parent::__construct();
		}
		
		public function periode_wisuda()
		{
			$query=$this->db->query("select graduation_date from view_mhs_lo group by graduation_date");
			return $query;
		}

		public function seluruh_lo_mhs()
		{
			$query=$this->db->query("select * from view_mhs_lo");
			return $query;
		}

		public function seluruh_lo_mhs_by_date($date)
		{
			$query=$this->db->query("select * from view_mhs_lo where graduation_date = '$date'");
			return $query;
		}
		
	}
?>