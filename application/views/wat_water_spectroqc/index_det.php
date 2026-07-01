<div class="content-wrapper">
	<section class="content">
		<div class="box box-black box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">Water Module - Water Spectro QC Detail</h3>
			</div>
			<form role="form"  id="formKeg" method="post" class="form-horizontal">
				<div class="box-body">
					<input type="hidden" class="form-control " id="id_spec" name="id_spec" value="<?php echo $id_spec ?>">
					<!-- <input id="id_spec" name="id_spec" type="hidden" class="form-control input-sm"> -->

					<div class="form-group">
						<label for="date_spec" class="col-sm-2 control-label">Date Spectro Run</label>
						<div class="col-sm-4">
							<input class="form-control " id="date_spec" name="date_spec" value="<?php echo $date_spec ?>"  disabled>
						</div>

						<label for="avg_result" class="col-sm-2 control-label">Avg result</label>
						<div class="col-sm-4">
							<input class="form-control " id="avg_result" name="avg_result" value="<?php echo $avg_result ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="initial" class="col-sm-2 control-label">Lab Tech</label>
						<div class="col-sm-4">
							<input class="form-control " id="initial" name="initial" value="<?php echo $initial ?>" disabled>
						</div>

						<label for="avg_trueness" class="col-sm-2 control-label">Avg trueness</label>
						<div class="col-sm-4">
							<input class="form-control " id="avg_trueness" name="avg_trueness" value="<?php echo $avg_trueness ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="chem_parameter" class="col-sm-2 control-label">Chemistry Parameter</label>
						<div class="col-sm-4">
							<input class="form-control " id="chem_parameter" name="chem_parameter" value="<?php echo $chem_parameter ?>"  disabled>
						</div>

						<label for="avg_bias" class="col-sm-2 control-label">Avg bias</label>
						<div class="col-sm-4">
							<input class="form-control " id="avg_bias" name="avg_bias" value="<?php echo $avg_bias ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="mixture_name" class="col-sm-2 control-label">Mixture name</label>
						<div class="col-sm-4">
							<input class="form-control " id="mixture_name" name="mixture_name" value="<?php echo $mixture_name ?>"  disabled>
						</div>

						<label for="sd" class="col-sm-2 control-label">SD</label>
						<div class="col-sm-4">
							<input class="form-control " id="sd" name="sd" value="<?php echo $sd ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="sample_no" class="col-sm-2 control-label">Sample number</label>
						<div class="col-sm-4">
							<input class="form-control " id="sample_no" name="sample_no" value="<?php echo $sample_no ?>"  disabled>
						</div>

						<label for="rsd" class="col-sm-2 control-label">%RSD</label>
						<div class="col-sm-4">
							<input class="form-control " id="rsd" name="rsd" value="<?php echo $rsd ?>"  disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="lot_no" class="col-sm-2 control-label">Lot number</label>
						<div class="col-sm-4">
							<input class="form-control " id="lot_no" name="lot_no" value="<?php echo $lot_no ?>"  disabled>
						</div>

						<label for="cv_horwits" class="col-sm-2 control-label">%CV Horwits</label>
						<div class="col-sm-4">
							<input class="form-control " id="cv_horwits" name="cv_horwits" value="<?php echo $cv_horwits ?>"  disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="date_expired" class="col-sm-2 control-label">Date expired</label>
						<div class="col-sm-4">
							<input class="form-control " id="date_expired" name="date_expired" value="<?php echo $date_expired ?>"  disabled>
						</div>

						<label for="cv" class="col-sm-2 control-label">0.67 x %CV</label>
						<div class="col-sm-4">
							<input class="form-control " id="cv" name="cv" value="<?php echo $cv ?>"  disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="cert_value" class="col-sm-2 control-label">Certified Value</label>
						<div class="col-sm-4">
							<input class="form-control " id="cert_value" name="cert_value" value="<?php echo $cert_value ?>"  disabled>
						</div>

						<label for="prec" class="col-sm-2 control-label">Precision</label>
						<div class="col-sm-4">
							<input class="form-control " id="prec" name="prec" value="<?php echo $prec ?>"  disabled>
						</div>
					</div>
					<div class="form-group">
						<label for="uncertainty" class="col-sm-2 control-label">Uncertainty</label>
						<div class="col-sm-4">
							<input class="form-control " id="uncertainty" name="uncertainty" value="<?php echo $uncertainty ?>"  disabled>
						</div>

						<label for="accuracy" class="col-sm-2 control-label">Accuracy</label>
						<div class="col-sm-4">
							<input class="form-control " id="accuracy" name="accuracy" value="<?php echo $accuracy ?>"  disabled>
						</div>
					</div>

					<div class="form-group">
						<label for="notes" class="col-sm-2 control-label">Comments</label>
						<div class="col-sm-4">
							<textarea class="form-control " id="notes" name="notes" disabled><?php echo $notes ?> </textarea>
						</div>

						<label for="bias" class="col-sm-2 control-label">Bias</label>
						<div class="col-sm-4">
							<input class="form-control " id="bias" name="bias" value="<?php echo $bias ?>"  disabled>
						</div>
					</div>

				</div><!-- /.box-body -->
				</form>

				<div class="box-footer">
					<div class="form-group">
						<div class="modal-footer clearfix">
	<!--                                            <button type="submit" name="Save" value="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> -->
							<button type="button" name="print" id="print" class="btn btn-primary" onclick="javascript:void(0);"><i class="fa fa-print"></i> Print</button>
							<button type="button" name="batal" value="batal" class="btn btn-warning" onclick="javascript:history.go(-1);"><i class="fa fa-times"></i> Close</button>
						</div>
					</div>

                <!-- <div class="row"> -->
                    <div class="col-xs-12"> 
                        <div class="box box-primary box-solid">
            
                            <div class="box-header">
                                <h3 class="box-title">Detail Spectro</h3>
                            </div>
							<div class="box-body pad table-responsive">
