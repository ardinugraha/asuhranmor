<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SurveiData extends CI_Controller {
	public function __construct(){
		parent::__construct();

        $this->load->model('Survei_model', 'surveis');
        $this->load->model('Survei_data_model', 'surveidatas');
        $this->load->model('Pos_model', 'poss');
		$this->load->model('Survei_stat_model', 'surveistats');
		$this->load->model('Njkb_model', 'njkbs');
		


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
				'jenis' => $this->njkbs->getJenis(),
				'merek' => $this->njkbs->getMerek(),
				'data_id' => $data_id,
				'wilayah_survey' => $this->surveis->getPosName($data_id),
				'tanggal_survey' => $this->surveis->getTanggal($data_id),
				'last_edit_survey' => $this->surveis->getLastEdit($data_id),
				'lampiran_survey' => $this->surveis->getLampiran($data_id),
				'status_survey' => $this->surveis->getStatus($data_id)
				], TRUE)
			);
        $this->load->view('template/index',$data);
	}
	

	public function njkb_list(){
		// POST data
		$postData = $this->input->post();
		$dataset = array(
			'jenis' => $this->input->post('jenis'),
			'merek' => $this->input->post('merek'),
			'key' => $this->input->post('key')
		);
		$datas = $this->njkbs->getNjkb($dataset);

		$response = array();

		foreach ($datas as $data) {
			$row = array();
			$row[] = array("value"=>$data->NJKB_KODE_KENDARAAN,"label"=>$data->NJKB_TYPE);
			$response = $row;
		}

		echo json_encode($response);
	  }

	public function rupiah($angka){
	
		$hasil_rupiah = "Rp " . number_format($angka,2,',','.');
		return $hasil_rupiah;
	 
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
            $row[] = $surveidata->SURVEY_DATA_JENIS;
            $row[] = $surveidata->SURVEY_DATA_MEREK;
            $row[] = $surveidata->SURVEY_DATA_TYPE;
            $row[] = $surveidata->SURVEY_DATA_TAHUN;
            $row[] = "Rp " . number_format($surveidata->SURVEY_DATA_HARGA,0,',','.');
            $row[] = $surveidata->KODE_VALUE;
			$row[] = $surveidata->SURVEY_DATA_ATTACHMENT;
			if($this->surveis->getStatus($survei_id)!=1){
				$row[] = '<a class="btn btn-flat btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_surveidata('."'".$surveidata->SURVEY_DATA_ID."'".')"  ><i class="glyphicon glyphicon-pencil"></i>  Edit</a>
				<a class="btn btn-flat btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_surveidata('."'".$surveidata->SURVEY_DATA_ID."'".')"><i class="glyphicon glyphicon-trash"></i>  Delete</a>';	
			}else{
				$row[] = '<a class="btn btn-warning" disabled >Data sudah dilaporkan</a>';
			}
            
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


	public function ajax_add(){
		//$this->_validate();
		$data = array(
			'survey_id' => $this->input->post('survey_id'),
			'survey_data_kode_kendaraan' => $this->input->post('survey_data_kode_kendaraan'),
			'survey_data_tahun' => $this->input->post('survey_data_tahun'),
			'survey_data_harga' => preg_replace("/[^0-9]/", '', $this->input->post('survey_data_harga')),
			'survey_data_merek' => $this->input->post('survey_data_merek'),
			'survey_data_type' => $this->input->post('survey_data_type'),
			'survey_data_jenis' => $this->njkbs->getJenisById($this->input->post('survey_data_jenis')),
			'survey_data_attachment' => null
			);
		$insert = $this->surveidatas->save($data);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_delete($id){
		$this->surveidatas->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id){
		$data = $this->surveidatas->get_by_survey_data_id($id);
		// $data->SURVEY_DATA_JENIS = $this->njkbs->getIdByJenisName($data->SURVEY_DATA_JENIS);
		echo json_encode($data);
	}

	public function ajax_update(){
		//$this->_validate();
		$data = array(
			'survey_data_kode_kendaraan' => $this->input->post('survey_data_kode_kendaraan'),
			'survey_data_tahun' => $this->input->post('survey_data_tahun'),
			'survey_data_harga' => preg_replace("/[^0-9]/", '', $this->input->post('survey_data_harga')),
			'survey_data_merek' => $this->input->post('survey_data_merek'),
			'survey_data_type' => $this->input->post('survey_data_type'),
			'survey_data_jenis' => $this->njkbs->getJenisById($this->input->post('survey_data_jenis')),
			'survey_data_attachment' => null
			);
		$insert = $this->surveidatas->update(array('survey_data_id' => $this->input->post('survey_data_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	

}