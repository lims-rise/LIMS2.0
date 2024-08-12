<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DNA Module - DNA Sample Control</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
<?php
        $lvl = $this->session->userdata('id_user_level');
        if ($lvl != 7){
            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New DNA Control </button>";
        }
?>
        
		<?php echo anchor(site_url('dna_sample_control/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
		    <th>Barcode sample</th>
		    <th>Sample type</th>
		    <th>Barcode vessel</th>
		    <th>Barcode vessel2</th>
		    <th>Barcode vessel3</th>
		    <th>Barcode vessel4</th>
		    <th>Barcode vessel5</th>
		    <!-- <th>Comments</th> -->
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
                    <h4 class="modal-title" id="modal-title">DNA - New DNA Control</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('dna_sample_control/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <div class="form-group">
                            <label for="barcode_sample" class="col-sm-4 control-label">Barcode sample</label>
                            <div class="col-sm-8">
                                <input id="barcode_sample" name="barcode_sample" type="text" class="form-control" placeholder="Barcode Sample" required>
                                <!-- <div class="val1tip"></div> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_sample" class="col-sm-4 control-label">Sample Type</label>
                            <div class="col-sm-8">
                            <select id='id_sample' name="id_sample" class="form-control">
                                <option>-- Select sample type --</option>
                                <?php
                                foreach($dnatype as $row){
									if ($id_sample == $row['id_sample']) {
										echo "<option value='".$row['id_sample']."' selected='selected'>".$row['sample']."</option>";
									}
									else {
                                        echo "<option value='".$row['id_sample']."'>".$row['sample']."</option>";
                                    }
                                }
                                    ?>
                            </select>
                            <!-- <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required> -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_vessel" class="col-sm-4 control-label">Barcode vessel</label>
                            <div class="col-sm-8">
                                <input id="barcode_vessel" name="barcode_vessel" type="text" class="form-control" placeholder="Barcode vessel" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_vessel2" class="col-sm-4 control-label">Barcode vessel 2</label>
                            <div class="col-sm-8">
                                <input id="barcode_vessel2" name="barcode_vessel2" type="text" class="form-control" placeholder="Barcode vessel 2" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_vessel3" class="col-sm-4 control-label">Barcode vessel 3</label>
                            <div class="col-sm-8">
                                <input id="barcode_vessel3" name="barcode_vessel3" type="text" class="form-control" placeholder="Barcode vessel 3" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_vessel4" class="col-sm-4 control-label">Barcode vessel 4</label>
                            <div class="col-sm-8">
                                <input id="barcode_vessel4" name="barcode_vessel4" type="text" class="form-control" placeholder="Barcode vessel 4" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="barcode_vessel5" class="col-sm-4 control-label">Barcode vessel 5</label>
                            <div class="col-sm-8">
                                <input id="barcode_vessel5" name="barcode_vessel5" type="text" class="form-control" placeholder="Barcode vessel 5" required>
                            </div>
                        </div>


<!-- 
                        <div class="form-group">
                            <label for="sample_type" class="col-sm-4 control-label">Sample Type</label>
                            <div class="col-sm-8">
                                <input id="sample_type" name="sample_type" type="text" class="form-control" placeholder="Sample Type" required>
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="id_type" class="col-sm-4 control-label">Sample Type</label>
                            <div class="col-sm-8">
                            <select id='sample_type' name="sample_type" class="form-control">
                                <option>-- Select answer --</option>
                                <option value='Human Stool (Control)' >Human Stool (Control)</option>
                                <option value='MacConkey (Control)' >MacConkey (Control)</option>
                                <option value='Water (Control)' >Water (Control)</option>
                                <option value='Bootsocks (Control)' >Bootsocks (Control)</option>
                                <option value='Soil (Control)' >Soil (Control)</option>
                                <option value='Animal Stool (Control)' >Animal Stool (Control)</option>                            
                            </select>
                            </div>
                        </div> -->

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

</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table
    $(document).ready(function() {

        $('#compose-modal').on('shown.bs.modal', function () {
            // $('#barcode_sample').val('');     
            $('#barcode_sample').focus();
        });        
                
        $('#id_sample').on("change", function() {
            var data1 = parseInt($('#id_sample').val(), 10);
            $('#barcode_vessel2').val('');
            $('#barcode_vessel3').val('');
            $('#barcode_vessel4').val('');
            $('#barcode_vessel5').val('');

            if ([4, 8, 12, 16, 20].includes(data1)) {
                $('#barcode_vessel2').attr('readonly', false);
                $('#barcode_vessel3').attr('readonly', false);
                $('#barcode_vessel4').attr('readonly', false);
                $('#barcode_vessel5').attr('readonly', false);
            }
            else {
                $('#barcode_vessel2').attr('readonly', true);
                $('#barcode_vessel3').attr('readonly', true);
                $('#barcode_vessel4').attr('readonly', true);
                $('#barcode_vessel5').attr('readonly', true);
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
            ajax: {"url": "dna_sample_control/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },
                {"data": "barcode_sample"},
                {"data": "sample"},
                {"data": "barcode_vessel"},
                {"data": "barcode_vessel2"},
                {"data": "barcode_vessel3"},
                {"data": "barcode_vessel4"},
                {"data": "barcode_vessel5"},
                // {"data": "comments"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> DNA - New DNA Control<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', false);
            $('#barcode_sample').val('');
            // $("#date_receipt").datepicker("setDate",'now');
            // $('#time_receipt').timepicker('setTime', new Date());
            $('#barcode_vessel').val('');
            $('#barcode_vessel2').val('');
            $('#barcode_vessel2').attr('readonly', true);
            $('#barcode_vessel3').val('');
            $('#barcode_vessel3').attr('readonly', true);
            $('#barcode_vessel4').val('');
            $('#barcode_vessel4').attr('readonly', true);
            $('#barcode_vessel5').val('');
            $('#barcode_vessel5').attr('readonly', true);
            $('#id_sample').val('');
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
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> DNA - Update DNA Control<span id="my-another-cool-loader"></span>');
            $('#barcode_sample').attr('readonly', true);
            $('#barcode_sample').val(data.barcode_sample);
            $('#barcode_vessel').val(data.barcode_vessel);
            $('#barcode_vessel2').val(data.barcode_vessel2);
            $('#barcode_vessel3').val(data.barcode_vessel3);
            $('#barcode_vessel4').val(data.barcode_vessel4);
            $('#barcode_vessel5').val(data.barcode_vessel5);
            $('#id_sample').val(data.id_sample).trigger('change');
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