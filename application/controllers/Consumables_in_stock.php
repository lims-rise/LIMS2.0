<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Google\Client as google_client;
use Google\Service\Drive as google_drive;


class Consumables_in_stock extends CI_Controller {

    /**
     * Constructor for the Consumables_in_stock controller.
     */
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Consumables_in_stock_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    /**
     * Retrieves all consumables in stock and the product names,
     * then loads the 'consumables_in_stock/index' view with the data.
     *
     * @return void
     */
    public function index()
    {
        $data['inStock'] = $this->Consumables_in_stock_model->getAllConsumablesInStock();
        $data['stockName'] = $this->Consumables_in_stock_model->getStock();
        $data['objectives'] = $this->Consumables_in_stock_model->getObjective();
        $this->template->load('template','consumables_in_stock/index', $data);
    } 

    public function getStockDetails()
    {
        $idStock = $this->input->post('idStock');
        $stock = $this->Consumables_in_stock_model->getStockById($idStock);
        echo json_encode($stock);
    }

    public function getStockByObjective()
    {
        $id_objective = $this->input->post('id_objective');
        $data = $this->Consumables_in_stock_model->getStockByObjective($id_objective);
        echo json_encode($data);
    }



    /**
     * Retrieves the JSON representation of the in stock consumables.
     *
     * @return void
     */
    public function jsonInStock() {
        header('Content-Type: application/json');
        echo $this->Consumables_in_stock_model->jsonGetInStock();
    }


