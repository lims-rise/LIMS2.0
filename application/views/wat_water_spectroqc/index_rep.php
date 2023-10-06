<style>
@media print{
    .noprint{
        display:none;
    }
@page { margin: 0; }
body { margin: 1.6cm; }
 }

.tab1 { tab-size: 2; }

</style>


<div class="content-wrapper">

<section class="content">
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
<!-- <img src="../../../assets/img/header_inv_02.png" width="1025px" class="icon" style="padding: 10px; float: left;"> -->
<h3>LIMS - Spectro CRM QC</h3>
<div class="noprint">
    <div class="modal-footer clearfix">
        <button id='print' class="btn btn-primary no-print" onclick="document.title = '<?php echo 'Print_Spectro_CRM'?>'; window.print();"><i class="fa fa-print"></i> Print</button>
        <button id='close' class="btn btn-warning" onclick="javascript:history.go(-1);"><i class="fa fa-times"></i> Close</button> 
    </div>
</div>
<!-- // <h4 class=text-right>Invoice : $invoice_number </h4>
// <h4 class=text-right>Date : $date_invoice </h4> -->
</div>

<?php

$q = $this->db->query('SELECT duplication, result, trueness, bias_method FROM obj2b_spectro_crm_det
WHERE flag = 0
AND id_spec="'.$id_spec.'"
ORDER BY duplication');        

$response = $q->result();

?>


<div class="box">
<h3 class="text-center">Verification Method Report</h3>
<input type='hidden' id='id_spec' value='<?php echo $id_spec; ?>'>
<p class="text-left">The results of the verification of the <?php echo $chem_parameter ?> as <?php echo $chem2 ?> (<?php echo $chem3 ?>) test method spectrophotometrically with the determination of trueness, bias and method precision are as follows:
    </p>
<!-- <h4 class="text-right">Date : <?php //echo $date_invoice ?></h4> -->
</br>

<table id="tabletop" width=100%; style="border:0px solid black; margin-left:auto;margin-right:auto;">
    <tr>
    <td align="left"><b>Table 1. Information <?php echo $chem_parameter ?> as <?php echo $chem2 ?> in CRM </b> </td>
    </tr>
    <tr> <td> </br> </td></tr>
    
    <tr>
    <table id="mytable1" width=50%; style="border:1px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr style="border:1px solid black;">
                <td colspan="2" align="center">Information Certificate of Analysis <?php echo $chem3 ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:1px solid black;" align="center">Mixture Name</td>
                <td width=60%; style="border:1px solid black;" align="center"><?php echo $mixture_name ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:1px solid black;" align="center">Sample No.</td>
                <td width=60%; style="border:1px solid black;" align="center"><?php echo $sample_no ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:1px solid black;" align="center">Lot. No.</td>
                <td width=60%; style="border:1px solid black;" align="center"><?php echo $lot_no ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:1px solid black;" align="center">Exp. date</td>
                <td width=60%; style="border:1px solid black;" align="center"><?php echo $date_expired ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:1px solid black;" align="center">Certified Value</td>
                <td width=60%; style="border:1px solid black;" align="center"><?php echo $cert_value ?></td>
            </tr>
            <tr>
                <td width=40%; style="border:1px solid black;" align="center">Uncertainty</td>
                <td width=60%; style="border:1px solid black;" align="center"><?php echo $uncertainty ?></td>
            </tr>
        </thead>
    </table>
    <!-- <tr> <td> </br> </td></tr>
    <tr> <td> </br> </td></tr> -->
    </br>
    </br>
    </tr>
    <tr>
    <td align="left"><b>Table 3. Results of Analysis</b> </td>
    </tr>
    <!-- <tr> <td> </br> </td></tr> -->
    <tr>
    </br>
    <table id="mytable2" style="border:1px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr>
                <td width=100px; style="border:1px solid black;" align="center"><b>Duplication</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>Result (mg/L)</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>Trueness (%R)</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>% Bias Method</b></td>
            </tr>

            <?php foreach ($response as $row): ?>
            <tr>
                <td style="border:1px solid black;" align="center"><?php echo $row->duplication; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $row->result; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $row->trueness; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $row->bias_method; ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td style="border:1px solid black;" align="center"><b>Total</b></td>
                <td style="border:1px solid black;" align="center"><?php echo $tot_result; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $tot_trueness; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $tot_bias; ?></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>Average</b></td>
                <td style="border:1px solid black;" align="center"><?php echo $avg_result; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $avg_trueness; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $avg_bias; ?></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>SD</b></td>
                <td style="border:1px solid black;" align="center"><?php echo $sd; ?></td>
                <td style="border:0px solid black;" align="center"></td>
                <td style="border:0px solid black;" align="center"></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>%RSD</b></td>
                <td style="border:1px solid black;" align="center"><?php echo $rsd; ?></td>
                <td style="border:0x solid black;" align="center"></td>
                <td style="border:0px solid black;" align="center"></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>%CV Horwits</b></td>
                <td style="border:1px solid black;" align="center"><?php echo $cv_horwits; ?></td>
                <td style="border:0px solid black;" align="center"></td>
                <td style="border:0px solid black;" align="center"></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>0.67 x %CV</b></td>
                <td style="border:1px solid black;" align="center"><?php echo $cv; ?></td>
                <td style="border:0px solid black;" align="center"></td>
                <td style="border:0px solid black;" align="center"></td>
            </tr>
            
        </thead>
    </table>
    </br>
    </br>
    </tr>
    <!-- <tr> <td> </br> </td></tr> -->
    <tr>
    <td align="left"><b>Table 4. Acceptance %RSD dan %R for determination Accuracy, Precision and Bias Method</b> </td>
    </br>
    </tr>
    <tr>
    </br>
    <table id="mytable3" style="border:1px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr>
                <td width=100px; style="border:1px solid black;" align="center"><b>Parameter</b></td>
                <td width=150px; style="border:1px solid black;" align="center"><b>Requirements</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>Results</b></td>
                <td width=100px; style="border:1px solid black;" align="center"><b>Conclusion</b></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>Precision</b></td>
                <td style="border:1px solid black;" align="center">% RSD ≤ <?php echo $cv; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $rsd; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $prec; ?></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>Accuracy</b></td>
                <td style="border:1px solid black;" align="center">80% ≤ %R ≤ 115%</td>
                <td style="border:1px solid black;" align="center"><?php echo $avg_trueness; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $accuracy; ?></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>Bias</b></td>
                <td style="border:1px solid black;" align="center">-20% ≤ Bias ≤ 15</td>
                <td style="border:1px solid black;" align="center"><?php echo $avg_bias; ?></td>
                <td style="border:1px solid black;" align="center"><?php echo $bias; ?></td>
            </tr>
        </thead>
    </table>
    </tr>

    <tr>
    </br>
    <table id="mytable3" style="border:1px solid black; margin-left:auto;margin-right:auto;">
        <thead>
            <tr>
                <td width=155px; style="border:1px solid black;" align="center"><b>Date of Conducted</b></td>
                <td width=300px; style="border:1px solid black;" align="center"><b><?php echo $date_spec; ?></b></td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>Place of Conducted</b></td>
                <td style="border:1px solid black;" align="center">RISE Laboratory</td>
            </tr>
            <tr>
                <td style="border:1px solid black;" align="center"><b>Analyst</b></td>
                <td style="border:1px solid black;" align="center"><?php echo $realname; ?></td>
            </tr>
        </thead>
    </table>
    </tr>
    <tfoot>
    </br>
    </br>
    </br>
    </br>
    </br>
    </br>
        <tr>
            <td>Copyright © 2022-2023 LIMS-RISE | RISE Data Team. All rights reserved.</td>
        </tr>
    </tfoot>
</table>



<!-- <div class="footer">
           <img src="../../../assets/img/dot.jpg" width="1025px" height="400px" class="icon" style="padding: 70px; float: left;">
     </div> -->
</div>
</div>
</div>
</div>
</section>    
</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            var table
            $(document).ready(function() {
                var id_del = $('#id_delivery').val();
				var base_url = location.hostname;

                // table = $("#mytable2").DataTable({
                //     oLanguage: {
                //         sProcessing: "loading..."
                //     },
                //     processing: true,
                //     serverSide: true,
                //     paging: false,
                //     ordering: false,
                //     info: false,
                //     bFilter: false,
                //     ajax: {"url": "wat_water_spectroqc/spec_printdet?id="+id_spec, "type": "POST"},
                //     columnDefs: [
                //         {
                //         targets: [4,5],
                //         className: 'text-right'
                //         }
                //     ],
                //     columns: [
                //         // {
                //         //     "data": "id_delivery_det",
                //         //     "orderable": false
                //         // },
                //         {"data": "duplication"},
                //         {"data": "result"},
                //         {"data": "trueness"},
                //         {"data": "bias_method"},
                //     ]
                // });
               
            });
        </script>