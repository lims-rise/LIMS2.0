<?php

    if (!defined('BASEPATH'))
    exit('No direct script access allowed');

    class Consumables_product_model extends CI_Model
    {

        public $table = 'consumables_products';
        public $id = 'id';
        public $order = 'ASC';

        function __construct()
        {
            parent::__construct();
        }

        function jsonGetProduct()
        {
            $this->datatables->select('consumables_products.id, consumables_products.product_name,
            consumables_products.unit_of_measure, consumables_products.quantity, consumables_products.units, consumables_products.item_description, consumables_products.date_collected, 
            consumables_products.time_collected, consumables_products.flag');
            $this->datatables->from('consumables_products');
            $this->datatables->where('consumables_products.flag', '0');

            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 7){
                $this->datatables->add_column('action', '', 'id');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id');
            }
            else {
                // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".anchor(site_url('consumables_product/deleteConsumablesProduct/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id');
            }
            return $this->datatables->generate();
        }


        function getAllConsumablesProduct()
        {
            $response = array();
            $this->db->select('*');
            $this->db->where('flag', '0');  // Assuming flag is a string, otherwise use 0 without quotes
            $q = $this->db->get('consumables_products');
            $response = $q->result_array();
        
            return $response;
        }

        function insertConsumablesProduct($data)
        {
            $this->db->insert('consumables_products', $data);
        }

        function updateConsumablesProduct($id, $data) 
        {
            $this->db->where($this->id, $id);
            $this->db->update('consumables_products', $data);
        }

        function destroyConsumablesProduct($id)
        {
            $this->db->where($this->id, $id);
            $this->db->delete('consumables_products');
        }

        function getById($id)
        {
            $this->db->where($this->id, $id);
            $this->db->where('flag', '0');
            return $this->db->get('consumables_products')->row();
        }


        
    }

?>