<?php
							$lvl = $this->session->userdata('id_user_level');
							if ($lvl != 7){
								echo "<button class='btn btn-primary' id='addtombol_det'><i class='fa fa-wpforms' aria-hidden='true'></i> New Data</button>";
							}
?>
							
							<!-- <button class='btn btn-warning' id='addtombol'><i class="fa fa-wpforms" aria-hidden="true"></i> New Data</button> -->
							<table id="example2" class="table display table-bordered table-striped" width="100%">
								<thead>
									<tr>
										<th width="10%">Duplication</th>
										<th>Result</th>
										<th>Trueness</th>
										<th>Bias method</th>
										<th>Result ^2</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
							</div> <!--/.box-body  -->

                        </div><!-- box box-warning -->
                    </div>  <!--col-xs-12 -->
                <!--</div> row -->    
				</div>

		</div>
	</section>
</div>


        <!-- MODAL FORM -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="modal-title-detail">Add Spectro Result<span id="my-another-cool-loader"></span></h4>
                    </div>
                    <form id="formDetail" action=<?php echo site_url('wat_water_spectroqc/savedetail') ?> method="post" class="form-horizontal">
                        <div class="modal-body">
						<div class="form-group">
                                <div class="col-sm-9">
                                    <input id="mode_det" name="mode_det" type="hidden" class="form-control input-sm">
                                    <input id="id_dspec" name="id_dspec" type="hidden" class="form-control input-sm">
									<input id="id_spec2" name="id_spec2" type="hidden" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="duplication" class="col-sm-4 control-label">Duplication</label>
                                <div class="col-sm-8">
                                    <input id="duplication" name="duplication" type="number" step="1"  class="form-control input-sm noEnterSubmit" placeholder="Duplication" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="result" class="col-sm-4 control-label">Result</label>
                                <div class="col-sm-8">
                                    <input id="result" name="result" type="number" step="0.01" placeholder="Result" class="form-control input-sm" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="trueness" class="col-sm-4 control-label">Trueness</label>
                                <div class="col-sm-8">
                                    <input id="trueness" name="trueness" placeholder="Trueness" class="form-control input-sm">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="bias_method" class="col-sm-4 control-label">Bias method</label>
                                <div class="col-sm-8">
                                    <input id="bias_method" name="bias_method" placeholder="Bias method" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="result2" class="col-sm-4 control-label">Result^2</label>
                                <div class="col-sm-8">
                                    <input id="result2" name="result2" placeholder="Result^2" class="form-control input-sm">
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

        <!-- MODAL CONFIRMATION DELETE DETAIL -->
        <div class="modal fade" id="confirm-modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="background-color: #dd4b39; color: white;">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
						<h4 class="modal-title"><i class="fa fa-trash"></i> Detail Spectro | Delete <span id="my-another-cool-loader"></span></h4>
					</div>
					<div class="modal-body">
						<div id="confirmation-content">
							<div class="modal-body">
								<p class="text-center" style="font-size: 15px;">Are you sure you want to delete sample <span id="id" style="font-weight: bold;"></span> ?</p>
							</div>
						</div>
					</div>
					<div class="modal-footer clearfix">
						<button type="button" id="confirm-save-detail" class="btn btn-danger"><i class="fa fa-trash"></i> Yes</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<script type="text/javascript">
	var table
	$(document).ready(function() {

		function showConfirmationDetail(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal-detail').modal('show');
        }

        // Handle the delete detail button click
        $(document).on('click', '.btn_delete_detail', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Wat_water_spectroqc/delete'); ?>/' + id;
            $('#confirm-modal-detail #id').text(id);
            console.log(id);
            showConfirmationDetail(url);
        });

        // When the confirm-save-detail button is clicked
        $('#confirm-save-detail').click(function() {
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
                    $('#confirm-modal-detail').modal('hide');
                    location.reload();
                }
            });
        });

		$('.noEnterSubmit').keypress(function (e) {
			if (e.which == 13) return false;
		});
				// $('#invoice_number').attr('readonly', true);

                // // $("#date_invoice").datepicker({
                // //     format: 'yyyy-mm-dd',
                // //     orientation: "auto",
                // //     autoclose: true
                // // }).datepicker("setDate",'now');;
                                
                // $("#retur").keyup( function() {
                //     var qty = $('#qty').val();
                //     var retur = $('#retur').val();
                //     tot = qty - retur;
                //     $('#tot_qty').val(tot);

                //     var qty = $('#tot_qty').val();
                //     var price = $('#price').val();
                //     tot = qty * price;
                //     $('#total').val(tot);
                // });

                // $("#price").keyup( function() {
                //     var qty = $('#qty').val();
                //     var retur = $('#retur').val();
                //     tot = qty - retur;
                //     $('#tot_qty').val(tot);

                //     var qty = $('#tot_qty').val();
                //     var price = $('#price').val();
                //     tot = qty * price;
                //     $('#total').val(tot);
                // });

                // $('#addtombol').click(function() {
                //     $('#id_delivery_det').val('');
                //     $('#retur').val('0');
                //     $('#price').val('0');
                //     $('#tot_qty').val('0');
                //     $('#totalx').val('0');
                //     $('#id_items').val('').trigger('change');
                //     $('#qty').val('0');
                //     $('#compose-modal').modal('show');
                // });

		// $("#result").change( function() {
		$("#result").keyup( function() {
			$('#trueness').val(($("#result").val() / $("#cert_value").val()) * 100);
			$('#bias_method').val($("#trueness").val() - 100);
			$('#result2').val($("#result").val() * $("#result").val());
		});
						
				
		var id_spec = $('#id_spec').val();
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

		table = $("#example2").DataTable({
			oLanguage: {
				sProcessing: "loading..."
			},
			processing: true,
			serverSide: true,
			paging: false,
			// ordering: false,
			info: false,
			bFilter: false,
			ajax: {"url": "../../wat_water_spectroqc/subjson?id="+id_spec, "type": "POST"},
			columns: [
				// {
				//     "data": "id_delivery_det",
				//     "orderable": false
				// },
				{"data": "duplication"},
				{"data": "result"}, 
				{"data": "trueness"},
				{"data": "bias_method"},
				{"data": "result2"},
				{
					"data" : "action",
					"orderable": false,
					"className" : "text-center"
				}
			],
			order: [[0, 'asc']],
			rowCallback: function(row, data, iDisplayIndex) {
				var info = this.fnPagingInfo();
				var page = info.iPage;
				var length = info.iLength;
				// var index = page * length + (iDisplayIndex + 1);
				// $('td:eq(0)', row).html(index);
			}
		});

		$('#compose-modal').on('shown.bs.modal', function () {
			if ($('#mode_det').val() == 'insert') {
				let table = $('#example2').DataTable(); 
				let rowCount = table.rows().count();
				$('#duplication').val(rowCount+1);
			}
            $('#result').focus();
		});        

		$('#print').click(function() {
			location.href = '../../wat_water_spectroqc/spec_print/'+id_spec;
		});


		$('#addtombol_det').click(function() {
			$('#mode_det').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> New spectro detail<span id="my-another-cool-loader"></span>');
			$('#trueness').attr('readonly', true);
			$('#bias_method').attr('readonly', true);
			$('#result2').attr('readonly', true);
		    $('#id_dspec').val('');
		    $('#id_spec2').val(id_spec);
		    $('#duplication').val('');
		    $('#result').val('');
		    $('#trueness').val('');
			$('#bias_method').val('');
			$('#result2').val('');
			$('#compose-modal').modal('show');
		});


		$('#example2').on('click', '.btn_edit_det', function(){
			let tr = $(this).parent().parent();
			let data = table.row(tr).data();
			console.log(data);
			$('#mode_det').val('edit');
			$('#modal-title').html('<i class="fa fa-pencil-square"></i> Update spectro detail <span id="my-another-cool-loader"></span>');
			$('#trueness').attr('readonly', true);
			$('#bias_method').attr('readonly', true);
			$('#result2').attr('readonly', true);
		    $('#id_dspec').val(data.id_dspec);
		    $('#id_spec2').val(data.id_spec);
		    $('#duplication').val(data.duplication);
		    $('#result').val(data.result);
		    $('#trueness').val(data.trueness);
		    $('#bias_method').val(data.bias_method);
		    $('#result2').val(data.result2);
			$('#compose-modal').modal('show');
		});  

	});
</script>