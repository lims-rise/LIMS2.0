<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Consumables_stock_used_model extends CI_Model
    {

        public $table = 'consumables_stock_used';
        public $id = 'id_stockused';
        public $order = 'ASC';

        function __construct()
        {
            parent::__construct();
        }

    /**
     * Retrieves stock used data in JSON format.
     *
     * @return mixed The generated JSON data.
     */
        function jsonGetStockUsed()
        {
            $this->datatables->select('consumables_stock_used.id_stockused, consumables_stock_used.product_id, consumables_products.product_name,
                consumables_stock_used.quantity, consumables_stock_used.unit, consumables_stock_used.n_campaigns, consumables_stock_used.comments,
                consumables_stock_used.minimum_stock, consumables_stock_used.date_collected, consumables_stock_used.time_collected
            ');
            $this->datatables->from('consumables_stock_used');
            $this->datatables->join('consumables_products', 'consumables_stock_used.product_id = consumables_products.id', 'right');
            $this->datatables->where('consumables_stock_used.flag', '0');

            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 7){
                $this->datatables->add_column('action', '', 'id_stockused');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_stockused');
            }
            else {
                // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".anchor(site_url('consumables_stock_used/deleteConsumablesStockUsed/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_stockused');
            }
            return $this->datatables->generate();
        }

        /**
         * Retrieves products from the database based on flag condition.
         *
         * @return array Result set of products
         */
        function getProduct()
        {
            $response = array();
            $this->db->select('*');
            $this->db->where('flag', '0');
            $q = $this->db->get('consumables_products');
            $response = $q->result_array();
            return $response;
        }

        function getProductById($productId)
        {
            $this->db->select('unit_of_measure');
            $this->db->where('id', $productId);
            $q = $this->db->get('consumables_products');
            return $q->row_array();
        }

    /**
     * Inserts data into the 'consumables_stock_used' table.
     *
     * @param array $data The data to be inserted into the table.
     * @return void
     */
        function insertConsumablesStockUsed($data)
        {
            $this->db->insert('consumables_stock_used', $data);
        }

        /**
         * Updates the 'consumables_stock_used' table with the provided data.
         *
         * @param datatype $id The ID of the record to update.
         * @param datatype $data The data to update the record with.
         * @return void
         */
        function updateConsumablesStockUsed($id, $data)
        {  
            $this->db->where($id, $id);
            $this->db->update('consumables_stock_used', $data);
        }

        /**
         * Deletes a record from the 'consumables_stock_used' table based on the provided ID.
         *
         * @param datatype $id The ID of the record to be deleted.
         * @throws Some_Exception_Class description of exception
         * @return Some_Return_Value
         */
        function destroyConsumablesSTockUsed($id)
        {
            $this->db->where($this->id, $id);
            $this->db->delete('consumables_stock_used');
        }

    /**
     * Retrieves a record from the 'consumables_stock_used' table based on the provided ID.
     *
     * @param int $id The ID of the record to retrieve.
     * @return stdClass|null The retrieved record, or null if no record is found.
     */
        function getById($id) 
        {
            $this->db->where($this->id, $id);
            $this->db->where('flag', '0');
            return $this->db->get('consumables_stock_used')->row();
        }
    }
?>