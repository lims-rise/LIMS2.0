<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Consumables_order_detail extends CI_Controller
    {
        /**
         * Constructor for the Consumables_order_detail controller.
         */
        function __construct()
        {
            parent:: __construct();
            is_login();
            $this->load->model('Consumables_order_detail_model');
            $this->load->library('form_validation');
            $this->load->library('datatables');
            $this->load->library('uuid');
        }

        /**
         * Retrieves the product data and loads the 'consumables_order_detail/index' view template.
         *
         * @throws - No specific exceptions are mentioned.
         * @return - No specific return value is mentioned.
         */
        function index()
        {
            // $data['oderDetail'] = $this->Consumables_order_detail_model->getById();
            $data['newOrder'] = $this->Consumables_order_detail_model->getProduct();
            $this->template->load('template', 'consumables_order_detail/index', $data);
        }

    /**
     * Retrieves the order detail data in JSON format and sends it as a response.
     *
     * @return void
     */
        public function jsonOrderDetail() 
        {
            $id2 = $this->input->get('id2',TRUE);
            header('Content-Type: application/json');
            echo $this->Consumables_order_detail_model->jsonGetOrderDetail($id2);
        }

    /**
     * Saves the consumables order detail.
     *
     * @return void
     */
        public function saveConsumablesOrderDetail() 
        {
            $mode = $this->input->post('mode',TRUE);
            $id = strtoupper($this->input->post('id_orderdetail',TRUE));
            $id_order = $this->input->post('id_neworder2',TRUE);
            $dt = new DateTime();

            if ($mode == 'insert') {
                $data = array(
                    'new_order_id' => $this->input->post('id_neworder2',TRUE),
                    'order_number' => $this->input->post('order_number',TRUE),
                    'ordered' => $this->input->post('ordered',TRUE),
                    'received' => $this->input->post('received',TRUE),
                    'amount_received' => $this->input->post('amount_received', TRUE),
                    'unit_reference' => $this->input->post('unit_reference1',TRUE),
                    'date_received' => $this->input->post('date_received',TRUE),
                    'contact_supplier_progress' => $this->input->post('contact_supplier_progress',TRUE),
                    'progress' => $this->input->post('progress1',TRUE),
                    'date_collected' => $this->input->post('date_collected',TRUE),
                    'time_collected' => $this->input->post('time_collected',TRUE),
                    'flag' => '0',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );

                // var_dump($data);
                // die();

                $this->Consumables_order_detail_model->insertConsumablesOrderDetail($data);
                $this->session->set_flashdata('message', 'Create Record Success');  
            } else if ($mode == 'edit') {
                $data = array(
                    'new_order_id' => $this->input->post('id_neworder2',TRUE),
                    'order_number' => $this->input->post('order_number',TRUE),
                    'ordered' => $this->input->post('ordered',TRUE),
                    'received' => $this->input->post('received',TRUE),
                    'amount_received' => $this->input->post('amount_received', TRUE),
                    'unit_reference' => $this->input->post('unit_reference1',TRUE),
                    'date_received' => $this->input->post('date_received',TRUE),
                    'contact_supplier_progress' => $this->input->post('contact_supplier_progress',TRUE),
                    'progress' => $this->input->post('progress1',TRUE),
                    'date_collected' => $this->input->post('date_collected',TRUE),
                    'time_collected' => $this->input->post('time_collected',TRUE),
                    'flag' => '0',
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );

                // var_dump($data);
                // die();
                $this->Consumables_order_detail_model->updateConsumablesOrderDetail($id, $data);
                $this->session->set_flashdata('message', 'Update Record Success');  
            }

            redirect(site_url("Consumables_order_detail/readConsumablesOrderDetail/".$id_order));
        }

    /**
     * Deletes a consumables new order record from the database.
     *
     * @param int $id The ID of the record to delete.
     * @return void
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

    /**
     * Deletes a consumables order detail record from the database.
     *
     * @param int $id The ID of the record to delete.
     * @return void
     */
        public function deleteConsumablesOrderDetail($id)
        {
            $row = $this->Consumables_order_detail_model->getById($id);
            if ($row) {
                $idParent = $row->new_order_id;
                // var_dump($idParent);
                // die();
                $this->Consumables_order_detail_model->destroyConsumablesOrderDetail($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url("Consumables_order_detail/readConsumablesOrderDetail/".$idParent));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url("Consumables_order_detail/readConsumablesOrderDetail/".$idParent));
            }
        }


        public function readConsumablesOrderDetail($id)
        {
            // $data['testing_type'] = $this->Water_sample_reception_model->getTest();
            $row = $this->Consumables_order_detail_model->get_detail($id);
            if ($row) {
                $data = array(
                    'id_neworder' => $row->id_neworder,
                    'product_id' => $row->product_id,
                    'product_name' => $row->product_name,
                    'quantity_ordering' => $row->quantity_ordering,
                    'unit_ordering' => $row->unit_ordering,
                    'quantity_per_unit' => $row->quantity_per_unit,
                    'total_quantity_ordered' => $row->total_quantity_ordered,
                    'unit_of_measure' => $row->unit_of_measure,
                    'indonesia_comments' => $row->indonesia_comments,
                    'melbourne_comments' => $row->melbourne_comments,
                    'order_decision' => $row->order_decision,
                    );
                    // var_dump($data);S
                    // die();
                    $this->template->load('template','Consumables_order_detail/index', $data);
            }
            else {
                // $this->template->load('template','Water_sample_reception/index_det');
            }
        }
    }
?>

