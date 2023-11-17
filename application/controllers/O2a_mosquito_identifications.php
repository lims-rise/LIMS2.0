<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O2a_mosquito_identifications extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O2a_mosquito_identifications_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O2a_mosquito_identifications_model');
        $data['person'] = $this->O2a_mosquito_identifications_model->getLabtech();
        $this->template->load('template','o2a_mosquito_identifications/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O2a_mosquito_identifications_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('bar_storagebag',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'bar_storagebag' => $this->input->post('bar_storagebag',TRUE),
            'date_ident' => $this->input->post('date_ident',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'catch_met' => $this->input->post('catch_met',TRUE),
            'no_mosquito' => $this->input->post('no_mosquito',TRUE),
            'aedes_aegypt_male' => $this->input->post('aedes_aegypt_male',TRUE),
            'aedes_aegypt_female' => $this->input->post('aedes_aegypt_female',TRUE),
            'aedes_albopictus_male' => $this->input->post('aedes_albopictus_male',TRUE),
            'aedes_albopictus_female' => $this->input->post('aedes_albopictus_female',TRUE),
            'aedes_polynesiensis_male' => $this->input->post('aedes_polynesiensis_male',TRUE),
            'aedes_polynesiensis_female' => $this->input->post('aedes_polynesiensis_female',TRUE),
            'aedes_other_male' => $this->input->post('aedes_other_male',TRUE),
            'aedes_other_female' => $this->input->post('aedes_other_female',TRUE),
            'culex_male' => $this->input->post('culex_male',TRUE),
            'culex_female' => $this->input->post('culex_female',TRUE),
            'culex_sitiens_male' => $this->input->post('culex_sitiens_male',TRUE),
            'culex_sitiens_female' => $this->input->post('culex_sitiens_female',TRUE),
            'culexann_male' => $this->input->post('culexann_male',TRUE),
            'culexann_female' => $this->input->post('culexann_female',TRUE),    
            'culex_other_male' => $this->input->post('culex_other_male',TRUE),
            'culex_other_female' => $this->input->post('culex_other_female',TRUE),    
            'anopheles_male' => $this->input->post('anopheles_male',TRUE),
            'anopheles_female' => $this->input->post('anopheles_female',TRUE),    
            'uranotaenia_male' => $this->input->post('uranotaenia_male',TRUE),
            'uranotaenia_female' => $this->input->post('uranotaenia_female',TRUE),    
            'mansonia_male' => $this->input->post('mansonia_male',TRUE),
            'mansonia_female' => $this->input->post('mansonia_female',TRUE),    
            'other_male' => $this->input->post('other_male',TRUE),
            'other_female' => $this->input->post('other_female',TRUE),    
            'culex_larvae' => $this->input->post('culex_larvae',TRUE),
            'aedes_larvae' => $this->input->post('aedes_larvae',TRUE),    
            'unidentify' => $this->input->post('unidentify',TRUE),    
            'notes' => $this->input->post('notes',TRUE),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
        );
 
            $this->O2a_mosquito_identifications_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                'bar_storagebag' => $this->input->post('bar_storagebag',TRUE),
                'date_ident' => $this->input->post('date_ident',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'catch_met' => $this->input->post('catch_met',TRUE),
                'no_mosquito' => $this->input->post('no_mosquito',TRUE),
                'aedes_aegypt_male' => $this->input->post('aedes_aegypt_male',TRUE),
                'aedes_aegypt_female' => $this->input->post('aedes_aegypt_female',TRUE),
                'aedes_albopictus_male' => $this->input->post('aedes_albopictus_male',TRUE),
                'aedes_albopictus_female' => $this->input->post('aedes_albopictus_female',TRUE),
                'aedes_polynesiensis_male' => $this->input->post('aedes_polynesiensis_male',TRUE),
                'aedes_polynesiensis_female' => $this->input->post('aedes_polynesiensis_female',TRUE),
                'aedes_other_male' => $this->input->post('aedes_other_male',TRUE),
                'aedes_other_female' => $this->input->post('aedes_other_female',TRUE),
                'culex_male' => $this->input->post('culex_male',TRUE),
                'culex_female' => $this->input->post('culex_female',TRUE),
                'culex_sitiens_male' => $this->input->post('culex_sitiens_male',TRUE),
                'culex_sitiens_female' => $this->input->post('culex_sitiens_female',TRUE),
                'culexann_male' => $this->input->post('culexann_male',TRUE),
                'culexann_female' => $this->input->post('culexann_female',TRUE),    
                'culex_other_male' => $this->input->post('culex_other_male',TRUE),
                'culex_other_female' => $this->input->post('culex_other_female',TRUE),    
                'anopheles_male' => $this->input->post('anopheles_male',TRUE),
                'anopheles_female' => $this->input->post('anopheles_female',TRUE),    
                'uranotaenia_male' => $this->input->post('uranotaenia_male',TRUE),
                'uranotaenia_female' => $this->input->post('uranotaenia_female',TRUE),    
                'mansonia_male' => $this->input->post('mansonia_male',TRUE),
                'mansonia_female' => $this->input->post('mansonia_female',TRUE),    
                'other_male' => $this->input->post('other_male',TRUE),
                'other_female' => $this->input->post('other_female',TRUE),    
                'culex_larvae' => $this->input->post('culex_larvae',TRUE),
                'aedes_larvae' => $this->input->post('aedes_larvae',TRUE),    
                'unidentify' => $this->input->post('unidentify',TRUE),    
                'notes' => $this->input->post('notes',TRUE),    
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->O2a_mosquito_identifications_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("o2a_mosquito_identifications"));
    }

    public function delete($id) 
    {
        $row = $this->O2a_mosquito_identifications_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->O2a_mosquito_identifications_model->delete($id);
            $this->O2a_mosquito_identifications_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o2a_mosquito_identifications'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o2a_mosquito_identifications'));
        }
    }

    public function valid_bs()
    {
        $id = $this->input->get('id1');
        $type = $this->input->get('id2');
        $data = $this->O2a_mosquito_identifications_model->validate1($id, $type);
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
        $sheet->setCellValue('A1', "Barcode_storagebag"); 
        $sheet->setCellValue('B1', "Initial_Person"); 
        $sheet->setCellValue('C1', "Date_identification");
        $sheet->setCellValue('D1', "Catch_methode");
        $sheet->setCellValue('E1', "SumMosquito");
        $sheet->setCellValue('F1', "Aedes_aegypt_male");
        $sheet->setCellValue('G1', "Aedes_aegypt_female");
        $sheet->setCellValue('H1', "Aedes_albopictus_male");
        $sheet->setCellValue('I1', "Aedes_albopictus_female");
        $sheet->setCellValue('J1', "Aedes_polynesiensis_male");
        $sheet->setCellValue('K1', "Aedes_polynesiensis_female");
        $sheet->setCellValue('L1', "Aedes_other_male");
        $sheet->setCellValue('M1', "Aedes_other_female");
        $sheet->setCellValue('N1', "Culex_male");
        $sheet->setCellValue('O1', "Culex_female");
        $sheet->setCellValue('P1', "Culex_sitiens_male");
        $sheet->setCellValue('Q1', "Culex_sitiens_female");
        $sheet->setCellValue('R1', "Culexann_male");
        $sheet->setCellValue('S1', "Culexann_female");
        $sheet->setCellValue('T1', "Culex_other_male");
        $sheet->setCellValue('U1', "Culex_other_female");
        $sheet->setCellValue('V1', "Anopheles_male");
        $sheet->setCellValue('W1', "Anopheles_female");
        $sheet->setCellValue('X1', "Uranotaenia_male");
        $sheet->setCellValue('Y1', "Uranotaenia_female");
        $sheet->setCellValue('Z1', "Mansonia_male");
        $sheet->setCellValue('AA1', "Mansonia_female");
        $sheet->setCellValue('AB1', "Other_male");
        $sheet->setCellValue('AC1', "Other_female");
        $sheet->setCellValue('AD1', "Culex_larvae");
        $sheet->setCellValue('AE1', "Aedes_larvae");
        $sheet->setCellValue('AF1', "Unidentify");
        $sheet->setCellValue('AG1', "Notes");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O2a_mosquito_identifications_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->bar_storagebag);
          $sheet->setCellValue('B'.$numrow, $data->initial);
          $sheet->setCellValue('C'.$numrow, $data->date_ident);
          $sheet->setCellValue('D'.$numrow, $data->catch_met);
          $sheet->setCellValue('E'.$numrow, $data->no_mosquito);
          $sheet->setCellValue('F'.$numrow, $data->aedes_aegypt_male);
          $sheet->setCellValue('G'.$numrow, $data->aedes_aegypt_female);
          $sheet->setCellValue('H'.$numrow, $data->aedes_albopictus_male);
          $sheet->setCellValue('I'.$numrow, $data->aedes_albopictus_female);
          $sheet->setCellValue('J'.$numrow, $data->aedes_polynesiensis_male);
          $sheet->setCellValue('K'.$numrow, $data->aedes_polynesiensis_female);
          $sheet->setCellValue('L'.$numrow, $data->aedes_other_male);
          $sheet->setCellValue('M'.$numrow, $data->aedes_other_female);
          $sheet->setCellValue('N'.$numrow, $data->culex_male);
          $sheet->setCellValue('O'.$numrow, $data->culex_female);
          $sheet->setCellValue('P'.$numrow, $data->culex_sitiens_male);
          $sheet->setCellValue('Q'.$numrow, $data->culex_sitiens_female);
          $sheet->setCellValue('R'.$numrow, $data->culexann_male);
          $sheet->setCellValue('S'.$numrow, $data->culexann_female);
          $sheet->setCellValue('T'.$numrow, $data->culex_other_male);
          $sheet->setCellValue('U'.$numrow, $data->culex_other_female);
          $sheet->setCellValue('V'.$numrow, $data->anopheles_male);
          $sheet->setCellValue('W'.$numrow, $data->anopheles_female);
          $sheet->setCellValue('X'.$numrow, $data->uranotaenia_male);
          $sheet->setCellValue('Y'.$numrow, $data->uranotaenia_female);
          $sheet->setCellValue('Z'.$numrow, $data->mansonia_male);
          $sheet->setCellValue('AA'.$numrow, $data->mansonia_female);
          $sheet->setCellValue('AB'.$numrow, $data->other_male);
          $sheet->setCellValue('AC'.$numrow, $data->other_female);
          $sheet->setCellValue('AD'.$numrow, $data->culex_larvae);
          $sheet->setCellValue('AE'.$numrow, $data->aedes_larvae);
          $sheet->setCellValue('AF'.$numrow, $data->unidentify);
          $sheet->setCellValue('AG'.$numrow, trim($data->notes));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O2A_Mosquito_Ident_'.$datenow.'.csv';

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

/* End of file O2a_mosquito_identifications.php */
/* Location: ./application/controllers/O2a_mosquito_identifications.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */