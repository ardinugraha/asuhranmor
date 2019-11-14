<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_model {
    function login($table,$where){
        $this->db->select('tbl_user.user_name as USER_NAME, tbl_user.user_irl_name as USER_IRL_NAME, tbl_user.user_nip as USER_NIP, tbl_user.user_id as USER_ID, tbl_kode.kode_value as USER_ROLE_NAME, tbl_user.user_ROLE as USER_ROLE');
        $this->db->from($table);
        $this->db->join('tbl_kode','tbl_kode.kode_data = tbl_user.user_role');
        $this->db->where($where);
        return $this->db->get();
    }

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */