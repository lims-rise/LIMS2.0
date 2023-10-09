<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header"> <h3 class="box-title">Objective 3 - Blood Centrifuge</h3> </div>        
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Blood Centrifuge </button>";
        }
?>

                        <?php echo anchor(site_url('o3_blood_centrifuge/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                        </div>
                        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                            <thead>
                                <tr>
                                    <!-- <th width="30px">No</th> -->
                                    <th>ID</th>
                                    <th>Date process</th>
                                    <th>Initial</th>
                                    <th>Centrifuge time</th>
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
                <div class="box-header"> <h3 class="box-title">Sample - Blood Centrifuge</h3> </div>                     
                <div class="box-body">
                    <div style="padding-bottom: 10px;">
                        <button class='btn btn-primary' id='addtomboldet'><i class="fa fa-wpforms" aria-hidden="true"></i> New Sample Blood Centrifuge </button>
                        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
                        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
                        <?php //echo anchor(site_url('o3_blood_centrifuge/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                    </div>
                    <table class="table table-bordered table-striped tbody" id="mytable_det">
                        <thead>
                            <tr>
                                <th width="30px">No</th>
                                <th>Barcode Sample</th>
                                <th>Comments</th>
                                <th width="120px">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div> <!-- box body -->
            </div> <!-- box box-black box-solid -->
        </div> <!-- col-xs-12 -->
    </div> <!-- row -->
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
                    <h4 class="modal-title" id="modal-title">O3 - Blood Centrifuge</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('o3_blood_centrifuge/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="idbc" name="idbc" type="hidden" class="form-control input-sm">

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
                            <label for="centrifuge_time" class="col-sm-4 control-label">Centrifuge Time</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                <input id="centrifuge_time" name="centrifuge_time" class="form-control" placeholder="Centrifuge Time" value="<?php 
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

    <!-- MODAL FORM -->
    <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">Sample - Blood Centrifuge</h4>
                </div>
                <form id="formSample2"  action= <?php echo site_url('o3_blood_centrifuge/save_detail') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
                        <input id="idbc_det" name="idbc_det" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode Sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode Sample" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comments_det" class="col-sm-4 control-label">Comments</label>
                            <div class="col-sm-8">
                                <textarea id="comments_det" name="comments_det" class="form-control" placeholder="Comments"> </textarea>
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

        $('.val1tip').tooltipster({
                animation: 'swing',
                delay: 1,
                theme: 'tooltipster-default',
                autoClose: true,
                position: 'bottom',
            });


        $('#barcode_sample').click(function() {
            $('.val1tip').tooltipster('hide');   
        });

        $("#detail-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });


        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-B0-", "F-B0-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong> ex.(N-B0-XXXXXX / F-B0-XXXXXX) </strong> </span>');
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
                url: "o3_blood_centrifuge/valid_bs?id1="+data1,
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
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
            }
        });

        $("input").keypress(function(){
            $('.val1tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#date_process').focus();
        });        
        
        $('#detail-modal').on('shown.bs.modal', function () {
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
            ajax: {"url": "o3_blood_centrifuge/json", "type": "POST"},
            columns: [
                // {
                //     "data": "id",
                //     "orderable": false
                // },
                {"data": "id"},
                {"data": "date_process"},
                {"data": "initial"},
                {"data": "centrifuge_time"},
                {"data": "comments"},
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

        table_det = $("#mytable_det").DataTable({
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
            ajax: {"url": "o3_blood_centrifuge/subjson", "type": "POST"},
            columns: [
                {
                    "data": "id_bc",
                    "orderable": false
                },
                {"data": "barcode_sample"},
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
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
                
        $('#addtombol').click(function() {
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O3 - New Blood Centrifuge<span id="my-another-cool-loader"></span>');
            $('#idbc').val('');
            // $('#date_process').val('');
            $('#id_person').val('');
            // $('#centrifuge_time').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#addtomboldet').click(function() {
            var data = table.row('.active').data();
            if (!data) {
                alert("Parent blood centrifuge not found, please select from the table above");
                return;
            }            
            $('#mode_det').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O3 - New Sample Blood Centrifuge<span id="my-another-cool-loader"></span>');
            $('#idbc_det').val(data.id);
            $('#barcode_sample').val('');
            $('#comments_det').val('');
            $('#detail-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Blood Centrifuge<span id="my-another-cool-loader"></span>');
            $('#idbc').val(data.id);
            $('#date_process').val(data.date_process);
            $('#id_person').val(data.id_person).trigger('change');
            $('#centrifuge_time').val(data.centrifuge_time);
            $('#comments').val(data.comments);
            $('#compose-modal').modal('show');
        });  

        $('#mytable_det').on('click', '.btn_edit_det', function(){
            let tr = $(this).parent().parent();
            let data = table_det.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode_det').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Sample Blood Centrifuge<span id="my-another-cool-loader"></span>');
            $('#idbc_det').val(data.id_bc);
            $('#barcode_sample').val(data.barcode_sample);
            $('#comments_det').val(data.comments);
            $('#detail-modal').modal('show');
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
            var data = table.row($(this)).data();
            if (data) {
                table_det.ajax.url('o3_blood_centrifuge/subjson?id=' + data.id).load();
            }
        });

        $('#mytable_det tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table_det.$('tr.active').removeClass('active');
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