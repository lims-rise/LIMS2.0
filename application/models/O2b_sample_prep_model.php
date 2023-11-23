<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O2b_sample_prep_model extends CI_Model
{

    public $table = 'obj2b_sediment_prep';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('barcode_sample, date_conduct, elution, elu_comments, barcode_tube, subsample_wet, lab, flag');
        $this->datatables->from('obj2b_sediment_prep');
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
                ".anchor(site_url('O2b_sample_prep/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting blood centrifuge : $1 ?\')"'), 'barcode_sample');
        }

        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('barcode_sample, barcode_endetec, volume_falcon, dilution, time_incubation, comments');
        $this->datatables->from('obj2b_subsd_endetec');
        $this->datatables->where('barcode_sample', $id);
        $this->datatables->where('flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('O2b_sample_prep/delete_det/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }

        return $this->datatables->generate();
    }

    function subjson2($id) {
        $this->datatables->select('barcode_sample, barcode_colilert, volume, dilution, time_incubation, comments');
        $this->datatables->from('obj2b_subsd_idexx');
        $this->datatables->where('barcode_sample', $id);
        $this->datatables->where('flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det2 btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det2 btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('O2b_sample_prep/delete_det/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }

        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT a.barcode_sample, a.date_conduct, a.elution, a.elu_comments, a.barcode_tube, a.subsample_wet, 
        b.barcode_endetec, b.volume_falcon, b.dilution as end_dilution, b.time_incubation as end_time_incubation, b.comments as end_comments, c.barcode_colilert,
        c.volume, c.dilution, c.time_incubation, c.comments
        FROM obj2b_sediment_prep a
        LEFT JOIN obj2b_subsd_endetec b ON a.barcode_sample=b.barcode_sample
        LEFT JOIN obj2b_subsd_idexx c ON a.barcode_sample=c.barcode_sample
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ');
        $response = $q->result();
        return $response;

        // $this->db->order_by('date_process, id', 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('obj2b_sediment_prep')->result();
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
        return $this->db->get('obj2b_sediment_prep')->row();
    }

    function get_by_id_bc($id)
    {
        $this->db->where('id_bc', $id);
        $this->db->where('flag', '0');
        return $this->db->get('obj2b_sediment_prep')->row();
    }

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

    function insert_det1($data)
    {
        $this->db->insert('obj2b_subsd_endetec', $data);
    }

    function insert_det2($data)
    {
        $this->db->insert('obj2b_subsd_idexx', $data);
    }
    
    // update data
    function update_det1($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('obj2b_subsd_endetec', $data);
    }

    function update_det2($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('obj2b_subsd_idexx', $data);
    }


    // delete data
    function delete($id)
    {
        $this->db->where('id_bc', $id);
        $this->db->delete('obj3_blood_centrifuge_det');

        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    // delete detail
    function delete_detail($id)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->delete('obj3_blood_centrifuge_det');
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
        $this->db->where('A1', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get('obj2b_bs_stomacher');
        $q = $this->db->get('v_check_bs');
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