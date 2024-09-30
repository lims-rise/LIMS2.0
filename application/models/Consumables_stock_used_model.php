<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Consumables_stock_used_model extends CI_Model
    {

        public $table = 'consumables_stock';
        public $id = 'id_stock';
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
            // $this->datatables->select('consumables_stock.id_stockused, consumables_stock.product_id, consumables_products.product_name,
            //     consumables_stock.quantity, consumables_stock.unit, consumables_stock.n_campaigns, consumables_stock.comments,
            //     consumables_stock.minimum_stock, consumables_stock.date_collected, consumables_stock.time_collected
            // ');
            $this->datatables->select('consumables_stock.id_stock, consumables_stock.product_name,
            consumables_stock.quantity, consumables_stock.unit, consumables_stock.quantity_per_unit, consumables_stock.unit_of_measure, consumables_stock.comments, consumables_stock.item_description,
            consumables_stock.minimum_stock, consumables_stock.date_collected, consumables_stock.date_created, consumables_stock.date_updated, GREATEST(consumables_stock.date_created, consumables_stock.date_updated) AS latest_date
        ');
            $this->datatables->from('consumables_stock');
            // $this->datatables->join('consumables_products', 'consumables_stock.product_id = consumables_products.id', 'right');
            $this->datatables->where('lab', $this->session->userdata('lab'));
            $this->datatables->where('consumables_stock.flag', '0');

            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 7){
                $this->datatables->add_column('action', '', 'id_stock');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_stock');
            }
            else {
                // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_stock');
            }

            // Order by latest date
            $this->db->order_by('latest_date', 'DESC');

            return $this->datatables->generate();
        }

        /**
         * Retrieves products from the database based on flag condition.
         *
         * @return array Result set of products
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

        // function getProductById($productId)
        // {
        //     $this->db->select('unit_of_measure');
        //     $this->db->where('id', $productId);
        //     $q = $this->db->get('consumables_products');
        //     return $q->row_array();
        // }

    /**
     * Inserts data into the 'consumables_stock_used' table.
     *
     * @param array $data The data to be inserted into the table.
     * @return void
     */
        function insertConsumablesStockUsed($data)
        {
            $this->db->insert('consumables_stock', $data);
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
            $this->db->where($this->id, $id);
            $this->db->update('consumables_stock', $data);
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
            $this->db->delete('consumables_stock');
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
            return $this->db->get('consumables_stock')->row();
        }


        // function checkStockLevelsAndSendNotification()
        // {
        //     log_message('debug', 'Started checking stock levels.');
        //     // Load email library
        //     $this->load->library('email');  
        //     // Get all products
        //     $this->db->select('id_stock, quantity, minimum_stock');
        //     $query = $this->db->get('consumables_stock');
        //     $stockData = $query->result_array();
    
        //     foreach ($stockData as $data) {
        //         $id_stock = $data['id_stock'];
        //         $quantity = $data['quantity'];
        //         $minimumStock = $data['minimum_stock'];
    
        //         // Check if quantity is approaching minimum stock
        //         if ($quantity <= $minimumStock + 10) {
        //             // Get product details
        //             $this->db->select('product_name');
        //             $this->db->where('id_stock', $id_stock);
        //             $productQuery = $this->db->get('consumables_stock');
        //             $product = $productQuery->row_array();
    
        //             // Prepare email
        //             $this->email->from('uhqdev@gmail.com', 'uhqdev');
        //             $this->email->to('ulhaqitcom@gmail.com');
        //             $this->email->subject('Stock Alert: ' . $product['product_name']);
        //             $this->email->message('The stock for product ' . $product['product_name'] . ' is approaching the minimum level. Current quantity: ' . $quantity . ', Minimum stock: ' . $minimumStock . '.' . "\n" . 'Please update the stock levels as soon as possible.');
    
        //             // Send email
        //             if ($this->email->send()) {
        //                echo 'Email sent successfully.';
        //             } else {
        //                 echo 'Error sending email: ' . $this->email->print_debugger();
        //             }
        //         }
        //     }
        //     log_message('debug', 'Finished checking stock levels.');
        // }

        function get_all() {
            $this->db->select('cs.product_name, cs.quantity, cs.unit, cs.quantity_per_unit, cs.unit_of_measure, cs.item_description, cs.comments, cs.date_collected');
            $this->db->from('consumables_stock AS cs');
            $this->db->where('cs.flag', '0');
            $query = $this->db->get();
            return $query->result();
        }
    }
?>