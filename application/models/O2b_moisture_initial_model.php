<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O2b_moisture_initial_model extends CI_Model
{

    public $table = 'obj2b_moisture1';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('*');
        $this->datatables->from('obj2b_moisture1');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('O2b_moisture_initial/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $this->db->order_by('date_moisture', 'ASC');
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        return $this->db->get('obj2b_moisture1')->result();
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

    //   function getSampleType(){

    //     $response = array();
    //     // Select record
    //     $this->db->select('*');
    //     $this->db->where('obj', 'O2B');
    //     $q = $this->db->get('ref_sampletype');
    //     $response = $q->result_array();
    
    //     return $response;
    //   }

    function getLabtech(){
        $response = array();
        $this->db->select('*');
        $this->db->where('position', 'Lab Tech');
        $q = $this->db->get('ref_person');
        $response = $q->result_array();
        return $response;
      }


    function load_freez($id){
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        $q = $this->db->query('
        SELECT freezer, shelf, rack, rack_level FROM ref_location_80
        WHERE id_location_80 = "'.$id.'"
        AND lab = "'.$this->session->userdata('lab').'" 
        ');        
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }      

    function get_freez($freez, $shelf, $rack, $draw){
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        $q = $this->db->query('
        SELECT id_location_80 FROM ref_location_80
        WHERE freezer = "'.$freez.'"
        AND shelf = "'.$shelf.'"
        AND rack = "'.$rack.'"
        AND rack_level = "'.$draw.'"
        AND lab = "'.$this->session->userdata('lab').'" 
        AND flag = 0
        ');        
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }            

      function validate1($id){
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        // WHERE barcode_falcon = "'.$id.'"

        $q = $this->db->query('
        SELECT barcode_sample, stype FROM
        (SELECT a.barcode_falcon AS barcode_sample, "Bootsocks" as stype
            FROM obj2b_bs_stomacher a
            LEFT JOIN obj2b_subbs_idexx b ON a.barcode_sample = b.barcode_sample
            LEFT JOIN obj2b_mac1 c ON a.barcode_falcon = c.barcode_sample
        WHERE LENGTH(a.barcode_falcon) > 0
        AND a.elution_no = "Moisture1"
        AND a.flag = 0
        UNION ALL
        SELECT barcode_sample, "Sediment" as stype FROM obj2b_receipt 
        WHERE id_type2b IN (7)
        AND (png_control <> "Yes" OR png_control is null)
        AND flag = 0) x
        WHERE x.barcode_sample = "'.$id.'"
        AND x.barcode_sample NOT IN (SELECT barcode_sample FROM obj2b_moisture1)
        ');        
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

      function validate2($id){
        $q = $this->db->query('
        SELECT a.barcode_falcon AS barcode_sample
        FROM obj2b_bs_stomacher a
        WHERE a.barcode_falcon = "'.$id.'"
        AND a.elution_no = "Moisture2"
        AND a.barcode_falcon NOT IN (SELECT barcode_sample FROM obj2b_moisture1 UNION ALL 
        SELECT barcode_falcon2 FROM obj2b_moisture1)
        AND a.flag = 0
        ');        
        $response = $q->result_array();
        return $response;
      }      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */