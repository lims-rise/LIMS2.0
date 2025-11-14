<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DNA_nanopore_result_model extends CI_Model {

    private $table = 'dna_nanopore_result';

    public function insert($data)
    {
        // $this->db->insert($this->table, $data);
    
        // Detect duplicates before insert
        // $this->db->where($data);
        $sample = trim($data['Sample']);
        $this->db->where('Sample', $sample);
        $query = $this->db->get($this->table);

        if ($query->num_rows() > 0) {
            // Return count of duplicates instead of inserting
            return [
                'status' => 'duplicate',
                'count' => $query->num_rows()
            ];
        } else {
            // Safe to insert
            $data['Sample'] = $sample;
            $this->db->insert($this->table, $data);
            return [
                'status' => 'success',
                'insert_id' => $this->db->insert_id()
            ];
        }
    }

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
