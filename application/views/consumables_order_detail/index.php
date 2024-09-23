<div class="content-wrapper">
    <section class="content">
    <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Lab Consumables - Order Detail</h3>
                    </div>
                    <form role="form" id="formKeg" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="id_order" class="col-sm-4 control-label">ID Order</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="id_order" name="id_order" value="<?php echo $id_order ?>" disabled>
                                            <input class="form-control" id="id_name" type="hidden" name="id_name" value="<?php echo $this->session->userdata('full_name'); ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity_ordering" class="col-sm-4 control-label">Quantity Order</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="quantity_ordering" name="quantity_ordering" value="<?php echo $quantity_ordering ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity_per_unit" class="col-sm-4 control-label">Quantity Per Unit</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="quantity_per_unit" name="quantity_per_unit" value="<?php echo $quantity_per_unit ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="total_quantity_ordered" class="col-sm-4 control-label">Total Quantity Ordered</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="total_quantity_ordered" name="total_quantity_ordered" value="<?php echo $total_quantity_ordered ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_ordered" class="col-sm-4 control-label">Date Ordered</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="date_ordered" name="date_ordered" value="<?php echo $date_ordered ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="form-group">
                                        <label for="product_name" class="col-sm-4 control-label">Product Name</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="product_name" name="product_name" value="<?php echo $product_name ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_ordering" class="col-sm-4 control-label">Unit Order</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="unit_ordering" name="unit_ordering" value="<?php echo $unit_ordering ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="unit_of_measure" class="col-sm-4 control-label">Unit Of Measure</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="unit_of_measure" name="unit_of_measure" value="<?php echo $unit_of_measure ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="time_ordered" class="col-sm-4 control-label">Time Ordered</label>
                                        <div class="col-sm-8">
                                            <input class="form-control" id="time_ordered" name="time_ordered" value="<?php echo $time_ordered ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="box-body">
                            <div style="padding-bottom: 10px;">
                                
                                <?php
                                        $lvl = $this->session->userdata('id_user_level');
                                        if ($lvl != 7) {
                                            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> Recieved </button>";
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
                                        <!-- <th>Order Name</th> -->
                                        <!-- <th>Order Number</th> -->
                                        <!-- <th>Ordered</th> -->
                                        <th>Name Received</th>
                                        <th>Amount Received</th>
                                        <th>Status Received</th>
                                        <th>Unit Reference</th>
                                        <th>Date Received</th>
                                        <th>Date Received</th>
                                        <th>Contact Supplier</th>
                                        <th>Comments</th>
                                        <!-- <th>Progress</th> -->
                                        <!-- <th>Time Collected </th> -->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                    <div class="form-group">
					<div class="modal-footer clearfix">
	<!--                     <button type="submit" name="Save" value="simpan" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button> -->
							<!-- <button type="button" name="excel" id="excel" class="btn btn-success" onclick="location.href='<?php //echo site_url('Water_sample_reception/excel_print'); ?>';"><i class="fa fa-file-excel-o"></i> Excel</button> -->
							<!-- <button type="button" name="excel" id="excel" class="btn btn-success" onclick="javascript:void(0);"><i class="fa fa-file-excel-o"></i> Excel</button>
							<button type="button" name="print" id="print" class="btn btn-primary" onclick="javascript:void(0);"><i class="fa fa-print"></i> Print</button> -->
                            <button type="button" name="batal" value="batal" class="btn btn-warning" onclick="window.location.href='<?= site_url('consumables_new_order'); ?>';">
							<i class="fa fa-times"></i> Close
						</button>
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
                    <h4 class="modal-title" id="modal-title">Consumables - Order Detail</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('consumables_order_detail/saveConsumablesOrderDetail') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <div class="form-group" id="hiddenField">
                                <div class="col-sm-9">
                                    <input id="mode" name="mode" type="hidden" class="form-control input-sm">
									<input id="idx_order" name="idx_order" type="hidden" class="form-control input-sm">
                                    <input id="unit_reference1" name="unit_reference1" type="hidden" class="form-control input-sm">
                                    <input id="progress1" name="progress1" type="hidden" class="form-control input-sm">
                                </div>
                        </div>
                        <div class="form-group" id="idx">
                            <label for="id_orderdetail" class="col-sm-4 control-label">ID Order Detail</label>
                            <div class="col-sm-8">
                                <input id="id_orderdetail" name="id_orderdetail" placeholder="Id Order Detail" type="text" class="form-control">
                            </div>
                        </div>

                        <!-- <div class="form-group">
							<label for="id_neworder" class="col-sm-4 control-label">Order Name</label>
							<div class="col-sm-8" >
								<select id='id_neworder' name="id_neworder" class="form-control">
									<option>-- Select Order Name --</option>
									<?php
									foreach($newOrder as $row){
										if ($id_neworder == $row['id_neworder']) {
											echo "<option value='".$row['id_neworder']."' selected='selected'>".$row['product_name']."</option>";
										}
										else {
											echo "<option value='".$row['id_neworder']."'>".$row['product_name']."</option>";
										}
									}
										?>
								</select>
							</div>
						</div> -->

                        <!-- <div class="form-group">
                            <label for="order_number" class="col-sm-4 control-label">Order Number</label>
                            <div class="col-sm-8">
                                <input id="order_number" name="order_number" type="text" class="form-control" placeholder="Order Number" required>
                                <div class="val1tip"></div>
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="ordered" class="col-sm-4 control-label">Ordered</label>
                            <div class="col-sm-8">
                                <select id="ordered" name="ordered" class="form-control">
                                    <option value="">-- Select Ordered --</option>
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="name_received" class="col-sm-4 control-label">Name Received</label>
                            <div class="col-sm-8">
                                <input id="name_received" name="name_received" type="text" class="form-control" placeholder="Name Received" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="amount_received" class="col-sm-4 control-label">Amount Received</label>
                            <div class="col-sm-8">
                                <input id="amount_received" name="amount_received" type="number" class="form-control" placeholder="Amount Received" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="received" class="col-sm-4 control-label">Status Received</label>
                            <div class="col-sm-8">
                                <select id="received" name="received" class="form-control">
                                    <option value="">-- Select Received --</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Partial">Partial</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unit_reference" class="col-sm-4 control-label">Unit Reference</label>
                            <div class="col-sm-8">
                                <input id="unit_reference" name="unit_reference" type="text" class="form-control" placeholder="Unit Reference"  disabled>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
							<label for="date_received" class="col-sm-4 control-label">Date Received</label>
							<div class="col-sm-8">
								<input id="date_received" name="date_received" type="date" class="form-control" placeholder="Date Received" value="<?php echo date("Y-m-d"); ?>">
							</div>
						</div>

                        <div class="form-group">
							<label for="time_received" class="col-sm-4 control-label">Time Received</label>
							<div class="col-sm-8">
								<div class="input-group clockpicker">
									<input id="time_received" name="time_received" class="form-control" placeholder="Time Received" value="<?php 
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
							<label for="contact_supplier_progress" class="col-sm-4 control-label">Contact Supplier</label>
							<div class="col-sm-8">
								<input id="contact_supplier_progress" name="contact_supplier_progress" type="text" class="form-control" placeholder="Contact Supplier" required>
							</div>
						</div>

                        <div class="form-group">
                            <label for="comments" class="col-sm-4 control-label">Comments</label>
                            <div class="col-sm-8">
                                <textarea id="comments" name="comments" class="form-control" placeholder="Comments"></textarea>
                            </div>
                        </div>

                        <!-- <div class="form-group">
							<label for="progress" class="col-sm-4 control-label">Progress</label>
							<div class="col-sm-8">
								<input id="progress" name="progress" type="text" class="form-control" placeholder="Progress" disabled>
							</div>
						</div> -->

                        <!-- <div class="form-group">
							<label for="date_received" class="col-sm-4 control-label">Date received</label>
							<div class="col-sm-8">
								<input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date received" value="<?php echo date("Y-m-d"); ?>">
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
    </div>
    <!-- END MODAL -->
    
    <!-- MODAL CONFIRMATION DELETE -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dd4b39; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i>  Order Detail | Delete <span id="my-another-cool-loader"></span></h4>
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


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    let table;
    let rowNum = 1;
    let idName = $('#id_name').val();
    $(document).ready(function() {

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('consumables_order_detail/deleteConsumablesOrderDetail'); ?>/' + id;
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


        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        $("#compose-modal").on('shown.bs.modal', function(){
            $('#amount_received').focus(); 
        });

        


        let id_order = $('#id_order').val();
        console.log(id_order);
        let quantityPerUnit = $('#quantity_per_unit').val();
        let unitOfMeasure = $('#unit_of_measure').val();
        let unitOrdering = $('#unit_ordering').val();
        let result = quantityPerUnit + unitOfMeasure + '/' + unitOrdering;
        $('#unit_reference1').val(result);
        $('#unit_reference').val(result);





        var base_url = location.hostname;
        // $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
        // {
        //     return {
        //         "iStart": oSettings._iDisplayStart,
        //         "iEnd": oSettings.fnDisplayEnd(),
        //         "iLength": oSettings._iDisplayLength,
        //         "iTotal": oSettings.fnRecordsTotal(),
        //         "iFilteredTotal": oSettings.fnRecordsDisplay(),
        //         "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        //         "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        //     };
        // };

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
            ajax: {"url": "../../consumables_order_detail/jsonOrderDetail?id2="+ id_order, "type": "POST"},
            // ajax: {"url": "../../Water_sample_reception/subjson2?id2="+ sample_id, "type": "POST"},
            columns: [
                {"data": "id_orderdetail"},
                // {"data": "product_name"},
                // {"data": "order_number"},
                // {"data": "ordered"},
                {"data": "name_received"},
                {"data": "amount_received"},
                {"data": "received"},
                {"data": "unit_reference"},
                {"data": "date_received"},
                {"data": "time_received"},
                {"data": "contact_supplier_progress"},
                {"data": "comments"},
                // {"data": "progress"},
                // {"data": "date_collected"},
				// {"data": "time_collected"},
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            order: [[1, 'desc']],
            // initComplete: function(settings, json) {
            //     // Dapatkan informasi paging dari tabel
            //     var pageInfo = this.api().fnPagingInfo();

            //     // Jika jumlah baris ditampilkan lebih dari 0, maka sembunyikan tombol Order Detail
            //     if (pageInfo.iTotal > 0) {
            //         $('#addtombol').hide();
            //     } else {
            //         $('#addtombol').show();
            //     }
            // }
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index); // Menetapkan nomor urut ke kolom pertama
                // if (info.iTotal > 0) {
                //     $('#addtombol').hide();
                // } else {
                //     $('#addtombol').show();
                // }
            }
        });

    


        $('#addtombol').click(function() {
            $('.val1tip').tooltipster('hide');   
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Consumables - New Received <span id="my-another-cool-loader"></span>');
            $('#hiddenField').hide();
            $('#idx').hide();
            $('#idx_order').val(id_order); // Assuming sample_id is defined somewhere
            // $('#order_number').val('');
            // $('#ordered').val('');
            // $('#ordered').on('change', function() {
            // var orderedItem = $('#ordered').val();
            // if (orderedItem == 1) {
            //     $('#progress').val('Done');
            //     $('#progress1').val('Done');
            // } else {
            //     $('#progress').val('Not Done');
            //     $('#progress1').val('Not Done');
            // }
            $('#name_received').val(idName);
            $('#name_received').attr('readonly', true);
            $('#received').val('');
            $('#amount_received').val('');
            $('#unit_reference1').val(result);
            $('#contact_supplier_progress').val('');
            $('#comments').val('');
            // $('#progress').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Consumables - Update Received <span id="my-another-cool-loader"></span>');
            $('#id_orderdetail').attr('readonly', true);
            $('#idx').hide();
            $('#id_orderdetail').val(data.id_orderdetail);
            	
            // Set the value of the dropdown based on the testing_type
				// $('#id_neworder2 option').each(function() {
				// 	if ($(this).text() === data.product_name) {
				// 		$(this).prop('selected', true);
				// 	}
				// });

            // $('#ordered').on('change', function() {
            // var orderedItem = $('#ordered').val();
            // if (orderedItem == 1) {
            //     $('#progress').val('Done');
            //     $('#progress1').val('Done');
            // } else {
            //     $('#progress').val('Not Done');
            //     $('#progress1').val('Not Done');
            // }
            // });
            $('#idx_order').val(data.id_order);
            // $('#order_number').val(data.order_number);
            // $('#ordered').val(data.ordered);
            $('#name_received').val(data.name_received);
            $('#received').val(data.received);
            $('#amount_received').val(data.amount_received);
            // $('#amount_received').val(data.amount_received);
            $('#unit_reference1').val(data.unit_reference);
            $('#date_received').val(data.date_received).trigger('change');
            $('#time_received').val(data.time_received).trigger('change');
            $('#contact_supplier_progress').val(data.contact_supplier_progress);
            $('#comments').val(data.comments);
            // $('#progress').val(data.progress);
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