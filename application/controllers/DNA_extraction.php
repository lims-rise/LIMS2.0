<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class DNA_extraction extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('DNA_extraction_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('DNA_extraction_model');
        $data['person'] = $this->DNA_extraction_model->getLabtech();
        $data['freez1'] = $this->DNA_extraction_model->getFreezer1();
        $data['shelf1'] = $this->DNA_extraction_model->getFreezer2();
        $data['rack1'] = $this->DNA_extraction_model->getFreezer3();
        $data['draw1'] = $this->DNA_extraction_model->getFreezer4();
        $this->template->load('template','dna_extraction/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->DNA_extraction_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('barcode_dna',TRUE);
        // $id_f = $this->input->post('id_freez',TRUE);
        // $id_s = $this->input->post('id_shelf',TRUE);
        // $id_r = $this->input->post('id_rack',TRUE);
        // $id_d = $this->input->post('id_draw',TRUE);
        // $id_loc = $this->DNA_extraction_model->GetLocID($id_f, $id_s, $id_r, $id_d);
        
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_dna' => $this->input->post('barcode_dna',TRUE),
            'barcode_sample' => $this->input->post('barcode_sample',TRUE),
            'date_extraction' => $this->input->post('date_extraction',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'kit_lot' => $this->input->post('kit_lot',TRUE),
            'sampletype' => $this->input->post('type',TRUE),
            'weights' => $this->input->post('weights',TRUE),
            'tube_number' => $this->input->post('tube_number',TRUE),
            'cryobox' => $this->input->post('cryobox',TRUE),
            'barcode_metagenomics' => $this->input->post('barcode_metagenomics',TRUE),
            'id_location' => $this->input->post('id_loc',TRUE),
            'meta_box' => $this->input->post('meta_box',TRUE),
            'comments' => $this->input->post('comments',TRUE),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->DNA_extraction_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_dna' => $this->input->post('barcode_dna',TRUE),
            'barcode_sample' => $this->input->post('barcode_sample',TRUE),
            'date_extraction' => $this->input->post('date_extraction',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'kit_lot' => $this->input->post('kit_lot',TRUE),
            'sampletype' => $this->input->post('type',TRUE),
            'weights' => $this->input->post('weights',TRUE),
            'tube_number' => $this->input->post('tube_number',TRUE),
            'cryobox' => $this->input->post('cryobox',TRUE),
            'barcode_metagenomics' => $this->input->post('barcode_metagenomics',TRUE),
            'id_location' => $this->input->post('id_loc',TRUE),
            'meta_box' => $this->input->post('meta_box',TRUE),
            'comments' => $this->input->post('comments',TRUE),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->DNA_extraction_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("dna_extraction"));
    }

    public function delete($id) 
    {
        $row = $this->DNA_extraction_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->DNA_extraction_model->delete($id);
            $this->DNA_extraction_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('dna_extraction'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('dna_extraction'));
        }
    }

    public function get_loc() 
    {
        $id1 = $this->input->get('id1');
        $id2 = $this->input->get('id2');
        $id3 = $this->input->get('id3');
        $id4 = $this->input->get('id4');
        // echo $id;
        $data = $this->DNA_extraction_model->get_location($id1, $id2, $id3, $id4);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->DNA_extraction_model->validate1($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function valid_dna() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->DNA_extraction_model->validatedna($id);

        header('Content-Type: application/json');
        echo json_encode($data);
        // return $this->response->setJSON($data);
        // $data['location'] = $this->O3_filter_paper_model->find_loc($id);
    }

    public function valid_cb() 
    {
        $id = $this->input->get('id1');
        // echo $id;
        $data = $this->DNA_extraction_model->validate_cb($id);

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
        $sheet->setCellValue('B1', "Date_extraction"); 
        $sheet->setCellValue('C1', "Lab_tech");
        $sheet->setCellValue('D1', "Kit_lot");
        $sheet->setCellValue('E1', "Sample_type");
        $sheet->setCellValue('F1', "Barcode_DNA");
        $sheet->setCellValue('G1', "Weights");
        $sheet->setCellValue('H1', "Tube_number");
        $sheet->setCellValue('I1', "Cryobox");
        $sheet->setCellValue('J1', "Barcode_metagenomics");
        $sheet->setCellValue('K1', "Location");
        $sheet->setCellValue('L1', "Meta_box");
        $sheet->setCellValue('M1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->DNA_extraction_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->date_extraction);
          $sheet->setCellValue('C'.$numrow, $data->initial);
          $sheet->setCellValue('D'.$numrow, $data->kit_lot);
          $sheet->setCellValue('E'.$numrow, $data->type);
          $sheet->setCellValue('F'.$numrow, $data->barcode_dna);
          $sheet->setCellValue('G'.$numrow, $data->weights);
          $sheet->setCellValue('H'.$numrow, $data->tube_number);
          $sheet->setCellValue('I'.$numrow, $data->cryobox);
          $sheet->setCellValue('J'.$numrow, $data->barcode_metagenomics);
          $sheet->setCellValue('K'.$numrow, $data->Location);
          $sheet->setCellValue('L'.$numrow, $data->meta_box);
          $sheet->setCellValue('M'.$numrow, $data->comments);
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'DNA_Extraction_'.$datenow.'.csv';

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

/* End of file DNA_extraction.php */
/* Location: ./application/controllers/DNA_extraction.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */