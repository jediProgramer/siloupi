<?php
    class Model_siloupi extends CI_Model
	{
		private $tabledb;	

		private $fields= array();

		private $data= array();

		private $clause = array();
		
		function __construct()
		{
			parent::__construct();
		}
		
		function simpandata($tabel,$data)
		{
			$this->db->insert($tabel,$data);
		}
		
		public function update($table,$data,$clause='') 
		{	

			if ($clause!='')
			{	//Update data berdasarkan id

				return $this->db->update($table,$data,$clause);
			}
			else
			{	//Update seluruh data di table
				return $this->db->update($table,$data);
			}
		}
		
		public function select($table,$clause='') 
		{			
			if($clause!='')
			{	//Pilih data berdasarkan id

				$this->query=$this->db->get_where($table,$clause);
			}
			else
			{  // pilih semua data
				$this->query=$this->db->get($table);
			}
			return $this->query->result();
		}
		
		public function ambildata($tabel)
		{
			$row=array();
			$sql=$this->db->query("SELECT * FROM $tabel");
			if($sql->num_rows()>0)
			{
				$row=$sql->result_array();
			}
			return $row;
		}
		
		public function ambildataOrder($tabel,$order)
		{
			$row=array();
			$sql=$this->db->query("SELECT * FROM $tabel ORDER BY $order");
			if($sql->num_rows()>0)
			{
				$row=$sql->result_array();
			}
			return $row;
		}
		
		public function ambildataById($tabel,$iduser,$isi)
		{
			$row=array();
			$sql=$this->db->query("SELECT * FROM $tabel WHERE $iduser='".$isi."'");
			if($sql->num_rows()>0)
			{
				$row=$sql->result_array();
			}
			return $row;
		}
		
		function selectbox($tabel,$order)
		{
			$sqlprov ="SELECT * FROM  ".$tabel." ORDER BY ".$order."";
			$q = $this->db->query($sqlprov);
			return $q->result();
		}
		
		function selectboxbyid($tabel,$col,$order,$id)
		{
			$sqlkokab ="SELECT * FROM  ".$tabel." WHERE ".$col."='".$id."' ORDER BY ".$order."";
			$q = $this->db->query($sqlkokab);
			return $q->result();
		}
		
		public function insertFotos($data = array()){
			$insert = $this->db->insert_batch('filesfoto',$data);
			return $insert?true:false;
		}
	}
?>