<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O3_feces_kk2 extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O3_feces_kk2_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O3_feces_kk2_model');
        $data['person'] = $this->O3_feces_kk2_model->getLabtech();
        $this->template->load('template','o3_feces_kk2/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O3_feces_kk2_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('bar_kkslide',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'bar_kkslide' => $this->input->post('bar_kkslide',TRUE),
            'date_process' => $this->input->post('date_process',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'id_person2' => $this->input->post('id_person2',TRUE),
            'duration' => $this->input->post('duration',TRUE),
            'start_time' => $this->input->post('start_time',TRUE),
            'end_time' => $this->input->post('end_time',TRUE),
            'ascaris' => $this->input->post('ascaris',TRUE),
            'ascaris_com' => $this->input->post('ascaris_com',TRUE),
            'hookworm' => $this->input->post('hookworm',TRUE),
            'hookworm_com' => $this->input->post('hookworm_com',TRUE),
            'trichuris' => $this->input->post('trichuris',TRUE),
            'trichuris_com' => $this->input->post('trichuris_com',TRUE),
            'strongyloides' => $this->input->post('strongyloides',TRUE),
            'strongyloides_com' => $this->input->post('strongyloides_com',TRUE),
            'taenia' => $this->input->post('taenia',TRUE),
            'taenia_com' => $this->input->post('taenia_com',TRUE),
            'other' => $this->input->post('other',TRUE),
            'other_com' => $this->input->post('other_com',TRUE),    
            'comments' => trim($this->input->post('comments',TRUE)),
            'finalized' => $this->input->post('finalized',TRUE),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
        );
 
            $this->O3_feces_kk2_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                'bar_kkslide' => $this->input->post('bar_kkslide',TRUE),
                'date_process' => $this->input->post('date_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'id_person2' => $this->input->post('id_person2',TRUE),
                'duration' => $this->input->post('duration',TRUE),
                'start_time' => $this->input->post('start_time',TRUE),
                'end_time' => $this->input->post('end_time',TRUE),
                'ascaris' => $this->input->post('ascaris',TRUE),
                'ascaris_com' => $this->input->post('ascaris_com',TRUE),
                'hookworm' => $this->input->post('hookworm',TRUE),
                'hookworm_com' => $this->input->post('hookworm_com',TRUE),
                'trichuris' => $this->input->post('trichuris',TRUE),
                'trichuris_com' => $this->input->post('trichuris_com',TRUE),
                'strongyloides' => $this->input->post('strongyloides',TRUE),
                'strongyloides_com' => $this->input->post('strongyloides_com',TRUE),
                'taenia' => $this->input->post('taenia',TRUE),
                'taenia_com' => $this->input->post('taenia_com',TRUE),
                'other' => $this->input->post('other',TRUE),
                'other_com' => $this->input->post('other_com',TRUE),
                'comments' => trim($this->input->post('comments',TRUE)),
                'finalized' => $this->input->post('finalized',TRUE),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->O3_feces_kk2_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("o3_feces_kk2"));
    }

    public function delete($id) 
    {
        $row = $this->O3_feces_kk2_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->O3_feces_kk2_model->delete($id);
            $this->O3_feces_kk2_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o3_feces_kk2'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o3_feces_kk2'));
        }
    }

    public function valid_bs()
    {
        $id = $this->input->get('id1');
        $type = $this->input->get('id2');
        $data = $this->O3_feces_kk2_model->validate1($id, $type);
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
        $sheet->setCellValue('A1', "Barcode_kkslide"); 
        $sheet->setCellValue('B1', "Date_process"); 
        $sheet->setCellValue('C1', "Person_read");
        $sheet->setCellValue('D1', "Person_write");
        $sheet->setCellValue('E1', "Duration");
        $sheet->setCellValue('F1', "Start_time");
        $sheet->setCellValue('G1', "End_time");
        $sheet->setCellValue('H1', "Ascaris");
        $sheet->setCellValue('I1', "Ascaris_note");
        $sheet->setCellValue('J1', "Hookworm");
        $sheet->setCellValue('K1', "Hookworm_note");
        $sheet->setCellValue('L1', "Trichuris");
        $sheet->setCellValue('M1', "Trichuris_note");
        $sheet->setCellValue('N1', "Strongyloides");
        $sheet->setCellValue('O1', "Strongyloides_note");
        $sheet->setCellValue('P1', "Taenia");
        $sheet->setCellValue('Q1', "Taenia_note");
        $sheet->setCellValue('R1', "Other");
        $sheet->setCellValue('S1', "Other_note");
        $sheet->setCellValue('T1', "Comments");
        $sheet->setCellValue('U1', "Finalized");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O3_feces_kk2_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->bar_kkslide);
          $sheet->setCellValue('B'.$numrow, $data->date_process);
          $sheet->setCellValue('C'.$numrow, $data->person_read);
          $sheet->setCellValue('D'.$numrow, $data->person_write);
          $sheet->setCellValue('E'.$numrow, $data->duration);
          $sheet->setCellValue('F'.$numrow, $data->start_time);
          $sheet->setCellValue('G'.$numrow, $data->end_time);
          $sheet->setCellValue('H'.$numrow, $data->ascaris);
          $sheet->setCellValue('I'.$numrow, $data->ascaris_com);
          $sheet->setCellValue('J'.$numrow, $data->hookworm);
          $sheet->setCellValue('K'.$numrow, $data->hookworm_com);
          $sheet->setCellValue('L'.$numrow, $data->trichuris);
          $sheet->setCellValue('M'.$numrow, $data->trichuris_com);
          $sheet->setCellValue('N'.$numrow, $data->strongyloides);
          $sheet->setCellValue('O'.$numrow, $data->strongyloides_com);
          $sheet->setCellValue('P'.$numrow, $data->taenia);
          $sheet->setCellValue('Q'.$numrow, $data->taenia_com);
          $sheet->setCellValue('R'.$numrow, $data->other);
          $sheet->setCellValue('S'.$numrow, $data->other_com);
          $sheet->setCellValue('T'.$numrow, trim($data->comments));
          $sheet->setCellValue('U'.$numrow, $data->finalized);
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O3_Feces_KK2_'.$datenow.'.csv';

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

/* End of file O3_feces_kk2.php */
/* Location: ./application/controllers/O3_feces_kk2.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */