<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Objective 3 - Blood SST Aliquot</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;"'>
        <button class='btn btn-primary' id='addtombol'><i class="fa fa-wpforms" aria-hidden="true"></i> New SST Aliquot </button>
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('o3_blood_sst/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>Barcode sample</th>
                    <th>Date process</th>
                    <th>Lab tech</th>
                    <th>Barcode SST1</th>
                    <th>Aliquot Vol-1</th>
                    <th>Cryobox 1</th>
                    <th>Barcode SST2</th>
                    <th>Aliquot Vol-2</th>
                    <th>Cryobox 2</th>
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
    
/* .without_ampm::-webkit-datetime-edit-ampm-field {
   display: none;
 } */
 /* input[type=time]::-webkit-clear-button {
   -webkit-appearance: none;
   -moz-appearance: none;
   -o-appearance: none;
   -ms-appearance:none;
   appearance: none;
   margin: -10px; 
 } */
</style>

    <!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">O3 - Blood SST Aliquot Sample</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('o3_blood_sst/save') ?> method="post" class="form-horizontal">
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
                            <!-- <input id="description" name="description" type="text" class="form-control" placeholder="Item Description" required> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_sst1" class="col-sm-4 control-label">Barcode SST-1</label>
                            <div class="col-sm-8">
                                <input id="barcode_sst1" name="barcode_sst1" placeholder="Barcode SST-1" class="form-control" required>
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vol_aliquot1" class="col-sm-4 control-label">Volume Aliquot-1</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="vol_aliquot1" name="vol_aliquot1" required>
                                    <option>-- Select Volume Aliquot-1 --</option>
                                    <?php
                                    echo "<option value='500uL'>500uL</option>
                                        <option value='<500uL'><500uL</option>";
                                    ?>
                                </select>
                            </div>
                            <!-- <div class="col-sm-1">
                                <a type="button" id="resv1" class="myeditlink" href="javascript:void(0)"><i class="fa fa-refresh"></i></a>
                            </div> -->
                        </div>

                        <div class="form-group">
                            <label for="cryobox1" class="col-sm-4 control-label">Cryobox-1</label>
                            <div class="col-sm-8">
                                <input id="cryobox1" name="cryobox1" placeholder="Cryobox-1" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_sst2" class="col-sm-4 control-label">Barcode SST-2</label>
                            <div class="col-sm-8">
                                <input id="barcode_sst2" name="barcode_sst2" placeholder="Barcode SST-2" class="form-control" >
                                <div class="val3tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vol_aliquot2" class="col-sm-4 control-label">Volume Aliquot-2</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="vol_aliquot2" name="vol_aliquot2" >
                                    <option>-- Select Volume Aliquot-2 --</option>
                                    <?php
                                    echo "<option value='500uL' >500uL</option>
                                        <option value='<500uL' ><500uL</option>";
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

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_sample').focus();
        });        

        $('.val1tip, .val2tip, .val3tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
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
            ckarray = ["N-B0-", "F-B0-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-B0-XXXXXX / F-B0-XXXXXX) </strong> </span>');
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
                url: "o3_blood_sst/valid_bs?id1="+data1+"&id2=1",
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

        $('#barcode_sst1').on("change", function() {
            data1 = $('#barcode_sst1').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-E1-", "F-E1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-E1-XXXXXX / F-E1-XXXXXX) </strong> </span>');
                $('.val2tip').tooltipster('content', tip);
                $('.val2tip').tooltipster('show');
                $('#barcode_sst1').val('');     
                $('#barcode_sst1').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#barcode_sst1').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#barcode_sst1').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_sst1').css({'background-color' : '#FFFFFF'});
                            $('#barcode_sst1').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_blood_sst/valid_bs?id1="+data1+"&id2=2",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#barcode_sst1').val('');     
                        $('#barcode_sst1').focus();
                        $('#barcode_sst1').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_sst1').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_sst1').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_sst1').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
            }
        });

        $('#barcode_sst2').on("change", function() {
            data1 = $('#barcode_sst2').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-E2-", "F-E2-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-E2-XXXXXX / F-E2-XXXXXX) </strong> </span>');
                $('.val3tip').tooltipster('content', tip);
                $('.val3tip').tooltipster('show');
                $('#barcode_sst2').val('');     
                $('#barcode_sst2').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#barcode_sst2').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#barcode_sst2').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_sst2').css({'background-color' : '#FFFFFF'});
                            $('#barcode_sst2').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $.ajax({
                type: "GET",
                url: "o3_blood_sst/valid_bs?id1="+data1+"&id2=3",
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val3tip').tooltipster('content', tip);
                        $('.val3tip').tooltipster('show');
                        $('#barcode_sst2').val('');     
                        $('#barcode_sst2').focus();
                        $('#barcode_sst2').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_sst2').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_sst2').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_sst2').css({'background-color' : '#FFFFFF'});
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
            ajax: {"url": "o3_blood_sst/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "date_process"},
                {"data": "initial"},
                {"data": "barcode_sst1"},
                {"data": "vol_aliquot1"},
                {"data": "cryobox1"},
                {"data": "barcode_sst2"},
                {"data": "vol_aliquot2"},
                {"data": "cryobox2"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O3 - New Blood SST Aliquot Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            // $('#date_process').val('');
            $('#id_person').val('').trigger('change');
            $('#barcode_sst1').val('');
            $('#vol_aliquot1').val('').trigger('change');
            $('#cryobox1').val('');
            $('#barcode_sst2').val('');
            $('#vol_aliquot2').val('').trigger('change');
            $('#cryobox2').val('');
            $('#comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Blood SST Aliquot Sample<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#date_process').val(data.date_process);
            $('#id_person').val(data.id_person).trigger('change');
            $('#barcode_sst1').val(data.barcode_sst1);
            $('#vol_aliquot1').val(data.vol_aliquot1);
            $('#cryobox1').val(data.cryobox1);
            $('#barcode_sst2').val(data.barcode_sst2);
            $('#vol_aliquot2').val(data.vol_aliquot2);
            $('#cryobox2').val(data.cryobox2);
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