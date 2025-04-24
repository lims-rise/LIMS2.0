<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class REP_nhmrc_model extends CI_Model
{

    public $table = 'nhmrc_receipt';
    public $id = 'barcode_sample';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json($date1, $date2, $rep) {
        $this->datatables->select('a.barcode_sample, a.date_arrival, a.time_arrival, b.sampletype, a.png_control, a.barcode_tinytag');
        $this->datatables->from('nhmrc_receipt a');
        $this->datatables->join('ref_sampletype b', 'a.id_type2b = b.id_sampletype', 'left');
        if ($rep == '6x') {
            $this->datatables->where('a.id_type2b', '6');
            $this->datatables->where("(LEFT(a.barcode_sample, 2) = 'N0' OR LEFT(a.barcode_sample, 2) = 'F0')");
        }
        else if ($rep == '6') {
            $this->datatables->where('a.id_type2b', '6');
            $this->datatables->where("(LEFT(a.barcode_sample, 2) <> 'N0' AND LEFT(a.barcode_sample, 2) <> 'F0')");
        }
        else {
            $this->datatables->where('a.id_type2b', $rep);
        } 
        $this->datatables->where('a.lab', $this->session->userdata('lab'));
        $this->datatables->where('a.flag', '0');
        $this->datatables->where("(a.date_arrival >= IF('$date1' IS NULL or '$date1' = '', '0000-00-00', '$date1'))", NULL);
        $this->datatables->where("(a.date_arrival <= IF('$date2' IS NULL or '$date2' = '', NOW(), '$date2'))", NULL);
        // $this->datatables->limit('50');
        return $this->datatables->generate();
    }

    function get_porchbootsock($date1, $date2, $rep)
    {
        $q = $this->db->query('
        SELECT 
        a.barcode_sample, q.sampletype, 
        a.date_arrival AS reception_date_arrival, 
        a.time_arrival AS reception_time_arrival,  
        a.png_control AS reception_png_control, 
        a.barcode_tinytag AS reception_barcode_tinytag,
        a.comments AS reception_comments,
        g.date_weighed AS bs_before_date_weighed_micro,
        g.barcode_bootsocks AS bs_before_barcode_bootsocks_micro,
        g.bootsock_weight_dry AS bs_before_bootsock_weight_dry_micro,
        g.comments AS bs_before_comment_micro,
        r.date_weighed AS bs_before_date_weighed_moisture,
        r.barcode_bootsocks AS bs_before_barcode_bootsocks_moisture,
        r.bootsock_weight_dry AS bs_before_bootsock_weight_dry_moisture,
        r.comments AS bs_before_comment_moisture,
        h.date_weighed AS bs_after_date_weighed_micro, 
        h.barcode_bootsocks AS bs_after_barcode_bootsocks_micro, 
        h.bootsock_weight_wet AS bs_after_bootsock_weight_wet_micro,
        h.comments AS bs_after_comment_micro,
        s.date_weighed AS bs_after_date_weighed_moisture, 
        s.barcode_bootsocks AS bs_after_barcode_bootsocks_moisture, 
        s.bootsock_weight_wet AS bs_after_bootsock_weight_wet_moisture,
        s.comments AS bs_after_comment_moisture,
        b.date_conduct AS stomacher_date_conduct,
        b.barcode_bootsock AS stomacher_barcode_bootsocks_Micro,
        b.elution_no AS stomacher_elution_number_Micro1,
        b.elution AS stomacher_elution_Micro1,
        b.barcode_falcon AS stomacher_barcode_falcon_Micro1,
        b.volume_stomacher AS stomacher_volume_Micro1,
        c.elution_no AS stomacher_elution_number_Micro2,
        c.elution AS stomacher_elution_Micro2,
        c.barcode_falcon AS stomacher_barcode_falcon_Micro2,
        c.volume_stomacher AS stomacher_volume_Micro2,
        d.barcode_bootsock AS stomacher_barcode_bootsocks_Moisture,
        d.elution_no AS stomacher_elution_number_Moisture1,
        d.elution AS stomacher_elution_Moisture1,
        d.barcode_falcon AS stomacher_barcode_falcon_Moisture1,
        d.volume_stomacher AS stomacher_volume_Moisture1,
        e.elution_no AS stomacher_elution_number_Moisture2,
        e.elution AS stomacher_elution_Moisture2,
        e.barcode_falcon AS stomacher_barcode_falcon_Moisture2,
        e.volume_stomacher AS stomacher_volume_Moisture2,
        f.barcode_colilert AS stom_idexx_in_barcode_colilert,
        f.barcode_falcon1 AS stom_idexx_in_barcode_falcon1,
        f.volume_falcon1 AS stom_idexx_in_volume_falcon1,
        f.barcode_falcon2 AS stom_idexx_in_barcode_falcon2,
        f.volume_falcon2 AS stom_idexx_in_volume_falcon2,
        f.dilution AS stom_idexx_in_dilution,
        f.time_incubation AS stom_idexx_in_time_incu_start,
        f.comments AS stom_idexx_in_comments,
        j.date_conduct AS idexx_out_date_conduct,
        j.timeout_incubation AS idexx_out_timeout_incubation,
        j.time_minutes AS idexx_out_time_minutes,
        j.ecoli_largewells AS idexx_out_ecoli_largewells,
        j.ecoli_smallwells AS idexx_out_ecoli_smallwells,
        j.ecoli_mpn AS idexx_out_ecoli_mpn,
        j.coliforms_largewells AS idexx_out_coliforms_largewells,
        j.coliforms_smallwells AS idexx_out_coliforms_smallwells,
        j.coliforms_mpn AS idexx_out_coliforms_mpn,
        j.comments AS idexx_out_comments,
        k.date_moisture AS mois_initial_date_moisture,
        k.barcode_foil AS mois_initial_barcode_foil_tray,
        k.foil_weight AS mois_initial_foil_tray_weight,
        k.time_filter_start AS mois_initial_time_filter_start,
        k.time_filter_finish AS mois_initial_time_filter_finish,
        k.wet_weight AS mois_initial_wet_weight,
        k.time_incubator AS mois_initial_time_incubator,
        k.comments AS mois_initial_comments,
        l.date_moisture AS mois24_date_moisture,
        l.dry_weight24 AS mois24_dry_weight24,
        l.comments AS mois24_comments,
        m.date_moisture AS mois48_date_moisture,
        m.dry_weight48 AS mois48_dry_weight48,
        m.difference AS mois48_difference,
        m.comments AS mois48_comments,
        n.date_moisture AS mois72_date_moisture,
        n.dry_weight72 AS mois72_dry_weight48,
        n.comments AS mois72_comments,
        i.date_conduct AS metagenomics_date_conduct,
        i.barcode_sample AS metagenomics_barcode_falcon1,
        i.barcode_falcon2 AS metagenomics_barcode_falcon2,
        i.volume_filtered AS metagenomics_volume_filtered,
        i.time_started AS metagenomics_time_started,
        i.time_finished AS metagenomics_time_finished,
        i.time_minutes AS metagenomics_time_minutes,
        i.barcode_dna_bag AS metagenomics_barcode_dna_bag,
        i.barcode_storage AS metagenomics_barcode_storage,
        concat("F",t.freezer,"-","S",t.shelf,"-","R",t.rack,"-","DRW",t.rack_level) AS metagenomics_location,
        i.comments AS metagenomics_comments,
        o.bar_macconkey AS mac1_barcode_macconkey,
        o.date_process AS mac1_date_process,
        o.time_process AS mac1_time_process,
        o.volume AS mac1_volume,
        o.comments AS mac1_comments,
        p.date_process AS mac2_date_process,
        p.time_process AS mac2_time_process,
        p.bar_macsweep1 AS mac2_bar_macsweep1,
        p.cryobox1 AS mac2_cryobox1,
        concat("F",u.freezer,"-","S",u.shelf,"-","R",u.rack,"-","DRW",u.rack_level) AS macsweep1_location,
        p.bar_macsweep2 AS mac2_bar_macsweep2,
        p.cryobox2 AS mac2_cryobox2,
        concat("F",v.freezer,"-","S",v.shelf,"-","R",v.rack,"-","DRW",v.rack_level) AS macsweep2_location,
        p.comments AS mac2_comments

        FROM nhmrc_receipt a
        LEFT JOIN nhmrc_bs_stomacher b ON a.barcode_sample=b.barcode_sample AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_bs_stomacher c ON a.barcode_sample=c.barcode_sample AND c.elution_no="Micro2"
        LEFT JOIN nhmrc_bs_stomacher d ON a.barcode_sample=d.barcode_sample AND d.elution_no="Moisture1"
        LEFT JOIN nhmrc_bs_stomacher e ON a.barcode_sample=e.barcode_sample AND e.elution_no="Moisture2"
        LEFT JOIN nhmrc_subbs_idexx f ON b.barcode_bootsock=f.barcode_sample 
        LEFT JOIN nhmrc_bootsocks_before g ON b.barcode_bootsock=g.barcode_bootsocks AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_bootsocks_after h ON b.barcode_bootsock=h.barcode_bootsocks AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_bootsocks_before r ON d.barcode_bootsock=r.barcode_bootsocks AND d.elution_no="Moisture1"
        LEFT JOIN nhmrc_bootsocks_after s ON d.barcode_bootsock=s.barcode_bootsocks AND d.elution_no="Moisture1"
        LEFT JOIN nhmrc_metagenomics i ON f.barcode_falcon1=i.barcode_sample
        LEFT JOIN nhmrc_idexx2 j ON f.barcode_colilert=j.barcode_colilert
        LEFT JOIN nhmrc_moisture1 k ON d.barcode_falcon=k.barcode_sample
        LEFT JOIN nhmrc_moisture2 l ON k.barcode_foil=l.barcode_foil
        LEFT JOIN nhmrc_moisture3 m ON k.barcode_foil=m.barcode_foil
        LEFT JOIN nhmrc_moisture4 n ON k.barcode_foil=n.barcode_foil
        LEFT JOIN nhmrc_mac1 o ON f.barcode_falcon1=o.barcode_sample
        LEFT JOIN nhmrc_mac2 p ON o.bar_macconkey=p.bar_macconkey
        LEFT JOIN ref_sampletype q ON a.id_type2b = q.id_sampletype
        LEFT JOIN ref_location_80 t ON i.id_location_80=t.id_location_80 AND t.lab = "'.$this->session->userdata('lab').'" 
        LEFT JOIN ref_location_80 u ON p.id_location_80_1=u.id_location_80 AND u.lab = "'.$this->session->userdata('lab').'" 
        LEFT JOIN ref_location_80 v ON p.id_location_80_2=v.id_location_80 AND v.lab = "'.$this->session->userdata('lab').'" 
                WHERE a.id_type2b = "'.$rep.'"
        AND (a.date_arrival >= "'.$date1.'"
            AND a.date_arrival <= "'.$date2.'")
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_arrival DESC, a.time_arrival ASC
        ');        
        $response = $q->result();
        return $response;
    }        

    function get_handboot($date1, $date2, $rep)
    {
        $q = $this->db->query('

        SELECT 
        a.barcode_sample, q.sampletype, 
        a.date_arrival AS reception_date_arrival, 
        a.time_arrival AS reception_time_arrival,  
        a.png_control AS reception_png_control, 
        a.barcode_tinytag AS reception_barcode_tinytag,
        a.comments AS reception_comments,
        g.date_weighed AS bs_before_date_weighed_micro,
        g.barcode_bootsocks AS bs_before_barcode_bootsocks_micro,
        g.bootsock_weight_dry AS bs_before_bootsock_weight_dry_micro,
        g.comments AS bs_before_comment_micro,
        h.date_weighed AS bs_after_date_weighed_micro, 
        h.barcode_bootsocks AS bs_after_barcode_bootsocks_micro, 
        h.bootsock_weight_wet AS bs_after_bootsock_weight_wet_micro,
        h.comments AS bs_after_comment_micro,
        b.date_conduct AS stomacher_date_conduct,
        b.barcode_bootsock AS stomacher_barcode_bootsocks_Micro,
        b.elution_no AS stomacher_elution_number_Micro1,
        b.elution AS stomacher_elution_Micro1,
        b.barcode_falcon AS stomacher_barcode_falcon_Micro1,
        b.volume_stomacher AS stomacher_volume_Micro1,
        c.elution_no AS stomacher_elution_number_Micro2,
        c.elution AS stomacher_elution_Micro2,
        c.barcode_falcon AS stomacher_barcode_falcon_Micro2,
        c.volume_stomacher AS stomacher_volume_Micro2,
        f.barcode_colilert AS stom_idexx_in_barcode_colilert,
        f.barcode_falcon1 AS stom_idexx_in_barcode_falcon1,
        f.volume_falcon1 AS stom_idexx_in_volume_falcon1,
        f.barcode_falcon2 AS stom_idexx_in_barcode_falcon2,
        f.volume_falcon2 AS stom_idexx_in_volume_falcon2,
        f.dilution AS stom_idexx_in_dilution,
        f.time_incubation AS stom_idexx_in_time_incu_start,
        f.comments AS stom_idexx_in_comments,
        j.date_conduct AS idexx_out_date_conduct,
        j.timeout_incubation AS idexx_out_timeout_incubation,
        j.time_minutes AS idexx_out_time_minutes,
        j.ecoli_largewells AS idexx_out_ecoli_largewells,
        j.ecoli_smallwells AS idexx_out_ecoli_smallwells,
        j.ecoli_mpn AS idexx_out_ecoli_mpn,
        j.coliforms_largewells AS idexx_out_coliforms_largewells,
        j.coliforms_smallwells AS idexx_out_coliforms_smallwells,
        j.coliforms_mpn AS idexx_out_coliforms_mpn,
        j.comments AS idexx_out_comments,
        i.date_conduct AS metagenomics_date_conduct,
        i.barcode_sample AS metagenomics_barcode_falcon1,
        i.barcode_falcon2 AS metagenomics_barcode_falcon2,
        i.volume_filtered AS metagenomics_volume_filtered,
        i.time_started AS metagenomics_time_started,
        i.time_finished AS metagenomics_time_finished,
        i.time_minutes AS metagenomics_time_minutes,
        i.barcode_dna_bag AS metagenomics_barcode_dna_bag,
        i.barcode_storage AS metagenomics_barcode_storage,
        concat("F",t.freezer,"-","S",t.shelf,"-","R",t.rack,"-","DRW",t.rack_level) AS metagenomics_location,
        i.comments AS metagenomics_comments,
        o.bar_macconkey AS mac1_barcode_macconkey,
        o.date_process AS mac1_date_process,
        o.time_process AS mac1_time_process,
        o.volume AS mac1_volume,
        o.comments AS mac1_comments,
        p.date_process AS mac2_date_process,
        p.time_process AS mac2_time_process,
        p.bar_macsweep1 AS mac2_bar_macsweep1,
        p.cryobox1 AS mac2_cryobox1,
        concat("F",u.freezer,"-","S",u.shelf,"-","R",u.rack,"-","DRW",u.rack_level) AS macsweep1_location,
        p.bar_macsweep2 AS mac2_bar_macsweep2,
        p.cryobox2 AS mac2_cryobox2,
        concat("F",v.freezer,"-","S",v.shelf,"-","R",v.rack,"-","DRW",v.rack_level) AS macsweep2_location,
        p.comments AS mac2_comments

        FROM nhmrc_receipt a
        LEFT JOIN nhmrc_bs_stomacher b ON a.barcode_sample=b.barcode_sample AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_bs_stomacher c ON a.barcode_sample=c.barcode_sample AND c.elution_no="Micro2"
        LEFT JOIN nhmrc_subbs_idexx f ON b.barcode_bootsock=f.barcode_sample 
        LEFT JOIN nhmrc_bootsocks_before g ON b.barcode_bootsock=g.barcode_bootsocks AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_bootsocks_after h ON b.barcode_bootsock=h.barcode_bootsocks AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_metagenomics i ON f.barcode_falcon1=i.barcode_sample
        LEFT JOIN nhmrc_idexx2 j ON f.barcode_colilert=j.barcode_colilert
        LEFT JOIN nhmrc_mac1 o ON f.barcode_falcon1=o.barcode_sample
        LEFT JOIN nhmrc_mac2 p ON o.bar_macconkey=p.bar_macconkey
        LEFT JOIN ref_sampletype q ON a.id_type2b = q.id_sampletype
        LEFT JOIN ref_location_80 t ON i.id_location_80=t.id_location_80 AND t.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 u ON p.id_location_80_1=u.id_location_80 AND u.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 v ON p.id_location_80_2=v.id_location_80 AND v.lab = "'.$this->session->userdata('lab').'"
        WHERE a.id_type2b = "'.$rep.'"
        AND (a.date_arrival >= "'.$date1.'"
            AND a.date_arrival <= "'.$date2.'")
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_arrival DESC, a.time_arrival ASC
        ');        
        $response = $q->result();
        return $response;
    }    


    function get_handrince($date1, $date2, $rep)
    {
        $q = $this->db->query('
        SELECT 
        a.barcode_sample, g.sampletype, 
        a.date_arrival AS reception_date_arrival, 
        a.time_arrival AS reception_time_arrival,  
        a.png_control AS reception_png_control, 
        a.barcode_tinytag AS reception_barcode_tinytag,
        a.comments AS reception_comments,
        k.barcode_bottle AS sampleentry_barcode_bottle,
        k.date_conduct AS sampleentry_date_conduct,
        k.vol_aliquot AS sampleentry_vol_aliquot,
        k.barcode_box AS sampleentry_barcode_box,
        k.position_tube AS sampleentry_position_tube,
        concat("F",l.freezer,"-","S",l.shelf,"-","R",l.rack,"-","DRW",l.rack_level) AS sampleentry_location,
        k.comments AS sampleentry_comments,
        b.date_conduct AS idexx_in_date_conduct,
        b.time_incubation AS idexx_in_time_incubation,
        b.barcode_colilert AS idexx_in_barcode_colilert1,
        b.volume AS idexx_in_volume1,
        b.dilution AS idexx_in_dilution1,
        b.comments AS idexx_in_comments1,
        b.barcode_colilert2 AS idexx_in_barcode_colilert2,
        b.volume2 AS idexx_in_volume2,
        b.dilution2 AS idexx_in_dilution2,
        b.comments2 AS idexx_in_comments2,
        c.date_conduct AS idexx_out_date_conduct,
        c.timeout_incubation AS idexx_out_timeout_incubation,
        c.time_minutes AS idexx_out_time_minutes,
        c.ecoli_largewells AS idexx_out_ecoli_largewells,
        c.ecoli_smallwells AS idexx_out_ecoli_smallwells,
        c.ecoli_mpn AS idexx_out_ecoli_mpn,
        c.coliforms_largewells AS idexx_out_coliforms_largewells,
        c.coliforms_smallwells AS idexx_out_coliforms_smallwells,
        c.coliforms_mpn AS idexx_out_coliforms_mpn,
        c.comments AS idexx_out_comments,
        d.date_conduct AS metagenomics_date_conduct,
        d.barcode_sample AS metagenomics_barcode_falcon1,
        d.barcode_falcon2 AS metagenomics_barcode_falcon2,
        d.volume_filtered AS metagenomics_volume_filtered,
        d.time_started AS metagenomics_time_started,
        d.time_finished AS metagenomics_time_finished,
        d.time_minutes AS metagenomics_time_minutes,
        d.barcode_dna_bag AS metagenomics_barcode_dna_bag,
        d.barcode_storage AS metagenomics_barcode_storage,
        concat("F",h.freezer,"-","S",h.shelf,"-","R",h.rack,"-","DRW",h.rack_level) AS metagenomics_location,
        d.comments AS metagenomics_comments,
        e.bar_macconkey AS mac1_barcode_macconkey,
        e.date_process AS mac1_date_process,
        e.time_process AS mac1_time_process,
        e.volume AS mac1_volume,
        e.comments AS mac1_comments,
        f.date_process AS mac2_date_process,
        f.time_process AS mac2_time_process,
        f.bar_macsweep1 AS mac2_bar_macsweep1,
        f.cryobox1 AS mac2_cryobox1,
        concat("F",i.freezer,"-","S",i.shelf,"-","R",i.rack,"-","DRW",i.rack_level) AS macsweep1_location,
        f.bar_macsweep2 AS mac2_bar_macsweep2,
        f.cryobox2 AS mac2_cryobox2,
        concat("F",j.freezer,"-","S",j.shelf,"-","R",j.rack,"-","DRW",j.rack_level) AS macsweep2_location,
        f.comments AS mac2_comments
        FROM nhmrc_receipt a
        LEFT JOIN nhmrc_idexx1 b ON a.barcode_sample=b.barcode_sample
        LEFT JOIN nhmrc_idexx2 c ON b.barcode_colilert=c.barcode_colilert
        LEFT JOIN nhmrc_metagenomics d ON a.barcode_sample=d.barcode_sample
        LEFT JOIN nhmrc_mac1 e ON a.barcode_sample=e.barcode_sample
        LEFT JOIN nhmrc_mac2 f ON e.bar_macconkey=f.bar_macconkey
        LEFT JOIN ref_sampletype g ON a.id_type2b = g.id_sampletype
        LEFT JOIN ref_location_80 h ON d.id_location_80=h.id_location_80 AND h.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 i ON f.id_location_80_1=i.id_location_80 AND i.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 j ON f.id_location_80_2=j.id_location_80 AND j.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN nhmrc_sample_entry k ON a.barcode_sample = k.barcode_sample
        LEFT JOIN ref_location_80 l ON k.id_location_80=l.id_location_80 AND l.lab = "'.$this->session->userdata('lab').'"
        WHERE a.id_type2b = "'.$rep.'"
        AND (a.date_arrival >= "'.$date1.'"
            AND a.date_arrival <= "'.$date2.'")
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_arrival DESC, a.time_arrival ASC
        ');        
        $response = $q->result();
        return $response;
    }        

    function get_drinkwater($date1, $date2, $rep)
    {
        $q = $this->db->query('
        SELECT 
        a.barcode_sample, g.sampletype, 
        a.date_arrival AS reception_date_arrival, 
        a.time_arrival AS reception_time_arrival,  
        a.png_control AS reception_png_control, 
        a.barcode_tinytag AS reception_barcode_tinytag,
        a.comments AS reception_comments,
        b.date_conduct AS idexx_in_date_conduct,
        b.time_incubation AS idexx_in_time_incubation,
        b.barcode_colilert AS idexx_in_barcode_colilert1,
        b.volume AS idexx_in_volume1,
        b.dilution AS idexx_in_dilution1,
        b.comments AS idexx_in_comments1,
        b.barcode_colilert2 AS idexx_in_barcode_colilert2,
        b.volume2 AS idexx_in_volume2,
        b.dilution2 AS idexx_in_dilution2,
        b.comments2 AS idexx_in_comments2,
        c.date_conduct AS idexx_out_date_conduct,
        c.timeout_incubation AS idexx_out_timeout_incubation,
        c.time_minutes AS idexx_out_time_minutes,
        c.ecoli_largewells AS idexx_out_ecoli_largewells,
        c.ecoli_smallwells AS idexx_out_ecoli_smallwells,
        c.ecoli_mpn AS idexx_out_ecoli_mpn,
        c.coliforms_largewells AS idexx_out_coliforms_largewells,
        c.coliforms_smallwells AS idexx_out_coliforms_smallwells,
        c.coliforms_mpn AS idexx_out_coliforms_mpn,
        c.comments AS idexx_out_comments,
        d.date_conduct AS metagenomics_date_conduct,
        d.barcode_sample AS metagenomics_barcode_falcon1,
        d.barcode_falcon2 AS metagenomics_barcode_falcon2,
        d.volume_filtered AS metagenomics_volume_filtered,
        d.time_started AS metagenomics_time_started,
        d.time_finished AS metagenomics_time_finished,
        d.time_minutes AS metagenomics_time_minutes,
        d.barcode_dna_bag AS metagenomics_barcode_dna_bag,
        d.barcode_storage AS metagenomics_barcode_storage,
        concat("F",h.freezer,"-","S",h.shelf,"-","R",h.rack,"-","DRW",h.rack_level) AS metagenomics_location,
        d.comments AS metagenomics_comments,
        e.bar_macconkey AS mac1_barcode_macconkey,
        e.date_process AS mac1_date_process,
        e.time_process AS mac1_time_process,
        e.volume AS mac1_volume,
        e.comments AS mac1_comments,
        f.date_process AS mac2_date_process,
        f.time_process AS mac2_time_process,
        f.bar_macsweep1 AS mac2_bar_macsweep1,
        f.cryobox1 AS mac2_cryobox1,
        concat("F",i.freezer,"-","S",i.shelf,"-","R",i.rack,"-","DRW",i.rack_level) AS macsweep1_location,
        f.bar_macsweep2 AS mac2_bar_macsweep2,
        f.cryobox2 AS mac2_cryobox2,
        concat("F",j.freezer,"-","S",j.shelf,"-","R",j.rack,"-","DRW",j.rack_level) AS macsweep2_location,
        f.comments AS mac2_comments
        FROM nhmrc_receipt a
        LEFT JOIN nhmrc_idexx1 b ON a.barcode_sample=b.barcode_sample
        LEFT JOIN nhmrc_idexx2 c ON b.barcode_colilert=c.barcode_colilert
        LEFT JOIN nhmrc_metagenomics d ON a.barcode_sample=d.barcode_sample
        LEFT JOIN nhmrc_mac1 e ON a.barcode_sample=e.barcode_sample
        LEFT JOIN nhmrc_mac2 f ON e.bar_macconkey=f.bar_macconkey
        LEFT JOIN ref_sampletype g ON a.id_type2b = g.id_sampletype
        LEFT JOIN ref_location_80 h ON d.id_location_80=h.id_location_80 AND h.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 i ON f.id_location_80_1=i.id_location_80 AND i.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 j ON f.id_location_80_2=j.id_location_80 AND j.lab = "'.$this->session->userdata('lab').'"
        WHERE a.id_type2b = "'.$rep.'"
        AND (a.date_arrival >= "'.$date1.'"
            AND a.date_arrival <= "'.$date2.'")
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_arrival DESC, a.time_arrival ASC
        ');        
        $response = $q->result();
        return $response;
    }        

    function get_food($date1, $date2, $rep)
    {
        $q = $this->db->query('
        SELECT
        a.barcode_sample, q.sampletype, 
        a.date_arrival AS reception_date_arrival, 
        a.time_arrival AS reception_time_arrival,  
        a.png_control AS reception_png_control, 
        a.barcode_tinytag AS reception_barcode_tinytag,
        a.comments AS reception_comments,
        b.date_conduct AS stomacher_date_conduct,
        b.barcode_food AS stomacher_barcode_food,
        b.elution_no AS stomacher_elution_number,
        b.elution AS stomacher_elution,
        b.food_weight AS stomacher_food_weight,
        b.food_comments AS stomacher_food_comments,
        c.barcode_colilert AS stom_idexx_in_barcode_colilert,
        c.barcode_falcon1 AS stom_idexx_in_barcode_falcon1,
        c.volume_falcon1 AS stom_idexx_in_volume_falcon1,
        c.barcode_falcon2 AS stom_idexx_in_barcode_falcon2,
        c.volume_falcon2 AS stom_idexx_in_volume_falcon2,
        c.dilution AS stom_idexx_in_dilution,
        c.time_incubation AS stom_idexx_in_time_incu_start,
        c.comments AS stom_idexx_in_comments,
        d.date_conduct AS idexx_out_date_conduct,
        d.timeout_incubation AS idexx_out_timeout_incubation,
        d.time_minutes AS idexx_out_time_minutes,
        d.ecoli_largewells AS idexx_out_ecoli_largewells,
        d.ecoli_smallwells AS idexx_out_ecoli_smallwells,
        d.ecoli_mpn AS idexx_out_ecoli_mpn,
        d.coliforms_largewells AS idexx_out_coliforms_largewells,
        d.coliforms_smallwells AS idexx_out_coliforms_smallwells,
        d.coliforms_mpn AS idexx_out_coliforms_mpn,
        d.comments AS idexx_out_comments,
        k.date_moisture AS mois_initial_date_moisture,
        k.barcode_foil AS mois_initial_barcode_foil_tray,
        k.foil_weight AS mois_initial_foil_tray_weight,
        k.time_filter_start AS mois_initial_time_filter_start,
        k.time_filter_finish AS mois_initial_time_filter_finish,
        k.wet_weight AS mois_initial_wet_weight,
        k.time_incubator AS mois_initial_time_incubator,
        k.comments AS mois_initial_comments,
        l.date_moisture AS mois24_date_moisture,
        l.dry_weight24 AS mois24_dry_weight24,
        l.comments AS mois24_comments,
        m.date_moisture AS mois48_date_moisture,
        m.dry_weight48 AS mois48_dry_weight48,
        m.difference AS mois48_difference,
        m.comments AS mois48_comments,
        n.date_moisture AS mois72_date_moisture,
        n.dry_weight72 AS mois72_dry_weight48,
        n.comments AS mois72_comments,
        e.date_conduct AS metagenomics_date_conduct,
        e.barcode_dna1 AS metagenomics_barcode_dna1,
        e.weight_sub1 AS metagenomics_weight_sub1,
        e.barcode_storage1 AS metagenomics_barcode_storage1,
        e.position_tube1 AS metagenomics_position_tube1,
        concat("F",t.freezer,"-","S",t.shelf,"-","R",t.rack,"-","DRW",t.rack_level) AS metagenomics_dna1_location,
        e.barcode_dna2 AS metagenomics_barcode_dna2,
        e.weight_sub2 AS metagenomics_weight_sub2,
        e.barcode_storage2 AS metagenomics_barcode_storage2,
        e.position_tube2 AS metagenomics_position_tube2,
        concat("F",w.freezer,"-","S",w.shelf,"-","R",w.rack,"-","DRW",w.rack_level) AS metagenomics_dna2_location,
        e.comments AS metagenomics_comments,
        o.bar_macconkey AS mac1_barcode_macconkey,
        o.date_process AS mac1_date_process,
        o.time_process AS mac1_time_process,
        o.volume AS mac1_volume,
        o.comments AS mac1_comments,
        p.date_process AS mac2_date_process,
        p.time_process AS mac2_time_process,
        p.bar_macsweep1 AS mac2_bar_macsweep1,
        p.cryobox1 AS mac2_cryobox1,
        concat("F",u.freezer,"-","S",u.shelf,"-","R",u.rack,"-","DRW",u.rack_level) AS macsweep1_location,
        p.bar_macsweep2 AS mac2_bar_macsweep2,
        p.cryobox2 AS mac2_cryobox2,
        concat("F",v.freezer,"-","S",v.shelf,"-","R",v.rack,"-","DRW",v.rack_level) AS macsweep2_location,
        p.comments AS mac2_comments
        FROM nhmrc_receipt a
        LEFT JOIN nhmrc_sample_prep b ON a.barcode_sample=b.barcode_sample
        LEFT JOIN nhmrc_subsd_idexx c ON b.barcode_food=c.barcode_food 
        LEFT JOIN nhmrc_idexx2 d ON c.barcode_colilert=d.barcode_colilert
        LEFT JOIN nhmrc_meta_food e ON a.barcode_sample=e.barcode_sample
        LEFT JOIN nhmrc_moisture1 k ON a.barcode_sample=k.barcode_sample
        LEFT JOIN nhmrc_moisture2 l ON k.barcode_foil=l.barcode_foil
        LEFT JOIN nhmrc_moisture3 m ON k.barcode_foil=m.barcode_foil
        LEFT JOIN nhmrc_moisture4 n ON k.barcode_foil=n.barcode_foil
        LEFT JOIN nhmrc_mac1 o ON c.barcode_falcon1=o.barcode_sample
        LEFT JOIN nhmrc_mac2 p ON o.bar_macconkey=p.bar_macconkey
        LEFT JOIN ref_sampletype q ON a.id_type2b = q.id_sampletype
        LEFT JOIN ref_location_80 t ON e.id_location_801=t.id_location_80 AND t.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 w ON e.id_location_802=w.id_location_80 AND w.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 u ON p.id_location_80_1=u.id_location_80 AND u.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 v ON p.id_location_80_2=v.id_location_80 AND v.lab = "'.$this->session->userdata('lab').'"
        WHERE a.id_type2b = "'.$rep.'"
        AND (a.date_arrival >= "'.$date1.'"
            AND a.date_arrival <= "'.$date2.'")
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_arrival DESC, a.time_arrival ASC
        ');        
        $response = $q->result();
        return $response;
    }            

    function get_handprint($date1, $date2, $rep)
    {
        $q = $this->db->query('
        SELECT 
        a.barcode_sample, g.sampletype, 
        a.date_arrival AS reception_date_arrival, 
        a.time_arrival AS reception_time_arrival,  
        a.png_control AS reception_png_control, 
        a.barcode_tinytag AS reception_barcode_tinytag,
        a.comments AS reception_comments,
        e.bar_macconkey AS mac1_barcode_macconkey,
        e.date_process AS mac1_date_process,
        e.time_process AS mac1_time_process,
        e.volume AS mac1_volume,
        e.comments AS mac1_comments,
        f.date_process AS mac2_date_process,
        f.time_process AS mac2_time_process,
        f.bar_macsweep1 AS mac2_bar_macsweep1,
        f.cryobox1 AS mac2_cryobox1,
        concat("F",i.freezer,"-","S",i.shelf,"-","R",i.rack,"-","DRW",i.rack_level) AS macsweep1_location,
        f.bar_macsweep2 AS mac2_bar_macsweep2,
        f.cryobox2 AS mac2_cryobox2,
        concat("F",j.freezer,"-","S",j.shelf,"-","R",j.rack,"-","DRW",j.rack_level) AS macsweep2_location,
        f.comments AS mac2_comments
        FROM nhmrc_receipt a
        LEFT JOIN nhmrc_mac1 e ON a.barcode_sample=e.barcode_sample
        LEFT JOIN nhmrc_mac2 f ON e.bar_macconkey=f.bar_macconkey
        LEFT JOIN ref_sampletype g ON a.id_type2b = g.id_sampletype
        LEFT JOIN ref_location_80 i ON f.id_location_80_1=i.id_location_80 AND i.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 j ON f.id_location_80_2=j.id_location_80 AND j.lab = "'.$this->session->userdata('lab').'"
        WHERE a.id_type2b = "'.$rep.'"
        AND (a.date_arrival >= "'.$date1.'"
            AND a.date_arrival <= "'.$date2.'")
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_arrival DESC, a.time_arrival ASC
        ');        
        $response = $q->result();
        return $response;
    }                
    function get_toys($date1, $date2, $rep)
    {
        $q = $this->db->query('
        SELECT 
        a.barcode_sample, q.sampletype, 
        a.date_arrival AS reception_date_arrival, 
        a.time_arrival AS reception_time_arrival,  
        a.png_control AS reception_png_control, 
        a.barcode_tinytag AS reception_barcode_tinytag,
        a.comments AS reception_comments,
        g.date_weighed AS bs_before_date_weighed_micro,
        g.barcode_bootsocks AS bs_before_barcode_bootsocks_micro,
        g.bootsock_weight_dry AS bs_before_bootsock_weight_dry_micro,
        g.comments AS bs_before_comment_micro,
        h.date_weighed AS bs_after_date_weighed_micro, 
        h.barcode_bootsocks AS bs_after_barcode_bootsocks_micro, 
        h.bootsock_weight_wet AS bs_after_bootsock_weight_wet_micro,
        h.comments AS bs_after_comment_micro,
        b.date_conduct AS stomacher_date_conduct,
        b.barcode_bootsock AS stomacher_barcode_bootsocks_Micro,
        b.elution_no AS stomacher_elution_number_Micro1,
        b.elution AS stomacher_elution_Micro1,
        b.barcode_falcon AS stomacher_barcode_falcon_Micro1,
        b.volume_stomacher AS stomacher_volume_Micro1,
        c.elution_no AS stomacher_elution_number_Micro2,
        c.elution AS stomacher_elution_Micro2,
        c.barcode_falcon AS stomacher_barcode_falcon_Micro2,
        c.volume_stomacher AS stomacher_volume_Micro2,
        f.barcode_colilert AS stom_idexx_in_barcode_colilert,
        f.barcode_falcon1 AS stom_idexx_in_barcode_falcon1,
        f.volume_falcon1 AS stom_idexx_in_volume_falcon1,
        f.barcode_falcon2 AS stom_idexx_in_barcode_falcon2,
        f.volume_falcon2 AS stom_idexx_in_volume_falcon2,
        f.dilution AS stom_idexx_in_dilution,
        f.time_incubation AS stom_idexx_in_time_incu_start,
        f.comments AS stom_idexx_in_comments,
        j.date_conduct AS idexx_out_date_conduct,
        j.timeout_incubation AS idexx_out_timeout_incubation,
        j.time_minutes AS idexx_out_time_minutes,
        j.ecoli_largewells AS idexx_out_ecoli_largewells,
        j.ecoli_smallwells AS idexx_out_ecoli_smallwells,
        j.ecoli_mpn AS idexx_out_ecoli_mpn,
        j.coliforms_largewells AS idexx_out_coliforms_largewells,
        j.coliforms_smallwells AS idexx_out_coliforms_smallwells,
        j.coliforms_mpn AS idexx_out_coliforms_mpn,
        j.comments AS idexx_out_comments,
        k.date_moisture AS mois_initial_date_moisture,
        k.barcode_foil AS mois_initial_barcode_foil_tray,
        k.foil_weight AS mois_initial_foil_tray_weight,
        k.time_filter_start AS mois_initial_time_filter_start,
        k.time_filter_finish AS mois_initial_time_filter_finish,
        k.wet_weight AS mois_initial_wet_weight,
        k.time_incubator AS mois_initial_time_incubator,
        k.comments AS mois_initial_comments,
        l.date_moisture AS mois24_date_moisture,
        l.dry_weight24 AS mois24_dry_weight24,
        l.comments AS mois24_comments,
        m.date_moisture AS mois48_date_moisture,
        m.dry_weight48 AS mois48_dry_weight48,
        m.difference AS mois48_difference,
        m.comments AS mois48_comments,
        n.date_moisture AS mois72_date_moisture,
        n.dry_weight72 AS mois72_dry_weight48,
        n.comments AS mois72_comments,
        i.date_conduct AS metagenomics_date_conduct,
        i.barcode_sample AS metagenomics_barcode_falcon1,
        i.barcode_falcon2 AS metagenomics_barcode_falcon2,
        i.volume_filtered AS metagenomics_volume_filtered,
        i.time_started AS metagenomics_time_started,
        i.time_finished AS metagenomics_time_finished,
        i.time_minutes AS metagenomics_time_minutes,
        i.barcode_dna_bag AS metagenomics_barcode_dna_bag,
        i.barcode_storage AS metagenomics_barcode_storage,
        concat("F",t.freezer,"-","S",t.shelf,"-","R",t.rack,"-","DRW",t.rack_level) AS metagenomics_location,
        i.comments AS metagenomics_comments,
        o.bar_macconkey AS mac1_barcode_macconkey,
        o.date_process AS mac1_date_process,
        o.time_process AS mac1_time_process,
        o.volume AS mac1_volume,
        o.comments AS mac1_comments,
        p.date_process AS mac2_date_process,
        p.time_process AS mac2_time_process,
        p.bar_macsweep1 AS mac2_bar_macsweep1,
        p.cryobox1 AS mac2_cryobox1,
        concat("F",u.freezer,"-","S",u.shelf,"-","R",u.rack,"-","DRW",u.rack_level) AS macsweep1_location,
        p.bar_macsweep2 AS mac2_bar_macsweep2,
        p.cryobox2 AS mac2_cryobox2,
        concat("F",v.freezer,"-","S",v.shelf,"-","R",v.rack,"-","DRW",v.rack_level) AS macsweep2_location,
        p.comments AS mac2_comments
        FROM nhmrc_receipt a
        LEFT JOIN nhmrc_bs_stomacher b ON a.barcode_sample=b.barcode_sample AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_bs_stomacher c ON a.barcode_sample=c.barcode_sample AND c.elution_no="Micro2"
        LEFT JOIN nhmrc_subbs_idexx f ON b.barcode_bootsock=f.barcode_sample 
        LEFT JOIN nhmrc_bootsocks_before g ON b.barcode_bootsock=g.barcode_bootsocks AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_bootsocks_after h ON b.barcode_bootsock=h.barcode_bootsocks AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_metagenomics i ON a.barcode_sample=i.barcode_sample
        LEFT JOIN nhmrc_idexx2 j ON f.barcode_colilert=j.barcode_colilert
        LEFT JOIN nhmrc_moisture1 k ON a.barcode_sample=k.barcode_sample
        LEFT JOIN nhmrc_moisture2 l ON k.barcode_foil=l.barcode_foil
        LEFT JOIN nhmrc_moisture3 m ON k.barcode_foil=m.barcode_foil
        LEFT JOIN nhmrc_moisture4 n ON k.barcode_foil=n.barcode_foil
        LEFT JOIN nhmrc_mac1 o ON a.barcode_sample=o.barcode_sample
        LEFT JOIN nhmrc_mac2 p ON o.bar_macconkey=p.bar_macconkey
        LEFT JOIN ref_sampletype q ON a.id_type2b = q.id_sampletype
        LEFT JOIN ref_location_80 t ON i.id_location_80=t.id_location_80 AND t.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 u ON p.id_location_80_1=u.id_location_80 AND u.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 v ON p.id_location_80_2=v.id_location_80 AND v.lab = "'.$this->session->userdata('lab').'"
        WHERE a.id_type2b = "'.$rep.'"
        AND (a.date_arrival >= "'.$date1.'"
            AND a.date_arrival <= "'.$date2.'")
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_arrival DESC, a.time_arrival ASC
        ');        
        $response = $q->result();
        return $response;
    }
    
    function get_swab($date1, $date2, $rep)
    {
        $q = $this->db->query('

        SELECT 
        a.barcode_sample, q.sampletype, 
        a.date_arrival AS reception_date_arrival, 
        a.time_arrival AS reception_time_arrival,  
        a.png_control AS reception_png_control, 
        a.barcode_tinytag AS reception_barcode_tinytag,
        a.comments AS reception_comments,
        b.date_conduct AS stomacher_date_conduct,
        b.barcode_bootsock AS stomacher_barcode_bootsocks_Micro,
        b.elution_no AS stomacher_elution_number_Micro1,
        b.elution AS stomacher_elution_Micro1,
        b.barcode_falcon AS stomacher_barcode_falcon_Micro1,
        b.volume_stomacher AS stomacher_volume_Micro1,
        c.elution_no AS stomacher_elution_number_Micro2,
        c.elution AS stomacher_elution_Micro2,
        c.barcode_falcon AS stomacher_barcode_falcon_Micro2,
        c.volume_stomacher AS stomacher_volume_Micro2,
        f.barcode_colilert AS stom_idexx_in_barcode_colilert,
        f.barcode_falcon1 AS stom_idexx_in_barcode_falcon1,
        f.volume_falcon1 AS stom_idexx_in_volume_falcon1,
        f.barcode_falcon2 AS stom_idexx_in_barcode_falcon2,
        f.volume_falcon2 AS stom_idexx_in_volume_falcon2,
        f.dilution AS stom_idexx_in_dilution,
        f.time_incubation AS stom_idexx_in_time_incu_start,
        f.comments AS stom_idexx_in_comments,
        j.date_conduct AS idexx_out_date_conduct,
        j.timeout_incubation AS idexx_out_timeout_incubation,
        j.time_minutes AS idexx_out_time_minutes,
        j.ecoli_largewells AS idexx_out_ecoli_largewells,
        j.ecoli_smallwells AS idexx_out_ecoli_smallwells,
        j.ecoli_mpn AS idexx_out_ecoli_mpn,
        j.coliforms_largewells AS idexx_out_coliforms_largewells,
        j.coliforms_smallwells AS idexx_out_coliforms_smallwells,
        j.coliforms_mpn AS idexx_out_coliforms_mpn,
        j.comments AS idexx_out_comments,
        i.date_conduct AS metagenomics_date_conduct,
        i.barcode_sample AS metagenomics_barcode_falcon1,
        i.barcode_falcon2 AS metagenomics_barcode_falcon2,
        i.volume_filtered AS metagenomics_volume_filtered,
        i.time_started AS metagenomics_time_started,
        i.time_finished AS metagenomics_time_finished,
        i.time_minutes AS metagenomics_time_minutes,
        i.barcode_dna_bag AS metagenomics_barcode_dna_bag,
        i.barcode_storage AS metagenomics_barcode_storage,
        concat("F",t.freezer,"-","S",t.shelf,"-","R",t.rack,"-","DRW",t.rack_level) AS metagenomics_location,
        i.comments AS metagenomics_comments,
        o.bar_macconkey AS mac1_barcode_macconkey,
        o.date_process AS mac1_date_process,
        o.time_process AS mac1_time_process,
        o.volume AS mac1_volume,
        o.comments AS mac1_comments,
        p.date_process AS mac2_date_process,
        p.time_process AS mac2_time_process,
        p.bar_macsweep1 AS mac2_bar_macsweep1,
        p.cryobox1 AS mac2_cryobox1,
        concat("F",u.freezer,"-","S",u.shelf,"-","R",u.rack,"-","DRW",u.rack_level) AS macsweep1_location,
        p.bar_macsweep2 AS mac2_bar_macsweep2,
        p.cryobox2 AS mac2_cryobox2,
        concat("F",v.freezer,"-","S",v.shelf,"-","R",v.rack,"-","DRW",v.rack_level) AS macsweep2_location,
        p.comments AS mac2_comments

        FROM nhmrc_receipt a
        LEFT JOIN nhmrc_bs_stomacher b ON a.barcode_sample=b.barcode_sample AND b.elution_no="Micro1"
        LEFT JOIN nhmrc_bs_stomacher c ON a.barcode_sample=c.barcode_sample AND c.elution_no="Micro2"
        LEFT JOIN nhmrc_subbs_idexx f ON b.barcode_bootsock=f.barcode_sample 
        LEFT JOIN nhmrc_metagenomics i ON a.barcode_sample=i.barcode_sample
        LEFT JOIN nhmrc_idexx2 j ON f.barcode_colilert=j.barcode_colilert
        LEFT JOIN nhmrc_mac1 o ON a.barcode_sample=o.barcode_sample
        LEFT JOIN nhmrc_mac2 p ON o.bar_macconkey=p.bar_macconkey
        LEFT JOIN ref_sampletype q ON a.id_type2b = q.id_sampletype
        LEFT JOIN ref_location_80 t ON i.id_location_80=t.id_location_80 AND t.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 u ON p.id_location_80_1=u.id_location_80 AND u.lab = "'.$this->session->userdata('lab').'"
        LEFT JOIN ref_location_80 v ON p.id_location_80_2=v.id_location_80 AND v.lab = "'.$this->session->userdata('lab').'"
        WHERE a.id_type2b = "'.$rep.'"
        AND (a.date_arrival >= "'.$date1.'"
            AND a.date_arrival <= "'.$date2.'")
        AND a.lab = "'.$this->session->userdata('lab').'" 
        AND a.flag = 0 
        ORDER BY a.date_arrival DESC, a.time_arrival ASC
        ');        
        $response = $q->result();
        return $response;
    }        
}

/* End of file Tbl_customer_model.php */
/* Location: ./application/models/Tbl_customer_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:29:29 */
/* http://harviacode.com */