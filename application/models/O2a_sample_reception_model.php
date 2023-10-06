<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O2a_sample_reception_model extends CI_Model
{

    public $table = 'obj2a_receipt';
    public $id = 'id_receipt';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_receipt, date_receipt, delivered, received, sample_type, id_delivered, id_received, lab, flag');
        $this->datatables->from('v_obj2arecept');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('flag', '0');
        // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('o2a_sample_reception/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting O2A sample reception : $1 ?\')"'), 'id_receipt');
        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('id_receipt_det, barcode_sample, id_receipt, lab, flag');
        $this->datatables->from('obj2a_receipt_det');
        $this->datatables->where('id_receipt', $id);
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('flag', '0');
        // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('o2a_sample_reception/delete_det/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting this sample detail ?\')"'), 'id_receipt_det');
        return $this->datatables->generate();
    }

    function get_all()
    {
        $q = $this->db->query('
        select b.barcode_sample, a.date_receipt, c.initial AS deli_by, d.initial AS rec_by, a.sample_type
        from obj2a_receipt a 
        LEFT JOIN obj2a_receipt_det b ON a.id_receipt = b.id_receipt
        LEFT JOIN ref_person c ON a.id_delivered = c.id_person
        LEFT JOIN ref_person d ON a.id_received = d.id_person
        WHERE a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_receipt, A.id_receipt
        ');        
        $response = $q->result();
        return $response;

        // $this->db->order_by('date_receipt, id_receipt', 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('v_obj2arecept')->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    function get_by_id_detail($id)
    {
        $this->db->where('id_receipt_det', $id);
        $this->db->where('flag', '0');
        return $this->db->get('obj2a_receipt_det')->row();
    }

    function get_by_id_rec($id)
    {
        $this->db->where('id_receipt', $id);
        $this->db->where('flag', '0');
        return $this->db->get('obj2a_receipt_det')->row();
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

    function insert_det($data)
    {
        $this->db->insert('obj2a_receipt_det', $data);
    }
    
    // update data
    function update_det($id, $data)
    {
        $this->db->where('id_receipt_det', $id);
        $this->db->update('obj2a_receipt_det', $data);
    }


    // // delete data
    // function delete($id)
    // {
    //     $this->db->where('id_bc', $id);
    //     $this->db->delete('obj2a_receipt_det');

    //     $this->db->where($this->id, $id);
    //     $this->db->delete($this->table);
    // }

    // // delete detail
    // function delete_detail($id)
    // {
    //     $this->db->where('barcode_sample', $id);
    //     $this->db->delete('obj2a_receipt_det');
    // }


    function getLabtech(){
        $response = array();
        $this->db->select('*');
        $this->db->where('position', 'Lab Tech');
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_person');
        $response = $q->result_array();
    
        return $response;
      }

      function getAllstaff(){
        $response = array();
        $this->db->select('*');
        $this->db->where('position is not null', NULL);
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_person');
        $response = $q->result_array();
    
        return $response;
      }

      function validate1($id){
        $this->db->where('barcode_sample', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        $q = $this->db->get('obj2a_receipt_det');
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