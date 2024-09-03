<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wat_water_chemistry_model extends CI_Model
{

    public $table = 'obj2b_chemistry_lab';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('barcode_sample, date_process, water_lab, parent_barcode, sampletype2bwat, ammonia, nitrate, 
        // nitrite, ph, bod, aluminium, barium, iron, chrome, cadmium, manganese, nickel, zinc, copper, lead, cod, tds, tss,
        // phosphate, oilgrease, sulfide, tot_nitrogen, tot_phosphorous, notes, id_type2bwat, lab, flag');
        // $this->datatables->from('v_lab_chemistry');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('a.barcode_sample, d.date_arrival AS date_process, c.lab AS water_lab,
        c.barcode_sample AS parent_barcode, b.sampletype AS sampletype2bwat,
        a.ammonia, a.nitrate, a.nitrite, a.ph, a.bod, a.aluminium, a.barium,
        a.iron, a.chrome, a.cadmium, a.manganese, a.nickel, a.zinc, a.copper,
        a.lead, a.cod, a.tds, a.tss, a.phosphate, a.oilgrease, a.sulfide,
        a.tot_nitrogen, a.tot_phosphorous, a.notes, c.id_type2bwat, a.lab, a.flag');
        $this->datatables->from('obj2b_chemistry_lab a');
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
        $this->datatables->join('obj2b_receipt d', 'c.barcode_sample = d.barcode_sample', 'left');
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
            a.barcode_sample AS barcode_sample,
            d.date_arrival AS date_process,
            c.lab AS water_lab,
            c.barcode_sample AS parent_barcode,
            b.sampletype AS sampletype2bwat,
            a.ammonia AS ammonia,
            a.nitrate AS nitrate,
            a.nitrite AS nitrite,
            a.ph AS ph,
            a.bod AS bod,
            a.aluminium AS aluminium,
            a.barium AS barium,
            a.iron AS iron,
            a.chrome AS chrome,
            a.cadmium AS cadmium,
            a.manganese AS manganese,
            a.nickel AS nickel,
            a.zinc AS zinc,
            a.copper AS copper,
            a.lead AS lead,
            a.cod AS cod,
            a.tds AS tds,
            a.tss AS tss,
            a.phosphate AS phosphate,
            a.oilgrease AS oilgrease,
            a.sulfide AS sulfide,
            a.tot_nitrogen AS tot_nitrogen,
            a.tot_phosphorous AS tot_phosphorous,
            a.notes AS notes,
            c.id_type2bwat AS id_type2bwat,
            a.lab, a.flag
            from obj2b_chemistry_lab a 
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
            left join ref_sampletype b on c.id_type2bwat = b.id_sampletype
            left join obj2b_receipt d on c.barcode_sample = d.barcode_sample
            WHERE a.lab = "'.$this->session->userdata('lab').'" 
            AND a.flag = 0
            ORDER BY a.barcode_sample, a.date_process
            ');
        }
        else {
            $q = $this->db->query('SELECT 
            a.barcode_sample AS barcode_sample,
            d.date_arrival AS date_process,
            c.lab AS water_lab,
            c.barcode_sample AS parent_barcode,
            b.sampletype AS sampletype2bwat,
            a.ammonia AS ammonia,
            a.nitrate AS nitrate,
            a.nitrite AS nitrite,
            a.ph AS ph,
            a.bod AS bod,
            a.aluminium AS aluminium,
            a.barium AS barium,
            a.iron AS iron,
            a.chrome AS chrome,
            a.cadmium AS cadmium,
            a.manganese AS manganese,
            a.nickel AS nickel,
            a.zinc AS zinc,
            a.copper AS copper,
            a.lead AS lead,
            a.cod AS cod,
            a.tds AS tds,
            a.tss AS tss,
            a.phosphate AS phosphate,
            a.oilgrease AS oilgrease,
            a.sulfide AS sulfide,
            a.tot_nitrogen AS tot_nitrogen,
            a.tot_phosphorous AS tot_phosphorous,
            a.notes AS notes,
            c.id_type2bwat AS id_type2bwat,
            a.lab, a.flag
            from obj2b_chemistry_lab a 
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
            left join ref_sampletype b on c.id_type2bwat = b.id_sampletype
            left join obj2b_receipt d on c.barcode_sample = d.barcode_sample
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
        // return $this->db->get('v_lab_chemistry')->result();
    }

    function get_all_conv()
    {
        if ($this->session->userdata('lab') == 1) {
            $q = $this->db->query('SELECT 
            a.barcode_sample AS barcode_sample,
            d.date_arrival AS date_process,
            c.lab AS water_lab,
            c.barcode_sample AS parent_barcode,
            b.sampletype AS sampletype2bwat,
            CASE WHEN c.id_type2bwat NOT IN (11, 15, 16, 17) THEN a.ammonia * 0.8224
                ELSE a.ammonia
            END AS ammonia,
            CASE WHEN c.id_type2bwat IN (11, 15, 16, 17) THEN 
                CASE WHEN a.nitrate * 0.2259 = 0 THEN a.nitrate
                    ELSE a.nitrate * 0.2259
                END
                ELSE a.nitrate
            END AS nitrate,
            CASE WHEN c.id_type2bwat IN (11, 15, 16, 17) THEN 
                CASE WHEN a.nitrite * 0.3045 = 0 THEN a.nitrite
                    ELSE a.nitrite * 0.3045
                END								
                ELSE a.nitrite
            END AS nitrite,
            a.notes AS notes,
            c.id_type2bwat AS id_type2bwat,
            a.lab, a.flag
            from obj2b_chemistry_lab a 
            LEFT JOIN (SELECT barcode_nitro AS barcode, "BTKL Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_nitro) > 0
                UNION ALL
                SELECT barcode_nitro2 AS barcode, "BBLK Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_nitro2) > 0) c ON a.barcode_sample = c.barcode 
            left join ref_sampletype b on c.id_type2bwat = b.id_sampletype
            left join obj2b_receipt d on c.barcode_sample = d.barcode_sample
            WHERE a.flag = 0
				AND c.lab IS NOT NULL
                AND a.lab = "'.$this->session->userdata('lab').'" 
            ORDER BY a.date_process, a.barcode_sample
            ');
        }
        else {
            $q = $this->db->query('SELECT 
            a.barcode_sample AS barcode_sample,
            d.date_arrival AS date_process,
            c.lab AS water_lab,
            c.barcode_sample AS parent_barcode,
            b.sampletype AS sampletype2bwat,
            CASE WHEN c.id_type2bwat NOT IN (11, 15, 16, 17) THEN a.ammonia * 0.8224
                ELSE a.ammonia
            END AS ammonia,
            CASE WHEN c.id_type2bwat IN (11, 15, 16, 17) THEN 
                CASE WHEN a.nitrate * 0.2259 = 0 THEN a.nitrate
                    ELSE a.nitrate * 0.2259
                END
            END AS nitrate,
            CASE WHEN c.id_type2bwat IN (11, 15, 16, 17) THEN 
                CASE WHEN a.nitrite * 0.3045 = 0 THEN a.nitrite
                    ELSE a.nitrite * 0.3045
                END								
            END AS nitrite,
            a.notes AS notes,
            c.id_type2bwat AS id_type2bwat,
            a.lab, a.flag
            from obj2b_chemistry_lab a 
            LEFT JOIN (SELECT barcode_nitro AS barcode, "WAF Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_nitro) > 0
                UNION ALL
                SELECT barcode_nitro2 AS barcode, "Other Chemistry" AS lab, barcode_sample, id_type2bwat FROM obj2b_chemistry
                where LENGTH(barcode_nitro2) > 0) c ON a.barcode_sample = c.barcode 
            left join ref_sampletype b on c.id_type2bwat = b.id_sampletype
            left join obj2b_receipt d on c.barcode_sample = d.barcode_sample
            WHERE a.flag = 0
				AND c.lab IS NOT NULL
                AND a.lab = "'.$this->session->userdata('lab').'" 
            ORDER BY a.date_process, a.barcode_sample
            ');
        }
        $response = $q->result();
        return $response;
        
        // $this->db->order_by('date_process', 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('v_lab_chemistry')->result();
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