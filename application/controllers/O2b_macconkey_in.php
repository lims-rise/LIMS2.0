<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O2b_macconkey_in extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O2b_macconkey_in_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O2b_macconkey_in_model');
        $data['person'] = $this->O2b_macconkey_in_model->getLabtech();
        // $data['type'] = $this->O2b_macconkey_in_model->getSampleType();
        $this->template->load('template','O2b_macconkey_in/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O2b_macconkey_in_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('bar_macconkey',TRUE));
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'bar_macconkey' => strtoupper($this->input->post('bar_macconkey',TRUE)),
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'barcode_falcon2' => strtoupper($this->input->post('barcode_falcon2',TRUE)),
            'date_process' => $this->input->post('date_process',TRUE),
            'time_process' => $this->input->post('time_process',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'volume' => $this->input->post('volume',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->O2b_macconkey_in_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'bar_macconkey' => strtoupper($this->input->post('bar_macconkey',TRUE)),
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'barcode_falcon2' => strtoupper($this->input->post('barcode_falcon2',TRUE)),
            'date_process' => $this->input->post('date_process',TRUE),
            'time_process' => $this->input->post('time_process',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'volume' => $this->input->post('volume',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->O2b_macconkey_in_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("O2b_macconkey_in"));
    }

    public function delete($id) 
    {
        $row = $this->O2b_macconkey_in_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->O2b_macconkey_in_model->delete($id);
            $this->O2b_macconkey_in_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('O2b_macconkey_in'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('O2b_macconkey_in'));
        }
    }

    public function load_stype() 
    {
        $id = $this->input->get('id1');
        $data = $this->O2b_macconkey_in_model->load_stype($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $data = $this->O2b_macconkey_in_model->validate1($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    public function valid_bs2() 
    {
        $id = $this->input->get('id1');
        $data = $this->O2b_macconkey_in_model->validate2($id);
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
        $sheet->setCellValue('A1', "Barcode_macconkey"); 
        $sheet->setCellValue('B1', "Barcode_sample/falcon1"); 
        $sheet->setCellValue('C1', "Barcode_falcon2");
        $sheet->setCellValue('D1', "Date_process");
        $sheet->setCellValue('E1', "Time_process");
        $sheet->setCellValue('F1', "Lab_tech");
        $sheet->setCellValue('G1', "Volume(mL)");
        $sheet->setCellValue('H1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O2b_macconkey_in_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->bar_macconkey);
          $sheet->setCellValue('B'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('C'.$numrow, $data->barcode_falcon2);
          $sheet->setCellValue('D'.$numrow, $data->date_process);
          $sheet->setCellValue('E'.$numrow, $data->time_process);
          $sheet->setCellValue('F'.$numrow, $data->initial);
          $sheet->setCellValue('G'.$numrow, $data->volume);
          $sheet->setCellValue('H'.$numrow, trim($data->comments));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O2B_Macconkey_IN_'.$datenow.'.csv';

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

/* End of file O2b_macconkey_in.php */
/* Location: ./application/controllers/O2b_macconkey_in.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */