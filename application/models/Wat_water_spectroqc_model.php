<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Wat_water_spectroqc_model extends CI_Model
{

    public $table = 'obj2b_spectro_crm';
    public $id = 'id_spec';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('obj2b_spectro_crm.id_spec, obj2b_spectro_crm.date_spec, 
        ref_person.initial, obj2b_spectro_crm.chem_parameter, obj2b_spectro_crm.mixture_name, 
        obj2b_spectro_crm.sample_no, obj2b_spectro_crm.lot_no, obj2b_spectro_crm.date_expired, 
        obj2b_spectro_crm.cert_value, obj2b_spectro_crm.uncertainty, obj2b_spectro_crm.notes, 
        obj2b_spectro_crm.id_person, obj2b_spectro_crm.lab, obj2b_spectro_crm.flag');
        $this->datatables->from('obj2b_spectro_crm');
        $this->datatables->join('ref_person', 'obj2b_spectro_crm.id_person = ref_person.id_person', 'left');
        $this->datatables->where('obj2b_spectro_crm.lab', $this->session->userdata('lab'));
        $this->datatables->where('obj2b_spectro_crm.flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', anchor(site_url('wat_water_spectroqc/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')), 'id_spec');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', anchor(site_url('wat_water_spectroqc/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-info btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>', 'id_spec');
        }
        else {
            $this->datatables->add_column('action', anchor(site_url('wat_water_spectroqc/read/$1'),'<i class="fa fa-th-list" aria-hidden="true"></i>', array('class' => 'btn btn-warning btn-sm')) ."
                ".'<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_spec');
        }
        return $this->datatables->generate();
    }

    function subjson($id) {
      $this->datatables->select('id_dspec, id_spec, duplication, result, trueness, 
      bias_method, result2, lab, flag');
      $this->datatables->from('obj2b_spectro_crm_det');
      $this->datatables->where('lab', $this->session->userdata('lab'));
      $this->datatables->where('flag', '0');
      $this->datatables->where('id_spec', $id);
      $lvl = $this->session->userdata('id_user_level');
      if ($lvl == 7){
          $this->datatables->add_column('action', '', 'id_spec');
      }
      else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_spec');
      }
      else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit_det btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>'." 
                ".'<button type="button" class="btn_delete_detail btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_spec');
        }
      return $this->datatables->generate();
  }

    function get_all()
    {
        $q = $this->db->query('SELECT a.id_spec, a.date_spec, c.initial, a.chem_parameter, a.mixture_name, a.sample_no, 
        a.lot_no, a.date_expired, a.cert_value, a.uncertainty, a.notes, a.tot_result, a.tot_trueness,
        a.tot_bias, a.avg_result, a.avg_trueness, a.avg_bias, a.sd, a.rsd, a.cv_horwits, a.cv,
        a.prec, a.accuracy, a.bias, b.id_dspec, b.duplication, b.result, b.trueness, b.bias_method, b.result2 
        FROM obj2b_spectro_crm a
        LEFT JOIN obj2b_spectro_crm_det b ON a.id_spec=b.id_spec
        LEFT JOIN ref_person c ON a.id_person = c.id_person    
        WHERE a.lab="'.$this->session->userdata('lab').'"
        AND a.flag = 0 
        ');        
        $response = $q->result();
        return $response;

        // $this->db->order_by($this->id, $this->order);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('obj2b_spectro_crm_det')->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        return $this->db->get($this->table)->row();
    }

    function get_detail($id)
    {

      $response = array();
      $this->db->select('*');
      $this->db->where('id_spec', $id);
      $this->db->where('lab', $this->session->userdata('lab'));
      $this->db->where('flag', '0');
      $q = $this->db->get('v_spectro');
      $response = $q->row();
  
      return $response;


        // $this->db->where('id_spec', $id_spec);
        // $this->db->where('flag', '0');
        // // $this->db->where('lab', $this->session->userdata('lab'));
        // return $this->db->get('obj2b_spectro_crm')->row();
    }

    function get_rep($id)
    {
        $q = $this->db->query('SELECT a.id_spec, a.date_spec, b.realname, a.chem_parameter, 
        IF(a.chem_parameter="Phosphate","Phosphorus",
        IF(a.chem_parameter="Nitrate","Nitrogen",
        IF(a.chem_parameter="Nitrite","Nitrogen","Nitrogen"))) AS chem2,
        IF(a.chem_parameter="Phosphate","PO4-P",
        IF(a.chem_parameter="Nitrate","NO3-N",
        IF(a.chem_parameter="Nitrite","NO2-N","NH3-N"))) AS chem3,
        a.mixture_name, a.sample_no, a.lot_no, a.date_expired, a.cert_value, a.uncertainty, a.notes, 
        a.tot_result, a.tot_trueness, a.tot_bias, a.avg_result, a.avg_trueness, a.avg_bias, a.sd, a.rsd, 
        a.cv_horwits, a.cv, a.prec, a.accuracy, a.bias
        FROM obj2b_spectro_crm a
        LEFT JOIN ref_person b ON a.id_person=b.id_person 
        WHERE a.id_spec="'.$id.'"
        AND a.flag = 0 
        ');        
        $response = $q->row();
        return $response;
      }


      function get_repdet($id)
      {
          $q = $this->db->query('SELECT * FROM obj2b_spectro_crm_det
          WHERE flag = 0
          AND id_spec="'.$id.'"');        
          $response = $q->row();
          return $response;
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

    function insert_det($data)
    {
        $this->db->insert('obj2b_spectro_crm_det', $data);
    }
    
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update_det($id, $data)
    {
        $this->db->where('id_dspec', $id);
        $this->db->update('obj2b_spectro_crm_det', $data);
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