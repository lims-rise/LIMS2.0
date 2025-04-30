<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class NHMRC_macconkey_out_model extends CI_Model
{

    public $table = 'nhmrc_mac2';
    public $id = 'bar_macconkey';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('nhmrc_mac2.bar_macconkey, nhmrc_mac2.date_process, nhmrc_mac2.time_process, 
        ref_person.initial, nhmrc_mac2.bar_macsweep1, nhmrc_mac2.cryobox1, nhmrc_mac2.id_location_80_1, nhmrc_mac2.bar_macsweep2, 
        nhmrc_mac2.cryobox2, nhmrc_mac2.id_location_80_2, nhmrc_mac2.comments, nhmrc_mac2.id_person, nhmrc_mac2.lab, nhmrc_mac2.flag');
        $this->datatables->from('nhmrc_mac2');
        $this->datatables->join('ref_person', 'nhmrc_mac2.id_person = ref_person.id_person', 'left');
        $this->datatables->where('nhmrc_mac2.lab', $this->session->userdata('lab'));
        $this->datatables->where('nhmrc_mac2.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'bar_macconkey');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'bar_macconkey');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'bar_macconkey');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT a.bar_macconkey, a.date_process, a.time_process, b.initial, a.bar_macsweep1, 
        a.cryobox1, 
        concat("F",fr1.freezer,"-","S",fr1.shelf,"-","R",fr1.rack,"-","DRW",fr1.rack_level) AS mac2_location1,        
        a.bar_macsweep2, a.cryobox2, 
        concat("F",fr2.freezer,"-","S",fr2.shelf,"-","R",fr2.rack,"-","DRW",fr2.rack_level) AS mac2_location2,        
        a.comments
        from nhmrc_mac2 a 
        left join ref_person b on a.id_person = b.id_person
        LEFT JOIN ref_location_80 fr1 ON a.id_location_80_1=fr1.id_location_80 AND fr1.lab = "'.$this->session->userdata('lab').'" 
        LEFT JOIN ref_location_80 fr2 ON a.id_location_80_2=fr2.id_location_80 AND fr2.lab = "'.$this->session->userdata('lab').'" 

        WHERE a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
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
            $q = $this->db->query('
            SELECT * FROM nhmrc_mac1
            WHERE bar_macconkey = "'.$id.'"
            AND flag = 0
            AND bar_macconkey NOT IN (SELECT bar_macconkey FROM nhmrc_mac2)
            ');        
            }
        else if($type == 2) {
            $q = $this->db->query('
            SELECT * FROM nhmrc_mac2
            WHERE bar_macsweep1 = "'.$id.'"
            AND flag = 0
            ');        
                // $this->db->where('bar_macsweep1', $id);
        }
        else if($type == 3) {
            $q = $this->db->query('
            SELECT * FROM nhmrc_mac2
            WHERE bar_macsweep2 = "'.$id.'"
            AND flag = 0
            ');        
            // $this->db->where('bar_macsweep2', $id);
        }
        // $response = $q->result_array();
        // $q = $this->db->get($this->table);
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