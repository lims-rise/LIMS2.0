<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">NHMRC - Moisture 48h</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Moisture 48h</button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('nhmrc_moisture_48/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>Barcode foil</th>
                    <th>Date moisture</th>
                    <th>Dry weight 48h(g)</th>
                    <th>Difference 24 and 48h</th>
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
                    <h4 class="modal-title" id="modal-title">NHMRC - Moisture 48h</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('nhmrc_moisture_48/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="barcode_foil" class="col-sm-4 control-label">Barcode foil</label>
                            <div class="col-sm-6">
                                <input id="barcode_foil" name="barcode_foil" type="text" class="form-control" placeholder="Barcode foil" required>
                                <div class="val1tip"></div>
                            </div>
                            <div class="col-sm-2">
                                <input id="dry_weight24" name="dry_weight24" type="number" step="0.01"  class="form-control" placeholder="Dry 24h (g)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_moisture" class="col-sm-4 control-label">Date moisture</label>
                            <div class="col-sm-8">
                                <input id="date_moisture" name="date_moisture" type="text" class="form-control datepicker" placeholder="Date moisture">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dry_weight48" class="col-sm-4 control-label">Dry weight 48h (g)</label>
                            <div class="col-sm-8">
                                <input id="dry_weight48" name="dry_weight48" type="number" step="0.01"  class="form-control" placeholder="Dry weight 48h (g)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="difference" class="col-sm-4 control-label">Difference 24h and 48h</label>
                            <div class="col-sm-8">
                                <input id="difference" name="difference" type="text" class="form-control" placeholder="Difference 24h and 48h" required>
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
                    <h4 class="modal-title"><i class="fa fa-trash"></i> NHMRC - Moisture 48h | Delete <span id="my-another-cool-loader"></span></h4>
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
            let url = '<?php echo site_url('NHMRC_moisture_48/delete'); ?>/' + id;
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

        $('.val1tip').tooltipster({
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

        function loadDry(data1) {
            $.getJSON("module/ob2b_moisture3/data_dry.php", {
                id1: data1,
                rand: Math.random(),
                ajax: 'true'
            }, function(j) {
                for (var i = 0; i < j.length; i++) {
                    $("#dry_weight24").val(j[i].dry);
                    if ((($('#dry_weight48').val()-$('#dry_weight24').val())/$('#dry_weight24').val()) < 0.1 ) {
                        $('#difference').val("STOP");
                    }
                    else {
                        $('#difference').val("CONTINUE");
                    }
                }
            })
        }        

        function load_dry(data1) {
            $.ajax({
                type: "GET",
                url: "nhmrc_moisture_48/load_dry?id1="+data1,
                dataType: "json",
                success: function(data) {
                    if (data.length > 0) {
                        $('#dry_weight24').val(data[0].dry);
                    }
                    else {
                        $('#dry_weight24').val('0');
                    }
                }
            });
            // return res; 
        }

        // function get_freez(data1, data2, data3, data4) {
        //     $.ajax({
        //         type: "GET",
        //         url: "nhmrc_moisture_48/get_freez?id1="+data1+"&id2="+data2+"&id3="+data3+"&id4="+data4,
        //         dataType: "json",
        //         success: function(data) {
        //             if (data.length > 0) {
        //                 // console.log();
        //                 $('#id_loc').val(data[0].id_location_80);    
        //             }
        //             else {
        //                 $('#id_loc').val('');    
        //             }
        //         }
        //     });
        // }

        // function checkBarcode() { col-sm-8
        // $('.modal-body').click(function() {
        $('#barcode_foil').click(function() {
            $('.val1tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
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
            $('#date_moisture').on('change', function (){
                if ($('#date_moisture').val() > today) {
                    $('#date_moisture').val(today);
                }
            });

        $("#date_moisture").datepicker({
            format: 'yyyy-mm-dd',
            // format: 'mm/dd/yyyy',
            orientation: "auto",
            autoclose: true
        });
        
        // $('#time_incubation').timepicker({ 'timeFormat': 'H:i' });
        // $('#time_incubation').on('click', function (){
        //     $('#time_incubation').timepicker('setTime', new Date());
        //     });
                    
        $('#barcode_foil').on("change", function() {
            data1 = $('#barcode_foil').val();
            $.ajax({
                type: "GET",
                url: "nhmrc_moisture_48/valid_bs?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length == 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is not on moisture sequence or is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_foil').focus();
                        $('#barcode_foil').val('');     
                        $('#dry_weight48').val('0');
                        $('#barcode_foil').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_foil').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_foil').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_foil').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                        // barcode = data[0].barcode_foil;
                        // console.log(data);
                    }
                    else {
                        $('#dry_weight24').val(data[0].dry_weight24);
                    }
                }
            });
            // }
            // $('.val1tip').tooltipster('content', 'Barcode :' + $(this).val()+' salah input, seharusnya memakai kode bla bla bla');
            // setTimeout(function(){
            //     $('.val1tip').tooltipster('hide');        
            // }, 5000);
        });


        $('#dry_weight48').on('change', function (){
            if ((($('#dry_weight24').val()-$('#dry_weight48').val())/$('#dry_weight24').val()) < 0.1 ) {
                $('#difference').val("STOP");
            }
            else {
                $('#difference').val("CONTINUE");
            }
        });

        $('#dry_weight48').on('keyup', function (){
            if ((($('#dry_weight24').val()-$('#dry_weight48').val())/$('#dry_weight24').val()) < 0.1 ) {
                $('#difference').val("STOP");
            }
            else {
                $('#difference').val("CONTINUE");
            }
        });
                
        $("input").keypress(function(){
            $('.val1tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_foil').focus();
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
            ajax: {"url": "nhmrc_moisture_48/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_foil"},
                {"data": "date_moisture"},
                {"data": "dry_weight48"},
                {"data": "difference"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> NHMRC - New Moisture 48h<span id="my-another-cool-loader"></span>');
            $('#barcode_foil').attr('readonly', false);
            $('#barcode_foil').val('');
            $('#dry_weight24').attr('readonly', true);
            $("#date_moisture").datepicker("setDate",'now');
            $('#dry_weight48').val('');
            $('#difference').attr('readonly', true);
            $('#difference').val('');
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
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> NHMRC - Update Moisture 48h<span id="my-another-cool-loader"></span>');
            $('#barcode_foil').attr('readonly', true);
            $('#barcode_foil').val(data.barcode_foil);
            $('#dry_weight24').attr('readonly', true);
            load_dry(data.barcode_foil); 
            $('#date_moisture').val(data.date_moisture);
            $('#dry_weight48').val(data.dry_weight48);
            $('#difference').attr('readonly', true);
            $('#difference').val(data.difference);
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