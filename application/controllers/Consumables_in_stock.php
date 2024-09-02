<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

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
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
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
        redirect(site_url("Consumables_in_stock"));
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
            redirect(site_url('Consumables_in_stock'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Consumables_in_stock'));
        }
    }

}