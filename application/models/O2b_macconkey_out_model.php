<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O2b_macconkey_out_model extends CI_Model
{

    public $table = 'obj2b_mac2';
    public $id = 'bar_macconkey';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('obj2b_mac2.bar_macconkey, obj2b_mac2.date_process, obj2b_mac2.time_process, 
        ref_person.initial, obj2b_mac2.bar_macsweep1, obj2b_mac2.cryobox1, obj2b_mac2.id_location_80_1, 
        obj2b_mac2.bar_macsweep2, obj2b_mac2.cryobox2, obj2b_mac2.id_location_80_2, obj2b_mac2.comments, 
        obj2b_mac2.id_person, obj2b_mac2.lab, obj2b_mac2.flag');
        $this->datatables->from('obj2b_mac2');
        $this->datatables->join('ref_person', 'obj2b_mac2.id_person = ref_person.id_person', 'left');
        $this->datatables->where('obj2b_mac2.lab', $this->session->userdata('lab'));
        $this->datatables->where('obj2b_mac2.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'bar_macconkey');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'bar_macconkey');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('O2b_macconkey_out/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'bar_macconkey');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT a.bar_macconkey, a.date_process, a.time_process, b.initial, a.bar_macsweep1, a.cryobox1, 
        concat("F",c.freezer,"-","S",c.shelf,"-","R",c.rack,"-","DRW",c.rack_level) AS location1, 
        a.bar_macsweep2, a.cryobox2, 
        concat("F",d.freezer,"-","S",d.shelf,"-","R",d.rack,"-","DRW",d.rack_level) AS location2, 
        a.comments
        from obj2b_mac2 a 
        left join ref_person b on a.id_person = b.id_person
        left join ref_location_80 c ON a.id_location_80_1 = c.id_location_80 AND c.lab = "'.$this->session->userdata('lab').'"
        left join ref_location_80 d ON a.id_location_80_2 = d.id_location_80 AND d.lab = "'.$this->session->userdata('lab').'"
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
            SELECT * FROM obj2b_mac1
            WHERE bar_macconkey = "'.$id.'"
            AND flag = 0
            AND bar_macconkey NOT IN (SELECT bar_macconkey FROM obj2b_mac2)
            ');        
            }
        else if($type == 2) {
            $q = $this->db->query('
            SELECT * FROM obj2b_mac2
            WHERE bar_macsweep1 = "'.$id.'"
            AND flag = 0
            ');        
                // $this->db->where('bar_macsweep1', $id);
        }
        else if($type == 3) {
            $q = $this->db->query('
            SELECT * FROM obj2b_mac2
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