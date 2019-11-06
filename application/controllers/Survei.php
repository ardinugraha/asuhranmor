<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survei extends CI_Controller {
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
            'title' => 'Manajemen Laporan Survei',
            'content' => $this->load->view('survei/survei_view', [
                'poss' => $this->poss->getAllPos(),
                'surveistats' => $this->surveistats->getAllstat()
				], TRUE)
			);
		$this->load->view('template/index',$data);
    }
    
    
	public function ajax_list(){
		$user_id = $this->session->userdata('user_id');
        $list = $this->surveis->get_datatables($user_id);
        
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

            $row[] = $survei->survey_status;//$this->surveistats->getStatName($survei->SURVEY_STATUS);

            $row[] = '<a class="btn btn-flat btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_survei('."'".$survei->survey_id."'".')"><i class="glyphicon glyphicon-pencil"></i>  Edit</a>
			<a class="btn btn-flat btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_survei('."'".$survei->survey_id."'".')"><i class="glyphicon glyphicon-trash"></i>  Delete</a>';

            $data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->surveis->count_all($user_id),
			"recordsFiltered" => $this->surveis->count_filtered($user_id),
			"data" => $data,
			);

		//output to json format
		echo json_encode($output);
	}
	

	public function ajax_add(){
		//$this->_validate();
		$data = array(
			'user_id' => $this->input->post('user_id'),
			'survey_tgl' => date('Y-m-d H:i:s'),
			'survey_pos' => $this->input->post('kode_data'),
			'survey_attachment' => null,
			'survey_status' => 0
			);
		$insert = $this->surveis->save($data);
		echo json_encode(array("status" => TRUE));
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
    
    

	

}
