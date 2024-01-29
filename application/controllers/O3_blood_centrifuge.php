<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O3_blood_centrifuge extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O3_blood_centrifuge_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['person'] = $this->O3_blood_centrifuge_model->getLabtech();
        $this->template->load('template','o3_blood_centrifuge/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O3_blood_centrifuge_model->json();
    }

    public function subjson() {
        $id=$this->input->get('id');
        header('Content-Type: application/json');
        echo $this->O3_blood_centrifuge_model->subjson($id);
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('idbc',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){

            $data = array(
                // 'id' => $this->input->post('idbc',TRUE),
                'date_process' => $this->input->post('date_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'centrifuge_time' => $this->input->post('centrifuge_time',TRUE),
                'comments' => trim($this->input->post('comments',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O3_blood_centrifuge_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                // 'id' => $this->input->post('idbc',TRUE),
                'date_process' => $this->input->post('date_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'centrifuge_time' => $this->input->post('centrifuge_time',TRUE),
                'comments' => trim($this->input->post('comments',TRUE)),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O3_blood_centrifuge_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("o3_blood_centrifuge"));
    }

    public function save_detail() 
    {
        $mode_det = $this->input->post('mode_det',TRUE);
        $id = $this->input->post('barcode_sample',TRUE);
        $dt = new DateTime();

        if ($mode_det=="insert"){
            $data = array(
                'barcode_sample' => $this->input->post('barcode_sample',TRUE),
                'comments' => trim($this->input->post('comments_det',TRUE)),
                'id_bc' => $this->input->post('idbc_det',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O3_blood_centrifuge_model->insert_det($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode_det=="edit"){
            $data = array(
                'barcode_sample' => $this->input->post('barcode_sample',TRUE),
                'comments' => trim($this->input->post('comments_det',TRUE)),
                'id_bc' => $this->input->post('idbc_det',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O3_blood_centrifuge_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("o3_blood_centrifuge"));
    }

    public function delete($id) 
    {
        $row = $this->O3_blood_centrifuge_model->get_by_id($id);
        $id_bc = $this->O3_blood_centrifuge_model->get_by_id_bc($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O3_blood_centrifuge_model->update($id, $data);
            $this->O3_blood_centrifuge_model->update_det($id_bc, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o3_blood_centrifuge'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o3_blood_centrifuge'));
        }
    }

    public function delete_det($id) 
    {
        $row = $this->O3_blood_centrifuge_model->get_by_id_detail($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O3_blood_centrifuge_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o3_blood_centrifuge'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o3_blood_centrifuge'));
        }
    }    

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $data = $this->O3_blood_centrifuge_model->validate1($id);

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
        $sheet->setCellValue('A1', "ID"); 
        $sheet->setCellValue('B1', "Date_process"); 
        $sheet->setCellValue('C1', "Lab_tech");
        $sheet->setCellValue('D1', "Centrifuge_time");
        $sheet->setCellValue('E1', "Comments");
        $sheet->setCellValue('F1', "Barcode_sample");
        $sheet->setCellValue('G1', "Comments_sample");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O3_blood_centrifuge_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->id);
          $sheet->setCellValue('B'.$numrow, $data->date_process);
          $sheet->setCellValue('C'.$numrow, $data->initial);
          $sheet->setCellValue('D'.$numrow, $data->centrifuge_time);
          $sheet->setCellValue('E'.$numrow, $data->comments);
          $sheet->setCellValue('F'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('G'.$numrow, trim($data->comments_sample));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O3_Blood_Centrifuge_'.$datenow.'.csv';

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

/* End of file o3_blood_centrifuge.php */
/* Location: ./application/controllers/o3_blood_centrifuge.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */