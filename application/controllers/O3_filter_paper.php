<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O3_filter_paper extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O3_filter_paper_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O3_filter_paper_model');
        $data['person'] = $this->O3_filter_paper_model->getLabtech();
        $data['freezer'] = $this->O3_filter_paper_model->getFreezer();
        $data['shelf'] = $this->O3_filter_paper_model->getShelf();
        $data['rack'] = $this->O3_filter_paper_model->getRack();
        $data['rack_level'] = $this->O3_filter_paper_model->getDrawer();
        $this->template->load('template','o3_filter_paper/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O3_filter_paper_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('barcode_sample',TRUE);
        $f = $this->input->post('freezer',TRUE);
        $s = $this->input->post('shelf',TRUE);
        $r = $this->input->post('rack',TRUE);
        $rl = $this->input->post('rack_level',TRUE);

        $freezerloc = $this->O3_filter_paper_model->getFreezLoc($f,$s,$r,$rl);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
                'date_in' => $this->input->post('date_process',TRUE),
                'time_in' => $this->input->post('time_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'id_vessel' => '1',
                'barcode_sample' => $this->input->post('barcode_sample',TRUE),
                'id_location_80' => $freezerloc->id_location_80,
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => $this->input->post('freezer_bag',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
    
            $this->O3_filter_paper_model->insert_freezer($data);
            $this->session->set_flashdata('message', 'Create Record Success');          
            $freezid = $this->O3_filter_paper_model->getFreezerIN($id);

            $data = array(
                'barcode_sample' => $this->input->post('barcode_sample',TRUE),
                'date_process' => $this->input->post('date_process',TRUE),
                'time_process' => $this->input->post('time_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'freezer_bag' => $this->input->post('freezer_bag',TRUE),
                'id_location_80' => $freezid->id,
                'comments' => $this->input->post('comments',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O3_filter_paper_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
      
        }
        else if ($mode=="edit"){
            $data = array(
                'date_in' => $this->input->post('date_process',TRUE),
                'time_in' => $this->input->post('time_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'id_vessel' => '1',
                'barcode_sample' => $this->input->post('barcode_sample',TRUE),
                'id_location_80' => $freezerloc->id_location_80,
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => $this->input->post('freezer_bag',TRUE),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );
    
            // $freezid = $this->O3_filter_paper_model->getFreezerIN($id);
            $this->O3_filter_paper_model->update_freezer($this->input->post('idfrez',TRUE), $data);
            $this->session->set_flashdata('message', 'Create Record Success');          

            $data = array(
                'barcode_sample' => $this->input->post('barcode_sample',TRUE),
                'date_process' => $this->input->post('date_process',TRUE),
                'time_process' => $this->input->post('time_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'freezer_bag' => $this->input->post('freezer_bag',TRUE),
                'id_location_80' => $this->input->post('idfrez',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O3_filter_paper_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("o3_filter_paper"));
    }

    public function delete($id) 
    {
        $row = $this->O3_filter_paper_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O3_filter_paper_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o3_filter_paper'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o3_filter_paper'));
        }
    }

    public function load_loc() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->O3_filter_paper_model->find_loc($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function load_cryo() 
    {
        $id = $this->input->get('idcryo');
        // echo $id;
        $data = $this->O3_filter_paper_model->find_cryo($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function valid_bs()
    {
        $id = $this->input->get('id1');
        $type = $this->input->get('id2');
        $data = $this->O3_filter_paper_model->validate1($id, $type);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    // public function _rules() 
    // {
	// $this->form_validation->set_rules('delivery_number', 'delivery number', 'trim|required');
	// $this->form_validation->set_rules('date_delivery', 'date delivery', 'trim|required');
	// $this->form_validation->set_rules('id_customer', 'id customer', 'trim|required');
	// $this->form_validation->set_rules('expedisi', 'expedisi', 'trim');
	// $this->form_validation->set_rules('receipt', 'receipt', 'trim');
	// // $this->form_validation->set_rules('sj', 'sj', 'trim|required');
	// $this->form_validation->set_rules('notes', 'notes', 'trim');

	// $this->form_validation->set_rules('id_delivery', 'id_delivery', 'trim');
	// $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    // }


    public function excel()
    {
        // $date1=$this->input->get('date1');
        // $date2=$this->input->get('date2');

        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Barcode_sample"); 
        $sheet->setCellValue('B1', "Date_process"); 
        $sheet->setCellValue('C1', "Time_process");
        $sheet->setCellValue('D1', "Lab_tech");
        $sheet->setCellValue('E1', "Freezer_bag");
        $sheet->setCellValue('F1', "Location");
        $sheet->setCellValue('G1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O3_filter_paper_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->date_process);
          $sheet->setCellValue('C'.$numrow, $data->time_process);
          $sheet->setCellValue('D'.$numrow, $data->initial);
          $sheet->setCellValue('E'.$numrow, $data->freezer_bag);
          $sheet->setCellValue('F'.$numrow, $data->location);
          $sheet->setCellValue('G'.$numrow, $data->comments);
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O3_Filter_paper_'.$datenow.'.csv';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=$fileName"); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    // $this->output->set_header('Content-Type: application/vnd.ms-excel');
    // $this->output->set_header("Content-type: application/csv");
    // $this->output->set_header('Cache-Control: max-age=0');
    $writer->save('php://output');
    //     $writer->save($fileName); 
    // //redirect(HTTP_UPLOAD_PATH.$fileName); 
    // $filepath = file_get_contents($fileName);
    // force_download($fileName, $filepath);

        // // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        // $sheet->getDefaultRowDimension()->setRowHeight(-1);
    
        // // Set orientasi kertas jadi LANDSCAPE
        // $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
        // // Set judul file excel nya
        // $sheet->setTitle("Delivery Reports");
    
        // // Proses file excel
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment; filename="Delivery_Reports.xlsx"'); // Set nama file excel nya
        // header('Cache-Control: max-age=0');
    
        // // $writer = new Xlsx($spreadsheet);
        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        // // $fileName = $fileName.'.csv';
        // $writer->save('php://output');
           
    }
}

/* End of file O3_filter_paper.php */
/* Location: ./application/controllers/O3_filter_paper.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */