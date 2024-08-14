<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O3_blood_centrifuge_model extends CI_Model
{

    public $table = 'obj3_blood_centrifuge';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('id, date_process, initial, centrifuge_time, comments, id_person, lab');
        // $this->datatables->from('v_obj3bcentrifuge');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('obj3_blood_centrifuge.id, obj3_blood_centrifuge.date_process, ref_person.initial, 
        obj3_blood_centrifuge.centrifuge_time, obj3_blood_centrifuge.comments, obj3_blood_centrifuge.id_person, 
        obj3_blood_centrifuge.lab, obj3_blood_centrifuge.flag');
        $this->datatables->from('obj3_blood_centrifuge');
        $this->datatables->join('ref_person', 'obj3_blood_centrifuge.id_person = ref_person.id_person', 'left');
        $this->datatables->where('obj3_blood_centrifuge.lab', $this->session->userdata('lab'));
        $this->datatables->where('obj3_blood_centrifuge.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id');
        }
        else {
            // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('o3_blood_centrifuge/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting blood centrifuge : $1 ?\')"'), 'id');
        }

        // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        return $this->datatables->generate();
    }

    function subjson($id) {
        $this->datatables->select('barcode_sample, comments, id_bc');
        $this->datatables->from('obj3_blood_centrifuge_det');
        $this->datatables->where('obj3_blood_centrifuge_det.lab', $this->session->userdata('lab'));
        $this->datatables->where('id_bc', $id);
        $this->datatables->where('flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'barcode_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        }
        else {
            // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
            ".anchor(site_url('o3_blood_centrifuge/delete_det/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
    }
        
        // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        return $this->datatables->generate();
    }

    function get_all()
    {

        $q = $this->db->query('SELECT 
        a.id, a.date_process, b.initial,
        date_format(a.centrifuge_time,"%H:%i") AS centrifuge_time,
        a.comments, 
        c.barcode_sample, c.comments as comments_sample,
        a.id_person, a.lab, a.flag
        from obj3_blood_centrifuge a
        left join ref_person b on a.id_person=b.id_person
        left join obj3_blood_centrifuge_det c on a.id=c.id_bc AND c.lab = "'.$this->session->userdata('lab').'" 
        WHERE a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0
        ORDER BY a.id
        ');
        $response = $q->result();
        return $response;

        // $this->db->order_by('date_process, id', $this->order);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('v_obj3bcentrifuge_det')->result();
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
        return $this->db->get('obj3_blood_centrifuge_det')->row();
    }

    function get_by_id_bc($id)
    {
        $this->db->where('id_bc', $id);
        $this->db->where('flag', '0');
        return $this->db->get('obj3_blood_centrifuge_det')->row();
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
        $this->db->insert('obj3_blood_centrifuge_det', $data);
    }
    
    // update data
    function update_det($id, $data)
    {
        $this->db->where('barcode_sample', $id);
        $this->db->update('obj3_blood_centrifuge_det', $data);
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
        $this->db->where('barcode_sample', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        $q = $this->db->get('obj3_blood_centrifuge_det');
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