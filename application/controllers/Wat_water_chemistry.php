<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class Wat_water_chemistry extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Wat_water_chemistry_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('Wat_water_chemistry_model');
        // $data['person'] = $this->Wat_water_chemistry_model->getLabtech();
        $this->template->load('template','Wat_water_chemistry/index');
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Wat_water_chemistry_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post(strtoupper('barcode_sample'),TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'barcode_sample' => $this->input->post(strtoupper('barcode_sample'),TRUE),
            'date_process' => $this->input->post('date_process',TRUE),
            'ammonia' => $this->input->post('ammonia',TRUE),
            'nitrate' => $this->input->post('nitrate',TRUE),
            'nitrite' => $this->input->post('nitrite',TRUE),
            'ph' => $this->input->post('ph',TRUE),
            'bod' => $this->input->post('bod',TRUE),
            'aluminium' => $this->input->post('aluminium',TRUE),
            'barium' => $this->input->post('barium',TRUE),
            'iron' => $this->input->post('iron',TRUE),
            'chrome' => $this->input->post('chrome',TRUE),
            'cadmium' => $this->input->post('cadmium',TRUE),
            'manganese' => $this->input->post('manganese',TRUE),
            'nickel' => $this->input->post('nickel',TRUE),
            'zinc' => $this->input->post('zinc',TRUE),
            'copper' => $this->input->post('copper',TRUE),
            'lead' => $this->input->post('lead',TRUE),
            'cod' => $this->input->post('cod',TRUE),
            'tds' => $this->input->post('tds',TRUE),    
            'tss' => $this->input->post('tss',TRUE),
            'phosphate' => $this->input->post('phosphate',TRUE),    
            'oilgrease' => $this->input->post('oilgrease',TRUE),
            'sulfide' => $this->input->post('sulfide',TRUE),    
            'tot_nitrogen' => $this->input->post('tot_nitrogen',TRUE),
            'tot_phosphorous' => $this->input->post('tot_phosphorous',TRUE),    
            'notes' => trim($this->input->post('notes',TRUE)),
            'uuid' => $this->uuid->v4(),
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
        );
 
            $this->Wat_water_chemistry_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
                'barcode_sample' => $this->input->post(strtoupper('barcode_sample'),TRUE),
                'date_process' => $this->input->post('date_process',TRUE),
                'ammonia' => $this->input->post('ammonia',TRUE),
                'nitrate' => $this->input->post('nitrate',TRUE),
                'nitrite' => $this->input->post('nitrite',TRUE),
                'ph' => $this->input->post('ph',TRUE),
                'bod' => $this->input->post('bod',TRUE),
                'aluminium' => $this->input->post('aluminium',TRUE),
                'barium' => $this->input->post('barium',TRUE),
                'iron' => $this->input->post('iron',TRUE),
                'chrome' => $this->input->post('chrome',TRUE),
                'cadmium' => $this->input->post('cadmium',TRUE),
                'manganese' => $this->input->post('manganese',TRUE),
                'nickel' => $this->input->post('nickel',TRUE),
                'zinc' => $this->input->post('zinc',TRUE),
                'copper' => $this->input->post('copper',TRUE),
                'lead' => $this->input->post('lead',TRUE),
                'cod' => $this->input->post('cod',TRUE),
                'tds' => $this->input->post('tds',TRUE),    
                'tss' => $this->input->post('tss',TRUE),
                'phosphate' => $this->input->post('phosphate',TRUE),    
                'oilgrease' => $this->input->post('oilgrease',TRUE),
                'sulfide' => $this->input->post('sulfide',TRUE),    
                'tot_nitrogen' => $this->input->post('tot_nitrogen',TRUE),
                'tot_phosphorous' => $this->input->post('tot_phosphorous',TRUE),    
                'notes' => trim($this->input->post('notes',TRUE)),    
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->Wat_water_chemistry_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("wat_water_chemistry"));
    }

    public function delete($id) 
    {
        $row = $this->Wat_water_chemistry_model->get_by_id($id);
        // $id_user = $this->input->get('id', TRUE);
        // $lab = $this->input->post('id_lab');
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            // $this->Wat_water_chemistry_model->delete($id);
            $this->Wat_water_chemistry_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wat_water_chemistry'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wat_water_chemistry'));
        }
    }

    public function valid_bs()
    {
        $id = $this->input->get('id1');
        $type = $this->input->get('id2');
        $data = $this->Wat_water_chemistry_model->validate1($id, $type);
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
        $sheet->setCellValue('A1', "Barcode Sample");
        $sheet->setCellValue('B1', "Date process");
        $sheet->setCellValue('C1', "Laboratory");
        $sheet->setCellValue('D1', "Parent barcode");
        $sheet->setCellValue('E1', "Water type");
        $sheet->setCellValue('F1', "Ammonia (NH3-N) mg/L");
        $sheet->setCellValue('G1', "Nitrate (NO3-N) mg/L");
        $sheet->setCellValue('H1', "Nitrite (NO2-N) mg/L");
        $sheet->setCellValue('I1', "BOD (Check unit)");
        $sheet->setCellValue('J1', "Aluminium mg/L");
        $sheet->setCellValue('K1', "Barium (Ba) mg/L");
        $sheet->setCellValue('L1', "Iron (Fe) mg/L");
        $sheet->setCellValue('M1', "Chrome (Cr) mg/L");
        $sheet->setCellValue('N1', "Cadmium (Cd) mg/L");
        $sheet->setCellValue('O1', "Manganese (Mn) mg/L");
        $sheet->setCellValue('P1', "Nickel (Ni) mg/L");
        $sheet->setCellValue('Q1', "Zinc (Zn) mg/L");
        $sheet->setCellValue('R1', "Copper (Cu) mg/L");
        $sheet->setCellValue('S1', "Lead (Pb) mg/L");
        $sheet->setCellValue('T1', "COD mg/L");
        $sheet->setCellValue('U1', "TDS mg/L");
        $sheet->setCellValue('V1', "TSS mg/L");
        $sheet->setCellValue('W1', "Phosphate mg/L");
        $sheet->setCellValue('X1', "Oil and grease mg/L");
        $sheet->setCellValue('Y1', "Sulfide mg/L");
        $sheet->setCellValue('Z1', "Total Nitrogen mg/L");
        $sheet->setCellValue('AA1', "Total Phosphorous mg/L");
        $sheet->setCellValue('AB1', "Notes");        
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->Wat_water_chemistry_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
            $sheet->setCellValue('B'.$numrow, $data->date_process);
            $sheet->setCellValue('C'.$numrow, $data->water_lab);
            $sheet->setCellValue('D'.$numrow, $data->parent_barcode);
            $sheet->setCellValue('E'.$numrow, $data->sampletype2bwat);
            $sheet->setCellValue('F'.$numrow, $data->ammonia);
            $sheet->setCellValue('G'.$numrow, $data->nitrate);
            $sheet->setCellValue('H'.$numrow, $data->nitrite);
            $sheet->setCellValue('I'.$numrow, $data->bod);
            $sheet->setCellValue('J'.$numrow, $data->aluminium);
            $sheet->setCellValue('K'.$numrow, $data->barium);
            $sheet->setCellValue('L'.$numrow, $data->iron);
            $sheet->setCellValue('M'.$numrow, $data->chrome);
            $sheet->setCellValue('N'.$numrow, $data->cadmium);
            $sheet->setCellValue('O'.$numrow, $data->manganese);
            $sheet->setCellValue('P'.$numrow, $data->nickel);
            $sheet->setCellValue('Q'.$numrow, $data->zinc);
            $sheet->setCellValue('R'.$numrow, $data->copper);
            $sheet->setCellValue('S'.$numrow, $data->lead);
            $sheet->setCellValue('T'.$numrow, $data->cod);
            $sheet->setCellValue('U'.$numrow, $data->tds);
            $sheet->setCellValue('V'.$numrow, $data->tss);
            $sheet->setCellValue('W'.$numrow, $data->phosphate);
            $sheet->setCellValue('X'.$numrow, $data->oilgrease);
            $sheet->setCellValue('Y'.$numrow, $data->sulfide);
            $sheet->setCellValue('Z'.$numrow, $data->tot_nitrogen);
            $sheet->setCellValue('AA'.$numrow, $data->tot_phosphorous);
            $sheet->setCellValue('AB'.$numrow, trim($data->notes));
            //   $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'Water_Chemistry_'.$datenow.'.csv';

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

/* End of file Wat_water_chemistry.php */
/* Location: ./application/controllers/Wat_water_chemistry.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */