<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Consumables_order_detail_model extends CI_Model
    {

        public $table = 'consumables_order_detail';
        public $id = 'id_orderdetail';
        public $order = 'ASC';

        /**
         * Constructor method.
         */
        function __construct()
        {
            parent::__construct();
        }

        /**
         * Retrieves product information from the database.
         *
         * @return array Product information
         */
        // function getProduct()
        // {
        //     $response = array();
        //     $this->db->select('co.id_neworder,co.stock_id, cp.product_name');
        //     $this->db->from('consumables_new_order co');
        //     $this->db->join('consumables_products cp', 'co.stock_id = cp.id', 'right');
        //     $this->db->where('co.flag', '0');
        //     $q = $this->db->get();
        //     $response = $q->result_array();
        //     return $response;
        // }

        function getProduct()
        {
            $response = array();
            $this->db->select('co.id_neworder,co.stock_id, cp.product_name');
            $this->db->from('consumables_new_order co');
            $this->db->join('consumables_in_stock cs', 'co.stock_id = cs.id_instock', 'right');
            $this->db->join('consumables_products cp', 'cs.product_id = cp.id', 'right');
            $this->db->where('co.flag', '0');
            $q = $this->db->get();
            $response = $q->result_array();
            return $response;
        }

    /**
     * Retrieves order detail information from the database and generates a JSON response.
     *
     * @return string JSON-encoded response containing order detail information
     */
        function jsonGetOrderDetail($id2)
        {
            $this->datatables->select('consumables_order_detail.id_orderdetail, consumables_order_detail.new_order_id, consumables_products.product_name, consumables_order_detail.order_number, consumables_order_detail.ordered, consumables_order_detail.received, consumables_order_detail.amount_received, consumables_order_detail.unit_reference, consumables_order_detail.date_received, consumables_order_detail.contact_supplier_progress, consumables_order_detail.progress, consumables_order_detail.date_collected, consumables_order_detail.time_collected');
            $this->datatables->from('consumables_order_detail');
            $this->datatables->join('consumables_new_order', 'consumables_order_detail.new_order_id = consumables_new_order.id_neworder', 'left');
            // $this->datatables->join('consumables_in_stock', 'consumables_new_order.stock_id = consumables_in_stock.id_instock', 'left');
            $this->datatables->join('consumables_products', 'consumables_new_order.product_id = consumables_products.id', 'left');
            $this->datatables->where('consumables_order_detail.new_order_id', $id2);
            $this->datatables->where('consumables_order_detail.flag', '0');
            
            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 7){
                $this->datatables->add_column('action', '', 'id_orderdetail');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_orderdetail');
            } else {
                // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".anchor(site_url('consumables_order_detail/deleteConsumablesOrderDetail/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_orderdetail');
            }
            
            return $this->datatables->generate();
        }

        /**
         * Inserts data into the 'consumables_order_detail' table.
         *
         * @param datatype $data The data to be inserted into the table.
         * @throws Some_Exception_Class description of exception
         * @return Some_Return_Value
         */
        function insertConsumablesOrderDetail($data)
        {
            $this->db->insert('consumables_order_detail', $data);
        }

    /**
     * Updates a record in the 'consumables_order_detail' table.
     *
     * @param int $id The ID of the record to update.
     * @param array $data The data to update the record with.
     * @throws None
     * @return void
     */
        function updateConsumablesOrderDetail($id, $data)
        {
            $this->db->where($this->id, $id);
            $this->db->update('consumables_order_detail', $data);
        }

        /**
         * Retrieves a record from the 'consumables_order_detail' table based on the provided ID.
         *
         * @param datatype $id description
         * @throws Some_Exception_Class description of exception
         * @return Some_Return_Value
         */
        function getById($id)
        {
            $this->db->where($this->id, $id);
            $this->db->where('flag', '0');
            return $this->db->get('consumables_order_detail')->row();
        }

    /**
     * Deletes a record from the 'consumables_order_detail' table based on the provided ID.
     *
     * @param int $id The ID of the record to delete.
     * @throws None
     * @return void
     */
        function destroyConsumablesOrderDetail($id)
        {
            $this->db->where($this->id, $id);
            $this->db->delete('consumables_order_detail');
        }

        function get_detail($id)
        {
        $response = array();

        $this->db->select('new_order.id_neworder, new_order.product_id, product.product_name,
            new_order.quantity_ordering, new_order.unit_ordering, new_order.quantity_per_unit,
            new_order.total_quantity_ordered, new_order.unit_of_measure, new_order.vendor,
            new_order.indonesia_comments, new_order.melbourne_comments, new_order.order_decision,
            new_order.date_collected, new_order.time_collected
        ');
        $this->db->from('consumables_new_order as new_order');
        // $this->db->join('consumables_in_stock as instock', 'new_order.stock_id = instock.id_instock', 'left');
        $this->db->join('consumables_products as product', 'new_order.product_id = product.id', 'left');
        $this->db->where('new_order.id_neworder', $id);
        $this->db->where('new_order.flag', '0');
        $q = $this->db->get();
        $response = $q->row();
        return $response;
        }
    }

?>