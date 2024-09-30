<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Consumables_product extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Consumables_product_model');
        $this->load->library('form_validation');        
	    $this->load->library('datatables');
	    $this->load->library('uuid');
    }

    public function index()
    {
        // $this->load->model('O3_sample_reception_model');
        // $data['product'] = $this->Consumables_product_model->getAllConsumablesProduct();
        // $data['type'] = $this->O3_sample_reception_model->getSampleType();\
        $data['stock'] = $this->Consumables_product_model->getStock();
        // var_dump($data);
        // die();
        $this->template->load('template','consumables_product/index', $data);
    } 

    public function jsonProduct() {
        header('Content-Type: application/json');
        echo $this->Consumables_product_model->jsonGetProduct();
    }

    public function getStockDetails()
    {
        $idStock = $this->input->post('idStock');
        $stock = $this->Consumables_product_model->getStockById($idStock);
        echo json_encode($stock);
    }

    public function saveConsumablesProduct() 
    {
        $mode = $this->input->post('mode',TRUE);
        $id = strtoupper($this->input->post('id',TRUE));
        $dt = new DateTime();

        if ($mode == "insert") {
            $data = array(
                'id_stock' => $this->input->post('id_stock',TRUE),
                'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                'quantity' => $this->input->post('quantity',TRUE),
                // 'units' => $this->input->post('units', TRUE),
                'item_description' => $this->input->post('item_description',TRUE),
                'date_collected' => $this->input->post('date_collected',TRUE),
                'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
                'uuid' => $this->uuid->v4(),
                'user_created' => $this->session->userdata('id_users'),
                'date_created' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($data);
            // die();
            $this->Consumables_product_model->insertConsumablesProduct($data);
            $this->session->set_flashdata('message', 'Create Record Success');   
            
        } else if ($mode == "edit") {
            $data = array(
                // 'product_name' => $this->input->post('product_name',TRUE),
                // 'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                // 'quantity' => $this->input->post('quantity',TRUE),
                // 'units' => $this->input->post('units', TRUE),
                'id_stock' => $this->input->post('id_stock',TRUE),
                'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                'quantity' => $this->input->post('quantity',TRUE),
                'item_description' => $this->input->post('item_description',TRUE),
                'date_collected' => $this->input->post('date_collected',TRUE),
                'time_collected' => $this->input->post('time_collected',TRUE),
                'flag' => '0',
                'uuid' => $this->uuid->v4(),
                'user_updated' => $this->session->userdata('id_users'),
                'date_updated' => $dt->format('Y-m-d H:i:s'),
            );

            // var_dump($id);
            // die();
            $this->Consumables_product_model->updateConsumablesProduct($id, $data);
            $this->session->set_flashdata('message', 'Update Record Success'); 
        } 

        redirect(site_url("Consumables_product"));
    }

    public function deleteConsumablesProduct($id)
    {
        $row = $this->Consumables_product_model->getById($id);
        if ($row) {
            $this->Consumables_product_model->destroyConsumablesProduct($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Consumables_product'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Consumables_product'));
        }
    }
}

?>