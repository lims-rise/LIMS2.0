<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class NHMRC_sample_prep_model extends CI_Model
{

    public $table = 'nhmrc_sample_prep';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('barcode_sample, date_conduct, elution_no, barcode_food, elution, 
        elu_comments, food_weight, food_comments, lab, flag');
        $this->datatables->from('nhmrc_sample_prep');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('flag', '0');

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

    function subjson2($id) {
        $this->datatables->select('barcode_food, barcode_colilert, barcode_falcon1, volume_falcon1, barcode_falcon2, volume_falcon2, dilution, time_incubation, comments');
        $this->datatables->from('nhmrc_subsd_idexx');
        $this->datatables->where('barcode_food', $id);
        $this->datatables->where('flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_food');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det2 btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_food');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det2 btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".'<button type="button" class="btn_delete_detail btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'barcode_food');
        }

        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT b.barcode_sample, d.sampletype, 
        a.date_conduct, a.elution_no, a.barcode_food, a.elution, a.elu_comments, a.food_weight, 
        c.barcode_colilert, c.barcode_falcon1, c.volume_falcon1, c.barcode_falcon2, c.volume_falcon2, 
        c.dilution, c.time_incubation, c.comments
        FROM nhmrc_receipt b
        LEFT JOIN nhmrc_sample_prep a ON b.barcode_sample=a.barcode_sample
        LEFT JOIN nhmrc_subsd_idexx c ON a.barcode_food=c.barcode_food
        LEFT JOIN ref_sampletype d ON b.id_type2b=d.id_sampletype
        WHERE b.id_type2b = 23
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ');
        $response = $q->result();
        return $response;

        // $this->db->order_by('date_process, id', 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('nhmrc_sample_prep')->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    function get_by_id_detail($id)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->where('flag', '0');
        return $this->db->get('nhmrc_sample_prep')->row();
    }

    // function get_by_id_bc($id)
    // {
    //     $this->db->where('id_bc', $id);
    //     $this->db->where('flag', '0');
    //     return $this->db->get('nhmrc_sample_prep')->row();
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

    function insert_det2($data)
    {
        $this->db->insert('nhmrc_subsd_idexx', $data);
    }
    
    // update data
    // function update_det1($id, $data)
    // {
    //     $this->db->where('barcode_sample', $id);
    //     $this->db->update('nhmrc_subsd_endetec', $data);
    // }

    function update_det2($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('nhmrc_subsd_idexx', $data);
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

      function validate1($id){
        $this->db->where('barcode_sample', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get('nhmrc_bs_stomacher');
        $q = $this->db->get('nhmrc_sample_prep');
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

    //   function validate2($id){
    //     $this->db->where('A1', $id);
    //     // $this->db->where('lab', $this->session->userdata('lab'));
    //     $q = $this->db->get('v_check_bs2');
    //     $response = $q->result_array();
    //     return $response;
    //     // return $this->db->get('ref_location_80')->row();
    //   }      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */