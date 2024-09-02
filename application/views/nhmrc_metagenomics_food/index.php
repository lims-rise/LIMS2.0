<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">NHMRC - Metagenomics (Food)</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Metagenomics (F)</button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('nhmrc_metagenomics_food/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>Barcode sample</th>
                    <th>Date conducted</th>
                    <th>Barcode DNA tube1</th>
                    <th>Barcode BOX tube1</th>
                    <th>Position tube1</th>
                    <th>Barcode DNA tube2</th>
                    <th>Barcode BOX tube2</th>
                    <th>Position tube2</th>
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
                    <h4 class="modal-title" id="modal-title">NHMRC - Metagenomics (Food)</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('nhmrc_metagenomics_food/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode sample/falcon 1" required>
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
                            <label for="barcode_dna1" class="col-sm-4 control-label">Barcode DNA tube 1</label>
                            <div class="col-sm-8">
                                <input id="barcode_dna1" name="barcode_dna1" type="text" class="form-control" placeholder="Barcode DNA tube 1" required>
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="weight_sub1" class="col-sm-4 control-label">Weight tube 1(g)</label>
                            <div class="col-sm-8">
                                <input id="weight_sub1" name="weight_sub1" type="number" step="0.01"  class="form-control" placeholder="Weight tube 1(g)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_storage1" class="col-sm-4 control-label">Barcode box tube 1</label>
                            <div class="col-sm-8">
                                <input id="barcode_storage1" name="barcode_storage1" type="text" class="form-control" placeholder="Barcode box tube 1" required>
                                <!-- <div class="val2tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="position_tube1" class="col-sm-4 control-label">Position tube 1</label>
                            <div class="col-sm-8">
                                <input id="position_tube1" name="position_tube1" type="number" step="0.01"  class="form-control" placeholder="Position tube 1" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_location" class="col-sm-4 control-label">Freezer location tube 1</label>
                            <input id="id_location_801" name="id_location_801" type="hidden" class="form-control" required>
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
                            <label for="barcode_dna2" class="col-sm-4 control-label">Barcode DNA tube 2</label>
                            <div class="col-sm-8">
                                <input id="barcode_dna2" name="barcode_dna2" type="text" class="form-control" placeholder="Barcode DNA tube 2" required>
                                <div class="val3tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="weight_sub2" class="col-sm-4 control-label">Weight tube 2(g)</label>
                            <div class="col-sm-8">
                                <input id="weight_sub2" name="weight_sub2" type="number" step="0.01"  class="form-control" placeholder="Weight tube 2(g)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_storage2" class="col-sm-4 control-label">Barcode box tube 2</label>
                            <div class="col-sm-8">
                                <input id="barcode_storage2" name="barcode_storage2" type="text" class="form-control" placeholder="Barcode box tube 2" required>
                                <!-- <div class="val2tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="position_tube2" class="col-sm-4 control-label">Position tube 2</label>
                            <div class="col-sm-8">
                                <input id="position_tube2" name="position_tube2" type="number" step="0.01"  class="form-control" placeholder="Position tube 2" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_location" class="col-sm-4 control-label">Freezer location tube 2</label>
                            <input id="id_location_802" name="id_location_802" type="hidden" class="form-control" required>
                            <div class="col-sm-2">
                            <select id='id_freez2' name="id_freez2" class="form-control" required>
                                <option>Freezer</option>
                                    <?php
                                    foreach($freez1 as $row){
                                        echo "<option value='".$row['freezer']."'>".$row['freezer']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_shelf2' name="id_shelf2" class="form-control" required>
                                <option>Shelf</option>
                                    <?php
                                    foreach($shelf1 as $row){
                                        echo "<option value='".$row['shelf']."'>".$row['shelf']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_rack2' name="id_rack2" class="form-control" required>
                                <option>Rack</option>
                                    <?php
                                    foreach($rack1 as $row){
                                        echo "<option value='".$row['rack']."'>".$row['rack']."</option>";
                                    }
                                    ?>
                            </select>
                            </div>
                            <div class="col-sm-2">
                            <select id='id_draw2' name="id_draw2" class="form-control" required>
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
                    <h4 class="modal-title"><i class="fa fa-trash"></i> NHMRC - Metagenomics (Food) | Delete <span id="my-another-cool-loader"></span></h4>
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
            let url = '<?php echo site_url('NHMRC_metagenomics_food/delete'); ?>/' + id;
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

        function load_freez1(data1) {
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_food/load_freez?id1="+data1,
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
                url: "nhmrc_metagenomics_food/load_freez?id1="+data1,
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

        function get_freez1(data1, data2, data3, data4) {
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_food/get_freez?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_location_801').val(data[0].id_location_80);    
                    }
                    else {
                        $('#id_loc').val('');    
                    }
                }
            });
        }
        
        function get_freez2(data1, data2, data3, data4) {
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_food/get_freez?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#id_location_802').val(data[0].id_location_80);    
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
            $('.val1tip, .val2tip, .val3tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        $('#barcode_dna1').click(function() {
            $('.val1tip, .val2tip, .val3tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        $('#barcode_dna2').click(function() {
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

        $('#id_freez1').on('change', function (){
            get_freez1($('#id_freez1').val(), $('#id_shelf1').val(), $('#id_rack1').val(), $('#id_draw1').val())
        });
        $('#id_shelf1').on('change', function (){
            get_freez1($('#id_freez1').val(), $('#id_shelf1').val(), $('#id_rack1').val(), $('#id_draw1').val())
        });
        $('#id_rack1').on('change', function (){
            get_freez1($('#id_freez1').val(), $('#id_shelf1').val(), $('#id_rack1').val(), $('#id_draw1').val())
        });
        $('#id_draw1').on('change', function (){
            get_freez1($('#id_freez1').val(), $('#id_shelf1').val(), $('#id_rack1').val(), $('#id_draw1').val())
        });


        $('#id_freez2').on('change', function (){
            get_freez2($('#id_freez2').val(), $('#id_shelf2').val(), $('#id_rack2').val(), $('#id_draw2').val())
        });
        $('#id_shelf2').on('change', function (){
            get_freez2($('#id_freez2').val(), $('#id_shelf2').val(), $('#id_rack2').val(), $('#id_draw2').val())
        });
        $('#id_rack2').on('change', function (){
            get_freez2($('#id_freez2').val(), $('#id_shelf2').val(), $('#id_rack2').val(), $('#id_draw2').val())
        });
        $('#id_draw2').on('change', function (){
            get_freez2($('#id_freez2').val(), $('#id_shelf2').val(), $('#id_rack2').val(), $('#id_draw2').val())
        });


        // $('#time_started').on('change', function (){
        //     var difference = Math.abs(toMinutes($('#time_finished').val()) - toMinutes($('#time_started').val()));
        //     var result = Math.floor(difference / 60);
        //     $('#time_minutes').val(result);
        // });

        // $('#time_started').on('keyup', function (){
        //     var difference = Math.abs(toMinutes($('#time_finished').val()) - toMinutes($('#time_started').val()));
        //     var result = Math.floor(difference / 60);
        //     $('#time_minutes').val(result);
        // });

        // $('#time_finished').on('change', function (){
        //     var difference = Math.abs(toMinutes($('#time_finished').val()) - toMinutes($('#time_started').val()));
        //     var result = Math.floor(difference / 60);
        //     $('#time_minutes').val(result);
        // });

        // $('#time_finished').on('keyup', function (){
        //     var difference = Math.abs(toMinutes($('#time_finished').val()) - toMinutes($('#time_started').val()));
        //     var result = Math.floor(difference / 60);
        //     $('#time_minutes').val(result);
        // });            
        
        // $('#time_incubation').timepicker({ 'timeFormat': 'H:i' });
        // $('#time_incubation').on('click', function (){
        //     $('#time_incubation').timepicker('setTime', new Date());
        //     });
                    
        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_food/valid_bs?id1="+data1,
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
                        // $('#volume_filtered').val('0');     
                        // $('#barcode_falcon2').attr('readonly', true);
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

        $('#barcode_dna1').on("change", function() {
            data1 = $('#barcode_dna1').val();
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_food/valid_bs2?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode DNA <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#barcode_dna1').focus();
                        $('#barcode_dna1').val('');     
                        $('#barcode_dna1').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_dna1').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_dna1').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_dna1').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
        });


        $('#barcode_dna2').on("change", function() {
            data1 = $('#barcode_dna2').val();
            $.ajax({
                type: "GET",
                url: "nhmrc_metagenomics_food/valid_bs2?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode DNA <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val3tip').tooltipster('content', tip);
                        $('.val3tip').tooltipster('show');
                        $('#barcode_dna2').focus();
                        $('#barcode_dna2').val('');     
                        $('#barcode_dna2').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_dna2').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_dna2').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_dna2').css({'background-color' : '#FFFFFF'});
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
            ajax: {"url": "nhmrc_metagenomics_food/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "date_conduct"},
                {"data": "barcode_dna1"},
                {"data": "barcode_storage1"},
                {"data": "position_tube1"},
                {"data": "barcode_dna2"},
                {"data": "barcode_storage2"},
                {"data": "position_tube2"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> NHMRC - New Metagenomics (Food)<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            $("#date_conduct").datepicker("setDate",'now');
            $('#barcode_dna1').val('');
            $('#weight_sub1').val('');
            $('#barcode_storage1').val('');
            $('#position_tube1').val('');
            $('#id_location_801').val('');
            $('#id_freez1').val('');
            $('#id_shelf1').val('');
            $('#id_rack1').val('');
            $('#id_draw1').val('');
            $('#barcode_dna2').val('');
            $('#weight_sub2').val('');
            $('#barcode_storage2').val('');
            $('#position_tube2').val('');
            $('#id_location_802').val('');
            $('#id_freez2').val('');
            $('#id_shelf2').val('');
            $('#id_rack2').val('');
            $('#id_draw2').val('');
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
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> NHMRC - Update Metagenomics (Food)<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#date_conduct').val(data.date_conduct);
            $('#barcode_dna1').val(data.barcode_dna1);
            $('#weight_sub1').val(data.weight_sub1);
            $('#barcode_storage1').val(data.barcode_storage1);
            $('#position_tube1').val(data.position_tube1);
            $('#id_location_801').val(data.id_location_801);
            load_freez1(data.id_location_801);
            $('#barcode_dna2').val(data.barcode_dna2);
            $('#weight_sub2').val(data.weight_sub2);
            $('#barcode_storage2').val(data.barcode_storage2);
            $('#position_tube2').val(data.position_tube2);
            $('#id_location_802').val(data.id_location_802);
            load_freez2(data.id_location_802);
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