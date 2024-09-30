<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consumables_report_model extends CI_Model
{

    public $table = 'v_obj2arecept';
    public $id = 'id_receipt';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($date1, $date2, $objective, $stock) {
        $this->datatables->select('    
            ro.objective, 
            cs.product_name, 
            cis.closed_container, 
            cis.unit_measure_lab, 
            cis.quantity_per_unit, 
            cis.loose_items, 
            cis.total_quantity, 
            cis.unit_of_measure,
            cis.expired_date,
            cis.comments,
            cis.date_collected,
            cis.flag'
        );
        
        $this->datatables->from('consumables_in_stock AS cis');
        $this->datatables->join('ref_objective AS ro', 'cis.id_objective = ro.id_objective', 'left');
        $this->datatables->join('consumables_stock AS cs', 'cis.id_stock = cs.id_stock', 'left');
        
        // Uncomment this line if you need to filter by lab
        $this->datatables->where('cis.lab', $this->session->userdata('lab'));
        
        $this->datatables->where('cis.flag', '0');
        if ($objective !== '') {
            $this->datatables->where('cis.id_objective', $objective);
        }
        if ($stock !== '') {
            $this->datatables->where('cis.id_stock', $stock);
        }
        
        
        // Menggunakan where_raw untuk kondisi tanggal
        $this->datatables->where("cis.date_collected >= IF('$date1' IS NULL OR '$date1' = '', '0000-00-00', '$date1')");
        $this->datatables->where("cis.date_collected <= IF('$date2' IS NULL OR '$date2' = '', NOW(), '$date2')");
        
        // Uncomment this line if you need to limit the number of results
        // $this->datatables->limit('50');
        
        return $this->datatables->generate();
    }
    

    function getObjective()
    {
        $response = array();
        $this->db->select('id_objective, objective');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_objective');
        $response = $q->result_array();
        return $response;
    }

}

/* End of file Tbl_customer_model.php */
/* Location: ./application/models/Tbl_customer_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:29:29 */
/* http://harviacode.com */