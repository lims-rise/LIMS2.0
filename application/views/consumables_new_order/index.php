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
                                <?php echo anchor(site_url('controller/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Order Qty</th>
                                        <th>Unit Order</th>
                                        <th>Qty Per Unit</th>
                                        <th>Unit Of Measure</th>
                                        <th>Total Qty Order</th>
                                        <th>Vendor</th>
                                        <th>Date Ordered</th>
                                        <!-- <th>Time Ordered </th> -->
                                        <th>Remaining Qty</th>
                                        <th>Qty Received</th>
                                        <th>Order Status</th>
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
							<div class="col-sm-8 .stockSelect-container">
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
                            <label for="quantity_ordering" class="col-sm-4 control-label">Order Quantity</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group1">
                                    <input id="quantity_ordering" name="quantity_ordering" type="number" class="form-control" placeholder="Order Quantity" required>
                                   <input id="unit_ordering" name="unit_ordering" type="text" class="form-control" placeholder="Unit" required>
                                </div>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="quantity_ordering" class="col-sm-4 control-label">Order Quantity</label>
                            <div class="col-sm-8">
                                <input id="quantity_ordering" name="quantity_ordering" type="number" class="form-control" placeholder="Order Quantity" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unit_ordering" class="col-sm-4 control-label">Unit Order</label>
                            <div class="col-sm-8">
                                <input id="unit_ordering" name="unit_ordering" type="text" class="form-control" placeholder="Unit Order" required>
                                <div class="val1tip"></div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="quantity_per_unit" class="col-sm-4 control-label">Quantity Per Unit</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group1">
                                    <input id="quantity_per_unit" name="quantity_per_unit" type="number" class="form-control" placeholder="Quantity Per Unit" required>
                                   <input id="unit_of_measure" name="unit_of_measure" type="text" class="form-control" placeholder="Unit" required>
                                </div>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="quantity_per_unit" class="col-sm-4 control-label">Quantity Per Unit</label>
                            <div class="col-sm-8">
                                <input id="quantity_per_unit" name="quantity_per_unit" type="number" class="form-control" placeholder="Quantity Per Unit" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unit_of_measure" class="col-sm-4 control-label">Unit Of Measure</label>
                            <div class="col-sm-8">
                                <input id="unit_of_measure" name="unit_of_measure" type="text" class="form-control" placeholder="Unit Of Measure" required>
                                <div class="val1tip"></div>
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="total_quantity_ordered" class="col-sm-4 control-label">Total Quantity Order</label>
                            <div class="col-sm-8">
                                <input id="total_quantity_ordered" name="total_quantity_ordered" type="number" class="form-control" placeholder="Total Quantity Order" required>
                                <div class="val1tip"></div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="total_quantity_ordered" class="col-sm-4 control-label">Total Quantity Order</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group1">
                                    <input id="total_quantity_ordered" name="total_quantity_ordered" type="number" class="form-control" placeholder="Total Quantity Order" required>
                                    <input id="unit_of_measure1" class="form-control unit-of-measure" disabled>
                                </div>
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
                            <label for="vendor" class="col-sm-4 control-label">Vendor</label>
                            <div class="col-sm-8">
                                <input id="vendor" name="vendor" type="text" class="form-control" placeholder="Vendor" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
							<label for="date_ordered" class="col-sm-4 control-label">Date ordered</label>
							<div class="col-sm-8">
								<input id="date_ordered" name="date_ordered" type="date" class="form-control" placeholder="Date ordered" value="<?php echo date("Y-m-d"); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="time_ordered" class="col-sm-4 control-label">Time ordered</label>
							<div class="col-sm-8">
								<div class="input-group clockpicker">
									<input id="time_ordered" name="time_ordered" class="form-control" placeholder="Time ordered" value="<?php 
									$datetime = new DateTime();
									echo $datetime->format( 'H:i' );
									?>">
									<span class="input-group-addon">
									<span class="glyphicon glyphicon-time"></span>
									</span>
								</div>
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

    <!-- MODAL CONFIRMATION DELETE -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dd4b39; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i>  Stock Order | Delete <span id="my-another-cool-loader"></span></h4>
                </div>
                <div class="modal-body">
                    <div id="confirmation-content">
                        <div class="modal-body">
                            <p class="text-center" style="font-size: 15px;">Are you sure you want to delete ID <span id="id" style="font-weight: bold;"></span> ?</p>
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

<style>

    .container {
        display: flex;
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        width: auto;
    }

    .btn-transparent-green {
        background-color: rgba(0, 255, 0, 0.1);
        border: none;
        color: green;
        padding: 2px 5px;
        border-radius: 10px;
        cursor: default;
        font-weight: bold;
        width: 50%;
    }

    .btn-transparent-red {
        background-color: rgba(255, 0, 0, 0.1);
        border: none;
        color: red;
        padding: 2px 5px;
        border-radius: 10px;
        cursor: default;
        font-weight: bold;
        width: 50%;
    }
    
    .btn-status-Completed {
        background-color: #98DED3;
        border: none;
        color: white;
        border-radius: 10px;
    }

    .btn-status-Uncompleted {
        background-color: #DE5B7B;
        border: none;
        color: white;
        border-radius: 10px;
    }

    .container {
        margin: 0;
        padding: 0;
    }
    
    .input-group1 {
        display: flex;
        align-items: center; /* Vertically center align items */
    }

    .input-group1 .form-control {
        margin: 0; /* Remove default margins */
    }

    .input-group1 .total-quantity {
        flex: 3; /* Take up more space */
        margin-right: -1px; /* Adjust spacing to ensure no extra gap */
    }

    .input-group1 .unit-of-measure {
        flex: 1; /* Take up less space */
        width: 100px; /* Adjust width as needed */
        text-align: center; /* Center text */
        border-left: 0; /* Remove border on the left to avoid double borders */
    }

    .form-control.stockSelect {
        width: 100% !important; /* Mengatur lebar elemen select */
    }
    .chosen-container {
        width: 100% !important; /* Mengatur lebar container Chosen */
    }
    .chosen-container-single .chosen-single {
        width: 100% !important; /* Mengatur lebar untuk dropdown tunggal */
    }
    .chosen-container-multi .chosen-choices {
        width: 100% !important; /* Mengatur lebar untuk dropdown multi */
    }

</style>
<!-- Chosen CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table;
    var rowNum = 1;
    $(document).ready(function() {
        $('.stockSelect').chosen({
            placeholder_text_single: "-- Select testing type --",
            no_results_text: "No results matched"
        });
        $('.chosen-container').each(function() {
            $(this).css('width', '100%');
        });
        
        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('consumables_new_order/deleteConsumablesOrder'); ?>/' + id;
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
                    $('#unit_of_measure1').val(response.unit_of_measure || '');
                    $('#quantity_per_unit').val(response.quantity_per_unit || '');
                    calculateTotalQuantity();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                    $('#unit_ordering').val('');
                    $('#unit_of_measure').val('');
                    $('#unit_of_measure1').val('');
                    $('#quantity_per_unit').val('');
                }
            });
            $('#unit_ordering').val('');
            $('#unit_of_measure').val('');
            $('#unit_of_measure1').val('');
            $('#quantity_per_unit').val('');
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

        $('#quantity_per_unit').on('change', function() {
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

        $('#compose-modal').on('hide.bs.modal', function () {
            // Bersihkan form
            $('#formSample').find('input, textarea').val('');
            
            // Bersihkan nilai yang dipilih dalam select
            $('#formSample select').val(null);
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
                {"data": "unit_of_measure"},
                {"data": "total_quantity_ordered"},
                {"data": "vendor"},
                {"data": "date_ordered"},
				// {"data": "time_ordered"},
                {"data": "remaining_quantity"},
                {"data": "received"},
                {"data": "status"},
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
            $('#id_stock').change(function() {
                let selectedProduct = $(this).val(); // Get the selected product value
                if (selectedProduct) {
                    $('#quantity_ordering').attr('readonly', false); // Enable field
                } else {
                    $('#quantity_ordering').attr('readonly', true);// Disable field
                }
            });
            $('.val1tip').tooltipster('hide');   
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Consumables - New Order <span id="my-another-cool-loader"></span>');
            $('#idx').hide();
            // $('#product_id').val('');
            $('#id_stock').val('');
            $('#quantity_ordering').val('');
            $('#quantity_ordering').attr('readonly', true);
            $('#unit_ordering').val('');
            $('#unit_ordering').attr('readonly', true);
            $('#quantity_per_unit').val('');
            $('#quantity_per_unit').attr('readonly', true);
            $('#total_quantity_ordered').attr('readonly', true);
            $('#total_quantity_ordered').val('');
            $('#unit_of_measure').val('');
            $('#unit_of_measure').attr('readonly', true);
            $('#unit_of_measure1').val('');
            $('#unit_of_measure1').attr('readonly', true);
            $('#vendor').val('');
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

            // Pastikan untuk memperbarui Chosen setelah memilih opsi
            $('#id_stock').trigger('chosen:updated');
            $('#quantity_ordering').val(data.quantity_ordering);
            $('#quantity_ordering').attr('readonly', false);
            $('#unit_ordering').val(data.unit_ordering);
            $('#unit_ordering').attr('readonly', true);
            $('#quantity_per_unit').val(data.quantity_per_unit);
            $('#quantity_per_unit').attr('readonly', true);
            $('#total_quantity_ordered').val(data.total_quantity_ordered);
            $('#total_quantity_ordered').attr('readonly', true);
            $('#total_quantity').val(data.total_quantity);
            $('#total_quantity').attr('readonly', true);
            $('#unit_of_measure').val(data.unit_of_measure);
            $('#unit_of_measure1').val(data.unit_of_measure);
            $('#unit_of_measure').attr('readonly', true);
            $('#vendor').val(data.vendor);
            $('#date_ordered').val(data.date_ordered).trigger('change');
            $('#time_ordered').val(data.time_ordered).trigger('change');
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