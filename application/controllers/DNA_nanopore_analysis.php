<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class DNA_nanopore_analysis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('DNA_nanopore_analysis_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('DNA_nanopore_analysis_model');
        $data['person'] = $this->DNA_nanopore_analysis_model->getLabtech();
        // $data['type'] = $this->DNA_nanopore_analysis_model->getSampleType();
        $this->template->load('template','DNA_nanopore_analysis/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->DNA_nanopore_analysis_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('barcode_dna',TRUE));
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_dna' => strtoupper($this->input->post('barcode_dna',TRUE)),
            'date_analysis' => $this->input->post('date_analysis',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'barcode_id' => $this->input->post('barcode_id',TRUE),
            'alias' => trim($this->input->post('alias',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->DNA_nanopore_analysis_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_dna' => strtoupper($this->input->post('barcode_dna',TRUE)),
            'date_analysis' => $this->input->post('date_analysis',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'barcode_id' => $this->input->post('barcode_id',TRUE),
            'alias' => trim($this->input->post('alias',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->DNA_nanopore_analysis_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("DNA_nanopore_analysis"));
    }

    public function delete($id) 
    {
        $row = $this->DNA_nanopore_analysis_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->DNA_nanopore_analysis_model->delete($id);
            $this->DNA_nanopore_analysis_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('DNA_nanopore_analysis'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('DNA_nanopore_analysis'));
        }
    }

    public function get_dna_type() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->DNA_nanopore_analysis_model->getDNAType($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->DNA_nanopore_analysis_model->validate1($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function valid_bid() 
    {
        $id1 = $this->input->get('id1');
        $id2 = $this->input->get('id2');
        // echo $id;
        $data = $this->DNA_nanopore_analysis_model->validate2($id1, $id2);

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
        $sheet->setCellValue('A1', "Barcode_DNA"); 
        $sheet->setCellValue('B1', "Date_analysis"); 
        $sheet->setCellValue('C1', "Lab_tech");
        $sheet->setCellValue('D1', "Barcode_ID");
        $sheet->setCellValue('E1', "Alias");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->DNA_nanopore_analysis_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_dna);
          $sheet->setCellValue('B'.$numrow, $data->date_analysis);
          $sheet->setCellValue('C'.$numrow, $data->initial);
          $sheet->setCellValue('D'.$numrow, $data->barcode_id);
          $sheet->setCellValue('E'.$numrow, trim($data->alias));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'DNA_nanopore_analysis_'.$datenow.'.csv';

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

/* End of file DNA_nanopore_analysis.php */
/* Location: ./application/controllers/DNA_nanopore_analysis.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */