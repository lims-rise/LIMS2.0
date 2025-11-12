<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DNA Module - DNA Nanopore Analysis</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New DNA Nanopore Analysis </button>";
        }
?>
        
		<?php echo anchor(site_url('DNA_nanopore_analysis/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode DNA</th>
		    <th>Date analysis</th>
		    <th>Lab tech</th>
		    <th>Barcode ID</th>
		    <th>Run Number</th>
		    <th>Comment</th>
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
                    <h4 class="modal-title" id="modal-title">DNA - New DNA Nanopore Analysis</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('DNA_nanopore_analysis/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_dna" class="col-sm-4 control-label">Barcode DNA</label>
                            <div class="col-sm-8">
                                <input id="barcode_dna" name="barcode_dna" type="text" class="form-control" placeholder="Barcode DNA" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date_analysis" class="col-sm-4 control-label">Date analysis</label>
                            <div class="col-sm-8">
                                <input id="date_analysis" name="date_analysis" type="date" class="form-control" placeholder="Date analysis" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Lab Tech</label>
                            <div class="col-sm-8">
                            <select id='id_person' name="id_person" class="form-control">
                                <option value='' selected disabled>Select lab tech</option>
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
                            <label for="barcode_id" class="col-sm-4 control-label">Barcode ID</label>
                            <div class="col-sm-8">
                            <select class="form-control" id="barcode_id" name="barcode_id" required>
									<?php
                                    echo "<option value='' selected disabled>Select barcode ID</option>";
                                
                                    for ($i = 1; $i <= 96; $i++) : ?>
                                        <!-- Use sprintf to format the value with leading zeros -->
                                        <option value='<?php echo "Barcode" . sprintf('%02d', $i); ?>'>
                                            <?php echo "Barcode" . sprintf('%02d', $i); ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                                <div class="val2tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="run_number" class="col-sm-4 control-label">Run Number</label>
                            <div class="col-sm-8">
                                <input id="run_number" name="run_number" type="text" class="form-control" placeholder="Run Number" required>
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="comment" class="col-sm-4 control-label">Comment</label>
                                <div class="col-sm-8">
                                    <textarea id="comment" name="comment" class="form-control" placeholder="Comment"> </textarea>
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

    <!-- MODAL CONFIRMATION DELETE -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dd4b39; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i> DNA Nanopore Analysis | Delete <span id="my-another-cool-loader"></span></h4>
                </div>
                <div class="modal-body">
                    <div id="confirmation-content">
                        <div class="modal-body">
                            <p class="text-center" style="font-size: 15px;">Are you sure you want to delete sample <span id="id" style="font-weight: bold;"></span> ?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer clearfix">
                    <button type="button" id="confirm-save" class="btn btn-danger"><i class="fa fa-trash"></i> Yes</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
                </div>
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

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('DNA_nanopore_analysis/delete'); ?>/' + id;
            $('#confirm-modal #id').text(id);
            console.log(id);
            showConfirmation(url);
        });

        // When the confirm-save button is clicked
        $('#confirm-save').click(function() {
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        alert(response.message);
                    } else {
                        alert(response.message);
                    }
                },
                complete: function() {
                    $('#confirm-modal').modal('hide');
                    location.reload();
                }
            });
        });
        
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
        // $('#barcode_sample').click(function() {
        //     $('.val1tip').tooltipster('hide');   
        // // $('#barcode_sample').val('');     
        // });

        $('.col-sm-8').click(function() {
            $('.val1tip, .val2tip').tooltipster('hide');   
            // $('#barcode_dna').val('');     
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip, .val2tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        // function loadSType(data1) {
        //     $.ajax({
        //         type: "GET",
        //         url: "DNA_nanopore_analysis/get_dna_type?id1="+data1,
        //         // data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             // var barcode = '';
        //             if (data.length > 0) {
        //                 $('#stype').val(data[0].sampletype);     
        //             }
        //             else {
        //                 tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode DNA <strong> ' + data1 +'</strong> is not found in the system !</span>');
        //                 $('.val1tip').tooltipster('content', tip);
        //                 $('.val1tip').tooltipster('show');
        //                 $('#barcode_dna').focus();
        //                 $('#barcode_dna').val('');     
        //                 $('#stype').val('');     
        //                 $('#barcode_dna').css({'background-color' : '#FFE6E7'});
        //                 setTimeout(function(){
        //                     $('#barcode_dna').css({'background-color' : '#FFFFFF'});
        //                     setTimeout(function(){
        //                         $('#barcode_dna').css({'background-color' : '#FFE6E7'});
        //                         setTimeout(function(){
        //                             $('#barcode_dna').css({'background-color' : '#FFFFFF'});
        //                         }, 300);                            
        //                     }, 300);
        //                 }, 300);

        //                 // barcode = data[0].barcode_sample;
        //                 // console.log(data);
        //             }
        //         }
        //     });            
        // }
        // $('#barcode_dna').on("change", function() {
        //     data1 = $('#barcode_dna').val();
        // });

        $('#barcode_dna').on("change", function() {
            data1 = $('#barcode_dna').val();
//            loadSType(data1);
            $.ajax({
                type: "GET",
                url: "DNA_nanopore_analysis/valid_bs?id1="+data1,
                // data:data1,
                dataType: "json",
                success: function(data) {
                    // var barcode = '';
                    // console.log(data);
                    if (data.length == 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode DNA <strong> ' + data1 +'</strong> is invalid !</span>');
                        $('.val1tip').tooltipster('content', tip);
                        $('.val1tip').tooltipster('show');
                        $('#barcode_dna').focus();
                        $('#barcode_dna').val('');     
                        // $('#stype').val('');     
                        $('#barcode_dna').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_dna').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_dna').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_dna').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);

                        // barcode = data[0].barcode_sample;
                        // console.log(data);
                    }
                }
            });
            // $('.val1tip').tooltipster('content', 'Barcode :' + $(this).val()+' salah input, seharusnya memakai kode bla bla bla');
            // setTimeout(function(){
            //     $('.val1tip').tooltipster('hide');        
            // }, 5000);
        });

        // $('#barcode_id').on("click", function() {
        $("#barcode_id").change(function(){
            data1 = $('#barcode_dna').val();
            data2 = $('#barcode_id').val();
            $.ajax({
                type: "GET",
                url: "DNA_nanopore_analysis/valid_bid?id1="+data1+"&id2="+data2,
                dataType: "json",
                success: function(data) {
                    if (data.length != 0) {
                        tip = $('<span><i class="fa fa-exclamation-triangle"></i> Barcode ID <strong> ' + data2 +'</strong> for Barcode DNA <strong> ' + data1 +'</strong> is already in the system !</span>');
                        $('.val2tip').tooltipster('content', tip);
                        $('.val2tip').tooltipster('show');
                        $('#barcode_id').focus();
                        $('#barcode_id').val('');     
                        // $('#stype').val('');     
                        $('#barcode_id').css({'background-color' : '#FFE6E7'});
                        setTimeout(function(){
                            $('#barcode_id').css({'background-color' : '#FFFFFF'});
                            setTimeout(function(){
                                $('#barcode_id').css({'background-color' : '#FFE6E7'});
                                setTimeout(function(){
                                    $('#barcode_id').css({'background-color' : '#FFFFFF'});
                                }, 300);                            
                            }, 300);
                        }, 300);
                    }
                }
            });
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

        // $("input").keypress(function(){
        //     // $('#barcode_sample').val('');     
        //     $('.val1tip').tooltipster('hide');   
        // });

        // $('#analysis_type').on("click", function() {
        //     data1 = $('#barcode_dna').val();
        //     data2 = $('#analysis_type').val();
        //     $.ajax({
        //         type: "GET",
        //         url: "DNA_nanopore_analysis/valid_asys?id1="+data1+"&id2="+data2,
        //         // data:data1,
        //         dataType: "json",
        //         success: function(data) {
        //             // console.log(data);
        //             // var barcode = '';
        //             $('#run_number').val(data[0].run);
        //             // if (data.length > 0) {
        //             //     $('#run_number').val(data[0].run);
        //             // }
        //         }
        //     });
        // });


        $('#compose-modal').on('shown.bs.modal', function () {
            // $('#barcode_sample').val('');     
            $('#barcode_dna').focus();
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
            ajax: {"url": "DNA_nanopore_analysis/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_dna"},
                {"data": "date_analysis"},
                {"data": "initial"},
                {"data": "barcode_id"},
                {"data": "run_number"},
                {"data": "comment"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> DNA - New DNA Nanopore Analysis<span id="my-another-cool-loader"></span>');
            $('#barcode_dna').attr('readonly', false);
            $('#barcode_dna').val('');
            $('#id_person').val('');
            $('#barcode_id').val('');
            $('#run_number').val('');
            $('#comment').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            $('.val1tip').tooltipster('hide');   
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            // var data = this.parents('tr').data();
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> DNA - Update DNA Nanopore Analysis<span id="my-another-cool-loader"></span>');
            $('#barcode_dna').attr('readonly', true);
            $('#barcode_dna').val(data.barcode_dna);
            $('#date_analysis').val(data.date_analysis);
            $('#id_person').val(data.id_person).trigger('change');
            $('#barcode_id').val(data.barcode_id).trigger('change');
            $('#run_number').val(data.run_number);
            $('#comment').val(data.comment);
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