<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
	public function __construct(){
		parent::__construct();

		$this->load->model('Survei_model', 'surveis');
		$this->load->model('Survei_data_model', 'surveidatas');
        $this->load->model('Pos_model', 'poss');
        $this->load->model('Survei_stat_model', 'surveistats');


		if($this->session->userdata('status') != 'login'){
			redirect(base_url());
		}
	}

	public function index(){
        $data = array(
            'title' => 'Hasil Laporan Survei',
            'content' => $this->load->view('report/report_view', [
                'poss' => $this->poss->getAllPos(),
                'surveistats' => $this->surveistats->getAllstat()
				], TRUE)
			);
		$this->load->view('template/index',$data);
    }
    
    
	public function ajax_list(){
		$user_id = $this->session->userdata('user_id');
        $list = $this->surveis->get_datatables_reported();
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $survei) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $survei->survey_tgl;
			$row[] = $survei->survey_pos;//$this->poss->getPosName($survei->SURVEY_POS);
            $row[] = $survei->survey_attachment;
            $row[] = '<a class="btn btn-flat btn-sm btn-primary" href='."'surveidata/index/".$survei->survey_id."'".' title="Edit" ><i class="glyphicon glyphicon-pencil"></i>  Detail</a>';
            $row[] = $survei->survey_tgl_reported;
            $row[] = $survei->user_name.' / '.$survei->user_nip.' / '.$survei->user_role;
            $row[] = '<a class="btn btn-flat btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_survei('."'".$survei->survey_id."'".')"><i class="glyphicon glyphicon-trash"></i>  Delete</a>';
            $data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->surveis->count_all_reported_2(),
			"recordsFiltered" => $this->surveis->count_filtered_reported_2(),
			"data" => $data,
			);

		//output to json format
		echo json_encode($output);
	}
	

	public function ajax_add(){
		//$this->_validate();
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'survey_tgl' => $this->input->post('survei_tanggal'),
			'survey_pos' => $this->input->post('survei_pos'),
			'survey_attachment' => $this->input->post('survei_lampiran'),
			'survey_status' => 0
			);
		$insert = $this->surveis->save($data);
		echo json_encode(array("status" => TRUE));
		//echo json_encode($this->surveis->save($data));
	}

	public function ajax_update(){
		//$this->_validate();
		$data = array(
			//'survey_tgl' => date('Y-m-d H:i:s'),
			'survey_pos' => $this->input->post('survei_pos'),
			'survey_attachment' => $this->input->post('survei_lampiran'),
			'survey_tgl' => $this->input->post('survei_tanggal'),
			'survey_status' => 0
			);
		$insert = $this->surveis->update(array('survey_id' => $this->input->post('survei_id')), $data);
		echo json_encode(array("status" => TRUE));
		//echo json_encode($this->surveis->save($data));
	}



	public function ajax_delete($id){

		$list = $this->surveidatas->get_by_survey_id($id);
		foreach ($list as $surveidata) {
			$this->surveidatas->delete_by_id($surveidata->SURVEY_DATA_ID);
			//echo json_encode($surveidata->SURVEY_DATA_ID);
		}
		$this->surveis->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_report($id){

		$this->surveis->report($id);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_edit($id){
		$data = $this->surveis->get_by_survey_id($id);
		echo json_encode($data);
	}

	public function ajax_update_date($id){
		$this->surveis->update_last_edit($id,date('Y-m-d H:i:s'));
		echo json_encode(array("status" => TRUE));
	}
	
}
