<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O3_feces_aliquot_model extends CI_Model
{

    public $table = 'obj3_faliquot';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('barcode_sample, date_process, time_process, initial, cons_stool, color_stool, abnormal, ab_other,
        //                             aliquot1, volume1, cryobox1, aliquot2, volume2, cryobox2,
        //                             aliquot3, volume3, cryobox3, aliquot_zymo, volume_zymo, batch_zymo, cryobox_zymo, comments, id_person, lab, flag');
        // $this->datatables->from('v_obj3faliquot');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('obj3_faliquot.barcode_sample, obj3_faliquot.date_process, obj3_faliquot.time_process, 
        ref_person.initial, obj3_faliquot.cons_stool, obj3_faliquot.color_stool, obj3_faliquot.abnormal, obj3_faliquot.ab_other,
        obj3_faliquot.aliquot1, obj3_faliquot.volume1, obj3_faliquot.cryobox1, obj3_faliquot.aliquot2, obj3_faliquot.volume2, obj3_faliquot.cryobox2,
        obj3_faliquot.aliquot3, obj3_faliquot.volume3, obj3_faliquot.cryobox3, obj3_faliquot.aliquot_zymo, obj3_faliquot.volume_zymo, 
        obj3_faliquot.batch_zymo, obj3_faliquot.cryobox_zymo, obj3_faliquot.comments, obj3_faliquot.id_person, obj3_faliquot.lab, obj3_faliquot.flag');
        $this->datatables->from('obj3_faliquot');
        $this->datatables->join('ref_person', 'obj3_faliquot.id_person = ref_person.id_person', 'left');
        $this->datatables->where('obj3_faliquot.lab', $this->session->userdata('lab'));
        $this->datatables->where('obj3_faliquot.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('o3_feces_aliquot/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('SELECT 
        a.barcode_sample, a.date_process, date_format(a.time_process,"%H:%i") AS time_process,
        b.initial, a.cons_stool, a.color_stool, a.abnormal, a.ab_other, a.aliquot1, a.volume1, a.cryobox1,
        a.aliquot2, a.volume2, a.cryobox2, a.aliquot3, a.volume3, a.cryobox3, a.aliquot_zymo, a.volume_zymo,
        a.batch_zymo, a.cryobox_zymo, a.comments, a.id_person, a.lab, a.flag
        from obj3_faliquot a 
        left join ref_person b on a.id_person = b.id_person 
        WHERE a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0
        ORDER BY a.barcode_sample, a.date_process
        ');
        $response = $q->result();
        return $response;

        // $this->db->order_by($this->id, $this->order);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('v_obj3faliquot')->result();
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
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
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

      function validate1($id, $type){
        if($type == 1) {
            $this->db->where('barcode_sample', $id);
        }
        else if($type == 2) {
            $this->db->where('aliquot1', $id);
        }
        else if($type == 3) {
            $this->db->where('aliquot2', $id);
        }
        else if($type == 4) {
            $this->db->where('aliquot3', $id);
        }
        else if($type == 5) {
            $this->db->where('aliquot_zymo', $id);
        }
        $this->db->where('flag', '0');
        $q = $this->db->get($this->table);
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

    //   function getSampleType(){

    //     $response = array();
    //     // Select record
    //     $this->db->select('*');
    //     $this->db->where('obj', 'O3');
    //     $q = $this->db->get('ref_sampletype');
    //     $response = $q->result_array();
    
    //     return $response;
    //   }
      
}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */