<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    
class Ref_consumables extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Ref_consumables_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        $data['stockName'] = $this->Ref_consumables_model->getStock();
        $data['objectives'] = $this->Ref_consumables_model->getObjective();
        $data['id_consumables'] = $this->Ref_consumables_model->generate_id_consumables();
        $this->template->load('template','ref_consumables/index', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->Ref_consumables_model->json();
    }

    public function save() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = $this->input->post('idx_consumanbles',TRUE);
        $id_stock = $this->input->post('id_stock',TRUE);
        $id_objective = $this->input->post('id_objective',TRUE);
        $dt = new DateTime();

        if ($mode=="insert"){
            $data = array(
            'id_objective' => $id,
            'id_stock' => $id_stock,
            'id_objective' => $id_objective,
            'uuid' => $this->uuid->v4(),
            'flag' => '0',
            'lab' => $this->session->userdata('lab'),
            'user_created' => $this->session->userdata('id_users'),
            'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
 
            $this->Ref_consumables_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }
        else if ($mode=="edit"){
            $data = array(
            'id_objective' => $id,
            'id_stock' => $id_stock,
            'id_objective' => $id_objective,
            'uuid' => $this->uuid->v4(),
            'flag' => '0',
            'lab' => $this->session->userdata('lab'),
            'user_updated' => $this->session->userdata('id_users'),
            'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            $this->Ref_consumables_model->update($id, $data);
            $this->session->set_flashdata('message', 'Create Record Success');    
        }

        redirect(site_url("ref_consumables"));
    }

    public function delete($id) 
    {
        $row = $this->Ref_consumables_model->get_by_id($id);
        $data = array(
            'flag' => 1,
            );

        if ($row) {
            $this->Ref_consumables_model->update($id, $data);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('ref_consumables'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('ref_consumables'));
        }
    }

    public function valid_bs() 
    {
        $id = $this->input->get('id1');
        $data = $this->Ref_consumables_model->validate1($id);
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    public function excel()
    {
        // $date1=$this->input->get('date1');
        // $date2=$this->input->get('date2');

        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "ID_destination"); 
        $sheet->setCellValue('B1', "Destination");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $rdeliver = $this->Ref_consumables_model->get_all();
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
          $sheet->setCellValue('A'.$numrow, $data->id_objective);
          $sheet->setCellValue('B'.$numrow, $data->objective);
        //   $no++; // Tambah 1 setiap kali looping
          $numrow++; // Tambah 1 setiap kali looping
        }
    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    $datenow=date("Ymd");
    $fileName = 'MASTER_objective_'.$datenow.'.csv';

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=$fileName"); // Set nama file excel nya
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
           
    }
}

/* End of file Ref_destination.php */
/* Location: ./application/controllers/Ref_destination.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */