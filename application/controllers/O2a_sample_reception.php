<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O2a_sample_reception extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O2a_sample_reception_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['person'] = $this->O2a_sample_reception_model->getLabtech();
        $data['staff'] = $this->O2a_sample_reception_model->getAllstaff();
        $this->template->load('template','o2a_sample_reception/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O2a_sample_reception_model->json();
    }

    public function subjson() {
        $id=$this->input->get('id');
        header('Content-Type: application/json');
        echo $this->O2a_sample_reception_model->subjson($id);
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('idrec',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){

            $data = array(
                // 'id' => $this->input->post('idbc',TRUE),
                'date_receipt' => $this->input->post('date_receipt',TRUE),
                'id_delivered' => $this->input->post('delivered',TRUE),
                'id_received' => $this->input->post('received',TRUE),
                'sample_type' => $this->input->post('sample_type',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2a_sample_reception_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                // 'id' => $this->input->post('idbc',TRUE),
                'date_receipt' => $this->input->post('date_receipt',TRUE),
                'id_delivered' => $this->input->post('delivered',TRUE),
                'id_received' => $this->input->post('received',TRUE),
                'sample_type' => $this->input->post('sample_type',TRUE),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2a_sample_reception_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("o2a_sample_reception"));
    }

    public function save_detail() 
    {
        $mode_det = $this->input->post('mode_det',TRUE);
        $id = $this->input->post('idrec_det',TRUE);
        $dt = new DateTime();

        if ($mode_det=="insert"){
            $data = array(
                'barcode_sample' => $this->input->post(strtoupper('barcode_sample'),TRUE),
                'id_receipt' => $this->input->post('idrec2',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2a_sample_reception_model->insert_det($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode_det=="edit"){
            $data = array(
                'barcode_sample' => $this->input->post(strtoupper('barcode_sample'),TRUE),
                'id_receipt' => $this->input->post('idrec2',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2a_sample_reception_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("o2a_sample_reception"));
    }

    public function delete($id) 
    {
        $row = $this->O2a_sample_reception_model->get_by_id($id);
        // $id_rec = $this->O2a_sample_reception_model->get_by_id_rec($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O2a_sample_reception_model->update($id, $data);
            //$this->O2a_sample_reception_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o2a_sample_reception'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o2a_sample_reception'));
        }
    }

    public function delete_det($id) 
    {
        $row = $this->O2a_sample_reception_model->get_by_id_detail($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O2a_sample_reception_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o2a_sample_reception'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o2a_sample_reception'));
        }
    }    

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $data = $this->O2a_sample_reception_model->validate1($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
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
        $sheet->setCellValue('A1', "Barcode_storagebag"); 
        $sheet->setCellValue('B1', "Date_receipt"); 
        $sheet->setCellValue('C1', "Delivered_by");
        $sheet->setCellValue('D1', "Received_by");
        $sheet->setCellValue('E1', "Sample_type");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O2a_sample_reception_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->date_receipt);
          $sheet->setCellValue('C'.$numrow, $data->deli_by);
          $sheet->setCellValue('D'.$numrow, $data->rec_by);
          $sheet->setCellValue('E'.$numrow, $data->sample_type);
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O2A_Sample_Receipt_'.$datenow.'.csv';

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

/* End of file o2a_sample_reception.php */
/* Location: ./application/controllers/o2a_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */