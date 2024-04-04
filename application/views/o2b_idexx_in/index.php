<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Objective 2B - IDEXX - In (Water)</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New IDEXX IN</button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('O2b_idexx_in/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode sample</th>
		    <th>Date conducted</th>
		    <!-- <th>Time incubation start</th> -->
		    <th>Barcode Colilert</th>
		    <th>Volume (mL)</th>
		    <th>Barcode Colilert_2</th>
		    <th>Volume_2 (mL)</th>
		    <!-- <th>Dilution</th> -->
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
                    <h4 class="modal-title" id="modal-title">O2B - IDEXX - In (Water)</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('O2b_idexx_in/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode sample" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_conduct" class="col-sm-4 control-label">Date conduct</label>
                            <div class="col-sm-8">
                                <input id="date_conduct" name="date_conduct" type="text" class="form-control datepicker" placeholder="Date conduct">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_incubation" class="col-sm-4 control-label">Time incubation start</label>
                            <div class="col-sm-8">
                                <input id="time_incubation" name="time_incubation" type="text" class="form-control clockpicker" placeholder="Time incubation start" value="<?php $datetime = new DateTime(); echo $datetime->format( 'H:i:s' ); ?>">
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
                        <hr>

                        <div class="form-group">
                            <label for="barcode_colilert" class="col-sm-4 control-label">Barcode colilert</label>
                            <div class="col-sm-8">
                                <input id="barcode_colilert" name="barcode_colilert" type="text" class="form-control" placeholder="Barcode colilert" required>
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">Volume (mL) added</label>
                            <div class="col-sm-8">
                                <input id="volume" name="volume" type="number" step="0.001"  class="form-control" placeholder="Volume (mL) added" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dilution" class="col-sm-4 control-label">Dilution</label>
                            <div class="col-sm-8">
                                <input id="dilution" name="dilution" type="text" class="form-control" placeholder="Dilution" required>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="comments" class="col-sm-4 control-label">Comments</label>
                                <div class="col-sm-8">
                                    <textarea id="comments" name="comments" class="form-control" placeholder="Comments"> </textarea>
                                </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="barcode_colilert2" class="col-sm-4 control-label">Barcode colilert-2</label>
                            <div class="col-sm-8">
                                <input id="barcode_colilert2" name="barcode_colilert2" type="text" class="form-control" placeholder="Barcode colilert-2">
                                <div class="val3tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume2" class="col-sm-4 control-label">Volume-2 (mL) added</label>
                            <div class="col-sm-8">
                                <input id="volume2" name="volume2" type="number" step="0.01"  class="form-control" placeholder="Volume-2 (mL) added">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dilution2" class="col-sm-4 control-label">Dilution-2</label>
                            <div class="col-sm-8">
                                <input id="dilution2" name="dilution2" type="text" class="form-control" placeholder="Dilution-2">
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="comments2" class="col-sm-4 control-label">Comments-2</label>
                                <div class="col-sm-8">
                                    <textarea id="comments2" name="comments2" class="form-control" placeholder="Comments-2"> </textarea>
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

        $('.val1tip, .val2tip, .val3tip').tooltipster({
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
            $('.val1tip, .val2tip, .val3tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        $('#barcode_colilert').click(function() {
            $('.val1tip, .val2tip, .val3tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        // $('.col-sm-8').click(function() {

            // $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        // });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip, .val2tip, .val3tip').tooltipster('hide');   
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
                    
        $('#volume').on("keyup change click", function() {
            $('#dilution').val($('#volume').val()/100);
        });

        $('#volume2').on("keyup change click", function() {
            $('#dilution2').val($('#volume2').val()/100);
        });

        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            // ckbar = data1.substring(0,5);
            // ckarray = ["N0-B0-", "N-F0-", "N-P1-", "F-B0-", "F-F0-", "F-P1-",];
            // ckarray = [10, 11, 12];
            // ck = $.inArray(ckbar, ckarray);
            // if (ck == -1) {
            //     tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong></br> ex.(N-B0-XXXXXX / F-B0-XXXXXX) </br> (N-F0-XXXXXX / F-F0-XXXXXX) </br> (N-P1-XXXXXX / F-P1-XXXXXX) </strong> </span>');
            //     $('.val1tip').tooltipster('content', tip);
            //     $('.val1tip').tooltipster('show');
            //     $('#barcode_sample').val('');     
            //     $('#barcode_sample').css({'background-color' : '#FFE6E7'});
            //     setTimeout(function(){
            //         $('#barcode_sample').css({'background-color' : '#FFFFFF'});
            //         setTimeout(function(){
            //             $('#barcode_sample').css({'background-color' : '#FFE6E7'});
            //             setTimeout(function(){
            //                 $('#barcode_sample').css({'background-color' : '#FFFFFF'});
            //                 $('#barcode_sample').focus();
            //             }, 300);                            
            //         }, 300);
            //     }, 300);
            // }
            // else {
            $.ajax({
                type: "GET",
                url: "O2b_idexx_in/valid_bs?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length == 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is not on reception or is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_sample').focus();
                        $('#barcode_sample').val('');     
                        $('#barcode_sample').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_sample').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_sample').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_sample').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);

                        // barcode = data[0].barcode_sample;
                        // console.log(data);
                    }
                }
            });
            // }
            // $('.val1tip').tooltipster('content', 'Barcode :' + $(this).val()+' salah input, seharusnya memakai kode bla bla bla');
            // setTimeout(function(){
            //     $('.val1tip').tooltipster('hide');        
            // }, 5000);
        });

        $('#barcode_colilert').on("change", function() {
            data1 = $('#barcode_colilert').val();
            data2 = $('#barcode_colilert2').val();
            // data2 = $('#barcode_sample').val();
            $.ajax({
                type: "GET",
                url: "O2b_idexx_in/valid_bs2?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if ((data.length > 0) || data1==data2) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode colilert <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
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

        $('#barcode_colilert2').on("change", function() {
            data1 = $('#barcode_colilert2').val();
            data2 = $('#barcode_colilert').val();
            // data2 = $('#barcode_sample').val();
            $.ajax({
                type: "GET",
                url: "O2b_idexx_in/valid_bs2?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if ((data.length > 0) || data1==data2) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode colilert <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val3tip').tooltipster('content', tip);
                        $('.val3tip').tooltipster('show');
                        $('#barcode_colilert2').focus();
                        $('#barcode_colilert2').val('');     
                        $('#barcode_colilert2').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_colilert2').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_colilert2').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_colilert2').css({'background-color' : '#FFFFFF'});
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
            $('.val1tip,.val2tip,.val2tip').tooltipster('hide');   
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
            ajax: {"url": "O2b_idexx_in/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "date_conduct"},
                // {"data": "time_incubation"},
                {"data": "barcode_colilert"},
                {"data": "volume"},
                {"data": "barcode_colilert2"},
                {"data": "volume2"},
                // {"data": "dilution"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O2B - New IDEXX - In (Water)<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            $("#date_conduct").datepicker("setDate",'now');
            // $('#time_incubation').clockpicker("setTime", new Date());
            // $('#date_conduct').val('');
            // $('#time_incubation').val('');
            // $('#blank_type').val('');
            $('#barcode_colilert').val('');
            $('#volume').val('');
            $('#dilution').attr('readonly', true);
            $('#dilution').val('');
            $('#comments').val('');
            $('#barcode_colilert2').val('');
            $('#volume2').val('');
            $('#dilution2').val('');
            $('#comments2').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            $('.val1tip').tooltipster('hide');   
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O2B - Update IDEXX - In (Water)<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#date_conduct').val(data.date_conduct);
            $('#time_incubation').val(data.time_incubation);
            // $('#blank_type').val(data.blank_type).trigger('change');
            $('#barcode_colilert').val(data.barcode_colilert);
            $('#volume').val(data.volume);
            $('#dilution').attr('readonly', true);
            $('#dilution').val(data.dilution);
            $('#comments').val(data.comments);
            $('#barcode_colilert2').val(data.barcode_colilert2);
            $('#volume2').val(data.volume2);
            $('#dilution2').val(data.dilution2);
            $('#comments2').val(data.comments2);
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