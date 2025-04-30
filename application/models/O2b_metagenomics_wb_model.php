<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O2b_metagenomics_wb_model extends CI_Model
{

    public $table = 'obj2b_metagenomics';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    // date_format(obj2b_metagenomics.time_started,"%H:%i") AS time_started,
    // date_format(obj2b_metagenomics.time_finished,"%H:%i") AS time_finished,

    // datatables
    function json() {
        $this->datatables->select('obj2b_metagenomics.barcode_sample, obj2b_metagenomics.barcode_falcon2, obj2b_metagenomics.date_conduct, obj2b_metagenomics.volume_filtered,
        date_format(obj2b_metagenomics.time_started,"%H:%i") AS time_started,
        date_format(obj2b_metagenomics.time_finished,"%H:%i") AS time_finished,
            obj2b_metagenomics.time_minutes, obj2b_metagenomics.barcode_dna_bag, obj2b_metagenomics.barcode_storage,
        concat("F",ref_location_80.freezer,"-","S",ref_location_80.shelf,"-","R",ref_location_80.rack,"-","DRW",ref_location_80.rack_level) AS location,
        obj2b_metagenomics.comments, obj2b_metagenomics.id_location_80, obj2b_metagenomics.lab, obj2b_metagenomics.flag
        ');
        $this->datatables->from('obj2b_metagenomics');
        $this->datatables->join('ref_location_80', 'obj2b_metagenomics.id_location_80 = ref_location_80.id_location_80 AND ref_location_80.lab = '.$this->session->userdata('lab') , 'left');
        $this->datatables->where('obj2b_metagenomics.lab', $this->session->userdata('lab'));
        $this->datatables->where('obj2b_metagenomics.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('O2b_metagenomics_wb/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT a.barcode_sample, a.barcode_falcon2, a.date_conduct, a.volume_filtered, a.time_started, a.time_finished, a.time_minutes, a.barcode_dna_bag,
        a.barcode_storage, concat("F",b.freezer,"-","S",b.shelf,"-","R",b.rack,"-","DRW",b.rack_level) AS Location, a.comments
        from obj2b_metagenomics a 
        left join ref_location_80 b on a.id_location_80 = b.id_location_80 and b.lab = "'.$this->session->userdata('lab').'"
        WHERE a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ');
        $response = $q->result();
        return $response;    
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
        SELECT barcode_sample, stype, vol FROM
        (SELECT x.barcode_sample, x.stype, x.volstom
            -IFNULL(b.volume_falcon1, 0)
            -IFNULL(b.volume_falcon2, 0)
            -IFNULL(c.volume, 0) as vol
         FROM
        (SELECT a.barcode_falcon AS barcode_sample, "Bootsocks" as stype, 
            IFNULL(SUM(a.volume_stomacher), 0) AS volstom, a.barcode_bootsock
                FROM obj2b_bs_stomacher a
            WHERE barcode_bootsock IN (SELECT barcode_bootsock 
            FROM obj2b_bs_stomacher 
            WHERE elution_no = "Micro1")
            AND a.flag = 0 
            GROUP BY barcode_bootsock) x
        LEFT JOIN obj2b_subbs_idexx b ON x.barcode_bootsock = b.barcode_sample
        LEFT JOIN obj2b_mac1 c ON x.barcode_sample = c.barcode_sample
        WHERE LENGTH(x.barcode_sample) > 0
        UNION ALL
        SELECT barcode_sample, "Water" as stype, 0 as vol 
        FROM obj2b_receipt 
        WHERE id_type2b IN (6)
        AND flag = 0) y
        WHERE y.barcode_sample = "'.$id.'"
        AND y.barcode_sample NOT IN (SELECT barcode_sample FROM obj2b_metagenomics)
        ');        
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

      function validatedna($id){
        $q = $this->db->query('
        SELECT cryobarcode, barcode_sample FROM (
        SELECT barcode_dna1 AS cryobarcode, barcode_sample
        FROM obj2b_meta_sediment
        WHERE flag = 0 
        UNION ALL
        SELECT barcode_dna2 AS cryobarcode, barcode_sample
        FROM obj2b_meta_sediment
        WHERE flag = 0 
        UNION ALL
        SELECT barcode_dna_bag AS cryobarcode, barcode_sample
        FROM obj2b_metagenomics
        WHERE flag = 0) x
        WHERE x.cryobarcode = "'.$id.'"       
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