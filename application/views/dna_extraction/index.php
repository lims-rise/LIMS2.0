<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DNA Module - DNA Extraction</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New DNA Extraction </button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('dna_extraction/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                <!-- <th width="30px">No</th> -->
                <th>Barcode sample</th>
                <th>Date extraction</th>
                <th>Sample type</th>
                <th>Weights</th>
                <th>Barcode DNA</th>
                <th>Cryobox</th>
                <th>Barcode metagenomics</th>
                <th>Meta box</th>
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
    
</style>

    <!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">DNA Extraction - New Sample</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('dna_extraction/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="date_extraction" class="col-sm-4 control-label">Date Extraction</label>
                            <div class="col-sm-8">
                                <input id="date_extraction" name="date_extraction" type="date" class="form-control" placeholder="Date Extraction" value="<?php echo date("Y-m-d"); ?>">
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
                            <label for="kit_lot" class="col-sm-4 control-label">Kit Lot</label>
                            <div class="col-sm-8">
                                <input id="kit_lot" name="kit_lot" type="number" class="form-control" placeholder="Kit Lot" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode Sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode Sample" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="type" class="col-sm-4 control-label">Sample Type</label>
                            <div class="col-sm-8">
                                <input id="type" name="type" type="text" class="form-control" placeholder="Sample Type" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_dna" class="col-sm-4 control-label">Barcode DNA</label>
                            <div class="col-sm-8">
                                <input id="barcode_dna" name="barcode_dna" type="text" class="form-control" placeholder="Barcode DNA" required>
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cryobox" class="col-sm-4 control-label">Cryobox</label>
                            <div class="col-sm-8">
                                <input id="cryobox" name="cryobox" type="text" class="form-control" placeholder="Cryobox" required>
                                <div class="val3tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="weights" class="col-sm-4 control-label">Weights (mg)</label>
                            <div class="col-sm-8">
                                <input id="weights" name="weights" type="number" step="1" class="form-control" placeholder="Weights (mg)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tube_number" class="col-sm-4 control-label">Tube Number</label>
                            <div class="col-sm-8">
                                <input id="tube_number" name="tube_number" type="number" class="form-control" placeholder="Tube Number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_metagenomics" class="col-sm-4 control-label">Barcode metagenomics</label>
                            <div class="col-sm-8">
                                <input id="barcode_metagenomics" name="barcode_metagenomics" type="text" class="form-control" placeholder="Barcode metagenomics">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="meta_box" class="col-sm-4 control-label">Meta box</label>
                            <div class="col-sm-8">
                                <input id="meta_box" name="meta_box" type="text" class="form-control" placeholder="Meta box">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_location" class="col-sm-4 control-label">Freezer Location</label>
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

                        <!-- <div class="form-group">
                            <label for="meta_box" class="col-sm-4 control-label">ID Location</label>
                            <div class="col-sm-8"> -->
                                <input id="id_loc" name="id_loc" type="hidden" class="form-control input-sm" >
                            <!-- </div>
                        </div> -->


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
                    <h4 class="modal-title"><i class="fa fa-trash"></i> DNA Extraction | Delete <span id="my-another-cool-loader"></span></h4>
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
            let url = '<?php echo site_url('Dna_extraction/delete'); ?>/' + id;
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


                
        // $('.col-sm-8').click(function() {

            // $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        // });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip, .val2tip, .val3tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        $('#id_freez').on("change", function() {
            if ($('#id_freez').val() == '-20'){
                $('#id_shelf').val('0');
                $('#id_rack').val('0');
                $('#id_draw').val('0');
                $('#id_shelf').prop('disabled', true);
                $('#id_rack').prop('disabled', true);
                $('#id_draw').prop('disabled', true);
            }
            else {
                $('#id_shelf').prop('disabled', false);
                $('#id_rack').prop('disabled', false);
                $('#id_draw').prop('disabled', false);
            }

            data1 = $('#id_freez').val();
            data2 = $('#id_shelf').val();
            data3 = $('#id_rack').val();
            data4 = $('#id_draw').val();
            $.ajax({
                type: "GET",
                url: "dna_extraction/get_loc?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        $('#id_loc').val(data[0].id_location_80);   
                    }
                    else {
                        $('#id_loc').val('');   
                    }
                }
            });            
        });

        $('#id_shelf').on("change", function() {
            data1 = $('#id_freez').val();
            data2 = $('#id_shelf').val();
            data3 = $('#id_rack').val();
            data4 = $('#id_draw').val();
            $.ajax({
                type: "GET",
                url: "dna_extraction/get_loc?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        $('#id_loc').val(data[0].id_location_80);   
                    }
                    else {
                        $('#id_loc').val('');   
                    }
                }
            });
        });        

        $('#id_rack').on("change", function() {
            data1 = $('#id_freez').val();
            data2 = $('#id_shelf').val();
            data3 = $('#id_rack').val();
            data4 = $('#id_draw').val();
            $.ajax({
                type: "GET",
                url: "dna_extraction/get_loc?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        $('#id_loc').val(data[0].id_location_80);   
                    }
                    else {
                        $('#id_loc').val('');   
                    }
                }
            });
        });        

        $('#id_draw').on("change", function() {
            data1 = $('#id_freez').val();
            data2 = $('#id_shelf').val();
            data3 = $('#id_rack').val();
            data4 = $('#id_draw').val();
            $.ajax({
                type: "GET",
                url: "dna_extraction/get_loc?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        $('#id_loc').val(data[0].id_location_80);   
                    }
                    else {
                        $('#id_loc').val('');   
                    }
                }
            });
        });        

        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            $.ajax({
                type: "GET",
                url: "dna_extraction/valid_bs?id1="+data1,
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        $('#type').val(data[0].type);   
                        $('#barcode_dna').focus();
                        // barcode = data[0].barcode_sample;
                        // console.log(data);
                    }
                    else {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> not found in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_sample').focus();
                        $('#barcode_sample').val('');     
                        $('#type').val('');   
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
        });

        $('#barcode_dna').on("change", function() {
            data1 = $('#barcode_dna').val();
            ckbar = data1.substring(0,5);
            ckarray = ["N-X1-", "N-X2-", "N-X3-", "N-X4-", "N-X5-","F-X1-", "F-X2-", "F-X3-", "F-X4-", "F-X5-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong></br> ex.(N-X#-XXXXXX / F-X#-XXXXXX) </strong> </span>');
                $('.val2tip').tooltipster('content', tip);
                $('.val2tip').tooltipster('show');
                $('#barcode_dna').val('');     
                $('#barcode_dna').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#barcode_dna').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#barcode_dna').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_dna').css({'background-color' : '#FFFFFF'});
                            $('#barcode_dna').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "dna_extraction/valid_dna?id1="+data1,
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#barcode_dna').focus();
                        $('#barcode_dna').val('');     
                        $('#barcode_dna').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_dna').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_dna').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_dna').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    } 
                }
            });
            }
        });

        $('#cryobox').on("change", function() {
            data1 = $('#cryobox').val();
            // ckbar = data1.substring(0,5);
            // ckarray = ["N-X1-", "N-X2-", "N-X3-", "N-X4-", "N-X5-","F-X1-", "F-X2-", "F-X3-", "F-X4-", "F-X5-"];
            // // ckarray = [10, 11, 12];
            // ck = $.inArray(ckbar, ckarray);
            // if (ck == -1) {
            //     tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong></br> ex.(N-X#-XXXXXX / F-X#-XXXXXX) </strong> </span>');
            //     $('.val3tip').tooltipster('content', tip);
            //     $('.val3tip').tooltipster('show');
            //     $('#cryobox').val('');     
            //     $('#cryobox').css({'background-color' : '#FFE6E7'});
            //     setTimeout(function(){
            //         $('#cryobox').css({'background-color' : '#FFFFFF'});
            //         setTimeout(function(){
            //             $('#cryobox').css({'background-color' : '#FFE6E7'});
            //             setTimeout(function(){
            //                 $('#cryobox').css({'background-color' : '#FFFFFF'});
            //                 $('#cryobox').focus();
            //             }, 300);                            
            //         }, 300);
            //     }, 300);
            // }
            // else {
            $.ajax({
                type: "GET",
                url: "dna_extraction/valid_cb?id1="+data1,
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data[0].num >= 81) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Cryobox <strong> ' + data1 +'</strong> is already full (81 sample) !</span>');
                        $('.val3tip').tooltipster('content', tip);
                        $('.val3tip').tooltipster('show');
                        $('#cryobox').focus();
                        $('#cryobox').val('');     
                        $('#cryobox').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#cryobox').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#cryobox').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#cryobox').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    } 
                }
            });
            // }
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
            setTimeout(function(){
                $('.val1tip, .val2tip, .val3tip').tooltipster('hide');   
            }, 2000);                            
        });

        $("input").click(function(){
            // $('#barcode_sample').val('');     
            setTimeout(function(){
                $('.val1tip, .val2tip, .val3tip').tooltipster('hide');   
            }, 2000);                            
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            // $('#barcode_sample').val('');     
            $('#date_extraction').focus();
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
            // searchable: false,
            ajax: {"url": "dna_extraction/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "date_extraction"},
                {"data": "type"},
                {"data": "weights"},
                // {"data": "tube_number"},
                {"data": "barcode_dna"},
                {"data": "cryobox"},
                {"data": "barcode_metagenomics"},
                {"data": "meta_box"},
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
            $('#id_loc').val('');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> DNA Extraction - New Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            $('#id_person').val('');
            $('#kit_lot').val('');
            $('#type').attr('readonly', true);
            $('#type').val('');
            $('#barcode_dna').attr('readonly', false);
            $('#barcode_dna').val('');
            $('#cryobox').val('');
            $('#weights').val('');
            $('#tube_number').val('');
            $('#barcode_metagenomics').val('');
            $('#meta_box').val('');
            $('#id_freez').val('');
            $('#id_shelf').val('');
            $('#id_rack').val('');
            $('#id_draw').val('');
            $('#id_loc').attr('readonly', true);
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
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> DNA Extraction - Update Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#date_extraction').val(data.date_extraction);
            $('#id_person').val(data.id_person);
            $('#kit_lot').val(data.kit_lot);
            $('#type').attr('readonly', true);
            $('#type').val(data.type);
            $('#barcode_dna').attr('readonly', true);
            $('#barcode_dna').val(data.barcode_dna);
            $('#cryobox').val(data.cryobox);
            $('#weights').val(data.weights);
            $('#tube_number').val(data.tube_number);
            $('#barcode_metagenomics').val(data.barcode_metagenomics);
            $('#meta_box').val(data.meta_box);
            $('#id_loc').val(data.id_location);
            $('#id_freez').val(data.freezer);
            $('#id_shelf').val(data.shelf);
            $('#id_rack').val(data.rack);
            $('#id_draw').val(data.rack_level);
            $('#id_loc').attr('readonly', true);
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