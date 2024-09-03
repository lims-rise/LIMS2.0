<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">NHMRC - Metagenomics (Bootsocks & Hand Rinse)</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Metagenomics (B/H)</button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('nhmrc_metagenomics_br/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>Barcode (W0/S1)</th>
                    <th>Barcode falcon 2</th>
                    <th>Date conducted</th>
                    <th>Volume filtered (mL)</th>
                    <th>Time started filtering</th>
                    <th>Time finished filtering</th>
                    <th>Duration filtering (minutes)</th>
                    <th>Barcode DNA storage</th>
                    <th>Barcode storage box</th>
                    <th>Freezer Location</th>
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
                    <h4 class="modal-title" id="modal-title">NHMRC - Metagenomics (Bootsocks & Hand Rinse)</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('nhmrc_metagenomics_br/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode (W0/S1)</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode sample/falcon 1" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="barcode_falcon2" class="col-sm-4 control-label">Barcode falcon 2</label>
                            <div class="col-sm-8">
                                <input id="barcode_falcon2" name="barcode_falcon2" type="text" class="form-control" placeholder="Barcode falcon 2">
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_conduct" class="col-sm-4 control-label">Date conduct</label>
                            <div class="col-sm-8">
                                <input id="date_conduct" name="date_conduct" type="text" class="form-control datepicker" placeholder="Date conduct">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume_filtered" class="col-sm-4 control-label">Volume filtered (mL)</label>
                            <div class="col-sm-8">
                                <input id="volume_filtered" name="volume_filtered" type="number" step="0.01"  class="form-control" placeholder="Volume filtered (mL)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_started" class="col-sm-4 control-label">Time started</label>
                            <div class="col-sm-8">
                                <input id="time_started" name="time_started" type="text" class="form-control clockpicker" placeholder="Time started" value="<?php $datetime = new DateTime(); echo $datetime->format( 'H:i:s' ); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_finished" class="col-sm-4 control-label">Time finished</label>
                            <div class="col-sm-8">
                                <input id="time_finished" name="time_finished" type="text" class="form-control clockpicker" placeholder="Time finished" value="<?php $datetime = new DateTime(); echo $datetime->format( 'H:i:s' ); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_minutes" class="col-sm-4 control-label">Duration (minutes)</label>
                            <div class="col-sm-8">
                                <input id="time_minutes" name="time_minutes" type="number" step="0.01"  class="form-control" placeholder="Duration (minutes)" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="barcode_dna_bag" class="col-sm-4 control-label">Barcode DNA Bag</label>
                            <div class="col-sm-8">
                                <input id="barcode_dna_bag" name="barcode_dna_bag" type="text" class="form-control" placeholder="Barcode DNA Bag" required>
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_storage" class="col-sm-4 control-label">Barcode storage</label>
                            <div class="col-sm-8">
                                <input id="barcode_storage" name="barcode_storage" type="text" class="form-control" placeholder="Barcode storage" required>
                                <!-- <div class="val2tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_location" class="col-sm-4 control-label">Freezer Location</label>
                            <input id="id_loc" name="id_loc" type="hidden" class="form-control" required>
                            <div class="col-sm-2">
                            <select id='id_freez' name="id_freez" class="form-control" required>
                                <option>Freezer</option>
                                    <?php
                                    foreach($freez1 as $row){
                                        echo "<option value='".$row['freezer']."'>".$row['freezer']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_shelf' name="id_shelf" class="form-control" required>
                                <option>Shelf</option>
                                    <?php
                                    foreach($shelf1 as $row){
                                        echo "<option value='".$row['shelf']."'>".$row['shelf']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_rack' name="id_rack" class="form-control" required>
                                <option>Rack</option>
                                    <?php
                                    foreach($rack1 as $row){
                                        echo "<option value='".$row['rack']."'>".$row['rack']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_draw' name="id_draw" class="form-control" required>
                                <option>Drawer</option>
                                    <?php
                                    foreach($draw1 as $row){
                                        echo "<option value='".$row['rack_level']."'>".$row['rack_level']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="comments" class="col-sm-4 control-label">Comments</label>
                                <div class="col-sm-8">
                                    <textarea id="comments" name="comments" class="form-control" placeholder="Comments"> </textarea>
                                </div>
                        </div>

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
                    <h4 class="modal-title"><i class="fa fa-trash"></i> NHMRC - Metagenomics (Bootsocks & Hand Rinse) | Delete <span id="my-another-cool-loader"></span></h4>
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
            let url = '<?php echo site_url('NHMRC_metagenomics_br/delete'); ?>/' + id;
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

        $('.val1tip, .val2tip').tooltipster({
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

        function load_freez(data1) {
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_br/load_freez?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_freez').val(data[0].freezer);    
                        $('#id_shelf').val(data[0].shelf);    
                        $('#id_rack').val(data[0].rack);    
                        $('#id_draw').val(data[0].rack_level);    
                    }
                    else {
                        $('#id_freez').val('');    
                        $('#id_shelf').val('');    
                        $('#id_rack').val('');    
                        $('#id_draw').val('');    
                    }
                }
            });
            // return res; 
        }

        function get_freez(data1, data2, data3, data4) {
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_br/get_freez?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_loc').val(data[0].id_location_80);    
                    }
                    else {
                        $('#id_loc').val('');    
                    }
                }
            });
        }

        // function checkBarcode() { col-sm-8
        // $('.modal-body').click(function() {
        $('#barcode_sample').click(function() {
            $('.val1tip, .val2tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        $('#barcode_colilert').click(function() {
            $('.val1tip, .val2tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        // $('.col-sm-8').click(function() {

            // $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        // });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip, .val2tip').tooltipster('hide');   
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

        $('#id_freez').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_draw').val())
        });
        $('#id_shelf').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_draw').val())
        });
        $('#id_rack').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_draw').val())
        });
        $('#id_draw').on('change', function (){
            get_freez($('#id_freez').val(), $('#id_shelf').val(), $('#id_rack').val(), $('#id_draw').val())
        });


        $('#time_started').on('change', function (){
            var difference = Math.abs(toMinutes($('#time_finished').val()) - toMinutes($('#time_started').val()));
            var result = Math.floor(difference / 60);
            $('#time_minutes').val(result);
        });

        $('#time_started').on('keyup', function (){
            var difference = Math.abs(toMinutes($('#time_finished').val()) - toMinutes($('#time_started').val()));
            var result = Math.floor(difference / 60);
            $('#time_minutes').val(result);
        });

        $('#time_finished').on('change', function (){
            var difference = Math.abs(toMinutes($('#time_finished').val()) - toMinutes($('#time_started').val()));
            var result = Math.floor(difference / 60);
            $('#time_minutes').val(result);
        });

        $('#time_finished').on('keyup', function (){
            var difference = Math.abs(toMinutes($('#time_finished').val()) - toMinutes($('#time_started').val()));
            var result = Math.floor(difference / 60);
            $('#time_minutes').val(result);
        });            
        
        // $('#time_incubation').timepicker({ 'timeFormat': 'H:i' });
        // $('#time_incubation').on('click', function (){
        //     $('#time_incubation').timepicker('setTime', new Date());
        //     });
                    
        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_br/valid_bs?id1="+data1,
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
                        $('#volume_filtered').val('0');     
                        $('#barcode_falcon2').attr('readonly', true);
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
                    else {
                        $('#volume_filtered').val(data[0].vol);     
                        if (data[0].stype == 'Bootsocks') {
                            $('#barcode_falcon2').attr('readonly', false);
                        } else {
                            $('#barcode_falcon2').attr('readonly', true);
                        }
                        // console.log(data);
                        // load_stype(data1);
                    }
                }
            });
            // }
            // $('.val1tip').tooltipster('content', 'Barcode :' + $(this).val()+' salah input, seharusnya memakai kode bla bla bla');
            // setTimeout(function(){
            //     $('.val1tip').tooltipster('hide');        
            // }, 5000);
        });

        $('#barcode_dna_bag').on("change", function() {
            data1 = $('#barcode_dna_bag').val();
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_br/valid_dna?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode DNA bag <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#barcode_dna_bag').focus();
                        $('#barcode_dna_bag').val('');     
                        $('#barcode_dna_bag').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_dna_bag').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_dna_bag').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_dna_bag').css({'background-color' : '#FFFFFF'});
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
            ajax: {"url": "nhmrc_metagenomics_br/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "barcode_falcon2"},
                {"data": "date_conduct"},
                {"data": "volume_filtered"},
                {"data": "time_started"},
                {"data": "time_finished"},
                {"data": "time_minutes"},
                {"data": "barcode_dna_bag"},
                {"data": "barcode_storage"},
                {"data": "location"},
                {"data": "comments"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[2, 'desc']],
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> NHMRC - New Metagenomics (Bootsocks & Hand Rinse)<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_falcon2').attr('readonly', true);
            $('#barcode_sample').val('');
            $('#barcode_falcon2').val('');
            $("#date_conduct").datepicker("setDate",'now');
            $('#volume_filtered').val('');
            $('#time_started').val('');
            $('#time_finished').val('');
            $('#time_minutes').val('');
            $('#barcode_dna_bag').val('');
            $('#barcode_storage').val('');
            $('#id_location').val('');
            $('#id_freez').val('');
            $('#id_shelf').val('');
            $('#id_rack').val('');
            $('#id_draw').val('');
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
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> NHMRC - Update Metagenomics (Bootsocks & Hand Rinse)<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#barcode_falcon2').val(data.barcode_falcon2);
            $('#date_conduct').val(data.date_conduct);
            $('#volume_filtered').val(data.volume_filtered);
            $('#time_started').val(data.time_started);
            $('#time_finished').val(data.time_finished);
            $('#time_minutes').val(data.time_minutes);
            $('#barcode_dna_bag').val(data.barcode_dna_bag);
            $('#barcode_storage').val(data.barcode_storage);
            load_freez(data.id_location_80);
            // $('#id_location_80').val(data.id_location_80);
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