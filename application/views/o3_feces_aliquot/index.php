<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Objective 3 - Feces Aliquot</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Feces Aliquot </button>";
        }
?>

        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class=    fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('o3_feces_aliquot/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>Barcode sample</th>
                    <th>Date process</th>
                    <!-- <th>Time process</th> -->
                    <th>Lab tech</th>
                    <th>Aliquot-1</th>
                    <th>Cryobox-1</th>
                    <th>Aliquot-2</th>
                    <th>Cryobox-2</th>
                    <th>Aliquot-3</th>
                    <th>Cryobox-3</th>
                    <th>Aliquot-zymo</th>
                    <th>Cryobox-zymo</th>
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
</style>

    <!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">O3 - Feces Aliquot Sample</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('o3_feces_aliquot/save') ?> method="post" class="form-horizontal">
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
                            <label for="time_process" class="col-sm-4 control-label">Time Process</label>
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
                            <label for="cons_stool" class="col-sm-4 control-label">Consistency of Stool</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="cons_stool" name="cons_stool">
                                <option value="">-- Select Consistency of Stool --</option>
                                <?php
                                echo "<option value='Normal stool (formed/soft/semi-solid/moist)' >Normal stool (formed/soft/semi-solid/moist)</option>
                                <option value='Diarrheal stool (unformed/watery)' >Diarrheal stool (unformed/watery)</option>
                                <option value='Constipated stool (formed/hard/dry)' >Constipated stool (formed/hard/dry)</option>";
                                ?>
                                </select>
                            </div>
                        </div>	


                        <div class="form-group">
                            <label for="color_stool" class="col-sm-4 control-label">Color of Stool</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="color_stool" name="color_stool">
                                <option value="">-- Select Color of Stool --</option>
                                <?php
                                echo "<option value='Yellow' >Yellow</option>
                                <option value='Brown' >Brown</option>
                                <option value='Black' >Black</option>
                                <option value='Green' >Green</option>
                                <option value='Red' >Red</option>
                                <option value='White' >White</option>
                                <option value='Other' >Other</option>";
                                ?>
                                </select>
                            </div>
                        </div>	

                        <div class="form-group">
                            <label for="abnormal" class="col-sm-4 control-label">Abnormal</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="abnormal" name="abnormal">
                                <option value="">-- Select Abnormal --</option>
                                <?php
                                echo "<option value='Normal' >Normal</option>
                                <option value='Mucus' >Mucus</option>
                                <option value='Blood' >Blood</option>
                                <option value='Worms' >Worms</option>
                                <option value='Other' >Other</option>";
                                ?>
                                </select>
                            </div>
                        </div>	

                        <div class="form-group">
                            <label for="ab_other" class="col-sm-4 control-label">Abnormal Comments</label>
                            <div class="col-sm-8">
                                <input id="ab_other" name="ab_other" type="text" class="form-control" placeholder="Abnormal Comments(if Other)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aliquot1" class="col-sm-4 control-label">Barcode Aliquot-1</label>
                            <div class="col-sm-8">
                                <input id="aliquot1" name="aliquot1" type="text" class="form-control" placeholder="Barcode Aliquot-1">
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume1" class="col-sm-4 control-label">Volume Aliquot-1</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="volume1" name="volume1">
                                        <option value="">-- Select Volume Aliquot-1 --</option>
                                        <?php
                                        echo "<option value='2g' >2g</option>
                                        <option value='<2g' ><2g</option>";
                                      ?>
                                    </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cryobox1" class="col-sm-4 control-label">Cryobox-1</label>
                            <div class="col-sm-8">
                                <input id="cryobox1" name="cryobox1" placeholder="Cryobox-1" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aliquot2" class="col-sm-4 control-label">Barcode Aliquot-2</label>
                            <div class="col-sm-8">
                                <input id="aliquot2" name="aliquot2" placeholder="Barcode Aliquot-2" class="form-control" >
                                <div class="val3tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume2" class="col-sm-4 control-label">Volume Aliquot-2</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="volume2" name="volume2" >
                                    <option value="">-- Select Volume Aliquot-2 --</option>
                                    <?php
                                        echo "<option value='2g' >2g</option>
                                        <option value='<2g' ><2g</option>";
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
                            <label for="aliquot3" class="col-sm-4 control-label">Barcode Aliquot-3</label>
                            <div class="col-sm-8">
                                <input id="aliquot3" name="aliquot3" placeholder="Barcode Aliquot-3" class="form-control">
                                <div class="val4tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume3" class="col-sm-4 control-label">Volume Aliquot-3</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="volume3" name="volume3">
                                    <option value="">-- Select Volume Aliquot-3 --</option>
                                    <?php
                                    echo "<option value='2g' >2g</option>
                                    <option value='<2g' ><2g</option>";
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cryobox3" class="col-sm-4 control-label">Cryobox-3</label>
                            <div class="col-sm-8">
                                <input id="cryobox3" name="cryobox3" placeholder="Cryobox-3" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aliquot_zymo" class="col-sm-4 control-label">Barcode Aliquot-Zymo</label>
                            <div class="col-sm-8">
                                <input id="aliquot_zymo" name="aliquot_zymo" placeholder="Barcode Aliquot-Zymo" class="form-control">
                                <div class="val5tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume_zymo" class="col-sm-4 control-label">Volume Aliquot-Zymo</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="volume_zymo" name="volume_zymo">
                                    <option value="">-- Select Volume Aliquot-Zymo --</option>
                                    <?php
                                    echo "<option value='0.2g' >0.2g</option>
                                    <option value='<0.2g' ><0.2g</option>";
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="batch_zymo" class="col-sm-4 control-label">Zymo Batch Number</label>
                            <div class="col-sm-8">
                                <input id="batch_zymo" name="batch_zymo" placeholder="Zymo Batch Number" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cryobox_zymo" class="col-sm-4 control-label">Cryobox-Zymo</label>
                            <div class="col-sm-8">
                                <input id="cryobox_zymo" name="cryobox_zymo" placeholder="Cryobox-Zymo" class="form-control">
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
                                <textarea id="notes" name="notes" class="form-control" placeholder="Notes"> </textarea>
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

        $('#abnormal').change(function(){
            if($('#abnormal').val() == "Other") {
                $('#ab_other').attr('readonly', false);
            }
            else {
                $('#ab_other').val('');
                $('#ab_other').attr('readonly', true);
            }
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_sample').focus();
        });        

        $('.val1tip, .val2tip, .val3tip, .val4tip, .val5tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip, .val2tip, .val3tip, .val4tip, .val5tip').tooltipster('hide');   
        });

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip,.val4tip,.val5tip').tooltipster('hide');   
            }, 3000);                            
        });

        // $('.clockpicker').clockpicker({
        // placement: 'bottom', // clock popover placement
        // align: 'left',       // popover arrow align
        // donetext: 'Done',     // done button text
        // autoclose: true,    // auto close when minute is selected
        // vibrate: true        // vibrate the device when dragging clock hand
        // });                

                
        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-F0-", "F-F0-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-F0-XXXXXX / F-F0-XXXXXX) </strong> </span>');
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
                url: "o3_feces_aliquot/valid_bs?id1="+data1+"&id2=1",
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

        $('#aliquot1').on("change", function() {
            data1 = $('#aliquot1').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-K1-", "F-K1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-K1-XXXXXX / F-K1-XXXXXX) </strong> </span>');
                $('.val2tip').tooltipster('content', tip);
                $('.val2tip').tooltipster('show');
                $('#aliquot1').val('');     
                $('#aliquot1').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#aliquot1').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#aliquot1').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#aliquot1').css({'background-color' : '#FFFFFF'});
                            $('#aliquot1').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_feces_aliquot/valid_bs?id1="+data1+"&id2=2",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#aliquot1').val('');     
                        $('#aliquot1').focus();
                        $('#aliquot1').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#aliquot1').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#aliquot1').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#aliquot1').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });

        $('#aliquot2').on("change", function() {
            data1 = $('#aliquot2').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-K2-", "F-K2-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-K2-XXXXXX / F-K2-XXXXXX) </strong> </span>');
                $('.val3tip').tooltipster('content', tip);
                $('.val3tip').tooltipster('show');
                $('#aliquot2').val('');     
                $('#aliquot2').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#aliquot2').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#aliquot2').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#aliquot2').css({'background-color' : '#FFFFFF'});
                            $('#aliquot2').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_feces_aliquot/valid_bs?id1="+data1+"&id2=3",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val3tip').tooltipster('content', tip);
                        $('.val3tip').tooltipster('show');
                        $('#aliquot2').val('');     
                        $('#aliquot2').focus();
                        $('#aliquot2').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#aliquot2').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#aliquot2').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#aliquot2').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });
        
        $('#aliquot3').on("change", function() {
            data1 = $('#aliquot3').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-K3-", "F-K3-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-K3-XXXXXX / F-K3-XXXXXX) </strong> </span>');
                $('.val4tip').tooltipster('content', tip);
                $('.val4tip').tooltipster('show');
                $('#aliquot3').val('');     
                $('#aliquot3').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#aliquot3').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#aliquot3').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#aliquot3').css({'background-color' : '#FFFFFF'});
                            $('#aliquot3').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_feces_aliquot/valid_bs?id1="+data1+"&id2=4",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val4tip').tooltipster('content', tip);
                        $('.val4tip').tooltipster('show');
                        $('#aliquot3').val('');     
                        $('#aliquot3').focus();
                        $('#aliquot3').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#aliquot3').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#aliquot3').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#aliquot3').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });

        $('#aliquot_zymo').on("change", function() {
            data1 = $('#aliquot_zymo').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-K4-", "F-K4-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-K4-XXXXXX / F-K4-XXXXXX) </strong> </span>');
                $('.val5tip').tooltipster('content', tip);
                $('.val5tip').tooltipster('show');
                $('#aliquot_zymo').val('');     
                $('#aliquot_zymo').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#aliquot_zymo').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#aliquot_zymo').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#aliquot_zymo').css({'background-color' : '#FFFFFF'});
                            $('#aliquot_zymo').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_feces_aliquot/valid_bs?id1="+data1+"&id2=5",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val5tip').tooltipster('content', tip);
                        $('.val5tip').tooltipster('show');
                        $('#aliquot_zymo').val('');     
                        $('#aliquot_zymo').focus();
                        $('#aliquot_zymo').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#aliquot_zymo').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#aliquot_zymo').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#aliquot_zymo').css({'background-color' : '#FFFFFF'});
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
            ajax: {"url": "o3_feces_aliquot/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "date_process"},
                // {"data": "time_process"},
                {"data": "initial"},
                {"data": "aliquot1"},
                {"data": "cryobox1"},
                {"data": "aliquot2"},
                {"data": "cryobox2"},
                {"data": "aliquot3"},
                {"data": "cryobox3"},
                {"data": "aliquot_zymo"},
                {"data": "cryobox_zymo"},
                {"data": "comments"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O3 - New Feces Aliquot Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#ab_other').attr('readonly', true);
            $('#barcode_sample').val('');
            // $('#date_process').val('');
            $('#id_person').val('').trigger('change');
            $('#cons_stool').val('');
            $('#color_stool').val('');
            $('#abnormal').val('');
            $('#ab_other').val('');
            $('#aliquot1').val('');
            $('#volume1').val('').trigger('change');
            $('#cryobox1').val('');
            $('#aliquot2').val('');
            $('#volume2').val('').trigger('change');
            $('#cryobox2').val('');
            $('#aliquot3').val('');
            $('#volume3').val('').trigger('change');
            $('#cryobox3').val('');
            $('#aliquot_zymo').val('');
            $('#volume_zymo').val('');
            $('#batch_zymo').val('');
            $('#cryobox_zymo').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Feces Aliquot Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#ab_other').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#date_process').val(data.date_process);
            $('#time_process').val(data.time_process);
            $('#id_person').val(data.id_person).trigger('change');
            $('#cons_stool').val(data.cons_stool);
            $('#color_stool').val(data.color_stool);
            $('#abnormal').val(data.abnormal).trigger('change');
            $('#ab_other').val(data.ab_other);
            $('#aliquot1').val(data.aliquot1);
            $('#volume1').val(data.volume1);
            $('#cryobox1').val(data.cryobox1);
            $('#aliquot2').val(data.aliquot2);
            $('#volume2').val(data.volume2);
            $('#cryobox2').val(data.cryobox2);
            $('#aliquot3').val(data.aliquot3);
            $('#volume3').val(data.volume3);
            $('#cryobox3').val(data.cryobox3);
            $('#aliquot_zymo').val(data.aliquot_zymo);
            $('#volume_zymo').val(data.volume_zymo);
            $('#batch_zymo').val(data.batch_zymo);
            $('#cryobox_zymo').val(data.cryobox_zymo);
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