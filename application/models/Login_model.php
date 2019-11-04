<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_model {
    function login($table,$where){
        return $this->db->get_where($table,$where);
    }

}

/* End of file Login_model.php */
/* Location: ./application/models/Login_model.php */