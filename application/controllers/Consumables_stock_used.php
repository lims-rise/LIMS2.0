<?php

if(!defined('BASEPATH')) exit('No direct script access allowed');

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
        $data['product'] = $this->Consumables_stock_used_model->getProduct();
        $this->template->load('template', 'consumables_stock_used/index', $data);
    }

    public function getProductDetails()
    {
        $productId = $this->input->post('productId');
        $product = $this->Consumables_stock_used_model->getProductById($productId);
        echo json_encode($product);
    }





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
        $id = strtoupper($this->input->post('id_stockused',TRUE));
        $dt = new DateTime();

        if ($mode == "insert") {
            $data = array(
                'product_id' => $this->input->post('id',TRUE),
                'quantity' => $this->input->post('quantity',TRUE),
                'unit' => $this->input->post('unit_of_measure',TRUE),
                'n_campaigns' => $this->input->post('n_campaigns',TRUE),
                'comments' => $this->input->post('comments', TRUE),
                'minimum_stock' => $this->input->post('minimum_stock',TRUE),
                'date_collected' => $this->input->post('date_collected',TRUE),
                'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
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
                'product_id' => $this->input->post('id',TRUE),
                'quantity' => $this->input->post('quantity',TRUE),
                'unit' => $this->input->post('unit_of_measure',TRUE),
                'n_campaigns' => $this->input->post('n_campaigns',TRUE),
                'comments' => $this->input->post('comments', TRUE),
                'minimum_stock' => $this->input->post('minimum_stock',TRUE),
                'date_collected' => $this->input->post('date_collected',TRUE),
                'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
            $this->Consumables_stock_used_model->updateConsumablesStockUsed($id, $data);
            $this->session->set_flashdata('message', 'Update Record Success'); 
        }
        redirect(site_url("Consumables_stock_used"));
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
            redirect(site_url('Consumables_stock_used'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Consumables_stock_used'));
        }
    }
}

?>