<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DNA_sample_control_model extends CI_Model
{

    public $table = 'dna_control';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('dna_control.barcode_sample, dna_control.barcode_vessel,
        dna_control.barcode_vessel2, dna_control.barcode_vessel3, dna_control.barcode_vessel4,
        dna_control.barcode_vessel5,ref_sampledna.sample, 
        dna_control.comments, dna_control.lab, dna_control.flag, dna_control.id_sample');
        $this->datatables->from('dna_control');
        $this->datatables->join('ref_sampledna', 'dna_control.id_sample = ref_sampledna.id_sample', 'left');
        $this->datatables->where('dna_control.lab', $this->session->userdata('lab'));
        $this->datatables->where('dna_control.flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'barcode_sample');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $this->db->select('dna_control.barcode_sample, ref_sampledna.sample, dna_control.barcode_vessel,dna_control.barcode_vessel2,
        dna_control.barcode_vessel3,dna_control.barcode_vessel4,dna_control.barcode_vessel5,dna_control.comments,
        dna_control.flag, dna_control.id_sample,dna_control.lab'); 
        $this->db->from('dna_control');
        $this->db->join('ref_sampledna', 'dna_control.id_sample = ref_sampledna.id_sample', 'left'); // Adjust the columns and table names
        $this->db->where('dna_control.lab', $this->session->userdata('lab'));
        $this->db->where('dna_control.flag', '0');
        $this->db->order_by('dna_control.' . $this->id, 'ASC');
        return $this->db->get()->result();
        
        // Execute the query and return the results
        // $this->db->order_by($this->id, 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('dna_control')->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
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

    // function getLabtech(){
    //     $response = array();
    //     $this->db->select('*');
    //     $this->db->where('position', 'Lab Tech');
    //     $q = $this->db->get('ref_person');
    //     $response = $q->result_array();
    
    //     return $response;
    //   }

      function getSampleDNA(){
        $response = array();
        $this->db->select('*');
        $q = $this->db->get('ref_sampledna');
        $response = $q->result_array();
        return $response;
      }

    //   function validate1($id){
    //     $this->db->where('barcode_sample', $id);
    //     // $this->db->where('lab', $this->session->userdata('lab'));
    //     $q = $this->db->get($this->table);
    //     $response = $q->result_array();
    //     return $response;
    //     // return $this->db->get('ref_location_80')->row();
    //   }

}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */