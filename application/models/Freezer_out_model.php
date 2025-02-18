<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Freezer_out_model extends CI_Model
{

    public $table = 'freezer_out';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('freezer_out.id, freezer_out.date_out, ref_person.initial, ref_sample.sample, 
                                    ref_vessel.vessel, freezer_out.barcode_sample, ref_destination.destination, 
                                    ref_shipping.shipping_method, freezer_out.tracking_number, freezer_out.comments, 
                                    freezer_out.id_person, freezer_out.id_sample, freezer_out.id_vessel, 
                                    freezer_out.id_destination, freezer_out.id_shipping');
        $this->datatables->from('freezer_out');
        $this->datatables->join('ref_person', 'freezer_out.id_person=ref_person.id_person', 'left');
        $this->datatables->join('ref_sample', 'freezer_out.id_sample=ref_sample.id_sample', 'left');
        $this->datatables->join('ref_vessel', 'freezer_out.id_vessel=ref_vessel.id_vessel', 'left');
        $this->datatables->join('ref_destination', 'freezer_out.id_destination=ref_destination.id_destination', 'left');
        $this->datatables->join('ref_shipping', 'freezer_out.id_shipping=ref_shipping.id_shipping', 'left');
        $this->datatables->where('freezer_out.lab', $this->session->userdata('lab'));
        $this->datatables->where('freezer_out.flag', '0');
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
      $this->db->select('freezer_out.id, freezer_out.date_out, ref_person.initial, ref_sample.sample, 
            ref_vessel.vessel, freezer_out.barcode_sample, ref_destination.destination, 
            ref_shipping.shipping_method, freezer_out.tracking_number, freezer_out.comments, 
            freezer_out.id_person, freezer_out.id_sample, freezer_out.id_vessel, 
            freezer_out.id_destination, freezer_out.id_shipping');
      // $this->db->from('freezer_out');
      $this->db->join('ref_person', 'freezer_out.id_person=ref_person.id_person', 'left');
      $this->db->join('ref_sample', 'freezer_out.id_sample=ref_sample.id_sample', 'left');
      $this->db->join('ref_vessel', 'freezer_out.id_vessel=ref_vessel.id_vessel', 'left');
      $this->db->join('ref_destination', 'freezer_out.id_destination=ref_destination.id_destination', 'left');
      $this->db->join('ref_shipping', 'freezer_out.id_shipping=ref_shipping.id_shipping', 'left');
      $this->db->where('freezer_out.lab', $this->session->userdata('lab'));
      $this->db->where('freezer_out.flag', '0');
      $this->db->order_by('freezer_out.date_out, freezer_out.id', 'ASC');
      return $this->db->get('freezer_out')->result();
    }

    function get_usedup()
    {
        $this->db->select('freezer_out.id, x.max_date_out, ref_person.initial, ref_sample.sample, 
            ref_vessel.vessel, freezer_out.barcode_sample, ref_destination.destination, 
            ref_shipping.shipping_method, freezer_out.tracking_number, freezer_out.comments, 
            freezer_out.id_person, freezer_out.id_sample, freezer_out.id_vessel, 
            freezer_out.id_destination, freezer_out.id_shipping');
        $this->db->from('freezer_out');
        $this->db->join('ref_person', 'freezer_out.id_person = ref_person.id_person', 'left');
        $this->db->join('ref_sample', 'freezer_out.id_sample = ref_sample.id_sample', 'left');
        $this->db->join('ref_vessel', 'freezer_out.id_vessel = ref_vessel.id_vessel', 'left');
        $this->db->join('ref_destination', 'freezer_out.id_destination = ref_destination.id_destination', 'left');
        $this->db->join('ref_shipping', 'freezer_out.id_shipping = ref_shipping.id_shipping', 'left');
        
        // Subquery for max_date_out
        $subquery = '(SELECT MAX(freezer_out.date_out) AS max_date_out, freezer_out.barcode_sample, freezer_out.uuid 
            FROM freezer_out 
            LEFT JOIN ref_destination ON freezer_out.id_destination = ref_destination.id_destination 
            WHERE freezer_out.lab = 2 
            AND freezer_out.flag = 0 
            AND ref_destination.id_destination <> 4 
            GROUP BY freezer_out.barcode_sample) x';
        
        $this->db->join($subquery, 'freezer_out.uuid = x.uuid');
        
        $this->db->where('freezer_out.lab', 2);
        $this->db->where('freezer_out.flag', 0);
        $this->db->where('ref_destination.id_destination <>', 4, false);
        
        $this->db->order_by('freezer_out.date_out, freezer_out.id', 'ASC');
        
        return $this->db->get()->result();
    }

    
    // function get_usedup()
    // {
    //   $this->db->select('freezer_out.id, freezer_out.date_out, ref_person.initial, ref_sample.sample, 
    //         ref_vessel.vessel, freezer_out.barcode_sample, ref_destination.destination, 
    //         ref_shipping.shipping_method, freezer_out.tracking_number, freezer_out.comments, 
    //         freezer_out.id_person, freezer_out.id_sample, freezer_out.id_vessel, 
    //         freezer_out.id_destination, freezer_out.id_shipping');
    //   // $this->db->from('freezer_out');
    //   $this->db->join('ref_person', 'freezer_out.id_person=ref_person.id_person', 'left');
    //   $this->db->join('ref_sample', 'freezer_out.id_sample=ref_sample.id_sample', 'left');
    //   $this->db->join('ref_vessel', 'freezer_out.id_vessel=ref_vessel.id_vessel', 'left');
    //   $this->db->join('ref_destination', 'freezer_out.id_destination=ref_destination.id_destination', 'left');
    //   $this->db->join('ref_shipping', 'freezer_out.id_shipping=ref_shipping.id_shipping', 'left');
    //   $this->db->where('freezer_out.lab', $this->session->userdata('lab'));
    //   $this->db->where('freezer_out.flag', '0');
    //   $this->db->where('ref_destination.id_destination <> 4');
    //   $this->db->order_by('freezer_out.date_out, freezer_out.id', 'ASC');
    //   return $this->db->get('freezer_out')->result();
    // }

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

    function getSampleType(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_sample');
        $response = $q->result_array();
    
        return $response;
      }

      function getVessel(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_vessel');
        $response = $q->result_array();
    
        return $response;
      }

      function getDestination(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_destination');
        $response = $q->result_array();
    
        return $response;
      }

      function getShipping(){
        $response = array();
        $this->db->select('*');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_shipping');
        $response = $q->result_array();
    
        return $response;
      }

    function getLabtech(){
        $response = array();
        $this->db->select('*');
        $this->db->where('position', 'Lab Tech');
        $q = $this->db->get('ref_person');
        $response = $q->result_array();
    
        return $response;
      }

    //   function getDNAType($id){
    //     $response = array();
    //     // Select record
    //     $this->db->select('sampletype');
    //     $this->db->where('barcode_dna', $id);
    //     $q = $this->db->get('dna_extraction');
    //     $response = $q->result_array();
    
    //     return $response;
    //   }

      function validate1($id){
        $this->db->where('barcode_sample', $id);
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