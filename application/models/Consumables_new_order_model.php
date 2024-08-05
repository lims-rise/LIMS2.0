<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Consumables_new_order_model extends CI_Model
    {

        public $table = 'consumables_new_order';
        public $id = 'id_neworder';
        public $order = 'ASC';

        /**
         * Constructor for the Consumables_new_order_model class.
         */
        function __construct()
        {
            parent::__construct();
        }

    /**
     * Retrieves all products from the `consumables_products` table.
     *
     * @return array An array of products.
     */
        // function getProduct()
        // {
        //     $response = array();
        //     $this->db->select('*');
        //     $this->db->where('flag', '0');
        //     $q = $this->db->get('consumables_products');
        //     $response = $q->result_array();
        //     return $response;
        // }

        // function getInStock()
        // {
        //     $response = array();
        //     $this->db->select('co.id_instock, co.product_id, cp.product_name, cp.unit_of_measure');
        //     $this->db->from('consumables_in_stock co');
        //     $this->db->join('consumables_products cp', 'co.product_id = cp.id', 'right');
        //     $this->db->where('co.flag', '0');
        //     $q = $this->db->get();
        //     $response = $q->result_array();
        //     return $response;
        // }

        function getInStock()
        {
            $this->db->select('co.id_instock, co.product_id, cp.product_name, cp.unit_of_measure');
            $this->db->from('consumables_in_stock co');
            $this->db->join('consumables_products cp', 'co.product_id = cp.id', 'left');
            $this->db->where('co.flag', '0');
            $this->db->where('co.id_instock NOT IN (SELECT stock_id FROM consumables_new_order)');
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array(); // Return an empty array if no results found
            }
        }
        function getProduct()
        {
            $response = array();
            $this->db->select('*');
            $this->db->where('flag', '0');
            $q = $this->db->get('consumables_products');
            $response = $q->result_array();
            return $response;
        }


    /**
     * Retrieves new orders from the `consumables_new_order` table and joins it with the `consumables_products` table.
     *
     * @return string The generated datatables JSON response.
     */
        // function jsonGetNewOrder()
        // {
        //     $this->datatables->select('consumables_new_order.id_neworder, consumables_new_order.product_id, consumables_products.product_name,
        //     consumables_new_order.quantity_ordering, consumables_new_order.unit_ordering, consumables_new_order.quantity_per_unit,
        //     consumables_new_order.total_quantity_ordered, consumables_new_order.unit_of_measure, consumables_new_order.vendor,
        //     consumables_new_order.indonesia_comments, consumables_new_order.melbourne_comments, consumables_new_order.order_decision,
        //     consumables_new_order.date_collected, consumables_new_order.time_collected
        //     ');
        //     $this->datatables->from('consumables_new_order');
        //     $this->datatables->join('consumables_products', 'consumables_new_order.product_id = consumables_products.id', 'right');
        //     $this->datatables->where('consumables_new_order.flag', '0');

        //     $lvl = $this->session->userdata('id_user_level');
        //     if ($lvl == 7){
        //         $this->datatables->add_column('action', '', 'id_neworder');
        //     }
        //     else if (($lvl == 2) | ($lvl == 3)){
        //         $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_neworder');
        //     }
        //     else {
        //         // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        //         $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
        //             ".anchor(site_url('consumables_new_order/deleteConsumablesNewOrder/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_neworder');
        //     }
        //     return $this->datatables->generate();
        // }

        function jsonGetNewOrder()
        {
            $this->datatables->select('consumables_new_order.id_neworder,  consumables_new_order.product_id, consumables_products.product_name,
            consumables_new_order.quantity_ordering, consumables_new_order.unit_ordering, consumables_new_order.quantity_per_unit,
            consumables_new_order.total_quantity_ordered, consumables_new_order.unit_of_measure, consumables_new_order.vendor,
            consumables_new_order.indonesia_comments, consumables_new_order.melbourne_comments, consumables_new_order.order_decision,
            consumables_new_order.date_collected, consumables_new_order.time_collected
            ');
            $this->datatables->from('consumables_new_order');
            // $this->datatables->join('consumables_in_stock', 'consumables_new_order.product_id = consumables_in_stock.id_instock', 'left');
            $this->datatables->join('consumables_products', 'consumables_new_order.product_id = consumables_products.id', 'left');
            $this->datatables->where('consumables_new_order.flag', '0');

            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 7){
                $this->datatables->add_column('action', '', 'id_neworder');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_neworder');
            }
            // else {
            //     // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
            //     $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
            //         ".anchor(site_url('consumables_new_order/deleteConsumablesNewOrder/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_neworder');
            // }
            else {
                $this->datatables->add_column('action', anchor(site_url('consumables_order_detail/readConsumablesOrderDetail/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')) ."
                    ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                    ".anchor(site_url('consumables_new_order/deleteConsumablesNewOrder/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting project ID : $1 ?\')"'), 'id_neworder');

                    // $this->datatables->add_column('action','<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                    // ".anchor(site_url('consumables_new_order/deleteConsumablesNewOrder/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting project ID : $1 ?\')"'), 'id_neworder');
            }
            return $this->datatables->generate();
        }

    /**
     * Inserts data into the 'consumables_new_order' table.
     *
     * @param array $data The data to be inserted into the table.
     * @throws Exception If there is an error inserting the data.
     * @return void
     */
        // function insertConsumablesNewOrder($data)
        // {
        //     $this->db->insert('consumables_new_order', $data);
        // }
        function insertConsumablesNewOrder($data)
        {
            $this->db->trans_start(); // Start transaction
            
            // Check if the product is already ordered
            $this->db->where('product_id', $data['product_id']);
            $query = $this->db->get('consumables_new_order');
            $result = $query->row_array();
            
            // If the product is already ordered, delete the existing order
            if ($result) {
                $this->db->where('product_id', $data['product_id']);
                $this->db->delete('consumables_new_order');
            }
            
            // Insert the new order
            $this->db->insert($this->table, $data);
            $id_neworder = $this->db->insert_id();
            
            $this->db->trans_complete(); // Complete transaction
            
            if ($this->db->trans_status() === FALSE) {
                // Handle transaction failure
                return false;
            }
            
            return $id_neworder;
        }


        // function updateQtyProduct($id,$data1)
        // {
        
        //     $data_sebelumnya = $this->db->select('consumables_products')->row();
        //     $this->db->where('id', $id);
        //     $data['quantity'] = (int)$data_sebelumnya->quantity + (int)$data1;
        //     // var_dump((int)$data_sebelumnya->quantity + (int)$data1);
        //     // die();
        //     $this->db->update('consumables_products', $data);
        // }

        // function updateQtyProduct($id, $data1)
        // {
        //     $this->db->where('id', $id);
        //     $data_sebelumnya = $this->db->get('consumables_products')->row();

        //     if ($data_sebelumnya) {
        //         $data['quantity'] = (int)$data_sebelumnya->quantity + (int)$data1;
        //         $this->db->update('consumables_products', $data, array('id' => $id));
        //     }
        // }

        /**
         * Updates the consumables new order in the database.
         *
         * @param int $id The ID of the consumables new order.
         * @param array $data The data to be updated.
         */
        function updateConsumablesNewOrder($id, $data)
        {
            $this->db->where($this->id, $id);
            $this->db->update('consumables_new_order', $data);
        }

    /**
     * Deletes a consumables new order from the database.
     *
     * @param int $id The ID of the consumables new order to be deleted.
     * @return void
     */
        function destroyConsumablesNewOrder($id)
        {
            $this->db->where($this->id, $id);
            $this->db->delete('consumables_new_order');
        }

        /**
         * Retrieves a specific consumables new order from the database by ID.
         *
         * @param int $id The ID of the consumables new order to retrieve.
         * @return Row The retrieved consumables new order.
         */
        function getById($id)
        {
            $this->db->where($this->id, $id);
            $this->db->where('flag', '0');
            return $this->db->get('consumables_new_order')->row();
        }

        // function get_detail($id)
        // {
        //   $response = array();
        // //   $this->db->select('*');
        // //   $this->db->join('ref_client', 'sample_reception.client_id=ref_client.client_id', 'left');
        // //   $this->db->where('sample_reception.project_id', $id);
        // //   // $this->db->where('lab', $this->session->userdata('lab'));
        // //   $this->db->where('sample_reception.flag', '0');
        // //   $q = $this->db->get('consumables_new_order');
        // //   $response = $q->row();
        // //   return $response;

        //   $this->db->select('consumables_new_order.id_neworder,  consumables_new_order.stock_id, consumables_products.product_name,
        //   consumables_new_order.quantity_ordering, consumables_new_order.unit_ordering, consumables_new_order.quantity_per_unit,
        //   consumables_new_order.total_quantity_ordered, consumables_new_order.unit_of_measure, consumables_new_order.vendor,
        //   consumables_new_order.indonesia_comments, consumables_new_order.melbourne_comments, consumables_new_order.order_decision,
        //   consumables_new_order.date_collected, consumables_new_order.time_collected
        //   ');
        //   $this->db->from('consumables_new_order');
        //   $this->db->join('consumables_in_stock', 'consumables_new_order.stock_id = consumables_in_stock.id_instock', 'left');
        //   $this->db->join('consumables_products', 'consumables_in_stock.product_id = consumables_products.id', 'left');
        //   $this->db->where('consumables_new_order.flag', '0');
        //   $q = $this->db->get('consumables_new_order');
        //   $response = $q->row();
        //   return $response;
        // }

        // function get_detail($id)
        // {
        //     $response = array();

        //     $this->db->select('new_order.id_neworder, new_order.stock_id, product.product_name,
        //         new_order.quantity_ordering, new_order.unit_ordering, new_order.quantity_per_unit,
        //         new_order.total_quantity_ordered, new_order.unit_of_measure, new_order.vendor,
        //         new_order.indonesia_comments, new_order.melbourne_comments, new_order.order_decision,
        //         new_order.date_collected, new_order.time_collected
        //     ');
        //     $this->db->from('consumables_new_order as new_order');
        //     $this->db->join('consumables_in_stock as instock', 'new_order.stock_id = instock.id_instock', 'left');
        //     $this->db->join('consumables_products as product', 'instock.product_id = product.id', 'left');
        //     $this->db->where('new_order.id_neworder', $id);
        //     $this->db->where('new_order.flag', '0');
        //     $q = $this->db->get();
        //     $response = $q->row();
        //     return $response;
        // }
    }
?>