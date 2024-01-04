<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O3_feces_aliquot extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O3_feces_aliquot_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O3_feces_aliquot_model');
        $data['person'] = $this->O3_feces_aliquot_model->getLabtech();
        // $data['type'] = $this->O3_feces_aliquot_model->getSampleType();
        $this->template->load('template','o3_feces_aliquot/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O3_feces_aliquot_model->json();
    }

    public function save() 
    {
        // $this->_rules();

        // if ($this->form_validation->run() == FALSE) {
        //     $this->index();
        // } else {
            $mode = $this->input->post('mode',TRUE);
            $id = $this->input->post('barcode_sample',TRUE);
            $dt = new DateTime();
    
            if ($mode=="insert"){
                $data = array(
                'barcode_sample' => $this->input->post('barcode_sample',TRUE),
                'date_process' => $this->input->post('date_process',TRUE),
                'time_process' => $this->input->post('time_process',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'cons_stool' => $this->input->post('cons_stool',TRUE),
                'color_stool' => $this->input->post('color_stool',TRUE),
                'abnormal' => $this->input->post('abnormal',TRUE),
                'ab_other' => $this->input->post('ab_other',TRUE),
                'aliquot1' => $this->input->post('aliquot1',TRUE),
                'volume1' => $this->sanitasi($this->input->post('volume1',TRUE)),
                'cryobox1' => $this->input->post('cryobox1',TRUE),
                'aliquot2' => $this->input->post('aliquot2',TRUE),
                'volume2' => $this->sanitasi($this->input->post('volume2',TRUE)),
                'cryobox2' => $this->input->post('cryobox2',TRUE),
                'aliquot3' => $this->input->post('aliquot3',TRUE),
                'volume3' => $this->sanitasi($this->input->post('volume3',TRUE)),
                'cryobox3' => $this->input->post('cryobox3',TRUE),
                'aliquot_zymo' => $this->input->post('aliquot_zymo',TRUE),
                'volume_zymo' => $this->sanitasi($this->input->post('volume_zymo',TRUE)),
                'batch_zymo' => $this->input->post('batch_zymo',TRUE),
                'cryobox_zymo' => $this->input->post('cryobox_zymo',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

                $this->O3_feces_aliquot_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');    
            }
            else if ($mode=="edit"){
                $data = array(
                    'barcode_sample' => $this->input->post('barcode_sample',TRUE),
                    'date_process' => $this->input->post('date_process',TRUE),
                    'time_process' => $this->input->post('time_process',TRUE),
                    'id_person' => $this->input->post('id_person',TRUE),
                    'cons_stool' => $this->input->post('cons_stool',TRUE),
                    'color_stool' => $this->input->post('color_stool',TRUE),
                    'abnormal' => $this->input->post('abnormal',TRUE),
                    'ab_other' => $this->input->post('ab_other',TRUE),
                    'aliquot1' => $this->input->post('aliquot1',TRUE),
                    'volume1' => $this->sanitasi($this->input->post('volume1',TRUE)),
                    'cryobox1' => $this->input->post('cryobox1',TRUE),
                    'aliquot2' => $this->input->post('aliquot2',TRUE),
                    'volume2' => $this->sanitasi($this->input->post('volume2',TRUE)),
                    'cryobox2' => $this->input->post('cryobox2',TRUE),
                    'aliquot3' => $this->input->post('aliquot3',TRUE),
                    'volume3' => $this->sanitasi($this->input->post('volume3',TRUE)),
                    'cryobox3' => $this->input->post('cryobox3',TRUE),
                    'aliquot_zymo' => $this->input->post('aliquot_zymo',TRUE),
                    'volume_zymo' => $this->sanitasi($this->input->post('volume_zymo',TRUE)),
                    'batch_zymo' => $this->input->post('batch_zymo',TRUE),
                    'cryobox_zymo' => $this->input->post('cryobox_zymo',TRUE),
                    'comments' => $this->input->post('comments',TRUE),
                    // 'uuid' => $this->uuid->v4(),
                    'lab' => $this->session->userdata('lab'),
                    'user_updated' => $this->session->userdata('id_users'),
                    'date_updated' => $dt->format('Y-m-d H:i:s'),
                    );
        
                $this->O3_feces_aliquot_model->update($id, $data);
                $this->session->set_flashdata('message', 'Create Record Success');    
            }
        // }    
        redirect(site_url("o3_feces_aliquot"));
    }

    public function delete($id) 
    {
        $row = $this->O3_feces_aliquot_model->get_by_id($id);

        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->O3_feces_aliquot_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('o3_feces_aliquot'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('o3_feces_aliquot'));
        }
    }


    // public function _rules() 
    // {
	// $this->form_validation->set_rules('barcode_sample', 'barcode_sample', 'trim|required');
	// $this->form_validation->set_rules('date_delivery', 'date delivery', 'trim|required');
	// $this->form_validation->set_rules('id_customer', 'id customer', 'trim|required');
	// $this->form_validation->set_rules('expedisi', 'expedisi', 'trim');
	// $this->form_validation->set_rules('receipt', 'receipt', 'trim');
	// $this->form_validation->set_rules('sj', 'sj', 'trim|required');
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
          $data = $this->O3_feces_aliquot_model->validate1($id, $type);
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
        $sheet->setCellValue('C1', "Time_process");
        $sheet->setCellValue('D1', "Lab_tech");
        $sheet->setCellValue('E1', "Cons_stool");
        $sheet->setCellValue('F1', "Color_stool");
        $sheet->setCellValue('G1', "Abnormal");
        $sheet->setCellValue('H1', "Other_abnormal");
        $sheet->setCellValue('I1', "Aliquot1");
        $sheet->setCellValue('J1', "Volume1");
        $sheet->setCellValue('K1', "Cryobox1");
        $sheet->setCellValue('L1', "Aliquot2");
        $sheet->setCellValue('M1', "Volume2");
        $sheet->setCellValue('N1', "Cryobox2");
        $sheet->setCellValue('O1', "Aliquot3");
        $sheet->setCellValue('P1', "Volume3");
        $sheet->setCellValue('Q1', "Cryobox3");
        $sheet->setCellValue('R1', "Aliquot_zymo");
        $sheet->setCellValue('S1', "Volume_zymo");
        $sheet->setCellValue('T1', "Batch_zymo");
        $sheet->setCellValue('U1', "Cryobox_zymo");
        $sheet->setCellValue('V1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O3_feces_aliquot_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->date_process);
          $sheet->setCellValue('C'.$numrow, $data->time_process);
          $sheet->setCellValue('D'.$numrow, $data->initial);
          $sheet->setCellValue('E'.$numrow, $data->cons_stool);
          $sheet->setCellValue('F'.$numrow, $data->color_stool);
          $sheet->setCellValue('G'.$numrow, $data->abnormal);
          $sheet->setCellValue('H'.$numrow, $data->ab_other);
          $sheet->setCellValue('I'.$numrow, $data->aliquot1);
          $sheet->setCellValue('J'.$numrow, $data->volume1);
          $sheet->setCellValue('K'.$numrow, $data->cryobox1);
          $sheet->setCellValue('L'.$numrow, $data->aliquot2);
          $sheet->setCellValue('M'.$numrow, $data->volume2);
          $sheet->setCellValue('N'.$numrow, $data->cryobox2);
          $sheet->setCellValue('O'.$numrow, $data->aliquot3);
          $sheet->setCellValue('P'.$numrow, $data->volume3);
          $sheet->setCellValue('Q'.$numrow, $data->cryobox3);
          $sheet->setCellValue('R'.$numrow, $data->aliquot_zymo);
          $sheet->setCellValue('S'.$numrow, $data->volume_zymo);
          $sheet->setCellValue('T'.$numrow, $data->batch_zymo);
          $sheet->setCellValue('U'.$numrow, $data->cryobox_zymo);
          $sheet->setCellValue('V'.$numrow, $data->comments);
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O3_Feces_Aliquots_'.$datenow.'.csv';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=$fileName"); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $writer->save('php://output');           
    }
}

/* End of file o3_feces_aliquot.php */
/* Location: ./application/controllers/o3_feces_aliquot.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */