<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Water Module - Water Chemstry</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
        <button class='btn btn-primary' id='addtombol'><i class="fa fa-wpforms" aria-hidden="true"></i> New Water Chemistry</button>
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('wat_water_chemistry/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode sample</th>
		    <th>Date process</th>
		    <th>Laboratory</th>
		    <th>Parent barcode</th>
		    <th>Water type</th>
		    <th>Ammonia</th>
		    <th>Nitrate</th>
		    <th>Nitrite</th>
		    <th>Notes</th>
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
                    <h4 class="modal-title" id="modal-title">New Water Chemistry</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('wat_water_chemistry/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode sample" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_process" class="col-sm-4 control-label">Date process</label>
                            <div class="col-sm-8">
                                <input id="date_process" name="date_process" type="date" class="form-control" placeholder="Date process" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ammonia" class="col-sm-4 control-label">Ammonia (NH3-N) mg/L</label>
                            <div class="col-sm-8">
                                <input id="ammonia" name="ammonia" type="text" class="form-control" placeholder="Ammonia (NH3-N) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nitrate" class="col-sm-4 control-label">Nitrate (NO3-N) mg/L</label>
                            <div class="col-sm-8">
                                <input id="nitrate" name="nitrate" type="text" class="form-control" placeholder="Nitrate (NO3-N) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nitrite" class="col-sm-4 control-label">Nitrite (NO2-N) mg/L</label>
                            <div class="col-sm-8">
                                <input id="nitrite" name="nitrite" type="text" class="form-control" placeholder="Nitrite (NO2-N) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ph" class="col-sm-4 control-label">pH (Potential Hydrogen)</label>
                            <div class="col-sm-8">
                                <input id="ph" name="ph" type="text" class="form-control" placeholder="pH (Potential Hydrogen)" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="bod" class="col-sm-4 control-label">BOD (Check unit)</label>
                            <div class="col-sm-8">
                                <input id="bod" name="bod" type="text" class="form-control" placeholder="BOD (Check unit)" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="aluminium" class="col-sm-4 control-label">Aluminium mg/L</label>
                            <div class="col-sm-8">
                                <input id="aluminium" name="aluminium" type="text" class="form-control" placeholder="Aluminium mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barium" class="col-sm-4 control-label">Barium (Ba) mg/L</label>
                            <div class="col-sm-8">
                                <input id="barium" name="barium" type="text" class="form-control" placeholder="Barium (Ba) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="iron" class="col-sm-4 control-label">Iron (Fe) mg/L</label>
                            <div class="col-sm-8">
                                <input id="iron" name="iron" type="text" class="form-control" placeholder="Iron (Fe) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="chrome" class="col-sm-4 control-label">Chrome (Cr) mg/L</label>
                            <div class="col-sm-8">
                                <input id="chrome" name="chrome" type="text" class="form-control" placeholder="Chrome (Cr) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cadmium" class="col-sm-4 control-label">Cadmium (Cd) mg/L</label>
                            <div class="col-sm-8">
                                <input id="cadmium" name="cadmium" type="text" class="form-control" placeholder="Cadmium (Cd) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="manganese" class="col-sm-4 control-label">Manganese (Mn) mg/L</label>
                            <div class="col-sm-8">
                                <input id="manganese" name="manganese" type="text" class="form-control" placeholder="Manganese (Mn) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nickel" class="col-sm-4 control-label">Nickel (Ni) mg/L</label>
                            <div class="col-sm-8">
                                <input id="nickel" name="nickel" type="text" class="form-control" placeholder="Nickel (Ni) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="zinc" class="col-sm-4 control-label">Zinc (Zn) mg/L</label>
                            <div class="col-sm-8">
                                <input id="zinc" name="zinc" type="text" class="form-control" placeholder="Zinc (Zn) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="copper" class="col-sm-4 control-label">Copper (Cu) mg/L</label>
                            <div class="col-sm-8">
                                <input id="copper" name="copper" type="text" class="form-control" placeholder="Copper (Cu) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lead" class="col-sm-4 control-label">Lead (Pb) mg/L</label>
                            <div class="col-sm-8">
                                <input id="lead" name="lead" type="text" class="form-control" placeholder="Lead (Pb) mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cod" class="col-sm-4 control-label">COD mg/L</label>
                            <div class="col-sm-8">
                                <input id="cod" name="cod" type="text" class="form-control" placeholder="COD mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tds" class="col-sm-4 control-label">TDS mg/L</label>
                            <div class="col-sm-8">
                                <input id="tds" name="tds" type="text" class="form-control" placeholder="TDS mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tss" class="col-sm-4 control-label">TSS mg/L</label>
                            <div class="col-sm-8">
                                <input id="tss" name="tss" type="text" class="form-control" placeholder="TSS mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="phosphate" class="col-sm-4 control-label">Phosphate mg/L</label>
                            <div class="col-sm-8">
                                <input id="phosphate" name="phosphate" type="text" class="form-control" placeholder="Phosphate mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="oilgrease" class="col-sm-4 control-label">Oil and grease mg/L</label>
                            <div class="col-sm-8">
                                <input id="oilgrease" name="oilgrease" type="text" class="form-control" placeholder="Oil and grease mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sulfide" class="col-sm-4 control-label">Sulfide mg/L</label>
                            <div class="col-sm-8">
                                <input id="sulfide" name="sulfide" type="text" class="form-control" placeholder="Sulfide mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tot_nitrogen" class="col-sm-4 control-label">Total Nitrogen mg/L</label>
                            <div class="col-sm-8">
                                <input id="tot_nitrogen" name="tot_nitrogen" type="text" class="form-control" placeholder="Total Nitrogen mg/L" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tot_phosphorous" class="col-sm-4 control-label">Total Phosphorous mg/L</label>
                            <div class="col-sm-8">
                                <input id="tot_phosphorous" name="tot_phosphorous" type="text" class="form-control" placeholder="Total Phosphorous mg/L" >
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
            }, 2000);                            
        });

        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
            ckbar = data1.substring(0,5).toUpperCase();
            ckarray = ["N-S1-", "F-S1-"];
            // ckarray = [10, 11, 12];
            ck = $.inArray(ckbar, ckarray);
            if (ck == -1) {
                tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-S1-XXXXXX / F-S1-XXXXXX) </strong> </span>');
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
                url: "wat_water_chemistry/valid_bs?id1="+data1+"&id2=1",
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
            ajax: {"url": "wat_water_chemistry/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "date_process"},
                {"data": "water_lab"},
                {"data": "parent_barcode"},
                {"data": "sampletype2bwat"},
                {"data": "ammonia"},
                {"data": "nitrate"},
                {"data": "nitrite"},
                {"data": "notes"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> New Water Chemistry<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            // $("#date_ident").datepicker("setDate",'now');
            // $('#time_receipt').timepicker('setTime', new Date());
            $('#ammonia').val('');
            $('#nitrate').val('');
            // $('#no_mosquito').attr('readonly', true);
            $('#nitrite').val('');
            $('#ph').val('');
            $('#bod').val('');
            $('#aluminium').val('');
            $('#barium').val('');
            $('#iron').val('');
            $('#chrome').val('');
            $('#cadmium').val('');
            $('#manganese').val('');
            $('#nickel').val('');
            $('#zinc').val('');
            $('#copper').val('');
            $('#lead').val('');
            $('#cod').val('');
            $('#tds').val('');
            $('#tss').val('');
            $('#phosphate').val('');
            $('#oilgrease').val('');
            $('#sulfide').val('');
            $('#tot_nitrogen').val('');
            $('#tot_phosphorous').val('');
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
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#date_process').val(data.date_process);
            $('#ammonia').val(data.ammonia);
            $('#nitrate').val(data.nitrate);
            $('#nitrite').val(data.nitrite);
            $('#ph').val(data.ph);
            $('#bod').val(data.bod);
            $('#aluminium').val(data.aluminium);
            $('#barium').val(data.barium);
            $('#iron').val(data.iron);
            $('#chrome').val(data.chrome);
            $('#cadmium').val(data.cadmium);
            $('#manganese').val(data.manganese);
            $('#nickel').val(data.nickel);
            $('#zinc').val(data.zinc);
            $('#copper').val(data.copper);
            $('#lead').val(data.lead);
            $('#cod').val(data.cod);
            $('#tds').val(data.tds);
            $('#tss').val(data.tss);
            $('#phosphate').val(data.phosphate);
            $('#oilgrease').val(data.oilgrease);
            $('#sulfide').val(data.sulfide);
            $('#tot_nitrogen').val(data.tot_nitrogen);
            $('#tot_phosphorous').val(data.tot_phosphorous);
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