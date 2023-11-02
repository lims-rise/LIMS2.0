<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Objective 2B - Other Lab Analysis</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New water sample </button>";
        }
?>
        
        <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
        <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
		<?php echo anchor(site_url('O2b_other_lab/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode sample</th>
		    <th width="140px">Water type</th>
        <?php
        if ($this->session->userdata('lab') == 1) {
            echo "
		    <th>BTKL chems</th>
		    <th>BBLK chems</th>
		    <th>BTKL micro</th>
		    <th>BBLK micro</th>
            "; 
        } 
        else {
            echo "
		    <th>WAF chems</th>
		    <th>Other chems</th>
		    <th>WAF micro</th>
		    <th>Other micro</th>
            "; 

        }
        ?>
		    <th>RISE lab</th>            
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
                    <h4 class="modal-title" id="modal-title">O2B - New water sample</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('O2b_other_lab/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">

                        <div class="form-group">
                            <label for="id_type2bwat" class="col-sm-4 control-label">Water type</label>
                            <div class="col-sm-8">
                            <select id='id_type2bwat' name="id_type2bwat" class="form-control">
                                <option value='' selected disabled>-- Select water type --</option>
                                <?php
                                foreach($type as $row){
									if ($id_sampletype == $row['id_sampletype']) {
										echo "<option value='".$row['id_sampletype']."' selected='selected'>".$row['sampletype']."</option>";
									}
									else {
                                        echo "<option value='".$row['id_sampletype']."'>".$row['sampletype']."</option>";
                                    }
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode sample" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="barcode_rise_lab" class="col-sm-4 control-label">Rise lab barcode</label>
                            <div class="col-sm-8">
                                <input id="barcode_rise_lab" name="barcode_rise_lab" type="text" class="form-control" placeholder="Rise lab barcode">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="barcode_nitro" class="col-sm-4 control-label">BKTL chemistry barcode</label>
                            <div class="col-sm-8">
                                <input id="barcode_nitro" name="barcode_nitro" type="text" class="form-control" placeholder="BKTL chemistry barcode">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="3rdparty_lab" class="col-sm-4 control-label">BKTL chemistry delivery</label>
                            <div class="col-sm-8">
                            <select id='3rdparty_lab' name="3rdparty_lab" class="form-control">
                                <option value='' selected disabled>-- Select answer --</option>
								<option value='Delivered to third party lab'>Delivered to third party lab</option>
								<option value='Stored overnight'>Stored overnight</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_nitro2" class="col-sm-4 control-label">BBLK chemistry barcode</label>
                            <div class="col-sm-8">
                                <input id="barcode_nitro2" name="barcode_nitro2" type="text" class="form-control" placeholder="BBLK chemistry barcode">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="3rdparty_lab2" class="col-sm-4 control-label">BBLK chemistry delivery</label>
                            <div class="col-sm-8">
                            <select id='3rdparty_lab2' name="3rdparty_lab2" class="form-control">
                                <option value='' selected disabled>-- Select answer --</option>
								<option value='Delivered to third party lab'>Delivered to third party lab</option>
								<option value='Stored overnight'>Stored overnight</option>
                            </select>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label for="barcode_microbiology" class="col-sm-4 control-label">BKTL micro barcode</label>
                            <div class="col-sm-8">
                                <input id="barcode_microbiology" name="barcode_microbiology" type="text" class="form-control" placeholder="BKTL micro barcode">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="3rdparty_lab3" class="col-sm-4 control-label">BKTL micro delivery</label>
                            <div class="col-sm-8">
                            <select id='3rdparty_lab3' name="3rdparty_lab3" class="form-control">
                                <option value='' selected disabled>-- Select answer --</option>
								<option value='Delivered to third party lab'>Delivered to third party lab</option>
								<option value='Stored overnight'>Stored overnight</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_microbiology2" class="col-sm-4 control-label">BBLK micro barcode</label>
                            <div class="col-sm-8">
                                <input id="barcode_microbiology2" name="barcode_microbiology2" type="text" class="form-control" placeholder="BBLK micro barcode">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="3rdparty_lab4" class="col-sm-4 control-label">BBLK micro delivery</label>
                            <div class="col-sm-8">
                            <select id='3rdparty_lab4' name="3rdparty_lab4" class="form-control">
                                <option value='' selected disabled>-- Select answer --</option>
								<option value='Delivered to third party lab'>Delivered to third party lab</option>
								<option value='Stored overnight'>Stored overnight</option>
                            </select>
                            </div>
                        </div>

                        <hr>

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


        $('#barcode_sample').on("change", function() {
            data1 = $('#barcode_sample').val();
l            // ckbar = data1.substring(0,5);
            // ckarray = ["N0-B0-", "N-F0-", "N-P1-", "F-B0-", "F-F0-", "F-P1-",];
            // ckarray = [10, 11, 12];
            // ck = $.inArray(ckbar, ckarray);
            // if (ck == -1) {
            //     tip = $('<span><i class="fa fa-exclamation-triangle"></i> Wrong barcode format !! <strong></br> ex.(N-B0-XXXXXX / F-B0-XXXXXX) </br> (N-F0-XXXXXX / F-F0-XXXXXX) </br> (N-P1-XXXXXX / F-P1-XXXXXX) </strong> </span>');
            //     $('.val1tip').tooltipster('content', tip);
            //     $('.val1tip').tooltipster('show');
            //     $('#barcode_sample').val('');     
            //     $('#barcode_sample').css({'background-color' : '#FFE6E7'});
            //     setTimeout(function(){
            //         $('#barcode_sample').css({'background-color' : '#FFFFFF'});
            //         setTimeout(function(){
            //             $('#barcode_sample').css({'background-color' : '#FFE6E7'});
            //             setTimeout(function(){
            //                 $('#barcode_sample').css({'background-color' : '#FFFFFF'});
            //                 $('#barcode_sample').focus();
            //             }, 300);                            
            //         }, 300);
            //     }, 300);
            // }
            // else {
            $.ajax({
                type: "GET",
                url: "O2b_other_lab/valid_bs?id1="+data1,
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

                        // barcode = data[0].barcode_sample;
                        // console.log(data);
                    }
                }
            });
            // }
            // $('.val1tip').tooltipster('content', 'Barcode :' + $(this).val()+' salah input, seharusnya memakai kode bla bla bla');
            // setTimeout(function(){
            //     $('.val1tip').tooltipster('hide');        
            // }, 5000);
        });

        // $("input").focusout(function(){
        //     if ($('#barcode_sample').val() == ""){
        //         tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode sample <strong> is required !</strong></span>');
        //         $('.val1tip').tooltipster('content', tip);
        //         $('.val1tip').tooltipster('show');
        //         $('#barcode_sample').focus();
        //         // $('.val1tip').tooltipster('hide');   
        //     }
        // });

        $('#id_type2bwat').focus();
        $("#id_type2bwat").change(function(){
            $.post("O2b_other_lab/gen_ctrl", {
                    wtyp:$('#id_type2bwat').val(),
                    rand:Math.random() },
                function(data) {
                    if($('#id_type2bwat').val()=='15' || $('#id_type2bwat').val()=='16' || $('#id_type2bwat').val()=='17') {
                        $('#barcode_sample').css({'background-color' : '#EEEEEE'});
                        // $('#barcode_sample').attr('readonly', true);
                        $('#barcode_sample').val(data[0].new_bar);
                        $('#barcode_rise_lab').focus();
                    } else {
                        $('#barcode_sample').css({'background-color' : '#FFFFFF'});
                        // $('#barcode_sample').attr('readonly', false);
                        // $('#barcode_sample').val('');
                        $('#barcode_sample').focus();
                    }
                });
        });
                
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
            ajax: {"url": "O2b_other_lab/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "sampletype2bwat"},
                {"data": "barcode_nitro"},
                {"data": "barcode_nitro2"},
                {"data": "barcode_microbiology"},
                {"data": "barcode_microbiology2"},
                {"data": "barcode_rise_lab"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> O2B - New water sample<span id="my-another-cool-loader"></span>');
            $('#id_type2bwat').val('').trigger('change');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            $('#barcode_nitro').val('');
            $('#3rdparty_lab').val('').trigger('change');
            $('#barcode_nitro2').val('');
            $('#3rdparty_lab2').val('').trigger('change');
            $('#barcode_microbiology').val('');
            $('#3rdparty_lab3').val('').trigger('change');
            $('#barcode_microbiology2').val('');
            $('#3rdparty_lab4').val('').trigger('change');
            $('#barcode_rise_lab').val('');
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
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> O2B - Update water sample<span id="my-another-cool-loader"></span>');
            $('#id_type2bwat').val(data.id_type2bwat).trigger('change');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#barcode_nitro').val(data.barcode_nitro);
            $('#3rdparty_lab').val(data.rdparty_lab).trigger('change');
            $('#barcode_nitro2').val(data.barcode_nitro2);
            $('#3rdparty_lab2').val(data.rdparty_lab2).trigger('change');
            $('#barcode_microbiology').val(data.barcode_microbiology);
            $('#3rdparty_lab3').val(data.rdparty_lab3).trigger('change');
            $('#barcode_microbiology2').val(data.barcode_microbiology2);
            $('#3rdparty_lab4').val(data.rdparty_lab4).trigger('change');
            $('#barcode_rise_lab').val(data.barcode_rise_lab);
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