<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O3_blood_sst extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O3_blood_sst_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O3_blood_sst_model');
        $data['person'] = $this->O3_blood_sst_model->getLabtech();
        $data['type'] = $this->O3_blood_sst_model->getSampleType();
        $this->template->load('template','o3_blood_sst/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O3_blood_sst_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('barcode_sample',TRUE));
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'date_process' => $this->input->post('date_process',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'barcode_sst1' => strtoupper($this->input->post('barcode_sst1',TRUE)),
            'vol_aliquot1' => $this->sanitasi($this->input->post('vol_aliquot1',TRUE)),
            'cryobox1' => strtoupper($this->input->post('cryobox1',TRUE)),
            'barcode_sst2' => strtoupper($this->input->post('barcode_sst2',TRUE)),
            'vol_aliquot2' => $this->sanitasi($this->input->post('vol_aliquot2',TRUE)),
            'cryobox2' => strtoupper($this->input->post('cryobox2',TRUE)),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            $this->O3_blood_sst_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
                'date_process' => $this->input->post('date_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'barcode_sst1' => strtoupper($this->input->post('barcode_sst1',TRUE)),
                'vol_aliquot1' => $this->sanitasi($this->input->post('vol_aliquot1',TRUE)),
                'cryobox1' => strtoupper($this->input->post('cryobox1',TRUE)),
                'barcode_sst2' => strtoupper($this->input->post('barcode_sst2',TRUE)),
                'vol_aliquot2' => $this->sanitasi($this->input->post('vol_aliquot2',TRUE)),
                'cryobox2' => strtoupper($this->input->post('cryobox2',TRUE)),    
                'comments' => trim($this->input->post('comments',TRUE)),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );

            $this->O3_blood_sst_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("o3_blood_sst"));
    }

    public function delete($id) 
    {
        $row = $this->O3_blood_sst_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O3_blood_sst_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o3_blood_sst'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o3_blood_sst'));
        }
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

    function sanitasi($data){
        $filter = htmlspecialchars_decode($data, ENT_QUOTES);
        return $filter;
      }

      public function valid_bs()
      {
          $id = $this->input->get('id1');
          $type = $this->input->get('id2');
          $data = $this->O3_blood_sst_model->validate1($id, $type);
          header('Content-Type: application/json');
          echo json_encode($data);
      }

    public function excel()
    {
        // $date1=$this->input->get('date1');
        // $date2=$this->input->get('date2');

        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Barcode_sample"); 
        $sheet->setCellValue('B1', "Date_process"); 
        $sheet->setCellValue('C1', "Lab_tech");
        $sheet->setCellValue('D1', "Barcode_SST1");
        $sheet->setCellValue('E1', "Vol_aliquot1");
        $sheet->setCellValue('F1', "Cryobox1");
        $sheet->setCellValue('G1', "Barcode_SST2");
        $sheet->setCellValue('H1', "Vol_aliquot2");
        $sheet->setCellValue('I1', "Cryobox2");
        $sheet->setCellValue('J1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O3_blood_sst_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->date_process);
          $sheet->setCellValue('C'.$numrow, $data->initial);
          $sheet->setCellValue('D'.$numrow, $data->barcode_sst1);
          $sheet->setCellValue('E'.$numrow, $data->vol_aliquot1);
          $sheet->setCellValue('F'.$numrow, $data->cryobox1);
          $sheet->setCellValue('G'.$numrow, $data->barcode_sst2);
          $sheet->setCellValue('H'.$numrow, $data->vol_aliquot2);
          $sheet->setCellValue('I'.$numrow, $data->cryobox2);
          $sheet->setCellValue('J'.$numrow, trim($data->comments));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O3_SST_Aliquots_'.$datenow.'.csv';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=$fileName"); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $writer->save('php://output');           
    }
}

/* End of file O3_blood_sst.php */
/* Location: ./application/controllers/O3_blood_sst.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */