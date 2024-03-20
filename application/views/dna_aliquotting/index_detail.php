
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DNA Module - DNA Aliquotting Details</h3>
			</div>
		<input type='hidden' id='id_dna' value='<?php echo $id_dna; ?>'>
		<table class='table table-bordered'>        
			<tr>
				<td width='15%' height = '10px'>Date aliquot</td>
				<td width='35%'><?php echo $date_aliquot; ?></td>
			</tr>
	
			<tr>
				<td height = '10px'>Lab tech</td>
				<td><?php echo $initial; ?></td>
			</tr>
	
			<tr>
				<td height = '10px'>Barcode monash</td>
				<td><?php echo $barcode_monash; ?></td>
			</tr>
	
			<tr>
				<td height = '10px'>Barcode cambridge</td>
				<td><?php echo $barcode_cambridge; ?></td>
			</tr>

            <tr>
				<td height = '10px'>Comments</td>
				<td><?php echo $comments; ?></td>
			</tr>
	
			<!-- <tr>
				<td>Receipt</td>
				<td><?php 
					// if (empty($receipt)) {
					// 	$photo = "./img/white.jpg";
					// }
					// else {
					// 	$photo = base_url("assets/receipt/". $receipt);
					// }
					// echo "<img style='width : 400px' id='preview' src='$photo' class='img-thumbnail' alt='Image Receipt'>";
				?></td>
			</tr> -->
	
			<!-- <tr>
				<td>Sj</td>
				<td><?php //echo $sj; ?></td>
			</tr> -->
	
			<!-- <tr>
				<td>Notes</td>
				<td><?php //echo $notes; ?></td>
			</tr> -->
	
			<tr>
				<td height = '10px'></td>
				<td><a href="<?php echo site_url('dna_aliquotting') ?>" class="btn btn-warning">Close</a></td>
			</tr>
	
		</table>
		</div>


        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">New DNA aliquot detail</h3>
                    </div>
                        <div class="box-body">
                        <div style="padding-bottom: 10px;">
<?php
                        $lvl = $this->session->userdata('id_user_level');
                        if ($lvl != 7){
                            echo "<button class='btn btn-danger btn-sm' id='addtombol'> Add DNA aliquot </button>";
                        }
?>                            
                        </div>
                        <table class="table table-bordered table-striped" id="mytable1" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Row</th>
                                    <th>Column</th>
                                    <th>Barcode DNA</th>
                                    <th>Comments</th>
                                    <th width="200px">Action</th>
                                </tr>
                            </thead>
                        
                        </table>
                        </div>
                    </div>
            </div>
            </div>

	</section>


    <!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">Add DNA Aliquot</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('dna_aliquotting/save_detail') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type='hidden' id='mode_det' name='mode_det'>
                            <input type='hidden' id='id_dna' name='id_dna' value='<?php echo $id_dna; ?>'>
                            <input type='hidden' id='id_dna_det' name='id_dna_det' value='<?php echo $id_dna_det; ?>'>
                            <label for="barcode_dna" class="col-sm-4 control-label">Barcode DNA</label>
                            <div class="col-sm-8">
                                <input id="barcode_dna" name="barcode_dna" type="text" class="form-control input-sm" placeholder="Barcode DNA">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comments" class="col-sm-4 control-label">Comments</label>
                            <div class="col-sm-8">
                                <textarea id="comments" name="comments" class="form-control input-sm" placeholder="Comments"> </textarea>
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
                $('#barcode_dna').focus();
            });        

            $('#addtombol').click(function() {
                $('#mode_det').val('insert');
                $('#id_dna_det').val('');
                $('#barcode_dna').val('');
                $('#comments').val('');
                $('#compose-modal').modal('show');
            });
                            
            var id_dna = $('#id_dna').val();
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

            table = $("#mytable1").DataTable({
                // initComplete: function() {
                //     var api = this.api();
                //     $('#mytable_filter input')
                //             .off('.DT')
                //             .on('keyup.DT', function(e) {
                //                 if (e.keyCode == 13) {
                //                     api.search(this.value).draw();
                //         }
                //     });
                // },
                oLanguage: {
                    sProcessing: "loading..."
                },
                processing: true,
                serverSide: true,
                ajax: {"url": "../../dna_aliquotting/subjson?id_dna="+id_dna, "type": "POST"},
                columns: [
                    // {
                    //     "data": "id_dna_det",
                    //     "orderable": false
                    // },
                    {"data": "row_id"},
                    {"data": "column_id"},
                    {"data": "barcode_dna"},
                    {"data": "comments"},
                    {
                        "data" : "action",
                        "orderable": false,
                        "className" : "text-center"
                    }
                ],
                order: [[0, 'desc'], [1, 'desc']],
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    // var index = page * length + (iDisplayIndex + 1);
                    // $('td:eq(0)', row).html(index);
                }
            });

            $('#mytable1').on('click', '.btn_edit', function(){
                let tr = $(this).parent().parent()
                let data = table.row(tr).data()
                console.log(data);
                // var data = this.parents('tr').data();
                $('#mode_det').val('edit');
                $('#modal-title').html('<i class="fa fa-pencil-square"></i> Edit DNA aliquot detail <span id="my-another-cool-loader"></span>');
                $('#id_dna_det').val(data.id_dna_det);
                $('#barcode_dna').val(data.barcode_dna);
                $('#comments').val(data.comments);
                $('#compose-modal').modal('show');
            });    
            
            
            $('#mytable1 tbody').on('click', 'tr', function () {
                if ($(this).hasClass('active')) {
                    $(this).removeClass('active');
                } else {
                    table.$('tr.active').removeClass('active');
                    $(this).addClass('active');
                }
            })   

        });
</script>