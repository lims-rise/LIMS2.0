<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class Ref_unproc_sample extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_unproc_sample_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('Ref_unproc_sample_model');
        // $data['person'] = $this->Ref_unproc_sample_model->getLabtech();
        // $data['type'] = $this->Ref_unproc_sample_model->getSampleType();
        $this->template->load('template','Ref_unproc_sample/index');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_unproc_sample_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post(strtoupper('barcode_sample'),TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_sample' => $this->input->post(strtoupper('barcode_sample'),TRUE),
            'date_entry' => $this->input->post('date_entry',TRUE),
            'time_entry' => $this->input->post('time_entry',TRUE),
            'comments' => $this->input->post('comments',TRUE),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->Ref_unproc_sample_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_sample' => $this->input->post(strtoupper('barcode_sample'),TRUE),
            'date_entry' => $this->input->post('date_entry',TRUE),
            'time_entry' => $this->input->post('time_entry',TRUE),
            'comments' => $this->input->post('comments',TRUE),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->Ref_unproc_sample_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("Ref_unproc_sample"));
    }

    public function delete($id) 
    {
        $row = $this->Ref_unproc_sample_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->Ref_unproc_sample_model->delete($id);
            $this->Ref_unproc_sample_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Ref_unproc_sample'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Ref_unproc_sample'));
        }
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->Ref_unproc_sample_model->validate1($id);

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
        $sheet->setCellValue('A1', "Barcode_sample"); 
        $sheet->setCellValue('B1', "Date_entry"); 
        $sheet->setCellValue('C1', "Time_entry");
        $sheet->setCellValue('D1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->Ref_unproc_sample_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->date_entry);
          $sheet->setCellValue('C'.$numrow, $data->time_entry);
          $sheet->setCellValue('D'.$numrow, $data->comments);
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'MASTER_Unprocessed_sample_'.$datenow.'.csv';

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

/* End of file Ref_unproc_sample.php */
/* Location: ./application/controllers/Ref_unproc_sample.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */