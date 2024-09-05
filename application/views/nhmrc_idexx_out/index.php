<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">NHMRC - IDEXX - Out (All)</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New IDEXX Out</button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('nhmrc_idexx_out/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode colilert</th>
		    <th>Date conducted</th>
		    <th>Incubation duration (minutes)</th>
		    <th>Ecoli large wells</th>
		    <th>Ecoli small wells</th>
		    <th>Ecoli MPN/100 mL</th>
		    <th>Coliform large wells</th>
		    <th>Coliform small wells</th>
		    <th>Coliform MPN/100 mL</th>
		    <!-- <th>Comments</th> -->
		    <th>Action</th>
                </tr>
            </thead>
	    
        </table>
        </div>
                    </div>
            </div>
            </div>
    </section>
<style>

.table tbody tr.selected {
    color: white !important;
    background-color: #9CDCFE !important;
}
    
</style>

    <!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">NHMRC - IDEXX - Out (All)</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('nhmrc_idexx_out/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_colilert" class="col-sm-4 control-label">Barcode colilert</label>
                            <div class="col-sm-8">
                                <input id="barcode_colilert" name="barcode_colilert" type="text" class="form-control" placeholder="Barcode colilert" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="idexx_date" class="col-sm-4 control-label">IDEXX in data</label>
                            <div class="col-sm-3">
                                <input id="date_conduct_in" name="date_conduct_in" type="text" class="form-control" placeholder="Date conduct in">
                            </div>
                            <div class="col-sm-3">
                                <input id="time_incubation_in" name="time_incubation_in" type="text" class="form-control" placeholder="Time conduct in">
                            </div>
                            <div class="col-sm-2">
                                <input id="dilution_in" name="dilution_in" type="text" class="form-control" placeholder="Dilution in">
                            </div>
                        </div>

                        <hr>


                        <div class="form-group">
                            <label for="date_conduct" class="col-sm-4 control-label">Date conduct</label>
                            <div class="col-sm-8">
                                <input id="date_conduct" name="date_conduct" type="text" class="form-control datepicker" placeholder="Date conduct">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="timeout_incubation" class="col-sm-4 control-label">Time incubation finished</label>
                            <div class="col-sm-8">
                                <input id="timeout_incubation" name="timeout_incubation" type="text" class="form-control clockpicker" placeholder="Time incubation finished">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_minutes" class="col-sm-4 control-label">Time incubation duration</label>
                            <div class="col-sm-8">
                                <input id="time_minutes" name="time_minutes" type="text" class="form-control clockpicker" placeholder="Time incubation duration">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ecoli_largewells" class="col-sm-4 control-label">Ecoli large wells</label>
                            <div class="col-sm-8">
                                <input id="ecoli_largewells" name="ecoli_largewells" type="number" step="1" min="0" max="49" class="form-control" placeholder="Ecoli large wells" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ecoli_smallwells" class="col-sm-4 control-label">Ecoli small wells</label>
                            <div class="col-sm-8">
                                <input id="ecoli_smallwells" name="ecoli_smallwells" type="number" step="1" min="0" max="48" class="form-control" placeholder="Ecoli small wells" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ecoli_mpn" class="col-sm-4 control-label">Ecoli MPN/100mL</label>
                            <div class="col-sm-8">
                                <input id="ecoli_mpn" name="ecoli_mpn" type="text" class="form-control" placeholder="Ecoli MPN/100mL" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="coliforms_largewells" class="col-sm-4 control-label">Coliforms Large Wells</label>
                            <div class="col-sm-8">
                                <input id="coliforms_largewells" name="coliforms_largewells" type="number" step="1" min="0" max="49" class="form-control" placeholder="Coliforms Large Wells" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="coliforms_smallwells" class="col-sm-4 control-label">Coliforms Small Wells</label>
                            <div class="col-sm-8">
                                <input id="coliforms_smallwells" name="coliforms_smallwells" type="number" step="1" min="0" max="48" class="form-control" placeholder="Coliforms Small Wells" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="coliforms_mpn" class="col-sm-4 control-label">Total coliforms MPN/100mL</label>
                            <div class="col-sm-8">
                                <input id="coliforms_mpn" name="coliforms_mpn" type="text" class="form-control" placeholder="Total coliforms MPN/100mL" required>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="comments" class="col-sm-4 control-label">Comments</label>
                                <div class="col-sm-8">
                                    <textarea id="comments" name="comments" class="form-control" placeholder="Comments"> </textarea>
                                </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="notes" class="col-sm-4 control-label">Notes</label>
                            <div class="col-sm-8">
                                <textarea id="notes" name="notes" class="form-control input-sm" placeholder="Notes"> </textarea>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer clearfix">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                        <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->    
    
    <!-- MODAL CONFIRMATION DELETE -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dd4b39; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i> NHMRC - IDEXX - Out (All) | Delete <span id="my-another-cool-loader"></span></h4>
                </div>
                <div class="modal-body">
                    <div id="confirmation-content">
                        <div class="modal-body">
                            <p class="text-center" style="font-size: 15px;">Are you sure you want to delete sample <span id="id" style="font-weight: bold;"></span> ?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <button type="button" id="confirm-save" class="btn btn-danger"><i class="fa fa-trash"></i> Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table

    function showDays(firstDate,secondDate){
        var startDay = new Date(firstDate);
        var endDay = new Date(secondDate);
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var millisBetween = startDay.getTime() - endDay.getTime();
        var days = millisBetween / millisecondsPerDay;
        return Math.floor(days);
    }

    function toMinutes(time_str) {
        var parts = time_str.split(':');
        return parts[0] * 3600 + parts[1] * 60;
    }


    $(document).ready(function() {

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('NHMRC_idexx_out/delete'); ?>/' + id;
            $('#confirm-modal #id').text(id);
            console.log(id);
            showConfirmation(url);
        });

        // When the confirm-save button is clicked
        $('#confirm-save').click(function() {
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                complete: function() {
                    $('#confirm-modal').modal('hide');
                    location.reload();
                }
            });
        });

        $('.clockpicker').clockpicker({
            // 'default': DisplayCurrentTime(),
            // default: DisplayCurrentTime(),
            placement: 'bottom', // clock popover placement
            align: 'left',       // popover arrow align
            donetext: 'Done',     // done button text
            autoclose: true,    // auto close when minute is selected
            vibrate: true        // vibrate the device when dragging clock hand
        });

        // $('.timepicker').timepicker({
        //     autoclose: true,
        //     timeFormat: 'H:i'
        // });

        $('.val1tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            // touchDevices: false,
            // trigger: 'hover',
            autoClose: true,
            position: 'bottom',
            // content: $('<span><i class="fa fa-exclamation-triangle"></i> <strong> This text is in bold case !</strong></span>')
            // content: $('<span><img src="../assets/img/ttd.jpg" /> <strong>This text is in bold case !</strong></span>')
            // content: 'Test tip'
        });


        $('#barcode_colilert').click(function() {
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_colilert').val('');     
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        $('.datepicker').datepicker({
            autoclose: true,
            dateFormat:'yy-mm-dd'
        });                  

        function load_dilution(data1) {
            $.ajax({
                type: "GET",
                url: "nhmrc_idexx_out/load_dilution?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#date_conduct_in').val(data[0].date_cond);     
                        $('#time_incubation_in').val(data[0].time_i);     
                        $('#dilution_in').val(data[0].dil);     
                        // var days = showDays($('#date_conduct').val(), $('#date_conduct_in').val());
                        // var difference = Math.abs(toMinutes($('#timeout_incubation').val()) - toMinutes($('#time_incubation_in').val()));
                        // var result = Math.floor(difference / 60) + (24 * 60 * days);
                        // $('#time_minutes').val(result);
                    }
                    else {
                        $('#date_conduct_in').val('');     
                        $('#time_incubation_in').val('');     
                        $('#dilution_in').val('');     
                    }
                }
            });
            // return res; 
        }

        function datachart(data1, data2) {
            $.ajax({
                type: "GET",
                url: "nhmrc_idexx_out/data_chart?id1="+data1+"&id2="+data2,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        if (data[0].mpn == '<Detection') {
                            res = "<"+ Math.round(1 / $("#dilution_in").val());
                        }
                        else if (data[0].mpn == '>Detection') {
                            res = ">"+ Math.round(2082 / $("#dilution_in").val());
                        }
                        else {
                            res = Math.round(data[0].mpn / $("#dilution_in").val());
                        }
                    }
                    else {
                        res = 'Invalid';     
                    }
                }
            });
            return res; 
        }

        $('#ecoli_largewells').on('change keypress keyup keydown', function(event) {        
            var empn = datachart($('#ecoli_largewells').val(), $('#ecoli_smallwells').val());
            if (empn == 'Invalid'){
                $('#ecoli_mpn').css({'background-color' : '#FFE6E7'});
                $('#ecoli_largewells').val('0');
                $('#ecoli_smallwells').val('0');
            }
            else {
                $('#ecoli_mpn').css({'background-color' : '#EEEEEE'});
            }
            $("#ecoli_mpn").val(empn);
        });

        $('#ecoli_smallwells').on('change keypress keyup keydown', function(event) {        
            var empn = datachart($('#ecoli_largewells').val(), $('#ecoli_smallwells').val());
            if (empn == 'Invalid'){
                $('#ecoli_mpn').css({'background-color' : '#FFE6E7'});
                $('#ecoli_largewells').val('0');
                $('#ecoli_smallwells').val('0');
            }
            else {
                $('#ecoli_mpn').css({'background-color' : '#EEEEEE'});
            }
            $("#ecoli_mpn").val(empn);
        });

        $('#coliforms_largewells').on('change keypress keyup keydown', function(event) {        
            var empn = datachart($('#coliforms_largewells').val(), $('#coliforms_smallwells').val());
            if (empn == 'Invalid'){
                $('#coliforms_mpn').css({'background-color' : '#FFE6E7'});
                $('#coliforms_largewells').val('0');
                $('#coliforms_smallwells').val('0');
            }
            else {
                $('#coliforms_mpn').css({'background-color' : '#EEEEEE'});
            }
            $("#coliforms_mpn").val(empn);
        });

        $('#coliforms_smallwells').on('change keypress keyup keydown', function(event) {        
            var empn = datachart($('#coliforms_largewells').val(), $('#coliforms_smallwells').val());
            if (empn == 'Invalid'){
                $('#coliforms_mpn').css({'background-color' : '#FFE6E7'});
                $('#coliforms_largewells').val('0');
                $('#coliforms_smallwells').val('0');
            }
            else {
                $('#coliforms_mpn').css({'background-color' : '#EEEEEE'});
            }
            $("#coliforms_mpn").val(empn);
        });

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();
        today = yyyy + '-' + mm + '-' + dd;
        // today = mm + '/' + dd + '/' + yyyy;
            $('#date_conduct').on('change', function (){
                if ($('#date_conduct').val() > today) {
                    $('#date_conduct').val(today);
                }
            });

        $("#date_conduct").datepicker({
            format: 'yyyy-mm-dd',
            // format: 'mm/dd/yyyy',
            orientation: "auto",
            autoclose: true
        });

        $("#barcode_colilert").change( function() {
            load_dilution($("#barcode_colilert").val());
        });

        $('#barcode_colilert').on("change", function() {
            data1 = $('#barcode_colilert').val();
            // load_dilution(data1);
            $.ajax({
                type: "GET",
                url: "nhmrc_idexx_out/valid_bs?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // $('#date_conduct_in').val(data[0].date_cond);     
                        // $('#time_incubation_in').val(data[0].time_i);     
                        // $('#dilution_in').val(data[0].dil);     
                    }
                    else {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode Colilert <strong> ' + data1 +'</strong> is already in the system or not register on the IDEXX in !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_colilert').focus();
                        $('#barcode_colilert').val('');     
                        $('#barcode_colilert').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_colilert').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_colilert').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_colilert').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        });

        $('#date_conduct').on('change', function (){
            var days = showDays($('#date_conduct').val(), $('#date_conduct_in').val());
            var difference = (toMinutes($('#timeout_incubation').val()) - toMinutes($('#time_incubation_in').val()));
            var result = Math.floor(difference / 60) + (24 * 60 * days);
            $('#time_minutes').val(result);
            if ($('#time_minutes').val() <= 0 ) {
                $('#time_minutes').val("");
                // $('#date_conduct').val("");
                $('#timeout_incubation').val("");
            }
        });        

        $('#timeout_incubation').on('change keypress keyup keydown', function(event) {        
        // $('#timeout_incubation').on('change', function (){
            var days = showDays($('#date_conduct').val(), $('#date_conduct_in').val());
            var difference = (toMinutes($('#timeout_incubation').val()) - toMinutes($('#time_incubation_in').val()));
            var result = Math.floor(difference / 60) + (24 * 60 * days);
            $('#time_minutes').val(result);
            if ($('#time_minutes').val() <= 0 ) {
                $('#time_minutes').val("");
                // $('#date_conduct').val("");
                $('#timeout_incubation').val("");
            }
        });        

        $("input").keypress(function(){
            // $('#barcode_sample').val('');     
            $('.val1tip,.val2tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            // $('#barcode_sample').val('');     
            $('#barcode_colilert').focus();
        });        
                
        var base_url = location.hostname;
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

        table = $("#mytable").DataTable({
            // initComplete: function() {
            //     var api = this.api();
            //     $('#mytable_filter input')
            //             .off('.DT')
            //             .on('keyup.DT', function(e) {
            //                 if (e.keyCode == 13) {
            //                     api.search(this.value).draw();
            //                 }
            //     });
            // },
            oLanguage: {
                sProcessing: "loading..."
            },
            // select: true;
            processing: true,
            serverSide: true,
            ajax: {"url": "nhmrc_idexx_out/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_colilert"},
                {"data": "date_conduct"},
                {"data": "time_minutes"},
                {"data": "ecoli_largewells"},
                {"data": "ecoli_smallwells"},
                {"data": "ecoli_mpn"},
                {"data": "coliforms_largewells"},
                {"data": "coliforms_smallwells"},
                {"data": "coliforms_mpn"},
                // {"data": "comments"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[1, 'desc']],
            // order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });

        $('#addtombol').click(function() {
            $('.val1tip').tooltipster('hide');   
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> NHMRC - New IDEXX - Out');
            $('#barcode_colilert').attr('readonly', false);
            $('#date_conduct_in').attr('readonly', true);
            $('#time_incubation_in').attr('readonly', true);
            $('#dilution_in').attr('readonly', true);
            $('#barcode_colilert').val('');
            // load_dilution('');
            $("#date_conduct").datepicker("setDate",'now');
            // $('#time_incubation').clockpicker("setTime", new Date());
            $('#date_conduct_in').val('');
            $('#time_incubation_in').val('');
            $('#dilution_in').val('');
            $('#timeout_incubation').val('');
            $('#time_minutes').attr('readonly', true);
            $('#time_minutes').val('');
            $('#ecoli_largewells').val('0');
            $('#ecoli_smallwells').val('0');
            $('#ecoli_mpn').attr('readonly', true);
            $('#ecoli_mpn').val('0');
            $('#coliforms_largewells').val('0');
            $('#coliforms_smallwells').val('0');
            $('#coliforms_mpn').attr('readonly', true);
            $('#coliforms_mpn').val('0');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            $('.val1tip').tooltipster('hide');   
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> NHMRC - Update IDEXX - Out');
            $('#barcode_colilert').attr('readonly', true);
            // $('#barcode_colilert').change();             
            $('#date_conduct_in').attr('readonly', true);
            $('#time_incubation_in').attr('readonly', true);
            $('#dilution_in').attr('readonly', true);
            $('#barcode_colilert').val(data.barcode_colilert);
            load_dilution(data.barcode_colilert);
            // $('#barcode_colilert').trigger('change');
            // $('#date_conduct_in').val(data.date_conduct_in);
            // $('#time_incubation_in').val(data.time_incubation_in);
            // $('#dilution_in').val(data.dilution_in);
            $('#barcode_colilert').val(data.barcode_colilert);
            $('#date_conduct').val(data.date_conduct);
            $('#timeout_incubation').val(data.timeout_incubation);
            $('#time_minutes').attr('readonly', true);
            $('#time_minutes').val(data.time_minutes);
            $('#ecoli_largewells').val(data.ecoli_largewells);
            $('#ecoli_smallwells').val(data.ecoli_smallwells);
            $('#ecoli_mpn').attr('readonly', true);
            $('#ecoli_mpn').val(data.ecoli_mpn);
            $('#coliforms_largewells').val(data.coliforms_largewells);
            $('#coliforms_smallwells').val(data.coliforms_smallwells);
            $('#coliforms_mpn').attr('readonly', true);
            $('#coliforms_mpn').val(data.coliforms_mpn);
            $('#comments').val(data.comments);
            $('#compose-modal').modal('show');
        });  

        // #tblEmployee tbody tr.even:hover {
        //     background-color: cadetblue;
        //     cursor: pointer;
        // }
        // $('#myTable').DataTable( {
        //     select: true
        // } );

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        })   

        // $('[data-dismiss=modal]').on('click', function(e) {
        //     var $t = $(this),
        //         target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
        //     $(target)
        //         .find("input,textarea,select")
        //         .val('')
        //         .end()
        //         .find("input[type=checkbox], input[type=radio]")
        //         .prop("checked", "")
        //         .end();
        // });
        // $('.modal').on('hidden.bs.modal', function() {
        //     $(this).find('form')[0].reset();
        // });
        // $('.modal').on('shown.bs.modal', function() {
        //     lastfocus = $(this);
        //     $('input:enabled:visible:not([readonly="readonly"])', this).get(0).select();
        // });                                
    });
</script>