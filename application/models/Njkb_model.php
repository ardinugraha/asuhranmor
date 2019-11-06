<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Njkb_model extends CI_model {

    public function __construct(){
		parent::__construct();
    }
    
    function getJenis(){
        $this->db->select('*');
        $this->db->from('tbl_kode');
        $this->db->where(array('kode_title'=>'veh_type'));
        
        return $this->db->get()->result();
    }

    function getMerek(){
        $this->db->select('*');
        $this->db->from('tbl_kode');
        $this->db->where(array('kode_title'=>'veh_brand'));
        
        return $this->db->get()->result();
    }




    function getNjkb($datasend){
          $this->db->select('*');
          $this->db->from('tbl_njkb');
          $this->db->like(array('njkb_jenis' => $datasend['jenis'], 'njkb_merek' => $datasend['merek'], 'njkb_type' => $datasend['key']));
        //   $this->db->like('njkb_merek', $datasend['merek']);
        //   $this->db->like('njkb_type', $datasend['key']);
        return $this->db->get()->result();
     }
    

}