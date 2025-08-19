<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class NHMRC_metagenomics_food_model extends CI_Model
{

    public $table = 'nhmrc_meta_food';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    // date_format(nhmrc_meta_food.time_started,"%H:%i") AS time_started,
    // date_format(nhmrc_meta_food.time_finished,"%H:%i") AS time_finished,

    // datatables
    function json() {
        $this->datatables->select('a.barcode_sample, a.date_conduct, 
        a.barcode_dna1, a.weight_sub1, a.barcode_storage1, a.position_tube1,
        concat("F",b.freezer,"-","S",b.shelf,"-","R",b.rack,"-","DRW",b.rack_level) AS location1, 
        a.barcode_dna2, a.weight_sub2, a.barcode_storage2, a.position_tube2, 
        concat("F",c.freezer,"-","S",c.shelf,"-","R",c.rack,"-","DRW",c.rack_level) AS location2,
        a.comments, a.id_location_801, a.id_location_802, a.id_freezer1, a.id_freezer2, a.lab, a.flag
        ');
        $this->datatables->from('nhmrc_meta_food a');
        $this->datatables->join('freezer_in g', 'a.id_freezer1 = g.id AND g.lab = '.$this->session->userdata('lab') , 'left');
        $this->datatables->join('ref_location_80 b', 'g.id_location_80 = b.id_location_80 AND b.lab = '.$this->session->userdata('lab') , 'left');
        $this->datatables->join('freezer_in h', 'a.id_freezer2 = h.id AND h.lab = '.$this->session->userdata('lab') , 'left');
        $this->datatables->join('ref_location_80 c', 'h.id_location_80 = c.id_location_80 AND b.lab = '.$this->session->userdata('lab') , 'left');
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
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'barcode_sample');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT a.barcode_sample, a.date_conduct, a.barcode_dna1, a.weight_sub1, a.barcode_storage1, a.position_tube1,
        concat("F",b.freezer,"-","S",b.shelf,"-","R",b.rack,"-","DRW",b.rack_level) AS Location_tube1,
        a.barcode_dna2, a.weight_sub2, a.barcode_storage2, a.position_tube2,
        concat("F",c.freezer,"-","S",c.shelf,"-","R",c.rack,"-","DRW",c.rack_level) AS Location_tube2,
        a.comments
        from nhmrc_meta_food a 
        left join freezer_in g on a.id_freezer1 = g.id and g.lab = "'.$this->session->userdata('lab').'"
        left join ref_location_80 b on g.id_location_80 = b.id_location_80 and b.lab = "'.$this->session->userdata('lab').'"
        left join freezer_in h on a.id_freezer2 = h.id and h.lab = "'.$this->session->userdata('lab').'"
        left join ref_location_80 c on h.id_location_80 = c.id_location_80 and c.lab = "'.$this->session->userdata('lab').'"
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
    
    function insert_freezer($data)
    {
        $this->db->insert('freezer_in', $data);
    }    
        
    function update_freezer($id_f, $data)
    {
        $this->db->where('id', $id_f);
        $this->db->update('freezer_in', $data);
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

      function get_id_freezer($id_freezer){
        $q = $this->db->query('
            SELECT MAX(id) AS id_freezer FROM freezer_in
            WHERE barcode_sample = "'.$id_freezer.'"
            GROUP BY barcode_sample
        ');        
        return $q->row()->id_freezer;
      }  

      function validate1($id){
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        // WHERE barcode_falcon = "'.$id.'"

        $q = $this->db->query('
        SELECT barcode_sample FROM nhmrc_receipt 
        WHERE barcode_sample = "'.$id.'"
        AND id_type2b IN (23)
        AND barcode_sample NOT IN (SELECT barcode_sample FROM nhmrc_meta_food)
        AND flag = 0 
        ');        
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

      function validatedna($id){
        $q = $this->db->query('
        SELECT bar_s2 FROM v_all_s2
        WHERE bar_s2 = "'.$id.'"       
        ');        
        $response = $q->result_array();
        return $response;
      }   

      function validate2($id){
        $q = $this->db->query('
        SELECT cryobarcode, barcode_sample FROM (
            SELECT barcode_p1a AS cryobarcode, barcode_sample
            FROM obj3_edta_aliquots
            WHERE flag = 0 
            UNION ALL
            SELECT barcode_p2a AS cryobarcode, barcode_sample
            FROM obj3_edta_aliquots
            WHERE flag = 0 
            UNION ALL
            SELECT barcode_p3a AS cryobarcode, barcode_sample
            FROM obj3_edta_aliquots
            WHERE flag = 0 
            UNION ALL
            SELECT packed_cells AS cryobarcode, barcode_sample
            FROM obj3_edta_aliquots
            WHERE flag = 0 
            UNION ALL
            SELECT barcode_sst1 AS cryobarcode, barcode_sample
            FROM obj3_sst_aliquots
            WHERE flag = 0 
            UNION ALL
            SELECT barcode_sst2 AS cryobarcode, barcode_sample
            FROM obj3_sst_aliquots
            WHERE flag = 0 
            UNION ALL
            SELECT barcode_wb AS cryobarcode, barcode_sample
            FROM obj3_edta_wholeblood
            WHERE flag = 0 
            UNION ALL
            SELECT aliquot1 AS cryobarcode, barcode_sample
            FROM obj3_faliquot
            WHERE flag = 0 
            UNION ALL
            SELECT aliquot2 AS cryobarcode, barcode_sample
            FROM obj3_faliquot
            WHERE flag = 0 
            UNION ALL
            SELECT aliquot3 AS cryobarcode, barcode_sample
            FROM obj3_faliquot
            WHERE flag = 0 
            UNION ALL
            SELECT aliquot_zymo AS cryobarcode, barcode_sample
            FROM obj3_faliquot
            WHERE flag = 0 
            UNION ALL
            SELECT bar_macsweep1 AS cryobarcode, bar_macconkey AS barcode_sample
            FROM obj3_fmac2
            WHERE flag = 0 
            UNION ALL
            SELECT bar_macsweep2 AS cryobarcode, bar_macconkey AS barcode_sample
            FROM obj3_fmac2
            WHERE flag = 0 
            UNION ALL
            SELECT barcode_dna1 AS cryobarcode, barcode_sample
            FROM nhmrc_meta_food
            WHERE flag = 0 
            UNION ALL
            SELECT barcode_dna2 AS cryobarcode, barcode_sample
            FROM nhmrc_meta_food
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