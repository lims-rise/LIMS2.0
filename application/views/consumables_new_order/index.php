<div class="content-wrapper">
    <section class="content">
    <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Lab Consumables - Order</h3>
                    </div>

                        <div class="box-body">
                            <div style="padding-bottom: 10px;">
                                <?php
                                        $lvl = $this->session->userdata('id_user_level');
                                        if ($lvl != 7){
                                            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Order </button>";
                                        }
                                ?>
                                <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
                                <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
                                <?php //echo anchor(site_url('o3_sample_reception/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Quantity Order</th>
                                        <th>Unit Order</th>
                                        <th>Quantity Per Unit</th>
                                        <th>Total Quantity Order</th>
                                        <th>Unit Of Measure</th>
                                        <th>Vendor</th>
                                        <th>Indonesia Comments</th>
                                        <th>Melbourne Comments</th>
                                        <th>Order Decision</th>
                                        <th>Date Collected</th>
                                        <th>Time Collected </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
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

    <!-- START MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">Consumables - New Order</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('consumables_new_order/saveConsumablesOrder') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">

                        <div class="form-group" id="idx">
                            <label for="id_neworder" class="col-sm-4 control-label">ID New Order</label>
                            <div class="col-sm-8">
                                <input id="id_neworder" name="id_neworder" placeholder="Id New Order" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
							<label for="id_stock" class="col-sm-4 control-label">Product Name</label>
							<div class="col-sm-8" >
								<select id='id_stock' name="id_stock" class="form-control stockSelect">
									<option>-- Select testing type --</option>
									<?php
									foreach($stockName as $row){
										if ($id_stock == $row['id_stock']) {
											echo "<option value='".$row['id_stock']."' selected='selected'>".$row['product_name']."</option>";
										}
										else {
											echo "<option value='".$row['id_stock']."'>".$row['product_name']."</option>";
										}
									}
										?>
								</select>
							</div>
						</div>

                        <div class="form-group">
                            <label for="quantity_ordering" class="col-sm-4 control-label">Quantity Order</label>
                            <div class="col-sm-8">
                                <input id="quantity_ordering" name="quantity_ordering" type="number" class="form-control" placeholder="Quantity Order" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unit_ordering" class="col-sm-4 control-label">Unit Order</label>
                            <div class="col-sm-8">
                                <input id="unit_ordering" name="unit_ordering" type="text" class="form-control" placeholder="Unit Order" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quantity_per_unit" class="col-sm-4 control-label">Quantity Per Unit</label>
                            <div class="col-sm-8">
                                <input id="quantity_per_unit" name="quantity_per_unit" type="number" class="form-control" placeholder="Quantity Per Unit" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="total_quantity_ordered" class="col-sm-4 control-label">Total Quantity Order</label>
                            <div class="col-sm-8">
                                <input id="total_quantity_ordered" name="total_quantity_ordered" type="number" class="form-control" placeholder="Total Quantity Order" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="unit_of_measure" class="col-sm-4 control-label">Unit Of Measure</label>
                            <div class="col-sm-8" >
                                <select id='unit_of_measure' name="unit_of_measure" class="form-control" required>
                                    <option value="">-- Select Unit Of Measure --</option>
                                    <?php
                                    foreach($productName as $row){
                                        if ($unit_of_measure == $row['unit_of_measure']) {
                                            echo "<option value='".$row['unit_of_measure']."' selected='selected'>".$row['unit_of_measure']."</option>";
                                        }
                                        else {
                                            echo "<option value='".$row['unit_of_measure']."'>".$row['unit_of_measure']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <div class="val1tip"></div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="unit_of_measure" class="col-sm-4 control-label">Unit Of Measure</label>
                            <div class="col-sm-8">
                                <input id="unit_of_measure" name="unit_of_measure" type="text" class="form-control" placeholder="Unit Of Measure" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="vendor" class="col-sm-4 control-label">Vendor</label>
                            <div class="col-sm-8">
                                <input id="vendor" name="vendor" type="text" class="form-control" placeholder="Vendor" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="order_decision" class="col-sm-4 control-label">Order Decision</label>
                            <div class="col-sm-8">
                                <select id="order_decision" name="order_decision" class="form-control">
                                    <option value="">-- Select Order Decision --</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="NA">NA</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
							<label for="date_collected" class="col-sm-4 control-label">Date product collected</label>
							<div class="col-sm-8">
								<input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date sample collected" value="<?php echo date("Y-m-d"); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="time_collected" class="col-sm-4 control-label">Time product collected</label>
							<div class="col-sm-8">
								<div class="input-group clockpicker">
									<input id="time_collected" name="time_collected" class="form-control" placeholder="Time sample collected" value="<?php 
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
                            <label for="indonesia_comments" class="col-sm-4 control-label">Indonesia Comment</label>
                            <div class="col-sm-8">
                                <textarea id="indonesia_comments" name="indonesia_comments" class="form-control" placeholder="Indonesia Comment"> </textarea>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="melbourne_comments" class="col-sm-4 control-label">Melbourne Comment</label>
                            <div class="col-sm-8">
                                <textarea id="melbourne_comments" name="melbourne_comments" class="form-control" placeholder="Melbourne Comment"> </textarea>
                                <div class="val1tip"></div>
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
    </div>
    <!-- END MODAL -->
</div>


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table;
    var rowNum = 1;
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

        $('#id_stock').change(function() {
            console.log('Selected value:', $(this).val());
        });

        // Fungsi untuk menghitung total quantity
        function calculateTotalQuantity() {
            var quantityOrdering = parseFloat($('#quantity_ordering').val()) || 0;
            var quantityPerUnit = parseFloat($('#quantity_per_unit').val()) || 0;
            var totalQuantityOrdered = (quantityOrdering * quantityPerUnit);
            $('#total_quantity_ordered').val(totalQuantityOrdered);
        }

        // Panggil fungsi calculateTotalQuantity setiap kali nilai input berubah
        $('#quantity_ordering, #quantity_per_unit, #total_quantity_ordered').on('input', function() {
            calculateTotalQuantity();
        });

        // Inisialisasi clockpicker
        $('.clockpicker').clockpicker({
            autoclose: true
        });


        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        $('.stockSelect').change(function() {
            var idStock = $(this).val();
            $.ajax({
                url: '<?php echo site_url('Consumables_new_order/getStockDetails'); ?>',
                type: 'POST',
                data: { idStock: idStock },
                dataType: 'json',
                success: function(response) {
                    $('#unit_ordering').val(response.unit || '');
                    $('#unit_of_measure').val(response.unit_of_measure || '');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    $('#unit_ordering').val('');
                    $('#unit_of_measure').val('');
                }
            });
            $('#unit_ordering').val('');
            $('#unit_of_measure').val('');
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
            processing: true,
            serverSide: true,
            ajax: {"url": "consumables_new_order/jsonOrder", "type": "POST"},
            columns: [
                {"data": "id_order"},
                {"data": "product_name"},
                {"data": "quantity_ordering"},
                {"data": "unit_ordering"},
                {"data": "quantity_per_unit"},
                {"data": "total_quantity_ordered"},
                {"data": "unit_of_measure"},
                {"data": "vendor"},
                {"data": "indonesia_comments"},
                {"data": "melbourne_comments"},
                {"data": "order_decision"},
                {"data": "date_collected"},
				{"data": "time_collected"},
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            order: [[1, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index); // Menetapkan nomor urut ke kolom pertama
            }
        });


        $('#addtombol').click(function() {
            $('.val1tip').tooltipster('hide');   
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Consumables - New Order <span id="my-another-cool-loader"></span>');
            $('#idx').hide();
            // $('#product_id').val('');
            $('#id_stock').val('');
            $('#quantity_ordering').val('');
            $('#unit_ordering').val('');
            $('#unit_ordering').attr('readonly', true);
            $('#quantity_per_unit').val('');
            $('#total_quantity_ordered').attr('readonly', true);
            $('#total_quantity_ordered').val('');
            $('#unit_of_measure').val('');
            $('#unit_of_measure').attr('readonly', true);
            $('#vendor').val('');
            $('#indonesia_comments').val('');
            $('#melbourne_comments').val('');
            $('#order_decision').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Consumables - Update New Order <span id="my-another-cool-loader"></span>');
            // $('#id_neworder').attr('readonly', true);
            // $('#id_neworder').val(data.id_neworder);
            $('#idx').hide();
            $('#id_order').val(data.id_order);
            $('#id_order').attr('readonly', true);
            	
            // Set the value of the dropdown based on the testing_type
				$('#id_stock option').each(function() {
					if ($(this).text() === data.product_name) {
						$(this).prop('selected', true);
					}
				});
            $('#quantity_ordering').val(data.quantity_ordering);
            $('#unit_ordering').val(data.unit_ordering);
            $('#quantity_per_unit').val(data.quantity_per_unit);
            $('#total_quantity_ordered').val(data.total_quantity_ordered);
            $('#total_quantity').val(data.total_quantity);
            $('#unit_of_measure').val(data.unit_of_measure);
            $('#vendor').val(data.vendor);
            $('#indonesia_comments').val(data.indonesia_comments);
            $('#melbourne_comments').val(data.melbourne_comments);
            $('#order_decision').val(data.order_decision);
            $('#date_collected').val(data.date_collected).trigger('change');
            $('#time_collected').val(data.time_collected).trigger('change');
            $('#compose-modal').modal('show');
        }); 

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }
        })  
    });

</script>