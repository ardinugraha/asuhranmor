<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('User_model', 'users');
	}

	public function index(){
		$data = array(
			'title' => 'Login Page | ASuHRanMor'
			);

		$this->load->view('template/login_view', $data);
	}

	function proses(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$where = array(
			'tbl_user.user_name' => $username,
			'tbl_user.user_pass' => md5($password),
			'tbl_kode.kode_title' => 'user_role'
			);

		$cek = $this->users->login("tbl_user",$where);
		
		if ($cek->num_rows() > 0) {
			$data = $cek->row_array();
			$data_session = array(
				'user_name' => $data['USER_NAME'],
				'user_irl_name' => $data['USER_IRL_NAME'],
				'user_nip' => $data['USER_NIP'],
				'status' => 'login',
				'user_id' => $data['USER_ID'],
				'user_role_name' => $data['USER_ROLE_NAME'],
				'user_role' => $data['USER_ROLE']
				
				);
			$this->session->set_userdata($data_session);
			redirect('dashboard');
			// echo "BENAR";
		} else{
			// echo "SALAH";
			redirect(base_url());
		}
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */