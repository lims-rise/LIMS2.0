<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class NHMRC_metagenomics_food extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model(['NHMRC_metagenomics_food_model', 'DNA_extraction_model']);
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('NHMRC_metagenomics_food_model');
        // $data['person'] = $this->NHMRC_metagenomics_food_model->getLabtech();
        // $data['type'] = $this->NHMRC_metagenomics_food_model->getSampleType();
        $data['freez1'] = $this->DNA_extraction_model->getFreezer1();
        $data['shelf1'] = $this->DNA_extraction_model->getFreezer2();
        $data['rack1'] = $this->DNA_extraction_model->getFreezer3();
        $data['draw1'] = $this->DNA_extraction_model->getFreezer4();
        $this->template->load('template','NHMRC_metagenomics_food/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->NHMRC_metagenomics_food_model->json();
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
            'barcode_dna1' => strtoupper($this->input->post('barcode_dna1',TRUE)),
            'weight_sub1' => $this->input->post('weight_sub1',TRUE),
            'barcode_storage1' => strtoupper($this->input->post('barcode_storage1',TRUE)),
            'position_tube1' => $this->input->post('position_tube1',TRUE),
            'id_location_801' => $this->input->post('id_location_801',TRUE),
            'barcode_dna2' => strtoupper($this->input->post('barcode_dna2',TRUE)),
            'weight_sub2' => $this->input->post('weight_sub2',TRUE),
            'barcode_storage2' => strtoupper($this->input->post('barcode_storage2',TRUE)),
            'position_tube2' => $this->input->post('position_tube2',TRUE),
            'id_location_802' => $this->input->post('id_location_802',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->NHMRC_metagenomics_food_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    

            $data = array(
                'date_in' => $this->input->post('date_conduct',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_dna1',TRUE)),
                'id_location_80' => $this->input->post('id_location_801',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('barcode_storage1',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->NHMRC_metagenomics_food_model->insert_freezer($data);            

            $data = array(
                'date_in' => $this->input->post('date_conduct',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_dna2',TRUE)),
                'id_location_80' => $this->input->post('id_location_802',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('barcode_storage2',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->NHMRC_metagenomics_food_model->insert_freezer($data);                 
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'date_conduct' => $this->input->post('date_conduct',TRUE),
            'barcode_dna1' => strtoupper($this->input->post('barcode_dna1',TRUE)),
            'weight_sub1' => $this->input->post('weight_sub1',TRUE),
            'barcode_storage1' => strtoupper($this->input->post('barcode_storage1',TRUE)),
            'position_tube1' => $this->input->post('position_tube1',TRUE),
            'id_location_801' => $this->input->post('id_location_801',TRUE),
            'barcode_dna2' => strtoupper($this->input->post('barcode_dna2',TRUE)),
            'weight_sub2' => $this->input->post('weight_sub2',TRUE),
            'barcode_storage2' => strtoupper($this->input->post('barcode_storage2',TRUE)),
            'position_tube2' => $this->input->post('position_tube2',TRUE),
            'id_location_802' => $this->input->post('id_location_802',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->NHMRC_metagenomics_food_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success'); 
            
            $data = array(
                'date_in' => $this->input->post('date_conduct',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_dna1',TRUE)),
                'id_location_80' => $this->input->post('id_location_801',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('barcode_storage1',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->NHMRC_metagenomics_food_model->insert_freezer($data);            

            $data = array(
                'date_in' => $this->input->post('date_conduct',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_dna2',TRUE)),
                'id_location_80' => $this->input->post('id_location_802',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('barcode_storage2',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->NHMRC_metagenomics_food_model->insert_freezer($data);                      
        }

        redirect(site_url("NHMRC_metagenomics_food"));
    }

    public function delete($id) 
    {
        $row = $this->NHMRC_metagenomics_food_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->NHMRC_metagenomics_food_model->delete($id);
            $this->NHMRC_metagenomics_food_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('NHMRC_metagenomics_food'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('NHMRC_metagenomics_food'));
        }
    }

    public function load_freez() 
    {
        $id = $this->input->get('id1');
        $data = $this->NHMRC_metagenomics_food_model->load_freez($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function get_freez() 
    {
        $id1 = $this->input->get('id1');
        $id2 = $this->input->get('id2');
        $id3 = $this->input->get('id3');
        $id4 = $this->input->get('id4');
        $data = $this->NHMRC_metagenomics_food_model->get_freez($id1, $id2, $id3, $id4);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $data = $this->NHMRC_metagenomics_food_model->validate1($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    public function valid_bs2() 
    {
        $id = $this->input->get('id1');
        $data = $this->NHMRC_metagenomics_food_model->validate2($id);
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
        $sheet->setCellValue('A1', "Barcode_sample");
        $sheet->setCellValue('B1', "Date_conduct");
        $sheet->setCellValue('C1', "Barcode_dna_tube1");
        $sheet->setCellValue('D1', "Weight_tube1");
        $sheet->setCellValue('E1', "Barcode_box1");
        $sheet->setCellValue('F1', "Position_tube1");
        $sheet->setCellValue('G1', "Location_tube1");
        $sheet->setCellValue('H1', "Barcode_dna_tube2");
        $sheet->setCellValue('I1', "Weight_tube2");
        $sheet->setCellValue('J1', "Barcode_box2");
        $sheet->setCellValue('K1', "Position_tube2");
        $sheet->setCellValue('L1', "Location_tube2");
        $sheet->setCellValue('M1', "Comments");
                // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->NHMRC_metagenomics_food_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
            $sheet->setCellValue('B'.$numrow, $data->date_conduct);
            $sheet->setCellValue('C'.$numrow, $data->barcode_dna1);
            $sheet->setCellValue('D'.$numrow, $data->weight_sub1);
            $sheet->setCellValue('E'.$numrow, $data->barcode_storage1);
            $sheet->setCellValue('F'.$numrow, $data->position_tube1);
            $sheet->setCellValue('G'.$numrow, $data->Location_tube1);
            $sheet->setCellValue('H'.$numrow, $data->barcode_dna2);
            $sheet->setCellValue('I'.$numrow, $data->weight_sub2);
            $sheet->setCellValue('J'.$numrow, $data->barcode_storage2);
            $sheet->setCellValue('K'.$numrow, $data->position_tube2);
            $sheet->setCellValue('L'.$numrow, $data->Location_tube2);
            $sheet->setCellValue('M'.$numrow, trim($data->comments));
                    //   $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'NHMRC_Metagenomics_(Food)_'.$datenow.'.csv';

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

/* End of file NHMRC_metagenomics_food.php */
/* Location: ./application/controllers/NHMRC_metagenomics_food.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */