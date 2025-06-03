<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class NHMRC_metagenomics_br extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model(['NHMRC_metagenomics_br_model', 'DNA_extraction_model']);
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('NHMRC_metagenomics_br_model');
        // $data['person'] = $this->NHMRC_metagenomics_br_model->getLabtech();
        // $data['type'] = $this->NHMRC_metagenomics_br_model->getSampleType();
        $data['freez1'] = $this->DNA_extraction_model->getFreezer1();
        $data['shelf1'] = $this->DNA_extraction_model->getFreezer2();
        $data['rack1'] = $this->DNA_extraction_model->getFreezer3();
        $data['draw1'] = $this->DNA_extraction_model->getFreezer4();
        $this->template->load('template','NHMRC_metagenomics_br/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->NHMRC_metagenomics_br_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('barcode_sample',TRUE));
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'barcode_falcon2' => strtoupper($this->input->post('barcode_falcon2',TRUE)),
            'date_conduct' => $this->input->post('date_conduct',TRUE),
            'volume_filtered' => $this->input->post('volume_filtered',TRUE),
            'time_started' => $this->input->post('time_started',TRUE),
            'time_finished' => $this->input->post('time_finished',TRUE),
            'time_minutes' => $this->input->post('time_minutes',TRUE),
            'barcode_dna_bag' => strtoupper($this->input->post('barcode_dna_bag',TRUE)),
            'barcode_storage' => strtoupper($this->input->post('barcode_storage',TRUE)),
            'id_location_80' => $this->input->post('id_loc',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );
 
            $this->NHMRC_metagenomics_br_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    

            $data = array(
                'date_in' => $this->input->post('date_conduct',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_dna_bag',TRUE)),
                'id_location_80' => $this->input->post('id_loc',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('barcode_storage',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->NHMRC_metagenomics_br_model->insert_freezer($data);                   
        }
        else if ($mode=="edit"){
            $data = array(
            'barcode_sample' => strtoupper($this->input->post('barcode_sample',TRUE)),
            'barcode_falcon2' => strtoupper($this->input->post('barcode_falcon2',TRUE)),
            'date_conduct' => $this->input->post('date_conduct',TRUE),
            'volume_filtered' => $this->input->post('volume_filtered',TRUE),
            'time_started' => $this->input->post('time_started',TRUE),
            'time_finished' => $this->input->post('time_finished',TRUE),
            'time_minutes' => $this->input->post('time_minutes',TRUE),
            'barcode_dna_bag' => strtoupper($this->input->post('barcode_dna_bag',TRUE)),
            'barcode_storage' => strtoupper($this->input->post('barcode_storage',TRUE)),
            'id_location_80' => $this->input->post('id_loc',TRUE),
            'comments' => trim($this->input->post('comments',TRUE)),
            // 'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->NHMRC_metagenomics_br_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');   
            
            $data = array(
                'date_in' => $this->input->post('date_conduct',TRUE),
                'time_in' => $dt->format('H:i:s'),
                'id_person' => '999',
                'id_vessel' => '1',
                'barcode_sample' => strtoupper($this->input->post('barcode_dna_bag',TRUE)),
                'id_location_80' => $this->input->post('id_loc',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                'out' => '0',
                'need_cryobox' => '1',
                'cryobox' => strtoupper($this->input->post('barcode_storage',TRUE)),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );
            $this->NHMRC_metagenomics_br_model->insert_freezer($data);                 
        }

        redirect(site_url("NHMRC_metagenomics_br"));
    }

    public function delete($id) 
    {
        $row = $this->NHMRC_metagenomics_br_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->NHMRC_metagenomics_br_model->delete($id);
            $this->NHMRC_metagenomics_br_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('NHMRC_metagenomics_br'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('NHMRC_metagenomics_br'));
        }
    }

    public function load_freez() 
    {
        $id = $this->input->get('id1');
        $data = $this->NHMRC_metagenomics_br_model->load_freez($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function get_freez() 
    {
        $id1 = $this->input->get('id1');
        $id2 = $this->input->get('id2');
        $id3 = $this->input->get('id3');
        $id4 = $this->input->get('id4');
        $data = $this->NHMRC_metagenomics_br_model->get_freez($id1, $id2, $id3, $id4);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $data = $this->NHMRC_metagenomics_br_model->validate1($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    public function valid_dna() 
    {
        $id = $this->input->get('id1');
        $data = $this->NHMRC_metagenomics_br_model->validatedna($id);
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
        $sheet->setCellValue('A1', "Barcode_(W0/S1)"); 
        $sheet->setCellValue('B1', "Barcode_falcon2"); 
        $sheet->setCellValue('C1', "Date_conduct");
        $sheet->setCellValue('D1', "Volume_filtered");
        $sheet->setCellValue('E1', "Time_started");
        $sheet->setCellValue('F1', "Time_finished");
        $sheet->setCellValue('G1', "Duration(minutes)");
        $sheet->setCellValue('H1', "Barcode_DNA_bag");
        $sheet->setCellValue('I1', "Barcode_storage");
        $sheet->setCellValue('J1', "Location");
        $sheet->setCellValue('K1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->NHMRC_metagenomics_br_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->barcode_falcon2);
          $sheet->setCellValue('C'.$numrow, $data->date_conduct);
          $sheet->setCellValue('D'.$numrow, $data->volume_filtered);
          $sheet->setCellValue('E'.$numrow, $data->time_started);
          $sheet->setCellValue('F'.$numrow, $data->time_finished);
          $sheet->setCellValue('G'.$numrow, $data->time_minutes);
          $sheet->setCellValue('H'.$numrow, $data->barcode_dna_bag);
          $sheet->setCellValue('I'.$numrow, $data->barcode_storage);
          $sheet->setCellValue('J'.$numrow, $data->Location);
          $sheet->setCellValue('K'.$numrow, trim($data->comments));
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'NHMRC_Metagenomics_(Bootsocks_&_HandRinse)_'.$datenow.'.csv';

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

/* End of file NHMRC_metagenomics_br.php */
/* Location: ./application/controllers/NHMRC_metagenomics_br.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */