<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class DNA_sample_control extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('DNA_sample_control_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('DNA_sample_control_model');
        // $data['person'] = $this->DNA_sample_control_model->getLabtech();
        $data['dnatype'] = $this->DNA_sample_control_model->getSampleDNA();
        $this->template->load('template','dna_sample_control/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->DNA_sample_control_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('barcode_sample',TRUE));
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'barcode_vessel' => strtoupper($this->input->post('barcode_vessel',TRUE)),
            'barcode_vessel2' => strtoupper($this->input->post('barcode_vessel2',TRUE)),
            'barcode_vessel3' => strtoupper($this->input->post('barcode_vessel3',TRUE)),
            'barcode_vessel4' => strtoupper($this->input->post('barcode_vessel4',TRUE)),
            'barcode_vessel5' => strtoupper($this->input->post('barcode_vessel5',TRUE)),
            'id_sample' => $this->input->post('id_sample',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->DNA_sample_control_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'barcode_vessel' => strtoupper($this->input->post('barcode_vessel',TRUE)),
            'barcode_vessel2' => strtoupper($this->input->post('barcode_vessel2',TRUE)),
            'barcode_vessel3' => strtoupper($this->input->post('barcode_vessel3',TRUE)),
            'barcode_vessel4' => strtoupper($this->input->post('barcode_vessel4',TRUE)),
            'barcode_vessel5' => strtoupper($this->input->post('barcode_vessel5',TRUE)),
            'id_sample' => $this->input->post('id_sample',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->DNA_sample_control_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("dna_sample_control"));
    }

    public function delete($id) 
    {
        $row = $this->DNA_sample_control_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->DNA_sample_control_model->delete($id);
            $this->DNA_sample_control_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dna_sample_control'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dna_sample_control'));
        }
    }

    // public function valid_bs() 
    // {
    //     $id = $this->input->get('id1');
    //     // echo $id;
    //     $data = $this->DNA_sample_control_model->validate1($id);

    //     header('Content-Type: application/json');
    //     echo json_encode($data);
    //     // return $this->response->setJSON($data);
    //     // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
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
        $sheet->setCellValue('A1', "Barcode_sample"); 
        $sheet->setCellValue('B1', "Sample_type");
        $sheet->setCellValue('C1', "Barcode_vessel"); 
        $sheet->setCellValue('D1', "Barcode_vessel2"); 
        $sheet->setCellValue('E1', "Barcode_vessel3"); 
        $sheet->setCellValue('F1', "Barcode_vessel4"); 
        $sheet->setCellValue('G1', "Barcode_vessel5"); 
        $sheet->setCellValue('H1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->DNA_sample_control_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->sample);
          $sheet->setCellValue('C'.$numrow, $data->barcode_vessel);
          $sheet->setCellValue('D'.$numrow, $data->barcode_vessel2);
          $sheet->setCellValue('E'.$numrow, $data->barcode_vessel3);
          $sheet->setCellValue('F'.$numrow, $data->barcode_vessel4);
          $sheet->setCellValue('G'.$numrow, $data->barcode_vessel5);
          $sheet->setCellValue('H'.$numrow, trim($data->comments));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'DNA_Sample_Control_'.$datenow.'.csv';

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

/* End of file DNA_sample_control.php */
/* Location: ./application/controllers/DNA_sample_control.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */