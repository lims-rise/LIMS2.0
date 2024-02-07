<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O2b_bootsocks_stomacher extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O2b_bootsocks_stomacher_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $data['person'] = $this->O2b_bootsocks_stomacher_model->getLabtech();
        $this->template->load('template','O2b_bootsocks_stomacher/index');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O2b_bootsocks_stomacher_model->json();
    }

    public function subjson() {
        $id=$this->input->get('id');
        header('Content-Type: application/json');
        echo $this->O2b_bootsocks_stomacher_model->subjson($id);
    }

    public function subjson2() {
        $id=$this->input->get('id');
        header('Content-Type: application/json');
        echo $this->O2b_bootsocks_stomacher_model->subjson2($id);
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        // $id = $this->input->post('idbc',TRUE);
        $id1 = strtoupper($this->input->post('barcode_sample',TRUE));
        $id2 = $this->input->post('elution_no',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){

            $data = array(
                'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
                'date_conduct' => $this->input->post('date_conduct',TRUE),
                'elution_no' => $this->input->post('elution_no',TRUE),
                'barcode_bootsock' => strtoupper($this->input->post('barcode_bootsock',TRUE)),
                'elution' => $this->input->post('elution',TRUE),
                'elu_comments' => $this->input->post('elu_comments',TRUE),
                'barcode_falcon' => strtoupper($this->input->post('barcode_falcon',TRUE)),
                'volume_stomacher' => $this->input->post('volume_stomacher',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2b_bootsocks_stomacher_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
                'date_conduct' => $this->input->post('date_conduct',TRUE),
                'barcode_bootsock' => strtoupper($this->input->post('barcode_bootsock',TRUE)),
                'elution' => $this->input->post('elution',TRUE),
                'elu_comments' => $this->input->post('elu_comments',TRUE),
                'barcode_falcon' => strtoupper($this->input->post('barcode_falcon',TRUE)),
                'volume_stomacher' => $this->input->post('volume_stomacher',TRUE),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2b_bootsocks_stomacher_model->update2($id1, $id2, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("O2b_bootsocks_stomacher"));
    }

    public function save_detail1() 
    {
        $mode_det1 = $this->input->post('mode_det1',TRUE);
        $id = strtoupper($this->input->post('barcode_bootsock1',TRUE));
        $dt = new DateTime();

        if ($mode_det1=="insert"){
            $data = array(
                'barcode_sample' => strtoupper($this->input->post('barcode_bootsock1',TRUE)),
                'barcode_endetec' => strtoupper($this->input->post('barcode_endetec',TRUE)),
                'barcode_falcon_en1' => strtoupper($this->input->post('barcode_falcon_en1',TRUE)),
                'volume_falcon_en1' => $this->input->post('volume_falcon_en1',TRUE),
                'barcode_falcon_en2' => strtoupper($this->input->post('barcode_falcon_en2',TRUE)),
                'volume_falcon_en2' => $this->input->post('volume_falcon_en2',TRUE),
                'dilution_en' => $this->input->post('dilution_en',TRUE),
                'time_incubation_en' => $this->input->post('time_incubation_en',TRUE),
                'comments_en' => trim($this->input->post('comments_en',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2b_bootsocks_stomacher_model->insert_det1($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode_det1=="edit"){
            $data = array(
                'barcode_sample' => strtoupper($this->input->post('barcode_bootsock1',TRUE)),
                'barcode_endetec' => strtoupper($this->input->post('barcode_endetec',TRUE)),
                'barcode_falcon_en1' => strtoupper($this->input->post('barcode_falcon_en1',TRUE)),
                'volume_falcon_en1' => $this->input->post('volume_falcon_en1',TRUE),
                'barcode_falcon_en2' => strtoupper($this->input->post('barcode_falcon_en2',TRUE)),
                'volume_falcon_en2' => $this->input->post('volume_falcon_en2',TRUE),
                'dilution_en' => $this->input->post('dilution_en',TRUE),
                'time_incubation_en' => $this->input->post('time_incubation_en',TRUE),
                'comments_en' => trim($this->input->post('comments_en',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2b_bootsocks_stomacher_model->update_det1($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("O2b_bootsocks_stomacher"));
    }

    public function save_detail2() 
    {
        $mode_det2 = $this->input->post('mode_det2',TRUE);
        $id = strtoupper($this->input->post('barcode_bootsock2',TRUE));
        $dt = new DateTime();

        if ($mode_det2=="insert"){
            $data = array(
                'barcode_sample' => strtoupper($this->input->post('barcode_bootsock2',TRUE)),
                'barcode_colilert' => strtoupper($this->input->post('barcode_colilert',TRUE)),
                'barcode_falcon_id1' => strtoupper($this->input->post('barcode_falcon_id1',TRUE)),
                'volume_falcon_id1' => $this->input->post('volume_falcon_id1',TRUE),
                'barcode_falcon_id2' => strtoupper($this->input->post('barcode_falcon_id2',TRUE)),
                'volume_falcon_id2' => $this->input->post('volume_falcon_id2',TRUE),
                'dilution_id' => $this->input->post('dilution_id',TRUE),
                'time_incubation_id' => $this->input->post('time_incubation_id',TRUE),
                'comments_id' => trim($this->input->post('comments_id',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2b_bootsocks_stomacher_model->insert_det2($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode_det2=="edit"){
            $data = array(
                'barcode_sample' => strtoupper($this->input->post('barcode_bootsock2',TRUE)),
                'barcode_colilert' => strtoupper($this->input->post('barcode_colilert',TRUE)),
                'barcode_falcon_id1' => strtoupper($this->input->post('barcode_falcon_id1',TRUE)),
                'volume_falcon_id1' => $this->input->post('volume_falcon_id1',TRUE),
                'barcode_falcon_id2' => strtoupper($this->input->post('barcode_falcon_id2',TRUE)),
                'volume_falcon_id2' => $this->input->post('volume_falcon_id2',TRUE),
                'dilution_id' => $this->input->post('dilution_id',TRUE),
                'time_incubation_id' => $this->input->post('time_incubation_id',TRUE),
                'comments_id' => trim($this->input->post('comments_id',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O2b_bootsocks_stomacher_model->update_det2($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("O2b_bootsocks_stomacher"));
    }


    public function delete($id) 
    {
        $row = $this->O2b_bootsocks_stomacher_model->get_by_id($id);
        $id_bc = $this->O2b_bootsocks_stomacher_model->get_by_id_bc($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O2b_bootsocks_stomacher_model->update($id, $data);
            $this->O2b_bootsocks_stomacher_model->update_det($id_bc, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('O2b_bootsocks_stomacher'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('O2b_bootsocks_stomacher'));
        }
    }

    public function delete_det($id) 
    {
        $row = $this->O2b_bootsocks_stomacher_model->get_by_id_detail($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O2b_bootsocks_stomacher_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('O2b_bootsocks_stomacher'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('O2b_bootsocks_stomacher'));
        }
    }    

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $data = $this->O2b_bootsocks_stomacher_model->validate1($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    // public function valid_boots() 
    // {
    //     $id = $this->input->get('id1');
    //     $data = $this->O2b_bootsocks_stomacher_model->validate2($id);

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
        $sheet->setCellValue('B1', "Date_conduct");
        $sheet->setCellValue('C1', "Barcode_bootsocks1");
        $sheet->setCellValue('D1', "Elution_number_Micro1");
        $sheet->setCellValue('E1', "Elution_Micro1");
        $sheet->setCellValue('F1', "Elution_Micro1_comment");
        $sheet->setCellValue('G1', "Barcode_falcon_Micro1");
        $sheet->setCellValue('H1', "Volume_Micro1");
        $sheet->setCellValue('I1', "Elution_number_Micro2");
        $sheet->setCellValue('J1', "Elution_Micro2");
        $sheet->setCellValue('K1', "Elution_Micro2_comment");
        $sheet->setCellValue('L1', "Barcode_falcon_Micro2");
        $sheet->setCellValue('M1', "Volume_Micro2");
        $sheet->setCellValue('N1', "Barcode_bootsocks2");
        $sheet->setCellValue('O1', "Elution_number_Moisture1");
        $sheet->setCellValue('P1', "Elution_Moisture1");
        $sheet->setCellValue('Q1', "Elution_Moisture1_comment");
        $sheet->setCellValue('R1', "Barcode_falcon_Moisture1");
        $sheet->setCellValue('S1', "Volume_Moisture1");
        $sheet->setCellValue('T1', "Elution_number_Moisture2");
        $sheet->setCellValue('U1', "Elution_Moisture2");
        $sheet->setCellValue('V1', "Elution_Moisture2_comment");
        $sheet->setCellValue('W1', "Barcode_falcon_Moisture2");
        $sheet->setCellValue('X1', "Volume_Moisture2");
        $sheet->setCellValue('Y1', "Endetec_barcode_endetec");
        $sheet->setCellValue('Z1', "Endetec_barcode_falcon1");
        $sheet->setCellValue('AA1', "Endetec_volume_falcon1");
        $sheet->setCellValue('AB1', "Endetec_barcode_falcon2");
        $sheet->setCellValue('AC1', "Endetec_volume_falcon2");
        $sheet->setCellValue('AD1', "Endetec_dilution");
        $sheet->setCellValue('AE1', "Endetec_time_incu_start");
        $sheet->setCellValue('AF1', "Endetec_comments");
        $sheet->setCellValue('AG1', "Idexx_barcode_colilert");
        $sheet->setCellValue('AH1', "Idexx_barcode_falcon1");
        $sheet->setCellValue('AI1', "Idexx_volume_falcon1");
        $sheet->setCellValue('AJ1', "Idexx_barcode_falcon2");
        $sheet->setCellValue('AK1', "Idexx_volume_falcon2");
        $sheet->setCellValue('AL1', "Idexx_dilution");
        $sheet->setCellValue('AM1', "Idexx_time_incu_start");
        $sheet->setCellValue('AN1', "Idexx_comments");    
        
        
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O2b_bootsocks_stomacher_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' .$numrow, $data->barcode_sample);
            $sheet->setCellValue('B' .$numrow, $data->stomacher_date_conduct);
            $sheet->setCellValue('C' .$numrow, $data->stomacher_barcode_bootsocks1);
            $sheet->setCellValue('D' .$numrow, $data->stomacher_elution_number_Micro1);
            $sheet->setCellValue('E' .$numrow, $data->stomacher_elution_Micro1);
            $sheet->setCellValue('F' .$numrow, trim($data->stomacher_elution_Micro1_comment));
            $sheet->setCellValue('G' .$numrow, $data->stomacher_barcode_falcon_Micro1);
            $sheet->setCellValue('H' .$numrow, $data->stomacher_volume_Micro1);
            $sheet->setCellValue('I' .$numrow, $data->stomacher_elution_number_Micro2);
            $sheet->setCellValue('j' .$numrow, $data->stomacher_elution_Micro2);
            $sheet->setCellValue('K' .$numrow, trim($data->stomacher_elution_Micro2_comment));
            $sheet->setCellValue('L' .$numrow, $data->stomacher_barcode_falcon_Micro2);
            $sheet->setCellValue('M' .$numrow, $data->stomacher_volume_Micro2);        
            $sheet->setCellValue('N' .$numrow, $data->stomacher_barcode_bootsocks2);
            $sheet->setCellValue('O' .$numrow, $data->stomacher_elution_number_Moisture1);
            $sheet->setCellValue('P' .$numrow, $data->stomacher_elution_Moisture1);
            $sheet->setCellValue('Q' .$numrow, trim($data->stomacher_elution_Moisture1_comment));
            $sheet->setCellValue('R' .$numrow, $data->stomacher_barcode_falcon_Moisture1);
            $sheet->setCellValue('S' .$numrow, $data->stomacher_volume_Moisture1);
            $sheet->setCellValue('T' .$numrow, $data->stomacher_elution_number_Moisture2);
            $sheet->setCellValue('U' .$numrow, $data->stomacher_elution_Moisture2);
            $sheet->setCellValue('V' .$numrow, trim($data->stomacher_elution_Moisture2_comment));
            $sheet->setCellValue('W' .$numrow, $data->stomacher_barcode_falcon_Moisture2);
            $sheet->setCellValue('X' .$numrow, $data->stomacher_volume_Moisture2);     
            $sheet->setCellValue('Y' .$numrow, $data->stom_endet_barcode_endetec);
            $sheet->setCellValue('Z' .$numrow, $data->stom_endet_barcode_falcon1);
            $sheet->setCellValue('AA'.$numrow, $data->stom_endet_volume_falcon1);
            $sheet->setCellValue('AB'.$numrow, $data->stom_endet_barcode_falcon2);
            $sheet->setCellValue('AC'.$numrow, $data->stom_endet_volume_falcon2);
            $sheet->setCellValue('AD'.$numrow, $data->stom_endet_dilution);
            $sheet->setCellValue('AE'.$numrow, $data->stom_endet_time_incu_start);
            $sheet->setCellValue('AF'.$numrow, trim($data->stom_endet_comments));
            $sheet->setCellValue('AG'.$numrow, $data->stom_idexx_barcode_colilert);
            $sheet->setCellValue('AH'.$numrow, $data->stom_idexx_barcode_falcon1);
            $sheet->setCellValue('AI'.$numrow, $data->stom_idexx_volume_falcon1);
            $sheet->setCellValue('AJ'.$numrow, $data->stom_idexx_barcode_falcon2);
            $sheet->setCellValue('AK'.$numrow, $data->stom_idexx_volume_falcon2);
            $sheet->setCellValue('AL'.$numrow, $data->stom_idexx_dilution);
            $sheet->setCellValue('AM'.$numrow, $data->stom_idexx_time_incu_start);
            $sheet->setCellValue('AN'.$numrow, trim($data->stom_idexx_comments)); 
          //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O2B_BOOTSOCKS_Stomacher_'.$datenow.'.csv';

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

/* End of file O2b_bootsocks_stomacher.php */
/* Location: ./application/controllers/O2b_bootsocks_stomacher.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */