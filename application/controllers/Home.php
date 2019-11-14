<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Survei_model', 'surveis');
        $this->load->model('Survei_data_model', 'surveidatas');
        $this->load->model('Pos_model', 'poss');
		$this->load->model('Survei_stat_model', 'surveistats');
		$this->load->model('Njkb_model', 'njkbs');



		if($this->session->userdata('status') != 'login'){
			redirect(base_url());
		}
	}

	public function index(){
		$data = array(
			'title' => 'Dashboard | ASuHRanMor',
			'content' => $this->load->view('dashboard/dashboard_view', [
				'surveinonreported' => $this->surveis->count_all_non_reported($this->session->userdata('user_id')),
				'surveidatanonreported' => $this->surveidatas->count_all_non_reported($this->session->userdata('user_id')),
				'surveireported' => $this->surveis->count_all_reported($this->session->userdata('user_id')),
				'surveidatareported' => $this->surveidatas->count_all_reported($this->session->userdata('user_id')),
				'surveireported2' => $this->surveis->count_all_reported_2(),
				'surveidatareported2' => $this->surveidatas->count_all_reported_2()
				
				], TRUE)
			);
		$this->load->view('template/index', $data);
	}

	

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */