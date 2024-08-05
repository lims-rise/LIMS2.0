<?php

    if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Consumables_in_stock_model extends CI_Model
    {

        public $table = 'consumables_in_stock';
        public $id = 'id_instock';
        public $order = 'ASC';

        /**
         * Constructor for Consumables_in_stock_model class.
         */
        function __construct()
        {
            parent::__construct();
        }

        /**
         * Retrieves data for displaying consumables in stock in JSON format.
         *
         * @return string The JSON data for consumables in stock.
         */
        function jsonGetInStock() 
        {
            $this->datatables->select('consumables_in_stock.id_instock, consumables_in_stock.product_id, consumables_products.product_name, consumables_in_stock.closed_container,
            consumables_in_stock.unit_measure_lab, consumables_in_stock.quantity_per_unit, consumables_in_stock.loose_items,
            consumables_in_stock.total_quantity, consumables_in_stock.unit_of_measure, consumables_in_stock.expired_date,
            consumables_in_stock.indonesia_comments, consumables_in_stock.melbourne_comments, consumables_in_stock.date_collected, consumables_in_stock.time_collected');
            $this->datatables->from('consumables_in_stock');
            $this->datatables->join('consumables_products', 'consumables_in_stock.product_id = consumables_products.id', 'right');
            $this->datatables->where('consumables_in_stock.flag', '0');

            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 7){
                $this->datatables->add_column('action', '', 'id_instock');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_instock');
            }
            else {
                // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".anchor(site_url('consumables_in_stock/deleteConsumablesInStock/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_instock');
            }
            return $this->datatables->generate();
        }


        /**
         * Retrieves all consumables in stock from the database.
         *
         * @return array Data of all consumables in stock
         */
        function getAllConsumablesInStock()
        {
            $response = array();
            $this->db->select('*');
            $this->db->where('flag', '0');  // Assuming flag is a string, otherwise use 0 without quotes
            $q = $this->db->get('consumables_in_stock');
            $response = $q->result_array();
        
            return $response;
        }

        /**
         * Retrieves product information from the database.
         *
         * @return array Data of all products
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
            $this->db->select('unit_of_measure'); // Ubah sesuai dengan nama kolom yang relevan
            $this->db->where('id', $productId);
            $q = $this->db->get('consumables_products');
            return $q->row_array(); // Mengembalikan hasil sebagai array
        }

    /**
     * Inserts data into the "consumables_in_stock" table.
     *
     * @param array $data The data to be inserted.
     * @return void
     */
        // function insertConsumablesInStock($data)
        // {
        //     $this->db->insert('consumables_in_stock', $data);
        // }

        function insertConsumablesInStock($data)
        {
            // insert into rhe consumables_in_stock table
            $this->db->trans_start();  // Starting Transaction
            $this->db->insert('consumables_in_stock', $data);
            $id_instock = $this->db->insert_id();

            // update product quantity
            $product_id = $data['product_id'];
            $closed_container_subs = $data['closed_container'];

            $this->db->set('quantity', 'quantity - ' . (int)$closed_container_subs, FALSE);
            $this->db->where('product_id', $product_id);
            $this->db->update('consumables_stock_used');
            $this->db->trans_complete();  // Completing transaction

            return $this->db->trans_status(); // Return true if the transaction succeeded
        }

        /**
         * Updates consumables in stock based on the provided ID and data.
         *
         * @param datatype $id The ID of the consumable to update.
         * @param datatype $data The data to update the consumable with.
         * @return void
         */
        // function updatetConsumablesInStock($id, $data)
        // {
        //     $this->db->where($this->id, $id);
        //     $this->db->update('consumables_in_stock', $data);
        // }

        function updatetConsumablesInStock($id, $data)
        {
            $this->db->trans_start(); // Starting Transaction

            // Get previous stock data
            $this->db->where('id_instock', $id);
            $old_stock = $this->db->get('consumables_in_stock')->row();

            if($old_stock) {
                // calculate difference
                $old_closed_container_subs = $old_stock->closed_container;
                $new_closed_container_subs = $data['closed_container'];
                $closed_container_diff = $new_closed_container_subs - $old_closed_container_subs;
                // var_dump($quantity_diff);
                // die();

                // update stock in consumables_in_stock table
                $this->db->where('id_instock', $id);
                $this->db->update('consumables_in_stock', $data);

                // update product quantity
                $product_id = $data['product_id'];
                $this->db->set('quantity', 'quantity - ' . (int)$closed_container_diff, FALSE);
                $this->db->where('product_id', $product_id);
                $this->db->update('consumables_stock_used');
            }

            // if ($old_stock) {
            //     // Calculate difference for old product
            //     $old_product_id = $old_stock->product_id;
            //     $old_total_quantity = $old_stock->total_quantity;
            //     $new_total_quantity = $data['total_quantity'];
            //     $quantity_diff = $new_total_quantity - $old_total_quantity;
    
            //     // Update stock in in_stock table
            //     $this->db->where('id_instock', $id);
            //     $this->db->update('consumables_in_stock', $data);
    
            //     // Adjust old product quantity
            //     $this->db->set('quantity', 'quantity + ' . (int)$old_total_quantity, FALSE);
            //     $this->db->where('id', $old_product_id);
            //     $this->db->update('consumables_products');
    
            //     // Adjust new product quantity
            //     $new_product_id = $data['product_id'];
            //     $this->db->set('quantity', 'quantity + ' . (int)$quantity_diff, FALSE);
            //     $this->db->where('id', $new_product_id);
            //     $this->db->update('consumables_products');
            // }

            $this->db->trans_complete(); // Completing transaction
            return $this->db->trans_status(); // Return true if the transaction succeeded
        }

    /**
     * Deletes a record from the "consumables_in_stock" table based on the provided ID.
     *
     * @param int $id The ID of the record to be deleted.
     * @return void
     */
        // function destroyConsumablesInStock($id)
        // {
        //     $this->db->where($this->id, $id);
        //     $this->db->delete('consumables_in_stock');
        // }

        function destroyConsumablesInStock($id)
        {
            $this->db->trans_start(); // Start transaction

            // Get stock data
            $this->db->where('id_instock', $id);
            $stock = $this->db->get('consumables_in_stock')->row();
    
            if ($stock) {
                // Calculate quantity to be reduced
                $closed_container_to_remove = $stock->closed_container;
    
                // Delete from in_stock table
                $this->db->where('id_instock', $id);
                $this->db->delete('consumables_in_stock');
    
                // Update product quantity
                $product_id = $stock->product_id;
                $this->db->set('quantity', 'quantity + ' . (int)$closed_container_to_remove, FALSE);
                $this->db->where('product_id', $product_id);
                $this->db->update('consumables_stock_used');
            }
    
            $this->db->trans_complete(); // Complete transaction
    
            return $this->db->trans_status(); // Return TRUE if transaction successful, FALSE otherwise
        }

        /**
         * Retrieves a record from the "consumables_in_stock" table based on the provided ID.
         *
         * @param datatype $id The ID of the record to retrieve.
         * @throws Exception if the record is not found.
         * @return object The retrieved record.
         */
        function getById($id)
        {
            $this->db->where($this->id, $id);
            $this->db->where('flag', '0');
            return $this->db->get('consumables_in_stock')->row();
        }

        
    }

?>