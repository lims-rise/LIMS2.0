<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">NHMRC - Macconkey out</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Macconkey out</button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('nhmrc_macconkey_out/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode macconkey</th>
		    <th>Date process</th>
		    <th>Time process</th>
		    <th>Lab tech</th>
		    <th>Macconkey sweep-1</th>
		    <th>Cryobox-1</th>
		    <th>Macconkey sweep-2</th>
		    <th>Cryobox-2</th>
		    <th>Comments</th>
		    <th width="150px">Action</th>
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
                    <h4 class="modal-title" id="modal-title">NHMRC - New Macconkey out</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('nhmrc_macconkey_out/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="bar_macconkey" class="col-sm-4 control-label">Barcode macconkey</label>
                            <div class="col-sm-8">
                                <input id="bar_macconkey" name="bar_macconkey" type="text" class="form-control" placeholder="Barcode Macconkey" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_process" class="col-sm-4 control-label">Date process</label>
                            <div class="col-sm-8">
                                <input id="date_process" name="date_process" type="date" class="form-control" placeholder="Date Process" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_process" class="col-sm-4 control-label">Time process</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                <input id="time_process" name="time_process" class="form-control" placeholder="Time Process" value="<?php 
                                $datetime = new DateTime();
                                echo $datetime->format( 'H:i' );
                                ?>">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                                </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Lab tech</label>
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
                            <label for="bar_macsweep1" class="col-sm-4 control-label">Barcode MacSweep-1</label>
                            <div class="col-sm-8">
                                <input id="bar_macsweep1" name="bar_macsweep1" type="text" class="form-control" placeholder="Barcode MacSweep-1" required>
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cryobox1" class="col-sm-4 control-label">Cryobox-1</label>
                            <div class="col-sm-8">
                                <input id="cryobox1" name="cryobox1" type="text" class="form-control" placeholder="Cryobox-1" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_location1" class="col-sm-4 control-label">Freezer Location-1</label>
                            <input id="id_loc1" name="id_loc1" type="hidden" class="form-control" required>
                            <div class="col-sm-2">
                            <select id='id_freez1' name="id_freez1" class="form-control" required>
                                <option>Freezer</option>
                                    <?php
                                    foreach($freez1 as $row){
                                        echo "<option value='".$row['freezer']."'>".$row['freezer']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_shelf1' name="id_shelf1" class="form-control" required>
                                <option>Shelf</option>
                                    <?php
                                    foreach($shelf1 as $row){
                                        echo "<option value='".$row['shelf']."'>".$row['shelf']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_rack1' name="id_rack1" class="form-control" required>
                                <option>Rack</option>
                                    <?php
                                    foreach($rack1 as $row){
                                        echo "<option value='".$row['rack']."'>".$row['rack']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_draw1' name="id_draw1" class="form-control" required>
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
                            <label for="bar_macsweep2" class="col-sm-4 control-label">Barcode MacSweep-2</label>
                            <div class="col-sm-8">
                                <input id="bar_macsweep2" name="bar_macsweep2" type="text" class="form-control" placeholder="Barcode MacSweep-2" required>
                                <div class="val3tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cryobox2" class="col-sm-4 control-label">Cryobox-2</label>
                            <div class="col-sm-8">
                                <input id="cryobox2" name="cryobox2" type="text" class="form-control" placeholder="Cryobox-2" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_location2" class="col-sm-4 control-label">Freezer Location-2</label>
                            <input id="id_loc2" name="id_loc2" type="hidden" class="form-control" required>
                            <div class="col-sm-2">
                            <select id='id_freez2' name="id_freez2" class="form-control" required>
                                <option>Freezer</option>
                                    <?php
                                    foreach($freez2 as $row){
                                        echo "<option value='".$row['freezer']."'>".$row['freezer']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_shelf2' name="id_shelf2" class="form-control" required>
                                <option>Shelf</option>
                                    <?php
                                    foreach($shelf2 as $row){
                                        echo "<option value='".$row['shelf']."'>".$row['shelf']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_rack2' name="id_rack2" class="form-control" required>
                                <option>Rack</option>
                                    <?php
                                    foreach($rack2 as $row){
                                        echo "<option value='".$row['rack']."'>".$row['rack']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_draw2' name="id_draw2" class="form-control" required>
                                <option>Drawer</option>
                                    <?php
                                    foreach($draw2 as $row){
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
                    <h4 class="modal-title"><i class="fa fa-trash"></i> NHMRC - Macconkey out | Delete <span id="my-another-cool-loader"></span></h4>
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
    $(document).ready(function() {

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('NHMRC_macconkey_out/delete'); ?>/' + id;
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
        placement: 'bottom', // clock popover placement
        align: 'left',       // popover arrow align
        donetext: 'Done',     // done button text
        autoclose: true,    // auto close when minute is selected
        vibrate: true        // vibrate the device when dragging clock hand
        });                

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#bar_macconkey').focus();
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

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            }, 3000);                            
        });

        function load_freez(data1) {
            $.ajax({
                type: "GET",
                url: "nhmrc_macconkey_out/load_freez?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_freez1').val(data[0].freezer);    
                        $('#id_shelf1').val(data[0].shelf);    
                        $('#id_rack1').val(data[0].rack);    
                        $('#id_draw1').val(data[0].rack_level);    
                    }
                    else {
                        $('#id_freez1').val('');    
                        $('#id_shelf1').val('');    
                        $('#id_rack1').val('');    
                        $('#id_draw1').val('');    
                    }
                }
            });
        }

        function load_freez2(data1) {
            $.ajax({
                type: "GET",
                url: "nhmrc_macconkey_out/load_freez?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_freez2').val(data[0].freezer);    
                        $('#id_shelf2').val(data[0].shelf);    
                        $('#id_rack2').val(data[0].rack);    
                        $('#id_draw2').val(data[0].rack_level);    
                    }
                    else {
                        $('#id_freez2').val('');    
                        $('#id_shelf2').val('');    
                        $('#id_rack2').val('');    
                        $('#id_draw2').val('');    
                    }
                }
            });
        }

        function get_freez(data1, data2, data3, data4) {
            $.ajax({
                type: "GET",
                url: "nhmrc_macconkey_out/get_freez?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_loc1').val(data[0].id_location_80_1);    
                        $('#id_loc2').val(data[0].id_location_80_2);    
                    }
                    else {
                        $('#id_loc1').val('');    
                        $('#id_loc2').val('');    
                    }
                }
            });
        }

        $('#bar_macconkey').on("change", function() {
            data1 = $('#bar_macconkey').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-S1-", "F-S1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-F2-XXXXXX / F-F2-XXXXXX) </strong> </span>');
                $('.val1tip').tooltipster('content', tip);
                $('.val1tip').tooltipster('show');
                $('#bar_macconkey').val('');     
                $('#bar_macconkey').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#bar_macconkey').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#bar_macconkey').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_macconkey').css({'background-color' : '#FFFFFF'});
                            $('#bar_macconkey').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "nhmrc_macconkey_out/valid_bs?id1="+data1+"&id2=1",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length == 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the mac OUT module or not registered in the mac IN module !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#bar_macconkey').val('');     
                        $('#bar_macconkey').focus();
                        $('#bar_macconkey').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_macconkey').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#bar_macconkey').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#bar_macconkey').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });

        $('#bar_macsweep1').on("change", function() {
            data1 = $('#bar_macsweep1').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-S2-", "F-S2-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-S2-XXXXXX / F-S2-XXXXXX) </strong> </span>');
                $('.val2tip').tooltipster('content', tip);
                $('.val2tip').tooltipster('show');
                $('#bar_macsweep1').val('');     
                $('#bar_macsweep1').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#bar_macsweep1').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#bar_macsweep1').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_macsweep1').css({'background-color' : '#FFFFFF'});
                            $('#bar_macsweep1').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "nhmrc_macconkey_out/valid_bs?id1="+data1+"&id2=2",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#bar_macsweep1').val('');     
                        $('#bar_macsweep1').focus();
                        $('#bar_macsweep1').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_macsweep1').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#bar_macsweep1').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#bar_macsweep1').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });        

        $('#bar_macsweep2').on("change", function() {
            data1 = $('#bar_macsweep2').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-S2-", "F-S2-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-S2-XXXXXX / F-S2-XXXXXX) </strong> </span>');
                $('.val3tip').tooltipster('content', tip);
                $('.val3tip').tooltipster('show');
                $('#bar_macsweep2').val('');     
                $('#bar_macsweep2').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#bar_macsweep2').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#bar_macsweep2').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_macsweep2').css({'background-color' : '#FFFFFF'});
                            $('#bar_macsweep2').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "nhmrc_macconkey_out/valid_bs?id1="+data1+"&id2=3",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val3tip').tooltipster('content', tip);
                        $('.val3tip').tooltipster('show');
                        $('#bar_macsweep2').val('');     
                        $('#bar_macsweep2').focus();
                        $('#bar_macsweep2').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_macsweep2').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#bar_macsweep2').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#bar_macsweep2').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
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
            ajax: {"url": "nhmrc_macconkey_out/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "bar_macconkey"},
                {"data": "date_process"},
                {"data": "time_process"},
                {"data": "initial"},
                {"data": "bar_macsweep1"},
                {"data": "cryobox1"},
                {"data": "bar_macsweep2"},
                {"data": "cryobox2"},
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
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> NHMRC - New Macconkey out<span id="my-another-cool-loader"></span>');
            $('#bar_macconkey').attr('readonly', false);
            $('#bar_macconkey').val('');
            // $("#date_receipt").datepicker("setDate",'now');
            // $('#time_receipt').timepicker('setTime', new Date());
            $('#id_person').val('');
            $('#bar_macsweep1').val('');
            $('#cryobox1').val('');
            $('#bar_macsweep2').val('');
            $('#cryobox2').val('');
            $('#id_location1').val('');
            $('#id_freez1').val('');
            $('#id_shelf1').val('');
            $('#id_rack1').val('');
            $('#id_draw1').val('');            
            $('#id_location2').val('');
            $('#id_freez2').val('');
            $('#id_shelf2').val('');
            $('#id_rack2').val('');
            $('#id_draw2').val('');            

            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> NHMRC - Update Macconkey out<span id="my-another-cool-loader"></span>');
            $('#bar_macconkey').attr('readonly', true);
            $('#bar_macconkey').val(data.bar_macconkey);
            $('#date_process').val(data.date_process);
            $('#time_process').val(data.time_process);
            // $('#time_receipt').clockpicker({'default': data.time_receipt});
            // $("#date_receipt").datepicker("setDate",'now');
            // $('#time_receipt').timepicker('setTime', new Date());
            $('#id_person').val(data.id_person).trigger('change');
            $('#bar_macsweep1').val(data.bar_macsweep1);
            $('#cryobox1').val(data.cryobox1);
            $('#bar_macsweep2').val(data.bar_macsweep2);
            $('#cryobox2').val(data.cryobox2);
            $('#comments').val(data.comments);
            load_freez(data.id_location_80_1);
            load_freez2(data.id_location_80_2);
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
        });   

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