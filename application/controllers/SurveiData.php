<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SurveiData extends CI_Controller {
	public function __construct(){
		parent::__construct();

        $this->load->model('Survei_model', 'surveis');
        $this->load->model('Survei_data_model', 'surveidatas');
        $this->load->model('Pos_model', 'poss');
        $this->load->model('Survei_stat_model', 'surveistats');
		// $this->load->model('kelas_model', 'kelass');
		// $this->load->model('mapel_model', 'mapels');
		// $this->load->model('siswa_model', 'siswas');
		// $this->load->model('user_model', 'users');


		if($this->session->userdata('status') != 'login'){
			redirect(base_url());
			// echo "HARUS LOGIN DULU";
		}
    }
    
    public function index($data_id){
		$data = array(
            'title' => 'Detail Laporan Survei',
            'content' => $this->load->view('surveidata/surveidata_view', [
                'poss' => $this->poss->getAllPos(),
                'surveistats' => $this->surveistats->getAllstat(),
                'data_id' => $data_id
				], TRUE)
			);
        $this->load->view('template/index',$data);
    }

    public function ajax_list($survei_id){
        $list = $this->surveidatas->get_datatables($survei_id);
        
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $surveidata) {
			$no++;
			$row = array();
			$row[] = $no;
            $row[] = $surveidata->SURVEY_DATA_KODE_KENDARAAN;
            $row[] = $surveidata->SURVEY_DATA_SUB_JENIS;
            $row[] = $surveidata->SURVEY_DATA_MEREK;
            $row[] = $surveidata->SURVEY_DATA_TYPE;
            $row[] = $surveidata->SURVEY_DATA_TAHUN;
            $row[] = $surveidata->SURVEY_DATA_HARGA;
            $row[] = $surveidata->SURVEY_DATA_POS;
            $row[] = $surveidata->SURVEY_DATA_ATTACHMENT;
            $row[] = '<a class="btn btn-flat btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_siswa('."'".$surveidata->SURVEY_DATA_ID."'".')"><i class="glyphicon glyphicon-pencil"></i>  Edit</a>
			<a class="btn btn-flat btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_siswa('."'".$surveidata->SURVEY_DATA_ID."'".')"><i class="glyphicon glyphicon-trash"></i>  Delete</a>';
			
            $data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->surveidatas->count_all($survei_id),
			"recordsFiltered" => $this->surveidatas->count_filtered($survei_id),
			"data" => $data,
			);

		//output to json format
		echo json_encode($output);
    }
}