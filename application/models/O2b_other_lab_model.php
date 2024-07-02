<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O2b_other_lab_model extends CI_Model
{

    public $table = 'obj2b_chemistry';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('barcode_sample, sampletype2bwat, barcode_nitro, 3rdparty_lab as rdparty_lab, barcode_nitro2, 3rdparty_lab2 as rdparty_lab2, barcode_microbiology, 3rdparty_lab3 as rdparty_lab3, barcode_microbiology2, 3rdparty_lab4 as rdparty_lab4, barcode_rise_lab, comments, id_type2bwat, lab, flag');
        // $this->datatables->from('v_obj2bchemistry');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('a.barcode_sample, b.sampletype AS sampletype2bwat, a.barcode_nitro, a.3rdparty_lab as rdparty_lab, 
        a.barcode_nitro2, a.3rdparty_lab2 as rdparty_lab2, a.barcode_microbiology, a.3rdparty_lab3 as rdparty_lab3, 
        a.barcode_microbiology2, a.3rdparty_lab4 as rdparty_lab4, a.barcode_rise_lab, a.comments, a.id_type2bwat, a.lab, a.flag');
        $this->datatables->from('obj2b_chemistry a');
        $this->datatables->join('ref_sampletype b', 'a.id_type2bwat = b.id_sampletype', 'left');
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
                ".anchor(site_url('O2b_other_lab/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT a.barcode_sample AS barcode_sample,b.sampletype AS sampletype2bwat, a.barcode_nitro AS barcode_nitro, 
        a.3rdparty_lab AS lab1, a.barcode_nitro2 AS barcode_nitro2, a.3rdparty_lab2 AS lab2,
        a.barcode_microbiology AS barcode_microbiology, a.3rdparty_lab3 AS lab3,
        a.barcode_microbiology2 AS barcode_microbiology2, a.3rdparty_lab4 AS lab4, a.barcode_rise_lab,
        a.comments AS comments,a.id_type2bwat AS id_type2bwat, a.lab, a.flag
        from obj2b_chemistry a 
        left join ref_sampletype b on a.id_type2bwat = b.id_sampletype 
        WHERE a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.barcode_sample
        ');
        $response = $q->result();
        return $response;

        // $this->db->order_by($this->id, $this->order);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('v_obj2bchemistry')->result();
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

    // function getLabtech(){
    //     $response = array();
    //     $this->db->select('*');
    //     $this->db->where('position', 'Lab Tech');
    //     $q = $this->db->get('ref_person');
    //     $response = $q->result_array();
    
    //     return $response;
    //   }

      function getSampleType(){

        $response = array();
        // Select record
        $this->db->select('*');
        $this->db->where('obj', 'O2BW');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_sampletype');
        $response = $q->result_array();
    
        return $response;
      }

      function gen_ctrl($wtyp){
        $ctrl = array('15', '16', '17');
        $this->db->select("CONCAT('CTRL-W-', LPAD(CONVERT(RIGHT(MAX(barcode_sample), 5)+1,CHAR) ,5,'0')) AS new_bar");
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        $this->db->where_in('id_type2bwat', $ctrl);
        $this->db->order_by('barcode_sample', 'ASC');
        $q = $this->db->get('obj2b_chemistry');
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

      function validate_nitro($id){
        $this->db->where('barcode_nitro', $id);
        $this->db->or_where('barcode_nitro2', $id);
        $this->db->or_where('barcode_microbiology', $id);
        $this->db->or_where('barcode_microbiology2', $id);
        $this->db->or_where('barcode_rise_lab', $id);
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