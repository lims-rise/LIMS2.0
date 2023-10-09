<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header"> <h3 class="box-title">Objective 2B - Bootsocks Stomacher</h3> </div>        
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Bootsocks Sample </button>";
        }
?>
                            
                            <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
                            <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
                            <?php echo anchor(site_url('o2b_bootsocks_stomacher/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                        </div>
                        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th width="30px">No</th> -->
                                    <th>Barcode Sample</th>
                                    <th>Date Conducted</th>
                                    <th>Elution Number</th>
                                    <th>Barcode Bootsock</th>
                                    <th>Elution</th>
                                    <th>Barcode Falcon Tube</th>
                                    <th>Volume recovered after stomacher (mL) </th>
                                    <th width="120px">Action</th>
                                </tr>
                            </thead>               
                        </table>
                    </div> 
                </div>
            </div> 
        </div> 

        <div class="row">
        <div class="col-xs-12">
            <div class="box box-black box-solid">
                <div class="box-header"> <h3 class="box-title">Sample - Endetec</h3> </div>                     
                <div class="box-body">
                    <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtomboldet'><i class='fa fa-wpforms' aria-hidden='true'></i> New Sample Endetec </button>";
        }
?>
                        
                        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
                        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
                        <?php //echo anchor(site_url('o2b_bootsocks_stomacher/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                    </div>
                    <table class="table table-bordered table-striped tbody" id="mytable_det1" style="width:100%">
                        <thead>
                            <tr>
                                <th>Barcode Endetec</th>
                                <th>Barcode Falcon1</th>
                                <th>Volume Falcon1</th>
                                <th>Barcode Falcon2</th>
                                <th>Volume Falcon2</th>
                                <th>Dilution factor</th>
                                <th>Time Inc. Started</th>
                                <th>Comments</th>
                                <th width="120px">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div> 
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-black box-solid">
                <div class="box-header"> <h3 class="box-title">Sample - IDEXX</h3> </div>                     
                <div class="box-body">
                    <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtomboldet2'><i class='fa fa-wpforms' aria-hidden='true'></i> New Sample IDEXX </button>";
        }
