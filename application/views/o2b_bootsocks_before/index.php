<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header"> <h3 class="box-title">Objective 2B - Bootsocks Before</h3> </div>        
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Bootsock </button>";
        }
?>
                            
                            <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
                            <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
                            <?php echo anchor(site_url('o2b_bootsocks_before/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                        </div>
                        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th width="30px">No</th> -->
                                    <th>Barcode bootsocks</th>
                                    <th>Date weighed</th>
                                    <th>Bootsocks weighed - dry (g) </th>
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
                    <h4 class="modal-title" id="modal-title">New BOOTSOCKS - weights (before sample collection)</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('o2b_bootsocks_before/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <!-- <input id="id_samplelog" name="id_samplelog" type="hidden" class="form-control input-sm"> -->

                        <div class="form-group">
                            <label for="barcode_bootsocks" class="col-sm-4 control-label">Barcode bootsocks</label>
                            <div class="col-sm-8">
                                <input id="barcode_bootsocks" name="barcode_bootsocks" type="text" class="form-control" placeholder="Barcode bootsocks" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_weighed" class="col-sm-4 control-label">Date weighed</label>
                            <div class="col-sm-8">
                                <input id="date_weighed" name="date_weighed" type="date" class="form-control" placeholder="Date weighed" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bootsock_weight_dry" class="col-sm-4 control-label">Bootsock weight - dry (g)</label>
                            <div class="col-sm-8">
                                <input id="bootsock_weight_dry" name="bootsock_weight_dry" type="number" step="0.01" class="form-control" placeholder="Bootsock weight - dry (g)" required>
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


<!-- </div> -->

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table
    var table_det
    $(document).ready(function() {
        
        // $('.clockpicker').clockpicker({
        // placement: 'bottom', // clock popover placement
        // align: 'left',       // popover arrow align
        // donetext: 'Done',     // done button text
        // autoclose: true,    // auto close when minute is selected
        // vibrate: true        // vibrate the device when dragging clock hand
        // });                

        $('.val1tip').tooltipster({
                animation: 'swing',
                delay: 1,
                theme: 'tooltipster-default',
                autoClose: true,
                position: 'bottom',
            });


        $('#barcode_bootsocks').click(function() {
            $('.val1tip').tooltipster('hide');   
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });


        $('#barcode_bootsocks').on("change", function() {
            data1 = $('#barcode_bootsocks').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-S1-", "F-S1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N-S1-XXXXXX / F-S1-XXXXXX) </strong> </span>');
                $('.val1tip').tooltipster('content', tip);
                $('.val1tip').tooltipster('show');
                $('#barcode_bootsocks').val('');     
                $('#barcode_bootsocks').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#barcode_bootsocks').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#barcode_bootsocks').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_bootsocks').css({'background-color' : '#FFFFFF'});
                            $('#barcode_bootsocks').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o2b_bootsocks_before/valid_bs?id1="+data1+"&id2=1",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_bootsocks').focus();
                        $('#barcode_bootsocks').val('');     
                        $('#barcode_bootsocks').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_bootsocks').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_bootsocks').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_bootsocks').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });
        
        $("input").keypress(function(){
            $('.val1tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_bootsocks').focus();
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
            ajax: {"url": "o2b_bootsocks_before/json", "type": "POST"},
            columns: [
                // {
                //     "data": "id",
                //     "orderable": false
                // },
                {"data": "barcode_bootsocks"},
                {"data": "date_weighed"},
                {"data": "bootsock_weight_dry"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O2B - New BOOTSOCKS - weights (before sample collection)<span id="my-another-cool-loader"></span>');
            $('#barcode_bootsocks').val('');
            $('#barcode_bootsocks').attr('readonly', false);
            $('#bootsock_weight_dry').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });


        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O2B - Update BOOTSOCKS - weights (before sample collection)<span id="my-another-cool-loader"></span>');
            $('#barcode_bootsocks').val(data.barcode_bootsocks);
            $('#barcode_bootsocks').attr('readonly', true);
            $('#date_weighed').val(data.date_weighed);
            $('#bootsock_weight_dry').val(data.bootsock_weight_dry);
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
            // var data = table.row($(this)).data();
            // if (data) {
            //     table_det.ajax.url('o2b_bootsocks_before/subjson?id=' + data.id_receipt).load();
            // }
        });

        // $('#mytable_det tbody').on('click', 'tr', function () {
        //     if ($(this).hasClass('active')) {
        //         $(this).removeClass('active');
        //     } else {
        //         table_det.$('tr.active').removeClass('active');
        //         $(this).addClass('active');
        //     }
        // });


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