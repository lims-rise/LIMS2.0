<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DNA_nanopore_result_model extends CI_Model {

    private $table = 'dna_nanopore_result';

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function get_all()
    {
        $query = $this->db->get($this->table);
        return $query->result();
    }
}
