<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class NHMRC_sample_prep extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('NHMRC_sample_prep_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $data['person'] = $this->NHMRC_sample_prep_model->getLabtech();
        $this->template->load('template','NHMRC_sample_prep/index');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->NHMRC_sample_prep_model->json();
    }

    // public function subjson() {
    //     $id=$this->input->get('id');
    //     header('Content-Type: application/json');
    //     echo $this->NHMRC_sample_prep_model->subjson($id);
    // }

    public function subjson2() {
        $id=$this->input->get('id');
        header('Content-Type: application/json');
        echo $this->NHMRC_sample_prep_model->subjson2($id);
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('barcode_sample',TRUE));
        $dt = new DateTime();

        if ($mode=="insert"){

            $data = array(
                'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
                'date_conduct' => $this->input->post('date_conduct',TRUE),
                'elution_no' => $this->input->post('elution_no',TRUE),
                'barcode_food' => $this->input->post('barcode_food',TRUE),
                'elution' => $this->input->post('elution',TRUE),
                'elu_comments' => $this->input->post('elu_comments',TRUE),
                'barcode_falcon1' => strtoupper($this->input->post('barcode_falcon1',TRUE)),
                'barcode_falcon2' => strtoupper($this->input->post('barcode_falcon2',TRUE)),
                'food_weight' => $this->input->post('food_weight',TRUE),
                'food_comments' => $this->input->post('food_comments',TRUE),
                'volume_stomacher' => $this->input->post('volume_stomacher',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->NHMRC_sample_prep_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
                'date_conduct' => $this->input->post('date_conduct',TRUE),
                'elution_no' => $this->input->post('elution_no',TRUE),
                'barcode_food' => $this->input->post('barcode_food',TRUE),
                'elution' => $this->input->post('elution',TRUE),
                'elu_comments' => $this->input->post('elu_comments',TRUE),
                'barcode_falcon1' => strtoupper($this->input->post('barcode_falcon1',TRUE)),
                'barcode_falcon2' => strtoupper($this->input->post('barcode_falcon2',TRUE)),
                'food_weight' => $this->input->post('food_weight',TRUE),
                'food_comments' => $this->input->post('food_comments',TRUE),
                'volume_stomacher' => $this->input->post('volume_stomacher',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->NHMRC_sample_prep_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("NHMRC_sample_prep"));
    }

    public function save_detail2() 
    {
        $mode_det2 = $this->input->post('mode_det2',TRUE);
        $id = strtoupper($this->input->post('barcode_sample2',TRUE));
        $dt = new DateTime();

        if ($mode_det2=="insert"){
            $data = array(
                'barcode_food' => strtoupper($this->input->post('barcode_food2',TRUE)),
                'barcode_colilert' => strtoupper($this->input->post('barcode_colilert',TRUE)),
                'barcode_falcon1' => strtoupper($this->input->post('barcode_falcon1',TRUE)),
                'volume_falcon1' => $this->input->post('volume_falcon1',TRUE),
                'barcode_falcon2' => strtoupper($this->input->post('barcode_falcon2',TRUE)),
                'volume_falcon2' => $this->input->post('volume_falcon2',TRUE),
                'dilution' => $this->input->post('dilution_id',TRUE),
                'time_incubation' => $this->input->post('time_incubation_id',TRUE),
                'comments' => trim($this->input->post('comments_id',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->NHMRC_sample_prep_model->insert_det2($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode_det2=="edit"){
            $data = array(
                'barcode_food' => strtoupper($this->input->post('barcode_food2',TRUE)),
                'barcode_colilert' => strtoupper($this->input->post('barcode_colilert',TRUE)),
                'barcode_falcon1' => strtoupper($this->input->post('barcode_falcon1',TRUE)),
                'volume_falcon1' => $this->input->post('volume_falcon1',TRUE),
                'barcode_falcon2' => strtoupper($this->input->post('barcode_falcon2',TRUE)),
                'volume_falcon2' => $this->input->post('volume_falcon2',TRUE),
                'dilution' => $this->input->post('dilution_id',TRUE),
                'time_incubation' => $this->input->post('time_incubation_id',TRUE),
                'comments' => trim($this->input->post('comments_id',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->NHMRC_sample_prep_model->update_det2($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("NHMRC_sample_prep"));
    }


    public function delete($id) 
    {
        $row = $this->NHMRC_sample_prep_model->get_by_id($id);
        $id_bc = $this->NHMRC_sample_prep_model->get_by_id_bc($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->NHMRC_sample_prep_model->update($id, $data);
            $this->NHMRC_sample_prep_model->update_det($id_bc, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('NHMRC_sample_prep'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('NHMRC_sample_prep'));
        }
    }

    public function delete_det($id) 
    {
        $row = $this->NHMRC_sample_prep_model->get_by_id_detail($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->NHMRC_sample_prep_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('NHMRC_sample_prep'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('NHMRC_sample_prep'));
        }
    }    

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $data = $this->NHMRC_sample_prep_model->validate1($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    // public function valid_boots() 
    // {
    //     $id = $this->input->get('id1');
    //     $data = $this->NHMRC_sample_prep_model->validate2($id);

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
        $sheet->setCellValue('C1', "Date_conduct");
        $sheet->setCellValue('D1', "Elution_no");
        $sheet->setCellValue('E1', "Barcode_food");
        $sheet->setCellValue('F1', "Elution");
        $sheet->setCellValue('G1', "Elution_comments");
        $sheet->setCellValue('H1', "Food_weight");
        $sheet->setCellValue('I1', "Barcode_colilert");
        $sheet->setCellValue('J1', "Barcode_valcon1");
        $sheet->setCellValue('K1', "Volume_valcon1");
        $sheet->setCellValue('L1', "Barcode_valcon2");
        $sheet->setCellValue('M1', "Volume_valcon2");
        $sheet->setCellValue('N1', "Dilution");
        $sheet->setCellValue('O1', "Time_incubation");
        $sheet->setCellValue('P1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->NHMRC_sample_prep_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->sampletype);
          $sheet->setCellValue('C'.$numrow, $data->date_conduct);
          $sheet->setCellValue('D'.$numrow, $data->elution_no);
          $sheet->setCellValue('E'.$numrow, $data->barcode_food);
          $sheet->setCellValue('F'.$numrow, $data->elution);
          $sheet->setCellValue('G'.$numrow, $data->elu_comments);
          $sheet->setCellValue('H'.$numrow, $data->food_weight);
          $sheet->setCellValue('I'.$numrow, $data->barcode_colilert);
          $sheet->setCellValue('J'.$numrow, $data->barcode_falcon1);
          $sheet->setCellValue('K'.$numrow, $data->volume_falcon1);
          $sheet->setCellValue('L'.$numrow, $data->barcode_falcon2);
          $sheet->setCellValue('M'.$numrow, $data->volume_falcon2);
          $sheet->setCellValue('N'.$numrow, $data->dilution);
          $sheet->setCellValue('O'.$numrow, $data->time_incubation);
          $sheet->setCellValue('P'.$numrow, trim($data->comments));          
          //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'NHMRC_FOOD_Sample_Prep_'.$datenow.'.csv';

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

/* End of file NHMRC_sample_prep.php */
/* Location: ./application/controllers/NHMRC_sample_prep.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */