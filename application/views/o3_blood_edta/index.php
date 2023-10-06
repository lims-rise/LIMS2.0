<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Objective 3 - Blood EDTA Aliquot</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'>
        <button class='btn btn-primary' id='addtombol'><i class="fa fa-wpforms" aria-hidden="true"></i> New EDTA Aliquot </button>
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('o3_blood_edta/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>Barcode sample</th>
                    <th>Date process</th>
                    <th>Lab tech</th>
                    <th>Hemolysis</th>
                    <th>Barcode WB</th>
                    <!-- <th>Aliquot WB</th> -->
                    <!-- <th>Cryobox WB</th> -->
                    <th>Bar Aliquot 1</th>
                    <!-- <th>Aliquot Vol-1</th> -->
                    <!-- <th>Cryobox 1</th> -->
                    <th>Bar Aliquot 2</th>
                    <!-- <th>Aliquot Vol-2</th> -->
                    <!-- <th>Cryobox 2</th> -->
                    <th>Bar Aliquot 3</th>
                    <!-- <th>Aliquot Vol-3</th> -->
                    <!-- <th>Cryobox 3</th> -->
                    <th>Packed Cells</th>
                    <!-- <th>Cryobox PC</th> -->
                    <!-- <th>Comments</th> -->
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
                    <h4 class="modal-title" id="modal-title">O3 - Blood EDTA Aliquot Sample</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('o3_blood_edta/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control">
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
                            <label for="id_person" class="col-sm-4 control-label">Lab Tech</label>
                            <div class="col-sm-8">
                            <select id='id_person' name="id_person" class="form-control">
                                <option value="">-- Select lab tech --</option>
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
                            <!-- <input id="description" name="description" type="text" class="form-control" placeholder="Item Description" required> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_type" class="col-sm-4 control-label">Hemolysis</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="hemolysis" name="hemolysis" required>
                                <option value="">-- Select Hemolysis --</option>
                                <?php
                                echo "<option value='Yes (Reddish Layer)' >Yes (Reddish Layer)</option>
                                    <option value='No (Yellow Layer)' >No (Yellow Layer)</option>
                                    <option value='Partially' >Partially</option>";
                                ?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_wb" class="col-sm-4 control-label">Barcode Whole Blood</label>
                            <div class="col-sm-8">
                                <input id="barcode_wb" name="barcode_wb" type="text" class="form-control" placeholder="Barcode Whole Blood" required>
                                <div class="val2tip"></div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="vol_aliquotwb" class="col-sm-4 control-label">Volume Aliquot-WB</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="vol_aliquotwb" name="vol_aliquotwb" required>
                                        <option value="">-- Select Volume Aliquot WB --</option>
                                        <?php
                                        echo "<option value='200uL' >200uL</option>
                                        <option value='<200uL' ><200uL</option>";
                                      ?>
                                    </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cryoboxwb" class="col-sm-4 control-label">Cryobox-WB</label>
                            <div class="col-sm-8">
                                <input id="cryoboxwb" name="cryoboxwb" type="text" class="form-control" placeholder="Cryobox-WB" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_p1a" class="col-sm-4 control-label">Barcode Plasma-1</label>
                            <div class="col-sm-8">
                                <input id="barcode_p1a" name="barcode_p1a" placeholder="Barcode Plasma-1" class="form-control" required>
                                <div class="val3tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vol_aliquot1" class="col-sm-4 control-label">Volume Aliquot-1</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="vol_aliquot1" name="vol_aliquot1" required>
                                    <option value="">-- Select Volume Aliquot-1 --</option>
                                    <?php
                                    echo "<option value='500uL'>500uL</option>
                                        <option value='<500uL'><500uL</option>";
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="col-sm-1">
                                <a type="button" id="resv1" class="myeditlink" href="javascript:void(0)"><i class="fa fa-refresh"></i></a>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label for="cryobox1" class="col-sm-4 control-label">Cryobox-1</label>
                            <div class="col-sm-8">
                                <input id="cryobox1" name="cryobox1" placeholder="Cryobox-1" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_p2a" class="col-sm-4 control-label">Barcode Plasma-2</label>
                            <div class="col-sm-8">
                                <input id="barcode_p2a" name="barcode_p2a" placeholder="Barcode Plasma-2" class="form-control" >
                                <div class="val4tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vol_aliquot2" class="col-sm-4 control-label">Volume Aliquot-2</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="vol_aliquot2" name="vol_aliquot2" >
                                    <option value="">-- Select Volume Aliquot-2 --</option>
                                    <?php
                                    echo "<option value='500uL' >500uL</option>
                                        <option value='<500uL' ><500uL</option>";
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="col-sm-1">
                                <a type="button" id="resv2" class="myeditlink" href="javascript:void(0)"><i class="fa fa-refresh"></i></a>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label for="cryobox2" class="col-sm-4 control-label">Cryobox-2</label>
                            <div class="col-sm-8">
                                <input id="cryobox2" name="cryobox2" placeholder="Cryobox-2" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_p3a" class="col-sm-4 control-label">Barcode Plasma-3</label>
                            <div class="col-sm-8">
                                <input id="barcode_p3a" name="barcode_p3a" placeholder="Barcode Plasma-3" class="form-control">
                                <div class="val5tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vol_aliquot3" class="col-sm-4 control-label">Volume Aliquot-3</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="vol_aliquot3" name="vol_aliquot3">
                                    <option value="">-- Select Volume Aliquot-3 --</option>
                                    <?php
                                    echo "<option value='500uL' >500uL</option>
                                        <option value='<500uL' ><500uL</option>";
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="col-sm-1">
                                <a type="button" id="resv3" class="myeditlink" href="javascript:void(0)"><i class="fa fa-refresh"></i></a>
                            </div> -->
                        </div>
                        <div class="form-group">
                            <label for="cryobox3" class="col-sm-4 control-label">Cryobox-3</label>
                            <div class="col-sm-8">
                                <input id="cryobox3" name="cryobox3" placeholder="Cryobox-3" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="packed_cells" class="col-sm-4 control-label">Packed Cells</label>
                            <div class="col-sm-8">
                                <input id="packed_cells" name="packed_cells" placeholder="Packed Cells" class="form-control" required>
                                <div class="val6tip"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cryobox_pc" class="col-sm-4 control-label">Cryobox-PC</label>
                            <div class="col-sm-8">
                                <input id="cryobox_pc" name="cryobox_pc" placeholder="Cryobox-PC" class="form-control" required>
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

        $('.val1tip, .val2tip, .val3tip, .val4tip, .val5tip, .val6tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
        });


        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip,.val2tip,.val3tip,.val4tip,.val5tip,.val6tip').tooltipster('hide');   
        });

        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-B0-", "F-B0-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-B0-XXXXXX / F-B0-XXXXXX) </strong> </span>');
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
                url: "o3_blood_edta/valid_bs?id1="+data1+"&id2=1",
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

        $('#barcode_wb').on("change", function() {
            data1 = $('#barcode_wb').val();
            ckbar = data1.substring(0,5);
            ckarray = ["N-H1-", "F-H1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N-H1-XXXXXX / F-H1-XXXXXX) </strong> </span>');
                $('.val2tip').tooltipster('content', tip);
                $('.val2tip').tooltipster('show');
                $('#barcode_wb').val('');     
                $('#barcode_wb').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#barcode_wb').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#barcode_wb').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_wb').css({'background-color' : '#FFFFFF'});
                            $('#barcode_wb').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_blood_edta/valid_bs?id1="+data1+"&id2=2",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#barcode_wb').focus();
                        $('#barcode_wb').val('');     
                        $('#barcode_wb').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_wb').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_wb').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_wb').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        }
        });

        $('#barcode_p1a').on("change", function() {
            data1 = $('#barcode_p1a').val();
            ckbar = data1.substring(0,5);
            ckarray = ["N-B1-", "F-B1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N-B1-XXXXXX / F-B1-XXXXXX) </strong> </span>');
                $('.val3tip').tooltipster('content', tip);
                $('.val3tip').tooltipster('show');
                $('#barcode_p1a').val('');     
                $('#barcode_p1a').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#barcode_p1a').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#barcode_p1a').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_p1a').css({'background-color' : '#FFFFFF'});
                            $('#barcode_p1a').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_blood_edta/valid_bs?id1="+data1+"&id2=3",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val3tip').tooltipster('content', tip);
                        $('.val3tip').tooltipster('show');
                        $('#barcode_p1a').focus();
                        $('#barcode_p1a').val('');     
                        $('#barcode_p1a').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_p1a').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_p1a').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_p1a').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });

        $('#barcode_p2a').on("change", function() {
            data1 = $('#barcode_p2a').val();
            ckbar = data1.substring(0,5);
            ckarray = ["N-B2-", "F-B2-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N-B2-XXXXXX / F-B2-XXXXXX) </strong> </span>');
                $('.val4tip').tooltipster('content', tip);
                $('.val4tip').tooltipster('show');
                $('#barcode_p2a').val('');     
                $('#barcode_p2a').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#barcode_p2a').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#barcode_p2a').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_p2a').css({'background-color' : '#FFFFFF'});
                            $('#barcode_p2a').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_blood_edta/valid_bs?id1="+data1+"&id2=4",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val4tip').tooltipster('content', tip);
                        $('.val4tip').tooltipster('show');
                        $('#barcode_p2a').focus();
                        $('#barcode_p2a').val('');     
                        $('#barcode_p2a').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_p2a').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_p2a').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_p2a').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });

        $('#barcode_p3a').on("change", function() {
            data1 = $('#barcode_p3a').val();
            ckbar = data1.substring(0,5);
            ckarray = ["N-B3-", "F-B3-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N-B3-XXXXXX / F-B3-XXXXXX) </strong> </span>');
                $('.val5tip').tooltipster('content', tip);
                $('.val5tip').tooltipster('show');
                $('#barcode_p3a').val('');     
                $('#barcode_p3a').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#barcode_p3a').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#barcode_p3a').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_p3a').css({'background-color' : '#FFFFFF'});
                            $('#barcode_p3a').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_blood_edta/valid_bs?id1="+data1+"&id2=5",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val5tip').tooltipster('content', tip);
                        $('.val5tip').tooltipster('show');
                        $('#barcode_p3a').focus();
                        $('#barcode_p3a').val('');     
                        $('#barcode_p3a').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_p3a').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_p3a').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_p3a').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });

        $('#packed_cells').on("change", function() {
            data1 = $('#packed_cells').val();
            ckbar = data1.substring(0,5);
            ckarray = ["N-C1-", "F-C1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N-C1-XXXXXX / F-C1-XXXXXX) </strong> </span>');
                $('.val6tip').tooltipster('content', tip);
                $('.val6tip').tooltipster('show');
                $('#packed_cells').val('');     
                $('#packed_cells').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#packed_cells').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#packed_cells').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#packed_cells').css({'background-color' : '#FFFFFF'});
                            $('#packed_cells').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_blood_edta/valid_bs?id1="+data1+"&id2=6",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val6tip').tooltipster('content', tip);
                        $('.val6tip').tooltipster('show');
                        $('#packed_cells').focus();
                        $('#packed_cells').val('');     
                        $('#packed_cells').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#packed_cells').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#packed_cells').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#packed_cells').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip,.val4tip,.val5tip,.val6tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip,.val4tip,.val5tip,.val6tip').tooltipster('hide');   
            }, 3000);                            
        });


        $('#compose-modal').on('shown.bs.modal', function () {
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
            ajax: {"url": "o3_blood_edta/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "date_process"},
                {"data": "initial"},
                {"data": "hemolysis"},
                {"data": "barcode_wb"},
                // {"data": "vol_aliquotwb"},
                // {"data": "cryoboxwb"},
                {"data": "barcode_p1a"},
                // {"data": "vol_aliquot1"},
                // {"data": "cryobox1"},
                {"data": "barcode_p2a"},
                // {"data": "vol_aliquot2"},
                // {"data": "cryobox2"},
                {"data": "barcode_p3a"},
                // {"data": "vol_aliquot3"},
                // {"data": "cryobox3"},
                {"data": "packed_cells"},
                // {"data": "cryobox_pc"},
                // {"data": "comments"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[1, 'desc']],
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O3 - New Blood EDTA Aliquot Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            // $('#date_process').val('');
            $('#id_person').val('').trigger('change');
            $('#hemolysis').val('').trigger('change');
            $('#barcode_wb').val('');
            $('#vol_aliquotwb').val('').trigger('change');
            $('#cryoboxwb').val('');
            $('#barcode_p1a').val('');
            $('#vol_aliquot1').val('').trigger('change');
            $('#cryobox1').val('');
            $('#barcode_p2a').val('');
            $('#vol_aliquot2').val('').trigger('change');
            $('#cryobox2').val('');
            $('#barcode_p3a').val('');
            $('#vol_aliquot3').val('').trigger('change');
            $('#cryobox3').val('');
            $('#packed_cells').val('');
            $('#cryobox_pc').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Blood EDTA Aliquot Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#date_process').val(data.date_process);
            $('#id_person').val(data.id_person).trigger('change');
            $('#hemolysis').val(data.hemolysis);
            $('#barcode_wb').val(data.barcode_wb);
            $('#vol_aliquotwb').val(data.vol_aliquotwb);
            $('#cryoboxwb').val(data.cryoboxwb);
            $('#barcode_p1a').val(data.barcode_p1a);
            $('#vol_aliquot1').val(data.vol_aliquot1);
            $('#cryobox1').val(data.cryobox1);
            $('#barcode_p2a').val(data.barcode_p2a);
            $('#vol_aliquot2').val(data.vol_aliquot2);
            $('#cryobox2').val(data.cryobox2);
            $('#barcode_p3a').val(data.barcode_p3a);
            $('#vol_aliquot3').val(data.vol_aliquot3);
            $('#cryobox3').val(data.cryobox3);
            $('#packed_cells').val(data.packed_cells);
            $('#cryobox_pc').val(data.cryobox_pc);
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