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
                'notes' => trim($this->input->post('notes',TRUE)),
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
                'notes' => trim($this->input->post('notes',TRUE)),
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

        $this->load->database();

        // Database connection settings
        // $host = 'localhost';
        // $user = 'root';
        // $password = '';

        // // Create a database connection
        // $mysqli = new mysqli($host, $user, $password, $database);

        // // Check for connection errors
        // if ($mysqli->connect_error) {
        //     die('Connection failed: ' . $mysqli->connect_error);
        // }        
        $spreadsheet = new Spreadsheet();

        $sheets = array(
            array(
                'Water_Spectro',
                'SELECT a.id_spec AS ID_spectro, a.date_spec AS Date_spectro, c.initial AS Lab_tech, a.chem_parameter AS Chemistry_parameter, a.mixture_name AS Mixture_name, a.sample_no AS Sample_number, 
                a.lot_no AS Lot_number, a.date_expired AS Date_expired, a.cert_value AS Certified_value, a.uncertainty AS Uncertainty, TRIM(a.notes) AS Comments, a.tot_result AS Total_result, a.tot_trueness AS Total_trueness,
                a.tot_bias AS Total_bias, a.avg_result AS AVG_result, a.avg_trueness AS AVG_trueness, a.avg_bias AS AVG_bias, a.sd AS SD, a.rsd AS `%RSD`, a.cv_horwits AS `%CV_horwits`, a.cv AS `0.67x%CV`,
                a.prec AS Test_Precision, a.accuracy AS Test_Accuracy, a.bias AS `Test_Bias`
                FROM obj2b_spectro_crm a
                LEFT JOIN ref_person c ON a.id_person = c.id_person
                WHERE
                a.lab = "'.$this->session->userdata('lab').'" 
                AND a.flag = 0 
                ORDER BY a.date_spec, a.id_spec
                ',
                array('ID_spectro', 'Date_spectro', 'Lab_tech', 'Chemistry_parameter', 'Mixture_name', 
                'Sample_number', 'Lot_number', 'Date_expired', 'Certified_value', 'Uncertainty', 
                'Comments', 'Total_result', 'Total_trueness', 'Total_bias', 'AVG_result', 'AVG_trueness',
                'AVG_bias', 'SD', '%RSD', '%CV_horwits', '0.67x%CV', 'Test_Precision', 'Test_Accuracy', 'Test_Bias'), // Columns for Sheet1
            ),
            array(
                'Water_spectro_QC_detail',
                'SELECT b.id_dspec AS ID_detail_spectro, b.id_spec AS ID_parent_spectro, b.duplication AS Duplication, 
                b.result AS Result, b.trueness AS Trueness, b.bias_method AS Bias_method, b.result2 AS `Result^2`
                FROM obj2b_spectro_crm_det b
                WHERE b.lab = "'.$this->session->userdata('lab').'" 
                AND b.flag = 0 
                ORDER BY b.id_spec, b.id_dspec ASC
                ', // Different columns for Sheet2
                array('ID_detail_spectro', 'ID_parent_spectro', 'Duplication', 'Result', 'Trueness', 'Bias_method', 'Result^2'), // Columns for Sheet2
            ),
            // Add more sheets as needed
        );
        
        $spreadsheet->removeSheetByIndex(0);

        foreach ($sheets as $sheetInfo) {
            // Create a new worksheet for each sheet
            $worksheet = $spreadsheet->createSheet();
            $worksheet->setTitle($sheetInfo[0]);
    
            // SQL query to fetch data for this sheet
            $sql = $sheetInfo[1];
            
            // Use the query builder to fetch data
            $query = $this->db->query($sql);
            $result = $query->result_array();
            
            // Column headers for this sheet
            $columns = $sheetInfo[2];
    
            // Add column headers
            $col = 1;
            foreach ($columns as $column) {
                $worksheet->setCellValueByColumnAndRow($col, 1, $column);
                $col++;
            }
    
            // Add data rows
            $row = 2;
            foreach ($result as $row_data) {
                $col = 1;
                foreach ($columns as $column) {
                    $worksheet->setCellValueByColumnAndRow($col, $row, $row_data[$column]);
                    $col++;
                }
                $row++;
            }
        }

        // Create a new Xlsx writer
        $writer = new Xlsx($spreadsheet);
        
        // Set the HTTP headers to download the Excel file
        $datenow=date("Ymd");
        $filename = 'Water_Spectro_QC_'.$datenow.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Save the Excel file to the output stream
        $writer->save('php://output');
    }


    // public function excel()
    // {
    //     $spreadsheet = new Spreadsheet();    
    //     $sheet = $spreadsheet->getActiveSheet();
    //     $sheet->setCellValue('A1', "ID_spectro"); 
    //     $sheet->setCellValue('B1', "Date_spectro"); 
    //     $sheet->setCellValue('C1', "Lab_tech");
    //     $sheet->setCellValue('D1', "Chemistry_parameter");
    //     $sheet->setCellValue('E1', "Mixture_name");
    //     $sheet->setCellValue('F1', "Sample_number");
    //     $sheet->setCellValue('G1', "Lot_number");
    //     $sheet->setCellValue('G1', "Date_expired");
    //     $sheet->setCellValue('G1', "Certified_value");
    //     $sheet->setCellValue('G1', "Uncertainty");
    //     $sheet->setCellValue('G1', "Comments");

    //     // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1

    //     // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    //     $rdeliver = $this->Wat_water_spectroqc_model->get_all();
    
    //     // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    //     $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
    //     foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
    //       $sheet->setCellValue('A'.$numrow, $data->barcode_sample);
    //       $sheet->setCellValue('B'.$numrow, $data->date_process);
    //       $sheet->setCellValue('C'.$numrow, $data->time_process);
    //       $sheet->setCellValue('D'.$numrow, $data->initial);
    //       $sheet->setCellValue('E'.$numrow, $data->freezer_bag);
    //       $sheet->setCellValue('F'.$numrow, $data->location);
    //       $sheet->setCellValue('G'.$numrow, $data->comments);
    //       $numrow++; // Tambah 1 setiap kali looping
    //     }
    // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
    // $datenow=date("Ymd");
    // $fileName = 'WAT_Water_spectroqc_'.$datenow.'.csv';

    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header("Content-Disposition: attachment; filename=$fileName"); // Set nama file excel nya
    // header('Cache-Control: max-age=0');

    // $writer->save('php://output');
    // }
}

/* End of file WAT_water_spectroqc.php */
/* Location: ./application/controllers/WAT_water_spectroqc.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */