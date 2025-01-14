<div class="content-wrapper">
    <section class="content">


       <div class="row">
             <div class="col-xs-12">
                <div class="box box-primary box-solid">

                    <div class="box-header">
                        <h3 class="box-title">REPORTS - NHMRC REPORT</h3>
                    </div>
                    <div id="buttonContainer" class="box-body">
                        <a class="btn btn-success btn-sm" id="nhmrc_sample_reception" href="nhmrc_sample_reception/excel"><i class="fa fa-file-excel-o"></i><br />Reception</a> 
                        <a class="btn btn-success btn-sm" id="nhmrc_bootsocks_before" href="nhmrc_bootsocks_before/excel"><i class="fa fa-file-excel-o"></i><br />B.Before</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_bootsocks_after" href="nhmrc_bootsocks_after/excel"><i class="fa fa-file-excel-o"></i><br />B.After</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_bootsocks_stomacher" href="nhmrc_bootsocks_stomacher/excel"><i class="fa fa-file-excel-o"></i><br />Stomacher(B/T)</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_sample_prep" href="nhmrc_sample_prep/excel"><i class="fa fa-file-excel-o"></i><br />Stomacher (Food)</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_blank_in" href="nhmrc_blank_in/excel"><i class="fa fa-file-excel-o"></i><br />Blank IN</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_idexx_in" href="nhmrc_idexx_in/excel"><i class="fa fa-file-excel-o"></i><br />IDEXX IN (HR)</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_idexx_out" href="nhmrc_idexx_out/excel"><i class="fa fa-file-excel-o"></i><br />IDEXX Out(All)</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_macconkey_in" href="nhmrc_macconkey_in/excel"><i class="fa fa-file-excel-o"></i><br />Mac In</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_macconkey_out" href="nhmrc_macconkey_out/excel"><i class="fa fa-file-excel-o"></i><br />Mac Out</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_metagenomics_br" href="nhmrc_metagenomics_br/excel"><i class="fa fa-file-excel-o"></i><br />Meta (B/R)</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_metagenomics_food" href="nhmrc_metagenomics_food/excel"><i class="fa fa-file-excel-o"></i><br />Meta (Food)</a>
                        <br><br>
                        <a class="btn btn-success btn-sm" id="nhmrc_moisture_initial" href="nhmrc_moisture_initial/excel"><i class="fa fa-file-excel-o"></i><br />Mois (I)</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_moisture_24" href="nhmrc_moisture_24/excel"><i class="fa fa-file-excel-o"></i><br />Mois (24)</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_moisture_48" href="nhmrc_moisture_48/excel"><i class="fa fa-file-excel-o"></i><br />Mois (48)</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_moisture_72" href="nhmrc_moisture_72/excel"><i class="fa fa-file-excel-o"></i><br />Mois (72)</a>
                        <a class="btn btn-success btn-sm" id="nhmrc_sample_entry" href="nhmrc_sample_entry/excel"><i class="fa fa-file-excel-o"></i><br />Sample entry (HR)</a>
                    </div>

                    <!-- <button id="triggerAllButtons" class="btn btn-primary">Export All</button> -->
                    <hr>

                    <div class="box-body">
                
                        <!-- <button> </button> -->
                        <!-- <div class="col-md-12 col-xs-12"> -->
                        <div class="form-group">
                            <label for="rep_type" class="col-sm-3 control-label">Report for sample type</label>
                            <div class="col-sm-4">
                                <select class="form-control" id="rep_type" name="rep_type" >
                                    <option>-- Select sample type --</option>
                                    <?php
                                    echo "<option value='18' >Porch Bootsocks</option>
                                        <option value='19' >Indoor Bootsocks</option>
                                        <option value='20' >Outdoor Bootsocks</option>
                                        <option value='21' >Hand Bootsocks</option>
                                        <option value='22' >Hand Rinse</option>
                                        <option value='23' >Food</option>
                                        <option value='24' >Hand Print</option>
                                        <option value='25' >Toys</option>
                                        <option value='26' >Swab Indoor</option>
                                        <option value='27' >Drinking Water</option>
                                        ";
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- <a class="btn btn-success btn-sm" id="o2a_sample_reception" href="o2a_sample_reception/excel"><i class="fa fa-file-excel-o"></i><br /> Sample Reception</a>
                            <a class="btn btn-success btn-sm" id="o2a_sample_logging" href="o2a_sample_logging/excel"><i class="fa fa-file-excel-o"></i><br /> Sample Logging</a>
                            <a class="btn btn-success btn-sm" id="o2a_mosquito_identifications" href="o2a_mosquito_identifications/excel"><i class="fa fa-file-excel-o"></i><br /> Mosquito Identifications</a> -->
                        <!-- </div> -->


                    </div> <!-- </box-body2 > -->

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <td width="250">Select date range :</td>
                            </tr>
                            <tr>
                                <td>
                                <div class="box">
                                    <!-- <div class="collapse" id="collapse-frez">
                                        <div class="box box-solid"> -->
                                            <div class="box-body">
                                            <!-- <form name="form" action="" method="get"> -->
                                            <!-- <label for="date_rep" class="col-sm-2 control-label">Pilih tanggal : </label> -->
                                                <div class="col-sm-2">
                                                    <input type="date" id="date_rep1" name="date_rep1" placeholder="Date start" class="form-control input-sm">
                                                </div>
                                                <div class="col-sm-2">
                                                    <input type="date" id="date_rep2" name="date_rep2" placeholder="Date end" class="form-control input-sm">
                                                </div>
                                                <!-- </form> -->
                                                <button id="refresh-rep" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Refresh</button>
                                            </div>
                                        <!-- </div>
                                    </div> -->
                                </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="box">
                                            <div class="box-header"></div>
                                            <div class="box-body table-responsive">
                                            <div style="padding-bottom: 10px;">
                                                <button class='btn btn-success btn-sm' id='export'> <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export To Excel </button>
                                                <?php //echo anchor(site_url('REP_nhmrc/index2'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                                                <?php //echo anchor(site_url('REP_nhmrc/excel/'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
                                                <?php //echo anchor(site_url('kelolamenu/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?>
                                            </div>

                                            <table id="myreptable" class="table display table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Barcode sample</th>
                                                            <th>Date arrive</th>
                                                            <th>Time arrive</th>
                                                            <th>Sample type</th>
                                                            <th>P&G control</th>
                                                            <th>Barcode tinytag</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!-- /.col-xs-12 -->
                                </div><!-- /.row -->                                
                                </td>
                            </tr>
                        </table>
                    <!-- </form> -->
                    </div> <!-- </box-body1 > -->
                </div>
            </div>
        </div>

    </section>

