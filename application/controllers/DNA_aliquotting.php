<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class DNA_aliquotting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('DNA_aliquotting_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('DNA_aliquotting_model');
        $data['person'] = $this->DNA_aliquotting_model->getLabtech();
        // $data['type'] = $this->DNA_aliquotting_model->getSampleType();
        $this->template->load('template','dna_aliquotting/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->DNA_aliquotting_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id_dna');
        header('Content-Type: application/json');
        echo $this->DNA_aliquotting_model->subjson($id);
    }

    public function read($id) 
    {
        $row = $this->DNA_aliquotting_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_dna' => $row->id_dna,
                'date_aliquot' => $row->date_aliquot,
                'initial' => $row->initial,
                'barcode_monash' => $row->barcode_monash,
                'barcode_cambridge' => $row->barcode_cambridge,
                'comments' => $row->comments,
                'id_person' => $row->id_person,
            );
        // $data['items'] = $this->Tbl_delivery_model->getItems();
            // $this->template->load('template','dna_aliquotting/tbl_delivery_read', $data);
            $this->template->load('template','dna_aliquotting/index_detail', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dna_aliquotting'));
        }
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('id_dna',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'date_aliquot' => $this->input->post('date_aliquot',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'barcode_monash' => $this->input->post(strtoupper('barcode_monash'),TRUE),
            'barcode_cambridge' => $this->input->post(strtoupper('barcode_cambridge'),TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->DNA_aliquotting_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'date_aliquot' => $this->input->post('date_aliquot',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'barcode_monash' => $this->input->post(strtoupper('barcode_monash'),TRUE),
            'barcode_cambridge' => $this->input->post(strtoupper('barcode_cambridge'),TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->DNA_aliquotting_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("dna_aliquotting"));
    }

    public function save_detail() {
        $mode = $this->input->post('mode_det',TRUE);
        $id_dna = $this->input->post('id_dna',TRUE);
        $id_dna_det = $this->input->post('id_dna_det',TRUE);
        $dt = new DateTime();

        $sql_aliq = "SELECT MAX(row_id) AS row_id, MAX(column_id) AS column_id
        FROM dna_aliquot_det
        WHERE id_dna = '$id_dna'
        GROUP BY id_dna, row_id
        ORDER BY row_id DESC 
        LIMIT 1";

        $lastaliq = $this->db->query($sql_aliq)->row();
        $rows = $lastaliq->row_id;
        $columns = $lastaliq->column_id;

        if ($rows == "") {
            $rows = "A";
        }

        if ($columns == 12) {
            if ($rows == "A") {$rows = "B";}
            else if ($rows == "B") {$rows = "C";}
            else if ($rows == "C") {$rows = "D";}
            else if ($rows == "D") {$rows = "E";}
            else if ($rows == "E") {$rows = "F";}
            else if ($rows == "F") {$rows = "G";}
            else if ($rows == "G") {$rows = "H";}
            $columns = 1;
        }
        else {
            $columns = $columns+1;
        }

        if ($mode=="insert"){
            $data = array(
            'barcode_dna' => $this->input->post(strtoupper('barcode_dna'),TRUE),
            'row_id' => $rows,
            'column_id' => $columns,
            'id_dna' => $this->input->post('id_dna',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->DNA_aliquotting_model->insert_detail($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_dna' => $this->input->post(strtoupper('barcode_dna'),TRUE),
            'row_id' => $rows,
            'column_id' => $columns,
            'id_dna' => $this->input->post('id_dna',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->DNA_aliquotting_model->update_detail($id_dna_det, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("dna_aliquotting/read/$id_dna"));
    }


    public function delete($id) 
    {
        $row = $this->DNA_aliquotting_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->DNA_aliquotting_model->delete($id);
            $this->DNA_aliquotting_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dna_aliquotting'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dna_aliquotting'));
        }
    }

    public function get_dna_type() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->DNA_aliquotting_model->getDNAType($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->DNA_aliquotting_model->validate1($id);

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
        $sheet->setCellValue('A1', "Barcode_DNA"); 
        $sheet->setCellValue('B1', "Date_aliquot"); 
        $sheet->setCellValue('C1', "Lab_tech");
        $sheet->setCellValue('D1', "Barcode_Monash");
        $sheet->setCellValue('E1', "Barcode_Cambridge");
        $sheet->setCellValue('F1', "Row_ID");
        $sheet->setCellValue('G1', "Column_ID");
        $sheet->setCellValue('H1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->DNA_aliquotting_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_dna);
          $sheet->setCellValue('B'.$numrow, $data->date_aliquot);
          $sheet->setCellValue('C'.$numrow, $data->initial);
          $sheet->setCellValue('D'.$numrow, $data->barcode_monash);
          $sheet->setCellValue('E'.$numrow, $data->barcode_cambridge);
          $sheet->setCellValue('F'.$numrow, $data->row_id);
          $sheet->setCellValue('G'.$numrow, $data->column_id);
          $sheet->setCellValue('H'.$numrow, trim($data->comments));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'DNA_Aliquotting_'.$datenow.'.csv';

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

/* End of file DNA_aliquotting.php */
/* Location: ./application/controllers/DNA_aliquotting.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */