<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O3_blood_edta_model extends CI_Model
{

    public $table = 'obj3_edta_aliquots';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('barcode_sample, date_process, initial, hemolysis, barcode_wb, vol_aliquotwb, cryoboxwb, 
        //                             barcode_p1a, vol_aliquot1, cryobox1, barcode_p2a, vol_aliquot2, cryobox2,
        //                             barcode_p3a, vol_aliquot3, cryobox3, packed_cells, cryobox_pc, comments, id_person, lab');
        // $this->datatables->from('v_obj3bedta_al');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('obj3_edta_aliquots.barcode_sample, obj3_edta_aliquots.date_process, ref_person.initial, 
        obj3_edta_aliquots.hemolysis, obj3_edta_aliquots.barcode_wb, obj3_edta_aliquots.vol_aliquotwb, obj3_edta_aliquots.cryoboxwb, 
        obj3_edta_aliquots.barcode_p1a, obj3_edta_aliquots.vol_aliquot1, obj3_edta_aliquots.cryobox1, obj3_edta_aliquots.barcode_p2a, 
        obj3_edta_aliquots.vol_aliquot2, obj3_edta_aliquots.cryobox2, obj3_edta_aliquots.barcode_p3a, obj3_edta_aliquots.vol_aliquot3, 
        obj3_edta_aliquots.cryobox3, obj3_edta_aliquots.packed_cells, obj3_edta_aliquots.cryobox_pc, obj3_edta_aliquots.comments, 
        obj3_edta_aliquots.id_person, obj3_edta_aliquots.lab, obj3_edta_aliquots.flag');
        $this->datatables->from('obj3_edta_aliquots');
        $this->datatables->join('ref_person', 'obj3_edta_aliquots.id_person = ref_person.id_person', 'left');
        $this->datatables->where('obj3_edta_aliquots.lab', $this->session->userdata('lab'));
        $this->datatables->where('obj3_edta_aliquots.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        }
        else {
            // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('o3_blood_edta/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }

        // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('SELECT 
        a.barcode_sample AS barcode_sample,a.date_process AS date_process,b.initial AS initial,a.hemolysis AS hemolysis,a.barcode_wb, a.vol_aliquotwb, a.cryoboxwb, a.barcode_p1a AS barcode_p1a,a.vol_aliquot1 AS vol_aliquot1,a.cryobox1 AS cryobox1,a.barcode_p2a AS barcode_p2a,a.vol_aliquot2 AS vol_aliquot2,a.cryobox2 AS cryobox2,a.barcode_p3a AS barcode_p3a,a.vol_aliquot3 AS vol_aliquot3,a.cryobox3 AS cryobox3,a.packed_cells AS packed_cells,a.cryobox_pc AS cryobox_pc,a.comments AS comments,a.id_person AS id_person, a.lab, a.flag
        from obj3_edta_aliquots a 
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
        // return $this->db->get('v_obj3bedta_al')->result();
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

    function getSampleType(){
        $response = array();
        // Select record
        $this->db->select('*');
        $this->db->where('obj', 'O3');
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_sampletype');
        $response = $q->result_array();
    
        return $response;
      }
      
    function validate1($id, $type){
        if($type == 1) {
            $this->db->where('barcode_sample', $id);
        }
        else if($type == 2) {
            $this->db->where('barcode_wb', $id);
        }
        else if($type == 3) {
            $this->db->where('barcode_p1a', $id);
        }
        else if($type == 4) {
            $this->db->where('barcode_p2a', $id);
        }
        else if($type == 5) {
            $this->db->where('barcode_p3a', $id);
        }
        else if($type == 6) {
            $this->db->where('packed_cells', $id);
        }
        $this->db->where('flag', '0');
        $q = $this->db->get($this->table);
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

    //   function validate2($id){
    //     $this->db->where('barcode_wb', $id);
    //     $q = $this->db->get($this->table);
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