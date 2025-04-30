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
            $this->datatables->select('consumables_in_stock.id_instock, consumables_in_stock.id_stock, ref_objective.id_objective, ref_objective.objective, consumables_stock.product_name, consumables_in_stock.closed_container,
            consumables_in_stock.unit_measure_lab, consumables_in_stock.quantity_per_unit, consumables_in_stock.loose_items, consumables_in_stock.quantity_take,
            consumables_in_stock.total_quantity, consumables_in_stock.unit_of_measure, consumables_in_stock.expired_date,
            consumables_in_stock.comments, consumables_in_stock.date_collected, consumables_in_stock.time_collected,  
            consumables_in_stock.date_created, consumables_in_stock.date_updated, GREATEST(consumables_in_stock.date_created, consumables_in_stock.date_updated) AS latest_date');
            $this->datatables->from('consumables_in_stock');
            $this->datatables->join('consumables_stock', 'consumables_in_stock.id_stock = consumables_stock.id_stock', 'left');
            $this->datatables->join('ref_objective', 'consumables_in_stock.id_objective = ref_objective.id_objective', 'left');
            $this->datatables->where('consumables_in_stock.flag', '0');
            // $this->datatables->where('consumables_in_stock.lab', $this->session->userdata('lab'));
            $lab = $this->session->userdata('lab');
            if ($lab) {
                $this->datatables->where('consumables_in_stock.lab', $lab);
                // $this->datatables->where('consumables_stock.lab', $lab);
            }
            // $this->datatables->where('consumables_stock.lab', $this->session->userdata('lab'));
            $this->datatables->add_column('quantity_with_unit', '$1 $2', 'total_quantity,unit_of_measure');

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
                    ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_instock');
            }

            // Order by latest date
            $this->db->order_by('latest_date', 'DESC');

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
        // function getProduct()
        // {
        //     $response = array();
        //     $this->db->select('*');
        //     $this->db->where('flag', '0');
        //     $q = $this->db->get('consumables_products');
        //     $response = $q->result_array();
        //     return $response;
        // }

        function getStock()
        {
            $response = array();
            $this->db->select('*');
            $this->db->where('flag', '0');
            $q = $this->db->get('consumables_stock');
            $response = $q->result_array();
            return $response;
        }

        function getStockQuantity()
        {
            $response = array();
            $this->db->select('quantity');
            $this->db->where('flag', '0');
            $q = $this->db->get('consumables_stock');
            $response = $q->result_array();
            return $response;
        }

        function getStockById($idStock)
        {
            $this->db->select('unit, unit_of_measure, quantity_per_unit, quantity');
            $this->db->where('id_stock', $idStock);
            $q = $this->db->get('consumables_stock');
            return $q->row_array();
        }

        // function getStockByObjective($id_objective)
        // {
        //     $this->db->select('consumables_stock.id_stock, consumables_stock.product_name');
        //     $this->db->join('ref_consumables', 'ref_consumables.id_stock = consumables_stock.id_stock');
        //     $this->db->where('ref_consumables.id_objective', $id_objective);
        //     $q = $this->db->get('consumables_stock');
        //     return $q->result_array();
        // }

        function getStockByObjective($id_objective)
        {
            // Pastikan parameter adalah array dan menggunakan where_in
            $this->db->select('consumables_stock.id_stock, consumables_stock.product_name');
            $this->db->join('ref_consumables', 'consumables_stock.id_stock = ref_consumables.id_stock');
            $this->db->where_in('ref_consumables.id_objective', $id_objective); // Menggunakan where_in
            $this->db->group_by('consumables_stock.product_name');
            $q = $this->db->get('consumables_stock');
            return $q->result_array();
        }
        
        


        function getObjective()
        {
            $this->db->select('id_objective, objective');
            $this->db->where('flag', '0');
            $q = $this->db->get('ref_objective');
            $response = $q->result_array();
            return $response;
        }

        // function getProductById($productId)
        // {
        //     $this->db->select('unit_of_measure'); // Ubah sesuai dengan nama kolom yang relevan
        //     $this->db->where('id', $productId);
        //     $q = $this->db->get('consumables_products');
        //     return $q->row_array(); // Mengembalikan hasil sebagai array
        // }

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

        // Fungsi untuk mendapatkan id_stock terbaru berdasarkan lab yang aktif
        public function get_latest_id_instock() {
            // Ambil lab dari session
            $lab = $this->session->userdata('lab');
            
            // Tentukan prefix berdasarkan lab
            $prefix = ($lab == 1) ? 'N-ST-' : 'F-ST-';  // ID-STOCK untuk Indonesia, FJ-STOCK untuk Fiji

            // Pilih id_stock terakhir berdasarkan lab
            $this->db->select('id_instock');
            $this->db->like('id_instock', $prefix); // Gunakan LIKE untuk mencocokkan id_stock dengan prefix yang sesuai
            $this->db->order_by('id_instock', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get('consumables_in_stock');

            // Cek jika ada id_stock sebelumnya
            if ($query->num_rows() > 0) {
                return $query->row()->id_instock;
            } else {
                return null;
            }
        }

        // Fungsi untuk menghasilkan id_stock berikutnya berdasarkan lab yang aktif
        public function generate_id_instock() {
            // Ambil lab dari session untuk menentukan prefix
            $lab = $this->session->userdata('lab');
            
            // Tentukan prefix berdasarkan lab
            $prefix = ($lab == 1) ? 'N-ST-' : 'F-ST-'; // ID-STOCK untuk Indonesia, FJ-STOCK untuk Fiji

            // Ambil id_stock terakhir yang sudah ada berdasarkan lab dan prefix
            $latest_id = $this->get_latest_id_instock();

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


        function insertConsumablesInStock($data)
        {
            $data['id_instock'] = $this->generate_id_instock();
            // insert into rhe consumables_in_stock table
            $this->db->trans_start();  // Starting Transaction
            $this->db->insert('consumables_in_stock', $data);
            $id_instock = $this->db->insert_id();

            // update product quantity
            // $id_stock = $data['id_stock'];
            // $closed_container_subs = $data['closed_container'];

            // $this->db->set('quantity', 'quantity - ' . (int)$closed_container_subs, FALSE);
            // $this->db->where('id_stock', $id_stock);
            // $this->db->update('consumables_stock');
            $this->db->trans_complete();  // Completing transaction

            return $this->db->trans_status(); // Return true if the transaction succeeded
        }

        function replaceConsumablesStockQuantity($id_stock, $total_closed_container)
        {
            // Mengganti quantity pada tabel consumables_stock
            $this->db->set('quantity', (int)$total_closed_container);
            $this->db->where('id_stock', $id_stock);
            return $this->db->update('consumables_stock');
        }

        function insertConsumablesQuantityTake($id_stock, $quantity_take)
        {
            // Ambil nilai quantity_take yang sudah ada di tabel consumables_stock
            $this->db->select('quantity_take');
            $this->db->where('id_stock', $id_stock);
            $existing_quantity_take = $this->db->get('consumables_stock')->row()->quantity_take;
        
            // Tambahkan nilai quantity_take baru ke nilai yang sudah ada
            $new_quantity_take = $existing_quantity_take + (int)$quantity_take;
        
            // Update tabel consumables_stock dengan jumlah baru
            $this->db->set('quantity_take', $new_quantity_take);
            $this->db->where('id_stock', $id_stock);
            return $this->db->update('consumables_stock');
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
                $id_stock = $data['id_stock'];
                $this->db->set('quantity', 'quantity - ' . (int)$closed_container_diff, FALSE);
                $this->db->where('id_stock', $id_stock);
                $this->db->update('consumables_stock');
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
                $id_stock = $stock->id_stock;
                $this->db->set('quantity', 'quantity + ' . (int)$closed_container_to_remove, FALSE);
                $this->db->where('id_stock', $id_stock);
                $this->db->update('consumables_stock');
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


        // function checkStockLevelsAndSendNotification()
        // {
        //     log_message('debug', 'Started checking stock levels.');
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
        //             $this->email->from('uhqdev@gmail.com', 'LIMS2.0 - Alerts');
        //             $this->email->to('ulhaqitcom@gmail.com');
        //             $this->email->subject('Stock Info: ' . $product['product_name']);
        //             $this->email->message('The stock for product ' . $product['product_name'] . ' is approaching the minimum level. Current quantity: ' . $quantity . ', Minimum stock: ' . $minimumStock . '.' . "\n" . 'Please update the stock levels as soon as possible.');
    
        //             // Send email
        //             if ($this->email->send()) {
        //                 log_message('debug', 'Email sent successfully for product ' . $product['product_name']);
        //             } else {
        //                 log_message('error', 'Error sending email for product ' . $product['product_name'] . ': ' . $this->email->print_debugger());
        //             }
        //         }
        //     }
        //     log_message('debug', 'Finished checking stock levels.');
        // }

        // function checkStockLevelsAndSendNotification($created_stock_ids = [])
        // {
        //     log_message('debug', 'Started checking stock levels.');
        //     $this->load->library('email');  

        //     // Jika ada id_stock yang diberikan, maka filter berdasarkan id_stock
        //     if (!empty($created_stock_ids)) {
        //         $this->db->where_in('id_stock', $created_stock_ids);
        //     }

        //     // Get all products (hanya yang baru saja diinsert atau diupdate)
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
        //             $this->email->from('uhqdev@gmail.com', 'LIMS2.0 - Alerts');
        //             $this->email->to('ulhaqitcom@gmail.com');
        //             $this->email->subject('Stock Info: ' . $product['product_name']);
        //             $this->email->message('The stock for product ' . $product['product_name'] . ' is approaching the minimum level. Current quantity: ' . $quantity . ', Minimum stock: ' . $minimumStock . '.' . "\n" . 'Please update the stock levels as soon as possible.');

        //             // Send email
        //             if ($this->email->send()) {
        //                 log_message('debug', 'Email sent successfully for product ' . $product['product_name']);
        //             } else {
        //                 log_message('error', 'Error sending email for product ' . $product['product_name'] . ': ' . $this->email->print_debugger());
        //             }
        //         }
        //     }
        //     log_message('debug', 'Finished checking stock levels.');
        // }

        // function checkStockLevelsAndSendNotification($created_stock_ids = [])
        // {
        //     log_message('debug', 'Started checking stock levels.');
        //     $this->load->library('email');

        //     // Jika ada id_stock yang diberikan, maka filter berdasarkan id_stock
        //     if (!empty($created_stock_ids)) {
        //         $this->db->where_in('id_stock', $created_stock_ids);
        //     }

        //     // Get all products (hanya yang baru saja diinsert atau diupdate)
        //     $this->db->select('id_stock, quantity, minimum_stock');
        //     $query = $this->db->get('consumables_stock');
        //     $stockData = $query->result_array();

        //     // Ambil semua email user dari tbl_user
        //     $this->db->select('email');
        //     $userQuery = $this->db->get('tbl_user');
        //     $userEmails = array_column($userQuery->result_array(), 'email');

        //     foreach ($stockData as $data) {
        //         $id_stock = $data['id_stock'];
        //         $quantity = $data['quantity'];
        //         $minimumStock = $data['minimum_stock'];

        //         // Cek apakah stok mendekati batas minimum
        //         if ($quantity <= $minimumStock + 10) {
        //             // Ambil nama produk
        //             $this->db->select('product_name');
        //             $this->db->where('id_stock', $id_stock);
        //             $productQuery = $this->db->get('consumables_stock');
        //             $product = $productQuery->row_array();

        //             $subject = 'Stock Info: ' . $product['product_name'];
        //             $message = 'The stock for product ' . $product['product_name'] . ' is approaching the minimum level. Current quantity: ' . $quantity . ', Minimum stock: ' . $minimumStock . '.' . "\n\n" . 'Please update the stock levels as soon as possible.';

        //             // Kirim email ke semua user
        //             foreach ($userEmails as $email) {
        //                 $this->email->clear(); // Penting: reset konfigurasi email setiap kali
        //                 $this->email->from('uhqdev@gmail.com', 'LIMS2.0 - Alerts');
        //                 $this->email->to($email);
        //                 $this->email->subject($subject);
        //                 $this->email->message($message);

        //                 if ($this->email->send()) {
        //                     log_message('debug', 'Email sent successfully to ' . $email . ' for product ' . $product['product_name']);
        //                 } else {
        //                     log_message('error', 'Error sending email to ' . $email . ' for product ' . $product['product_name'] . ': ' . $this->email->print_debugger());
        //                 }
        //             }
        //         }
        //     }

        //     log_message('debug', 'Finished checking stock levels.');
        // }

        function checkStockLevelsAndSendNotification($created_stock_ids = [])
        {
            log_message('debug', 'Started checking stock levels.');
            $this->load->library('email');

            // Ambil data stok yang relevan
            if (!empty($created_stock_ids)) {
                $this->db->where_in('id_stock', $created_stock_ids);
            }
            $this->db->select('id_stock, quantity, minimum_stock, product_name');
            $query = $this->db->get('consumables_stock');
            $stockData = $query->result_array();

            // Filter stok yang mendekati minimum
            $stockToNotify = array_filter($stockData, function ($stock) {
                return $stock['quantity'] <= $stock['minimum_stock'] + 10;
            });

            if (empty($stockToNotify)) {
                log_message('debug', 'No stock approaching minimum level. No emails sent.');
                return;
            }

            // Ambil semua email user dari tbl_user
            $this->db->select('email');
            $userQuery = $this->db->get('tbl_user');
            $userEmails = array_column($userQuery->result_array(), 'email');

            foreach ($stockToNotify as $stock) {
                $subject = 'Stock Info: ' . $stock['product_name'];
                $message = 'The stock for product ' . $stock['product_name'] . ' is approaching the minimum level. Current quantity: ' . $stock['quantity'] . ', Minimum stock: ' . $stock['minimum_stock'] . '.' . "\n\n" . 'Please update the stock levels as soon as possible.';

                foreach ($userEmails as $email) {
                    $this->email->clear();
                    $this->email->from('uhqdev@gmail.com', 'LIMS2.0 - Alerts');
                    $this->email->to($email);
                    $this->email->subject($subject);
                    $this->email->message($message);

                    if ($this->email->send()) {
                        log_message('debug', 'Email sent successfully to ' . $email . ' for product ' . $stock['product_name']);
                    } else {
                        log_message('error', 'Error sending email to ' . $email . ' for product ' . $stock['product_name'] . ': ' . $this->email->print_debugger());
                    }
                }
            }

            log_message('debug', 'Finished checking stock levels.');
        }



        function get_all() {
            $this->db->select('ro.objective, cs.product_name, cis.closed_container, cis.unit_measure_lab, cis.quantity_per_unit, 
            cis.loose_items, cis.total_quantity, cis.unit_of_measure, cis.expired_date, cis.comments, cis.date_collected, cis.time_collected');
            $this->db->from('consumables_in_stock AS cis');
            $this->db->join('consumables_stock AS cs', 'cis.id_stock = cs.id_stock', 'left');
            $this->db->join('ref_objective AS ro', 'cis.id_objective = ro.id_objective', 'left');
            $this->db->where('cis.flag', '0');
            $query = $this->db->get();
            return $query->result();
        }
        
    }

?>