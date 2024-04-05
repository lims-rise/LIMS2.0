<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Objective 2B - Endetec - Out (Water)</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Endetec - OUT</button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('O2b_endetec_out_w/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode endetec</th>
		    <th>Date conducted</th>
		    <th>Time Ecoli detection (duration)</th>
		    <th>Ecoli volume added</th>
		    <th>Ecoli CFU/100mL</th>
		    <th>Coliform volume added</th>
		    <th>Coliform CFU/100mL</th>
		    <th>Comments</th>
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
                    <h4 class="modal-title" id="modal-title">O2B - Endetec - Out (Water)</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('O2b_endetec_out_w/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_endetec" class="col-sm-4 control-label">Barcode endetec</label>
                            <div class="col-sm-8">
                                <input id="barcode_endetec" name="barcode_endetec" type="text" class="form-control" placeholder="Barcode endetec" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="endetec_date" class="col-sm-4 control-label">Endetec in data</label>
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
                            <label for="time_ecoli" class="col-sm-4 control-label">Time Ecoli detection (duration)</label>
                            <div class="col-sm-8">
                                <input id="time_ecoli" name="time_ecoli" type="text" class="form-control clockpicker" placeholder="Time Ecoli detection (duration)">
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="time_incubation" class="col-sm-4 control-label">Time incubation start</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                <input id="time_incubation" name="time_incubation" class="form-control" placeholder="Time incubation start" value="
                                <?php 
                                // $datetime = new DateTime();
                                // echo $datetime->format( 'H:i' );
                                ?>">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="volume_ecoli" class="col-sm-4 control-label">Ecoli volume added</label>
                            <div class="col-sm-8">
                                <input id="volume_ecoli" name="volume_ecoli" type="number" step="0.01"  class="form-control" placeholder="Ecoli volume added" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ecoli_cfu" class="col-sm-4 control-label">Ecoli CFU/100mL</label>
                            <div class="col-sm-8">
                                <input id="ecoli_cfu" name="ecoli_cfu" type="number" step="0.01"  class="form-control" placeholder="Ecoli CFU/100mL" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_coliforms" class="col-sm-4 control-label">Coliform volume added</label>
                            <div class="col-sm-8">
                                <input id="total_coliforms" name="total_coliforms" type="number" step="0.01"  class="form-control" placeholder="Coliform volume added" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_coli_cfu" class="col-sm-4 control-label">Coliform CFU/100mL</label>
                            <div class="col-sm-8">
                                <input id="total_coli_cfu" name="total_coli_cfu" type="number" step="0.01"  class="form-control" placeholder="Coliform CFU/100mL" required>
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

</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table


    $(document).ready(function() {
        
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


        // function checkBarcode() { col-sm-8
        // $('.modal-body').click(function() {
        $('#barcode_sample').click(function() {
            $('.val1tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        $('#barcode_endetec').click(function() {
            $('.val1tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        // $('.col-sm-8').click(function() {

            // $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        // });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        $('.datepicker').datepicker({
                    autoclose: true,
                    dateFormat:'yy-mm-dd'
                });                  

        // $('.timepicker').timepicker({
        //     timeFormat: 'h:mm p',
        //     interval: 60,
        //     minTime: '10',
        //     maxTime: '6:00pm',
        //     defaultTime: '11',
        //     startTime: '10:00',
        //     dynamic: false,
        //     dropdown: true,
        //     scrollbar: true
        // });


        // $('.timepicker').timepicker({
        //     autoclose: true,
        //     timeFormat: 'H:i'
        // })          

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

        $('#time_incubation').on('click', function (){
            $('#time_incubation').clockpicker('setTime', new Date());
            });

        
        // $('#time_incubation').timepicker({ 'timeFormat': 'H:i' });
        // $('#time_incubation').on('click', function (){
        //     $('#time_incubation').timepicker('setTime', new Date());
        //     });
                    
        $('#volume_ecoli').on("keyup", function() {
             $('#ecoli_cfu').val($('#volume_ecoli').val()/$('#dilution_in').val());
        });

        $('#total_coliforms').on("keyup", function() {
             $('#total_coli_cfu').val($('#total_coliforms').val()/$('#dilution_in').val());
        });

        // $('#barcode_sample').on("change", function() {
        //     data1 = $('#barcode_sample').val();
        //     $.ajax({
        //         type: "GET",
        //         url: "O2b_endetec_out_w/valid_bs?id1="+data1,
        //         dataType: "json",
        //         success: function(data) {
        //             if (data.length == 0) {
        //                 tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is not on reception or is already in the system !</span>');
        //                 $('.val1tip').tooltipster('content', tip);
        //                 $('.val1tip').tooltipster('show');
        //                 $('#barcode_sample').focus();
        //                 $('#barcode_sample').val('');     
        //                 $('#barcode_sample').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#barcode_sample').css({'background-color' : '#FFFFFF'});
        //                     setTimeout(function(){
        //                         $('#barcode_sample').css({'background-color' : '#FFE6E7'});
        //                         setTimeout(function(){
        //                             $('#barcode_sample').css({'background-color' : '#FFFFFF'});
        //                         }, 300);                            
        //                     }, 300);
        //                 }, 300);
        //             }
        //         }
        //     });
        // });

        $('#barcode_endetec').on("change", function() {
            data1 = $('#barcode_endetec').val();
            $.ajax({
                type: "GET",
                url: "O2b_endetec_out_w/valid_bs?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        $('#date_conduct_in').val(data[0].date);     
                        $('#time_incubation_in').val(data[0].time);     
                        $('#dilution_in').val(data[0].dil);     
                    }
                    else {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode endetec <strong> ' + data1 +'</strong> is already in the system or not register on the Endetec in (water) !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_endetec').focus();
                        $('#barcode_endetec').val('');     
                        $('#barcode_endetec').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_endetec').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_endetec').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_endetec').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        });


        // $("input").focusout(function(){
        //     if ($('#barcode_sample').val() == ""){
        //         tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode sample <strong> is required !</strong></span>');
        //         $('.val1tip').tooltipster('content', tip);
        //         $('.val1tip').tooltipster('show');
        //         $('#barcode_sample').focus();
        //         // $('.val1tip').tooltipster('hide');   
        //     }
        // });

        $("input").keypress(function(){
            // $('#barcode_sample').val('');     
            $('.val1tip,.val2tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            // $('#barcode_sample').val('');     
            $('#barcode_sample').focus();
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
            ajax: {"url": "O2b_endetec_out_w/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_endetec"},
                {"data": "date_conduct"},
                {"data": "time_ecoli"},
                {"data": "volume_ecoli"},
                {"data": "ecoli_cfu"},
                {"data": "total_coliforms"},
                {"data": "total_coli_cfu"},
                {"data": "comments"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O2B - New Endetec - Out (Water)<span id="my-another-cool-loader"></span>');
            $('#barcode_endetec').attr('readonly', false);
            $('#date_conduct_in').attr('readonly', true);
            $('#time_incubation_in').attr('readonly', true);
            $('#dilution_in').attr('readonly', true);
            $('#ecoli_cfu').attr('readonly', true);
            $('#total_coli_cfu').attr('readonly', true);
            $('#barcode_endetec').val('');
            $("#date_conduct").datepicker("setDate",'now');
            // $('#time_incubation').clockpicker("setTime", new Date());
            // $('#date_conduct').val('');
            // $('#time_incubation').val('');
            // $('#blank_type').val('');
            $('#volume_ecoli').val('0');
            $('#ecoli_cfu').val('0');
            $('#total_coliforms').val('0');
            $('#total_coli_cfu').val('0');
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
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O2B - Update Endetec - Out (Water)<span id="my-another-cool-loader"></span>');
            $('#barcode_endetec').attr('readonly', true);
            // $('#barcode_endetec').change();             
            $('#date_conduct_in').attr('readonly', true);
            $('#time_incubation_in').attr('readonly', true);
            $('#dilution_in').attr('readonly', true);
            $('#ecoli_cfu').attr('readonly', true);
            $('#total_coli_cfu').attr('readonly', true);
            $('#barcode_endetec').val(data.barcode_endetec);
            $('#date_conduct_in').val(data.date_conduct_in);
            $('#time_incubation_in').val(data.time_incubation_in);
            $('#dilution_in').val(data.dilution_in);
            $('#date_conduct').val(data.date_conduct);
            $('#time_ecoli').val(data.time_ecoli);
            // $('#blank_type').val(data.blank_type).trigger('change');
            $('#volume_ecoli').val(data.volume_ecoli);
            $('#ecoli_cfu').val(data.ecoli_cfu);
            $('#total_coliforms').val(data.total_coliforms);
            $('#total_coli_cfu').val(data.total_coli_cfu);
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