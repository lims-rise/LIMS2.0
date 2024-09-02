<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class NHMRC_bootsocks_before_model extends CI_Model
{

    public $table = 'nhmrc_bootsocks_before';
    public $id = 'barcode_bootsocks';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('barcode_bootsocks, date_weighed, bootsock_weight_dry, comments, lab, flag');
        $this->datatables->from('nhmrc_bootsocks_before');
        $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_bootsocks');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_bootsocks');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'barcode_bootsocks');
        }

        return $this->datatables->generate();
    }

    // function subjson($id) {
    //     $this->datatables->select('id_samplelog, barcode_sample, id_receipt, lab, flag');
    //     $this->datatables->from('obj2a_samplepick');
    //     $this->datatables->where('id_receipt', $id);
    //     $this->datatables->where('lab', $this->session->userdata('lab'));
    //     $this->datatables->where('flag', '0');
    //     // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
    //     $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
    //             ".anchor(site_url('NHMRC_bootsocks_before/delete_det/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting this sample detail ?\')"'), 'id_receipt_det');
    //     return $this->datatables->generate();
    // }

    function get_all()
    {
        $this->db->order_by('date_weighed', 'ASC');
        $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        return $this->db->get('nhmrc_bootsocks_before')->result();
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
    //     $this->db->where('id_receipt_det', $id);
    //     return $this->db->get('obj2a_receipt_det')->row();
    // }

    // function get_by_id_rec($id)
    // {
    //     $this->db->where('id_receipt', $id);
    //     return $this->db->get('obj2a_receipt_det')->row();
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

    // function insert_det($data)
    // {
    //     $this->db->insert('obj2a_receipt_det', $data);
    // }
    
    // update data
    // function update_det($id, $data)
    // {
    //     $this->db->where('id_receipt_det', $id);
    //     $this->db->update('obj2a_receipt_det', $data);
    // }


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


    // function getLabtech(){
    //     $response = array();
    //     $this->db->select('*');
    //     $this->db->where('position', 'Lab Tech');
    //     $q = $this->db->get('ref_person');
    //     $response = $q->result_array();
    
    //     return $response;
    //   }

    //   function getAllstaff(){
    //     $response = array();
    //     $this->db->select('*');
    //     $this->db->where('position is not null', NULL);
    //     $q = $this->db->get('ref_person');
    //     $response = $q->result_array();
    
    //     return $response;
    //   }

      function validate1($id, $type){
        if($type == 1) {
            $this->db->where('barcode_bootsocks', $id);
        }
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        $q = $this->db->get('nhmrc_bootsocks_before');
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