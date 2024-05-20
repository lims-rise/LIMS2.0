<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class NHMRC_bootsocks_after extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('NHMRC_bootsocks_after_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $data['person'] = $this->NHMRC_bootsocks_after_model->getLabtech();
        // $data['staff'] = $this->NHMRC_bootsocks_after_model->getAllstaff();
        $this->template->load('template','NHMRC_bootsocks_after/index');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->NHMRC_bootsocks_after_model->json();
    }

    // public function subjson() {
    //     $id=$this->input->get('id');
    //     header('Content-Type: application/json');
    //     echo $this->NHMRC_bootsocks_after_model->subjson($id);
    // }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('barcode_bootsocks',TRUE));
        $dt = new DateTime();

        if ($mode=="insert"){

            $data = array(
                // 'id' => $this->input->post('idbc',TRUE),
                'barcode_bootsocks' => strtoupper($this->input->post('barcode_bootsocks',TRUE)),
                'date_weighed' => $this->input->post('date_weighed',TRUE),
                'bootsock_weight_wet' => $this->input->post('bootsock_weight_wet',TRUE),
                'comments' => trim($this->input->post('comments',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->NHMRC_bootsocks_after_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                // 'id' => $this->input->post('idbc',TRUE),
                'barcode_bootsocks' => strtoupper($this->input->post('barcode_bootsocks',TRUE)),
                'date_weighed' => $this->input->post('date_weighed',TRUE),
                'bootsock_weight_wet' => $this->input->post('bootsock_weight_wet',TRUE),
                'comments' => trim($this->input->post('comments',TRUE)),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->NHMRC_bootsocks_after_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("NHMRC_bootsocks_after"));
    }

    // public function save_detail() 
    // {
    //     $mode_det = $this->input->post('mode_det',TRUE);
    //     $id = $this->input->post('idrec_det',TRUE);
    //     $dt = new DateTime();

    //     if ($mode_det=="insert"){
    //         $data = array(
    //             'barcode_sample' => $this->input->post('barcode_sample',TRUE),
    //             'id_receipt' => $this->input->post('idrec2',TRUE),
    //             'uuid' => $this->uuid->v4(),
    //             'lab' => $this->session->userdata('lab'),
    //             'user_created' => $this->session->userdata('id_users'),
    //             'date_created' => $dt->format('Y-m-d H:i:s'),
    //             );

    //         $this->NHMRC_bootsocks_after_model->insert_det($data);
    //         $this->session->set_flashdata('message', 'Create Record Success');    
    //     }
    //     else if ($mode_det=="edit"){
    //         $data = array(
    //             'barcode_sample' => $this->input->post('barcode_sample',TRUE),
    //             'id_receipt' => $this->input->post('idrec2',TRUE),
    //             'uuid' => $this->uuid->v4(),
    //             'lab' => $this->session->userdata('lab'),
    //             'user_updated' => $this->session->userdata('id_users'),
    //             'date_updated' => $dt->format('Y-m-d H:i:s'),
    //             );

    //         $this->NHMRC_bootsocks_after_model->update_det($id, $data);
    //         $this->session->set_flashdata('message', 'Create Record Success');    
    //     }

    //     redirect(site_url("NHMRC_bootsocks_after"));
    // }

    public function delete($id) 
    {
        $row = $this->NHMRC_bootsocks_after_model->get_by_id($id);
        // $id_rec = $this->NHMRC_bootsocks_after_model->get_by_id_rec($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->NHMRC_bootsocks_after_model->update($id, $data);
            //$this->NHMRC_bootsocks_after_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('NHMRC_bootsocks_after'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('NHMRC_bootsocks_after'));
        }
    }

    // public function delete_det($id) 
    // {
    //     $row = $this->NHMRC_bootsocks_after_model->get_by_id_detail($id);

    //     $data = array(
    //         'flag' => 1,
    //         );

    //     if ($row) {
    //         $this->NHMRC_bootsocks_after_model->update_det($id, $data);
    //         $this->session->set_flashdata('message', 'Delete Record Success');
    //         redirect(site_url('NHMRC_bootsocks_after'));
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('NHMRC_bootsocks_after'));
    //     }
    // }    

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $type = $this->input->get('id2');
        $data = $this->NHMRC_bootsocks_after_model->validate1($id, $type);

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
        $sheet->setCellValue('A1', "Barcode_bootsocks"); 
        $sheet->setCellValue('B1', "Date_weighed"); 
        $sheet->setCellValue('C1', "Weight_wet");
        $sheet->setCellValue('D1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->NHMRC_bootsocks_after_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_bootsocks);
          $sheet->setCellValue('B'.$numrow, $data->date_weighed);
          $sheet->setCellValue('C'.$numrow, $data->bootsock_weight_wet);
          $sheet->setCellValue('D'.$numrow, trim($data->comments));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'NHMRC_BT_weights_after_'.$datenow.'.csv';

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

/* End of file NHMRC_bootsocks_after.php */
/* Location: ./application/controllers/NHMRC_bootsocks_after.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */