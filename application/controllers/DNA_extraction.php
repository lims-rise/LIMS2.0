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
        $id = strtoupper($this->input->post('barcode_dna',TRUE));
        // $id_f = $this->input->post('id_freez',TRUE);
        // $id_s = $this->input->post('id_shelf',TRUE);
        // $id_r = $this->input->post('id_rack',TRUE);
        // $id_d = $this->input->post('id_draw',TRUE);
        // $id_loc = $this->DNA_extraction_model->GetLocID($id_f, $id_s, $id_r, $id_d);
        
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_dna' => strtoupper($this->input->post('barcode_dna',TRUE)),
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'date_extraction' => $this->input->post('date_extraction',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'kit_lot' => $this->input->post('kit_lot',TRUE),
            'sampletype' => $this->input->post('type',TRUE),
            'weights' => $this->input->post('weights',TRUE),
            'tube_number' => $this->input->post('tube_number',TRUE),
            'cryobox' => strtoupper($this->input->post('cryobox',TRUE)),
            'barcode_metagenomics' => strtoupper($this->input->post('barcode_metagenomics',TRUE)),
            'id_location' => $this->input->post('id_loc',TRUE),
            'meta_box' => strtoupper($this->input->post('meta_box',TRUE)),
            'qc_status' => $this->input->post('qc_status',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->DNA_extraction_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    

            $data = array(
                'date_in' => $this->input->post('date_extraction',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_dna',TRUE)),
                'id_location_80' => $this->input->post('id_loc',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('cryobox',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->DNA_extraction_model->insert_freezer($data);       
            
            $data = array(
                'date_in' => $this->input->post('date_extraction',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_metagenomics',TRUE)),
                'id_location_80' => '1000',
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('meta_box',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->DNA_extraction_model->insert_freezer($data);                
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_dna' => strtoupper($this->input->post('barcode_dna',TRUE)),
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'date_extraction' => $this->input->post('date_extraction',TRUE),
            'id_person' => $this->input->post('id_person',TRUE),
            'kit_lot' => $this->input->post('kit_lot',TRUE),
            'sampletype' => $this->input->post('type',TRUE),
            'weights' => $this->input->post('weights',TRUE),
            'tube_number' => $this->input->post('tube_number',TRUE),
            'cryobox' => strtoupper($this->input->post('cryobox',TRUE)),
            'barcode_metagenomics' => strtoupper($this->input->post('barcode_metagenomics',TRUE)),
            'id_location' => $this->input->post('id_loc',TRUE),
            'meta_box' => strtoupper($this->input->post('meta_box',TRUE)),
            'qc_status' => $this->input->post('qc_status',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->DNA_extraction_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    

            $data = array(
                'date_in' => $this->input->post('date_extraction',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_dna',TRUE)),
                'id_location_80' => $this->input->post('id_loc',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('cryobox',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->DNA_extraction_model->insert_freezer($data);       
            
            $data = array(
                'date_in' => $this->input->post('date_extraction',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_metagenomics',TRUE)),
                'id_location_80' => '1000',
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('meta_box',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->DNA_extraction_model->insert_freezer($data);                 
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
        $sheet->setCellValue('A1', "Barcode_DNA");
        $sheet->setCellValue('B1', "Source_Barcode_sample"); 
        $sheet->setCellValue('C1', "Date_extraction"); 
        $sheet->setCellValue('D1', "Lab_tech");
        $sheet->setCellValue('E1', "Kit_lot");
        $sheet->setCellValue('F1', "Sample_type");
        $sheet->setCellValue('G1', "Parent_Barcode_Sample");
        $sheet->setCellValue('H1', "Parent_Sample_Type");
        $sheet->setCellValue('I1', "Weights");
        $sheet->setCellValue('J1', "Tube_number");
        $sheet->setCellValue('K1', "Cryobox");
        $sheet->setCellValue('L1', "Barcode_metagenomics");
        $sheet->setCellValue('M1', "Location");
        $sheet->setCellValue('N1', "Meta_box");
        $sheet->setCellValue('O1', "QC_Status");
        $sheet->setCellValue('P1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->DNA_extraction_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_dna);
          $sheet->setCellValue('B'.$numrow, $data->source_barcode_sample);
          $sheet->setCellValue('C'.$numrow, $data->date_extraction);
          $sheet->setCellValue('D'.$numrow, $data->initial);
          $sheet->setCellValue('E'.$numrow, $data->kit_lot);
          $sheet->setCellValue('F'.$numrow, $data->sampletype);
          $sheet->setCellValue('G'.$numrow, $data->parent_barcode_sample);
          $sheet->setCellValue('H'.$numrow, $data->parent_sample_type);
          $sheet->setCellValue('I'.$numrow, $data->weights);
          $sheet->setCellValue('J'.$numrow, $data->tube_number);
          $sheet->setCellValue('K'.$numrow, $data->cryobox);
          $sheet->setCellValue('L'.$numrow, $data->barcode_metagenomics);
          $sheet->setCellValue('M'.$numrow, $data->Location);
          $sheet->setCellValue('N'.$numrow, $data->meta_box);
          $sheet->setCellValue('O'.$numrow, $data->qc_status);
          $sheet->setCellValue('P'.$numrow, trim($data->comments));
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