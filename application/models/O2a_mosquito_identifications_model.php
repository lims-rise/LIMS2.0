<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O2a_mosquito_identifications_model extends CI_Model
{

    public $table = 'obj2a_identification';
    public $id = 'bar_storagebag';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('bar_storagebag, date_ident, initial, catch_met, no_mosquito, aedes_aegypt_male, aedes_aegypt_female, 
        // aedes_albopictus_male, aedes_albopictus_female, aedes_polynesiensis_male, aedes_polynesiensis_female, 
        // aedes_other_male, aedes_other_female, culex_male, culex_female, culex_sitiens_male, culex_sitiens_female, 
        // culexann_male, culexann_female, culex_other_male, culex_other_female, anopheles_male, anopheles_female,
        // uranotaenia_male, uranotaenia_female, mansonia_male, mansonia_female, other_male, other_female,
        // culex_larvae, aedes_larvae, unidentify, notes, id_person, lab, flag');
        // $this->datatables->from('v_obj2aiden');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('a.bar_storagebag, a.date_ident, b.initial, a.catch_met, a.no_mosquito, a.aedes_aegypt_male, a.aedes_aegypt_female, 
        a.aedes_albopictus_male, a.aedes_albopictus_female, a.aedes_polynesiensis_male, a.aedes_polynesiensis_female, 
        a.aedes_other_male, a.aedes_other_female, a.culex_male, a.culex_female, a.culex_sitiens_male, a.culex_sitiens_female, 
        a.culexann_male, a.culexann_female, a.culex_other_male, a.culex_other_female, a.anopheles_male, a.anopheles_female,
        a.uranotaenia_male, a.uranotaenia_female, a.mansonia_male, a.mansonia_female, a.other_male, a.other_female,
        a.culex_larvae, a.aedes_larvae, a.unidentify, a.notes, a.id_person, a.lab, a.flag');
        $this->datatables->from('obj2a_identification a');
        $this->datatables->join('ref_person b', 'a.id_person = b.id_person', 'left');
        $this->datatables->where('a.lab', $this->session->userdata('lab'));
        $this->datatables->where('a.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'bar_storagebag');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'bar_storagebag');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('o2a_mosquito_identifications/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'bar_storagebag');
        }

        // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        return $this->datatables->generate();
    }

    function get_all()
    {
        $this->db->order_by('date_ident', 'ASC');
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        return $this->db->get('v_obj2aiden')->result();
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

      function validate1($id, $type){
        if($type == 1) {
            $this->db->where('bar_storagebag', $id);
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