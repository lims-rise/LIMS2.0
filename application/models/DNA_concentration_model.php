<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DNA_concentration_model extends CI_Model
{

    public $table = 'dna_concentration';
    public $id = 'barcode_dna';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('barcode_dna, date_concentration, initial, sampletype, dna_concentration, comments,
        // id_person, lab, flag');
        // $this->datatables->from('v_dna_conc');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('a.barcode_dna, a.date_concentration, c.initial, b.sampletype, 
        a.dna_concentration, a.comments, a.id_person, a.lab, a.flag');
        $this->datatables->from('dna_concentration a');
        $this->datatables->join('dna_extraction b', 'a.barcode_dna=b.barcode_dna', 'left');
        $this->datatables->join('ref_person c', 'a.id_person=c.id_person', 'left');
        $this->datatables->where('a.lab', $this->session->userdata('lab'));
        $this->datatables->where('a.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'barcode_dna');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT a.barcode_dna, a.date_concentration, c.initial, b.sampletype, a.dna_concentration, a.comments
        FROM dna_concentration a
        LEFT JOIN dna_extraction b ON a.barcode_dna=b.barcode_dna
        LEFT JOIN ref_person c ON a.id_person=c.id_person
        WHERE a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_concentration
        ');
        $response = $q->result();
        return $response;    
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    // function get_by_id_detail($id)
    // {
    //     $this->db->where('id_delivery_det', $id);
    //     return $this->db->get('tbl_delivery_det')->row();
    // }

    // get total rows
    // function total_rows($q = NULL) {
    //     $this->db->like('id_delivery', $q);
	// $this->db->or_like('date_delivery', $q);
	// $this->db->or_like('delivery_number', $q);
	// $this->db->or_like('customer_name', $q);
	// $this->db->or_like('city', $q);
	// $this->db->or_like('phone', $q);
	// $this->db->or_like('notes', $q);
	// $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }

    // get data with limit and search
    // function get_limit_data($limit, $start = 0, $q = NULL) {
    //     $this->db->order_by($this->id, $this->order);
    //     $this->db->like('id_delivery', $q);
	// $this->db->or_like('date_delivery', $q);
	// $this->db->or_like('delivery_number', $q);
	// $this->db->or_like('customer_name', $q);
	// $this->db->or_like('city', $q);
	// $this->db->or_like('phone', $q);
	// $this->db->or_like('notes', $q);
	// $this->db->limit($limit, $start);
    //     return $this->db->get($this->table)->result();
    // }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
    
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    // function delete($id_user, $data)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->update($this->table, $data);
    // }

    // function delete($id)
    // {
        // $this->db->where($this->id, $id);
        // $this->db->delete($this->table);
    // }

    function getLabtech(){
        $response = array();
        $this->db->select('*');
        $this->db->where('position', 'Lab Tech');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_person');
        $response = $q->result_array();
    
        return $response;
      }

      function getDNAType($id){
        $response = array();
        // Select record
        $this->db->select('sampletype');
        $this->db->where('barcode_dna', $id);
        $this->db->where('flag', '0');
        $q = $this->db->get('dna_extraction');
        $response = $q->result_array();
    
        return $response;
      }

      function validate1($id){
        $this->db->where('barcode_dna', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        $q = $this->db->get($this->table);
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */