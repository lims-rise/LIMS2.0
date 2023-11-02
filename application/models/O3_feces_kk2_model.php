<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O3_feces_kk2_model extends CI_Model
{

    public $table = 'obj3_fkk2';
    public $id = 'bar_kkslide';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('bar_kkslide, date_process, person_read, person_write, duration, start_time, end_time, 
        // ascaris, ascaris_com, hookworm, hookworm_com, trichuris, trichuris_com, strongyloides, strongyloides_com, taenia,
        // taenia_com, other, other_com, comments, finalized, id_person, id_person2, lab, flag');
        // $this->datatables->from('v_obj3fkk2');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('a.bar_kkslide, a.date_process, b.initial AS person_read, c.initial AS person_write, 
        a.duration, a.start_time, a.end_time, a.ascaris, a.ascaris_com, a.hookworm, a.hookworm_com, a.trichuris, 
        a.trichuris_com, a.strongyloides, a.strongyloides_com, a.taenia,
        a.taenia_com, a.other, a.other_com, a.comments, a.finalized, a.id_person, a.id_person2, a.lab, a.flag');
        $this->datatables->from('obj3_fkk2 a');
        $this->datatables->join('ref_person b', 'a.id_person = b.id_person', 'left');
        $this->datatables->join('ref_person c', 'a.id_person2 = c.id_person', 'left');
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
                ".anchor(site_url('O3_feces_kk2/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }
        // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('SELECT 
        a.bar_kkslide, a.date_process, b.initial AS person_read, c.initial AS person_write, a.duration, a.start_time, a.end_time, a.ascaris, a.ascaris_com, a.hookworm, a.hookworm_com, a.trichuris, a.trichuris_com,
        a.strongyloides, a.strongyloides_com, a.taenia, a.taenia_com, other, other_com, a.comments, a.id_person, a.finalized, a.id_person2, a.lab, a.flag
        from obj3_fkk2 a
        left join ref_person b on a.id_person = b.id_person
        left join ref_person c on a.id_person2 = c.id_person 
        WHERE a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0
        ORDER BY a.bar_kkslide, a.date_process
        ');
        $response = $q->result();
        return $response;

        // $this->db->order_by($this->id, 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('v_obj3fkk2')->result();
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

      function validate1($id, $type){
        if($type == 1) {
            $this->db->where('bar_kkslide', $id);
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