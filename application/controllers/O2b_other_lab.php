<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class O2b_other_lab extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('O2b_other_lab_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O2b_other_lab_model');
        // $data['person'] = $this->O2b_other_lab_model->getLabtech();
        $data['type'] = $this->O2b_other_lab_model->getSampleType();
        $this->template->load('template','O2b_other_lab/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->O2b_other_lab_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('barcode_sample',TRUE));
        $dt = new DateTime();
        $cdate = $dt->format('Y-m-d');
        $ctime = $dt->format('H:i:s');

        if ($mode=="insert"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'id_type2bwat' => $this->input->post('id_type2bwat',TRUE),
            'barcode_nitro' => strtoupper($this->input->post('barcode_nitro',TRUE)),
            '3rdparty_lab' => $this->input->post('3rdparty_lab',TRUE),
            'barcode_nitro2' => strtoupper($this->input->post('barcode_nitro2',TRUE)),
            '3rdparty_lab2' => $this->input->post('3rdparty_lab2',TRUE),
            'barcode_microbiology' => strtoupper($this->input->post('barcode_microbiology',TRUE)),
            '3rdparty_lab3' => $this->input->post('3rdparty_lab3',TRUE),
            'barcode_microbiology2' => strtoupper($this->input->post('barcode_microbiology2',TRUE)),
            '3rdparty_lab4' => $this->input->post('3rdparty_lab4',TRUE),
            'barcode_rise_lab' => strtoupper($this->input->post('barcode_rise_lab',TRUE)),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->O2b_other_lab_model->insert($data);

            $id_type2bwat = $this->input->post('id_type2bwat', TRUE);

            if ($id_type2bwat !== null) {
                if (strpos($id_type2bwat, '15') !== false || 
                    strpos($id_type2bwat, '16') !== false || 
                    strpos($id_type2bwat, '17') !== false) {            
                    $data = array(
                        'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
                        'date_arrival' => $cdate,
                        'time_arrival' => $ctime,
                        'id_type2b' => '6',
                        'png_control' => 'Yes',
                        'comments' => 'WATER CONTROL',
                        'uuid' => $this->uuid->v4(),
                        'lab' => $this->session->userdata('lab'),
                        'user_created' => $this->session->userdata('id_users'),
                        'date_created' => $dt->format('Y-m-d H:i:s'),
                        );
                                    
                    $this->O2b_other_lab_model->insert_reception($data);    
                }
            }
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'id_type2bwat' => $this->input->post('id_type2bwat',TRUE),
            'barcode_nitro' => strtoupper($this->input->post('barcode_nitro',TRUE)),
            '3rdparty_lab' => $this->input->post('3rdparty_lab',TRUE),
            'barcode_nitro2' => strtoupper($this->input->post('barcode_nitro2',TRUE)),
            '3rdparty_lab2' => $this->input->post('3rdparty_lab2',TRUE),
            'barcode_microbiology' => strtoupper($this->input->post('barcode_microbiology',TRUE)),
            '3rdparty_lab3' => $this->input->post('3rdparty_lab3',TRUE),
            'barcode_microbiology2' => strtoupper($this->input->post('barcode_microbiology2',TRUE)),
            '3rdparty_lab4' => $this->input->post('3rdparty_lab4',TRUE),
            'barcode_rise_lab' => strtoupper($this->input->post('barcode_rise_lab',TRUE)),
            'comments' => trim($this->input->post('comments',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->O2b_other_lab_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("O2b_other_lab"));
    }

    public function delete($id) 
    {
        $row = $this->O2b_other_lab_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->O2b_other_lab_model->delete($id);
            $this->O2b_other_lab_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('O2b_other_lab'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('O2b_other_lab'));
        }
    }

    public function gen_ctrl() 
    {
        $wtyp = $this->input->get('wtyp');
        // echo $id;
        $data = $this->O2b_other_lab_model->gen_ctrl($wtyp);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->O2b_other_lab_model->validate1($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function valid_nitro() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->O2b_other_lab_model->validate_nitro($id);

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
        $sheet->setCellValue('A1', "Barcode_sample"); 
        $sheet->setCellValue('B1', "Sample_watertype"); 
        $sheet->setCellValue('C1', "RISE_Lab_Barcode");

        if ($this->session->userdata('lab') == 1) {
            $sheet->setCellValue("D1", "BTKL_chems_Barcode");
            $sheet->setCellValue("E1", "BTKL_chems_Deliver");
            $sheet->setCellValue("F1", "BBLK_chems_Barcode");
            $sheet->setCellValue("G1", "BBLK_chems_Deliver");
            $sheet->setCellValue("H1", "BTKL_micro_Barcode");
            $sheet->setCellValue("I1", "BTKL_micro_Deliver");
            $sheet->setCellValue("J1", "BBLK_micro_Barcode");
            $sheet->setCellValue("K1", "BBLK_micro_Deliver");                
        }
        else {
            $sheet->setCellValue("D1", "WAF_chems_Barcode");
            $sheet->setCellValue("E1", "WAF_chems_Deliver");
            $sheet->setCellValue("F1", "Other_chems_Barcode");
            $sheet->setCellValue("G1", "Other_chems_Deliver");
            $sheet->setCellValue("H1", "WAF_micro_Barcode");
            $sheet->setCellValue("I1", "WAF_micro_Deliver");
            $sheet->setCellValue("J1", "Other_micro_Barcode");
            $sheet->setCellValue("K1", "Other_micro_Deliver");                            
        }
        $sheet->setCellValue('L1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->O2b_other_lab_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->sampletype2bwat);
          $sheet->setCellValue('C'.$numrow, $data->barcode_rise_lab);
          $sheet->setCellValue('D'.$numrow, $data->barcode_nitro);
          $sheet->setCellValue('E'.$numrow, $data->lab1);
          $sheet->setCellValue('F'.$numrow, $data->barcode_nitro2);
          $sheet->setCellValue('G'.$numrow, $data->lab2);
          $sheet->setCellValue('H'.$numrow, $data->barcode_microbiology);
          $sheet->setCellValue('I'.$numrow, $data->lab3);
          $sheet->setCellValue('J'.$numrow, $data->barcode_microbiology2);
          $sheet->setCellValue('K'.$numrow, $data->lab4);
          $sheet->setCellValue('L'.$numrow, trim($data->comments));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'O2B_Other_Lab_Analysis_'.$datenow.'.csv';

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

/* End of file O2b_other_lab.php */
/* Location: ./application/controllers/O2b_other_lab.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */