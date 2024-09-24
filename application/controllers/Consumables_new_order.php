<?php
    if(!defined('BASEPATH')) exit('No direct script access allowed');
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\IOFactory;
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    use Google\Client as google_client;
    use Google\Service\Drive as google_drive;

    class Consumables_new_order extends CI_Controller 
    {
    /**
     * Constructor for the class.
     *
     * This function is called when an object of the class is created.
     * It initializes the necessary dependencies and performs any necessary setup.
     *
     * @return void
     */
        function __construct()
        {
            parent::__construct();
            is_login();
            $this->load->model('Consumables_new_order_model');
            $this->load->library('form_validation');
            $this->load->library('datatables');
            $this->load->library('uuid');
        }

        /**
         * Loads the product data and renders the 'consumables_new_order/index' view.
         *
         * @return void
         */
        function index()
        {
            // $data['InStock'] = $this->Consumables_new_order_model->getInstock();
            $data['stockName'] = $this->Consumables_new_order_model->getStock();
            // var_dump($data);
            // die();
            $this->template->load('template', 'consumables_new_order/index', $data);
        }

        public function getStockDetails()
        {
            $idStock = $this->input->post('idStock');
            $stock = $this->Consumables_new_order_model->getStockById($idStock);
            echo json_encode($stock);
        }

    /**
     * Retrieves new order data in JSON format.
     *
     * This function sets the 'Content-Type' header to 'application/json' and
     * echoes the result of calling the 'jsonGetNewOrder' method on the
     * 'Consumables_new_order_model' object.
     *
     * @return void
     */
        public function jsonOrder()
        {
            header('Content-Type: application/json');
            echo $this->Consumables_new_order_model->jsonGetOrder();
        }

        /**
         * Save new consumables order.
         *
         * @return void
         */
        public function saveConsumablesOrder()
        {
            $mode = $this->input->post('mode',TRUE);
            $id = strtoupper($this->input->post('id_order',TRUE));
            $dt = new DateTime();
            $c = $this->input->post('id_stock', TRUE);

            // var_dump($c);
            // die();
            if ($mode == "insert") {
                $data = array(
                    // 'product_id' => $this->input->post('product_id',TRUE),
                    'id_stock' => $this->input->post('id_stock',TRUE),
                    'quantity_ordering' => $this->input->post('quantity_ordering',TRUE),
                    'unit_ordering' => $this->input->post('unit_ordering',TRUE),
                    'quantity_per_unit' => $this->input->post('quantity_per_unit',TRUE),
                    'total_quantity_ordered' => $this->input->post('total_quantity_ordered', TRUE),
                    'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                    'vendor' => $this->input->post('vendor',TRUE),
                    'date_ordered' => $this->input->post('date_ordered',TRUE),
                    'time_ordered' => $this->input->post('time_ordered',TRUE),
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_created' => $this->session->userdata('id_users'),
                    'date_created' => $dt->format('Y-m-d H:i:s'),
                );
                
                // var_dump($data);
                // die();
                $this->Consumables_new_order_model->insertConsumablesOrder($data);
                // $this->Consumables_new_order_model->updateQtyProduct($id_product,$this->input->post('quantity_per_unit',TRUE));
                
                $this->session->set_flashdata('message', 'Create Record Success');  
            } else if ($mode == "edit") {
                $data = array(
                    // 'product_id' => $this->input->post('product_id',TRUE),
                    'id_stock' => $this->input->post('id_stock',TRUE),
                    'quantity_ordering' => $this->input->post('quantity_ordering',TRUE),
                    'unit_ordering' => $this->input->post('unit_ordering',TRUE),
                    'quantity_per_unit' => $this->input->post('quantity_per_unit',TRUE),
                    'total_quantity_ordered' => $this->input->post('total_quantity_ordered', TRUE),
                    'unit_of_measure' => $this->input->post('unit_of_measure',TRUE),
                    'vendor' => $this->input->post('vendor',TRUE),
                    'date_ordered' => $this->input->post('date_ordered',TRUE),
                    'time_ordered' => $this->input->post('time_ordered',TRUE),
                    'flag' => '0',
                    'lab' => $this->session->userdata('lab'),
                    'uuid' => $this->uuid->v4(),
                    'user_updated' => $this->session->userdata('id_users'),
                    'date_updated' => $dt->format('Y-m-d H:i:s'), 
                );
                $this->Consumables_new_order_model->updateConsumablesOrder($id, $data);
                $this->session->set_flashdata('message', 'Update Record Success');  
            }

            redirect(site_url("consumables_new_order"));
        }


        /**
         * A function to delete a consumable new order record by its ID.
         *
         * @param datatype $id The ID of the consumable new order record to be deleted.
         * @throws Some_Exception_Class description of exception
         * @return Some_Return_Value
         */
        public function deleteConsumablesOrder($id)
        {
            $row = $this->Consumables_new_order_model->getById($id);
            if ($row) {
                $this->Consumables_new_order_model->destroyConsumablesOrder($id);
                $this->session->set_flashdata('message', 'Delete Record Success');
                redirect(site_url('consumables_new_order'));
            } else {
                $this->session->set_flashdata('message', 'Record Not Found');
                redirect(site_url('consumables_new_order'));
            }
        }

        // public function readConsumablesNewOrder($id)
        // {
        //     // $data['testing_type'] = $this->Water_sample_reception_model->getTest();
        //     $row = $this->Consumables_new_order_model->get_detail($id);
        //     if ($row) {
        //         $data = array(
        //             'id_neworder' => $row->id_neworder,
        //             'stock_id' => $row->stock_id,
        //             'product_name' => $row->product_name,
        //             'quantity_ordering' => $row->quantity_ordering,
        //             'unit_ordering' => $row->unit_ordering,
        //             'quantity_per_unit' => $row->quantity_per_unit,
        //             'total_quantity_ordered' => $row->total_quantity_ordered,
        //             'unit_of_measure' => $row->unit_of_measure,
        //             'indonesia_comments' => $row->indonesia_comments,
        //             'melbourne_comments' => $row->melbourne_comments,
        //             'order_decision' => $row->order_decision,
        //             );
        //             // var_dump($data);
        //             // die();
        //             $this->template->load('template','consumables_order_detail/index', $data);
        //     }
        //     else {
        //         // $this->template->load('template','Water_sample_reception/index_det');
        //     }
        // }


        public function excel() {
            $spreadsheet = new Spreadsheet();    
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setCellValue('A1', "Product Name"); 
            $sheet->setCellValue('B1', "Quantity Ordering"); 
            $sheet->setCellValue('C1', "Unit Ordering");
            $sheet->setCellValue('D1', "Quantity Per Unit");
            $sheet->setCellValue('E1', "Total Quantity Ordered");
            $sheet->setCellValue('F1', "Unit of Measure");
            $sheet->setCellValue('G1', "Vendor");
            $sheet->setCellValue('H1', "Date Ordered");
            $sheet->setCellValue('I1', "Time Ordered");
            $sheet->setCellValue('J1', "Remaining Quantity");
            $sheet->setCellValue('K1', "Received Quantity");
            $sheet->setCellValue('L1', "Status");
    
            $order = $this->Consumables_new_order_model->get_all();
            $numrow = 2;
            foreach($order as $data){ 
                if (property_exists($data, 'product_name')) {
                    $sheet->setCellValue('A'.$numrow, $data->product_name);
                } else {
                    $sheet->setCellValue('A'.$numrow, '');
                }
        
                if (property_exists($data, 'quantity_ordering')) {
                    $sheet->setCellValue('B'.$numrow, $data->quantity_ordering);
                } else {
                    $sheet->setCellValue('B'.$numrow, '');
                }
        
                if (property_exists($data, 'unit_ordering')) {
                    $sheet->setCellValue('C'.$numrow, $data->unit_ordering);
                } else {
                    $sheet->setCellValue('C'.$numrow, '');
                }
        
                if (property_exists($data, 'quantity_per_unit')) {
                    $sheet->setCellValue('D'.$numrow, $data->quantity_per_unit);
                } else {
                    $sheet->setCellValue('D'.$numrow, '');
                }
    
                if (property_exists($data, 'total_quantity_ordered')) {
                    $sheet->setCellValue('F'.$numrow, $data->total_quantity_ordered);
                } else {
                    $sheet->setCellValue('F'.$numrow, '');
                }
        
                if (property_exists($data, 'unit_of_measure')) {
                    $sheet->setCellValue('E'.$numrow, $data->unit_of_measure);
                } else {
                    $sheet->setCellValue('E'.$numrow, '');
                }
        
                if (property_exists($data, 'vendor')) {
                    $sheet->setCellValue('G'.$numrow, $data->vendor);
                } else {
                    $sheet->setCellValue('G'.$numrow, '');
                }
        
                if (property_exists($data, 'date_ordered')) {
                    $sheet->setCellValue('H'.$numrow, $data->date_ordered);
                } else {
                    $sheet->setCellValue('H'.$numrow, '');
                }
        
                if (property_exists($data, 'time_ordered')) {
                    $sheet->setCellValue('I'.$numrow, $data->time_ordered);
                } else {
                    $sheet->setCellValue('I'.$numrow, '');
                }
        
                if (property_exists($data, 'remaining_quantity')) {
                    $sheet->setCellValue('J'.$numrow, $data->remaining_quantity);
                } else {
                    $sheet->setCellValue('J'.$numrow, '');
                }
    
                if (property_exists($data, 'received')) {
                    $sheet->setCellValue('K'.$numrow, $data->received);
                } else {
                    $sheet->setCellValue('K'.$numrow, '');
                }
    
                if (property_exists($data, 'status')) {
                    $sheet->setCellValue('L'.$numrow, $data->status);
                } else {
                    $sheet->setCellValue('L'.$numrow, '');
                }
                $numrow++;
            }
    
            // Set header untuk file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="Report_Order.xlsx"');
            header('Cache-Control: max-age=0');
    
            // Tampilkan file excel
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }

    }
?>