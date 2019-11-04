<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos_Model extends CI_model {

    public function __construct(){
		parent::__construct();
    }
    
    function getAllPos(){
        $this->db->select('*');
        $this->db->from('tbl_kode');
        $this->db->where('KODE_TITLE','city_pos');

        return $this->db->get()->result();
    }

    function getPosName($kode_data){
        $this->db->select('kode_value');
        $this->db->from('tbl_kode');
        $this->db->where(array('kode_data'=>$kode_data,'kode_title'=>'city_pos'));
        
        return $this->db->get()->row()->kode_value;
    }
    

}