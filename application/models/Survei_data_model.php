<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survei_data_model extends CI_Model {
	var $table = 'tbl_survey_data';
	var $column_order = array('survey_data_id','survey_data_kode_kendaraan','survey_data_jenis','survey_data_merek','survey_data_type','survey_data_tahun','survey_data_hpu','survey_data_pos','survey_data_attachment',null); //set column field database for datatable orderable
	var $column_search = array('survey_data_id','survey_data_kode_kendaraan','survey_data_jenis','survey_data_merek','survey_data_type','survey_data_tahun','survey_data_hpu','survey_data_pos','survey_data_attachment'); //set column field database for datatable searchable just firstname
	var $order = array('survey_data_id' => 'asc'); // default order 


	public function __construct(){
		parent::__construct();
		
	}

	private function _get_datatables_query($survei_id){
		
		$this->db->select('*');
        $this->db->from('tbl_survey_data');
        $this->db->where('survey_id',$survei_id);
        
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

	function get_datatables($survei_id){
		$this->_get_datatables_query($survei_id);
		if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
    }

    public function count_all($survei_id)
	{
        $this->db->from($this->table);
        $this->db->where('survey_id',$survei_id);
		return $this->db->count_all_results();
    }
    
    function count_filtered($survei_id)
	{
		$this->_get_datatables_query($survei_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function save($data){
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}


	public function delete_by_id($id)
	{
		$this->db->where('survey_data_id', $id);
		$this->db->delete($this->table);
	}


	public function get_by_survey_id($id)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('survey_id',$id);
		return $this->db->get()->result();
	}

}