<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DNA_aliquotting_model extends CI_Model
{

    public $table = 'dna_aliquot';
    public $id = 'id_dna';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('id_dna, date_aliquot, initial, barcode_monash, barcode_cambridge, comments, aliq,
        // id_person, lab, flag');
        // $this->datatables->from('v_dna_aliq');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('a.id_dna, a.date_aliquot, b.initial, a.barcode_monash, a.barcode_cambridge, 
        a.comments, a.id_person, a.lab, a.flag, count(c.id_dna_det) AS aliq');
        $this->datatables->from('dna_aliquot a');
        $this->datatables->join('ref_person b', 'a.id_person=b.id_person', 'left');
        $this->datatables->join('dna_aliquot_det c', 'a.id_dna=c.id_dna', 'left');
        $this->datatables->where('a.lab', $this->session->userdata('lab'));
        $this->datatables->where('a.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'id_dna');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', anchor(site_url('dna_aliquotting/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                    ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_dna');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('dna_aliquotting/read/$1'),'<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                    ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                    ".anchor(site_url('dna_aliquotting/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_dna');
        }
        return $this->datatables->generate();
    }

    function subjson($id) {
        // $this->datatables->select('row_id, column_id, barcode_dna, comments, id_dna_det, id_dna, lab, flag');
        // $this->datatables->from('v_dna_aliq_det');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');
        // $this->datatables->where('id_dna', $id);

        $this->datatables->select('id_dna_det, row_id, column_id, barcode_dna, comments, id_dna, lab, flag');
        $this->datatables->from('dna_aliquot_det');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('flag', '0');
        $this->datatables->where('id_dna', $id);

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'id_dna_det');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_dna_det');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('dna_aliquotting/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_dna_det');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT c.barcode_dna, a.date_aliquot, b.initial, a.barcode_monash, a.barcode_cambridge, c.row_id, c.column_id,
        a.comments
        FROM dna_aliquot a
        LEFT JOIN dna_aliquot_det c ON a. id_dna = c.id_dna
        LEFT JOIN ref_person b ON a.id_person=b.id_person  
        WHERE a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_aliquot
        ');
        $response = $q->result();
        return $response;    
    }

    function get_by_id($id_dna)
    {
        $this->db->where('id_dna', $id_dna);
        $this->db->where('flag', '0');
        return $this->db->get('v_dna_aliq')->row();
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

    function insert_detail($data)
    {
        $this->db->insert('dna_aliquot_det', $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update_detail($id, $data)
    {
        $this->db->where('id_dna_det', $id);
        $this->db->update('dna_aliquot_det', $data);
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
        $this->db->where('lab', $this->session->userdata('lab'));
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