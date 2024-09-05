<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">NHMRC - Macconkey In</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Macconkey IN</button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('nhmrc_macconkey_in/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>Barcode macconkey</th>
                    <th>Barcode sample</th>
                    <th>Date process</th>
                    <th>Time process</th>
                    <th>Person</th>
                    <th>Volume (mL)</th>
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
                    <h4 class="modal-title" id="modal-title">NHMRC - Macconkey In</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('nhmrc_macconkey_in/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode sample/falcon 1</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode sample/falcon 1" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sample_type" class="col-sm-4 control-label">Sample type</label>
                            <div class="col-sm-8">
                                <input id="sample_type" name="sample_type" type="text" class="form-control" placeholder="Sample type" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_falcon" class="col-sm-4 control-label">Barcode falcon 2</label>
                            <div class="col-sm-8">
                                <input id="barcode_falcon" name="barcode_falcon" type="text" class="form-control" placeholder="Barcode falcon 2">
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_process" class="col-sm-4 control-label">Date process</label>
                            <div class="col-sm-8">
                                <input id="date_process" name="date_process" type="text" class="form-control datepicker" placeholder="Date process">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="time_process" class="col-sm-4 control-label">Time process</label>
                            <div class="col-sm-8">
                                <input id="time_process" name="time_process" type="text" class="form-control clockpicker" placeholder="Time process" value="<?php $datetime = new DateTime(); echo $datetime->format( 'H:i:s' ); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Lab tech</label>
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
                            <label for="bar_macconkey" class="col-sm-4 control-label">Barcode macconkey</label>
                            <div class="col-sm-8">
                                <input id="bar_macconkey" name="bar_macconkey" type="text" class="form-control" placeholder="Barcode macconkey" required>
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="volume" class="col-sm-4 control-label">Volume (mL)</label>
                            <div class="col-sm-8">
                                <input id="volume" name="volume" type="number" step="0.01"  class="form-control" placeholder="Volume (mL)" required>
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
                    <h4 class="modal-title"><i class="fa fa-trash"></i> NHMRC - Macconkey In | Delete <span id="my-another-cool-loader"></span></h4>
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
            let url = '<?php echo site_url('NHMRC_macconkey_in/delete'); ?>/' + id;
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

        function load_stype(data1) {
            $.ajax({
                type: "GET",
                url: "nhmrc_macconkey_in/load_stype?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        // console.log();
                        $('#sample_type').val(data[0].sampletype);    
                        $('#barcode_falcon').attr('readonly', false);
                    }
                    else {
                        $('#sample_type').val('');    
                        $('#barcode_falcon').attr('readonly', true);
                    }
                }
            });
            // return res; 
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

        
        // $('#time_incubation').timepicker({ 'timeFormat': 'H:i' });
        // $('#time_incubation').on('click', function (){
        //     $('#time_incubation').timepicker('setTime', new Date());
        //     });
                    
        $('#volume').on("change", function() {
            $('#dilution').val($('#volume').val()/100);
        });

        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            $.ajax({
                type: "GET",
                url: "nhmrc_macconkey_in/valid_bs?id1="+data1,
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
                    else {
                        load_stype(data1);
                    }
                }
            });
            // }
            // $('.val1tip').tooltipster('content', 'Barcode :' + $(this).val()+' salah input, seharusnya memakai kode bla bla bla');
            // setTimeout(function(){
            //     $('.val1tip').tooltipster('hide');        
            // }, 5000);
        });

        $('#bar_macconkey').on("change", function() {
            data1 = $('#bar_macconkey').val();
            $.ajax({
                type: "GET",
                url: "nhmrc_macconkey_in/valid_bs2?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode macconkey <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#bar_macconkey').focus();
                        $('#bar_macconkey').val('');     
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
            ajax: {"url": "nhmrc_macconkey_in/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "bar_macconkey"},
                {"data": "barcode_sample"},
                {"data": "date_process"},
                {"data": "time_process"},
                {"data": "initial"},
                {"data": "volume"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> NHMRC - New Macconkey - In<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#sample_type').attr('readonly', true);
            $('#barcode_falcon').attr('readonly', true);
            $('#barcode_sample').val('');
            $('#sample_type').val('');
            $('#barcode_falcon').val('');
            $("#date_process").datepicker("setDate",'now');
            // $('#time_process').clockpicker("setTime", new Date());
            // $('#date_conduct').val('');
            // $('#time_incubation').val('');
            $('#id_person').val('');
            $('#bar_macconkey').val('');
            $('#volume').val('');
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
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> NHMRC - Update Macconkey - In<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#sample_type').attr('readonly', true);
            $('#barcode_falcon').val(data.barcode_falcon);
            $('#date_process').val(data.date_process);
            $('#time_process').val(data.time_process);
            $('#id_person').val(data.id_person); //.trigger('change');
            $('#bar_macconkey').attr('readonly', true);
            $('#bar_macconkey').val(data.bar_macconkey);
            load_stype(data.barcode_sample);
            $('#volume').val(data.volume);
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