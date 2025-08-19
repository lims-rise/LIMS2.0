<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class DNA_extraction_model extends CI_Model
{

    public $table = 'dna_extraction';
    public $id = 'barcode_dna';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json() {
        $this->datatables->select('a.barcode_sample, a.date_extraction, d.initial, a.kit_lot, a.sampletype as `type`, a.weights, a.barcode_dna, a.tube_number, a.cryobox, 
            a.barcode_metagenomics, a.id_location, a.meta_box, a.qc_status, a.comments, a.id_freezer1, a.id_freezer2, a.id_person, a.lab, a.flag, b.freezer, b.shelf, b.rack, b.rack_level');
        $this->datatables->from('dna_extraction a');
        $this->datatables->join('freezer_in c', 'a.id_freezer1 = c.id AND c.lab = '.$this->session->userdata('lab') , 'left');
        $this->datatables->join('ref_location_80 b', 'c.id_location_80 = b.id_location_80 AND b.lab = '.$this->session->userdata('lab') , 'left');
        $this->datatables->join('ref_person d', 'a.id_person = d.id_person', 'left');
        $this->datatables->where('a.lab', $this->session->userdata('lab'));
        $this->datatables->where('a.flag', '0');

        $lvl = $this->session->userdata('id_user_level');
        if ($lvl == 7){
            $this->datatables->add_column('action', '', 'a.barcode_dna');
        }
        else if (($lvl == 2) | ($lvl == 3)){
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>', 'a.barcode_dna');
        }
        else {
            $this->datatables->add_column('action', '<button type="button" class="btn_edit btn btn-info btn-sm" aria-hidden="true"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Update</button>'." 
                ".'<button type="button" class="btn_delete btn btn-danger btn-sm" data-id="$1" aria-hidden="true"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', 'a.barcode_dna');
        }
        return $this->datatables->generate();
    }

    // function json()
    // {
    //     $q = $this->datatables->query('SELECT a.barcode_sample, a.date_extraction, b.initial, a.kit_lot, c.type, a.barcode_dna, a.tube_number, a.cryobox, 
    //     a.barcode_metagenomics, 
    //     concat("F",d.freezer,"-","S",d.shelf,"-","R",d.rack,"-","DRW",d.rack_level) AS Location, a.meta_box, a.comments
    //     FROM dna_extraction a
    //     LEFT JOIN ref_person b ON a.id_person = b.id_person
    //     LEFT JOIN (SELECT barcode_p1a  barcode, cryobox1  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(barcode_p1a)) > 0
    //     UNION ALL
    //     SELECT barcode_p2a  barcode, cryobox2  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(barcode_p2a)) > 0
    //     UNION ALL
    //     SELECT TRIM(barcode_p3a) barcode, cryobox3  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(barcode_p3a)) > 0
    //     UNION ALL
    //     SELECT packed_cells barcode, cryobox_pc  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(packed_cells)) > 0
    //     UNION ALL
    //     SELECT barcode_wb  barcode, cryoboxwb  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(barcode_wb)) > 0
    //     UNION ALL
    //     SELECT barcode_sst1  barcode, cryobox1  vessel, "O3 Blood-SST" type
    //     FROM obj3_sst_aliquots
    //     WHERE LENGTH(TRIM(barcode_sst1)) > 0
    //     UNION ALL
    //     SELECT barcode_sst2  barcode, cryobox2  vessel, "O3 Blood-SST" type
    //     FROM obj3_sst_aliquots
    //     WHERE LENGTH(TRIM(barcode_sst2)) > 0
    //     UNION ALL
    //     SELECT barcode_sample  barcode, freezer_bag  vessel, "O3 Filter Paper" type
    //     FROM obj3_bfilterpaper
    //     WHERE LENGTH(TRIM(barcode_sample)) > 0
    //     UNION ALL
    //     SELECT aliquot1  barcode, cryobox1  vessel, "O3 Feces" type
    //     FROM obj3_faliquot
    //     WHERE LENGTH(TRIM(aliquot1)) > 0
    //     UNION ALL
    //     SELECT aliquot2  barcode, cryobox2  vessel, "O3 Feces" type
    //     FROM obj3_faliquot
    //     WHERE LENGTH(TRIM(aliquot2)) > 0
    //     UNION ALL
    //     SELECT aliquot3  barcode, cryobox3  vessel, "O3 Feces" type
    //     FROM obj3_faliquot
    //     WHERE LENGTH(TRIM(aliquot3)) > 0
    //     UNION ALL
    //     SELECT aliquot_zymo  barcode, cryobox_zymo  vessel, "O3 Feces" type
    //     FROM obj3_faliquot
    //     WHERE LENGTH(TRIM(aliquot_zymo)) > 0
    //     UNION ALL
    //     SELECT bar_macsweep1  barcode, cryobox1  vessel, "O3 Feces" type
    //     FROM obj3_fmac2
    //     WHERE LENGTH(TRIM(bar_macsweep1)) > 0
    //     UNION ALL
    //     SELECT bar_macsweep2  barcode, cryobox2  vessel, "O3 Feces" type
    //     FROM obj3_fmac2
    //     WHERE LENGTH(TRIM(bar_macsweep2)) > 0
    //     UNION ALL
    //     SELECT barcode_dna_bag  barcode, barcode_storage  vessel, CONCAT("O2B ", c.sampletype) type
    //     FROM obj2b_metagenomics a
    //     LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
    //     LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
    //     WHERE LENGTH(TRIM(barcode_dna_bag)) > 0
    //     UNION ALL
    //     SELECT barcode_dna1  barcode, barcode_storage1  vessel, CONCAT("O2B ", c.sampletype) type
    //     FROM obj2b_meta_sediment a
    //     LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
    //     LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
    //     WHERE LENGTH(TRIM(barcode_dna1)) > 0
    //     UNION ALL
    //     SELECT barcode_dna2  barcode, barcode_storage2  vessel, CONCAT("O2B ", c.sampletype) type
    //     FROM obj2b_meta_sediment a
    //     LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
    //     LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
    //     WHERE LENGTH(TRIM(barcode_dna2)) > 0) c ON a.barcode_sample=c.barcode
    //     LEFT JOIN ref_location_80 d on a.id_location=d.id_location_80 AND d.lab = "'.$this->session->userdata('lab').'" 
    //     WHERE a.lab = "'.$this->session->userdata('lab').'" 
    //     AND a.flag = 0 
    //     ORDER BY a.date_extraction
    //     ');
    //     $response = $q->generate();
    //     return $response;    
    // }

    // function get_all()  <-- old function
    // {
    //     $q = $this->db->query('SELECT a.barcode_sample, a.date_extraction, b.initial, a.kit_lot, c.type, a.barcode_dna, a.weights, a.tube_number, a.cryobox, 
    //     a.barcode_metagenomics, 
    //     concat("F",d.freezer,"-","S",d.shelf,"-","R",d.rack,"-","DRW",d.rack_level) AS Location, a.meta_box, a.qc_status, a.comments
    //     FROM dna_extraction a
    //     LEFT JOIN ref_person b ON a.id_person = b.id_person
    //     LEFT JOIN (SELECT barcode_p1a  barcode, cryobox1  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(barcode_p1a)) > 0
    //     UNION ALL
    //     SELECT barcode_p2a  barcode, cryobox2  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(barcode_p2a)) > 0
    //     UNION ALL
    //     SELECT TRIM(barcode_p3a) barcode, cryobox3  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(barcode_p3a)) > 0
    //     UNION ALL
    //     SELECT packed_cells barcode, cryobox_pc  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(packed_cells)) > 0
    //     UNION ALL
    //     SELECT barcode_wb  barcode, cryoboxwb  vessel, "O3 Blood-EDTA" type
    //     FROM obj3_edta_aliquots
    //     WHERE LENGTH(TRIM(barcode_wb)) > 0
    //     UNION ALL
    //     SELECT barcode_sst1  barcode, cryobox1  vessel, "O3 Blood-SST" type
    //     FROM obj3_sst_aliquots
    //     WHERE LENGTH(TRIM(barcode_sst1)) > 0
    //     UNION ALL
    //     SELECT barcode_sst2  barcode, cryobox2  vessel, "O3 Blood-SST" type
    //     FROM obj3_sst_aliquots
    //     WHERE LENGTH(TRIM(barcode_sst2)) > 0
    //     UNION ALL
    //     SELECT barcode_sample  barcode, freezer_bag  vessel, "O3 Filter Paper" type
    //     FROM obj3_bfilterpaper
    //     WHERE LENGTH(TRIM(barcode_sample)) > 0
    //     UNION ALL
    //     SELECT aliquot1  barcode, cryobox1  vessel, "O3 Feces" type
    //     FROM obj3_faliquot
    //     WHERE LENGTH(TRIM(aliquot1)) > 0
    //     UNION ALL
    //     SELECT aliquot2  barcode, cryobox2  vessel, "O3 Feces" type
    //     FROM obj3_faliquot
    //     WHERE LENGTH(TRIM(aliquot2)) > 0
    //     UNION ALL
    //     SELECT aliquot3  barcode, cryobox3  vessel, "O3 Feces" type
    //     FROM obj3_faliquot
    //     WHERE LENGTH(TRIM(aliquot3)) > 0
    //     UNION ALL
    //     SELECT aliquot_zymo  barcode, cryobox_zymo  vessel, "O3 Feces" type
    //     FROM obj3_faliquot
    //     WHERE LENGTH(TRIM(aliquot_zymo)) > 0
    //     UNION ALL
    //     SELECT bar_macsweep1  barcode, cryobox1  vessel, "O3 Feces" type
    //     FROM obj3_fmac2
    //     WHERE LENGTH(TRIM(bar_macsweep1)) > 0
    //     UNION ALL
    //     SELECT bar_macsweep2  barcode, cryobox2  vessel, "O3 Feces" type
    //     FROM obj3_fmac2
    //     WHERE LENGTH(TRIM(bar_macsweep2)) > 0
    //     UNION ALL
    //     SELECT barcode_dna_bag  barcode, barcode_storage  vessel, CONCAT("O2B ", c.sampletype) type
    //     FROM obj2b_metagenomics a
    //     LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
    //     LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
    //     WHERE LENGTH(TRIM(barcode_dna_bag)) > 0
    //     UNION ALL
    //     SELECT barcode_dna1  barcode, barcode_storage1  vessel, CONCAT("O2B ", c.sampletype) type
    //     FROM obj2b_meta_sediment a
    //     LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
    //     LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
    //     WHERE LENGTH(TRIM(barcode_dna1)) > 0
    //     UNION ALL
    //     SELECT barcode_dna2  barcode, barcode_storage2  vessel, CONCAT("O2B ", c.sampletype) type
    //     FROM obj2b_meta_sediment a
    //     LEFT JOIN obj2b_receipt b ON a.barcode_sample=b.barcode_sample
    //     LEFT JOIN ref_sampletype c ON b.id_type2b=c.id_sampletype
    //     WHERE LENGTH(TRIM(barcode_dna2)) > 0) c ON a.barcode_sample=c.barcode
    //     LEFT JOIN ref_location_80 d on a.id_location=d.id_location_80 AND d.lab = "'.$this->session->userdata('lab').'" 
    //     WHERE a.lab = "'.$this->session->userdata('lab').'" 
    //     AND a.flag = 0 
    //     ORDER BY a.date_extraction
    //     ');
    //     $response = $q->result();
    //     return $response;    
    // }

    function get_all()
    {
        $q = $this->db->query('SELECT a.barcode_dna, a.barcode_sample AS "source_barcode_sample", a.date_extraction, b.initial, a.kit_lot, a.sampletype, c.Barcode_sample AS "parent_barcode_sample", c.sampletype AS "parent_sample_type", a.weights, a.tube_number, a.cryobox, 
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
        AND a.flag = 0 
        ORDER BY a.date_extraction
        ');
        $response = $q->result();
        return $response;    
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
    
    function update_freezer($id_f, $data)
    {
        $this->db->where('id', $id_f);
        $this->db->update('freezer_in', $data);
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

    function get_location($id_f, $id_s, $id_r, $id_d)
    {
        $q = $this->db->query('
        SELECT id_location_80 FROM ref_location_80 
        WHERE freezer = "'.$id_f.'" 
        AND shelf = "'.$id_s.'" 
        AND rack = "'.$id_r.'" 
        AND rack_level = "'.$id_d.'" 
        AND lab = "'.$this->session->userdata('lab').'" 
        AND flag = 0 
        ');
        //$url = $this->db->where('id_user_level',$user['id_user_level'])->get('tbl_user_level')->row();
        $response = $q->result_array();
        return $response;
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

    function get_freez($freez, $shelf, $rack, $draw){
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        $q = $this->db->query('
        SELECT id_location_80 FROM ref_location_80
        WHERE freezer = "'.$freez.'"
        AND shelf = "'.$shelf.'"
        AND rack = "'.$rack.'"
        AND rack_level = "'.$draw.'"
        AND lab = "'.$this->session->userdata('lab').'" 
        AND flag = 0 
        ');        
        return $q->row()->id_location_80;
        // $response = $q->result_array();
        // return $response;
        // return $this->db->get('ref_location_80')->row();
      }            


      function get_id_freezer($id_freezer){
        $q = $this->db->query('
            SELECT MAX(id) AS id_freezer FROM freezer_in
            WHERE barcode_sample = "'.$id_freezer.'"
            GROUP BY barcode_sample
        ');        
        return $q->row()->id_freezer;
      }  

      function getFreezer1(){
        $response = array();
        // $this->db->select('freezer');
        // $q = $this->db->get('ref_location_80');
        $q = $this->db->query('
            SELECT DISTINCT freezer FROM ref_location_80
            WHERE lab = "'.$this->session->userdata('lab').'" 
            AND flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
      }

      function getFreezer2(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT shelf FROM ref_location_80
            WHERE lab = "'.$this->session->userdata('lab').'" 
            AND flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
      }

      function getFreezer3(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT rack FROM ref_location_80
            WHERE lab = "'.$this->session->userdata('lab').'" 
            AND flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
      }

      function getFreezer4(){
        $response = array();
        $q = $this->db->query('
            SELECT DISTINCT rack_level FROM ref_location_80
            WHERE lab = "'.$this->session->userdata('lab').'" 
            AND flag = 0 
        ');
        $response = $q->result_array();    
        return $response;
      }
      
      function validate1($id){
        $q = $this->db->query('
            SELECT barcode,  `type` FROM v_ref_dna_ex 
            WHERE barcode = "'. $id .'"
            AND vessel IN (SELECT barcode_sample FROM freezer_in)
            UNION ALL
            SELECT a.barcode_vessel AS barcode, b.sample AS `type` FROM dna_control a
            LEFT JOIN ref_sampledna b ON a.id_sample=b.id_sample
            WHERE barcode_vessel = "'. $id .'"
            AND a.flag = 0
            UNION ALL
            SELECT barcode_sample AS barcode, CONCAT("O2B ", b.sampletype) AS `type`
            FROM obj2b_receipt a
            LEFT JOIN ref_sampletype b ON a.id_type2b=b.id_sampletype
            WHERE a.barcode_sample = "'. $id .'"
            AND a.flag = 0
        ');
        // $this->db->where('barcode_sample', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }

      function validatedna($id){
        $q = $this->db->query('
        SELECT bar_s2 FROM v_all_s2
        WHERE bar_s2 = "'.$id.'"       
        ');        
        $response = $q->result_array();
        return $response;
      }      

      function validatednaxxx($id){
        $this->db->where('barcode_dna', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        $q = $this->db->get($this->table);
        $response = $q->result_array();
        return $response;
        // return $this->db->get('ref_location_80')->row();
      }      

      function validate_cb($id){
        $q = $this->db->query('
        SELECT cryobox, COUNT(*) AS num
        FROM dna_extraction
        WHERE cryobox = "'. $id .'"
        AND flag = 0
        GROUP BY cryobox');
        
        // $this->db->where('barcode_dna', $id);
        // $this->db->where('lab', $this->session->userdata('lab'));
        // $q = $this->db->get($this->table);
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