    /**
     * Saves the consumables in stock based on the provided mode.
     *
     * @return void
     */
    public function saveConsumablesInStock()
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('id_instock',TRUE));
        $dt = new DateTime();

        if ($mode == "insert") {

            $data = array(
                 // 'product_id' => $this->input->post('id',TRUE),
                'id_stock' => $this->input->post('id_stock',TRUE),
                'id_objective' => $this->input->post('id_objective',TRUE),
                'closed_container' => $this->input->post('closed_container',TRUE),
                'unit_measure_lab' => $this->input->post('unit_measure_lab',TRUE),
                'quantity_per_unit' => $this->input->post('quantity_per_unit',TRUE),
                'loose_items' => $this->input->post('loose_items', TRUE),
                'total_quantity' => $this->input->post('total_quantity',TRUE),
                'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                'expired_date' => $this->input->post('expired_date',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                // 'indonesia_comments' => $this->input->post('indonesia_comments',TRUE),
                // 'melbourne_comments' => $this->input->post('melbourne_comments',TRUE),
                'date_collected' => $this->input->post('date_collected',TRUE),
                'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
    
            $result = $this->Consumables_in_stock_model->insertConsumablesInStock($data);
            if ($result) {
                $this->session->set_flashdata('message', 'Stock added successfully.');
            } else {
                $this->session->set_flashdata('message', 'Failed to add stock.');
            }
        } else if ($mode == "edit") {
            $data = array(
                // 'product_id' => $this->input->post('id',TRUE),
                'id_stock' => $this->input->post('id_stock',TRUE),
                'id_objective' => $this->input->post('id_objective',TRUE),
                'closed_container' => $this->input->post('closed_container',TRUE),
                'unit_measure_lab' => $this->input->post('unit_measure_lab',TRUE),
                'quantity_per_unit' => $this->input->post('quantity_per_unit',TRUE),
                'loose_items' => $this->input->post('loose_items', TRUE),
                'total_quantity' => $this->input->post('total_quantity',TRUE),
                'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                'expired_date' => $this->input->post('expired_date',TRUE),
                'comments' => $this->input->post('comments',TRUE),
                // 'indonesia_comments' => $this->input->post('indonesia_comments',TRUE),
                // 'melbourne_comments' => $this->input->post('melbourne_comments',TRUE),
                'date_collected' => $this->input->post('date_collected',TRUE),
                'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
            $result = $this->Consumables_in_stock_model->updatetConsumablesInStock($id, $data);
            if ($result) {
                $this->session->set_flashdata('message', 'Stock updated successfully.');
            } else {
                $this->session->set_flashdata('message', 'Failed to update stock.');
            } 
        }
         // Check stock levels and send notification after saving data
        $this->Consumables_in_stock_model->checkStockLevelsAndSendNotification();
        redirect(site_url("consumables_in_stock"));
    }

    /**
     * Deletes a consumable in stock record by its ID.
     *
     * @param int $id The ID of the consumable in stock record to be deleted.
     * @return void
     */
    public function deleteConsumablesInStock($id)
    {
        $row = $this->Consumables_in_stock_model->getById($id);
        if ($row) {
            $this->Consumables_in_stock_model->destroyConsumablesInStock($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('consumables_in_stock'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('consumables_in_stock'));
        }
    }

    public function excel() {
        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Objective"); 
        $sheet->setCellValue('B1', "Product Name"); 
        $sheet->setCellValue('C1', "Close Container");
        $sheet->setCellValue('D1', "Unit Measure Lab");
        $sheet->setCellValue('E1', "Quantity Per Unit");
        $sheet->setCellValue('F1', "Loose Items");
        $sheet->setCellValue('G1', "Total Quantity");
        $sheet->setCellValue('H1', "Unit of Measure");
        $sheet->setCellValue('I1', "Expired Date");
        $sheet->setCellValue('J1', "Comments");
        $sheet->setCellValue('K1', "Date Collected");
        $sheet->setCellValue('L1', "Time Collected");

        $stock_take = $this->Consumables_in_stock_model->get_all();
        $numrow = 2;
        foreach($stock_take as $data){ 
            if (property_exists($data, 'objective')) {
                $sheet->setCellValue('A'.$numrow, $data->objective);
            } else {
                $sheet->setCellValue('A'.$numrow, '');
            }
    
            if (property_exists($data, 'product_name')) {
                $sheet->setCellValue('B'.$numrow, $data->product_name);
            } else {
                $sheet->setCellValue('B'.$numrow, '');
            }
    
            if (property_exists($data, 'closed_container')) {
                $sheet->setCellValue('C'.$numrow, $data->closed_container);
            } else {
                $sheet->setCellValue('C'.$numrow, '');
            }
    
            if (property_exists($data, 'unit_measure_lab')) {
                $sheet->setCellValue('D'.$numrow, $data->unit_measure_lab);
            } else {
                $sheet->setCellValue('D'.$numrow, '');
            }

            if (property_exists($data, 'quantity_per_unit')) {
                $sheet->setCellValue('F'.$numrow, $data->quantity_per_unit);
            } else {
                $sheet->setCellValue('F'.$numrow, '');
            }
    
            if (property_exists($data, 'loose_items')) {
                $sheet->setCellValue('E'.$numrow, $data->loose_items);
            } else {
                $sheet->setCellValue('E'.$numrow, '');
            }
    
            if (property_exists($data, 'total_quantity')) {
                $sheet->setCellValue('G'.$numrow, $data->total_quantity);
            } else {
                $sheet->setCellValue('G'.$numrow, '');
            }
    
            if (property_exists($data, 'unit_of_measure')) {
                $sheet->setCellValue('H'.$numrow, $data->unit_of_measure);
            } else {
                $sheet->setCellValue('H'.$numrow, '');
            }
    
            if (property_exists($data, 'expired_date')) {
                $sheet->setCellValue('I'.$numrow, $data->expired_date);
            } else {
                $sheet->setCellValue('I'.$numrow, '');
            }
    
            if (property_exists($data, 'comments')) {
                $sheet->setCellValue('J'.$numrow, $data->comments);
            } else {
                $sheet->setCellValue('J'.$numrow, '');
            }

            if (property_exists($data, 'date_collected')) {
                $sheet->setCellValue('K'.$numrow, $data->date_collected);
            } else {
                $sheet->setCellValue('K'.$numrow, '');
            }

            if (property_exists($data, 'time_collected')) {
                $sheet->setCellValue('L'.$numrow, $data->time_collected);
            } else {
                $sheet->setCellValue('L'.$numrow, '');
            }
            $numrow++;
        }

        // Set header untuk file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report_Stock_take.xlsx"');
        header('Cache-Control: max-age=0');

        // Tampilkan file excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

}