<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// require_once '../../extlib/PHPExcel/PHPExcel.php';

class REP_dna extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('REP_dna_model');
        // $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','REP_dna/index');
    } 

    // public function index2()
    // {
    //     $this->template->load('template','REP_dna/index2');
    // } 

    
    public function json() {
        $date1=$this->input->get('date1');
        $date2=$this->input->get('date2');
        // var_dump($date2);
        header('Content-Type: application/json');
        echo $this->REP_dna_model->json($date1,$date2);
    }


    public function excel()
    {
        $date1=$this->input->get('date1');
        $date2=$this->input->get('date2');

        $this->load->database();
        // include('application/config/database.php');
        // include(APPPATH.'config/database.php');

        // Database connection settings
        // $host = 'localhost';
        // $user = 'root';
        // $password = '';

        // Create a database connection
        // $mysqli = new mysqli($host, $user, $password, $database);

        // // Check for connection errors
        // if ($mysqli->connect_error) {
        //     die('Connection failed: ' . $mysqli->connect_error);
        // }        


                // 'DNA_Extraction',
                // 'SELECT a.barcode_sample AS Barcode_sample, a.date_extraction AS Date_extraction, 
                // b.initial AS Lab_tech, a.kit_lot AS Kit_lot, a.sampletype AS Sample_type, 
                // a.barcode_dna AS Barcode_DNA, a.weights AS Weights, a.tube_number AS Tube_number, a.cryobox AS Cryobox, 
                // a.barcode_metagenomics AS Barcode_metagenomics, a.meta_box AS Meta_box,
                // CONCAT("F",d.freezer,"-S",d.shelf,"-R",d.rack,"-DRW",d.rack_level) AS Freezer_Location,
                // TRIM(a.comments) AS Comments
                // FROM dna_extraction a
                // LEFT JOIN ref_person b ON a.id_person=b.id_person 
                // LEFT JOIN ref_location_80 d ON a.id_location=d.id_location_80 AND d.lab = "'.$this->session->userdata('lab').'" 
                // WHERE  (a.date_extraction >= "'.$date1.'"
                // AND a.date_extraction <= "'.$date2.'")
                // AND a.lab = "'.$this->session->userdata('lab').'" 
                // AND a.flag = 0 
                // ORDER BY a.date_extraction, a.barcode_dna ASC
                // ',
                // array('Barcode_sample', 'Date_extraction', 'Lab_tech', 'Kit_lot', 'Sample_type', 'Barcode_DNA', 'Weights', 'Tube_number', 'Cryobox',
                //         'Barcode_metagenomics', 'Meta_box', 'Freezer_Location', 'Comments'), // Columns for Sheet1



        $spreadsheet = new Spreadsheet();

        $sheets = array(
            array(
                'DNA_Extraction',
                'SELECT a.barcode_dna, a.barcode_sample AS "source_barcode_sample", a.date_extraction, b.initial, a.kit_lot, a.sampletype, c.Barcode_sample AS "parent_barcode_sample", c.sampletype AS "parent_sample_type", a.weights, a.tube_number, a.cryobox, 
                a.barcode_metagenomics, 
                concat("F",d.freezer,"-","S",d.shelf,"-","R",d.rack,"-","DRW",d.rack_level) AS Location, a.meta_box, a.qc_status, a.comments
                FROM dna_extraction a
                LEFT JOIN ref_person b ON a.id_person = b.id_person
                LEFT JOIN (SELECT barcode_p1a barcode, cryobox1 vessel, "O3 Blood-EDTA" type, 
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_edta_aliquots a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_p1a)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT barcode_p2a barcode, cryobox2 vessel, "O3 Blood-EDTA" type, 
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_edta_aliquots a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_p2a)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT barcode_p3a barcode, cryobox3 vessel, "O3 Blood-EDTA" type, 
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_edta_aliquots a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_p3a)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT packed_cells barcode, cryobox_pc vessel, "O3 Blood-EDTA" type, 
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_edta_aliquots a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.packed_cells)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT barcode_wb barcode, cryoboxwb vessel, "O3 Blood-EDTA" type, 
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_edta_aliquots a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_wb)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT barcode_sst1 barcode, cryobox1 vessel, "O3 Blood-SST" type, 
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_sst_aliquots a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_sst1)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT barcode_sst2 barcode, cryobox2 vessel, "O3 Blood-SST" type, 
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_sst_aliquots a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_sst2)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT a.barcode_sample barcode, a.freezer_bag vessel, "O3 Filter Paper" type,
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_bfilterpaper a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_sample)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT a.aliquot1 barcode, a.cryobox1 vessel, "O3 Feces" type,
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_faliquot a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.aliquot1)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT a.aliquot2 barcode, a.cryobox2 vessel, "O3 Feces" type,
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_faliquot a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.aliquot2)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT a.aliquot3 barcode, a.cryobox3 vessel, "O3 Feces" type,
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_faliquot a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.aliquot3)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT a.aliquot_zymo barcode, a.cryobox_zymo vessel, "O3 Feces" type,
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_faliquot a
                                            LEFT JOIN obj3_sam_rec b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.aliquot_zymo)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT a.bar_macsweep1 barcode, a.cryobox1 vessel, "O3 Feces" type,
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_fmac2 a
                                            LEFT JOIN obj3_fmac1 d ON a.bar_macconkey = d.bar_macconkey
                                            LEFT JOIN obj3_sam_rec b ON d.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.bar_macsweep1)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT a.bar_macsweep2 barcode, a.cryobox2 vessel, "O3 Feces" type,
                                            b.barcode_sample, c.sampletype
                                            FROM obj3_fmac2 a
                                            LEFT JOIN obj3_fmac1 d ON a.bar_macconkey = d.bar_macconkey
                                            LEFT JOIN obj3_sam_rec b ON d.barcode_sample = b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.bar_macsweep2)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT a.barcode_dna_bag barcode, a.barcode_storage vessel, CONCAT("O2B ", c.sampletype) type,
                                            IFNULL(b.barcode_sample, d.barcode_sample) AS barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM obj2b_metagenomics a
                                            LEFT JOIN obj2b_receipt b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN (SELECT a.barcode_falcon, b.barcode_sample, b.id_type2b FROM obj2b_bs_stomacher a 
                                            LEFT JOIN obj2b_receipt b ON a.barcode_sample = b.barcode_sample) d ON a.barcode_sample = d.barcode_falcon
                                            LEFT JOIN ref_sampletype c ON IFNULL(b.id_type2b, d.id_type2b) = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_dna_bag)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                UNION ALL
                                            SELECT a.barcode_dna1 barcode, a.barcode_storage1 vessel, CONCAT("O2B ", c.sampletype) type,
                                            a.barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM obj2b_meta_sediment a
                                            LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_dna1)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"	
                UNION ALL
                                            SELECT a.barcode_dna2 barcode, a.barcode_storage2 vessel, CONCAT("O2B ", c.sampletype) type,
                                            a.barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM obj2b_meta_sediment a
                                            LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_dna2)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL
                                            SELECT a.bar_macsweep1 barcode, a.cryobox1 vessel, CONCAT("O2B ", c.sampletype) type,
                                            b.barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM obj2b_mac2 a
                                            LEFT JOIN obj2b_mac1 d ON a.bar_macconkey=d.bar_macconkey
                                            LEFT JOIN (SELECT barcode_sample barcode, barcode_sample, id_type2b
                                                    FROM obj2b_receipt
                                                    WHERE lab = "'.$this->session->userdata('lab').'"
                                                    UNION ALL
                                                    SELECT a.barcode_falcon barcode, b.barcode_sample, b.id_type2b
                                                    FROM obj2b_bs_stomacher a
                                                    LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
                                                    WHERE a.lab = "'.$this->session->userdata('lab').'"
                                                    UNION ALL
                                                    SELECT a.barcode_tube barcode, b.barcode_sample, b.id_type2b
                                                    FROM obj2b_sediment_prep a
                                                    LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
                                                    WHERE a.lab = "'.$this->session->userdata('lab').'"
                                                    ) b ON d.barcode_sample=b.barcode
                                            LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
                                            WHERE LENGTH(TRIM(a.bar_macsweep1)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"

                        UNION ALL
                                            SELECT a.bar_macsweep2 barcode, a.cryobox2 vessel, CONCAT("O2B ", c.sampletype) type,
                                            b.barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM obj2b_mac2 a
                                            LEFT JOIN obj2b_mac1 d ON a.bar_macconkey=d.bar_macconkey
                                            LEFT JOIN (SELECT barcode_sample barcode, barcode_sample, id_type2b
                                                    FROM obj2b_receipt
                                                    WHERE lab = "'.$this->session->userdata('lab').'"
                                                    UNION ALL
                                                    SELECT a.barcode_falcon barcode, b.barcode_sample, b.id_type2b
                                                    FROM obj2b_bs_stomacher a
                                                    LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
                                                    WHERE a.lab = "'.$this->session->userdata('lab').'"
                                                    UNION ALL
                                                    SELECT a.barcode_tube barcode, b.barcode_sample, b.id_type2b
                                                    FROM obj2b_sediment_prep a
                                                    LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
                                                    WHERE a.lab = "'.$this->session->userdata('lab').'"
                                                    ) b ON d.barcode_sample=b.barcode
                                            LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
                                            WHERE LENGTH(TRIM(a.bar_macsweep2)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL
                                            SELECT a.bar_macsweep1 barcode, a.cryobox1 vessel, CONCAT("NHMRC ", c.sampletype) type,
                                            b.barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM nhmrc_mac2 a
                                            LEFT JOIN nhmrc_mac1 d ON a.bar_macconkey=d.bar_macconkey
                                            LEFT JOIN (SELECT barcode_sample barcode, barcode_sample, id_type2b
                                                    FROM nhmrc_receipt
                                                    WHERE lab = "'.$this->session->userdata('lab').'"
                                                    UNION ALL
                                                    SELECT a.barcode_falcon barcode, b.barcode_sample, b.id_type2b
                                                    FROM nhmrc_bs_stomacher a
                                                    LEFT JOIN nhmrc_receipt b ON a.barcode_sample=b.barcode_sample
                                                    WHERE a.lab = "'.$this->session->userdata('lab').'"
                                                    UNION ALL
                                                    SELECT c.barcode_falcon1 barcode, b.barcode_sample, b.id_type2b
                                                    FROM nhmrc_subsd_idexx c 
                                                    LEFT JOIN nhmrc_sample_prep a ON a.barcode_food=c.barcode_food
                                                    LEFT JOIN nhmrc_receipt b ON a.barcode_sample=b.barcode_sample
                                                    WHERE a.lab = "'.$this->session->userdata('lab').'"
                                                    ) b ON d.barcode_sample=b.barcode
                                            LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
                                            WHERE LENGTH(TRIM(a.bar_macsweep1)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL
                                            SELECT a.bar_macsweep2 barcode, a.cryobox2 vessel, CONCAT("NHMRC ", c.sampletype) type,
                                            b.barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM nhmrc_mac2 a
                                            LEFT JOIN nhmrc_mac1 d ON a.bar_macconkey=d.bar_macconkey
                                            LEFT JOIN (SELECT barcode_sample barcode, barcode_sample, id_type2b
                                                    FROM nhmrc_receipt
                                                    WHERE lab = "'.$this->session->userdata('lab').'"
                                                    UNION ALL
                                                    SELECT a.barcode_falcon barcode, b.barcode_sample, b.id_type2b
                                                    FROM nhmrc_bs_stomacher a
                                                    LEFT JOIN nhmrc_receipt b ON a.barcode_sample=b.barcode_sample
                                                    WHERE a.lab = "'.$this->session->userdata('lab').'"
                                                    UNION ALL
                                                    SELECT c.barcode_falcon1 barcode, b.barcode_sample, b.id_type2b
                                                    FROM nhmrc_subsd_idexx c 
                                                    LEFT JOIN nhmrc_sample_prep a ON a.barcode_food=c.barcode_food
                                                    LEFT JOIN nhmrc_receipt b ON a.barcode_sample=b.barcode_sample
                                                    WHERE a.lab = "'.$this->session->userdata('lab').'"
                                                    ) b ON d.barcode_sample=b.barcode
                                            LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
                                            WHERE LENGTH(TRIM(a.bar_macsweep2)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL 									
                                            SELECT a.barcode_dna_bag barcode, a.barcode_storage vessel, CONCAT("NHMRC ", c.sampletype) type,
                                            IFNULL(b.barcode_sample, d.barcode_sample) AS barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM nhmrc_metagenomics a
                                            LEFT JOIN nhmrc_receipt b ON a.barcode_sample = b.barcode_sample
                                            LEFT JOIN (SELECT a.barcode_falcon, b.barcode_sample, b.id_type2b FROM nhmrc_bs_stomacher a 
                                            LEFT JOIN nhmrc_receipt b ON a.barcode_sample = b.barcode_sample) d ON a.barcode_sample = d.barcode_falcon
                                            LEFT JOIN ref_sampletype c ON IFNULL(b.id_type2b, d.id_type2b) = c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_dna_bag)) > 0
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL 
                                            SELECT a.barcode_dna1 barcode, a.barcode_storage1 vessel, CONCAT("NHMRC ", c.sampletype) type,
                                            a.barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM nhmrc_meta_food a
                                            LEFT JOIN nhmrc_receipt b ON a.barcode_sample=b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_dna1)) > 0			
                                            AND a.lab = "'.$this->session->userdata('lab').'"		
                        UNION ALL 
                                            SELECT a.barcode_dna2 barcode, a.barcode_storage1 vessel, CONCAT("NHMRC ", c.sampletype) type,
                                            a.barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM nhmrc_meta_food a
                                            LEFT JOIN nhmrc_receipt b ON a.barcode_sample=b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
                                            WHERE LENGTH(TRIM(a.barcode_dna2)) > 0					
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL
                                            SELECT DISTINCT a.barcode_sample barcode, B.cryobox vessel, CONCAT("O2B ", c.sampletype) type,
                                            a.barcode_sample, IFNULL(c.sampletype, a.comments) AS sample_type
                                            FROM obj2b_receipt a
                                            LEFT JOIN freezer_in b ON a.barcode_sample=b.barcode_sample
                                            LEFT JOIN ref_sampletype c ON a.id_type2b=c.id_sampletype
                                            WHERE LEFT(a.barcode_sample, 5) = "N-S2-"
                                            AND LENGTH(TRIM(a.barcode_sample)) > 0		
                                            AND a.lab = "'.$this->session->userdata('lab').'"		
                        UNION ALL
                                            SELECT a.barcode_vessel barcode, null vessel, null type, a.barcode_sample, 
                                            b.sample AS sample_type
                                            FROM dna_control a
                                            LEFT JOIN ref_sampledna b ON a.id_sample = b.id_sample
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL
                                            SELECT a.barcode_vessel2 barcode, null vessel, null type, a.barcode_sample, 
                                            b.sample AS sample_type
                                            FROM dna_control a
                                            LEFT JOIN ref_sampledna b ON a.id_sample = b.id_sample
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL
                                            SELECT a.barcode_vessel3 barcode, null vessel, null type, a.barcode_sample, 
                                            b.sample AS sample_type
                                            FROM dna_control a
                                            LEFT JOIN ref_sampledna b ON a.id_sample = b.id_sample
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL
                                            SELECT a.barcode_vessel4 barcode, null vessel, null type, a.barcode_sample, 
                                            b.sample AS sample_type
                                            FROM dna_control a
                                            LEFT JOIN ref_sampledna b ON a.id_sample = b.id_sample
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                        UNION ALL
                                            SELECT a.barcode_vessel5 barcode, null vessel, null type, a.barcode_sample, 
                                            b.sample AS sample_type
                                            FROM dna_control a
                                            LEFT JOIN ref_sampledna b ON a.id_sample = b.id_sample
                                            AND a.lab = "'.$this->session->userdata('lab').'"
                                            ) c ON a.barcode_sample=c.barcode									
                LEFT JOIN ref_location_80 d on a.id_location=d.id_location_80 AND d.lab = "'.$this->session->userdata('lab').'"
                        WHERE a.lab = "'.$this->session->userdata('lab').'"
                AND a.flag = 0 
                ORDER BY a.date_extraction, a.barcode_dna ASC
                ',
                array('Barcode_DNA', 'Source_Barcode_sample', 'Date_extraction', 'Lab_tech', 'Kit_lot', 'Sample_type', 'Parent_Barcode_Sample', 'Parent_Sample_Type', 'Weights',
                        'Tube_number', 'Cryobox', 'Barcode_metagenomics', 'Location', 'Meta_box', 'QC_Status','Comments'), // Columns for Sheet1
            ),
            array(
                'DNA_Concentration',
                'SELECT a.barcode_dna AS Barcode_DNA, a.date_concentration AS Date_concentration, 
                c.initial AS Lab_tech, b.sampletype AS Sample_type, a.dna_concentration AS DNA_concentration, 
                TRIM(a.comments) AS Comments
                FROM dna_concentration a
                LEFT JOIN dna_extraction b ON a.barcode_dna=b.barcode_dna
                LEFT JOIN ref_person c ON a.id_person=c.id_person 
                WHERE (a.date_concentration >= "'.$date1.'"
                AND a.date_concentration <= "'.$date2.'")
                AND a.lab = "'.$this->session->userdata('lab').'" 
                AND a.flag = 0 
                ORDER BY a.date_concentration, a.barcode_dna ASC
                ', // Different columns for Sheet2
                array('Barcode_DNA', 'Date_concentration', 'Lab_tech', 'Sample_type', 'DNA_concentration', 'Comments'), // Columns for Sheet2
            ),
            array(
                'DNA_Aliquotting',
                'SELECT c.barcode_dna AS Barcode_DNA, a.date_aliquot AS Date_aliquot, b.initial AS Lab_tech,
                a.barcode_monash AS Barcode_Monash, a.barcode_cambridge AS Barcode_Cambridge, 
                c.row_id AS Row_ID, c.column_id AS Column_ID, TRIM(a.comments) AS Comments
                FROM dna_aliquot a
                LEFT JOIN dna_aliquot_det c ON a. id_dna = c.id_dna
                LEFT JOIN ref_person b ON a.id_person=b.id_person  
                WHERE (a.date_aliquot >= "'.$date1.'"
                AND a.date_aliquot <= "'.$date2.'")
                AND a.lab = "'.$this->session->userdata('lab').'" 
                AND a.flag = 0 
                ORDER BY a.date_aliquot ASC
                ',
                array('Barcode_DNA', 'Date_aliquot', 'Lab_tech', 'Barcode_Monash',
                'Barcode_Cambridge', 'Row_ID', 'Column_ID', 'Comments'),
            ),
            array(
                'DNA_Sample_Analysis',
                'SELECT a.barcode_dna AS Barcode_DNA, a.date_analysis AS Date_analysis, b.initial AS Lab_tech,
                a.analysis_type AS Analysis_type, a.run_number AS Run_number, 
                a.barcode_array AS Barcode_array, TRIM(a.comments) AS Comments
                FROM dna_sample_analysis a
                LEFT JOIN ref_person b ON a.id_person = b.id_person         
                WHERE (a.date_analysis >= "'.$date1.'"
                AND a.date_analysis <= "'.$date2.'")
                AND a.lab = "'.$this->session->userdata('lab').'" 
                AND a.flag = 0 
                ORDER BY a.date_analysis ASC
                ',
                array('Barcode_DNA', 'Date_analysis', 'Lab_tech', 'Analysis_type',
                'Run_number', 'Barcode_array', 'Comments'),
            ),
            array(
                'DNA_Nanopore_Analysis',
                'SELECT a.barcode_dna AS Barcode_DNA, a.date_analysis AS Date_analysis, b.initial AS Lab_tech,
                a.barcode_ID AS Barcode_ID, TRIM(a.alias) AS Alias
                FROM dna_nanopore_analysis a
                LEFT JOIN ref_person b ON a.id_person = b.id_person         
                WHERE (a.date_analysis >= "'.$date1.'"
                AND a.date_analysis <= "'.$date2.'")
                AND a.lab = "'.$this->session->userdata('lab').'" 
                AND a.flag = 0 
                ORDER BY a.date_analysis ASC
                ',
                array('Barcode_DNA', 'Date_analysis', 'Lab_tech', 'Barcode_ID', 'Alias'),
            ),
            // Add more sheets as needed
        );
        
        $spreadsheet->removeSheetByIndex(0);
        foreach ($sheets as $sheetInfo) {
            // Create a new worksheet for each sheet
            $worksheet = $spreadsheet->createSheet();
            $worksheet->setTitle($sheetInfo[0]);
    
            // SQL query to fetch data for this sheet
            $sql = $sheetInfo[1];
            
            // Use the query builder to fetch data
            $query = $this->db->query($sql);
            $result = $query->result_array();
            
            // Column headers for this sheet
            $columns = $sheetInfo[2];
    
            // Add column headers
            $col = 1;
            foreach ($columns as $column) {
                $worksheet->setCellValueByColumnAndRow($col, 1, $column);
                $col++;
            }
    
            // Add data rows
            $row = 2;
            foreach ($result as $row_data) {
                $col = 1;
                foreach ($columns as $column) {
                    $worksheet->setCellValueByColumnAndRow($col, $row, $row_data[$column]);
                    $col++;
                }
                $row++;
            }
        }

        // foreach ($sheets as $sheetInfo) {
        //     // Create a new worksheet for each sheet
        //     $worksheet = $spreadsheet->createSheet();
        //     $worksheet->setTitle($sheetInfo[0]);
        
        //     // SQL query to fetch data for this sheet
        //     $sql = $sheetInfo[1];
        //     $result = $mysqli->query($sql);
        
        //     // Column headers for this sheet
        //     $columns = $sheetInfo[2];
        
        //     // Add column headers
        //     $col = 1;
        //     foreach ($columns as $column) {
        //         $worksheet->setCellValueByColumnAndRow($col, 1, $column);
        //         $col++;
        //     }
        
        //     // Add data rows
        //     $row = 2;
        //     while ($row_data = $result->fetch_assoc()) {
        //         $col = 1;
        //         foreach ($columns as $column) {
        //             $worksheet->setCellValueByColumnAndRow($col, $row, $row_data[$column]);
        //             $col++;
        //         }
        //         $row++;
        //     }
        // }
        
        // Create a new Xlsx writer
        $writer = new Xlsx($spreadsheet);
        
        // Set the HTTP headers to download the Excel file
        $datenow=date("Ymd");
        $filename = 'ALL_DNA_reports_'.$datenow.'.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        
        // Save the Excel file to the output stream
        $writer->save('php://output');
        






        // $date1 =  $this->uri->segment(3);
        // $date2 =  $this->uri->segment(4);

        // $spreadsheet = new Spreadsheet();    
        // $sheet = $spreadsheet->getActiveSheet();
        // // Buat header tabel nya pada baris ke 1
        // $sheet->setCellValue('A1', "ID Delivery"); // Set kolom A3 dengan tulisan "NO"
        // $sheet->setCellValue('B1', "Delivery Number"); // Set kolom B3 dengan tulisan "NIS"
        // $sheet->setCellValue('C1', "Date Delivery"); // Set kolom C3 dengan tulisan "NAMA"
        // $sheet->setCellValue('D1', "Distributor"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        // $sheet->setCellValue('E1', "City"); // Set kolom E3 dengan tulisan "ALAMAT"
        // $sheet->setCellValue('F1', "ID Items");
        // $sheet->setCellValue('G1', "Items Description");
        // $sheet->setCellValue('H1', "Qty");
        // $sheet->getStyle('A1:H1')->getFont()->setBold(true); // Set bold kolom A1
    
        // // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        // $rdeliver = $this->REP_dna_model->get_all($date1, $date2);
    
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        // $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
        // foreach($rdeliver as $data){ // Lakukan looping pada variabel siswa
        //   $sheet->setCellValue('A'.$numrow, $data->id_delivery);
        //   $sheet->setCellValue('B'.$numrow, $data->delivery_number);
        //   $sheet->setCellValue('C'.$numrow, $data->date_delivery);
        //   $sheet->setCellValue('D'.$numrow, $data->customer_name);
        //   $sheet->setCellValue('E'.$numrow, $data->city);
        //   $sheet->setCellValue('F'.$numrow, $data->id_items);
        //   $sheet->setCellValue('G'.$numrow, $data->items);
        //   $sheet->setCellValue('H'.$numrow, $data->qty);
          
        //   $no++; // Tambah 1 setiap kali looping
        //   $numrow++; // Tambah 1 setiap kali looping
        // }
        
        // // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        // $sheet->getDefaultRowDimension()->setRowHeight(-1);
    
        // // Set orientasi kertas jadi LANDSCAPE
        // $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    
        // // Set judul file excel nya
        // $sheet->setTitle("Delivery Reports");
    
        // // Proses file excel
        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment; filename="REP_dnas.xlsx"'); // Set nama file excel nya
        // header('Cache-Control: max-age=0');
    
        // $writer = new Xlsx($spreadsheet);
        // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        // $fileName = $fileName.'.csv';
        // $writer->save('php://output');
           
    }

}


/* End of file Tbl_customer.php */
/* Location: ./application/controllers/Tbl_customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:29:29 */
/* http://harviacode.com */