</div>
<!-- <script src="<?php //echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script> -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

const currentDate = new Date();
// Get the year, month, and day components
const year = currentDate.getFullYear();
const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so add 1 and pad with '0'
const day = String(currentDate.getDate()).padStart(2, '0');
// Create the formatted date string in "YYYY-MM-DD" format and store it in a variable
const formattedDate = `${year}-${month}-${day}`;

    $(document).ready(function() {
/*
        // Click event for the trigger button
        $('#triggerAllButtons').on('click', function() {
            // Find all buttons in the container and trigger their clicks
            $('#buttonContainer').find('a.btn-success').each(function() {
                // Triggering the click event using the JavaScript click() method
                $(this)[0].click();
            });
        });

        // Click event for each individual button
        $('a.btn-success').on('click', function(e) {
            // Prevent the default action (e.g., following the link)
            e.preventDefault();
            
            // Your button click logic goes here
            // For example, you can open a link using window.location.href
            window.location.href = $(this).attr('href');
        });

*/
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };

        $('#date_rep1').on('click', function (){
            if ($('#date_rep1').val() > $('#date_rep2').val()) {
                $('#date_rep2').val($('#date_rep1').val());
            }
        });

        $('#date_rep2').on('click', function (){
            if ($('#date_rep2').val() < $('#date_rep1').val()) {
                $('#date_rep1').val($('#date_rep2').val());
            }
        });

        $('#date_rep1').on('blur', function (){
            if ($('#date_rep1').val() > $('#date_rep2').val()) {
                $('#date_rep2').val($('#date_rep1').val());
            }
        });

        $('#date_rep2').on('blur', function (){
            if ($('#date_rep2').val() < $('#date_rep1').val()) {
                $('#date_rep1').val($('#date_rep2').val());
            }
        });

        $("#export").on('click', function() {
            var rep = $('#rep_type').val();
            var date1 = $('#date_rep1').val();
            var date2 = $('#date_rep2').val();
            if (date1 == '') {
                date1 = '2018-01-01';    
            }
            if (date2 == '') {
                date2=formattedDate;
            }
            document.location.href="REP_nhmrc/excel?date1="+date1+"&date2="+date2+"&rep="+rep;
        });

    $('#refresh-rep ').click(function() {
        var rep = $('#rep_type').val();
        var date1 = $('#date_rep1').val();
        var date2 = $('#date_rep2').val();
        var t = $("#myreptable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            bDestroy: true,
            // paging: true,
            ordering: true,
            info: false,
            bFilter: false,
            ajax: {"url": "REP_nhmrc/json?date1="+date1+"&date2="+date2+"&rep="+rep, "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false,
                //     "className" : "text-center"
                // },
                {"data": "barcode_sample"},
                {"data": "date_arrival"},
                {"data": "time_arrival"},
                {"data": "sampletype"},
                {"data": "png_control"},
                {"data": "barcode_tinytag"},
            ],
            order: [[1, 'DESC']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });
        // $('#compose-modal').modal('show');
    });

    });
</script>