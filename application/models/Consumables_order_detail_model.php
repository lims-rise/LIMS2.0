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
            $this->datatables->select('order_detail.id_orderdetail, order_detail.id_order, stock.product_name, order_detail.name_received,
            order_detail.received, order_detail.amount_received, 
            order_detail.unit_reference, order_detail.date_received, order_detail.time_received, order_detail.contact_supplier_progress, order_detail.comments');
            $this->datatables->from('consumables_order_detail as order_detail');
            $this->datatables->join('consumables_order as order', 'order_detail.id_order = order.id_order', 'left');
            // $this->datatables->join('consumables_in_stock', 'consumables_new_order.stock_id = consumables_in_stock.id_instock', 'left');
            $this->datatables->join('consumables_stock as stock', 'order.id_stock = stock.id_stock', 'left');
            $this->datatables->where('order_detail.id_order', $id2);
            $this->datatables->where('order_detail.flag', '0');
            // $this->datatables->where('order_detail.lab', $this->session->userdata('lab'));
            // $this->datatables->where('stock.lab', $this->session->userdata('lab'));
            
            $lvl = $this->session->userdata('id_user_level');
            if ($lvl == 7){
                $this->datatables->add_column('action', '', 'id_orderdetail');
            }
            else if (($lvl == 2) | ($lvl == 3)){
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_orderdetail');
            } else {
                // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
                $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_orderdetail');
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

            // // insert into rhe consumables_in_stock table
            // $this->db->trans_start();  // Starting Transaction
            // $this->db->insert('consumables_in_stock', $data);
            // $id_instock = $this->db->insert_id();

            // // update product quantity
            // $id_stock = $data['id_stock'];
            // $closed_container_subs = $data['closed_container'];

            // $this->db->set('quantity', 'quantity + ' . (int)$closed_container_subs, FALSE);
            // $this->db->where('id_stock', $id_stock);
            // $this->db->update('consumables_stock');
            // $this->db->trans_complete();  // Completing transaction

            // return $this->db->trans_status(); // Return true if the transaction succeeded

        // Fungsi untuk mendapatkan id_stock terbaru berdasarkan lab yang aktif
        public function get_latest_id_orderdetail() {
            // Ambil lab dari session
            $lab = $this->session->userdata('lab');
            
            // Tentukan prefix berdasarkan lab
            $prefix = ($lab == 1) ? 'N-OD-' : 'F-OD-';  // ID-STOCK untuk Indonesia, FJ-STOCK untuk Fiji

            // Pilih id_stock terakhir berdasarkan lab
            $this->db->select('id_orderdetail');
            $this->db->like('id_orderdetail', $prefix); // Gunakan LIKE untuk mencocokkan id_stock dengan prefix yang sesuai
            $this->db->order_by('id_orderdetail', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get('consumables_order_detail');

            // Cek jika ada id_stock sebelumnya
            if ($query->num_rows() > 0) {
                return $query->row()->id_orderdetail;
            } else {
                return null;
            }
        }

        // Fungsi untuk menghasilkan id_stock berikutnya berdasarkan lab yang aktif
        public function generate_id_orderdetail() {
            // Ambil lab dari session untuk menentukan prefix
            $lab = $this->session->userdata('lab');
            
            // Tentukan prefix berdasarkan lab
            $prefix = ($lab == 1) ? 'N-OD-' : 'F-OD-'; // ID-STOCK untuk Indonesia, FJ-STOCK untuk Fiji

            // Ambil id_stock terakhir yang sudah ada berdasarkan lab dan prefix
            $latest_id = $this->get_latest_id_orderdetail();

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


        function insertConsumablesOrderDetail($data)
        {
            $data['id_orderdetail'] = $this->generate_id_orderdetail();
            $this->db->trans_start();
            $this->db->insert('consumables_order_detail', $data);
            $id_orderDetail = $this->db->insert_id();

            // $q = $this->db->get('consumables_order_detail');
            // $data1 = $q->row_array();
            // $quantity_per_unit = $data1['amount_received'];

            //update consumables quantity
            // $q = $this->db->get('consumables_order');
            // $data1 = $q->row_array();
            // $quantity_per_unit = $data1['quantity_per_unit'];

            // $q1 = $this->db->get('consumables_in_stock');
            // $data2 = $q1->row_array();
            // $total_quantity = $data2['total_quantity'];
            // var_dump($total_quantity);
            // die();

            // $this->db->select('*');
            // $this->db->from('consumables_order_detail');
            // $this->db->join('consumables_order', 'consumables_order_detail.id_order = consumables_order.id_order', 'left');
            // $this->db->where('consumables_order_detail.id_order', $data['id_order']);
            // $this->db->where('consumables_order_detail.flag', '0');
            // $q2 = $this->db->get();
            // $data3 = $q2->result_array();
            // $id_orderDetail = $data3[0]['id_stock'];
            // var_dump($id_orderDetail);
            // die();
            $this->db->select('*');
            $this->db->from('consumables_order_detail');
            $this->db->join('consumables_order', 'consumables_order_detail.id_order = consumables_order.id_order', 'left');
            $this->db->join('consumables_stock', 'consumables_stock.id_stock = consumables_order.id_stock', 'left');
            $this->db->where('consumables_order_detail.id_order', $data['id_order']);
            $this->db->where('consumables_order_detail.flag', '0');
            $q2 = $this->db->get();
            $data3 = $q2->result_array();
            $id_stock = $data3[0]['id_stock'];
            // var_dump($id_orderDetail);
            // die();

            // $amount_received_subs = $data['amount_received'];
            $amount_received = $data['amount_received'];
            // $test = ((int)$total_quantity + ((int)$amount_received_subs * (int)$quantity_per_unit));
            // var_dump($amount_received);
            // die();
            // $this->db->set('quantity', 'quantity + ' . ((int)$total_quantity + ((int)$amount_received_subs * (int)$quantity_per_unit)), FALSE);
            $this->db->set('quantity', 'quantity + ' . ((int)$amount_received), FALSE);
            $this->db->where('id_stock', $id_stock);
            $this->db->update('consumables_stock');
            $this->db->trans_complete();

            return $this->db->trans_status();

        }

    /**
     * Updates a record in the 'consumables_order_detail' table.
     *
     * @param int $id The ID of the record to update.
     * @param array $data The data to update the record with.
     * @throws None
     * @return void
     */
        // function updateConsumablesOrderDetail($id, $data)
        // {
        //     $this->db->where($this->id, $id);
        //     $this->db->update('consumables_order_detail', $data);
        // }

        function updateConsumablesOrderDetail($id, $data)
        {
            // var_dump($id);
            // die();
            $this->db->trans_start(); // Starting Transaction

            // Get previous order detail data
            $this->db->where('id_orderdetail', $id);
            $old_order_detail = $this->db->get('consumables_order_detail')->row();
            // var_dump($old_order_detail);
            // die();
            if ($old_order_detail) {
                // Calculate difference in quantity
                $old_amount_received = $old_order_detail->amount_received;
                $new_amount_received = $data['amount_received'];

                $amount_received_diff = $new_amount_received - $old_amount_received;
       
                // Update order detail
                $this->db->where('id_orderdetail', $id);
                $this->db->update('consumables_order_detail', $data);

                // Get additional details for updating consumables stock
                // $this->db->where('id_order', $data['id_order']);
                // $order = $this->db->get('consumables_order')->row_array();
                // $quantity_per_unit = $order['quantity_per_unit'];

                
                // var_dump($total_quantity);
                // die();

                // $this->db->select('*');
                // $this->db->from('consumables_order_detail');
                // $this->db->join('consumables_order', 'consumables_order_detail.id_order = consumables_order.id_order', 'left');
                // $this->db->where('consumables_order_detail.id_order', $data['id_order']);
                // $this->db->where('consumables_order_detail.flag', '0');
                // $q2 = $this->db->get();
                // $data3 = $q2->result_array();
                // $id_orderDetail = $data3[0]['id_stock'];

                $this->db->select('*');
                $this->db->from('consumables_order_detail');
                $this->db->join('consumables_order', 'consumables_order_detail.id_order = consumables_order.id_order', 'left');
                $this->db->where('consumables_order_detail.id_order', $data['id_order']);
                $this->db->where('consumables_order_detail.flag', '0');
                $q2 = $this->db->get();
                $data3 = $q2->result_array();
                $id_stock = $data3[0]['id_stock'];

                // $test = ((int)$amount_received_diff * (int)$quantity_per_unit);
                // var_dump($test);
                // die();

                // $this->db->set('quantity', 'quantity + ' . ((int)$amount_received_diff * (int)$quantity_per_unit), FALSE);
                $this->db->set('quantity', 'quantity + ' . ((int)$amount_received_diff), FALSE);
                $this->db->where('id_stock', $id_stock);
                $this->db->update('consumables_stock');
            }

            $this->db->trans_complete(); // Completing Transaction

            return $this->db->trans_status(); // Return true if the transaction succeeded
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
        // function destroyConsumablesOrderDetail($id)
        // {
        //     $this->db->where($this->id, $id);
        //     $this->db->delete('consumables_order_detail');
        // }

        function destroyConsumablesOrderDetail($id)
        {
            $this->db->trans_start(); // Start transaction

            // Get order detail data
            $this->db->where('id_orderdetail', $id);
            $order_detail = $this->db->get('consumables_order_detail')->row();

            if ($order_detail) {
                // Calculate quantity to be reduced
                $amount_received = $order_detail->amount_received;
                // var_dump($amount_received);
                // die();

                // Get associated order data
                // $this->db->where('id_order', $order_detail->id_order);
                // $order = $this->db->get('consumables_order')->row();
                // $quantity_per_unit = $order->quantity_per_unit;

                // $q1 = $this->db->get('consumables_in_stock');
                // $data2 = $q1->row_array();
                // $total_quantity = $data2['total_quantity'];


                // Calculate quantity to be adjusted in consumables stock
                // $quantity_to_adjust = ($total_quantity + ($amount_received * $quantity_per_unit));
                // var_dump($quantity_to_adjust);
                // die();

                // Get stock ID from order detail
                $this->db->select('*');
                $this->db->from('consumables_order_detail');
                $this->db->join('consumables_order', 'consumables_order_detail.id_order = consumables_order.id_order', 'left');
                $this->db->where('consumables_order_detail.id_orderdetail', $id);
                $this->db->where('consumables_order_detail.flag', '0');
                $q2 = $this->db->get();
                $data3 = $q2->result_array();
                $id_stock = $data3[0]['id_stock'];
                // var_dump($id_stock);
                // die();
                // Delete from order detail table
                $this->db->where('id_orderdetail', $id);
                $this->db->delete('consumables_order_detail');

                // Update consumables quantity
                // $this->db->set('quantity', 'quantity - ' . (int)$quantity_to_adjust, FALSE);
                $this->db->set('quantity', 'quantity - ' . (int)$amount_received, FALSE);
                $this->db->where('id_stock', $id_stock);
                $this->db->update('consumables_stock');
            }

            $this->db->trans_complete(); // Complete transaction

            return $this->db->trans_status(); // Return TRUE if transaction successful, FALSE otherwise
        }


        // function get_detail($id)
        // {
        // $response = array();

        //     $this->db->select('order.id_order, order.id_stock, stock.product_name,
        //         order.quantity_ordering, order.unit_ordering, order.quantity_per_unit,
        //         order.total_quantity_ordered, order.unit_of_measure, order.vendor,
        //         order.date_ordered, order.time_ordered
        //     ');
        //     $this->db->from('consumables_order as order');
        //     // $this->db->join('consumables_in_stock as instock', 'new_order.stock_id = instock.id_instock', 'left');
        //     $this->db->join('consumables_stock as stock', 'order.id_stock = stock.id_stock', 'left');
        //     $this->db->where('order.id_order', $id);
        //     $this->db->where('order.flag', '0');
        //     $q = $this->db->get();
        //     $response = $q->row();
        //     return $response;
        // }


        function get_detail($id) {
            $response = array();
            $this->db->select('co.id_order, co.id_stock, cs.product_name, co.quantity_ordering, co.unit_ordering, 
                co.quantity_per_unit, co.total_quantity_ordered, co.unit_of_measure, co.vendor, co.date_ordered, 
                co.time_ordered, COALESCE(SUM(cod.amount_received), 0) AS received, 
                (co.quantity_ordering - COALESCE(SUM(cod.amount_received), 0)) AS remaining_quantity, 
                IF(COALESCE(SUM(cod.amount_received), 0) = co.quantity_ordering, "Completed", "Uncompleted") AS status');
            $this->db->from('consumables_order AS co');
            $this->db->join('consumables_stock AS cs', 'co.id_stock = cs.id_stock', 'left');
            $this->db->join('consumables_order_detail AS cod', 'co.id_order = cod.id_order', 'left');
            $this->db->where('co.id_order', $id);
            $this->db->where('co.flag', '0');
            $this->db->group_by('co.id_order');
            $query = $this->db->get();
            $response =  $query->row();
            return $response;
        }
    }

?>