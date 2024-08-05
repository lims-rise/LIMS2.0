<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Consumables_new_order extends CI_Controller 
    {
    /**
     * Constructor for the class.
     *
     * This function is called when an object of the class is created.
     * It initializes the necessary dependencies and performs any necessary setup.
     *
     * @return void
     */
        function __construct()
        {
            parent::__construct();
            is_login();
            $this->load->model('Consumables_new_order_model');
            $this->load->library('form_validation');
            $this->load->library('datatables');
            $this->load->library('uuid');
        }

        /**
         * Loads the product data and renders the 'consumables_new_order/index' view.
         *
         * @return void
         */
        function index()
        {
            // $data['InStock'] = $this->Consumables_new_order_model->getInstock();
            $data['productName'] = $this->Consumables_new_order_model->getProduct();
            // var_dump($data);
            // die();
            $this->template->load('template', 'consumables_new_order/index', $data);
        }

    /**
     * Retrieves new order data in JSON format.
     *
     * This function sets the 'Content-Type' header to 'application/json' and
     * echoes the result of calling the 'jsonGetNewOrder' method on the
     * 'Consumables_new_order_model' object.
     *
     * @return void
     */
        public function jsonNewOrder()
        {
            header('Content-Type: application/json');
            echo $this->Consumables_new_order_model->jsonGetNewOrder();
        }

        /**
         * Save new consumables order.
         *
         * @return void
         */
        public function saveConsumablesNewOrder()
        {
            $mode = $this->input->post('mode',TRUE);
            $id = strtoupper($this->input->post('id_neworder',TRUE));
            $dt = new DateTime();
            $c = $this->input->post('product_id', TRUE);

            // var_dump($c);
            // die();
            if ($mode == "insert") {
                $data = array(
                    'product_id' => $this->input->post('product_id',TRUE),
                    'quantity_ordering' => $this->input->post('quantity_ordering',TRUE),
                    'unit_ordering' => $this->input->post('unit_ordering',TRUE),
                    'quantity_per_unit' => $this->input->post('quantity_per_unit',TRUE),
                    'total_quantity_ordered' => $this->input->post('total_quantity_ordered', TRUE),
                    'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                    'vendor' => $this->input->post('vendor',TRUE),
                    'indonesia_comments' => $this->input->post('indonesia_comments',TRUE),
                    'melbourne_comments' => $this->input->post('melbourne_comments',TRUE),
                    'order_decision' => $this->input->post('order_decision',TRUE),
                    'date_collected' => $this->input->post('date_collected',TRUE),
                    'time_collected' => $this->input->post('time_collected',TRUE),
                    'flag' => '0',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                
                // var_dump($data);
                // die();
                $this->Consumables_new_order_model->insertConsumablesNewOrder($data);
                // $this->Consumables_new_order_model->updateQtyProduct($id_product,$this->input->post('quantity_per_unit',TRUE));
                
                $this->session->set_flashdata('message', 'Create Record Success');  
            } else if ($mode == "edit") {
                $data = array(
                    'product_id' => $this->input->post('product_id',TRUE),
                    'quantity_ordering' => $this->input->post('quantity_ordering',TRUE),
                    'unit_ordering' => $this->input->post('unit_ordering',TRUE),
                    'quantity_per_unit' => $this->input->post('quantity_per_unit',TRUE),
                    'total_quantity_ordered' => $this->input->post('total_quantity_ordered', TRUE),
                    'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                    'vendor' => $this->input->post('vendor',TRUE),
                    'indonesia_comments' => $this->input->post('indonesia_comments',TRUE),
                    'melbourne_comments' => $this->input->post('melbourne_comments',TRUE),
                    'order_decision' => $this->input->post('order_decision',TRUE),
                    'date_collected' => $this->input->post('date_collected',TRUE),
                    'time_collected' => $this->input->post('time_collected',TRUE),
                    'flag' => '0',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'), 
                );
                $this->Consumables_new_order_model->updateConsumablesNewOrder($id, $data);
                $this->session->set_flashdata('message', 'Update Record Success');  
            }

            redirect(site_url("Consumables_new_order"));
        }


        /**
         * A function to delete a consumable new order record by its ID.
         *
         * @param datatype $id The ID of the consumable new order record to be deleted.
         * @throws Some_Exception_Class description of exception
         * @return Some_Return_Value
         */
        public function deleteConsumablesNewOrder($id)
        {
            $row = $this->Consumables_new_order_model->getById($id);
            if ($row) {
                $this->Consumables_new_order_model->destroyConsumablesNewOrder($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('Consumables_new_order'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('Consumables_new_order'));
            }
        }

        // public function readConsumablesNewOrder($id)
        // {
        //     // $data['testing_type'] = $this->Water_sample_reception_model->getTest();
        //     $row = $this->Consumables_new_order_model->get_detail($id);
        //     if ($row) {
        //         $data = array(
        //             'id_neworder' => $row->id_neworder,
        //             'stock_id' => $row->stock_id,
        //             'product_name' => $row->product_name,
        //             'quantity_ordering' => $row->quantity_ordering,
        //             'unit_ordering' => $row->unit_ordering,
        //             'quantity_per_unit' => $row->quantity_per_unit,
        //             'total_quantity_ordered' => $row->total_quantity_ordered,
        //             'unit_of_measure' => $row->unit_of_measure,
        //             'indonesia_comments' => $row->indonesia_comments,
        //             'melbourne_comments' => $row->melbourne_comments,
        //             'order_decision' => $row->order_decision,
        //             );
        //             // var_dump($data);
        //             // die();
        //             $this->template->load('template','consumables_order_detail/index', $data);
        //     }
        //     else {
        //         // $this->template->load('template','Water_sample_reception/index_det');
        //     }
        // }

    }
?>