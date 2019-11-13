<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survei_model extends CI_Model {
	var $table = 'tbl_survey';
	var $column_order = array('survey_id','survey_tgl', 'survey_pos', 'survey_attachment',null, 'survey_status', null); //set column field database for datatable orderable
	var $column_search = array('survey_id','survey_tgl', 'survey_pos', 'c.kode_value', 'survey_status', ); //set column field database for datatable searchable just firstname
	var $order = array('survey_id' => 'asc'); // default order 


	public function __construct(){
		parent::__construct();
		
	}

	private function _get_datatables_query($user_id){
		
		$this->db->select('a.survey_id as survey_id, a.survey_tgl as survey_tgl, c.kode_value as survey_pos, a.survey_attachment as survey_attachment, d.kode_value as survey_status');
		$this->db->from('tbl_survey as a');
		$this->db->join('tbl_kode as c','c.kode_data = a.survey_pos');
		$this->db->where('c.kode_title','city_pos');
		$this->db->join('tbl_kode as d','d.kode_data = a.survey_status');
		$this->db->where('d.kode_title','survey_cond_status');
		$this->db->where('a.user_id',$user_id);
        //$this->db->simple_query("SELECT a.SURVEY_TGL as survey_tgl ,b.kode_value as survey_pos ,a.SURVEY_ATTACHMENT as survey_attachment ,c.kode_value as survey_status FROM tbl_survey a,tbl_kode b,tbl_kode c WHERE b.kode_title = 'city_pos' and a.survey_pos = b.kode_data and c.kode_title = 'survey_cond_status' and a.survey_status = c.kode_data");
        //$this->db->query('SELECT * from tbl_survey');

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

	function get_datatables($user_id){
		$this->_get_datatables_query($user_id);
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
    }

    public function count_all($user_id)
	{
		$this->db->from($this->table);
		$this->db->where('user_id',$user_id);
		return $this->db->count_all_results();
    }
    
    function count_filtered($user_id)
	{
		$this->_get_datatables_query($user_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function save($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}


	public function getPos($data){
		$this->db->select('survey_pos');
		$this->db->from($this->table);
		$this->db->where('survey_id',$data);
		return $this->db->get()->row()->survey_pos;
	}

	public function getPosName($data){
		$this->db->select('c.kode_value as survey_pos');
		$this->db->from('tbl_survey as a');
		$this->db->join('tbl_kode as c','c.kode_data = a.survey_pos');
		$this->db->where('c.kode_title','city_pos');
		$this->db->where('a.survey_id',$data);
		return $this->db->get()->row()->survey_pos;
	}


	public function getTanggal($data){
		$this->db->select('survey_tgl');
		$this->db->from($this->table);
		$this->db->where('survey_id',$data);
		return $this->db->get()->row()->survey_tgl;
	}

	public function getStatus($data){
		$this->db->select('survey_status');
		$this->db->from($this->table);
		$this->db->where('survey_id',$data);
		return $this->db->get()->row()->survey_status;
	}


	public function delete_by_id($id)
	{
		$this->db->where('survey_id', $id);
		$this->db->delete($this->table);
	}

	public function get_by_survey_id($id)
	{
		$this->db->select('a.survey_id as survey_id, a.survey_tgl as survey_tgl, a.survey_pos as survey_pos, a.survey_attachment as survey_attachment');
		$this->db->from('tbl_survey as a');
		$this->db->join('tbl_kode as c','c.kode_data = a.survey_pos');
		$this->db->where('c.kode_title','city_pos');
		$this->db->where('a.survey_id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function update($where, $data){
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function report($data){


		$this->db->where('survey_id',$data);
		$this->db->update('tbl_survey',array('survey_status'=>1));
		return $this->db->affected_rows();
	}

	public function update_last_edit($id,$data){
		$this->db->where('survey_id',$id);
		$this->db->update('tbl_survey',array('survey_last_date'=>$data));
		return $this->db->affected_rows();
	}

}