<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('User_model', 'Users');



		if($this->session->userdata('status') != 'login'){
			redirect(base_url());
		}
	}

	public function index(){
		$data = array(
			'title' => 'Dashboard | ASuHRanMor',
			'content' => $this->load->view('profile/profile_view', [null
				
				], TRUE)
			);
		$this->load->view('template/index', $data);
	}

	

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */