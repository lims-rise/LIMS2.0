<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O3_filter_paper_model extends CI_Model
{

    public $table = 'obj3_bfilterpaper';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('barcode_sample, date_process, time_process, initial, freezer_bag, location, comments, id_person, id_location_80, lab');
        $this->datatables->from('v_obj3bfilterpaper');
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
            // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('o3_filter_paper/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }
        // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        return $this->datatables->generate();
    }

    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        return $this->db->get('v_obj3bfilterpaper')->result();
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

    function insert_freezer($data)
    {
        $this->db->insert('freezer_in', $data);
    }
    
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update_freezer($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('freezer_in', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function getFreezerIN($id){
      // $response = array();
      $this->db->select('MAX(id) AS id');
      $this->db->where('barcode_sample', $id);
      $this->db->where('flag', '0');
    // $q = $this->db->get('freezer_in');
      // $response = $q->result_array();
      return $this->db->get('freezer_in')->row();
      // return $response;
    }

    function getLabtech(){
        $response = array();
        $this->db->select('*');
        $this->db->where('position', 'Lab Tech');
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_person');
        $response = $q->result_array();
    
        return $response;
      }

      function getFreezer(){
        $response = array();
        $this->db->select('freezer');
        $this->db->distinct();
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location_80');
        $response = $q->result_array();
        return $response;
      }

      function getShelf(){
        $response = array();
        $this->db->select('shelf');
        $this->db->distinct();
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location_80');
        $response = $q->result_array();
        return $response;
      }

      function getRack(){
        $response = array();
        $this->db->select('rack');
        $this->db->distinct();
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location_80');
        $response = $q->result_array();
        return $response;
      }
      
      function getDrawer(){
        $response = array();
        $this->db->select('rack_level');
        $this->db->distinct();
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location_80');
        $response = $q->result_array();
        return $response;
      }

      function find_loc($id){
        // $this->db->where('id_location_80', $id);
        // $q = $this->db->get('ref_location_80');
        $this->db->where('id', $id);
        $this->db->where('flag', '0');
        $q = $this->db->get('v_findcryo');
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

      function find_cryo($id){
        $this->db->where('cryobox', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        $q = $this->db->get('v_findcryo');
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

      function getFreezLoc($f,$s,$r,$rl){
        $this->db->select('id_location_80');
        $this->db->where('freezer', $f);
        $this->db->where('shelf', $s);
        $this->db->where('rack', $r);
        $this->db->where('rack_level', $rl);
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // return $this->db->get('ref_location_80');
        // $response = $q->result_array();
        // return $response;
        return $this->db->get('ref_location_80')->row();
      }

      function validate1($id, $type){
        if($type == 1) {
            $this->db->where('barcode_sample', $id);
        }
        $this->db->where('flag', '0');
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