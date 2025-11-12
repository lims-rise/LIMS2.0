<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

defined('BASEPATH') OR exit('No direct script access allowed');

class DNA_nanopore_result extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dna_nanopore_result_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('session');
    }

 public function index()
{
    // echo "Controller is working!<br>";

    $data['results'] = $this->dna_nanopore_result_model->get_all();
    // var_dump($data['results']);

    // $this->load->view('dna_nanopore_result/index', $data);
    $this->template->load('template','dna_nanopore_result/index', $data);
}

    // public function index()
    // {
    //     $data['results'] = $this->dna_nanopore_result_model->get_all();
    //     $this->load->view('dna_nanopore_result/index', $data);
    // }

    public function upload_csv()
    {
        if (!empty($_FILES['csv_file']['name'])) {

            $file_data = fopen($_FILES['csv_file']['tmp_name'], 'r');
            fgetcsv($file_data); // skip header row

            while (($row = fgetcsv($file_data, 1000, ",")) !== FALSE) {
                if (count($row) >= 5) {
                    $data = array(
                        'Sample'     => $row[0],
                        'Dups'       => $row[1],
                        'GC'         => $row[2],
                        'Median_len' => $row[3],
                        'Seqs'       => $row[4]
                    );
                    $this->dna_nanopore_result_model->insert($data);
                }
            }

            fclose($file_data);
            $this->session->set_flashdata('success', 'CSV imported successfully.');
        } else {
            $this->session->set_flashdata('error', 'Please select a valid CSV file.');
        }

        redirect('dna_nanopore_result');
    }
}
