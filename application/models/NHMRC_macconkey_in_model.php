<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class NHMRC_macconkey_in_model extends CI_Model
{

    public $table = 'nhmrc_mac1';
    public $id = 'bar_macconkey';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('nhmrc_mac1.bar_macconkey, nhmrc_mac1.barcode_sample, nhmrc_mac1.barcode_falcon2, 
        nhmrc_mac1.date_process, nhmrc_mac1.time_process, ref_person.initial, nhmrc_mac1.volume, nhmrc_mac1.comments, nhmrc_mac1.lab, nhmrc_mac1.flag, nhmrc_mac1.id_person');
        $this->datatables->from('nhmrc_mac1');
        $this->datatables->join('ref_person', 'nhmrc_mac1.id_person = ref_person.id_person', 'left');
        $this->datatables->where('nhmrc_mac1.lab', $this->session->userdata('lab'));
        $this->datatables->where('nhmrc_mac1.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'bar_macconkey');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'bar_macconkey');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('NHMRC_macconkey_in/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'bar_macconkey');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT a.bar_macconkey, a.barcode_sample, a.barcode_falcon2, a.date_process, a.time_process, 
        b.initial, a.volume, a.comments
        from nhmrc_mac1 a 
        left join ref_person b on a.id_person = b.id_person
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
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_person');
        $response = $q->result_array();
        return $response;
      }


    function load_stype($id){
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        $q = $this->db->query('
        SELECT sampletype FROM
        (
        SELECT a.barcode_sample AS "barcode_sample", b.sampletype AS "sampletype" 
          FROM nhmrc_receipt a
          LEFT JOIN ref_sampletype b ON a.id_type2b=b.id_sampletype
          WHERE a.id_type2b not IN (7,9)
          AND a.flag = 0
        UNION ALL
        SELECT barcode_tube AS "barcode_sample", "Sediment" AS "sampletype" 
        FROM nhmrc_sediment_prep
        WHERE flag = 0
        UNION ALL
        SELECT barcode_falcon AS "barcode_sample", "Bootsocks" AS "sampletype" 
        FROM nhmrc_bs_stomacher
        WHERE flag = 0
        ) x
        WHERE barcode_sample = "'.$id.'"
        ');        
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }      


      function validate1($id){
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        $q = $this->db->query('
        SELECT sampletype FROM
        (
        SELECT a.barcode_sample AS "barcode_sample", b.sampletype AS "sampletype" FROM nhmrc_receipt a
          LEFT JOIN ref_sampletype b ON a.id_type2b=b.id_sampletype
          WHERE a.id_type2b not IN (7,9)
          AND (a.png_control <> "Yes" OR a.png_control is null)
          AND a.flag = 0
        UNION ALL
        SELECT barcode_tube AS "barcode_sample", "Sediment" AS "sampletype" 
        FROM nhmrc_sediment_prep
        WHERE flag = 0
        UNION ALL
        SELECT barcode_falcon AS "barcode_sample", "Bootsocks" AS "sampletype" 
        FROM nhmrc_bs_stomacher
        WHERE flag = 0
        ) x
        WHERE barcode_sample = "'.$id.'" 
        AND barcode_sample NOT IN (SELECT barcode_sample FROM nhmrc_mac1)    
        ');        
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

      function validate2($id){
        $q = $this->db->query('
        SELECT bar_macconkey FROM nhmrc_mac1
        WHERE bar_macconkey = "'.$id.'"
        AND flag = 0
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