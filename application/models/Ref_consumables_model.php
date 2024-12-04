<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_consumables_model extends CI_Model
{

    public $table = 'ref_consumables';
    public $id = 'id_consumables';
    public $order = 'DESC';


    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('rc.id_consumables, 
            ro.objective,
            cs.product_name');
        $this->datatables->from('ref_consumables AS rc');
        $this->datatables->join('ref_objective AS ro', 'ro.id_objective = rc.id_objective', 'left');
        $this->datatables->join('consumables_stock AS cs', 'cs.id_stock = rc.id_stock', 'left');
        $this->datatables->where('rc.lab', $this->session->userdata('lab'));
        $this->datatables->where('rc.flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'id_consumables');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_consumables');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".anchor(site_url('Ref_objective/delete/$1'),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Confirm deleting sample : $1 ?\')"'), 'id_consumables');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $this->db->order_by($this->id, 'ASC');
        $this->db->where('flag', '0');
        return $this->db->get($this->table)->result();
    }

    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        $this->db->where('flag', '0');
        return $this->db->get($this->table)->row();
    }

        // Fungsi untuk mendapatkan id_stock terbaru berdasarkan lab yang aktif
        public function get_latest_id_consumables() {
            // Ambil lab dari session
            $lab = $this->session->userdata('lab');
            
            // Tentukan prefix berdasarkan lab
            $prefix = ($lab == 1) ? 'ID-CONSUMABLES-' : 'FJ-CONSUMABLES-';  // ID-STOCK untuk Indonesia, FJ-STOCK untuk Fiji

            // Pilih id_stock terakhir berdasarkan lab
            $this->db->select('id_consumables');
            $this->db->like('id_consumables', $prefix); // Gunakan LIKE untuk mencocokkan id_stock dengan prefix yang sesuai
            $this->db->order_by('id_consumables', 'DESC');
            $this->db->limit(1);
            $query = $this->db->get('ref_consumables');

            // Cek jika ada id_stock sebelumnya
            if ($query->num_rows() > 0) {
                return $query->row()->id_consumables;
            } else {
                return null;
            }
        }

        // Fungsi untuk menghasilkan id_stock berikutnya berdasarkan lab yang aktif
        public function generate_id_consumables() {
            // Ambil lab dari session untuk menentukan prefix
            $lab = $this->session->userdata('lab');
            
            // Tentukan prefix berdasarkan lab
            $prefix = ($lab == 1) ? 'ID-CONSUMABLES-' : 'FJ-CONSUMABLES-'; // ID-STOCK untuk Indonesia, FJ-STOCK untuk Fiji

            // Ambil id_stock terakhir yang sudah ada berdasarkan lab dan prefix
            $latest_id = $this->get_latest_id_consumables();

            if ($latest_id) {
                // Jika id_stock sebelumnya ada dan prefix sesuai, ambil nomor urut berikutnya
                if (strpos($latest_id, $prefix) === 0) {
                    $number = intval(substr($latest_id, strlen($prefix))) + 1;
                } else {
                    $number = 1;  // Jika prefix tidak sesuai, mulai dari nomor 1
                }
            } else {
                $number = 1;  // Jika belum ada id_stock, mulai dari nomor 1
            }

            // Format id_stock dengan prefix dan nomor urut
            $new_id = sprintf('%s%05d', $prefix, $number);
            return $new_id;
        }

    // insert data
    function insert($data)
    {
        $data['id_consumables'] = $this->generate_id_consumables();
        $this->db->insert($this->table, $data);
    }
    
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

      function validate1($id){
        $this->db->where('barcode_sample', $id);
        $this->db->where('flag', '0');
        $q = $this->db->get($this->table);
        $response = $q->result_array();
        return $response;
      }

      function getStock()
      {
          $response = array();
          $labId = $this->session->userdata('lab');
          $this->db->select('*');
          $this->db->where('flag', '0');
          $this->db->where('lab', $labId);
          $q = $this->db->get('consumables_stock');
          $response = $q->result_array();
          return $response;
      }

      function getObjective()
      {
          $response = array();
          $this->db->select('id_objective, objective');
          $this->db->where('flag', '0');
          $q = $this->db->get('ref_objective');
          $response = $q->result_array();
          return $response;
      }

}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */