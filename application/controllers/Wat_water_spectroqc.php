<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class WAT_water_spectroqc extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Wat_water_spectroqc_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('WAT_water_spectroqc_model');
        $data['person'] = $this->Wat_water_spectroqc_model->getLabtech();
        // $data['freezer'] = $this->WAT_water_spectroqc_model->getFreezer();
        // $data['shelf'] = $this->WAT_water_spectroqc_model->getShelf();
        // $data['rack'] = $this->WAT_water_spectroqc_model->getRack();
        // $data['rack_level'] = $this->WAT_water_spectroqc_model->getDrawer();
        $this->template->load('template','wat_water_spectroqc/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Wat_water_spectroqc_model->json();
    }

    public function subjson() {
        $id = $this->input->get('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Wat_water_spectroqc_model->subjson($id);
    }


    public function read($id)
    {
        // $this->template->load('template','wat_water_spectroqc/index_det', $data);
        // $id_spec = $this->input->post('id_spec',TRUE);
        $row = $this->Wat_water_spectroqc_model->get_detail($id);
        if ($row) {
            // $inv = $this->WAT_water_spectroqc_model->getInv();            
            $data = array(
                'id_spec' => $row->id_spec,
                'date_spec' => $row->date_spec,
                'initial' => $row->initial,
                'chem_parameter' => $row->chem_parameter,
                'mixture_name' => $row->mixture_name,
                'sample_no' => $row->sample_no,
                'lot_no' => $row->lot_no,
                'date_expired' => $row->date_expired,
                'cert_value' => $row->cert_value,
                'uncertainty' => $row->uncertainty,
                'notes' => $row->notes,
                'avg_result' => $row->avg_result,
                'avg_trueness' => $row->avg_trueness,
                'avg_bias' => $row->avg_bias,
                'sd' => $row->sd,
                'rsd' => $row->rsd,
                'cv_horwits' => $row->cv_horwits,
                'cv' => $row->cv,
                'prec' => $row->prec,
                'accuracy' => $row->accuracy,
                'bias' => $row->bias,
                );
                $this->template->load('template','wat_water_spectroqc/index_det', $data);
        }
        else {
            // $this->template->load('template','wat_water_spectroqc/index_det');
        }

    } 

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('id_spec',TRUE);
        // $f = $this->input->post('freezer',TRUE);
        // $s = $this->input->post('shelf',TRUE);
        // $r = $this->input->post('rack',TRUE);
        // $rl = $this->input->post('rack_level',TRUE);

        // $freezerloc = $this->WAT_water_spectroqc_model->getFreezLoc($f,$s,$r,$rl);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
                'date_spec' => $this->input->post('date_spec',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'chem_parameter' => $this->input->post('chem_parameter',TRUE),
                'mixture_name' => $this->input->post('mixture_name',TRUE),
                'sample_no' => $this->input->post('sample_no',TRUE),
                'lot_no' => $this->input->post('lot_no',TRUE),
                'date_expired' => $this->input->post('date_expired',TRUE),
                'cert_value' => $this->input->post('cert_value',TRUE),
                'uncertainty' => $this->input->post('uncertainty',TRUE),
                'notes' => $this->input->post('notes',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->Wat_water_spectroqc_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
      
        }
        else if ($mode=="edit"){
            $data = array(
                'date_spec' => $this->input->post('date_spec',TRUE),
                'id_person' => $this->input->post('id_person',TRUE),
                'chem_parameter' => $this->input->post('chem_parameter',TRUE),
                'mixture_name' => $this->input->post('mixture_name',TRUE),
                'sample_no' => $this->input->post('sample_no',TRUE),
                'lot_no' => $this->input->post('lot_no',TRUE),
                'date_expired' => $this->input->post('date_expired',TRUE),
                'cert_value' => $this->input->post('cert_value',TRUE),
                'uncertainty' => $this->input->post('uncertainty',TRUE),
                'notes' => $this->input->post('notes',TRUE),
                // 'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );
    
            $this->Wat_water_spectroqc_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("wat_water_spectroqc"));
    }


    public function savedetail() 
    {
        $mode = $this->input->post('mode_det',TRUE);
        $id = $this->input->post('id_dspec',TRUE);
        $id_spec = $this->input->post('id_spec2',TRUE);
        // $f = $this->input->post('freezer',TRUE);
        // $s = $this->input->post('shelf',TRUE);
        // $r = $this->input->post('rack',TRUE);
        // $rl = $this->input->post('rack_level',TRUE);

        // $freezerloc = $this->WAT_water_spectroqc_model->getFreezLoc($f,$s,$r,$rl);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
                'id_spec' => $this->input->post('id_spec2',TRUE),
                'duplication' => $this->input->post('duplication',TRUE),
                'result' => $this->input->post('result',TRUE),
                'trueness' => $this->input->post('trueness',TRUE),
                'bias_method' => $this->input->post('bias_method',TRUE),
                'result2' => $this->input->post('result2',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
                );

            $this->Wat_water_spectroqc_model->insert_det($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
      
        }
        else if ($mode=="edit"){
            $data = array(
                'id_spec' => $this->input->post('id_spec2',TRUE),
                'duplication' => $this->input->post('duplication',TRUE),
                'result' => $this->input->post('result',TRUE),
                'trueness' => $this->input->post('trueness',TRUE),
                'bias_method' => $this->input->post('bias_method',TRUE),
                'result2' => $this->input->post('result2',TRUE),
                'uuid' => $this->uuid->v4(),
                'lab' => $this->session->userdata('lab'),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
                );
    
            $this->Wat_water_spectroqc_model->update_det($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("wat_water_spectroqc/read/".$id_spec));
    }

    public function spec_print($id) 
    {
        $row = $this->Wat_water_spectroqc_model->get_rep($id);
        if ($row) {
            $data = array(
            'id_spec' => $row->id_spec,
            'date_spec' => $row->date_spec,
            'realname' => $row->realname,
            'chem_parameter' => $row->chem_parameter,
            'chem2' => $row->chem2,
            'chem3' => $row->chem3,
            'mixture_name' => $row->mixture_name,
            'sample_no' => $row->sample_no,
            'lot_no' => $row->lot_no,
            'date_expired' => $row->date_expired,
            'cert_value' => $row->cert_value,
            'uncertainty' => $row->uncertainty,
            'notes' => $row->notes,
            'tot_result' => $row->tot_result,
            'tot_trueness' => $row->tot_trueness,
            'tot_bias' => $row->tot_bias,
            'avg_result' => $row->avg_result,
            'avg_trueness' => $row->avg_trueness,
            'avg_bias' => $row->avg_bias,
            'sd' => $row->sd,
            'rsd' => $row->rsd,
            'cv_horwits' => $row->cv_horwits,
            'cv' => $row->cv,
            'prec' => $row->prec,
            'accuracy' => $row->accuracy,
            'bias' => $row->bias,
            );
        // $data['items'] = $this->Tbl_receive_old_model->getItems();
            $this->template->load('template','wat_water_spectroqc/index_rep', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url("wat_water_spectroqc/read/".$id));
        }
    }

    public function spec_printdet() 
    {
        $id = $this->input->post('id',TRUE);
        header('Content-Type: application/json');
        echo $this->Wat_water_spectroqc_model->get_repdet($id);

        // $row = $this->Wat_water_spectroqc_model->get_rep($id);
        // if ($row) {
        //     $data = array(
        //     'id_spec' => $row->id_spec,
        //     'date_spec' => $row->date_spec,
        //     'realname' => $row->realname,
        //     'chem_parameter' => $row->chem_parameter,
        //     'chem2' => $row->chem2,
        //     'chem3' => $row->chem3,
        //     'mixture_name' => $row->mixture_name,
        //     'sample_no' => $row->sample_no,
        //     'lot_no' => $row->lot_no,
        //     'date_expired' => $row->date_expired,
        //     'cert_value' => $row->cert_value,
        //     'uncertainty' => $row->uncertainty,
        //     'notes' => $row->notes,
        //     'tot_result' => $row->tot_result,
        //     'tot_trueness' => $row->tot_trueness,
        //     'tot_bias' => $row->tot_bias,
        //     'avg_result' => $row->avg_result,
        //     'avg_trueness' => $row->avg_trueness,
        //     'avg_bias' => $row->avg_bias,
        //     'sd' => $row->sd,
        //     'rsd' => $row->rsd,
        //     'cv_horwits' => $row->cv_horwits,
        //     'cv' => $row->cv,
        //     'prec' => $row->prec,
        //     'accuracy' => $row->accuracy,
        //     'bias' => $row->bias,
        //     );
        // // $data['items'] = $this->Tbl_receive_old_model->getItems();
        //     $this->template->load('template','wat_water_spectroqc/index_rep', $data);
        // } else {
        //     $this->session->set_flashdata('message', 'Record Not Found');
        //     redirect(site_url("wat_water_spectroqc/read/".$id));
        // }
    }    

    public function delete($id) 
    {
        $row = $this->Wat_water_spectroqc_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->WAT_water_spectroqc_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('wat_water_spectroqc'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('wat_water_spectroqc'));
        }
    }

    public function valid_bs()
    {
        $id = $this->input->get('id1');
        $type = $this->input->get('id2');
        $data = $this->Wat_water_spectroqc_model->validate1($id, $type);
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
        $sheet->setCellValue('B1', "Date_process"); 
        $sheet->setCellValue('C1', "Time_process");
        $sheet->setCellValue('D1', "Lab_tech");
        $sheet->setCellValue('E1', "Freezer_bag");
        $sheet->setCellValue('F1', "Location");
        $sheet->setCellValue('G1', "Comments");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->Wat_water_spectroqc_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
          $sheet->setCellValue('B'.$numrow, $data->date_process);
          $sheet->setCellValue('C'.$numrow, $data->time_process);
          $sheet->setCellValue('D'.$numrow, $data->initial);
          $sheet->setCellValue('E'.$numrow, $data->freezer_bag);
          $sheet->setCellValue('F'.$numrow, $data->location);
          $sheet->setCellValue('G'.$numrow, $data->comments);
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'WAT_Water_spectroqc_'.$datenow.'.csv';

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

/* End of file WAT_water_spectroqc.php */
/* Location: ./application/controllers/WAT_water_spectroqc.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */