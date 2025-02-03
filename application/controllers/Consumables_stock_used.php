<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Google\Client as google_client;
use Google\Service\Drive as google_drive;

class Consumables_stock_used extends CI_Controller
{
    /**
     * Constructor for the class.
     *
     * This function is called when an object of the class is created.
     * It initializes the necessary components and libraries required by the class.
     *
     * @return void
     */
    function __construct() {
        parent:: __construct();
        is_login();
        $this->load->model('Consumables_stock_used_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->library('uuid');
    }

    /**
     * Displays the index page of the Consumables stock used controller.
     *
     * This function retrieves the list of products from the Consumables_stock_used_model
     * and loads the 'consumables_stock_used/index' view with the retrieved data.
     *
     * @return void
     */
    public function index() 
    {
        // $data['product'] = $this->Consumables_stock_used_model->getProduct();
        // $this->template->load('template', 'consumables_stock_used/index', $data);
        // $this->Consumables_stock_used_model->checkStockLevelsAndSendNotification();
        $data['id_stock'] = $this->Consumables_stock_used_model->generate_id_stock();
        $this->template->load('template', 'consumables_stock_used/index', $data);
    }

    // public function getProductDetails()
    // {
    //     $productId = $this->input->post('productId');
    //     $product = $this->Consumables_stock_used_model->getProductById($productId);
    //     echo json_encode($product);
    // }





    /**
     * Retrieves the stock used data in JSON format.
     *
     * @return void
     */
    public function jsonStockUsed()
    {
        header('Content-Type: application/json');
        echo $this->Consumables_stock_used_model->jsonGetStockUsed();

    }

/**
 * Saves the consumables stock used.
 *
 * This function saves the consumables stock used data. It retrieves the mode,
 * id, and current date and time from the input. If the mode is "insert", it
 * creates a new array with the necessary data and inserts it into the
 * database using the Consumables_stock_used_model. If the mode is "edit", it
 * updates the data in the database using the same model. Finally, it sets
 * a flash message and redirects to the Consumables_stock_used page.
 *
 * @return void
 */
    public function saveConsumablesStockUsed()
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('idx_stock',TRUE));
        $dt = new DateTime();

        if ($mode == "insert") {
            $data = array(
                // 'product_id' => $this->input->post('id',TRUE),
                'product_name' => $this->input->post('product_name',TRUE),
                'quantity' => $this->input->post('quantity',TRUE),
                'quantity_take' => $this->input->post('quantity_take',TRUE),
                'unit' => $this->input->post('unit',TRUE),
                'quantity_per_unit' => $this->input->post('quantity_per_unit',TRUE),
                'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                // 'used' => $this->input->post('used',TRUE),
                // 'n_campaigns' => $this->input->post('n_campaigns',TRUE),
                'item_description' => $this->input->post('item_description', TRUE),
                'comments' => $this->input->post('comments', TRUE),
                'minimum_stock' => $this->input->post('minimum_stock',TRUE),
                'date_collected' => $this->input->post('date_collected',TRUE),
                // 'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
            $this->Consumables_stock_used_model->insertConsumablesStockUsed($data);
            $this->session->set_flashdata('message', 'Create Record Success');  
        } else if ($mode == "edit"){
            $data = array(
                // 'product_id' => $this->input->post('id',TRUE),
                'product_name' => $this->input->post('product_name',TRUE),
                'quantity' => $this->input->post('quantity',TRUE),
                'quantity_take' => $this->input->post('quantity_take',TRUE),
                'unit' => $this->input->post('unit',TRUE),
                'quantity_per_unit' => $this->input->post('quantity_per_unit',TRUE),
                'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                // 'used' => $this->input->post('used',TRUE),
                // 'n_campaigns' => $this->input->post('n_campaigns',TRUE),
                'item_description' => $this->input->post('item_description', TRUE),
                'comments' => $this->input->post('comments', TRUE),
                'minimum_stock' => $this->input->post('minimum_stock',TRUE),
                'date_collected' => $this->input->post('date_collected',TRUE),
                // 'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
                'lab' => $this->session->userdata('lab'),
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
            $this->Consumables_stock_used_model->updateConsumablesStockUsed($id, $data);
            $this->session->set_flashdata('message', 'Update Record Success'); 
        }
        redirect(site_url("consumables_stock_used"));
    }

    /**
     * Deletes a consumable stock used record by its ID.
     *
     * @param datatype $id The ID of the consumable stock used record to be deleted.
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function deleteConsumablesStockUsed($id) 
    {
        $row = $this->Consumables_stock_used_model->getById($id);
        if ($row) {
            $this->Consumables_stock_used_model->destroyConsumablesSTockUsed($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('consumables_stock_used'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('consumables_stock_used'));
        }
    }

    // public function check_stock_levels()
    // {
    //     $this->Consumables_stock_used_model->checkStockLevelsAndSendNotification();
    //     echo "Stock levels checked and notifications sent if necessary.";
    // }

    // public function run_stock_check() {
    //     $this->load->model('Consumables_stock_used_model');
    //     $this->Consumables_stock_used_model->checkStockLevelsAndSendNotification();
    //     echo 'Stock check completed';
    // }

    public function excel() {
        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', "Product Name"); 
        $sheet->setCellValue('B1', "Quantity"); 
        $sheet->setCellValue('C1', "Unit");
        $sheet->setCellValue('D1', "Quantity Per Unit");
        $sheet->setCellValue('E1', "Unit of Measure");
        $sheet->setCellValue('F1', "Item Description");
        $sheet->setCellValue('G1', "Comments");
        $sheet->setCellValue('H1', "Date Collected");

        $in_stock = $this->Consumables_stock_used_model->get_all();
    
        $numrow = 2;
        foreach($in_stock as $data){ 
            if (property_exists($data, 'product_name')) {
                $sheet->setCellValue('A'.$numrow, $data->product_name);
            } else {
                $sheet->setCellValue('A'.$numrow, '');
            }
    
            if (property_exists($data, 'quantity')) {
                $sheet->setCellValue('B'.$numrow, $data->quantity);
            } else {
                $sheet->setCellValue('B'.$numrow, '');
            }
    
            if (property_exists($data, 'unit')) {
                $sheet->setCellValue('C'.$numrow, $data->unit);
            } else {
                $sheet->setCellValue('C'.$numrow, '');
            }
    
            if (property_exists($data, 'quantity_per_unit')) {
                $sheet->setCellValue('D'.$numrow, $data->quantity_per_unit);
            } else {
                $sheet->setCellValue('D'.$numrow, '');
            }

            if (property_exists($data, 'unit_of_measure')) {
                $sheet->setCellValue('F'.$numrow, $data->unit_of_measure);
            } else {
                $sheet->setCellValue('F'.$numrow, '');
            }
    
            if (property_exists($data, 'item_description')) {
                $sheet->setCellValue('E'.$numrow, $data->item_description);
            } else {
                $sheet->setCellValue('E'.$numrow, '');
            }
    
            if (property_exists($data, 'comments')) {
                $sheet->setCellValue('G'.$numrow, $data->comments);
            } else {
                $sheet->setCellValue('G'.$numrow, '');
            }
    
            if (property_exists($data, 'date_collected')) {
                $sheet->setCellValue('H'.$numrow, $data->date_collected);
            } else {
                $sheet->setCellValue('H'.$numrow, '');
            }
    
            $numrow++;
        }

        // Set header untuk file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Report_In_stock.xlsx"');
        header('Cache-Control: max-age=0');

        // Tampilkan file excel
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }

}

?>