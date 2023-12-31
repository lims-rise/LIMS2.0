<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class REP_dna_model extends CI_Model
{

    public $table = 'dna_extraction';
    public $id = 'barcode_dna';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($date1, $date2) {
        $this->datatables->select('*');
        $this->datatables->from('dna_extraction');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('flag', '0');
        $this->datatables->where("(date_extraction >= IF('$date1' IS NULL or '$date1' = '', '0000-00-00', '$date1'))", NULL);
        $this->datatables->where("(date_extraction <= IF('$date2' IS NULL or '$date2' = '', NOW(), '$date2'))", NULL);
        // $this->datatables->limit('50');
        return $this->datatables->generate();
    }


}

/* End of file Tbl_customer_model.php */
/* Location: ./application/models/Tbl_customer_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:29:29 */
/* http://harviacode.com */