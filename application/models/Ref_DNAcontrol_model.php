<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ref_DNAcontrol_model extends CI_Model
{

    public $table = 'ref_sampledna';
    public $id = 'id_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('id_sample, sample');
        $this->datatables->from('ref_sampledna');
        // $this->datatables->where('lab', $this->session->userdata('lab'));
        $this->datatables->where('flag', '0');
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'id_sample');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'id_sample');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
            ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'id_sample');
        }
        return $this->datatables->generate();
    }

    function get_all()
    {
        $this->db->order_by($this->id, 'ASC');
        // $this->db->where('lab', $this->session->userdata('lab'));
        $this->db->where('flag', '0');
        return $this->db->get('ref_sampledna')->result();
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
    
    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    // function delete($id_user, $data)
    // {
    //     $this->db->where($this->id, $id);
    //     $this->db->update($this->table, $data);
    // }

    // function delete($id)
    // {
        // $this->db->where($this->id, $id);
        // $this->db->delete($this->table);
    // }

    // function getLabtech(){
    //     $response = array();
    //     $this->db->select('*');
    //     $this->db->where('position', 'Lab Tech');
    //     $q = $this->db->get('Ref_allsample');
    //     $response = $q->result_array();
    
    //     return $response;
    //   }

    //   function getSampleType(){

    //     $response = array();
    //     // Select record
    //     $this->db->select('*');
    //     $this->db->where('obj', 'O3');
    //     $q = $this->db->get('Ref_allsample');
    //     $response = $q->result_array();
    
    //     return $response;
    //   }

      function validate1($id){
        $this->db->where('barcode_sample', $id);
        $this->db->where('flag', '0');
        // $this->db->where('lab', $this->session->userdata('lab'));
        $q = $this->db->get($this->table);
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

      function generate_excel_report($date1, $date2) {
        
        $sheets = array(
            array(
                'DNA_Extraction',
                'SELECT a.barcode_dna AS "Barcode_DNA", a.barcode_sample AS "Source_Barcode_sample", a.date_extraction AS "Date_extraction", b.initial AS "Lab_tech", 
                a.kit_lot AS "Kit_lot", a.sampletype AS "Sample_type", c.Barcode_sample AS "Parent_Barcode_Sample", c.sampletype AS "Parent_Sample_Type", a.weights AS "Weights", 
                a.tube_number AS "Tube_number", a.cryobox AS "Cryobox", a.barcode_metagenomics AS "Barcode_metagenomics", 
                concat("F",d.freezer,"-","S",d.shelf,"-","R",d.rack,"-","DRW",d.rack_level) AS "Location", a.meta_box AS "Meta_box", a.qc_status AS "QC_Status", a.comments AS "Comments"
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
                                            "DNA Control" AS sample_type
                                            FROM dna_control a
                                            WHERE a.lab = "'.$this->session->userdata('lab').'" AND LENGTH(TRIM(a.barcode_vessel)) > 0
                        UNION ALL
                                            SELECT a.barcode_vessel2 barcode, null vessel, null type, a.barcode_sample, 
                                            "DNA Control" AS sample_type
                                            FROM dna_control a
                                            WHERE a.lab = "'.$this->session->userdata('lab').'" AND LENGTH(TRIM(a.barcode_vessel2)) > 0
                        UNION ALL
                                            SELECT a.barcode_vessel3 barcode, null vessel, null type, a.barcode_sample, 
                                            "DNA Control" AS sample_type
                                            FROM dna_control a
                                            WHERE a.lab = "'.$this->session->userdata('lab').'" AND LENGTH(TRIM(a.barcode_vessel3)) > 0
                        UNION ALL
                                            SELECT a.barcode_vessel4 barcode, null vessel, null type, a.barcode_sample, 
                                            "DNA Control" AS sample_type
                                            FROM dna_control a
                                            WHERE a.lab = "'.$this->session->userdata('lab').'" AND LENGTH(TRIM(a.barcode_vessel4)) > 0
                        UNION ALL
                                            SELECT a.barcode_vessel5 barcode, null vessel, null type, a.barcode_sample, 
                                            "DNA Control" AS sample_type
                                            FROM dna_control a
                                            WHERE a.lab = "'.$this->session->userdata('lab').'" AND LENGTH(TRIM(a.barcode_vessel5)) > 0
                                            ) c ON a.barcode_sample=c.barcode									
                LEFT JOIN (
                            SELECT a.id, a.date_in, a.time_in, a.barcode_sample, a.lab, a.id_location_80
                            FROM freezer_in a
                            JOIN (
                            SELECT id, barcode_sample, MIN(CONCAT(date_in, time_in)) max_recent FROM freezer_in
                            GROUP BY barcode_sample
                            ) b ON a.barcode_sample=b.barcode_sample AND CONCAT(a.date_in, a.time_in) = b.max_recent
                ) g ON a.barcode_dna=g.barcode_sample AND g.lab = "'.$this->session->userdata('lab').'"
                LEFT JOIN ref_location_80 d on g.id_location_80=d.id_location_80 AND d.lab = "'.$this->session->userdata('lab').'"                             									
                WHERE a.lab = "'.$this->session->userdata('lab').'"
                AND (a.date_extraction >= "'.$date1.'"
                AND a.date_extraction <= "'.$date2.'")
                AND a.flag = 0 
                ORDER BY a.date_extraction, a.barcode_dna ASC
                ',
                array('Barcode_DNA', 'Source_Barcode_sample', 'Date_extraction', 'Lab_tech', 'Kit_lot', 'Sample_type', 'Parent_Barcode_Sample', 'Parent_Sample_Type', 'Weights',
                        'Tube_number', 'Cryobox', 'Barcode_metagenomics', 'Location', 'Meta_box', 'QC_Status','Comments'),
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
                ',
                array('Barcode_DNA', 'Date_concentration', 'Lab_tech', 'Sample_type', 'DNA_concentration', 'Comments'),
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
        );

        return $sheets;
      }

}

/* End of file Tbl_delivery_model.php */
/* Location: ./application/models/Tbl_delivery_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:38:42 */
/* http://harviacode.com */