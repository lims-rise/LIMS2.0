<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');

    class Consumables_new_order_model extends CI_Model
    {

        public $table = 'consumables_order';
        public $id = 'id_order';
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
            $this->db->select('co.id_instock, co.id_stock, cp.product_name, cp.unit');
            $this->db->from('consumables_in_stock co');
            $this->db->join('consumables cp', 'co.id_stock = cp.id_stock', 'left');
            $this->db->where('co.flag', '0');
            $this->db->where('co.id_instock NOT IN (SELECT stock_id FROM consumables_order)');
            
            $query = $this->db->get();
            
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return array(); // Return an empty array if no results found
            }
        }
        function getStock()
        {
            $response = array();
            $this->db->select('*');
            $this->db->where('flag', '0');
            $q = $this->db->get('consumables_stock');
            $response = $q->result_array();
            return $response;
        }

        function getStockById($idStock)
        {
            $this->db->select('unit, unit_of_measure, quantity_per_unit');
            $this->db->where('id_stock', $idStock);
            $q = $this->db->get('consumables_stock');
            return $q->row_array();
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

        function jsonGetOrder()
        {
            $this->datatables->select('consumables_order.id_order, 
                consumables_order.id_stock, 
                consumables_stock.product_name,
                consumables_order.quantity_ordering, 
                consumables_order.unit_ordering, 
                consumables_order.quantity_per_unit,
                consumables_order.total_quantity_ordered, 
                consumables_order.unit_of_measure, 
                consumables_order.vendor,
                consumables_order.date_ordered, 
                consumables_order.time_ordered,
                consumables_order.note,
                COALESCE(SUM(consumables_order_detail.amount_received), 0) AS received,
                (consumables_order.quantity_ordering - COALESCE(SUM(consumables_order_detail.amount_received), 0)) AS remaining_quantity,
                IF(COALESCE(SUM(consumables_order_detail.amount_received), 0) = consumables_order.quantity_ordering, "Completed", "Uncompleted") AS status,
                consumables_order.date_created, consumables_order.date_updated, GREATEST(consumables_order.date_created, consumables_order.date_updated) AS latest_date');
            $this->datatables->from('consumables_order');
            $this->datatables->join('consumables_stock', 'consumables_order.id_stock = consumables_stock.id_stock', 'left');
            $this->datatables->join('consumables_order_detail', 'consumables_order.id_order = consumables_order_detail.id_order', 'left');
            $this->datatables->where('consumables_order.flag', '0');
            $this->datatables->where('consumables_order.lab', $this->session->userdata('lab'));
            $this->datatables->where('consumables_stock.lab', $this->session->userdata('lab'));
            $this->datatables->group_by('consumables_order.id_order');

            // Add column with styling
            $this->datatables->add_column('received', '<div class="container"><button type="button" class="btn-transparent-green">$1</button></div>', 'received');
            $this->datatables->add_column('remaining_quantity', '<div class="container"><button type="button" class="btn-transparent-red">$1</button></div>', 'remaining_quantity');

              // Add column with status styling
              $this->datatables->add_column('status', '
              <div class="container">
                  <button type="button" class="btn-status-$1">$1</button>
              </div>', 'status');

            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 7){
                $this->datatables->add_column('action', '', 'id_order');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', 
                    '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button> ' .
                    anchor(site_url('consumables_order_detail/readConsumablesOrderDetail/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')), 
                    'id_order');
            }
            // else {
            //     // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
            //     $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
            //         ".anchor(site_url('consumables_new_order/deleteConsumablesNewOrder/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_neworder');
            // }
            else {
                $this->datatables->add_column('action', anchor(site_url('consumables_order_detail/readConsumablesOrderDetail/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                    ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                    ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_order');

                    // $this->datatables->add_column('action','<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                    // ".anchor(site_url('consumables_new_order/deleteConsumablesNewOrder/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting project ID : $1 ?\')"'), 'id_order');
            }

            // Order by latest date
            $this->db->order_by('latest_date', 'DESC');

            return $this->datatables->generate();
        }

    /**
     * Inserts data into the 'consumables_new_order' table.
     *
     * @param array $data The data to be inserted into the table.
     * @throws Exception If there is an error inserting the data.
     * @return void
     */

        // Fungsi untuk mendapatkan id_stock terbaru berdasarkan lab yang aktif
        public function get_latest_id_order() {
            // Ambil lab dari session
            $lab = $this->session->userdata('lab');
            
            // Tentukan prefix berdasarkan lab
            $prefix = ($lab == 1) ? 'N-O-' : 'F-O-';  // ID-STOCK untuk Indonesia, FJ-STOCK untuk Fiji

            // Pilih id_stock terakhir berdasarkan lab
            $this->db->select('id_order');
            $this->db->like('id_order', $prefix); // Gunakan LIKE untuk mencocokkan id_stock dengan prefix yang sesuai
            $this->db->order_by('id_order', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get('consumables_order');

            // Cek jika ada id_stock sebelumnya
            if ($query->num_rows() > 0) {
                return $query->row()->id_order;
            } else {
                return null;
            }
        }

        // Fungsi untuk menghasilkan id_stock berikutnya berdasarkan lab yang aktif
        public function generate_id_order() {
            // Ambil lab dari session untuk menentukan prefix
            $lab = $this->session->userdata('lab');
            
            // Tentukan prefix berdasarkan lab
            $prefix = ($lab == 1) ? 'N-O-' : 'F-O-'; // ID-STOCK untuk Indonesia, FJ-STOCK untuk Fiji

            // Ambil id_stock terakhir yang sudah ada berdasarkan lab dan prefix
            $latest_id = $this->get_latest_id_order();

            if ($latest_id) {
                // Jika id_stock sebelumnya ada dan prefix sesuai, ambil nomor urut berikutnya
                if (strpos($latest_id, $prefix) === 0) {
                    $number = intval(substr($latest_id, strlen($prefix))) + 1;
                } else {
                    $number = 1;  // Jika prefix tidak sesuai, mulai dari nomor 1
                }
            } else {
                $number = 1;  // Jika belum ada id_stock, mulai dari nomor 1
            }

            // Format id_stock dengan prefix dan nomor urut
            $new_id = sprintf('%s%05d', $prefix, $number);
            return $new_id;
        }


        function insertConsumablesOrder($data)
        {
            $data['id_order'] = $this->generate_id_order();
            $this->db->insert('consumables_order', $data);
        }
        // function insertConsumablesOrder($data)
        // {
        //     $this->db->trans_start(); // Start transaction
            
        //     // Check if the product is already ordered
        //     $this->db->where('id_stock', $data['id_stock']);
        //     $query = $this->db->get('consumables_order');
        //     $result = $query->row_array();
            
        //     // If the product is already ordered, delete the existing order
        //     if ($result) {
        //         $this->db->where('id_stock', $data['id_stock']);
        //         $this->db->delete('consumables_order');
        //     }
            
        //     // Insert the new order
        //     $this->db->insert($this->table, $data);
        //     $id_order = $this->db->insert_id();
            
        //     $this->db->trans_complete(); // Complete transaction
            
        //     if ($this->db->trans_status() === FALSE) {
        //         // Handle transaction failure
        //         return false;
        //     }
            
        //     return $id_order;
        // }


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
        function updateConsumablesOrder($id, $data)
        {
            $this->db->where($this->id, $id);
            $this->db->update('consumables_order', $data);
        }

    /**
     * Deletes a consumables new order from the database.
     *
     * @param int $id The ID of the consumables new order to be deleted.
     * @return void
     */
        function destroyConsumablesOrder($id)
        {
            $this->db->where($this->id, $id);
            $this->db->delete('consumables_order');
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
            return $this->db->get('consumables_order')->row();
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

        function get_all() {
            $this->db->select('co.id_order, co.id_stock, cs.product_name, co.quantity_ordering, co.unit_ordering, 
                co.quantity_per_unit, co.total_quantity_ordered, co.unit_of_measure, co.vendor, co.date_ordered, 
                co.time_ordered, COALESCE(SUM(cod.amount_received), 0) AS received, 
                (co.quantity_ordering - COALESCE(SUM(cod.amount_received), 0)) AS remaining_quantity, 
                IF(COALESCE(SUM(cod.amount_received), 0) = co.quantity_ordering, "Completed", "Uncompleted") AS status,
                GROUP_CONCAT(cod.name_received SEPARATOR ", ") AS received_by');
            $this->db->from('consumables_order AS co');
            $this->db->join('consumables_stock AS cs', 'co.id_stock = cs.id_stock', 'left');
            $this->db->join('consumables_order_detail AS cod', 'co.id_order = cod.id_order', 'left');
            $this->db->group_by('co.id_order');
            $query = $this->db->get();
            return $query->result();
        }

        function get_received() {
            $this->db->select('cod.name_received, cs.product_name, cod.amount_received, cod.date_received, cod.time_received, cod.contact_supplier_progress, cod.comments');
            $this->db->from('consumables_order_detail AS cod');
            $this->db->join('consumables_order AS co', 'cod.id_order = co.id_order', 'left');
            $this->db->join('consumables_stock AS cs', 'co.id_stock = cs.id_stock', 'left');
            $this->db->where('cod.flag', '0');
            $this->db->group_by('cod.id_orderdetail');
            $query = $this->db->get();
            return $query->result();
        }
    }
?>