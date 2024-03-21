<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O3_sample_reception_model extends CI_Model
{

    public $table = 'obj3_sam_rec';
    public $id = 'barcode_sample';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('barcode_sample, date_receipt, time_receipt, initial, sample_type, png_control, cold_chain, cont_intact, comments, id_person, id_type');
        // $this->datatables->from('v_obj3sample');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('obj3_sam_rec.barcode_sample, obj3_sam_rec.date_receipt, obj3_sam_rec.time_receipt,
        ref_person.initial, ref_sampletype.sampletype AS sample_type, obj3_sam_rec.png_control, obj3_sam_rec.cold_chain,
         obj3_sam_rec.cont_intact, obj3_sam_rec.comments, obj3_sam_rec.id_person, obj3_sam_rec.id_type, obj3_sam_rec.lab, obj3_sam_rec.flag');
        $this->datatables->from('obj3_sam_rec');
        $this->datatables->join('ref_person', 'obj3_sam_rec.id_person = ref_person.id_person', 'left');
        $this->datatables->join('ref_sampletype', 'obj3_sam_rec.id_type = ref_sampletype.id_sampletype', 'left');
        $this->datatables->where('obj3_sam_rec.lab', $this->session->userdata('lab'));
        $this->datatables->where('obj3_sam_rec.flag', '0');

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
                ".anchor(site_url('o3_sample_reception/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('SELECT 
        obj3_sam_rec.barcode_sample, obj3_sam_rec.date_receipt, obj3_sam_rec.time_receipt,
        ref_person.initial, ref_sampletype.sampletype AS sample_type, obj3_sam_rec.png_control, obj3_sam_rec.cold_chain,
        obj3_sam_rec.cont_intact, obj3_sam_rec.comments, obj3_sam_rec.id_person, obj3_sam_rec.lab, obj3_sam_rec.flag        
        FROM obj3_sam_rec
        LEFT JOIN ref_person ON obj3_sam_rec.id_person = ref_person.id_person
        LEFT JOIN ref_sampletype ON obj3_sam_rec.id_type = ref_sampletype.id_sampletype
        WHERE obj3_sam_rec.lab = "'.$this->session->userdata('lab').'" 
        AND obj3_sam_rec.flag = 0
        ORDER BY obj3_sam_rec.date_receipt, obj3_sam_rec.time_receipt, obj3_sam_rec.barcode_sample
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

      function getSampleType(){

        $response = array();
        // Select record
        $this->db->select('*');
        $this->db->where('obj', 'O3');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_sampletype');
        $response = $q->result_array();
    
        return $response;
      }

      function validate1($id){
        $this->db->where('barcode_sample', $id);
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