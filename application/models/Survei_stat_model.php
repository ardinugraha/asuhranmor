<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survei_stat_model extends CI_model {

    public function __construct(){
		parent::__construct();
    }
    
    function getAllStat(){
        $this->db->select('*');
        $this->db->from('tbl_kode');
        $this->db->where('kode_title','survey_cond_status');

        return $this->db->get()->result();
    }

    
    function getStatName($kode_data){
        $this->db->select('kode_value');
        $this->db->from('tbl_kode');
        $this->db->where(array('kode_data'=>$kode_data,'kode_title'=>'survey_cond_status'));
        
        return $this->db->get()->row()->kode_value;
    }

}