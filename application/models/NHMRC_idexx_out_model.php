<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class NHMRC_idexx_out_model extends CI_Model
{

    public $table = 'nhmrc_idexx2';
    public $id = 'barcode_colilert';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function json() {
        $this->datatables->select('nhmrc_idexx2.barcode_colilert, nhmrc_idexx2.date_conduct,
            date_format(nhmrc_idexx2.timeout_incubation,"%H:%i") AS timeout_incubation,
            nhmrc_idexx2.time_minutes, nhmrc_idexx2.ecoli_largewells, nhmrc_idexx2.ecoli_smallwells, 
            nhmrc_idexx2.ecoli_mpn, nhmrc_idexx2.coliforms_largewells, 
            nhmrc_idexx2.coliforms_smallwells, nhmrc_idexx2.coliforms_mpn, nhmrc_idexx2.comments, 
            ');
        $this->datatables->from('nhmrc_idexx2');
        $this->datatables->where('nhmrc_idexx2.lab', $this->session->userdata('lab'));
        $this->datatables->where('nhmrc_idexx2.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'nhmrc_idexx2.barcode_colilert');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'nhmrc_idexx2.barcode_colilert');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'barcode_colilert');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $this->db->order_by('date_conduct', 'ASC');
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        return $this->db->get('nhmrc_idexx2')->result();
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


    function data_chart($id1, $id2){
        $q = $this->db->query('
        select mpn FROM obj2b_idexxchart WHERE big = "'.$id1.'" AND small = "'.$id2.'"
        ');        
        $response = $q->result_array();
        return $response;
      }


      function load_dilution($id){
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        $q = $this->db->query('
        SELECT * FROM
        (SELECT barcode_colilert, dilution as dil, date_conduct AS date_cond, time_incubation as time_i, flag
        FROM nhmrc_idexx1
        UNION ALL
        SELECT barcode_colilert2, dilution2 as dil, date_conduct AS date_cond, time_incubation as time_i, flag
        FROM nhmrc_idexx1
        UNION ALL         
        SELECT b.barcode_colilert, b.dilution as dil, a.date_conduct AS date_cond, b.time_incubation as time_i, a.flag 
        FROM nhmrc_bs_stomacher a
        LEFT JOIN nhmrc_subbs_idexx b ON a.barcode_bootsock=b.barcode_sample
        UNION ALL         
        SELECT b.barcode_colilert, b.dilution as dil, a.date_conduct AS date_cond, b.time_incubation as time_i, a.flag 
        FROM nhmrc_sample_prep a
        LEFT JOIN nhmrc_subsd_idexx b ON a.barcode_food=b.barcode_food
        UNION ALL 
        SELECT e.barcode_endidx, e.dilution as dil, e.date_conduct AS date_cond, e.time_incubation as time_i, flag
        FROM nhmrc_blanks e
        WHERE e.blank_type = "IDEXX"
        ) x
        WHERE x.barcode_colilert =  "'.$id.'"
        AND x.flag = 0 
        GROUP BY x.barcode_colilert
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
        SELECT barcode_colilert FROM
        (SELECT barcode_colilert, dilution, time_incubation, flag
        FROM nhmrc_idexx1
        UNION ALL 
        SELECT barcode_colilert2, dilution2, time_incubation, flag
        FROM nhmrc_idexx1
        UNION ALL         
        SELECT barcode_colilert, dilution, time_incubation, flag
        FROM nhmrc_subbs_idexx
        UNION ALL 
        SELECT barcode_colilert, dilution, time_incubation, flag
        FROM nhmrc_subsd_idexx
        UNION ALL 
        SELECT barcode_endidx, dilution, time_incubation, flag
        FROM nhmrc_blanks
        WHERE blank_type = "IDEXX"
        ) x
        WHERE x.barcode_colilert = "'.$id.'"
        AND x.barcode_colilert NOT IN (SELECT barcode_colilert FROM nhmrc_idexx2)
        AND x.flag = 0 
        GROUP BY x.barcode_colilert
        ');        
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

    //   function validate2($id, $id2){
    //     $q = $this->db->query('
    //     SELECT barcodes1, barcode_sample FROM (
    //         SELECT barcode_nitro AS barcodes1, barcode_sample
    //         FROM nhmrc_chemistry
    //         UNION ALL
    //         SELECT barcode_endetec AS barcodes1, barcode_sample
    //         FROM nhmrc_idexx2
    //         UNION ALL
    //         SELECT barcode_colilert AS barcodes1, barcode_sample
    //         FROM nhmrc_idexx1
    //         UNION ALL
    //         SELECT barcode_bootsocks AS barcodes1, barcode_bootsocks AS barcode_sample
    //         FROM nhmrc_bootsocks_before
    //         UNION ALL
    //         SELECT barcode_foil AS barcodes1, barcode_sample
    //         FROM nhmrc_moisture1
    //         UNION ALL
    //         SELECT barcode_falcon AS barcodes1, barcode_sample
    //         FROM nhmrc_bs_stomacher
    //         UNION ALL
    //         SELECT barcode_endetec AS barcodes1, barcode_sample
    //         FROM nhmrc_subbs_endetec
    //         UNION ALL
    //         SELECT barcode_colilert AS barcodes1, barcode_sample
    //         FROM nhmrc_subbs_idexx
    //         UNION ALL
    //         SELECT barcode_tube AS barcodes1, barcode_sample
    //         FROM nhmrc_sediment_prep
    //         UNION ALL
    //         SELECT barcode_endetec AS barcodes1, barcode_sample
    //         FROM nhmrc_subsd_endetec
    //         UNION ALL
    //         SELECT barcode_colilert AS barcodes1, barcode_sample
    //         FROM nhmrc_subsd_idexx) x
    //         WHERE x.barcodes1 = "'.$id.'"
    //              AND x.barcodes1 NOT IN (SELECT barcode_endetec FROM nhmrc_idexx2
    //                                     WHERE barcode_sample = "'.$id2.'")
    //     ');        
    //     $response = $q->result_array();
    //     return $response;
    //   }      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */