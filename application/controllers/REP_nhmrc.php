<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// require_once '../../extlib/PHPExcel/PHPExcel.php';

class REP_nhmrc extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('REP_nhmrc_model');
        // $this->load->library('form_validation');        
	    $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template','REP_nhmrc/index');
    } 

    // public function index2()
    // {
    //     $this->template->load('template','REP_nhmrc/index2');
    // } 

    public function cleanEnter($text) {
        return str_replace(["\r", "\n"], ' ', trim($text));
    }
    
    public function json() {
        $rep=$this->input->get('rep');
        $date1=$this->input->get('date1');
        $date2=$this->input->get('date2');
        // var_dump($date2);
        header('Content-Type: application/json');
        echo $this->REP_nhmrc_model->json($date1,$date2,$rep);
    }


    public function excel()
    {
        $rep=$this->input->get('rep');
        $date1=$this->input->get('date1');
        $date2=$this->input->get('date2');

        $spreadsheet = new Spreadsheet();    
        $sheet = $spreadsheet->getActiveSheet();

        if ($rep == 18 || $rep == 19 || $rep == 20) {
            $sheet->setCellValue('A1',"barcode_sample");
            $sheet->setCellValue('B1',"sampletype");
            $sheet->setCellValue('C1',"reception_date_arrival");
            $sheet->setCellValue('D1',"reception_time_arrival");
            $sheet->setCellValue('E1',"reception_png_control");
            $sheet->setCellValue('F1',"reception_barcode_tinytag");
            $sheet->setCellValue('G1',"reception_comments");
            $sheet->setCellValue('H1',"bs_before_date_weighed_micro");
            $sheet->setCellValue('I1',"bs_before_barcode_bootsocks_micro");
            $sheet->setCellValue('J1',"bs_before_bootsock_weight_dry_micro");
            $sheet->setCellValue('K1',"bs_before_comment_micro");
            $sheet->setCellValue('L1',"bs_before_date_weighed_moisture");
            $sheet->setCellValue('M1',"bs_before_barcode_bootsocks_moisture");
            $sheet->setCellValue('N1',"bs_before_bootsock_weight_dry_moisture");
            $sheet->setCellValue('O1',"bs_before_comment_moisture");
            $sheet->setCellValue('P1',"bs_after_date_weighed_micro");
            $sheet->setCellValue('Q1',"bs_after_barcode_bootsocks_micro");
            $sheet->setCellValue('R1',"bs_after_bootsock_weight_wet_micro");
            $sheet->setCellValue('S1',"bs_after_comment_micro");
            $sheet->setCellValue('T1',"bs_after_date_weighed_moisture");
            $sheet->setCellValue('U1',"bs_after_barcode_bootsocks_moisture");
            $sheet->setCellValue('V1',"bs_after_bootsock_weight_wet_moisture");
            $sheet->setCellValue('W1',"bs_after_comment_moisture");
            $sheet->setCellValue('X1',"stomacher_date_conduct");
            $sheet->setCellValue('Y1',"stomacher_barcode_bootsocks_Micro");
            $sheet->setCellValue('Z1',"stomacher_elution_number_Micro1");
            $sheet->setCellValue('AA1',"stomacher_elution_Micro1");
            $sheet->setCellValue('AB1',"stomacher_barcode_falcon_Micro1");
            $sheet->setCellValue('AC1',"stomacher_volume_Micro1");
            $sheet->setCellValue('AD1',"stomacher_elution_number_Micro2");
            $sheet->setCellValue('AE1',"stomacher_elution_Micro2");
            $sheet->setCellValue('AF1',"stomacher_barcode_falcon_Micro2");
            $sheet->setCellValue('AG1',"stomacher_volume_Micro2");
            $sheet->setCellValue('AH1',"stomacher_barcode_bootsocks_Moisture");
            $sheet->setCellValue('AI1',"stomacher_elution_number_Moisture1");
            $sheet->setCellValue('AJ1',"stomacher_elution_Moisture1");
            $sheet->setCellValue('AK1',"stomacher_barcode_falcon_Moisture1");
            $sheet->setCellValue('AL1',"stomacher_volume_Moisture1");
            $sheet->setCellValue('AM1',"stomacher_elution_number_Moisture2");
            $sheet->setCellValue('AN1',"stomacher_elution_Moisture2");
            $sheet->setCellValue('AO1',"stomacher_barcode_falcon_Moisture2");
            $sheet->setCellValue('AP1',"stomacher_volume_Moisture2");
            $sheet->setCellValue('AQ1',"stom_idexx_in_barcode_colilert");
            $sheet->setCellValue('AR1',"stom_idexx_in_barcode_falcon1");
            $sheet->setCellValue('AS1',"stom_idexx_in_volume_falcon1");
            $sheet->setCellValue('AT1',"stom_idexx_in_barcode_falcon2");
            $sheet->setCellValue('AU1',"stom_idexx_in_volume_falcon2");
            $sheet->setCellValue('AV1',"stom_idexx_in_dilution");
            $sheet->setCellValue('AW1',"stom_idexx_in_time_incu_start");
            $sheet->setCellValue('AX1',"stom_idexx_in_comments");
            $sheet->setCellValue('AY1',"idexx_out_date_conduct");
            $sheet->setCellValue('AZ1',"idexx_out_timeout_incubation");
            $sheet->setCellValue('BA1',"idexx_out_time_minutes");
            $sheet->setCellValue('BB1',"idexx_out_ecoli_largewells");
            $sheet->setCellValue('BC1',"idexx_out_ecoli_smallwells");
            $sheet->setCellValue('BD1',"idexx_out_ecoli_mpn");
            $sheet->setCellValue('BE1',"idexx_out_coliforms_largewells");
            $sheet->setCellValue('BF1',"idexx_out_coliforms_smallwells");
            $sheet->setCellValue('BG1',"idexx_out_coliforms_mpn");
            $sheet->setCellValue('BH1',"idexx_out_comments");
            $sheet->setCellValue('BI1',"mois_initial_date_moisture");
            $sheet->setCellValue('BJ1',"mois_initial_barcode_foil_tray");
            $sheet->setCellValue('BK1',"mois_initial_foil_tray_weight");
            $sheet->setCellValue('BL1',"mois_initial_time_filter_start");
            $sheet->setCellValue('BM1',"mois_initial_time_filter_finish");
            $sheet->setCellValue('BN1',"mois_initial_wet_weight");
            $sheet->setCellValue('BO1',"mois_initial_time_incubator");
            $sheet->setCellValue('BP1',"mois_initial_comments");
            $sheet->setCellValue('BQ1',"mois24_date_moisture");
            $sheet->setCellValue('BR1',"mois24_dry_weight24");
            $sheet->setCellValue('BS1',"mois24_comments");
            $sheet->setCellValue('BT1',"mois48_date_moisture");
            $sheet->setCellValue('BU1',"mois48_dry_weight48");
            $sheet->setCellValue('BV1',"mois48_difference");
            $sheet->setCellValue('BW1',"mois48_comments");
            $sheet->setCellValue('BX1',"mois72_date_moisture");
            $sheet->setCellValue('BY1',"mois72_dry_weight48");
            $sheet->setCellValue('BZ1',"mois72_comments");
            $sheet->setCellValue('CA1',"metagenomics_date_conduct");
            $sheet->setCellValue('CB1',"metagenomics_barcode_falcon1");
            $sheet->setCellValue('CC1',"metagenomics_barcode_falcon2");
            $sheet->setCellValue('CD1',"metagenomics_volume_filtered");
            $sheet->setCellValue('CE1',"metagenomics_time_started");
            $sheet->setCellValue('CF1',"metagenomics_time_finished");
            $sheet->setCellValue('CG1',"metagenomics_time_minutes");
            $sheet->setCellValue('CH1',"metagenomics_barcode_dna_bag");
            $sheet->setCellValue('CI1',"metagenomics_barcode_storage");
            $sheet->setCellValue('CJ1',"metagenomics_location");
            $sheet->setCellValue('CK1',"metagenomics_comments");
            $sheet->setCellValue('CL1',"mac1_barcode_macconkey");
            $sheet->setCellValue('CM1',"mac1_date_process");
            $sheet->setCellValue('CN1',"mac1_time_process");
            $sheet->setCellValue('CO1',"mac1_volume");
            $sheet->setCellValue('CP1',"mac1_comments");
            $sheet->setCellValue('CQ1',"mac2_date_process");
            $sheet->setCellValue('CR1',"mac2_time_process");
            $sheet->setCellValue('CS1',"mac2_bar_macsweep1");
            $sheet->setCellValue('CT1',"mac2_cryobox1");
            $sheet->setCellValue('CU1',"macsweep1_location");
            $sheet->setCellValue('CV1',"mac2_bar_macsweep2");
            $sheet->setCellValue('CW1',"mac2_cryobox2");
            $sheet->setCellValue('CX1',"macsweep2_location");
            $sheet->setCellValue('CY1',"mac2_comments");
            

            $rdeliver = $this->REP_nhmrc_model->get_porchbootsock($date1, $date2, $rep);
        
            $numrow = 2; 
            foreach($rdeliver as $data){ 
                $sheet->setCellValue('A'.$numrow, $this->cleanEnter($data->barcode_sample));
                $sheet->setCellValue('B'.$numrow, $this->cleanEnter($data->sampletype));
                $sheet->setCellValue('C'.$numrow, $this->cleanEnter($data->reception_date_arrival));
                $sheet->setCellValue('D'.$numrow, $this->cleanEnter($data->reception_time_arrival));
                $sheet->setCellValue('E'.$numrow, $this->cleanEnter($data->reception_png_control));
                $sheet->setCellValue('F'.$numrow, $this->cleanEnter($data->reception_barcode_tinytag));
                $sheet->setCellValue('G'.$numrow, $this->cleanEnter($data->reception_comments));
                $sheet->setCellValue('H'.$numrow, $this->cleanEnter($data->bs_before_date_weighed_micro));
                $sheet->setCellValue('I'.$numrow, $this->cleanEnter($data->bs_before_barcode_bootsocks_micro));
                $sheet->setCellValue('J'.$numrow, $this->cleanEnter($data->bs_before_bootsock_weight_dry_micro));
                $sheet->setCellValue('K'.$numrow, $this->cleanEnter($data->bs_before_comment_micro));
                $sheet->setCellValue('L'.$numrow, $this->cleanEnter($data->bs_before_date_weighed_moisture));
                $sheet->setCellValue('M'.$numrow, $this->cleanEnter($data->bs_before_barcode_bootsocks_moisture));
                $sheet->setCellValue('N'.$numrow, $this->cleanEnter($data->bs_before_bootsock_weight_dry_moisture));
                $sheet->setCellValue('O'.$numrow, $this->cleanEnter($data->bs_before_comment_moisture));
                $sheet->setCellValue('P'.$numrow, $this->cleanEnter($data->bs_after_date_weighed_micro));
                $sheet->setCellValue('Q'.$numrow, $this->cleanEnter($data->bs_after_barcode_bootsocks_micro));
                $sheet->setCellValue('R'.$numrow, $this->cleanEnter($data->bs_after_bootsock_weight_wet_micro));
                $sheet->setCellValue('S'.$numrow, $this->cleanEnter($data->bs_after_comment_micro));
                $sheet->setCellValue('T'.$numrow, $this->cleanEnter($data->bs_after_date_weighed_moisture));
                $sheet->setCellValue('U'.$numrow, $this->cleanEnter($data->bs_after_barcode_bootsocks_moisture));
                $sheet->setCellValue('V'.$numrow, $this->cleanEnter($data->bs_after_bootsock_weight_wet_moisture));
                $sheet->setCellValue('W'.$numrow, $this->cleanEnter($data->bs_after_comment_moisture));
                $sheet->setCellValue('X'.$numrow, $this->cleanEnter($data->stomacher_date_conduct));
                $sheet->setCellValue('Y'.$numrow, $this->cleanEnter($data->stomacher_barcode_bootsocks_Micro));
                $sheet->setCellValue('Z'.$numrow, $this->cleanEnter($data->stomacher_elution_number_Micro1));
                $sheet->setCellValue('AA'.$numrow, $this->cleanEnter($data->stomacher_elution_Micro1));
                $sheet->setCellValue('AB'.$numrow, $this->cleanEnter($data->stomacher_barcode_falcon_Micro1));
                $sheet->setCellValue('AC'.$numrow, $this->cleanEnter($data->stomacher_volume_Micro1));
                $sheet->setCellValue('AD'.$numrow, $this->cleanEnter($data->stomacher_elution_number_Micro2));
                $sheet->setCellValue('AE'.$numrow, $this->cleanEnter($data->stomacher_elution_Micro2));
                $sheet->setCellValue('AF'.$numrow, $this->cleanEnter($data->stomacher_barcode_falcon_Micro2));
                $sheet->setCellValue('AG'.$numrow, $this->cleanEnter($data->stomacher_volume_Micro2));
                $sheet->setCellValue('AH'.$numrow, $this->cleanEnter($data->stomacher_barcode_bootsocks_Moisture));
                $sheet->setCellValue('AI'.$numrow, $this->cleanEnter($data->stomacher_elution_number_Moisture1));
                $sheet->setCellValue('AJ'.$numrow, $this->cleanEnter($data->stomacher_elution_Moisture1));
                $sheet->setCellValue('AK'.$numrow, $this->cleanEnter($data->stomacher_barcode_falcon_Moisture1));
                $sheet->setCellValue('AL'.$numrow, $this->cleanEnter($data->stomacher_volume_Moisture1));
                $sheet->setCellValue('AM'.$numrow, $this->cleanEnter($data->stomacher_elution_number_Moisture2));
                $sheet->setCellValue('AN'.$numrow, $this->cleanEnter($data->stomacher_elution_Moisture2));
                $sheet->setCellValue('AO'.$numrow, $this->cleanEnter($data->stomacher_barcode_falcon_Moisture2));
                $sheet->setCellValue('AP'.$numrow, $this->cleanEnter($data->stomacher_volume_Moisture2));
                $sheet->setCellValue('AQ'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_colilert));
                $sheet->setCellValue('AR'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_falcon1));
                $sheet->setCellValue('AS'.$numrow, $this->cleanEnter($data->stom_idexx_in_volume_falcon1));
                $sheet->setCellValue('AT'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_falcon2));
                $sheet->setCellValue('AU'.$numrow, $this->cleanEnter($data->stom_idexx_in_volume_falcon2));
                $sheet->setCellValue('AV'.$numrow, $this->cleanEnter($data->stom_idexx_in_dilution));
                $sheet->setCellValue('AW'.$numrow, $this->cleanEnter($data->stom_idexx_in_time_incu_start));
                $sheet->setCellValue('AX'.$numrow, $this->cleanEnter($data->stom_idexx_in_comments));
                $sheet->setCellValue('AY'.$numrow, $this->cleanEnter($data->idexx_out_date_conduct));
                $sheet->setCellValue('AZ'.$numrow, $this->cleanEnter($data->idexx_out_timeout_incubation));
                $sheet->setCellValue('BA'.$numrow, $this->cleanEnter($data->idexx_out_time_minutes));
                $sheet->setCellValue('BB'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_largewells));
                $sheet->setCellValue('BC'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_smallwells));
                $sheet->setCellValue('BD'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_mpn));
                $sheet->setCellValue('BE'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_largewells));
                $sheet->setCellValue('BF'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_smallwells));
                $sheet->setCellValue('BG'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_mpn));
                $sheet->setCellValue('BH'.$numrow, $this->cleanEnter($data->idexx_out_comments));
                $sheet->setCellValue('BI'.$numrow, $this->cleanEnter($data->mois_initial_date_moisture));
                $sheet->setCellValue('BJ'.$numrow, $this->cleanEnter($data->mois_initial_barcode_foil_tray));
                $sheet->setCellValue('BK'.$numrow, $this->cleanEnter($data->mois_initial_foil_tray_weight));
                $sheet->setCellValue('BL'.$numrow, $this->cleanEnter($data->mois_initial_time_filter_start));
                $sheet->setCellValue('BM'.$numrow, $this->cleanEnter($data->mois_initial_time_filter_finish));
                $sheet->setCellValue('BN'.$numrow, $this->cleanEnter($data->mois_initial_wet_weight));
                $sheet->setCellValue('BO'.$numrow, $this->cleanEnter($data->mois_initial_time_incubator));
                $sheet->setCellValue('BP'.$numrow, $this->cleanEnter($data->mois_initial_comments));
                $sheet->setCellValue('BQ'.$numrow, $this->cleanEnter($data->mois24_date_moisture));
                $sheet->setCellValue('BR'.$numrow, $this->cleanEnter($data->mois24_dry_weight24));
                $sheet->setCellValue('BS'.$numrow, $this->cleanEnter($data->mois24_comments));
                $sheet->setCellValue('BT'.$numrow, $this->cleanEnter($data->mois48_date_moisture));
                $sheet->setCellValue('BU'.$numrow, $this->cleanEnter($data->mois48_dry_weight48));
                $sheet->setCellValue('BV'.$numrow, $this->cleanEnter($data->mois48_difference));
                $sheet->setCellValue('BW'.$numrow, $this->cleanEnter($data->mois48_comments));
                $sheet->setCellValue('BX'.$numrow, $this->cleanEnter($data->mois72_date_moisture));
                $sheet->setCellValue('BY'.$numrow, $this->cleanEnter($data->mois72_dry_weight48));
                $sheet->setCellValue('BZ'.$numrow, $this->cleanEnter($data->mois72_comments));
                $sheet->setCellValue('CA'.$numrow, $this->cleanEnter($data->metagenomics_date_conduct));
                $sheet->setCellValue('CB'.$numrow, $this->cleanEnter($data->metagenomics_barcode_falcon1));
                $sheet->setCellValue('CC'.$numrow, $this->cleanEnter($data->metagenomics_barcode_falcon2));
                $sheet->setCellValue('CD'.$numrow, $this->cleanEnter($data->metagenomics_volume_filtered));
                $sheet->setCellValue('CE'.$numrow, $this->cleanEnter($data->metagenomics_time_started));
                $sheet->setCellValue('CF'.$numrow, $this->cleanEnter($data->metagenomics_time_finished));
                $sheet->setCellValue('CG'.$numrow, $this->cleanEnter($data->metagenomics_time_minutes));
                $sheet->setCellValue('CH'.$numrow, $this->cleanEnter($data->metagenomics_barcode_dna_bag));
                $sheet->setCellValue('CI'.$numrow, $this->cleanEnter($data->metagenomics_barcode_storage));
                $sheet->setCellValue('CJ'.$numrow, $this->cleanEnter($data->metagenomics_location));
                $sheet->setCellValue('CK'.$numrow, $this->cleanEnter($data->metagenomics_comments));
                $sheet->setCellValue('CL'.$numrow, $this->cleanEnter($data->mac1_barcode_macconkey));
                $sheet->setCellValue('CM'.$numrow, $this->cleanEnter($data->mac1_date_process));
                $sheet->setCellValue('CN'.$numrow, $this->cleanEnter($data->mac1_time_process));
                $sheet->setCellValue('CO'.$numrow, $this->cleanEnter($data->mac1_volume));
                $sheet->setCellValue('CP'.$numrow, $this->cleanEnter($data->mac1_comments));
                $sheet->setCellValue('CQ'.$numrow, $this->cleanEnter($data->mac2_date_process));
                $sheet->setCellValue('CR'.$numrow, $this->cleanEnter($data->mac2_time_process));
                $sheet->setCellValue('CS'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep1));
                $sheet->setCellValue('CT'.$numrow, $this->cleanEnter($data->mac2_cryobox1));
                $sheet->setCellValue('CU'.$numrow, $this->cleanEnter($data->macsweep1_location));
                $sheet->setCellValue('CV'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep2));
                $sheet->setCellValue('CW'.$numrow, $this->cleanEnter($data->mac2_cryobox2));
                $sheet->setCellValue('CX'.$numrow, $this->cleanEnter($data->macsweep2_location));
                $sheet->setCellValue('CY'.$numrow, $this->cleanEnter($data->mac2_comments));
                
                //   $no++; // Tambah 1 setiap kali looping
              $numrow++; // Tambah 1 setiap kali looping
            }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $datenow=date("Ymd");
        if ($rep == 18) {
            $boottype = 'Porch_Bootsocks_';
        }
        else if ($rep == 19) {
            $boottype = 'Indoor_Bootsocks_';
        }
        else if ($rep == 20) {
            $boottype = 'Outdoor_Bootsocks_';
        }
        $fileName = 'NHMRC_'.$boottype.'_report_'.$datenow.'.csv';        
        }
        else if ($rep == 21) {
            $sheet->setCellValue('A1',"barcode_sample");
            $sheet->setCellValue('B1',"sampletype");
            $sheet->setCellValue('C1',"reception_date_arrival");
            $sheet->setCellValue('D1',"reception_time_arrival");
            $sheet->setCellValue('E1',"reception_png_control");
            $sheet->setCellValue('F1',"reception_barcode_tinytag");
            $sheet->setCellValue('G1',"reception_comments");
            $sheet->setCellValue('H1',"bs_before_date_weighed_micro");
            $sheet->setCellValue('I1',"bs_before_barcode_bootsocks_micro");
            $sheet->setCellValue('J1',"bs_before_bootsock_weight_dry_micro");
            $sheet->setCellValue('K1',"bs_before_comment_micro");
            $sheet->setCellValue('L1',"bs_after_date_weighed_micro");
            $sheet->setCellValue('M1',"bs_after_barcode_bootsocks_micro");
            $sheet->setCellValue('N1',"bs_after_bootsock_weight_wet_micro");
            $sheet->setCellValue('O1',"bs_after_comment_micro");
            $sheet->setCellValue('P1',"stomacher_date_conduct");
            $sheet->setCellValue('Q1',"stomacher_barcode_bootsocks_Micro");
            $sheet->setCellValue('R1',"stomacher_elution_number_Micro1");
            $sheet->setCellValue('S1',"stomacher_elution_Micro1");
            $sheet->setCellValue('T1',"stomacher_barcode_falcon_Micro1");
            $sheet->setCellValue('U1',"stomacher_volume_Micro1");
            $sheet->setCellValue('V1',"stomacher_elution_number_Micro2");
            $sheet->setCellValue('W1',"stomacher_elution_Micro2");
            $sheet->setCellValue('X1',"stomacher_barcode_falcon_Micro2");
            $sheet->setCellValue('Y1',"stomacher_volume_Micro2");
            $sheet->setCellValue('Z1',"stom_idexx_in_barcode_colilert");
            $sheet->setCellValue('AA1',"stom_idexx_in_barcode_falcon1");
            $sheet->setCellValue('AB1',"stom_idexx_in_volume_falcon1");
            $sheet->setCellValue('AC1',"stom_idexx_in_barcode_falcon2");
            $sheet->setCellValue('AD1',"stom_idexx_in_volume_falcon2");
            $sheet->setCellValue('AE1',"stom_idexx_in_dilution");
            $sheet->setCellValue('AF1',"stom_idexx_in_time_incu_start");
            $sheet->setCellValue('AG1',"stom_idexx_in_comments");
            $sheet->setCellValue('AH1',"idexx_out_date_conduct");
            $sheet->setCellValue('AI1',"idexx_out_timeout_incubation");
            $sheet->setCellValue('AJ1',"idexx_out_time_minutes");
            $sheet->setCellValue('AK1',"idexx_out_ecoli_largewells");
            $sheet->setCellValue('AL1',"idexx_out_ecoli_smallwells");
            $sheet->setCellValue('AM1',"idexx_out_ecoli_mpn");
            $sheet->setCellValue('AN1',"idexx_out_coliforms_largewells");
            $sheet->setCellValue('AO1',"idexx_out_coliforms_smallwells");
            $sheet->setCellValue('AP1',"idexx_out_coliforms_mpn");
            $sheet->setCellValue('AQ1',"idexx_out_comments");
            $sheet->setCellValue('AR1',"metagenomics_date_conduct");
            $sheet->setCellValue('AS1',"metagenomics_barcode_falcon1");
            $sheet->setCellValue('AT1',"metagenomics_barcode_falcon2");
            $sheet->setCellValue('AU1',"metagenomics_volume_filtered");
            $sheet->setCellValue('AV1',"metagenomics_time_started");
            $sheet->setCellValue('AW1',"metagenomics_time_finished");
            $sheet->setCellValue('AX1',"metagenomics_time_minutes");
            $sheet->setCellValue('AY1',"metagenomics_barcode_dna_bag");
            $sheet->setCellValue('AZ1',"metagenomics_barcode_storage");
            $sheet->setCellValue('BA1',"metagenomics_location");
            $sheet->setCellValue('BB1',"metagenomics_comments");
            $sheet->setCellValue('BC1',"mac1_barcode_macconkey");
            $sheet->setCellValue('BD1',"mac1_date_process");
            $sheet->setCellValue('BE1',"mac1_time_process");
            $sheet->setCellValue('BF1',"mac1_volume");
            $sheet->setCellValue('BG1',"mac1_comments");
            $sheet->setCellValue('BH1',"mac2_date_process");
            $sheet->setCellValue('BI1',"mac2_time_process");
            $sheet->setCellValue('BJ1',"mac2_bar_macsweep1");
            $sheet->setCellValue('BK1',"mac2_cryobox1");
            $sheet->setCellValue('BL1',"macsweep1_location");
            $sheet->setCellValue('BM1',"mac2_bar_macsweep2");
            $sheet->setCellValue('BN1',"mac2_cryobox2");
            $sheet->setCellValue('BO1',"macsweep2_location");
            $sheet->setCellValue('BP1',"mac2_comments");            

            $rdeliver = $this->REP_nhmrc_model->get_handboot($date1, $date2, $rep);
        
            $numrow = 2; 
            foreach($rdeliver as $data){ 
                $sheet->setCellValue('A'.$numrow, $this->cleanEnter($data->barcode_sample));
                $sheet->setCellValue('B'.$numrow, $this->cleanEnter($data->sampletype));
                $sheet->setCellValue('C'.$numrow, $this->cleanEnter($data->reception_date_arrival));
                $sheet->setCellValue('D'.$numrow, $this->cleanEnter($data->reception_time_arrival));
                $sheet->setCellValue('E'.$numrow, $this->cleanEnter($data->reception_png_control));
                $sheet->setCellValue('F'.$numrow, $this->cleanEnter($data->reception_barcode_tinytag));
                $sheet->setCellValue('G'.$numrow, $this->cleanEnter($data->reception_comments));
                $sheet->setCellValue('H'.$numrow, $this->cleanEnter($data->bs_before_date_weighed_micro));
                $sheet->setCellValue('I'.$numrow, $this->cleanEnter($data->bs_before_barcode_bootsocks_micro));
                $sheet->setCellValue('J'.$numrow, $this->cleanEnter($data->bs_before_bootsock_weight_dry_micro));
                $sheet->setCellValue('K'.$numrow, $this->cleanEnter($data->bs_before_comment_micro));
                $sheet->setCellValue('L'.$numrow, $this->cleanEnter($data->bs_after_date_weighed_micro));
                $sheet->setCellValue('M'.$numrow, $this->cleanEnter($data->bs_after_barcode_bootsocks_micro));
                $sheet->setCellValue('N'.$numrow, $this->cleanEnter($data->bs_after_bootsock_weight_wet_micro));
                $sheet->setCellValue('O'.$numrow, $this->cleanEnter($data->bs_after_comment_micro));
                $sheet->setCellValue('P'.$numrow, $this->cleanEnter($data->stomacher_date_conduct));
                $sheet->setCellValue('Q'.$numrow, $this->cleanEnter($data->stomacher_barcode_bootsocks_Micro));
                $sheet->setCellValue('R'.$numrow, $this->cleanEnter($data->stomacher_elution_number_Micro1));
                $sheet->setCellValue('S'.$numrow, $this->cleanEnter($data->stomacher_elution_Micro1));
                $sheet->setCellValue('T'.$numrow, $this->cleanEnter($data->stomacher_barcode_falcon_Micro1));
                $sheet->setCellValue('U'.$numrow, $this->cleanEnter($data->stomacher_volume_Micro1));
                $sheet->setCellValue('V'.$numrow, $this->cleanEnter($data->stomacher_elution_number_Micro2));
                $sheet->setCellValue('W'.$numrow, $this->cleanEnter($data->stomacher_elution_Micro2));
                $sheet->setCellValue('X'.$numrow, $this->cleanEnter($data->stomacher_barcode_falcon_Micro2));
                $sheet->setCellValue('Y'.$numrow, $this->cleanEnter($data->stomacher_volume_Micro2));
                $sheet->setCellValue('Z'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_colilert));
                $sheet->setCellValue('AA'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_falcon1));
                $sheet->setCellValue('AB'.$numrow, $this->cleanEnter($data->stom_idexx_in_volume_falcon1));
                $sheet->setCellValue('AC'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_falcon2));
                $sheet->setCellValue('AD'.$numrow, $this->cleanEnter($data->stom_idexx_in_volume_falcon2));
                $sheet->setCellValue('AE'.$numrow, $this->cleanEnter($data->stom_idexx_in_dilution));
                $sheet->setCellValue('AF'.$numrow, $this->cleanEnter($data->stom_idexx_in_time_incu_start));
                $sheet->setCellValue('AG'.$numrow, $this->cleanEnter($data->stom_idexx_in_comments));
                $sheet->setCellValue('AH'.$numrow, $this->cleanEnter($data->idexx_out_date_conduct));
                $sheet->setCellValue('AI'.$numrow, $this->cleanEnter($data->idexx_out_timeout_incubation));
                $sheet->setCellValue('AJ'.$numrow, $this->cleanEnter($data->idexx_out_time_minutes));
                $sheet->setCellValue('AK'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_largewells));
                $sheet->setCellValue('AL'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_smallwells));
                $sheet->setCellValue('AM'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_mpn));
                $sheet->setCellValue('AN'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_largewells));
                $sheet->setCellValue('AO'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_smallwells));
                $sheet->setCellValue('AP'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_mpn));
                $sheet->setCellValue('AQ'.$numrow, $this->cleanEnter($data->idexx_out_comments));
                $sheet->setCellValue('AR'.$numrow, $this->cleanEnter($data->metagenomics_date_conduct));
                $sheet->setCellValue('AS'.$numrow, $this->cleanEnter($data->metagenomics_barcode_falcon1));
                $sheet->setCellValue('AT'.$numrow, $this->cleanEnter($data->metagenomics_barcode_falcon2));
                $sheet->setCellValue('AU'.$numrow, $this->cleanEnter($data->metagenomics_volume_filtered));
                $sheet->setCellValue('AV'.$numrow, $this->cleanEnter($data->metagenomics_time_started));
                $sheet->setCellValue('AW'.$numrow, $this->cleanEnter($data->metagenomics_time_finished));
                $sheet->setCellValue('AX'.$numrow, $this->cleanEnter($data->metagenomics_time_minutes));
                $sheet->setCellValue('AY'.$numrow, $this->cleanEnter($data->metagenomics_barcode_dna_bag));
                $sheet->setCellValue('AZ'.$numrow, $this->cleanEnter($data->metagenomics_barcode_storage));
                $sheet->setCellValue('BA'.$numrow, $this->cleanEnter($data->metagenomics_location));
                $sheet->setCellValue('BB'.$numrow, $this->cleanEnter($data->metagenomics_comments));
                $sheet->setCellValue('BC'.$numrow, $this->cleanEnter($data->mac1_barcode_macconkey));
                $sheet->setCellValue('BD'.$numrow, $this->cleanEnter($data->mac1_date_process));
                $sheet->setCellValue('BE'.$numrow, $this->cleanEnter($data->mac1_time_process));
                $sheet->setCellValue('BF'.$numrow, $this->cleanEnter($data->mac1_volume));
                $sheet->setCellValue('BG'.$numrow, $this->cleanEnter($data->mac1_comments));
                $sheet->setCellValue('BH'.$numrow, $this->cleanEnter($data->mac2_date_process));
                $sheet->setCellValue('BI'.$numrow, $this->cleanEnter($data->mac2_time_process));
                $sheet->setCellValue('BJ'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep1));
                $sheet->setCellValue('BK'.$numrow, $this->cleanEnter($data->mac2_cryobox1));
                $sheet->setCellValue('BL'.$numrow, $this->cleanEnter($data->macsweep1_location));
                $sheet->setCellValue('BM'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep2));
                $sheet->setCellValue('BN'.$numrow, $this->cleanEnter($data->mac2_cryobox2));
                $sheet->setCellValue('BO'.$numrow, $this->cleanEnter($data->macsweep2_location));
                $sheet->setCellValue('BP'.$numrow, $this->cleanEnter($data->mac2_comments));                
                
                //   $no++; // Tambah 1 setiap kali looping
              $numrow++; // Tambah 1 setiap kali looping
            }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $datenow=date("Ymd");
        $fileName = 'NHMRC_Hand_Bootsocks_report_'.$datenow.'.csv';            
        }
        else if ($rep == 22) {
            $sheet->setCellValue('A1',"barcode_sample");
            $sheet->setCellValue('B1',"sampletype");
            $sheet->setCellValue('C1',"reception_date_arrival");
            $sheet->setCellValue('D1',"reception_time_arrival");
            $sheet->setCellValue('E1',"reception_png_control");
            $sheet->setCellValue('F1',"reception_barcode_tinytag");
            $sheet->setCellValue('G1',"reception_comments");
            $sheet->setCellValue('H1',"sampleentry_barcode_bottle");
            $sheet->setCellValue('I1',"sampleentry_date_conduct");
            $sheet->setCellValue('J1',"sampleentry_vol_aliquot");
            $sheet->setCellValue('K1',"sampleentry_barcode_box");
            $sheet->setCellValue('L1',"sampleentry_position_tube");
            $sheet->setCellValue('M1',"sampleentry_location");
            $sheet->setCellValue('N1',"sampleentry_comments");
            $sheet->setCellValue('O1',"idexx_in_date_conduct");
            $sheet->setCellValue('P1',"idexx_in_time_incubation");
            $sheet->setCellValue('Q1',"idexx_in_barcode_colilert1");
            $sheet->setCellValue('R1',"idexx_in_volume1");
            $sheet->setCellValue('S1',"idexx_in_dilution1");
            $sheet->setCellValue('T1',"idexx_in_comments1");
            $sheet->setCellValue('U1',"idexx_in_barcode_colilert2");
            $sheet->setCellValue('V1',"idexx_in_volume2");
            $sheet->setCellValue('W1',"idexx_in_dilution2");
            $sheet->setCellValue('X1',"idexx_in_comments2");
            $sheet->setCellValue('Y1',"idexx_out_date_conduct");
            $sheet->setCellValue('Z1',"idexx_out_timeout_incubation");
            $sheet->setCellValue('AA1',"idexx_out_time_minutes");
            $sheet->setCellValue('AB1',"idexx_out_ecoli_largewells");
            $sheet->setCellValue('AC1',"idexx_out_ecoli_smallwells");
            $sheet->setCellValue('AD1',"idexx_out_ecoli_mpn");
            $sheet->setCellValue('AE1',"idexx_out_coliforms_largewells");
            $sheet->setCellValue('AF1',"idexx_out_coliforms_smallwells");
            $sheet->setCellValue('AG',"idexx_out_coliforms_mpn");
            $sheet->setCellValue('AH1',"idexx_out_comments");
            $sheet->setCellValue('AI1',"metagenomics_date_conduct");
            $sheet->setCellValue('AJ1',"metagenomics_barcode_falcon1");
            $sheet->setCellValue('AK1',"metagenomics_barcode_falcon2");
            $sheet->setCellValue('AL1',"metagenomics_volume_filtered");
            $sheet->setCellValue('AM1',"metagenomics_time_started");
            $sheet->setCellValue('AN1',"metagenomics_time_finished");
            $sheet->setCellValue('AO1',"metagenomics_time_minutes");
            $sheet->setCellValue('AP1',"metagenomics_barcode_dna_bag");
            $sheet->setCellValue('AQ1',"metagenomics_barcode_storage");
            $sheet->setCellValue('AR1',"metagenomics_location");
            $sheet->setCellValue('AS1',"metagenomics_comments");
            $sheet->setCellValue('AT1',"mac1_barcode_macconkey");
            $sheet->setCellValue('AU1',"mac1_date_process");
            $sheet->setCellValue('AV1',"mac1_time_process");
            $sheet->setCellValue('AW1',"mac1_volume");
            $sheet->setCellValue('AX1',"mac1_comments");
            $sheet->setCellValue('AY1',"mac2_date_process");
            $sheet->setCellValue('AZ1',"mac2_time_process");
            $sheet->setCellValue('BA1',"mac2_bar_macsweep1");
            $sheet->setCellValue('BB1',"mac2_cryobox1");
            $sheet->setCellValue('BC1',"macsweep1_location");
            $sheet->setCellValue('BD1',"mac2_bar_macsweep2");
            $sheet->setCellValue('BE1',"mac2_cryobox2");
            $sheet->setCellValue('BF1',"macsweep2_location");
            $sheet->setCellValue('BG1',"mac2_comments");                       

            $rdeliver = $this->REP_nhmrc_model->get_handrince($date1, $date2, $rep);
        
            $numrow = 2; 
            foreach($rdeliver as $data){ 
                $sheet->setCellValue('A'.$numrow, $this->cleanEnter($data->barcode_sample));
                $sheet->setCellValue('B'.$numrow, $this->cleanEnter($data->sampletype));
                $sheet->setCellValue('C'.$numrow, $this->cleanEnter($data->reception_date_arrival));
                $sheet->setCellValue('D'.$numrow, $this->cleanEnter($data->reception_time_arrival));
                $sheet->setCellValue('E'.$numrow, $this->cleanEnter($data->reception_png_control));
                $sheet->setCellValue('F'.$numrow, $this->cleanEnter($data->reception_barcode_tinytag));
                $sheet->setCellValue('G'.$numrow, $this->cleanEnter($data->reception_comments));
                $sheet->setCellValue('H'.$numrow, $this->cleanEnter($data->sampleentry_barcode_bottle));
                $sheet->setCellValue('I'.$numrow, $this->cleanEnter($data->sampleentry_date_conduct));
                $sheet->setCellValue('J'.$numrow, $this->cleanEnter($data->sampleentry_vol_aliquot));
                $sheet->setCellValue('K'.$numrow, $this->cleanEnter($data->sampleentry_barcode_box));
                $sheet->setCellValue('L'.$numrow, $this->cleanEnter($data->sampleentry_position_tube));
                $sheet->setCellValue('M'.$numrow, $this->cleanEnter($data->sampleentry_location));
                $sheet->setCellValue('N'.$numrow, $this->cleanEnter($data->sampleentry_comments));
                $sheet->setCellValue('O'.$numrow, $this->cleanEnter($data->idexx_in_date_conduct));
                $sheet->setCellValue('P'.$numrow, $this->cleanEnter($data->idexx_in_time_incubation));
                $sheet->setCellValue('Q'.$numrow, $this->cleanEnter($data->idexx_in_barcode_colilert1));
                $sheet->setCellValue('R'.$numrow, $this->cleanEnter($data->idexx_in_volume1));
                $sheet->setCellValue('S'.$numrow, $this->cleanEnter($data->idexx_in_dilution1));
                $sheet->setCellValue('T'.$numrow, $this->cleanEnter($data->idexx_in_comments1));
                $sheet->setCellValue('U'.$numrow, $this->cleanEnter($data->idexx_in_barcode_colilert2));
                $sheet->setCellValue('V'.$numrow, $this->cleanEnter($data->idexx_in_volume2));
                $sheet->setCellValue('W'.$numrow, $this->cleanEnter($data->idexx_in_dilution2));
                $sheet->setCellValue('X'.$numrow, $this->cleanEnter($data->idexx_in_comments2));
                $sheet->setCellValue('Y'.$numrow, $this->cleanEnter($data->idexx_out_date_conduct));
                $sheet->setCellValue('Z'.$numrow, $this->cleanEnter($data->idexx_out_timeout_incubation));
                $sheet->setCellValue('AA'.$numrow, $this->cleanEnter($data->idexx_out_time_minutes));
                $sheet->setCellValue('AB'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_largewells));
                $sheet->setCellValue('AC'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_smallwells));
                $sheet->setCellValue('AD'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_mpn));
                $sheet->setCellValue('AE'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_largewells));
                $sheet->setCellValue('AF'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_smallwells));
                $sheet->setCellValue('AG'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_mpn));
                $sheet->setCellValue('AH'.$numrow, $this->cleanEnter($data->idexx_out_comments));
                $sheet->setCellValue('AI'.$numrow, $this->cleanEnter($data->metagenomics_date_conduct));
                $sheet->setCellValue('AJ'.$numrow, $this->cleanEnter($data->metagenomics_barcode_falcon1));
                $sheet->setCellValue('AK'.$numrow, $this->cleanEnter($data->metagenomics_barcode_falcon2));
                $sheet->setCellValue('AL'.$numrow, $this->cleanEnter($data->metagenomics_volume_filtered));
                $sheet->setCellValue('AM'.$numrow, $this->cleanEnter($data->metagenomics_time_started));
                $sheet->setCellValue('AN'.$numrow, $this->cleanEnter($data->metagenomics_time_finished));
                $sheet->setCellValue('AO'.$numrow, $this->cleanEnter($data->metagenomics_time_minutes));
                $sheet->setCellValue('AP'.$numrow, $this->cleanEnter($data->metagenomics_barcode_dna_bag));
                $sheet->setCellValue('AQ'.$numrow, $this->cleanEnter($data->metagenomics_barcode_storage));
                $sheet->setCellValue('AR'.$numrow, $this->cleanEnter($data->metagenomics_location));
                $sheet->setCellValue('AS'.$numrow, $this->cleanEnter($data->metagenomics_comments));
                $sheet->setCellValue('AT'.$numrow, $this->cleanEnter($data->mac1_barcode_macconkey));
                $sheet->setCellValue('AU'.$numrow, $this->cleanEnter($data->mac1_date_process));
                $sheet->setCellValue('AV'.$numrow, $this->cleanEnter($data->mac1_time_process));
                $sheet->setCellValue('AW'.$numrow, $this->cleanEnter($data->mac1_volume));
                $sheet->setCellValue('AX'.$numrow, $this->cleanEnter($data->mac1_comments));
                $sheet->setCellValue('AY'.$numrow, $this->cleanEnter($data->mac2_date_process));
                $sheet->setCellValue('AZ'.$numrow, $this->cleanEnter($data->mac2_time_process));
                $sheet->setCellValue('BA'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep1));
                $sheet->setCellValue('BB'.$numrow, $this->cleanEnter($data->mac2_cryobox1));
                $sheet->setCellValue('BC'.$numrow, $this->cleanEnter($data->macsweep1_location));
                $sheet->setCellValue('BD'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep2));
                $sheet->setCellValue('BE'.$numrow, $this->cleanEnter($data->mac2_cryobox2));
                $sheet->setCellValue('BF'.$numrow, $this->cleanEnter($data->macsweep2_location));
                $sheet->setCellValue('BG'.$numrow, $this->cleanEnter($data->mac2_comments));                            
                
                //   $no++; // Tambah 1 setiap kali looping
              $numrow++; // Tambah 1 setiap kali looping
            }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $datenow=date("Ymd");
        $fileName = 'NHMRC_Hand_Rinse_report_'.$datenow.'.csv';            
        }        
        else if ($rep == 23) {
            $sheet->setCellValue('A1',"barcode_sample");
            $sheet->setCellValue('B1',"sampletype");
            $sheet->setCellValue('C1',"reception_date_arrival");
            $sheet->setCellValue('D1',"reception_time_arrival");
            $sheet->setCellValue('E1',"reception_png_control");
            $sheet->setCellValue('F1',"reception_barcode_tinytag");
            $sheet->setCellValue('G1',"reception_comments");
            $sheet->setCellValue('H1',"stomacher_date_conduct");
            $sheet->setCellValue('I1',"stomacher_barcode_food");
            $sheet->setCellValue('J1',"stomacher_elution_number");
            $sheet->setCellValue('K1',"stomacher_elution");
            $sheet->setCellValue('L1',"stomacher_food_weight");
            $sheet->setCellValue('M1',"stomacher_food_comments");
            $sheet->setCellValue('N1',"stom_idexx_in_barcode_colilert");
            $sheet->setCellValue('O1',"stom_idexx_in_barcode_falcon1");
            $sheet->setCellValue('P1',"stom_idexx_in_volume_falcon1");
            $sheet->setCellValue('Q1',"stom_idexx_in_barcode_falcon2");
            $sheet->setCellValue('R1',"stom_idexx_in_volume_falcon2");
            $sheet->setCellValue('S1',"stom_idexx_in_dilution");
            $sheet->setCellValue('T1',"stom_idexx_in_time_incu_start");
            $sheet->setCellValue('U1',"stom_idexx_in_comments");
            $sheet->setCellValue('V1',"idexx_out_date_conduct");
            $sheet->setCellValue('W1',"idexx_out_timeout_incubation");
            $sheet->setCellValue('X1',"idexx_out_time_minutes");
            $sheet->setCellValue('Y1',"idexx_out_ecoli_largewells");
            $sheet->setCellValue('Z1',"idexx_out_ecoli_smallwells");
            $sheet->setCellValue('AA1',"idexx_out_ecoli_mpn");
            $sheet->setCellValue('AB1',"idexx_out_coliforms_largewells");
            $sheet->setCellValue('AC1',"idexx_out_coliforms_smallwells");
            $sheet->setCellValue('AD1',"idexx_out_coliforms_mpn");
            $sheet->setCellValue('AE1',"idexx_out_comments");
            $sheet->setCellValue('AF1',"mois_initial_date_moisture");
            $sheet->setCellValue('AG1',"mois_initial_barcode_foil_tray");
            $sheet->setCellValue('AH1',"mois_initial_foil_tray_weight");
            $sheet->setCellValue('AI1',"mois_initial_time_filter_start");
            $sheet->setCellValue('AJ1',"mois_initial_time_filter_finish");
            $sheet->setCellValue('AK1',"mois_initial_wet_weight");
            $sheet->setCellValue('AL1',"mois_initial_time_incubator");
            $sheet->setCellValue('AM1',"mois_initial_comments");
            $sheet->setCellValue('AN1',"mois24_date_moisture");
            $sheet->setCellValue('AO1',"mois24_dry_weight24");
            $sheet->setCellValue('AP1',"mois24_comments");
            $sheet->setCellValue('AQ1',"mois48_date_moisture");
            $sheet->setCellValue('AR1',"mois48_dry_weight48");
            $sheet->setCellValue('AS1',"mois48_difference");
            $sheet->setCellValue('AT1',"mois48_comments");
            $sheet->setCellValue('AU1',"mois72_date_moisture");
            $sheet->setCellValue('AV1',"mois72_dry_weight48");
            $sheet->setCellValue('AW1',"mois72_comments");
            $sheet->setCellValue('AX1',"metagenomics_date_conduct");
            $sheet->setCellValue('AY1',"metagenomics_barcode_dna1");
            $sheet->setCellValue('AZ1',"metagenomics_weight_sub1");
            $sheet->setCellValue('BA1',"metagenomics_barcode_storage1");
            $sheet->setCellValue('BB1',"metagenomics_position_tube1");
            $sheet->setCellValue('BC1',"metagenomics_dna1_location");
            $sheet->setCellValue('BD1',"metagenomics_barcode_dna2");
            $sheet->setCellValue('BE1',"metagenomics_weight_sub2");
            $sheet->setCellValue('BF1',"metagenomics_barcode_storage2");
            $sheet->setCellValue('BG1',"metagenomics_position_tube2");
            $sheet->setCellValue('BH1',"metagenomics_dna2_location");
            $sheet->setCellValue('BI1',"metagenomics_comments");
            $sheet->setCellValue('BJ1',"mac1_barcode_macconkey");
            $sheet->setCellValue('BK1',"mac1_date_process");
            $sheet->setCellValue('BL1',"mac1_time_process");
            $sheet->setCellValue('BM1',"mac1_volume");
            $sheet->setCellValue('BN1',"mac1_comments");
            $sheet->setCellValue('BO1',"mac2_date_process");
            $sheet->setCellValue('BP1',"mac2_time_process");
            $sheet->setCellValue('BQ1',"mac2_bar_macsweep1");
            $sheet->setCellValue('BR1',"mac2_cryobox1");
            $sheet->setCellValue('BS1',"macsweep1_location");
            $sheet->setCellValue('BT1',"mac2_bar_macsweep2");
            $sheet->setCellValue('BU1',"mac2_cryobox2");
            $sheet->setCellValue('BV1',"macsweep2_location");
            $sheet->setCellValue('BW1',"mac2_comments");
            
            $rdeliver = $this->REP_nhmrc_model->get_food($date1, $date2, $rep);
        
            $numrow = 2; 
            foreach($rdeliver as $data){ 
                $sheet->setCellValue('A'.$numrow, $this->cleanEnter($data->barcode_sample));
                $sheet->setCellValue('B'.$numrow, $this->cleanEnter($data->sampletype));
                $sheet->setCellValue('C'.$numrow, $this->cleanEnter($data->reception_date_arrival));
                $sheet->setCellValue('D'.$numrow, $this->cleanEnter($data->reception_time_arrival));
                $sheet->setCellValue('E'.$numrow, $this->cleanEnter($data->reception_png_control));
                $sheet->setCellValue('F'.$numrow, $this->cleanEnter($data->reception_barcode_tinytag));
                $sheet->setCellValue('G'.$numrow, $this->cleanEnter($data->reception_comments));
                $sheet->setCellValue('H'.$numrow, $this->cleanEnter($data->stomacher_date_conduct));
                $sheet->setCellValue('I'.$numrow, $this->cleanEnter($data->stomacher_barcode_food));
                $sheet->setCellValue('J'.$numrow, $this->cleanEnter($data->stomacher_elution_number));
                $sheet->setCellValue('K'.$numrow, $this->cleanEnter($data->stomacher_elution));
                $sheet->setCellValue('L'.$numrow, $this->cleanEnter($data->stomacher_food_weight));
                $sheet->setCellValue('M'.$numrow, $this->cleanEnter($data->stomacher_food_comments));
                $sheet->setCellValue('N'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_colilert));
                $sheet->setCellValue('O'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_falcon1));
                $sheet->setCellValue('P'.$numrow, $this->cleanEnter($data->stom_idexx_in_volume_falcon1));
                $sheet->setCellValue('Q'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_falcon2));
                $sheet->setCellValue('R'.$numrow, $this->cleanEnter($data->stom_idexx_in_volume_falcon2));
                $sheet->setCellValue('S'.$numrow, $this->cleanEnter($data->stom_idexx_in_dilution));
                $sheet->setCellValue('T'.$numrow, $this->cleanEnter($data->stom_idexx_in_time_incu_start));
                $sheet->setCellValue('U'.$numrow, $this->cleanEnter($data->stom_idexx_in_comments));
                $sheet->setCellValue('V'.$numrow, $this->cleanEnter($data->idexx_out_date_conduct));
                $sheet->setCellValue('W'.$numrow, $this->cleanEnter($data->idexx_out_timeout_incubation));
                $sheet->setCellValue('X'.$numrow, $this->cleanEnter($data->idexx_out_time_minutes));
                $sheet->setCellValue('Y'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_largewells));
                $sheet->setCellValue('Z'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_smallwells));
                $sheet->setCellValue('AA'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_mpn));
                $sheet->setCellValue('AB'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_largewells));
                $sheet->setCellValue('AC'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_smallwells));
                $sheet->setCellValue('AD'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_mpn));
                $sheet->setCellValue('AE'.$numrow, $this->cleanEnter($data->idexx_out_comments));
                $sheet->setCellValue('AF'.$numrow, $this->cleanEnter($data->mois_initial_date_moisture));
                $sheet->setCellValue('AG'.$numrow, $this->cleanEnter($data->mois_initial_barcode_foil_tray));
                $sheet->setCellValue('AH'.$numrow, $this->cleanEnter($data->mois_initial_foil_tray_weight));
                $sheet->setCellValue('AI'.$numrow, $this->cleanEnter($data->mois_initial_time_filter_start));
                $sheet->setCellValue('AJ'.$numrow, $this->cleanEnter($data->mois_initial_time_filter_finish));
                $sheet->setCellValue('AK'.$numrow, $this->cleanEnter($data->mois_initial_wet_weight));
                $sheet->setCellValue('AL'.$numrow, $this->cleanEnter($data->mois_initial_time_incubator));
                $sheet->setCellValue('AM'.$numrow, $this->cleanEnter($data->mois_initial_comments));
                $sheet->setCellValue('AN'.$numrow, $this->cleanEnter($data->mois24_date_moisture));
                $sheet->setCellValue('AO'.$numrow, $this->cleanEnter($data->mois24_dry_weight24));
                $sheet->setCellValue('AP'.$numrow, $this->cleanEnter($data->mois24_comments));
                $sheet->setCellValue('AQ'.$numrow, $this->cleanEnter($data->mois48_date_moisture));
                $sheet->setCellValue('AR'.$numrow, $this->cleanEnter($data->mois48_dry_weight48));
                $sheet->setCellValue('AS'.$numrow, $this->cleanEnter($data->mois48_difference));
                $sheet->setCellValue('AT'.$numrow, $this->cleanEnter($data->mois48_comments));
                $sheet->setCellValue('AU'.$numrow, $this->cleanEnter($data->mois72_date_moisture));
                $sheet->setCellValue('AV'.$numrow, $this->cleanEnter($data->mois72_dry_weight48));
                $sheet->setCellValue('AW'.$numrow, $this->cleanEnter($data->mois72_comments));
                $sheet->setCellValue('AX'.$numrow, $this->cleanEnter($data->metagenomics_date_conduct));
                $sheet->setCellValue('AY'.$numrow, $this->cleanEnter($data->metagenomics_barcode_dna1));
                $sheet->setCellValue('AZ'.$numrow, $this->cleanEnter($data->metagenomics_weight_sub1));
                $sheet->setCellValue('BA'.$numrow, $this->cleanEnter($data->metagenomics_barcode_storage1));
                $sheet->setCellValue('BB'.$numrow, $this->cleanEnter($data->metagenomics_position_tube1));
                $sheet->setCellValue('BC'.$numrow, $this->cleanEnter($data->metagenomics_dna1_location));
                $sheet->setCellValue('BD'.$numrow, $this->cleanEnter($data->metagenomics_barcode_dna2));
                $sheet->setCellValue('BE'.$numrow, $this->cleanEnter($data->metagenomics_weight_sub2));
                $sheet->setCellValue('BF'.$numrow, $this->cleanEnter($data->metagenomics_barcode_storage2));
                $sheet->setCellValue('BG'.$numrow, $this->cleanEnter($data->metagenomics_position_tube2));
                $sheet->setCellValue('BH'.$numrow, $this->cleanEnter($data->metagenomics_dna2_location));
                $sheet->setCellValue('BI'.$numrow, $this->cleanEnter($data->metagenomics_comments));
                $sheet->setCellValue('BJ'.$numrow, $this->cleanEnter($data->mac1_barcode_macconkey));
                $sheet->setCellValue('BK'.$numrow, $this->cleanEnter($data->mac1_date_process));
                $sheet->setCellValue('BL'.$numrow, $this->cleanEnter($data->mac1_time_process));
                $sheet->setCellValue('BM'.$numrow, $this->cleanEnter($data->mac1_volume));
                $sheet->setCellValue('BN'.$numrow, $this->cleanEnter($data->mac1_comments));
                $sheet->setCellValue('BO'.$numrow, $this->cleanEnter($data->mac2_date_process));
                $sheet->setCellValue('BP'.$numrow, $this->cleanEnter($data->mac2_time_process));
                $sheet->setCellValue('BQ'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep1));
                $sheet->setCellValue('BR'.$numrow, $this->cleanEnter($data->mac2_cryobox1));
                $sheet->setCellValue('BS'.$numrow, $this->cleanEnter($data->macsweep1_location));
                $sheet->setCellValue('BT'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep2));
                $sheet->setCellValue('BU'.$numrow, $this->cleanEnter($data->mac2_cryobox2));
                $sheet->setCellValue('BV'.$numrow, $this->cleanEnter($data->macsweep2_location));
                $sheet->setCellValue('BW'.$numrow, $this->cleanEnter($data->mac2_comments));                
                                
                //   $no++; // Tambah 1 setiap kali looping
              $numrow++; // Tambah 1 setiap kali looping
            }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $datenow=date("Ymd");
        $fileName = 'NHMRC_Food_report_'.$datenow.'.csv';            
        }
        else if ($rep == 24) {
            $sheet->setCellValue('A1',"barcode_sample");
            $sheet->setCellValue('B1',"sampletype");
            $sheet->setCellValue('C1',"reception_date_arrival");
            $sheet->setCellValue('D1',"reception_time_arrival");
            $sheet->setCellValue('E1',"reception_png_control");
            $sheet->setCellValue('F1',"reception_barcode_tinytag");
            $sheet->setCellValue('G1',"reception_comments");
            $sheet->setCellValue('H1',"mac1_barcode_macconkey");
            $sheet->setCellValue('I1',"mac1_date_process");
            $sheet->setCellValue('J1',"mac1_time_process");
            $sheet->setCellValue('K1',"mac1_volume");
            $sheet->setCellValue('L1',"mac1_comments");
            $sheet->setCellValue('M1',"mac2_date_process");
            $sheet->setCellValue('N1',"mac2_time_process");
            $sheet->setCellValue('O1',"mac2_bar_macsweep1");
            $sheet->setCellValue('P1',"mac2_cryobox1");
            $sheet->setCellValue('Q1',"macsweep1_location");
            $sheet->setCellValue('R1',"mac2_bar_macsweep2");
            $sheet->setCellValue('S1',"mac2_cryobox2");
            $sheet->setCellValue('T1',"macsweep2_location");
            $sheet->setCellValue('U1',"mac2_comments");            
            
            $rdeliver = $this->REP_nhmrc_model->get_handprint($date1, $date2, $rep);
        
            $numrow = 2; 
            foreach($rdeliver as $data){ 
                $sheet->setCellValue('A'.$numrow, $this->cleanEnter($data->barcode_sample));
                $sheet->setCellValue('B'.$numrow, $this->cleanEnter($data->sampletype));
                $sheet->setCellValue('C'.$numrow, $this->cleanEnter($data->reception_date_arrival));
                $sheet->setCellValue('D'.$numrow, $this->cleanEnter($data->reception_time_arrival));
                $sheet->setCellValue('E'.$numrow, $this->cleanEnter($data->reception_png_control));
                $sheet->setCellValue('F'.$numrow, $this->cleanEnter($data->reception_barcode_tinytag));
                $sheet->setCellValue('G'.$numrow, $this->cleanEnter($data->reception_comments));
                $sheet->setCellValue('H'.$numrow, $this->cleanEnter($data->mac1_barcode_macconkey));
                $sheet->setCellValue('I'.$numrow, $this->cleanEnter($data->mac1_date_process));
                $sheet->setCellValue('J'.$numrow, $this->cleanEnter($data->mac1_time_process));
                $sheet->setCellValue('K'.$numrow, $this->cleanEnter($data->mac1_volume));
                $sheet->setCellValue('L'.$numrow, $this->cleanEnter($data->mac1_comments));
                $sheet->setCellValue('M'.$numrow, $this->cleanEnter($data->mac2_date_process));
                $sheet->setCellValue('N'.$numrow, $this->cleanEnter($data->mac2_time_process));
                $sheet->setCellValue('O'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep1));
                $sheet->setCellValue('P'.$numrow, $this->cleanEnter($data->mac2_cryobox1));
                $sheet->setCellValue('Q'.$numrow, $this->cleanEnter($data->macsweep1_location));
                $sheet->setCellValue('R'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep2));
                $sheet->setCellValue('S'.$numrow, $this->cleanEnter($data->mac2_cryobox2));
                $sheet->setCellValue('T'.$numrow, $this->cleanEnter($data->macsweep2_location));
                $sheet->setCellValue('U'.$numrow, $this->cleanEnter($data->mac2_comments));                               
                                
                //   $no++; // Tambah 1 setiap kali looping
              $numrow++; // Tambah 1 setiap kali looping
            }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $datenow=date("Ymd");
        $fileName = 'NHMRC_Hand_Print_'.$datenow.'.csv';            
        }        
        else if ($rep == 25) {
            $sheet->setCellValue('A1',"barcode_sample");
            $sheet->setCellValue('B1',"sampletype");
            $sheet->setCellValue('C1',"reception_date_arrival");
            $sheet->setCellValue('D1',"reception_time_arrival");
            $sheet->setCellValue('E1',"reception_png_control");
            $sheet->setCellValue('F1',"reception_barcode_tinytag");
            $sheet->setCellValue('G1',"reception_comments");
            $sheet->setCellValue('H1',"bs_before_date_weighed_micro");
            $sheet->setCellValue('I1',"bs_before_barcode_bootsocks_micro");
            $sheet->setCellValue('J1',"bs_before_bootsock_weight_dry_micro");
            $sheet->setCellValue('K1',"bs_before_comment_micro");
            $sheet->setCellValue('L1',"bs_after_date_weighed_micro");
            $sheet->setCellValue('M1',"bs_after_barcode_bootsocks_micro");
            $sheet->setCellValue('N1',"bs_after_bootsock_weight_wet_micro");
            $sheet->setCellValue('O1',"bs_after_comment_micro");
            $sheet->setCellValue('P1',"stomacher_date_conduct");
            $sheet->setCellValue('Q1',"stomacher_barcode_bootsocks_Micro");
            $sheet->setCellValue('R1',"stomacher_elution_number_Micro1");
            $sheet->setCellValue('S1',"stomacher_elution_Micro1");
            $sheet->setCellValue('T1',"stomacher_barcode_falcon_Micro1");
            $sheet->setCellValue('U1',"stomacher_volume_Micro1");
            $sheet->setCellValue('V1',"stomacher_elution_number_Micro2");
            $sheet->setCellValue('W1',"stomacher_elution_Micro2");
            $sheet->setCellValue('X1',"stomacher_barcode_falcon_Micro2");
            $sheet->setCellValue('Y1',"stomacher_volume_Micro2");
            $sheet->setCellValue('Z1',"stom_idexx_in_barcode_colilert");
            $sheet->setCellValue('AA1',"stom_idexx_in_barcode_falcon1");
            $sheet->setCellValue('AB1',"stom_idexx_in_volume_falcon1");
            $sheet->setCellValue('AC1',"stom_idexx_in_barcode_falcon2");
            $sheet->setCellValue('AD1',"stom_idexx_in_volume_falcon2");
            $sheet->setCellValue('AE1',"stom_idexx_in_dilution");
            $sheet->setCellValue('AF1',"stom_idexx_in_time_incu_start");
            $sheet->setCellValue('AG1',"stom_idexx_in_comments");
            $sheet->setCellValue('AH1',"idexx_out_date_conduct");
            $sheet->setCellValue('AI1',"idexx_out_timeout_incubation");
            $sheet->setCellValue('AJ1',"idexx_out_time_minutes");
            $sheet->setCellValue('AK1',"idexx_out_ecoli_largewells");
            $sheet->setCellValue('AL1',"idexx_out_ecoli_smallwells");
            $sheet->setCellValue('AM1',"idexx_out_ecoli_mpn");
            $sheet->setCellValue('AN1',"idexx_out_coliforms_largewells");
            $sheet->setCellValue('AO1',"idexx_out_coliforms_smallwells");
            $sheet->setCellValue('AP1',"idexx_out_coliforms_mpn");
            $sheet->setCellValue('AQ1',"idexx_out_comments");
            $sheet->setCellValue('AR1',"mois_initial_date_moisture");
            $sheet->setCellValue('AS1',"mois_initial_barcode_foil_tray");
            $sheet->setCellValue('AT1',"mois_initial_foil_tray_weight");
            $sheet->setCellValue('AU1',"mois_initial_time_filter_start");
            $sheet->setCellValue('AV1',"mois_initial_time_filter_finish");
            $sheet->setCellValue('AW1',"mois_initial_wet_weight");
            $sheet->setCellValue('AX1',"mois_initial_time_incubator");
            $sheet->setCellValue('AY1',"mois_initial_comments");
            $sheet->setCellValue('AZ1',"mois24_date_moisture");
            $sheet->setCellValue('BA1',"mois24_dry_weight24");
            $sheet->setCellValue('BB1',"mois24_comments");
            $sheet->setCellValue('BC1',"mois48_date_moisture");
            $sheet->setCellValue('BD1',"mois48_dry_weight48");
            $sheet->setCellValue('BE1',"mois48_difference");
            $sheet->setCellValue('BF1',"mois48_comments");
            $sheet->setCellValue('BG1',"mois72_date_moisture");
            $sheet->setCellValue('BH1',"mois72_dry_weight48");
            $sheet->setCellValue('BI1',"mois72_comments");
            $sheet->setCellValue('BJ1',"metagenomics_date_conduct");
            $sheet->setCellValue('BK1',"metagenomics_barcode_falcon1");
            $sheet->setCellValue('BL1',"metagenomics_barcode_falcon2");
            $sheet->setCellValue('BM1',"metagenomics_volume_filtered");
            $sheet->setCellValue('BN1',"metagenomics_time_started");
            $sheet->setCellValue('BO1',"metagenomics_time_finished");
            $sheet->setCellValue('BP1',"metagenomics_time_minutes");
            $sheet->setCellValue('BQ1',"metagenomics_barcode_dna_bag");
            $sheet->setCellValue('BR1',"metagenomics_barcode_storage");
            $sheet->setCellValue('BS1',"metagenomics_location");
            $sheet->setCellValue('BT1',"metagenomics_comments");
            $sheet->setCellValue('BU1',"mac1_barcode_macconkey");
            $sheet->setCellValue('BV1',"mac1_date_process");
            $sheet->setCellValue('BW1',"mac1_time_process");
            $sheet->setCellValue('BX1',"mac1_volume");
            $sheet->setCellValue('BY1',"mac1_comments");
            $sheet->setCellValue('BZ1',"mac2_date_process");
            $sheet->setCellValue('CA1',"mac2_time_process");
            $sheet->setCellValue('CB1',"mac2_bar_macsweep1");
            $sheet->setCellValue('CC1',"mac2_cryobox1");
            $sheet->setCellValue('CD1',"macsweep1_location");
            $sheet->setCellValue('CE1',"mac2_bar_macsweep2");
            $sheet->setCellValue('CF1',"mac2_cryobox2");
            $sheet->setCellValue('CG1',"macsweep2_location");
            $sheet->setCellValue('CH1',"mac2_comments");                 
            
            $rdeliver = $this->REP_nhmrc_model->get_toys($date1, $date2, $rep);
        
            $numrow = 2; 
            foreach($rdeliver as $data){ 
                $sheet->setCellValue('A'.$numrow, $this->cleanEnter($data->barcode_sample));
                $sheet->setCellValue('B'.$numrow, $this->cleanEnter($data->sampletype));
                $sheet->setCellValue('C'.$numrow, $this->cleanEnter($data->reception_date_arrival));
                $sheet->setCellValue('D'.$numrow, $this->cleanEnter($data->reception_time_arrival));
                $sheet->setCellValue('E'.$numrow, $this->cleanEnter($data->reception_png_control));
                $sheet->setCellValue('F'.$numrow, $this->cleanEnter($data->reception_barcode_tinytag));
                $sheet->setCellValue('G'.$numrow, $this->cleanEnter($data->reception_comments));
                $sheet->setCellValue('H'.$numrow, $this->cleanEnter($data->bs_before_date_weighed_micro));
                $sheet->setCellValue('I'.$numrow, $this->cleanEnter($data->bs_before_barcode_bootsocks_micro));
                $sheet->setCellValue('J'.$numrow, $this->cleanEnter($data->bs_before_bootsock_weight_dry_micro));
                $sheet->setCellValue('K'.$numrow, $this->cleanEnter($data->bs_before_comment_micro));
                $sheet->setCellValue('L'.$numrow, $this->cleanEnter($data->bs_after_date_weighed_micro));
                $sheet->setCellValue('M'.$numrow, $this->cleanEnter($data->bs_after_barcode_bootsocks_micro));
                $sheet->setCellValue('N'.$numrow, $this->cleanEnter($data->bs_after_bootsock_weight_wet_micro));
                $sheet->setCellValue('O'.$numrow, $this->cleanEnter($data->bs_after_comment_micro));
                $sheet->setCellValue('P'.$numrow, $this->cleanEnter($data->stomacher_date_conduct));
                $sheet->setCellValue('Q'.$numrow, $this->cleanEnter($data->stomacher_barcode_bootsocks_Micro));
                $sheet->setCellValue('R'.$numrow, $this->cleanEnter($data->stomacher_elution_number_Micro1));
                $sheet->setCellValue('S'.$numrow, $this->cleanEnter($data->stomacher_elution_Micro1));
                $sheet->setCellValue('T'.$numrow, $this->cleanEnter($data->stomacher_barcode_falcon_Micro1));
                $sheet->setCellValue('U'.$numrow, $this->cleanEnter($data->stomacher_volume_Micro1));
                $sheet->setCellValue('V'.$numrow, $this->cleanEnter($data->stomacher_elution_number_Micro2));
                $sheet->setCellValue('W'.$numrow, $this->cleanEnter($data->stomacher_elution_Micro2));
                $sheet->setCellValue('X'.$numrow, $this->cleanEnter($data->stomacher_barcode_falcon_Micro2));
                $sheet->setCellValue('Y'.$numrow, $this->cleanEnter($data->stomacher_volume_Micro2));
                $sheet->setCellValue('Z'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_colilert));
                $sheet->setCellValue('AA'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_falcon1));
                $sheet->setCellValue('AB'.$numrow, $this->cleanEnter($data->stom_idexx_in_volume_falcon1));
                $sheet->setCellValue('AC'.$numrow, $this->cleanEnter($data->stom_idexx_in_barcode_falcon2));
                $sheet->setCellValue('AD'.$numrow, $this->cleanEnter($data->stom_idexx_in_volume_falcon2));
                $sheet->setCellValue('AE'.$numrow, $this->cleanEnter($data->stom_idexx_in_dilution));
                $sheet->setCellValue('AF'.$numrow, $this->cleanEnter($data->stom_idexx_in_time_incu_start));
                $sheet->setCellValue('AG'.$numrow, $this->cleanEnter($data->stom_idexx_in_comments));
                $sheet->setCellValue('AH'.$numrow, $this->cleanEnter($data->idexx_out_date_conduct));
                $sheet->setCellValue('AI'.$numrow, $this->cleanEnter($data->idexx_out_timeout_incubation));
                $sheet->setCellValue('AJ'.$numrow, $this->cleanEnter($data->idexx_out_time_minutes));
                $sheet->setCellValue('AK'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_largewells));
                $sheet->setCellValue('AL'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_smallwells));
                $sheet->setCellValue('AM'.$numrow, $this->cleanEnter($data->idexx_out_ecoli_mpn));
                $sheet->setCellValue('AN'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_largewells));
                $sheet->setCellValue('AO'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_smallwells));
                $sheet->setCellValue('AP'.$numrow, $this->cleanEnter($data->idexx_out_coliforms_mpn));
                $sheet->setCellValue('AQ'.$numrow, $this->cleanEnter($data->idexx_out_comments));
                $sheet->setCellValue('AR'.$numrow, $this->cleanEnter($data->mois_initial_date_moisture));
                $sheet->setCellValue('AS'.$numrow, $this->cleanEnter($data->mois_initial_barcode_foil_tray));
                $sheet->setCellValue('AT'.$numrow, $this->cleanEnter($data->mois_initial_foil_tray_weight));
                $sheet->setCellValue('AU'.$numrow, $this->cleanEnter($data->mois_initial_time_filter_start));
                $sheet->setCellValue('AV'.$numrow, $this->cleanEnter($data->mois_initial_time_filter_finish));
                $sheet->setCellValue('AW'.$numrow, $this->cleanEnter($data->mois_initial_wet_weight));
                $sheet->setCellValue('AX'.$numrow, $this->cleanEnter($data->mois_initial_time_incubator));
                $sheet->setCellValue('AY'.$numrow, $this->cleanEnter($data->mois_initial_comments));
                $sheet->setCellValue('AZ'.$numrow, $this->cleanEnter($data->mois24_date_moisture));
                $sheet->setCellValue('BA'.$numrow, $this->cleanEnter($data->mois24_dry_weight24));
                $sheet->setCellValue('BB'.$numrow, $this->cleanEnter($data->mois24_comments));
                $sheet->setCellValue('BC'.$numrow, $this->cleanEnter($data->mois48_date_moisture));
                $sheet->setCellValue('BD'.$numrow, $this->cleanEnter($data->mois48_dry_weight48));
                $sheet->setCellValue('BE'.$numrow, $this->cleanEnter($data->mois48_difference));
                $sheet->setCellValue('BF'.$numrow, $this->cleanEnter($data->mois48_comments));
                $sheet->setCellValue('BG'.$numrow, $this->cleanEnter($data->mois72_date_moisture));
                $sheet->setCellValue('BH'.$numrow, $this->cleanEnter($data->mois72_dry_weight48));
                $sheet->setCellValue('BI'.$numrow, $this->cleanEnter($data->mois72_comments));
                $sheet->setCellValue('BJ'.$numrow, $this->cleanEnter($data->metagenomics_date_conduct));
                $sheet->setCellValue('BK'.$numrow, $this->cleanEnter($data->metagenomics_barcode_falcon1));
                $sheet->setCellValue('BL'.$numrow, $this->cleanEnter($data->metagenomics_barcode_falcon2));
                $sheet->setCellValue('BM'.$numrow, $this->cleanEnter($data->metagenomics_volume_filtered));
                $sheet->setCellValue('BN'.$numrow, $this->cleanEnter($data->metagenomics_time_started));
                $sheet->setCellValue('BO'.$numrow, $this->cleanEnter($data->metagenomics_time_finished));
                $sheet->setCellValue('BP'.$numrow, $this->cleanEnter($data->metagenomics_time_minutes));
                $sheet->setCellValue('BQ'.$numrow, $this->cleanEnter($data->metagenomics_barcode_dna_bag));
                $sheet->setCellValue('BR'.$numrow, $this->cleanEnter($data->metagenomics_barcode_storage));
                $sheet->setCellValue('BS'.$numrow, $this->cleanEnter($data->metagenomics_location));
                $sheet->setCellValue('BT'.$numrow, $this->cleanEnter($data->metagenomics_comments));
                $sheet->setCellValue('BU'.$numrow, $this->cleanEnter($data->mac1_barcode_macconkey));
                $sheet->setCellValue('BV'.$numrow, $this->cleanEnter($data->mac1_date_process));
                $sheet->setCellValue('BW'.$numrow, $this->cleanEnter($data->mac1_time_process));
                $sheet->setCellValue('BX'.$numrow, $this->cleanEnter($data->mac1_volume));
                $sheet->setCellValue('BY'.$numrow, $this->cleanEnter($data->mac1_comments));
                $sheet->setCellValue('BZ'.$numrow, $this->cleanEnter($data->mac2_date_process));
                $sheet->setCellValue('CA'.$numrow, $this->cleanEnter($data->mac2_time_process));
                $sheet->setCellValue('CB'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep1));
                $sheet->setCellValue('CC'.$numrow, $this->cleanEnter($data->mac2_cryobox1));
                $sheet->setCellValue('CD'.$numrow, $this->cleanEnter($data->macsweep1_location));
                $sheet->setCellValue('CE'.$numrow, $this->cleanEnter($data->mac2_bar_macsweep2));
                $sheet->setCellValue('CF'.$numrow, $this->cleanEnter($data->mac2_cryobox2));
                $sheet->setCellValue('CG'.$numrow, $this->cleanEnter($data->macsweep2_location));
                $sheet->setCellValue('CH'.$numrow, $this->cleanEnter($data->mac2_comments));
                                           
                                
                //   $no++; // Tambah 1 setiap kali looping
              $numrow++; // Tambah 1 setiap kali looping
            }
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $datenow=date("Ymd");
        $fileName = 'NHMRC_Toys_'.$datenow.'.csv';            
        }                
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment; filename=$fileName"); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $writer->save('php://output');           
    }

}


/* End of file Tbl_customer.php */
/* Location: ./application/controllers/Tbl_customer.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-12-14 03:29:29 */
/* http://harviacode.com */