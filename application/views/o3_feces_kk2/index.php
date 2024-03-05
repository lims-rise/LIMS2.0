<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Objective 3 - Feces KK 2</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New KK 2 </button>";
        }
?>

        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('o3_feces_kk2/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode KK slide</th>
		    <th>Date process</th>
		    <th>Person read</th>
		    <th>Person write</th>
		    <th>#Eggs ascaris</th>
		    <th>#Eggs hookworm</th>
		    <th>#Eggs trichuris</th>
		    <th>#Eggs strongyloides</th>
		    <th>#Eggs taenia</th>
		    <th>#Eggs other</th>
		    <th>Fin</th>
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
                    <h4 class="modal-title" id="modal-title">O3 - New Feces KK 1</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('o3_feces_kk2/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="bar_kkslide" class="col-sm-4 control-label">Barcode KK slide</label>
                            <div class="col-sm-8">
                                <input id="bar_kkslide" name="bar_kkslide" type="text" class="form-control" placeholder="Barcode KK slide" required>
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
                            <label for="id_person" class="col-sm-4 control-label">Person (Read)</label>
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
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person2" class="col-sm-4 control-label">Person (Write)</label>
                            <div class="col-sm-8">
                            <select id='id_person2' name="id_person2" class="form-control">
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
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="start_time" class="col-sm-4 control-label">Start Time</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                <input id="start_time" name="start_time" class="form-control" placeholder="Start Time" value="<?php 
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
                            <label for="end_time" class="col-sm-4 control-label">End Time</label>
                            <div class="col-sm-8">
                                <div class="input-group clockpicker">
                                <input id="end_time" name="end_time" class="form-control" placeholder="End Time" value="<?php 
                                $datetime2 = new DateTime();
                                echo $datetime2->format( 'H:i' );
                                ?>">
                                <span class="input-group-addon">
                                <span class="glyphicon glyphicon-time"></span>
                                </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duration" class="col-sm-4 control-label">Duration</label>
                            <div class="col-sm-8">
                                <input id="duration" name="duration" type="number" class="form-control" placeholder="Duration" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ascaris" class="col-sm-4 control-label">Ascaris Lumbricoides</label>
                            <div class="col-sm-3">
                                <input id="ascaris" name="ascaris" type="number" class="form-control" placeholder="#Eggs" required>
                            </div>
                            <div class="col-sm-5">
                                <input id="ascaris_com" name="ascaris_com" type="text" class="form-control" placeholder="Comments">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="hookworm" class="col-sm-4 control-label">Hookworm</label>
                            <div class="col-sm-3">
                                <input id="hookworm" name="hookworm" type="number" class="form-control" placeholder="#Eggs" required>
                            </div>
                            <div class="col-sm-5">
                                <input id="hookworm_com" name="hookworm_com" type="text" class="form-control" placeholder="Comments">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="trichuris" class="col-sm-4 control-label">Trichuris trichura</label>
                            <div class="col-sm-3">
                                <input id="trichuris" name="trichuris" type="number" class="form-control" placeholder="#Eggs" required>
                            </div>
                            <div class="col-sm-5">
                                <input id="trichuris_com" name="trichuris_com" type="text" class="form-control" placeholder="Comments">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="strongyloides" class="col-sm-4 control-label">Strongyloides stercoralis</label>
                            <div class="col-sm-3">
                                <input id="strongyloides" name="strongyloides" type="number" class="form-control" placeholder="#Eggs" required>
                            </div>
                            <div class="col-sm-5">
                                <input id="strongyloides_com" name="strongyloides_com" type="text" class="form-control" placeholder="Comments">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="taenia" class="col-sm-4 control-label">Taenia spps</label>
                            <div class="col-sm-3">
                                <input id="taenia" name="taenia" type="number" class="form-control" placeholder="#Eggs" required>
                            </div>
                            <div class="col-sm-5">
                                <input id="taenia_com" name="taenia_com" type="text" class="form-control" placeholder="Comments">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="other" class="col-sm-4 control-label">Other</label>
                            <div class="col-sm-3">
                                <input id="other" name="other" type="number" class="form-control" placeholder="#Eggs" required>
                            </div>
                            <div class="col-sm-5">
                                <input id="other_com" name="other_com" type="text" class="form-control" placeholder="Comments">
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="comments" class="col-sm-4 control-label">Comments</label>
                                <div class="col-sm-8">
                                    <textarea id="comments" name="comments" class="form-control" placeholder="Comments"> </textarea>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="finalized" class="col-sm-4 control-label">Finalized</label>
                            <div class="col-sm-8">
                            <select id='finalized' name="finalized" class="form-control">
                                <option value=''>-- Select answer --</option>
								<option value='1'>Yes</option>
								<option value='0'>No</option>
                            </select>
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
        
        // function timeToSeconds(time) {
        //     time = time.split(":");
        //     return time[0] * 3600 + time[1] * 60 + time[2];
        // }

        function toMinutes(time_str) {
        // Extract hours and minutes
            var parts = time_str.split(':');
            // compute  and return total minutes
            return parts[0] * 3600 + // an hour has 60 minutes
                parts[1] * 60; // minutes
        }        

        $('.clockpicker').clockpicker({
        placement: 'bottom', // clock popover placement
        align: 'left',       // popover arrow align
        donetext: 'Done',     // done button text
        autoclose: true,    // auto close when minute is selected
        vibrate: true        // vibrate the device when dragging clock hand
        });                

        $("#end_time").on("change", function (){
            var difference = Math.abs(toMinutes($('#end_time').val()) - toMinutes($('#start_time').val()));
            var result = Math.floor(difference / 60);
            $('#duration').val(result);
        });

        $('#start_time').on('change', function (){
            var difference = Math.abs(toMinutes($('#end_time').val()) - toMinutes($('#start_time').val()));
            var result = Math.floor(difference / 60);
            $('#duration').val(result);
        });


        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_sample').focus();
        });        
                
        $('.val1tip').tooltipster({
            animation: 'swing',
            delay: 1,
            theme: 'tooltipster-default',
            autoClose: true,
            position: 'bottom',
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
        });

        $("input").keypress(function(){
            $('.val1tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip').tooltipster('hide');   
            }, 3000);                            
        });

        $('#id_person').on("change", function() {
            //$('#bar_kkslide').trigger('change');
        });

        $('#bar_kkslide').on("change", function() {
            data1 = $('#bar_kkslide').val();
            data3 = $('#id_person').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-F1-", "F-F1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-F1-XXXXXX / F-F1-XXXXXX) </strong> </span>');
                $('.val1tip').tooltipster('content', tip);
                $('.val1tip').tooltipster('show');
                $('#bar_kkslide').val('');     
                $('#bar_kkslide').css({'background-color' : '#FFE6E7'});
                setTimeout(function(){
                    $('#bar_kkslide').css({'background-color' : '#FFFFFF'});
                    setTimeout(function(){
                        $('#bar_kkslide').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_kkslide').css({'background-color' : '#FFFFFF'});
                            $('#bar_kkslide').focus();
                        }, 300);                            
                    }, 300);
                }, 300);
            }
            else {
            $('#bar_kkslide').val(data1);     
            $.ajax({
                type: "GET",
                url: "o3_feces_kk2/valid_bs?id1="+data1+"&id2=1&id3="+data3,
                data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    if (data.length > 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#bar_kkslide').val('');     
                        $('#bar_kkslide').focus();
                        $('#bar_kkslide').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#bar_kkslide').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#bar_kkslide').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#bar_kkslide').css({'background-color' : '#FFFFFF'});
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
            oLanguage: {
                sProcessing: "loading..."
            },
            // select: true;
            processing: true,
            serverSide: true,
            ajax: {"url": "o3_feces_kk2/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "bar_kkslide"},
                {"data": "date_process"},
                {"data": "person_read"},
                {"data": "person_write"},
                {"data": "ascaris"},
                {"data": "hookworm"},
                {"data": "trichuris"},
                {"data": "strongyloides"},
                {"data": "taenia"},
                {"data": "other"},
                {"data": "finalized"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[1, 'desc']],
            // columnDefs: [{
            //     orderable: false,
            //     className: 'select-checkbox',
            //     targets: 0
            // }],            
            // select: {
            //     style:    'os',
            //     selector: 'td:first-child'
            // },            
            // columnDefs: [{
            //     'render': function(data, type, row, meta){
            //         var checkbox = $("<input/>",{
            //             "type": "checkbox"
            //         });
            //         if(row[9] === "1") {
            //             checkbox.attr("disabled", true);
            //             checkbox.attr("checked", "checked");
            //             checkbox.addClass("checkbox_checked");
            //         }else{
            //             checkbox.attr("disabled", true);
            //             checkbox.addClass("checkbox_unchecked");
            //         }
            //         return checkbox.prop("outerHTML")
            //     }
            // }],            
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
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O3 - New Feces KK 1<span id="my-another-cool-loader"></span>');
            $('#bar_kkslide').attr('readonly', false);
            $('#bar_kkslide').val('');
            // $("#date_receipt").datepicker("setDate",'now');
            // $('#time_receipt').timepicker('setTime', new Date());
            $('#id_person').val('');
            $('#id_person2').val('');
            $('#start_time').val('');
            $('#end_time').val('');
            $('#duration').val(0);
            $('#ascaris').val(0);
            $('#ascaris_com').val('');
            $('#hookworm').val(0);
            $('#hookworm_com').val('');
            $('#trichuris').val(0);
            $('#trichuris_com').val('');
            $('#strongyloides').val(0);
            $('#strongyloides_com').val('');
            $('#taenia').val(0);
            $('#taenia_com').val('');
            $('#other').val(0);
            $('#other_com').val('');
            $('#comments').val('');
            $('#finalized').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Feces KK 1<span id="my-another-cool-loader"></span>');
            $('#bar_kkslide').attr('readonly', true);
            $('#bar_kkslide').val(data.bar_kkslide);
            $('#date_process').val(data.date_process);
            $('#id_person').val(data.id_person).trigger('change');
            $('#id_person2').val(data.id_person2).trigger('change');
            $('#start_time').val(data.start_time);
            $('#end_time').val(data.end_time);
            $('#duration').val(data.duration);
            $('#ascaris').val(data.ascaris);
            $('#ascaris_com').val(data.ascaris_com);
            $('#hookworm').val(data.hookworm);
            $('#hookworm_com').val(data.hookworm_com);
            $('#trichuris').val(data.trichuris);
            $('#trichuris_com').val(data.trichuris_com);
            $('#strongyloides').val(data.strongyloides);
            $('#strongyloides_com').val(data.strongyloides_com);
            $('#taenia').val(data.taenia);
            $('#taenia_com').val(data.taenia_com);
            $('#other').val(data.other);
            $('#other_com').val(data.other_com);
            $('#comments').val(data.comments);
            $('#finalized').val('0').trigger('change');
            if (data.finalized == 1) {
                $('#finalized').val('1').trigger('change');
            }
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