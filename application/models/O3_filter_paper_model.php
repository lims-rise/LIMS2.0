<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class O3_filter_paper_model extends CI_Model
{

    public $table = 'obj3_bfilterpaper';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        // $this->datatables->select('barcode_sample, date_process, time_process, initial, freezer_bag, location, comments, id_person, id_location_80, lab');
        // $this->datatables->from('v_obj3bfilterpaper');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        // $this->datatables->where('flag', '0');

        $this->datatables->select('obj3_bfilterpaper.barcode_sample, obj3_bfilterpaper.date_process, obj3_bfilterpaper.time_process, 
        initial, obj3_bfilterpaper.freezer_bag, 
        concat("F",ref_location_80.freezer,"-","S",ref_location_80.shelf,"-","R",ref_location_80.rack,"-","DRW",ref_location_80.rack_level) AS location,
        obj3_bfilterpaper.comments, obj3_bfilterpaper.id_person, 
        obj3_bfilterpaper.id_location_80, obj3_bfilterpaper.lab, obj3_bfilterpaper.flag');
        $this->datatables->from('obj3_bfilterpaper');
        $this->datatables->join('ref_person', 'obj3_bfilterpaper.id_person = ref_person.id_person', 'left');
        $this->datatables->join('ref_location_80', 'obj3_bfilterpaper.id_location_80 = ref_location_80.id_location_80', 'left');
        $this->datatables->where('obj3_bfilterpaper.lab', $this->session->userdata('lab'));
        $this->datatables->where('obj3_bfilterpaper.flag', '0');

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
                ".anchor(site_url('o3_filter_paper/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'barcode_sample');
        }
        // $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-primary btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'barcode_sample');
        return $this->datatables->generate();
    }

    function get_all()
    {
      $q = $this->db->query('SELECT 
      a.barcode_sample AS barcode_sample,a.date_process AS date_process,date_format(a.time_process,"%H:%i") AS time_process,b.initial AS initial,a.freezer_bag AS freezer_bag,
      concat("F",d.freezer,"-","S",d.shelf,"-","R",d.rack,"-","DRW",d.rack_level) AS location,
      a.comments AS comments,a.id_person AS id_person,a.id_location_80 AS id_location_80, a.lab, a.flag
      from obj3_bfilterpaper a 
      left join ref_person b on a.id_person = b.id_person 
      LEFT JOIN (SELECT x.id, x.cryobox, x.id_location_80, b.freezer, b.shelf, b.rack, b.rack_level, x.lab, x.flag  FROM
          (SELECT a.id, a.cryobox, b.id_location_80, a.lab, a.flag 
            FROM
              (SELECT MAX(id) id, cryobox, lab, flag
              FROM freezer_in
              GROUP BY cryobox) a
              LEFT JOIN (SELECT id, id_location_80, lab, flag FROM freezer_in) b ON a.id = b.id
              UNION ALL
              SELECT a.id, a.cryobox, b.id_location_80, a.lab, a.flag FROM
                (SELECT MAX(id) id, barcode_sample AS cryobox, lab, flag
                FROM freezer_in
                WHERE id_vessel <> 1
                GROUP BY barcode_sample) a
              LEFT JOIN (SELECT id, id_location_80, lab, flag FROM freezer_in) b ON a.id = b.id
              ) x
            LEFT JOIN ref_location_80 b ON x.id_location_80 = b.id_location_80
            GROUP BY x.cryobox
            ORDER BY id) d on a.freezer_bag = d.cryobox 
      WHERE a.lab = "'.$this->session->userdata('lab').'" 
      AND a.flag = 0
      ORDER BY  a.barcode_sample, a.date_process
      ');
      $response = $q->result();
      return $response;

        // $this->db->order_by($this->id, $this->order);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $this->db->where('flag', '0');
        // return $this->db->get('v_obj3bfilterpaper')->result();
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

    function insert_freezer($data)
    {
        $this->db->insert('freezer_in', $data);
    }
    
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    function update_freezer($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('freezer_in', $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function getFreezerIN($id){
      // $response = array();
      $this->db->select('MAX(id) AS id');
      $this->db->where('barcode_sample', $id);
      $this->db->where('flag', '0');
    // $q = $this->db->get('freezer_in');
      // $response = $q->result_array();
      return $this->db->get('freezer_in')->row();
      // return $response;
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

      function getFreezer(){
        $response = array();
        $this->db->select('freezer');
        $this->db->distinct();
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location_80');
        $response = $q->result_array();
        return $response;
      }

      function getShelf(){
        $response = array();
        $this->db->select('shelf');
        $this->db->distinct();
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location_80');
        $response = $q->result_array();
        return $response;
      }

      function getRack(){
        $response = array();
        $this->db->select('rack');
        $this->db->distinct();
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location_80');
        $response = $q->result_array();
        return $response;
      }
      
      function getDrawer(){
        $response = array();
        $this->db->select('rack_level');
        $this->db->distinct();
        $this->db->where('flag', '0');
        $q = $this->db->get('ref_location_80');
        $response = $q->result_array();
        return $response;
      }

      function find_loc($id){
        // $this->db->where('id_location_80', $id);
        // $q = $this->db->get('ref_location_80');
        $this->db->where('id', $id);
        $this->db->where('flag', '0');
        $q = $this->db->get('v_findcryo');
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

      function find_cryo($id){
        // $this->db->where('cryobox', $id);
        // $this->db->where('flag', '0');
        // // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get('v_findcryo');
        // $response = $q->result_array();
        // return $response;

        $q = $this->db->query('SELECT x.id, x.cryobox, x.id_location_80, b.freezer, b.shelf, b.rack, b.rack_level, x.lab, x.flag FROM
        (SELECT a.id, a.cryobox, b.id_location_80, a.lab, a.flag 
        FROM
          (SELECT MAX(id) id, cryobox, lab, flag
          FROM freezer_in
          GROUP BY cryobox) a
          LEFT JOIN (SELECT id, id_location_80, lab, flag FROM freezer_in) b ON a.id = b.id
          UNION ALL
          SELECT a.id, a.cryobox, b.id_location_80, a.lab, a.flag FROM
            (SELECT MAX(id) id, barcode_sample AS cryobox, lab, flag
            FROM freezer_in
            WHERE id_vessel <> 1
            GROUP BY barcode_sample) a
          LEFT JOIN (SELECT id, id_location_80, lab, flag FROM freezer_in) b ON a.id = b.id
          ) x
        LEFT JOIN ref_location_80 b ON x.id_location_80 = b.id_location_80
        WHERE x.lab = "'.$this->session->userdata('lab').'" 
        AND x.flag = 0
        AND x.cryobox = "'.$id.'" 
        GROUP BY x.cryobox
        ORDER BY id 
        ');
        //$url = $this->db->where('id_user_level',$user['id_user_level'])->get('tbl_user_level')->row();
        $response = $q->result_array();
        return $response;

        // return $this->db->get('ref_location_80')->row();
      }

      function getFreezLoc($f,$s,$r,$rl){
        $this->db->select('id_location_80');
        $this->db->where('freezer', $f);
        $this->db->where('shelf', $s);
        $this->db->where('rack', $r);
        $this->db->where('rack_level', $rl);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        // return $this->db->get('ref_location_80');
        // $response = $q->result_array();
        // return $response;
        return $this->db->get('ref_location_80')->row();
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