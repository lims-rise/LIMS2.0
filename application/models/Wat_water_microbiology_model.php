<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wat_water_microbiology_model extends CI_Model
{

    public $table = 'obj2b_wat_microby';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('barcode_sample, date_process, water_lab, parent_barcode, sampletype, 
        // total_coliforms, volume_ecoli, comments, id_type2bwat, lab, flag');
        // $this->datatables->from('v_obj2bwat_microby');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('a.barcode_sample, a.date_process, c.lab AS water_lab,
        c.barcode_sample AS parent_barcode, b.sampletype, a.total_coliforms, 
        a.volume_ecoli, a.comments, c.id_type2bwat, a.lab, a.flag');
        $this->datatables->from('obj2b_wat_microby a');
        if ($this->session->userdata('lab') == 1) {
            $this->datatables->join('(SELECT barcode_nitro AS barcode, "BTKL Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_nitro) > 0
            UNION ALL
            SELECT barcode_nitro2 AS barcode, "BBLK Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_nitro2) > 0
            UNION ALL
            SELECT barcode_microbiology AS barcode, "BTKL Micro" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_microbiology) > 0
            UNION ALL
            SELECT barcode_microbiology2 AS barcode, "BBLK Micro" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_microbiology2) > 0
            UNION ALL
            SELECT barcode_rise_lab AS barcode, "RISE Lab" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_rise_lab) > 0 ) c', 'a.barcode_sample = c.barcode', 'left');
        }
        else {
            $this->datatables->join('(SELECT barcode_nitro AS barcode, "WAF Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_nitro) > 0
            UNION ALL
            SELECT barcode_nitro2 AS barcode, "Other Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_nitro2) > 0
            UNION ALL
            SELECT barcode_microbiology AS barcode, "WAF Micro" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_microbiology) > 0
            UNION ALL
            SELECT barcode_microbiology2 AS barcode, "Other Micro" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_microbiology2) > 0
            UNION ALL
            SELECT barcode_rise_lab AS barcode, "RISE Lab" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
            where LENGTH(barcode_rise_lab) > 0 ) c', 'a.barcode_sample = c.barcode', 'left');
        }
        $this->datatables->join('ref_sampletype b', 'c.id_type2bwat = b.id_sampletype', 'left');
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
        if ($this->session->userdata('lab') == 1) {
            $q = $this->db->query('SELECT 
            a.barcode_sample, a.date_process, 
            c.lab AS water_lab,
            c.barcode_sample AS parent_barcode,
            b.sampletype, a.total_coliforms, a.volume_ecoli, a.comments, c.id_type2bwat,
            a.lab, a.flag
            FROM obj2b_wat_microby a
            LEFT JOIN (SELECT barcode_nitro AS barcode, "BTKL Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_nitro) > 0
                UNION ALL
                SELECT barcode_nitro2 AS barcode, "BBLK Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_nitro2) > 0
                UNION ALL
                SELECT barcode_microbiology AS barcode, "BTKL Micro" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_microbiology) > 0
                UNION ALL
                SELECT barcode_microbiology2 AS barcode, "BBLK Micro" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_microbiology2) > 0
                UNION ALL
                SELECT barcode_rise_lab AS barcode, "RISE Lab" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_rise_lab) > 0) c ON a.barcode_sample = c.barcode
            LEFT JOIN ref_sampletype b ON c.id_type2bwat=b.id_sampletype 
            WHERE a.lab = "'.$this->session->userdata('lab').'" 
            AND a.flag = 0
            ORDER BY a.barcode_sample, a.date_process
            ');
        }
        else {
            $q = $this->db->query('SELECT 
            a.barcode_sample, a.date_process, 
            c.lab AS water_lab,
            c.barcode_sample AS parent_barcode,
            b.sampletype, a.total_coliforms, a.volume_ecoli, a.comments, c.id_type2bwat,
            a.lab, a.flag
            FROM obj2b_wat_microby a
            LEFT JOIN (SELECT barcode_nitro AS barcode, "WAF Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_nitro) > 0
                UNION ALL
                SELECT barcode_nitro2 AS barcode, "Other Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_nitro2) > 0
                UNION ALL
                SELECT barcode_microbiology AS barcode, "WAF Micro" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_microbiology) > 0
                UNION ALL
                SELECT barcode_microbiology2 AS barcode, "Other Micro" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_microbiology2) > 0
                UNION ALL
                SELECT barcode_rise_lab AS barcode, "RISE Lab" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_rise_lab) > 0) c ON a.barcode_sample = c.barcode
            LEFT JOIN ref_sampletype b ON c.id_type2bwat=b.id_sampletype 
            WHERE a.lab = "'.$this->session->userdata('lab').'" 
            AND a.flag = 0
            ORDER BY a.barcode_sample, a.date_process
            ');
        }
        $response = $q->result();
        return $response;
        // $this->db->order_by('date_process', 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('v_obj2bwat_microby')->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
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

      function validate1($id, $type){
        if($type == 1) {
            $this->db->where('barcode_sample', $id);
        }
        $this->db->where('flag', '0');
        $q = $this->db->get($this->table);
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