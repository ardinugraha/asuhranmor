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


    function getJenisById($data){
      $this->db->select('kode_value');
      $this->db->from('tbl_kode');
      $this->db->where(array('kode_title'=>'veh_type','kode_data'=>$data));
      return $this->db->get()->row()->kode_value;
    }

    function getMerek(){
        $this->db->select('*');
        $this->db->from('tbl_kode');
        $this->db->where(array('kode_title'=>'veh_brand'));
        
        return $this->db->get()->result();
    }

    function getMerekById($data){
      $this->db->select('kode_value');
      $this->db->from('tbl_kode');
      $this->db->where(array('kode_title'=>'veh_brand','kode_data'=>$data));
      
      return $this->db->get()->row()->kode_value;
    }

    




    function getNjkb($datasend){
          $this->db->select('*');
          $this->db->from('tbl_njkb');
          $this->db->like(array('njkb_jenis' => $datasend['jenis'], 'njkb_merek' => $datasend['merek'], 'njkb_type' => $datasend['key']));
        return $this->db->get()->result();
     }
    

}