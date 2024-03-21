<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header"> <h3 class="box-title">Objective 2A - Sample Logging</h3> </div>        
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Sample </button>";
        }
?>

                        
                            <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
                            <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
                            <?php echo anchor(site_url('o2a_sample_logging/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                        </div>
                        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th width="30px">No</th> -->
                                    <th>ID</th>
                                    <th>Date collection</th>
                                    <th>Lab Tech</th>
                                    <th>Barcode sample bag</th>
                                    <th>Barcode eclosion</th>
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
                    <h4 class="modal-title" id="modal-title">O2A - Sample Reception</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('o2a_sample_logging/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_samplelog" name="id_samplelog" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="date_collection" class="col-sm-4 control-label">Date receipt</label>
                            <div class="col-sm-8">
                                <input id="date_collection" name="date_collection" type="date" class="form-control" placeholder="Date receipt" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Lab tech</label>
                            <div class="col-sm-8">
                            <select id='id_person' name="id_person" class="form-control">
                                <option>-- Select person --</option>
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
                            <label for="bar_samplebag" class="col-sm-4 control-label">Barcode samplebag</label>
                            <div class="col-sm-8">
                                <input id="bar_samplebag" name="bar_samplebag" type="text" class="form-control" placeholder="Barcode samplebag" value="<?php echo date("Y-m-d"); ?>">
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bar_eclosion" class="col-sm-4 control-label">Barcode eclosion</label>
                            <div class="col-sm-8">
                                <input id="bar_eclosion" name="bar_eclosion" type="text" class="form-control" placeholder="Barcode eclosion" value="<?php echo date("Y-m-d"); ?>">
                                <div class="val2tip"></div>
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

        $('.val1tip,.val2tip').tooltipster({
                animation: 'swing',
                delay: 1,
                theme: 'tooltipster-default',
                autoClose: true,
                position: 'bottom',
            });


        $('#bar_samplebag').click(function() {
            $('.val1tip,.val2tip').tooltipster('hide');   
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip,.val2tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });


        $('#bar_samplebag').on("change", function() {
            data1 = $('#bar_samplebag').val();
            ckbar = data1.substring(0,6).toUpperCase();
            ckarray = ["N0-M0-", "F0-M0-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N0-M0-XXXXXX / F0-M0-XXXXXX) </strong> </span>');
                $('.val1tip').tooltipster('content', tip);
                $('.val1tip').tooltipster('show');
                $('#bar_samplebag').val('');     
                $('#bar_samplebag').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#bar_samplebag').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#bar_samplebag').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_samplebag').css({'background-color' : '#FFFFFF'});
                            $('#bar_samplebag').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o2a_sample_logging/valid_bs?id1="+data1+"&id2=1",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#bar_samplebag').focus();
                        $('#bar_samplebag').val('');     
                        $('#bar_samplebag').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_samplebag').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#bar_samplebag').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#bar_samplebag').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });

        $('#bar_eclosion').on("change", function() {
            data1 = $('#bar_eclosion').val();
            ckbar = data1.substring(0,6).toUpperCase();
            ckarray = ["N0-M1-", "F0-M1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N0-M1-XXXXXX / F0-M1-XXXXXX) </strong> </span>');
                $('.val2tip').tooltipster('content', tip);
                $('.val2tip').tooltipster('show');
                $('#bar_eclosion').val('');     
                $('#bar_eclosion').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#bar_eclosion').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#bar_eclosion').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_eclosion').css({'background-color' : '#FFFFFF'});
                            $('#bar_eclosion').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o2a_sample_logging/valid_bs?id1="+data1+"&id2=2",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#bar_eclosion').focus();
                        $('#bar_eclosion').val('');     
                        $('#bar_eclosion').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_eclosion').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#bar_eclosion').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#bar_eclosion').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });
        
        $("input").keypress(function(){
            $('.val1tip,.val2tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#date_collection').focus();
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
            ajax: {"url": "o2a_sample_logging/json", "type": "POST"},
            columns: [
                // {
                //     "data": "id",
                //     "orderable": false
                // },
                {"data": "id_samplelog"},
                {"data": "date_collection"},
                {"data": "initial"},
                {"data": "bar_samplebag"},
                {"data": "bar_eclosion"},
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
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });

                
        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O2A - New sample logging<span id="my-another-cool-loader"></span>');
            $('#id_samplelog').val('');
            $('#id_person').val('');
            $('#bar_samplebag').val('');
            $('#bar_eclosion').val('');
            $('#compose-modal').modal('show');
        });


        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O2A - Update sample logging<span id="my-another-cool-loader"></span>');
            $('#id_samplelog').val(data.id_samplelog);
            $('#date_receipt').val(data.date_collection);
            $('#id_person').val(data.id_person).trigger('change');
            $('#bar_samplebag').val(data.bar_samplebag);
            $('#bar_eclosion').val(data.bar_eclosion);
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
            //     table_det.ajax.url('o2a_sample_logging/subjson?id=' + data.id_receipt).load();
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