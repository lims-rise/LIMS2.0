<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O3_blood_edta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O3_blood_edta_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O3_blood_edta_model');
        $data['person'] = $this->O3_blood_edta_model->getLabtech();
        $data['type'] = $this->O3_blood_edta_model->getSampleType();
        $this->template->load('template','o3_blood_edta/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O3_blood_edta_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('barcode_sample',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_sample' => $this->input->post('barcode_sample',TRUE),
            'date_process' => $this->input->post('date_process',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'hemolysis' => $this->input->post('hemolysis',TRUE),
            'barcode_wb' => $this->input->post('barcode_wb',TRUE),
            'vol_aliquotwb' => $this->sanitasi($this->input->post('vol_aliquotwb',TRUE)),
            'cryoboxwb' => $this->input->post('cryoboxwb',TRUE),
            'barcode_p1a' => $this->input->post('barcode_p1a',TRUE),
            'vol_aliquot1' => $this->sanitasi($this->input->post('vol_aliquot1',TRUE)),
            'cryobox1' => $this->input->post('cryobox1',TRUE),
            'barcode_p2a' => $this->input->post('barcode_p2a',TRUE),
            'vol_aliquot2' => $this->sanitasi($this->input->post('vol_aliquot2',TRUE)),
            'cryobox2' => $this->input->post('cryobox2',TRUE),
            'barcode_p3a' => $this->input->post('barcode_p3a',TRUE),
            'vol_aliquot3' => $this->sanitasi($this->input->post('vol_aliquot3',TRUE)),
            'cryobox3' => $this->input->post('cryobox3',TRUE),
            'packed_cells' => $this->input->post('packed_cells',TRUE),
            'cryobox_pc' => $this->input->post('cryobox_pc',TRUE),
            'comments' => $this->input->post('comments',TRUE),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            $this->O3_blood_edta_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                'barcode_sample' => $this->input->post('barcode_sample',TRUE),
                'date_process' => $this->input->post('date_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'hemolysis' => $this->input->post('hemolysis',TRUE),
                'barcode_wb' => $this->input->post('barcode_wb',TRUE),
                'vol_aliquotwb' => $this->sanitasi($this->input->post('vol_aliquotwb',TRUE)),
                'cryoboxwb' => $this->input->post('cryoboxwb',TRUE),
                'barcode_p1a' => $this->input->post('barcode_p1a',TRUE),
                'vol_aliquot1' => $this->sanitasi($this->input->post('vol_aliquot1',TRUE)),
                'cryobox1' => $this->input->post('cryobox1',TRUE),
                'barcode_p2a' => $this->input->post('barcode_p2a',TRUE),
                'vol_aliquot2' => $this->sanitasi($this->input->post('vol_aliquot2',TRUE)),
                'cryobox2' => $this->input->post('cryobox2',TRUE),
                'barcode_p3a' => $this->input->post('barcode_p3a',TRUE),
                'vol_aliquot3' => $this->sanitasi($this->input->post('vol_aliquot3',TRUE)),
                'cryobox3' => $this->input->post('cryobox3',TRUE),
                'packed_cells' => $this->input->post('packed_cells',TRUE),
                'cryobox_pc' => $this->input->post('cryobox_pc',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );
    
            $this->O3_blood_edta_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("o3_blood_edta"));
    }

    public function delete($id) 
    {
        $row = $this->O3_blood_edta_model->get_by_id($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O3_blood_edta_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o3_blood_edta'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o3_blood_edta'));
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
          $data = $this->O3_blood_edta_model->validate1($id, $type);
          header('Content-Type: application/json');
          echo json_encode($data);
      }

    //   public function valid_bw()
    //   {
    //       $id = $this->input->get('id1');
    //       $data = $this->O3_blood_edta_model->validate2($id);
    //       header('Content-Type: application/json');
    //       echo json_encode($data);
    //   }


    public function excel()
    {
        // $date1=$this->input->get('date1');
        // $date2=$this->input->get('date2');

        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Barcode_sample"); 
        $sheet->setCellValue('B1', "Date_process"); 
        $sheet->setCellValue('C1', "Lab_tech");
        $sheet->setCellValue('D1', "Hemolysis");
        $sheet->setCellValue('E1', "Barcode_wb");
        $sheet->setCellValue('F1', "Vol_aliquotwb");
        $sheet->setCellValue('G1', "Cryoboxwb");
        $sheet->setCellValue('H1', "Barcode_plasma1");
        $sheet->setCellValue('I1', "Vol_aliquot1");
        $sheet->setCellValue('J1', "Cryobox1");
        $sheet->setCellValue('K1', "Barcode_plasma2");
        $sheet->setCellValue('L1', "Vol_aliquot2");
        $sheet->setCellValue('M1', "Cryobox2");
        $sheet->setCellValue('N1', "Barcode_plasma3");
        $sheet->setCellValue('O1', "Vol_aliquot3");
        $sheet->setCellValue('P1', "Cryobox3");
        $sheet->setCellValue('Q1', "Packed_cells");
        $sheet->setCellValue('R1', "Cryobox_PC");
        $sheet->setCellValue('S1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O3_blood_edta_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->date_process);
          $sheet->setCellValue('C'.$numrow, $data->initial);
          $sheet->setCellValue('D'.$numrow, $data->hemolysis);
          $sheet->setCellValue('E'.$numrow, $data->barcode_wb);
          $sheet->setCellValue('F'.$numrow, $data->vol_aliquotwb);
          $sheet->setCellValue('G'.$numrow, $data->cryoboxwb);
          $sheet->setCellValue('H'.$numrow, $data->barcode_p1a);
          $sheet->setCellValue('I'.$numrow, $data->vol_aliquot1);
          $sheet->setCellValue('J'.$numrow, $data->cryobox1);
          $sheet->setCellValue('K'.$numrow, $data->barcode_p2a);
          $sheet->setCellValue('L'.$numrow, $data->vol_aliquot2);
          $sheet->setCellValue('M'.$numrow, $data->cryobox2);
          $sheet->setCellValue('N'.$numrow, $data->barcode_p3a);
          $sheet->setCellValue('O'.$numrow, $data->vol_aliquot3);
          $sheet->setCellValue('P'.$numrow, $data->cryobox3);
          $sheet->setCellValue('Q'.$numrow, $data->packed_cells);
          $sheet->setCellValue('R'.$numrow, $data->cryobox_pc);
          $sheet->setCellValue('S'.$numrow, $data->comments);
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O3_Blood_edta_'.$datenow.'.csv';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=$fileName"); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $writer->save('php://output');           
    }
}

/* End of file O3_blood_edta.php */
/* Location: ./application/controllers/O3_blood_edta.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */