<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();

		// $this->load->model('guru_model', 'gurus');
		// $this->load->model('kelas_model', 'kelass');
		// $this->load->model('mapel_model', 'mapels');
		// $this->load->model('siswa_model', 'siswas');
		// $this->load->model('user_model', 'users');


		if($this->session->userdata('status') != 'login'){
			redirect(base_url());
			// echo "HARUS LOGIN DULU";
		}
	}

	public function index(){
		
		$this->load->view('template/index', $data);
	}

	

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */