<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Sample External - Sample Reception</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'>
        <button class='btn btn-primary' id='addtombol'><i class="fa fa-wpforms" aria-hidden="true"></i> New Sample </button>
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('se_sample_reception/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode sample</th>
		    <th>New barcode</th>
		    <th>Date received</th>
		    <th>Lab received</th>
		    <!-- <th>Person</th> -->
		    <th>Sample type</th>
		    <th>Obtained from</th>
		    <th>Condition</th>
		    <!-- <th>Cont. intact</th> -->
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
                    <h4 class="modal-title" id="modal-title">Sample External - New Sample</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('se_sample_reception/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode Sample" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_barcode" class="col-sm-4 control-label">New barcode</label>
                            <div class="col-sm-8">
                                <input id="new_barcode" name="new_barcode" type="text" class="form-control" placeholder="New Barcode">
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_received" class="col-sm-4 control-label">Date receive</label>
                            <div class="col-sm-8">
                                <input id="date_received" name="date_received" type="date" class="form-control" placeholder="Date receive" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lab_received" class="col-sm-4 control-label">Lab receive</label>
                            <div class="col-sm-8">
                                <input id="lab_received" name="lab_received" type="text" class="form-control" placeholder="Lab receive" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="person" class="col-sm-4 control-label">Person receive</label>
                            <div class="col-sm-8">
                                <input id="person" name="person" type="text" class="form-control" placeholder="Person receive" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sample_type" class="col-sm-4 control-label">Sample type</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="sample_type" name="sample_type">
                                    <option value="" selected disabled>Choose Sample Type</option>
                                        <option value="Whole Sample">Whole Sample</option>
                                        <option value="Aliquot">Aliquot</option>
                                        <option value="Tray containing samples">Tray containing samples</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="obtained" class="col-sm-4 control-label">Obtained from lab?</label>
                            <div class="col-sm-8">
                                <input id="obtained" name="obtained" type="text" class="form-control" placeholder="Obtained from lab?">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="conditions" class="col-sm-4 control-label">Sample condition</label>
                            <div class="col-sm-8">
                                <input id="conditions" name="conditions" type="text" class="form-control" placeholder="Sample condition">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quarantine" class="col-sm-4 control-label">Quarantine Permits</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="quarantine" name="quarantine">
                                    <option value="" selected disabled>Quarantine Permits Required ?</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="permit_number" class="col-sm-4 control-label">Permit number</label>
                            <div class="col-sm-8">
                                <input id="permit_number" name="permit_number" type="text" class="form-control" placeholder="Permit number">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name_email_custodian" class="col-sm-4 control-label">Name and email of custodian</label>
                            <div class="col-sm-8">
                                <input id="name_email_custodian" name="name_email_custodian" type="text" class="form-control" placeholder="Name and email of custodian">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desc_storage" class="col-sm-4 control-label">Description of storage</label>
                            <div class="col-sm-8">
                                <input id="desc_storage" name="desc_storage" type="text" class="form-control" placeholder="Description of storage">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="loc_storage" class="col-sm-4 control-label">Location of storage</label>
                            <div class="col-sm-8">
                                <input id="loc_storage" name="loc_storage" type="text" class="form-control" placeholder="Location of storage">
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


        // function checkBarcode() { col-sm-8
        // $('.modal-body').click(function() {
        $('#barcode_sample').click(function() {
            $('.val1tip').tooltipster('hide');   
        // $('#barcode_sample').val('');     
        });

        // $('.col-sm-8').click(function() {

            // $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        // });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });


        // $('#barcode_sample').on("change", function() {
        //     data1 = $('#barcode_sample').val();
        //     ckbar = data1.substring(0,5);
        //     ckarray = ["N-B0-", "N-F0-", "N-P1-", "F-B0-", "F-F0-", "F-P1-",];
        //     // ckarray = [10, 11, 12];
        //     ck = $.inArray(ckbar, ckarray);
        //     if (ck == -1) {
        //         tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong></br> ex.(N-B0-XXXXXX / F-B0-XXXXXX) </br> (N-F0-XXXXXX / F-F0-XXXXXX) </br> (N-P1-XXXXXX / F-P1-XXXXXX) </strong> </span>');
        //         $('.val1tip').tooltipster('content', tip);
        //         $('.val1tip').tooltipster('show');
        //         $('#barcode_sample').val('');     
        //         $('#barcode_sample').css({'background-color' : '#FFE6E7'});
        //         setTimeout(function(){
        //             $('#barcode_sample').css({'background-color' : '#FFFFFF'});
        //             setTimeout(function(){
        //                 $('#barcode_sample').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#barcode_sample').css({'background-color' : '#FFFFFF'});
        //                     $('#barcode_sample').focus();
        //                 }, 300);                            
        //             }, 300);
        //         }, 300);
        //     }
        //     else {
        //     $.ajax({
        //         type: "GET",
        //         url: "se_sample_reception/valid_bs?id1="+data1,
        //         data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             if (data.length > 0) {
        //                 tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
        //                 $('.val1tip').tooltipster('content', tip);
        //                 $('.val1tip').tooltipster('show');
        //                 $('#barcode_sample').focus();
        //                 $('#barcode_sample').val('');     
        //                 $('#barcode_sample').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#barcode_sample').css({'background-color' : '#FFFFFF'});
        //                     setTimeout(function(){
        //                         $('#barcode_sample').css({'background-color' : '#FFE6E7'});
        //                         setTimeout(function(){
        //                             $('#barcode_sample').css({'background-color' : '#FFFFFF'});
        //                         }, 300);                            
        //                     }, 300);
        //                 }, 300);
        //             }
        //         }
        //     });
        //     }
        // });

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
            $('.val1tip').tooltipster('hide');   
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
            ajax: {"url": "se_sample_reception/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "new_barcode"},
                {"data": "date_received"},
                {"data": "lab_received"},
                // {"data": "person"},
                {"data": "sample_type"},
                {"data": "obtained"},
                {"data": "conditions"},
                // {"data": "cont_intact"},
                {"data": "comments"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[3, 'desc']],
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Sample External - New Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            // $("#date_receipt").datepicker("setDate",'now');
            // $('#time_receipt').timepicker('setTime', new Date());
            $('#new_barcode').val('');
            $('#lab_received').val('');
            $('#person').val('');
            $('#sample_type').val('');
            $('#obtained').val('');
            $('#conditions').val('');
            $('#quarantine').val('');
            $('#permit_number').val('');
            $('#name_email_custodian').val('');
            $('#desc_storage').val('');
            $('#loc_storage').val('');
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
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Sample External - Update Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#date_received').val(data.date_received);
            $('#new_barcode').val(data.new_barcode);
            $('#lab_received').val(data.lab_received);
            $('#person').val(data.person);
            $('#sample_type').val(data.sample_type).trigger('change');
            $('#obtained').val(data.obtained);
            $('#conditions').val(data.conditions);
            $('#quarantine').val(data.quarantine).trigger('change');
            $('#permit_number').val(data.permit_number);
            $('#name_email_custodian').val(data.name_email_custodian);
            $('#desc_storage').val(data.desc_storage);
            $('#loc_storage').val(data.loc_storage);
            // $('#time_receipt').clockpicker({'default': data.time_receipt});
            // $("#date_receipt").datepicker("setDate",'now');
            // $('#time_receipt').timepicker('setTime', new Date());
            // $('#id_person').val(data.id_person).trigger('change');
            // $('#id_type').val(data.id_type).trigger('change');
            // $('#png_control').val(data.png_control);
            // $('#cold_chain').val(data.cold_chain);
            // $('#cont_intact').val(data.cont_intact).trigger('change');
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