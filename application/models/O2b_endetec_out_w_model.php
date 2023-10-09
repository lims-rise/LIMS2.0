<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O2b_endetec_out_w_model extends CI_Model
{

    public $table = 'obj2b_endetec2';
    public $id = 'barcode_endetec';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('obj2b_endetec2.barcode_endetec, obj2b_endetec2.date_conduct, obj2b_endetec2.time_ecoli, 
        obj2b_endetec2.volume_ecoli, obj2b_endetec2.ecoli_cfu, obj2b_endetec2.total_coliforms, obj2b_endetec2.total_coli_cfu, 
        obj2b_endetec2.comments, obj2b_endetec2.lab, obj2b_endetec2.flag, obj2b_endetec1.date_conduct AS date_conduct_in, 
        obj2b_endetec1.time_incubation AS time_incubation_in, obj2b_endetec1.dilution AS dilution_in');
        $this->datatables->from('obj2b_endetec2');
        $this->datatables->join('obj2b_endetec1', 'obj2b_endetec2.barcode_endetec = obj2b_endetec1.barcode_endetec', 'left');
        $this->datatables->where('obj2b_endetec2.lab', $this->session->userdata('lab'));
        $this->datatables->where('obj2b_endetec2.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'obj2b_endetec2.barcode_endetec');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'obj2b_endetec2.barcode_endetec');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('O2b_endetec_out_w/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'obj2b_endetec2.barcode_endetec');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $this->db->order_by($this->id, 'ASC');
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        return $this->db->get('obj2b_endetec2')->result();
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

      function validate1($id){
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        $q = $this->db->query('
        SELECT * FROM
        (SELECT barcode_endetec AS barcode, date_conduct AS date, time_incubation AS time, dilution AS dil, flag 
        FROM obj2b_endetec1 
        UNION ALL
        SELECT a.barcode_endetec AS barcode, b.date_conduct AS date, a.time_incubation AS time, a.dilution AS dil, flag
        FROM obj2b_subbs_endetec a
        LEFT JOIN obj2b_bs_stomacher b ON a.barcode_sample=b.barcode_bootsock
        UNION ALL
        SELECT a.barcode_endetec AS barcode, b.date_conduct AS date, a.time_incubation AS time, a.dilution AS dil, flag
        FROM obj2b_subsd_endetec a
        LEFT JOIN obj2b_sediment_prep b ON a.barcode_sample=b.barcode_sample
        UNION ALL
        SELECT barcode_endidx AS barcode, date_conduct AS date, time_incubation AS time, dilution AS dil, flag
        FROM obj2b_blanks WHERE blank_type="Endetec") x
        WHERE x.barcode NOT IN (SELECT barcode_endetec FROM obj2b_endetec2)
        AND x.barcode = "'.$id.'"
        AND x.flag = 0
        ');        
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

    //   function validate2($id, $id2){
    //     $q = $this->db->query('
    //     SELECT barcodes1, barcode_sample FROM (
    //         SELECT barcode_nitro AS barcodes1, barcode_sample
    //         FROM obj2b_chemistry
    //         UNION ALL
    //         SELECT barcode_endetec AS barcodes1, barcode_sample
    //         FROM obj2b_endetec2
    //         UNION ALL
    //         SELECT barcode_colilert AS barcodes1, barcode_sample
    //         FROM obj2b_idexx1
    //         UNION ALL
    //         SELECT barcode_bootsocks AS barcodes1, barcode_bootsocks AS barcode_sample
    //         FROM obj2b_bootsocks_before
    //         UNION ALL
    //         SELECT barcode_foil AS barcodes1, barcode_sample
    //         FROM obj2b_moisture1
    //         UNION ALL
    //         SELECT barcode_falcon AS barcodes1, barcode_sample
    //         FROM obj2b_bs_stomacher
    //         UNION ALL
    //         SELECT barcode_endetec AS barcodes1, barcode_sample
    //         FROM obj2b_subbs_endetec
    //         UNION ALL
    //         SELECT barcode_colilert AS barcodes1, barcode_sample
    //         FROM obj2b_subbs_idexx
    //         UNION ALL
    //         SELECT barcode_tube AS barcodes1, barcode_sample
    //         FROM obj2b_sediment_prep
    //         UNION ALL
    //         SELECT barcode_endetec AS barcodes1, barcode_sample
    //         FROM obj2b_subsd_endetec
    //         UNION ALL
    //         SELECT barcode_colilert AS barcodes1, barcode_sample
    //         FROM obj2b_subsd_idexx) x
    //         WHERE x.barcodes1 = "'.$id.'"
    //              AND x.barcodes1 NOT IN (SELECT barcode_endetec FROM obj2b_endetec2
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