?>
                        
                        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
                        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
                        <?php //echo anchor(site_url('o2b_bootsocks_stomacher/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                    </div>
                    <table class="table table-bordered table-striped tbody" id="mytable_det2" style="width:100%">
                        <thead>
                            <tr>
                                <th>Barcode Colilert</th>
                                <th>Barcode Falcon1</th>
                                <th>Volume Falcon1 (mL)</th>
                                <th>Barcode Falcon2</th>
                                <th>Volume Falcon2 (mL)</th>
                                <th>Dilution</th>
                                <th>Time Inc. Started</th>
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
</div>

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
                    <h4 class="modal-title" id="modal-title">O2B - Bootsocks Stomacher</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('o2b_bootsocks_stomacher/save') ?> method="post" class="form-horizontal">
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
                            <label for="date_conduct" class="col-sm-4 control-label">Date conducted</label>
                            <div class="col-sm-8">
                                <input id="date_conduct" name="date_conduct" type="date" class="form-control" placeholder="Date conducted" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="elution_no" class="col-sm-4 control-label">Elution number</label>
                            <div class="col-sm-8">
                            <select id='elution_no' name="elution_no" class="form-control">
                                <option>-- Select answer --</option>
                                <option value="Micro1">Micro1</option>
                                <option value="Micro2">Micro2</option>
                                <option value="Moisture1">Moisture1</option>
                                <option value="Moisture2">Moisture2</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_bootsock" class="col-sm-4 control-label">Barcode bootsock</label>
                            <div class="col-sm-8">
                                <input id="barcode_bootsock" name="barcode_bootsock" type="text" class="form-control" placeholder="Barcode bootsock" required>
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="elution" class="col-sm-4 control-label">Elution</label>
                            <div class="col-sm-8">
                            <select id='elution' name="elution" class="form-control">
                                <option>-- Select answer --</option>
                                <option value="50">50</option>
                                <option value="Other">Other</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="elu_comments" class="col-sm-4 control-label">Elution (other)</label>
                            <div class="col-sm-8">
                                <input id="elu_comments" name="elu_comments" type="text" class="form-control" placeholder="Elution (other)" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_falcon" class="col-sm-4 control-label">Barcode falcon</label>
                            <div class="col-sm-8">
                                <input id="barcode_falcon" name="barcode_falcon" type="text" class="form-control" placeholder="Barcode falcon" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume_stomacher" class="col-sm-4 control-label">Volume recovered after stomacher (mL)</label>
                            <div class="col-sm-8">
                                <input id="volume_stomacher" name="volume_stomacher" type="number" class="form-control" placeholder="Volume recovered after stomacher (mL)">
                                <!-- <div class="val1tip"></div> -->
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

    <!-- MODAL FORM -->
    <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="detail-title1">Sample - Endetec</h4>
                </div>
                <form id="formSample2"  action= <?php echo site_url('o2b_bootsocks_stomacher/save_detail1') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode_det1" name="mode_det1" type="hidden" class="form-control input-sm">
                        <!-- <input id="barcode_bootsock1" name="barcode_bootsock1" type="hidden" class="form-control input-sm"> -->

                        <div class="form-group">
                            <label for="barcode_bootsock1" class="col-sm-4 control-label">Barcode bootsock</label>
                            <div class="col-sm-8">
                                <input id="barcode_bootsock1" name="barcode_bootsock1" type="text" class="form-control" placeholder="Barcode bootsock" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_endetec" class="col-sm-4 control-label">Barcode endetec</label>
                            <div class="col-sm-8">
                                <input id="barcode_endetec" name="barcode_endetec" type="text" class="form-control" placeholder="Barcode endetec" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_falcon_en1" class="col-sm-4 control-label">Barcode falcon1</label>
                            <div class="col-sm-8">
                                <input id="barcode_falcon_en1" name="barcode_falcon_en1" type="text" class="form-control" placeholder="Barcode falcon1" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume_falcon_en1" class="col-sm-4 control-label">Volume falcon1(mL)</label>
                            <div class="col-sm-8">
                                <input id="volume_falcon_en1" name="volume_falcon_en1" type="number" class="form-control" placeholder="Volume falcon1(mL)">
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_falcon_en2" class="col-sm-4 control-label">Barcode falcon2</label>
                            <div class="col-sm-8">
                                <input id="barcode_falcon_en2" name="barcode_falcon_en2" type="text" class="form-control" placeholder="Barcode falcon2" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume_falcon_en2" class="col-sm-4 control-label">Volume falcon2(mL)</label>
                            <div class="col-sm-8">
                                <input id="volume_falcon_en2" name="volume_falcon_en2" type="number" class="form-control" placeholder="Volume falcon2(mL)">
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dilution_en" class="col-sm-4 control-label">Dilution</label>
                            <div class="col-sm-8">
                                <input id="dilution_en" name="dilution_en" type="text" class="form-control" placeholder="Dilution" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_incubation_en" class="col-sm-4 control-label">Time incubation started</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                <input id="time_incubation_en" name="time_incubation_en" class="form-control" placeholder="Time incubation started" value="<?php 
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
                            <label for="comments_en" class="col-sm-4 control-label">Comments</label>
                            <div class="col-sm-8">
                                <textarea id="comments_en" name="comments_en" class="form-control" placeholder="Comments"> </textarea>
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


    <!-- MODAL FORM -->
    <div class="modal fade" id="detail-modal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="detail-title2">Sample - IDEXX</h4>
                </div>
                <form id="formSample2"  action= <?php echo site_url('o2b_bootsocks_stomacher/save_detail2') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode_det2" name="mode_det2" type="hidden" class="form-control input-sm">
                        <!-- <input id="idbc_det" name="idbc_det" type="hidden" class="form-control input-sm"> -->

                        <div class="form-group">
                            <label for="barcode_bootsock2" class="col-sm-4 control-label">Barcode bootsock</label>
                            <div class="col-sm-8">
                                <input id="barcode_bootsock2" name="barcode_bootsock2" type="text" class="form-control" placeholder="Barcode bootsock" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_colilert" class="col-sm-4 control-label">Barcode colilert</label>
                            <div class="col-sm-8">
                                <input id="barcode_colilert" name="barcode_colilert" type="text" class="form-control" placeholder="Barcode colilert" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_falcon_id1" class="col-sm-4 control-label">Barcode falcon1</label>
                            <div class="col-sm-8">
                                <input id="barcode_falcon_id1" name="barcode_falcon_id1" type="text" class="form-control" placeholder="Barcode falcon1" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume_falcon_id1" class="col-sm-4 control-label">Volume falcon1(mL)</label>
                            <div class="col-sm-8">
                                <input id="volume_falcon_id1" name="volume_falcon_id1" type="number" class="form-control" placeholder="Volume falcon1(mL)">
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_falcon_id2" class="col-sm-4 control-label">Barcode falcon2</label>
                            <div class="col-sm-8">
                                <input id="barcode_falcon_id2" name="barcode_falcon_id2" type="text" class="form-control" placeholder="Barcode falcon2" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume_falcon_id2" class="col-sm-4 control-label">Volume falcon2(mL)</label>
                            <div class="col-sm-8">
                                <input id="volume_falcon_id2" name="volume_falcon_id2" type="number" class="form-control" placeholder="Volume falcon2(mL)">
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dilution_id" class="col-sm-4 control-label">Dilution</label>
                            <div class="col-sm-8">
                                <input id="dilution_id" name="dilution_id" type="text" class="form-control" placeholder="Dilution" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_incubation_id" class="col-sm-4 control-label">Time incubation started</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                <input id="time_incubation_id" name="time_incubation_id" class="form-control" placeholder="Time incubation started" value="<?php 
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
                            <label for="comments_id" class="col-sm-4 control-label">Comments</label>
                            <div class="col-sm-8">
                                <textarea id="comments_id" name="comments_id" class="form-control" placeholder="Comments"> </textarea>
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

