<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Survei extends CI_Controller {
	public function __construct(){
		parent::__construct();

        $this->load->model('Survei_model', 'surveis');
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

	public function index(){
		// $data = array(
		// 	'title' => 'Data Semua Siswa | .this.nilaiSiswa',
		// 	'content' => $this->load->view('siswa/siswa_view', [
		// 		'kelamins' => $this->kelamins->getAllJenisKelamin(),
		// 		'kelass' => $this->kelass->getAllKelas()
		// 		], TRUE)
        // 	);

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
        $list = $this->surveis->get_datatables();
        
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

            $row[] = '<a class="btn btn-flat btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_siswa('."'".$survei->survey_id."'".')"><i class="glyphicon glyphicon-pencil"></i>  Edit</a>
			<a class="btn btn-flat btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_siswa('."'".$survei->survey_id."'".')"><i class="glyphicon glyphicon-trash"></i>  Delete</a>';

            $data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->surveis->count_all(),
			"recordsFiltered" => $this->surveis->count_filtered(),
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
			'survey_status' => 1
			);
		$insert = $this->surveis->save($data);
		echo json_encode(array("status" => TRUE));
	}
    
    

	

}
