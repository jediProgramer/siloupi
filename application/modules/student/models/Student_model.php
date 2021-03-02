<?php
	require_once APPPATH."models/Model_siloupi.php";
    class Student_model extends Model_siloupi
	{
		private $table = 'student';
		private $primary = 'nim';
		private $column_order = array('nim','idprograme','name', 'status', 'class_generation', 'idlevel', 'idfaculty'); //field yang ada di table student
		private $column_search = array('nim','idprograme','name', 'status', 'class_generation', 'idlevel', 'idfaculty'); //field yang diizin untuk pencarian 
		private $order = array('nim' => 'asc'); // default order

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

		private function _get_datatables_query($clause)
		{
		
			$this->db->from($this->table);
			$this->db->where($clause);

			$i = 0;
		
			foreach ($this->column_search as $item) // loop column 
			{
				if($_POST['search']['value']) // if datatable send POST for search
				{
					
					if($i===0) // first loop
					{
						$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
						$this->db->like($item, $_POST['search']['value']);
					}
					else
					{
						$this->db->or_like($item, $_POST['search']['value']);
					}

					if(count($this->column_search) - 1 == $i) //last loop
						$this->db->group_end(); //close bracket
				}
				$i++;
			}
			
			if(isset($_POST['order'])) // here order processing
			{
				$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
			} 
			else if(isset($this->order))
			{
				$order = $this->order;
				$this->db->order_by(key($order), $order[key($order)]);
			}
		}

		function get_datatables($clause)
		{
			$this->_get_datatables_query($clause);
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}

		function count_filtered($clause)
		{
			$this->_get_datatables_query($clause);
			$query = $this->db->get();
			return $query->num_rows();
		}

		public function count_all($clause)
		{
			//$this->db->get_where($this->table, $clause);
			$this->db->from($this->table);
			$this->db->where($clause);
			return $this->db->count_all_results();
		}

	}
?>