<!-- </div> -->

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table
    var table_det
    $(document).ready(function() {
        
        $('.clockpicker').clockpicker({
        placement: 'bottom', // clock popover placement
        align: 'left',       // popover arrow align
        donetext: 'Done',     // done button text
        autoclose: true,    // auto close when minute is selected
        vibrate: true        // vibrate the device when dragging clock hand
        });                



        $('#elu_comments').attr('readonly', true);
        $('#elution').on('change', function (){
            if ($('#elution').val() == 50 ) {
                $('#elu_comments').val('');
                $('#elu_comments').attr('readonly', true);
            }
            else if ($('#elution').val() == 'Other' ) {
                $('#elu_comments').val('');
                $('#elu_comments').attr('readonly', false);
            }
        });

        $('#volume_falcon_en1').on('keyup', function (){
            $n1 = $('#volume_falcon_en1').val() * 1;
            $n2 = $('#volume_falcon_en2').val() * 1;
            $('#dilution_en').val(($n1 + $n2) / 100);
        });
        $('#volume_falcon_en1').on('click', function (){
            $('#volume_falcon_en1').keyup();
        });
        $('#volume_falcon_en2').on('keyup', function (){
            $('#volume_falcon_en1').keyup();
        });
        $('#volume_falcon_en2').on('click', function (){
            $('#volume_falcon_en1').keyup();
        });

        $('#volume_falcon_id1').on('keyup', function (){
            $n1 = $('#volume_falcon_id1').val() * 1;
            $n2 = $('#volume_falcon_id2').val() * 1;
            $('#dilution_id').val(($n1 + $n2) / 100);
        });
        $('#volume_falcon_id1').on('click', function (){
            $('#volume_falcon_id1').keyup();
        });
        $('#volume_falcon_id2').on('keyup', function (){
            $('#volume_falcon_id1').keyup();
        });
        $('#volume_falcon_id2').on('click', function (){
            $('#volume_falcon_id1').keyup();
        });

        $('.val1tip, .val2tip').tooltipster({
                animation: 'swing',
                delay: 1,
                theme: 'tooltipster-default',
                autoClose: true,
                position: 'bottom',
            });


        $('#barcode_sample').click(function() {
            $('.val1tip, .val2tip').tooltipster('hide');   
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip, .val2tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        $("#detail-modal").on('hide.bs.modal', function(){
            $('.val1tip, .val2tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });


        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            // ckbar = data1.substring(0,5).toUpperCase();
            // ckarray = ["N-B0-", "F-B0-"];
            // ck = $.inArray(ckbar, ckarray);
            // if (ck == -1) {
            //     tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N-B0-XXXXXX / F-B0-XXXXXX) </strong> </span>');
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
                url: "o2b_bootsocks_stomacher/valid_bs?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                console.log(data);
                    // var barcode = '';
                    if (data.length > 0) {
                        // if (data.res == 1) {
                        //     tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> not found in the reception !</span>');
                        // }
                        // else 
                        // alert(data[0].res +" >> "+data[0].cnt);
                        if ((data[0].res == "4") && (data[0].cnt == "4")) {
                            tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already have 4 elution !</span>');
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
                        }
                    }
                    else {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> not bootsock sample or not found in the reception !</span>');
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
                    }
                }
            });
            // }
        });

        // $('#barcode_bootsock').on("change", function() {
        //     data1 = $('#barcode_bootsock').val();
        //     ckbar = data1.substring(0,5).toUpperCase();
        //     ckarray = ["N-S1-", "F-S1-"];
        //     // ckarray = [10, 11, 12];
        //     ck = $.inArray(ckbar, ckarray);
        //     if (ck == -1) {
        //         tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N-S1-XXXXXX / F-S1-XXXXXX) </strong> </span>');
        //         $('.val2tip').tooltipster('content', tip);
        //         $('.val2tip').tooltipster('show');
        //         $('#barcode_bootsock').val('');     
        //         $('#barcode_bootsock').css({'background-color' : '#FFE6E7'});
        //         setTimeout(function(){
        //             $('#barcode_bootsock').css({'background-color' : '#FFFFFF'});
        //             setTimeout(function(){
        //                 $('#barcode_bootsock').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#barcode_bootsock').css({'background-color' : '#FFFFFF'});
        //                     $('#barcode_bootsock').focus();
        //                 }, 300);                            
        //             }, 300);
        //         }, 300);
        //     }
        //     else {
        //     $.ajax({
        //         type: "GET",
        //         url: "o2b_bootsocks_stomacher/valid_boots?id1="+data1,
        //         // data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             console.log(data);
        //             // var barcode = '';
        //             if (data.length == 0) {
        //                 tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is not found in the bootsock before weight !</span>');
        //                 $('.val2tip').tooltipster('content', tip);
        //                 $('.val2tip').tooltipster('show');
        //                 $('#barcode_bootsock').focus();
        //                 $('#barcode_bootsock').val('');     
        //                 $('#barcode_bootsock').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#barcode_bootsock').css({'background-color' : '#FFFFFF'});
        //                     setTimeout(function(){
        //                         $('#barcode_bootsock').css({'background-color' : '#FFE6E7'});
        //                         setTimeout(function(){
        //                             $('#barcode_bootsock').css({'background-color' : '#FFFFFF'});
        //                         }, 300);                            
        //                     }, 300);
        //                 }, 300);
        //             }
        //             else {
        //                 if (data[0].A3 != "1") {
        //                     tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the bootsocks stomacher module !</span>');
        //                     $('.val2tip').tooltipster('content', tip);
        //                     $('.val2tip').tooltipster('show');
        //                     $('#barcode_bootsock').focus();
        //                     $('#barcode_bootsock').val('');     
        //                     $('#barcode_bootsock').css({'background-color' : '#FFE6E7'});
        //                     setTimeout(function(){
        //                         $('#barcode_bootsock').css({'background-color' : '#FFFFFF'});
        //                         setTimeout(function(){
        //                             $('#barcode_bootsock').css({'background-color' : '#FFE6E7'});
        //                             setTimeout(function(){
        //                                 $('#barcode_bootsock').css({'background-color' : '#FFFFFF'});
        //                             }, 300);                            
        //                         }, 300);
        //                     }, 300);
        //                 }
        //             }
        //         }
        //     });
        //     }
        // });        

        $("input").keypress(function(){
            $('.val1tip, .val2tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_sample').focus();
        });        
        
        $('#detail-modal').on('shown.bs.modal', function () {
            $('#barcode_endetec').focus();
        });        

        $('#detail-modal2').on('shown.bs.modal', function () {
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
            oLanguage: {
                sProcessing: "Please wait while retriving data from server..."
            },
            processing: true,
            serverSide: true,
            ajax: {"url": "o2b_bootsocks_stomacher/json", "type": "POST"},
            columns: [
                {"data": "barcode_sample"},
                {"data": "date_conduct"},
                {"data": "elution_no"},
                {"data": "barcode_bootsock"},
                {"data": "elution"},
                {"data": "barcode_falcon"},
                {"data": "volume_stomacher"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
            }
        });

        table_det1 = $("#mytable_det1").DataTable({
            oLanguage: {
                sProcessing: "Please wait while retriving data from server..."
            },
            // select: true;
            processing: true,
            serverSide: true,
            ajax: {"url": "o2b_bootsocks_stomacher/subjson", "type": "POST"},
            columns: [
                // {
                //     "data": "id_bc",
                //     "orderable": false
                // },
                // {"data": "barcode_sample"},
                {"data": "barcode_endetec"},
                {"data": "barcode_falcon1"},
                {"data": "volume_falcon1"},
                {"data": "barcode_falcon2"},
                {"data": "volume_falcon2"},
                {"data": "dilution"},
                {"data": "time_incubation"},
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
                
        table_det2 = $("#mytable_det2").DataTable({
            oLanguage: {
                sProcessing: "Please wait while retriving data from server..."
            },
            // select: true;
            processing: true,
            serverSide: true,
            ajax: {"url": "o2b_bootsocks_stomacher/subjson2", "type": "POST"},
            columns: [
                // {
                //     "data": "id_bc",
                //     "orderable": false
                // },
                // {"data": "barcode_sample"},
                {"data": "barcode_colilert"},
                {"data": "barcode_falcon1"},
                {"data": "volume_falcon1"},
                {"data": "barcode_falcon2"},
                {"data": "volume_falcon2"},
                {"data": "dilution"},
                {"data": "time_incubation"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O2B - New Bootsocks Stomacher<span id="my-another-cool-loader"></span>');
            $('#barcode_sample ').val('');
            // $('#date_conduct').val('');
            $('#elution_no').val('');
            $('#barcode_bootsock').val('');
            $('#elution').val('');
            $('#elu_comments').val('');
            $('#barcode_falcon').val('');
            $('#volume_stomacher').val('');
            $('#compose-modal').modal('show');
        });

        $('#addtomboldet').click(function() {
            var data = table.row('.active').data();
            if (!data) {
                alert("Parent bootsocks not found, please select from the table above");
                return;
            }
            data1 = data.elution_no;
            ckbar = data1.substring(0,5).toUpperCase();
            if (ckbar != "MICRO") {
                alert("Endetec is for Micro sample only, please select Micro sample from the table above");
                return;
            }
            $('#mode_det').val('insert');
            $('#detail-title1').html('<i class="fa fa-wpforms"></i> O2B - New Endetec<span id="my-another-cool-loader"></span>');
            $('#barcode_bootsock1').attr('readonly', true);
            $('#barcode_bootsock1').val(data.barcode_bootsock);
            $('#barcode_endetec').val('');
            $('#barcode_falcon_en1').val('');
            $('#volume_falcon_en1').val('');
            $('#barcode_falcon_en2').val('');
            $('#volume_falcon_en2').val('');
            $('#dilution_en').attr('readonly', true);
            $('#dilution_en').val('');
            $('#time_incubation_en').val('');
            $('#comments_en').val('');
            $('#detail-modal').modal('show');
        });

        $('#addtomboldet2').click(function() {
            var data = table.row('.active').data();
            if (!data) {
                alert("Parent bootsocks not found, please select from the table above");
                return;
            }            
            data1 = data.elution_no;
            ckbar = data1.substring(0,5).toUpperCase();
            if (ckbar != "MICRO") {
                alert("IDEXX is for Micro sample only, please select Micro sample from the table above");
                return;
            }
            $('#mode_det2').val('insert');
            $('#detail-title2').html('<i class="fa fa-wpforms"></i> O2B - New IDEXX<span id="my-another-cool-loader"></span>');
            $('#barcode_bootsock2').attr('readonly', true);
            $('#barcode_bootsock2').val(data.barcode_bootsock);
            $('#barcode_colilert').val('');
            $('#barcode_falcon_id1').val('');
            $('#volume_falcon_id1').val('');
            $('#barcode_falcon_id2').val('');
            $('#volume_falcon_id2').val('');
            $('#dilution_id').attr('readonly', true);
            $('#dilution_id').val('');
            $('#time_incubation_id').val('');
            $('#comments_id').val('');
            $('#detail-modal2').modal('show');
        });


        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O2B - Update Bootsocks Stomacher<span id="my-another-cool-loader"></span>');
            $('#barcode_sample ').val(data.barcode_sample);
            $('#date_conduct').val(data.date_conduct);
            $('#elution_no').val(data.elution_no).trigger('change');
            $('#barcode_bootsock').val(data.barcode_bootsock);
            $('#elution').val(data.elution);
            $('#elu_comments').val(data.elu_comments);
            $('#barcode_falcon').val(data.barcode_falcon);
            $('#volume_stomacher').val(data.volume_stomacher);
            $('#compose-modal').modal('show');
        });  

        $('#mytable_det1').on('click', '.btn_edit_det', function(){
            let tr = $(this).parent().parent();
            let data = table_det1.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode_det').val('edit');
            $('#detail-title1').html('<i class="fa fa-pencil-square"></i> O2B - Update Endetec<span id="my-another-cool-loader"></span>');
            $('#barcode_bootsock1').attr('readonly', true);
            $('#barcode_bootsock1').val(data.barcode_sample);
            $('#barcode_endetec').val(data.barcode_endetec);
            $('#barcode_falcon_en1').val(data.barcode_falcon1);
            $('#volume_falcon_en1').val(data.volume_falcon1);
            $('#barcode_falcon_en2').val(data.barcode_falcon2);
            $('#volume_falcon_en2').val(data.volume_falcon2);
            $('#dilution_en').attr('readonly', true);
            $('#dilution_en').val(data.dilution);
            $('#time_incubation_en').val(data.time_incubation);
            $('#comments_en').val(data.comments);
            $('#detail-modal').modal('show');
        });  


        $('#mytable_det2').on('click', '.btn_edit_det2', function(){
            let tr = $(this).parent().parent();
            let data = table_det2.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode_det2').val('edit');
            $('#detail-title2').html('<i class="fa fa-pencil-square"></i> O2B - Update IDEXX<span id="my-another-cool-loader"></span>');
            $('#barcode_bootsock2').attr('readonly', true);
            $('#barcode_bootsock2').val(data.barcode_sample);
            $('#barcode_colilert').val(data.barcode_colilert);
            $('#barcode_falcon_id1').val(data.barcode_falcon1);
            $('#volume_falcon_id1').val(data.volume_falcon1);
            $('#barcode_falcon_id2').val(data.barcode_falcon2);
            $('#volume_falcon_id2').val(data.volume_falcon2);
            $('#dilution_id').attr('readonly', true);
            $('#dilution_id').val(data.dilution);
            $('#time_incubation_id').val(data.time_incubation);
            $('#comments_id').val(data.comments);
            $('#detail-modal2').modal('show');
        });  

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
            var data = table.row($(this)).data();
            if (data) {
                if (data.barcode_bootsock == "") {
                    table_det1.ajax.url('o2b_bootsocks_stomacher/subjson?id=' + data.barcode_sample).load();
                }
                else {
                    table_det1.ajax.url('o2b_bootsocks_stomacher/subjson?id=' + data.barcode_bootsock).load();
                }                
                table_det2.ajax.url('o2b_bootsocks_stomacher/subjson2?id=' + data.barcode_bootsock).load();
            }
        });

        $('#mytable_det1 tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table_det1.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        });

        $('#mytable_det2 tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table_det2.$('tr.active').removeClass('active');
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