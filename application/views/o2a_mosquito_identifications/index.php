<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Objective 2A - Mosquito Identifications</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <button class='btn btn-primary' id='addtombol'><i class="fa fa-wpforms" aria-hidden="true"></i> New Identifications </button>
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('o2a_mosquito_identifications/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode storagebag</th>
		    <th>Lab tech</th>
		    <th>Date identification</th>
		    <th>Catch method</th>
		    <th>#Mosquitos</th>
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
                <form id="formSample"  action= <?php echo site_url('o2a_mosquito_identifications/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="bar_storagebag" class="col-sm-4 control-label">Barcode storagebag</label>
                            <div class="col-sm-8">
                                <input id="bar_storagebag" name="bar_storagebag" type="text" class="form-control" placeholder="Barcode storagebag" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_ident" class="col-sm-4 control-label">Date identification</label>
                            <div class="col-sm-8">
                                <input id="date_ident" name="date_ident" type="date" class="form-control" placeholder="Date identification" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Lab tech</label>
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
                            <label for="catch_met" class="col-sm-4 control-label">Catch method</label>
                            <div class="col-sm-8">
                            <select id='catch_met' name="catch_met" class="form-control">
                                <option>-- Select answer --</option>
								<option value='Pupae'>Pupae</option>
								<option value='BG'>BG</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_mosquito" class="col-sm-4 control-label">Number of mosquito</label>
                            <div class="col-sm-8">
                                <input id="no_mosquito" name="no_mosquito" type="number" class="form-control" placeholder="Number of Mosquito" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aedes_aegypt" class="col-sm-4 control-label">Aedes aegypti (M/F)</label>
                            <div class="col-sm-4">
                                <input id="aedes_aegypt_male" name="aedes_aegypt_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="aedes_aegypt_female" name="aedes_aegypt_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aedes_albopictus" class="col-sm-4 control-label">Aedes albopictus (M/F)</label>
                            <div class="col-sm-4">
                                <input id="aedes_albopictus_male" name="aedes_albopictus_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="aedes_albopictus_female" name="aedes_albopictus_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aedes_polynesiensis" class="col-sm-4 control-label">Aedes polynesiensis (M/F)</label>
                            <div class="col-sm-4">
                                <input id="aedes_polynesiensis_male" name="aedes_polynesiensis_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="aedes_polynesiensis_female" name="aedes_polynesiensis_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aedes_other" class="col-sm-4 control-label">Aedes other (M/F)</label>
                            <div class="col-sm-4">
                                <input id="aedes_other_male" name="aedes_other_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="aedes_other_female" name="aedes_other_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- <label for="culex" class="col-sm-4 control-label">Culex quinquefasciatus (M/F)</label> -->
                            <label for="culex" class="col-sm-4 control-label">Culex quinquefasci (M/F)</label>
                            <div class="col-sm-4">
                                <input id="culex_male" name="culex_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="culex_female" name="culex_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="culex_sitiens" class="col-sm-4 control-label">Culex sitiens (M/F)</label>
                            <div class="col-sm-4">
                                <input id="culex_sitiens_male" name="culex_sitiens_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="culex_sitiens_female" name="culex_sitiens_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="culexann" class="col-sm-4 control-label">Culex annulirostris (M/F)</label>
                            <div class="col-sm-4">
                                <input id="culexann_male" name="culexann_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="culexann_female" name="culexann_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="culex_other" class="col-sm-4 control-label">Culex other (M/F)</label>
                            <div class="col-sm-4">
                                <input id="culex_other_male" name="culex_other_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="culex_other_female" name="culex_other_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="anopheles" class="col-sm-4 control-label">Anopheles (M/F)</label>
                            <div class="col-sm-4">
                                <input id="anopheles_male" name="anopheles_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="anopheles_female" name="anopheles_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="uranotaenia" class="col-sm-4 control-label">Uranotaenia (M/F)</label>
                            <div class="col-sm-4">
                                <input id="uranotaenia_male" name="uranotaenia_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="uranotaenia_female" name="uranotaenia_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mansonia" class="col-sm-4 control-label">Mansonia (M/F)</label>
                            <div class="col-sm-4">
                                <input id="mansonia_male" name="mansonia_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="mansonia_female" name="mansonia_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="other" class="col-sm-4 control-label">Other (M/F)</label>
                            <div class="col-sm-4">
                                <input id="other_male" name="other_male" type="number" min=0 max=999 class="form-control" placeholder="#Male">
                            </div>
                            <div class="col-sm-4">
                                <input id="other_female" name="other_female" type="number" min=0 max=999 class="form-control" placeholder="#Female">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="culex_larvae" class="col-sm-4 control-label">Culex larvae</label>
                            <div class="col-sm-8">
                                <input id="culex_larvae" name="culex_larvae" type="number" min=0 max=999 class="form-control" placeholder="#Culex larvae">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aedes_larvae" class="col-sm-4 control-label">Aedes larvae</label>
                            <div class="col-sm-8">
                                <input id="aedes_larvae" name="aedes_larvae" type="number" min=0 max=999 class="form-control" placeholder="#Aedes larvae">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unidentify" class="col-sm-4 control-label">Unidentify / Damage</label>
                            <div class="col-sm-8">
                                <input id="unidentify" name="unidentify" type="number" min=0 max=999 class="form-control" placeholder="#Unidentify / Damage">
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="notes" class="col-sm-4 control-label">Comments</label>
                                <div class="col-sm-8">
                                    <textarea id="notes" name="notes" class="form-control" placeholder="Comments"> </textarea>
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

</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

var table
$(document).ready(function() {

    function toNumber(anum) {
        anum = anum || 0;
        return parseInt(anum);
    }
        
    function sum_all() {
		// alert ("cst_m : " + toNumber($('#aedes_aegypt_male').val()));
        var aae_m = toNumber($('#aedes_aegypt_male').val());
        var aae_f = toNumber($('#aedes_aegypt_female').val());
        var aal_m = toNumber($('#aedes_albopictus_male').val());
        var aal_f = toNumber($('#aedes_albopictus_female').val());
        var apo_m = toNumber($('#aedes_polynesiensis_male').val());
        var apo_f = toNumber($('#aedes_polynesiensis_female').val());
        var aot_m = toNumber($('#aedes_other_male').val());
        var aot_f = toNumber($('#aedes_other_female').val());
        var cul_m = toNumber($('#culex_male').val());
        var cul_f = toNumber($('#culex_female').val());
        var cst_m = toNumber($('#culex_sitiens_male').val());
        var cst_f = toNumber($('#culex_sitiens_female').val());
        var can_m = toNumber($('#culexann_male').val());
        var can_f = toNumber($('#culexann_female').val());
        var cot_m = toNumber($('#culex_other_male').val());
        var cot_f = toNumber($('#culex_other_female').val());
        var ano_m = toNumber($('#anopheles_male').val());
        var ano_f = toNumber($('#anopheles_female').val());
        var ura_m = toNumber($('#uranotaenia_male').val());
        var ura_f = toNumber($('#uranotaenia_female').val());
        var man_m = toNumber($('#mansonia_male').val());
        var man_f = toNumber($('#mansonia_female').val());
        var oth_m = toNumber($('#other_male').val());
        var oth_f = toNumber($('#other_female').val());
        var c_lar = toNumber($('#culex_larvae').val());		
        var a_lar = toNumber($('#aedes_larvae').val());
        var total = aae_m+aae_f+aal_m+aal_f+apo_m+apo_f+aot_m+aot_f+cul_m+cul_f+cst_m+cst_f+can_m+can_f+cot_m+cot_f+ano_m+ano_f+
                    ura_m+ura_f+man_m+man_f+oth_m+oth_f+c_lar+a_lar;
        // var total = parseInt(aae_m) + parseInt(aae_f) + parseInt(aal_m) + parseInt(aal_f) + parseInt(apo_m) + parseInt(apo_f) + parseInt(aot_m) + parseInt(aot_f) + 
        //     parseInt(cul_m) + parseInt(cul_f) + parseInt(cst_m) + parseInt(cst_f) + parseInt(can_m) + parseInt(can_f) + parseInt(cot_m) + parseInt(cot_f) + 
		// 	parseInt(ano_m) + parseInt(ano_f) + parseInt(ura_m) + parseInt(ura_f) + parseInt(man_m) + parseInt(man_f) + parseInt(oth_m) + parseInt(oth_f) + parseInt(c_lar) + parseInt(a_lar);
		return total;
    }

    $("input").on('change', function(){
        // alert('hasil : '+sum_all());
		$('#no_mosquito').val(sum_all()); 
    });


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


        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip').tooltipster('hide');   
            }, 3000);                            
        });

        $('#bar_kkslide').on("change", function() {
            data1 = $('#bar_kkslide').val();
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
            $.ajax({
                type: "GET",
                url: "o2a_mosquito_identifications/valid_bs?id1="+data1+"&id2=1",
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
            ajax: {"url": "o2a_mosquito_identifications/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "bar_storagebag"},
                {"data": "initial"},
                {"data": "date_ident"},
                {"data": "catch_met"},
                {"data": "no_mosquito"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'desc']],
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
            $('#bar_storagebag').attr('readonly', false);
            $('#bar_storagebag').val('');
            // $("#date_ident").datepicker("setDate",'now');
            // $('#time_receipt').timepicker('setTime', new Date());
            $('#id_person').val('');
            $('#catch_met').val('');
            $('#no_mosquito').attr('readonly', true);
            $('#no_mosquito').val('');
            $('#aedes_aegypt_male').val('');
            $('#aedes_aegypt_female').val('');
            $('#aedes_albopictus_male').val('');
            $('#aedes_albopictus_female').val('');
            $('#aedes_polynesiensis_male').val('');
            $('#aedes_polynesiensis_female').val('');
            $('#aedes_other_male').val('');
            $('#aedes_other_female').val('');
            $('#culex_male').val('');
            $('#culex_female').val('');
            $('#culex_sitiens_male').val('');
            $('#culex_sitiens_female').val('');
            $('#culexann_male').val('');
            $('#culexann_female').val('');
            $('#culex_other_male').val('');
            $('#culex_other_female').val('');
            $('#anopheles_male').val('');
            $('#anopheles_female').val('');
            $('#uranotaenia_male').val('');
            $('#uranotaenia_female').val('');
            $('#mansonia_male').val('');
            $('#mansonia_female').val('');
            $('#other_male').val('');
            $('#other_female').val('');
            $('#culex_larvae').val('');
            $('#aedes_larvae').val('');
            $('#unidentify').val('');
            $('#notes').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Feces KK 1<span id="my-another-cool-loader"></span>');
            $('#bar_storagebag').attr('readonly', true);
            $('#bar_storagebag').val(data.bar_storagebag);
            $('#date_ident').val(data.date_ident);
            $('#id_person').val(data.id_person).trigger('change');
            $('#catch_met').val(data.catch_met).trigger('change');
            $('#no_mosquito').attr('readonly', true);
            $('#no_mosquito').val(data.no_mosquito);
            $('#aedes_aegypt_male').val(data.aedes_aegypt_male);
            $('#aedes_aegypt_female').val(data.aedes_aegypt_female);
            $('#aedes_albopictus_male').val(data.aedes_albopictus_male);
            $('#aedes_albopictus_female').val(data.aedes_albopictus_female);
            $('#aedes_polynesiensis_male').val(data.aedes_polynesiensis_male);
            $('#aedes_polynesiensis_female').val(data.aedes_polynesiensis_female);
            $('#aedes_other_male').val(data.aedes_other_male);
            $('#aedes_other_female').val(data.aedes_other_female);
            $('#culex_male').val(data.culex_male);
            $('#culex_female').val(data.culex_female);
            $('#culex_sitiens_male').val(data.culex_sitiens_male);
            $('#culex_sitiens_female').val(data.culex_sitiens_female);
            $('#culexann_male').val(data.culexann_male);
            $('#culexann_female').val(data.culexann_female);
            $('#culex_other_male').val(data.culex_other_male);
            $('#culex_other_female').val(data.culex_other_female);
            $('#anopheles_male').val(data.anopheles_male);
            $('#anopheles_female').val(data.anopheles_female);
            $('#uranotaenia_male').val(data.uranotaenia_male);
            $('#uranotaenia_female').val(data.uranotaenia_female);
            $('#mansonia_male').val(data.mansonia_male);
            $('#mansonia_female').val(data.mansonia_female);
            $('#other_male').val(data.other_male);
            $('#other_female').val(data.other_female);
            $('#culex_larvae').val(data.culex_larvae);
            $('#aedes_larvae').val(data.aedes_larvae);
            $('#unidentify').val(data.unidentify);
            $('#notes').val(data.notes);
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