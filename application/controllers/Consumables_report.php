<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// require_once '../../extlib/PHPExcel/PHPExcel.php';

class Consumables_report extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Consumables_report_model');
        // $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $data['objectives'] = $this->Consumables_report_model->getObjective();
        $this->template->load('template','consumables_report/index', $data);
    } 

    
    public function json() {
        $date1=$this->input->get('date1');
        $date2=$this->input->get('date2');
        $objective = $this->input->get('objective');
        $stock = $this->input->get('stock');
        // var_dump($date2);
        header('Content-Type: application/json');
        echo $this->Consumables_report_model->json($date1,$date2,$objective,$stock);
    }

    public function getStockByObjective()
    {
        $id_objective = $this->input->post('id_objective');
        $data = $this->Consumables_report_model->getStockByObjective($id_objective);
        echo json_encode($data);
    }


    public function excel()
    {
        $date1=$this->input->get('date1');
        $date2=$this->input->get('date2');
        $objective = $this->input->get('objective');
        $stock = $this->input->get('stock');

        $this->load->database();
        if ($objective == 'all') {
            $query = 'SELECT 
                ro.objective, 
                cs.product_name, 
                cis.closed_container, 
                cis.unit_measure_lab, 
                cis.quantity_per_unit, 
                cis.loose_items, 
                cis.total_quantity, 
                cis.unit_of_measure,
                cis.expired_date,
                cis.comments,
                cis.date_collected,
                cis.flag
            FROM consumables_in_stock AS cis
            LEFT JOIN ref_objective AS ro ON cis.id_objective = ro.id_objective
            LEFT JOIN consumables_stock AS cs ON cis.id_stock = cs.id_stock
            WHERE
                (cis.date_collected  >= "'.$date1.'"
                AND cis.date_collected  <= "'.$date2.'")
                AND cis.lab = "'.$this->session->userdata('lab').'" 
                AND cis.flag = 0 
            ORDER BY cis.date_collected, cis.id_objective';
        }  else {
            $query = 'SELECT 
                ro.objective, 
                cs.product_name, 
                cis.closed_container, 
                cis.unit_measure_lab, 
                cis.quantity_per_unit, 
                cis.loose_items, 
                cis.total_quantity, 
                cis.unit_of_measure,
                cis.expired_date,
                cis.comments,
                cis.date_collected,
                cis.flag
            FROM consumables_in_stock AS cis
            LEFT JOIN ref_objective AS ro ON cis.id_objective = ro.id_objective
            LEFT JOIN consumables_stock AS cs ON cis.id_stock = cs.id_stock
            WHERE
                (cis.date_collected  >= "'.$date1.'"
                AND cis.date_collected  <= "'.$date2.'")
                AND cis.id_objective = "'.$objective.'"
                AND cis.lab = "'.$this->session->userdata('lab').'" 
                AND cis.flag = 0 ';
        
            if (!empty($stock)) {
                $query .= ' AND cis.id_stock = "'.$stock.'"';
            }
        
            $query .= ' ORDER BY cis.date_collected, cis.id_objective';
        }
      
        $spreadsheet = new Spreadsheet();

        $sheets = array(
            array(
                'Stock Take Report',
                $query,
                array('objective', 'product_name', 'closed_container', 'unit_measure_lab', 'quantity_per_unit', 'loose_items', 'total_quantity', 'unit_of_measure', 'expired_date', 'comments', 'date_collected', 'flag'), // Columns for Sheet1
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
        $filename = 'Consumables_report_'.$datenow.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Save the Excel file to the output stream
        $writer->save('php://output');
           
    }

}


/* End of file Tbl_customer.php */
/* Location: ./application/controllers/Tbl_customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:29:29 */
/* http://harviacode.com */