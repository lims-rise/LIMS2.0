<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O2b_endetec_out_w extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O2b_endetec_out_w_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O2b_endetec_out_w_model');
        // $data['person'] = $this->O2b_endetec_out_w_model->getLabtech();
        // $data['type'] = $this->O2b_endetec_out_w_model->getSampleType();
        $this->template->load('template','O2b_endetec_out_w/index');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O2b_endetec_out_w_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('barcode_endetec',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_endetec' => $this->input->post('barcode_endetec',TRUE),
            'date_conduct' => $this->input->post('date_conduct',TRUE),
            'time_ecoli' => $this->input->post('time_ecoli',TRUE),
            'volume_ecoli' => $this->input->post('volume_ecoli',TRUE),
            'ecoli_cfu' => $this->input->post('ecoli_cfu',TRUE),
            'total_coliforms' => $this->input->post('total_coliforms',TRUE),
            'total_coli_cfu' => $this->input->post('total_coli_cfu',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->O2b_endetec_out_w_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_endetec' => $this->input->post('barcode_endetec',TRUE),
            'date_conduct' => $this->input->post('date_conduct',TRUE),
            'time_ecoli' => $this->input->post('time_ecoli',TRUE),
            'volume_ecoli' => $this->input->post('volume_ecoli',TRUE),
            'ecoli_cfu' => $this->input->post('ecoli_cfu',TRUE),
            'total_coliforms' => $this->input->post('total_coliforms',TRUE),
            'total_coli_cfu' => $this->input->post('total_coli_cfu',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->O2b_endetec_out_w_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("O2b_endetec_out_w"));
    }

    public function delete($id) 
    {
        $row = $this->O2b_endetec_out_w_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->O2b_endetec_out_w_model->delete($id);
            $this->O2b_endetec_out_w_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('O2b_endetec_out_w'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('O2b_endetec_out_w'));
        }
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $data = $this->O2b_endetec_out_w_model->validate1($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    // public function valid_bs2() 
    // {
    //     $id = $this->input->get('id1');
    //     $id2 = $this->input->get('id2');
    //     $data = $this->O2b_endetec_out_w_model->validate2($id, $id2);
    //     header('Content-Type: application/json');
    //     echo json_encode($data);
    // }


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
        $sheet->setCellValue('A1', "Barcode_endetec"); 
        $sheet->setCellValue('B1', "Date_conduct"); 
        $sheet->setCellValue('C1', "Time_E.coli_detection");
        $sheet->setCellValue('D1', "E.coli_CFU/volume_added");
        $sheet->setCellValue('E1', "E.coli_CFU/100mL");
        $sheet->setCellValue('F1', "Total_coliforms_CFU/volume_added");
        $sheet->setCellValue('G1', "Total_coliforms_CFU/100mL");
        $sheet->setCellValue('H1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O2b_endetec_out_w_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_endetec);
          $sheet->setCellValue('B'.$numrow, $data->date_conduct);
          $sheet->setCellValue('C'.$numrow, $data->time_ecoli);
          $sheet->setCellValue('D'.$numrow, $data->volume_ecoli);
          $sheet->setCellValue('E'.$numrow, $data->ecoli_cfu);
          $sheet->setCellValue('F'.$numrow, $data->total_coliforms);
          $sheet->setCellValue('G'.$numrow, $data->total_coli_cfu);
          $sheet->setCellValue('H'.$numrow, trim($data->comments));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O2B_Endetec_OUT_(Water)_'.$datenow.'.csv';

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

/* End of file O2b_endetec_out_w.php */
/* Location: ./application/controllers/O2b_endetec_out_w.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */