<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Objective 3 - Filter Paper</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Filter Paper </button>";
        }
?>

        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('o3_filter_paper/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode sample</th>
		    <th>Date process</th>
		    <th>Time process</th>
		    <th>Lab tech</th>
		    <th>Freezer bag</th>
		    <th>Location</th>
		    <th>Comments</th>
		    <th width="120px">Action</th>
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
    
/* .without_ampm::-webkit-datetime-edit-ampm-field {
   display: none;
 } */
 /* input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 } */
</style>

    <!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">O3 - New Sample Filter Paper</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('o3_filter_paper/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="idfrez" name="idfrez" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode Sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode Sample" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_process" class="col-sm-4 control-label">Date Process</label>
                            <div class="col-sm-8">
                                <input id="date_process" name="date_process" type="date" class="form-control" placeholder="Date Process" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_process" class="col-sm-4 control-label">Time Process</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                <input id="time_process" name="time_process" class="form-control" placeholder="Time Process" value="<?php 
                                $datetime = new DateTime( "now", new DateTimeZone( "Asia/Makassar" ) );
                                echo $datetime->format( 'H:i' );
                                ?>">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                                </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Lab Tech</label>
                            <div class="col-sm-8">
                            <select id='id_person' name="id_person" class="form-control">
                                <option>-- Select lab tech --</option>
                                <?php
                                foreach($person as $row){
									if ($id_person == $row['id_person']) {
										echo "<option value='".$row['id_person']."' selected='selected'>".$row['realname']."</option>";
									}
									else {
                                        echo "<option value='".$row['id_person']."'>".$row['realname']."</option>";
                                    }
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="freezer_bag" class="col-sm-4 control-label">Freezer Bag Barcode</label>
                            <div class="col-sm-8">
                                <input id="freezer_bag" name="freezer_bag" type="text" class="form-control" placeholder="Freezer Bag Barcode" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="freezer" class="col-sm-4 control-label">Freezer Location</label>
                            <div class="col-sm-2">
                            <select id='freezer' name="freezer" class="form-control">
                                <option>Freezer</option>
                                <?php
                                foreach($freezer as $row){
                                    echo "<option value='".$row['freezer']."'>".$row['freezer']."</option>";
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
                            </div>
                            <div class="col-sm-2">
                            <select id='shelf' name="shelf" class="form-control">
                                <option>Shelf</option>
                                <?php
                                foreach($shelf as $row){
                                    echo "<option value='".$row['shelf']."'>".$row['shelf']."</option>";
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
                            </div>

                            <div class="col-sm-2">
                            <select id='rack' name="rack" class="form-control">
                                <option>Rack</option>
                                <?php
                                foreach($rack as $row){
                                    echo "<option value='".$row['rack']."'>".$row['rack']."</option>";
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
                            </div>

                            <div class="col-sm-2">
                            <select id='rack_level' name="rack_level" class="form-control">
                                <option>Drawer</option>
                                <?php
                                foreach($rack_level as $row){
                                    echo "<option value='".$row['rack_level']."'>".$row['rack_level']."</option>";
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
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
        placement: 'bottom', // clock popover placement
        align: 'left',       // popover arrow align
        donetext: 'Done',     // done button text
        autoclose: true,    // auto close when minute is selected
        vibrate: true        // vibrate the device when dragging clock hand
        });                

        $('.val1tip, .val2tip, .val3tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });        

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_sample').focus();
        });

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            }, 3000);                            
        });
        
        $('#freezer_bag').on("change", function() {
            findcryo($('#freezer_bag').val());
        });

        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            ckbar = data1.substring(0,5);
            ckarray = ["N-P1-", "F-P1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-P1-XXXXXX / F-P1-XXXXXX) </strong> </span>');
                $('.val1tip').tooltipster('content', tip);
                $('.val1tip').tooltipster('show');
                $('#barcode_sample').val('');     
                $('#barcode_sample').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#barcode_sample').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#barcode_sample').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_sample').css({'background-color' : '#FFFFFF'});
                            $('#barcode_sample').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_filter_paper/valid_bs?id1="+data1+"&id2=1",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_sample').val('');     
                        $('#barcode_sample').focus();
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
                    }
                }
            });
            }
        });

        function findcryo(data1) {
            $.ajax({
                type: "GET",
                url: "o3_filter_paper/load_cryo?idcryo="+data1,
                data:data1,
                dataType: "json",
                success: function(data) {
                    var freez = '';
                    var shelf = '';
                    var rack = '';
                    var rack_level = '';
                    $("#freezer").val('');
                    $("#shelf").val('');
                    $("#rack").val('');
                    $("#rack_level").val('');                    
                    if (data) {
                        freez = data[0].freezer;
                        shelf = data[0].shelf;
                        rack = data[0].rack;
                        rack_level = data[0].rack_level;
                        // console.log(data);
                        // $("#comments").val(data[0].rack_level);
                    }

                    $("#freezer").val(freez);
                    $("#shelf").val(shelf);
                    $("#rack").val(rack);
                    $("#rack_level").val(rack_level);                    
                }
            });
        }

        // function loadLoc(data1) {
        //     $.ajax({
        //         type: "GET",
        //         url: "o3_filter_paper/load_loc?id1="+data1,
        //         data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             var freez = '';
        //             var shelf = '';
        //             var rack = '';
        //             var rack_level = '';
        //             $("#freezer").val('');
        //             $("#shelf").val('');
        //             $("#rack").val('');
        //             $("#rack_level").val('');                    
        //             if (data) {
        //                 freez = data[0].freezer;
        //                 shelf = data[0].shelf;
        //                 rack = data[0].rack;
        //                 rack_level = data[0].rack_level;
        //                 // console.log(data);
        //                 // $("#comments").val(data[0].rack_level);
        //             }

        //             $("#freezer").val(freez);
        //             $("#shelf").val(shelf);
        //             $("#rack").val(rack);
        //             $("#rack_level").val(rack_level);                    
        //         }
        //     });
        // }
        
    //     function loadLoc(data1) {
    //     // $("#my-another-cool-loader").html('<img src="img/719.gif" />');
    //     $.getJSON("o3_filter_paper/load_loc", {
    //         id1: data1,
    //         // rand: Math.random(),
    //         ajax: 'true'
    //     }, function(j) {
    //         var freez = '';
    //         var shelf = '';
    //         var rack = '';
    //         var rack_level = '';
    //         freez = j.freezer;
    //         shelf = j.shelf;
    //         rack = j.rack;
    //         rack_level = j.rack_level;

    //         for (var i = 0; i < j.length; i++) {
    //             freez += j[i].freezer;
    //             shelf += j[i].shelf;
    //             rack += j[i].rack;
    //             rack_level += j[i].rack_level;
    //         }

    //         $("#freezer").val(freez);
    //         $("#shelf").val(shelf);
    //         $("#rack").val(rack);
    //         $("#rack_level").val(rack_level);

    //         // $("#my-another-cool-loader").html('');
    //     })
    // }

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
            // select: true;
            processing: true,
            serverSide: true,
            ajax: {"url": "o3_filter_paper/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "date_process"},
                {"data": "time_process"},
                {"data": "initial"},
                {"data": "freezer_bag"},
                {"data": "location"},
                {"data": "comments"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[1, 'desc']],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });

        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O3 - New Sample Filter Paper<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            // $("#date_process").datepicker("setDate",'now');
            // $('#time_receipt').timepicker('setTime', new Date());
            $('#id_person').val('');
            $('#freezer_bag').val('');
            $('#freezer').val('');
            $('#shelf').val('');
            $('#rack').val('');
            $('#rack_level').val('');
            $('#comments').val('');
            $('#idfrez').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Sample Filter Paper<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#date_process').val(data.date_process);
            $('#time_process').val(data.time_process);
            $('#id_person').val(data.id_person).trigger('change');
            $('#freezer_bag').val(data.freezer_bag);
            $('#idfrez').val(data.id_location_80);
            // loadLoc(data.id_location_80);
            findcryo(data.freezer_bag);
            $('#comments').val(data.comments);
            $('#compose-modal').modal('show');
        });  

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        })   
                          
    });
</script>