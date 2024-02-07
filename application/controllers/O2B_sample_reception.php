<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O2B_sample_reception extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O2B_sample_reception_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O2B_sample_reception_model');
        // $data['person'] = $this->O2B_sample_reception_model->getLabtech();
        $data['type'] = $this->O2B_sample_reception_model->getSampleType();
        $this->template->load('template','O2B_sample_reception/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O2B_sample_reception_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('barcode_sample',TRUE));
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'date_arrival' => $this->input->post('date_arrival',TRUE),
            'time_arrival' => $this->input->post('time_arrival',TRUE),
            'id_type2b' => $this->input->post('id_type2b',TRUE),
            'png_control' => $this->input->post('png_control',TRUE),
            'barcode_tinytag' => $this->input->post('barcode_tinytag',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->O2B_sample_reception_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'date_arrival' => $this->input->post('date_arrival',TRUE),
            'time_arrival' => $this->input->post('time_arrival',TRUE),
            'id_type2b' => $this->input->post('id_type2b',TRUE),
            'png_control' => $this->input->post('png_control',TRUE),
            'barcode_tinytag' => $this->input->post('barcode_tinytag', TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->O2B_sample_reception_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("O2B_sample_reception"));
    }

    public function delete($id) 
    {
        $row = $this->O2B_sample_reception_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->O2B_sample_reception_model->delete($id);
            $this->O2B_sample_reception_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('O2B_sample_reception'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('O2B_sample_reception'));
        }
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->O2B_sample_reception_model->validate1($id);

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
        $sheet->setCellValue('B1', "Date_arrival"); 
        $sheet->setCellValue('C1', "Time_arrival");
        $sheet->setCellValue('D1', "Sample_type");
        $sheet->setCellValue('E1', "P&G_control");
        $sheet->setCellValue('F1', "Barcode_tinytag");
        $sheet->setCellValue('G1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O2B_sample_reception_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->date_arrival);
          $sheet->setCellValue('C'.$numrow, $data->time_arrival);
          $sheet->setCellValue('D'.$numrow, $data->sampletype2b);
          $sheet->setCellValue('E'.$numrow, $data->png_control);
          $sheet->setCellValue('F'.$numrow, $data->barcode_tinytag);
          $sheet->setCellValue('G'.$numrow, trim($data->comments));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O2B_Sample_Reception_'.$datenow.'.csv';

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

/* End of file O2B_sample_reception.php */
/* Location: ./application/controllers/O2B_sample_reception.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */