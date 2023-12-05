<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Water Module - Water Spectro QC</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Spectro CRM </button>";
        }
?>        
		<?php echo anchor(site_url('wat_water_spectroqc/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>ID</th>
		    <th>Date spectro</th>
		    <th>Lab tech</th>
		    <th>Chemistry parameter</th>
		    <th>Lot number</th>
		    <th>Date expired</th>
		    <th>Cert. Value</th>
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
                    <h4 class="modal-title" id="modal-title">Water Module - New Water Spectro QC</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('wat_water_spectroqc/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_spec" name="id_spec" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="date_spec" class="col-sm-4 control-label">Date spectro run</label>
                            <div class="col-sm-8">
                                <input id="date_spec" name="date_spec" type="date" class="form-control" placeholder="Date Spectro Run" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Lab tech</label>
                            <div class="col-sm-8" >
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
                            <label for="chem_parameter" class="col-sm-4 control-label">Chemistry parameter</label>
                            <div class="col-sm-8">
                                <select class="form-control" id="chem_parameter" name="chem_parameter" required>
                                    <option value="" selected disabled>Choose Chemistry parameter</option>
                                    <?php
                                    echo "<option value='Ammonia' >Ammonia</option>
                                        <option value='Nitrate' >Nitrate</option>
                                        <option value='Nitrite' >Nitrite</option>
                                        <option value='Phosphate' >Phosphate</option> ";
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="mixture_name" class="col-sm-4 control-label">Mixture name</label>
                            <div class="col-sm-8">
                                <input id="mixture_name" name="mixture_name" type="text" class="form-control" placeholder="Mixture name" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sample_no" class="col-sm-4 control-label">Sample number</label>
                            <div class="col-sm-8">
                                <input id="sample_no" name="sample_no" type="text" class="form-control" placeholder="Sample number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="lot_no" class="col-sm-4 control-label">Lot number</label>
                            <div class="col-sm-8">
                                <input id="lot_no" name="lot_no" type="text" class="form-control" placeholder="Lot number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_expired" class="col-sm-4 control-label">Date expired</label>
                            <div class="col-sm-8">
                                <input id="date_expired" name="date_expired" type="date" class="form-control" placeholder="Date expired" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cert_value" class="col-sm-4 control-label">Certified value</label>
                            <div class="col-sm-8">
                                <input id="cert_value" name="cert_value" type="number" step="0.1" class="form-control" placeholder="Certified Value">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="uncertainty" class="col-sm-4 control-label">Uncertainty</label>
                            <div class="col-sm-8">
                                <input id="uncertainty" name="uncertainty" type="number" step="0.01" class="form-control" placeholder="Uncertainty">
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="notes" class="col-sm-4 control-label">Comments</label>
                                <div class="col-sm-8">
                                    <textarea id="notes" name="notes" class="form-control" placeholder="Comments"> </textarea>
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

        $('#compose-modal').on('shown.bs.modal', function () {
            $('#barcode_sample').focus();
        });

        $("input").keypress(function(){
            $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
        });

        $("input").click(function(){
            setTimeout(function(){
                $('.val1tip,.val2tip,.val3tip').tooltipster('hide');   
            }, 3000);                            
        });
        
        $('#freezer_bag').on("change", function() {
            findcryo($('#freezer_bag').val());
        });

        // $('#barcode_sample').on("change", function() {
        //     data1 = $('#barcode_sample').val();
        //     ckbar = data1.substring(0,5);
        //     ckarray = ["N-P1-", "F-P1-"];
        //     // ckarray = [10, 11, 12];
        //     ck = $.inArray(ckbar, ckarray);
        //     if (ck == -1) {
        //         tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! </br> <strong> ex.(N-P1-XXXXXX / F-P1-XXXXXX) </strong> </span>');
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
        //         url: "wat_water_spectroqc/valid_bs?id1="+data1+"&id2=1",
        //         data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             // var barcode = '';
        //             if (data.length > 0) {
        //                 tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode <strong> ' + data1 +'</strong> is already in the system !</span>');
        //                 $('.val1tip').tooltipster('content', tip);
        //                 $('.val1tip').tooltipster('show');
        //                 $('#barcode_sample').val('');     
        //                 $('#barcode_sample').focus();
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

        // function findcryo(data1) {
        //     $.ajax({
        //         type: "GET",
        //         url: "wat_water_spectroqc/load_cryo?idcryo="+data1,
        //         data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             var freez = '';
        //             var shelf = '';
        //             var rack = '';
        //             var rack_level = '';
        //             $("#freezer").val('');
        //             $("#shelf").val('');
        //             $("#rack").val('');
        //             $("#rack_level").val('');                    
        //             if (data) {
        //                 freez = data[0].freezer;
        //                 shelf = data[0].shelf;
        //                 rack = data[0].rack;
        //                 rack_level = data[0].rack_level;
        //                 // console.log(data);
        //                 // $("#comments").val(data[0].rack_level);
        //             }

        //             $("#freezer").val(freez);
        //             $("#shelf").val(shelf);
        //             $("#rack").val(rack);
        //             $("#rack_level").val(rack_level);                    
        //         }
        //     });
        // }

        // function loadLoc(data1) {
        //     $.ajax({
        //         type: "GET",
        //         url: "wat_water_spectroqc/load_loc?id1="+data1,
        //         data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             var freez = '';
        //             var shelf = '';
        //             var rack = '';
        //             var rack_level = '';
        //             $("#freezer").val('');
        //             $("#shelf").val('');
        //             $("#rack").val('');
        //             $("#rack_level").val('');                    
        //             if (data) {
        //                 freez = data[0].freezer;
        //                 shelf = data[0].shelf;
        //                 rack = data[0].rack;
        //                 rack_level = data[0].rack_level;
        //                 // console.log(data);
        //                 // $("#comments").val(data[0].rack_level);
        //             }

        //             $("#freezer").val(freez);
        //             $("#shelf").val(shelf);
        //             $("#rack").val(rack);
        //             $("#rack_level").val(rack_level);                    
        //         }
        //     });
        // }
        
    //     function loadLoc(data1) {
    //     // $("#my-another-cool-loader").html('<img src="img/719.gif" />');
    //     $.getJSON("wat_water_spectroqc/load_loc", {
    //         id1: data1,
    //         // rand: Math.random(),
    //         ajax: 'true'
    //     }, function(j) {
    //         var freez = '';
    //         var shelf = '';
    //         var rack = '';
    //         var rack_level = '';
    //         freez = j.freezer;
    //         shelf = j.shelf;
    //         rack = j.rack;
    //         rack_level = j.rack_level;

    //         for (var i = 0; i < j.length; i++) {
    //             freez += j[i].freezer;
    //             shelf += j[i].shelf;
    //             rack += j[i].rack;
    //             rack_level += j[i].rack_level;
    //         }

    //         $("#freezer").val(freez);
    //         $("#shelf").val(shelf);
    //         $("#rack").val(rack);
    //         $("#rack_level").val(rack_level);

    //         // $("#my-another-cool-loader").html('');
    //     })
    // }

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
            ajax: {"url": "wat_water_spectroqc/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "id_spec"},
                {"data": "date_spec"},
                {"data": "initial"},
                {"data": "chem_parameter"},
                {"data": "lot_no"},
                {"data": "date_expired"},
                {"data": "cert_value"},
                {"data": "notes"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[1, 'desc']],
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Water Module - New Water Spectro QC<span id="my-another-cool-loader"></span>');
            $('#id_spec').attr('readonly', false);
            $('#id_spec').val('');
            // $("#date_spec").datepicker("setDate",'now');
            $('#id_person').val('');
            $('#chem_parameter').val('');
            $('#mixture_name').val('');
            $('#sample_no').val('');
            $('#lot_no').val('');
            $('#date_expired').val('');
            $('#cert_value').val('');
            $('#uncertainty').val('');
            $('#notes').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O3 - Update Sample Filter Paper<span id="my-another-cool-loader"></span>');
            $('#id_spec').attr('readonly', true);
            $('#id_spec').val(data.id_spec);
            $('#date_spec').val(data.date_spec);
            $('#id_person').val(data.id_person).trigger('change');
            $('#chem_parameter').val(data.chem_parameter);
            $('#mixture_name').val(data.mixture_name);
            $('#sample_no').val(data.sample_no);
            $('#lot_no').val(data.lot_no);
            $('#date_expired').val(data.date_expired);
            $('#cert_value').val(data.cert_value);
            $('#uncertainty').val(data.uncertainty);
            $('#notes').val(data.notes);
            $('#compose-modal').modal('show');
        });  

        // $('#mytable tbody').on('click', '.btn_detail', function() {
        //     // var data = table.row($(this).parents('tr')).data();
        //     // location.href = 'wat_water_spectroqc/index_det?id_spec='+data.id_spec;
        //     // location.href = 'wat_water_spectroqc/index_detail';
        // });

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