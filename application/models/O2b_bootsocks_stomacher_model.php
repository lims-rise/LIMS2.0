<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O2b_bootsocks_stomacher_model extends CI_Model
{

    public $table = 'obj2b_bs_stomacher';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('barcode_sample, date_conduct, elution_no, barcode_bootsock, elution, elu_comments, barcode_falcon, volume_stomacher, lab, flag');
        $this->datatables->from('obj2b_bs_stomacher');
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
                ".anchor(site_url('o2b_bootsocks_stomacher/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting blood centrifuge : $1 ?\')"'), 'barcode_sample');
        }

        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('barcode_sample, barcode_endetec, barcode_falcon1, volume_falcon1, barcode_falcon2, volume_falcon2, dilution, time_incubation, comments');
        $this->datatables->from('obj2b_subbs_endetec');
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
                ".anchor(site_url('o2b_bootsocks_stomacher/delete_det/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }

        return $this->datatables->generate();
    }

    function subjson2($id) {
        $this->datatables->select('barcode_sample, barcode_colilert, barcode_falcon1, volume_falcon1, barcode_falcon2, volume_falcon2, dilution, time_incubation, comments');
        $this->datatables->from('obj2b_subbs_idexx');
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
                ".anchor(site_url('o2b_bootsocks_stomacher/delete_det/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }

        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        SELECT 
        a.barcode_sample AS barcode_sample, 
        g.date_conduct AS stomacher_date_conduct,
        g.barcode_bootsock AS stomacher_barcode_bootsocks1,
        g.elution_no AS stomacher_elution_number_Micro1,
        g.elution AS stomacher_elution_Micro1,
        g.barcode_falcon AS stomacher_barcode_falcon_Micro1,
        g.volume_stomacher AS stomacher_volume_Micro1,
        o.elution_no AS stomacher_elution_number_Micro2,
        o.elution AS stomacher_elution_Micro2,
        o.barcode_falcon AS stomacher_barcode_falcon_Micro2,
        o.volume_stomacher AS stomacher_volume_Micro2,
        s.barcode_bootsock AS stomacher_barcode_bootsocks2,
        s.elution_no AS stomacher_elution_number_Moisture1,
        s.elution AS stomacher_elution_Moisture1,
        s.barcode_falcon AS stomacher_barcode_falcon_Moisture1,
        s.volume_stomacher AS stomacher_volume_Moisture1,
        t.elution_no AS stomacher_elution_number_Moisture2,
        t.elution AS stomacher_elution_Moisture2,
        t.barcode_falcon AS stomacher_barcode_falcon_Moisture2,
        t.volume_stomacher AS stomacher_volume_Moisture2,
        h.barcode_endetec AS stom_endet_barcode_endetec,
        h.barcode_falcon1 AS stom_endet_barcode_falcon1,
        h.volume_falcon1 AS stom_endet_volume_falcon1,
        h.barcode_falcon2 AS stom_endet_barcode_falcon2,
        h.volume_falcon2 AS stom_endet_volume_falcon2,
        h.dilution AS stom_endet_dilution,
        h.time_incubation AS stom_endet_time_incu_start,
        h.comments AS stom_endet_comments,
        j.barcode_colilert AS stom_idexx_barcode_colilert,
        j.barcode_falcon1 AS stom_idexx_barcode_falcon1,
        j.volume_falcon1 AS stom_idexx_volume_falcon1,
        j.barcode_falcon2 AS stom_idexx_barcode_falcon2,
        j.volume_falcon2 AS stom_idexx_volume_falcon2,
        j.dilution AS stom_idexx_dilution,
        j.time_incubation AS stom_idexx_time_incu_start,
        j.comments AS stom_idexx_comments
        FROM obj2b_receipt a
        LEFT JOIN obj2b_bs_stomacher g ON a.barcode_sample=g.barcode_sample AND g.elution_no="Micro1"
        LEFT JOIN obj2b_bs_stomacher o ON a.barcode_sample=o.barcode_sample AND o.elution_no="Micro2"
        LEFT JOIN obj2b_bs_stomacher s ON a.barcode_sample=s.barcode_sample AND s.elution_no="Moisture1"
        LEFT JOIN obj2b_bs_stomacher t ON a.barcode_sample=t.barcode_sample AND t.elution_no="Moisture2"
        LEFT JOIN obj2b_subbs_endetec h ON a.barcode_sample=h.barcode_sample
        LEFT JOIN obj2b_subbs_idexx j ON a.barcode_sample=j.barcode_sample
        WHERE a.id_type2b = 9
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ');
        $response = $q->result();
        return $response;

        // $this->db->order_by('date_process, id', 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('obj2b_bs_stomacher')->result();
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
        return $this->db->get('obj2b_bs_stomacher')->row();
    }

    function get_by_id_bc($id)
    {
        $this->db->where('id_bc', $id);
        $this->db->where('flag', '0');
        return $this->db->get('obj2b_bs_stomacher')->row();
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
        $this->db->insert('obj2b_subbs_endetec', $data);
    }

    function insert_det2($data)
    {
        $this->db->insert('obj2b_subbs_idexx', $data);
    }
    
    // update data
    function update_det1($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('obj2b_subbs_endetec', $data);
    }

    function update_det2($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('obj2b_subbs_idexx', $data);
    }


    // delete data
    function delete($id)
    {
        $this->db->where('id_bc', $id);
        $this->db->delete('obj2b_bs_stomacher');

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