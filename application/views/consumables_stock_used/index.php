<div class="content-wrapper">
    <section class="content">
    <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Lab Consumables - In Stock</h3>
                    </div>
                    <form role="form"  id="formKegHidden" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input class="form-control " id="id_stock" type="hidden"  value="<?php echo $id_stock ?>"  disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="box-body">
                            <div style="padding-bottom: 10px;">
                                <?php
                                        $lvl = $this->session->userdata('id_user_level');
                                        if ($lvl != 7){
                                            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New In Stock </button>";
                                        }
                                ?>
                                <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
                                <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
                                <?php echo anchor(site_url('consumables_stock_used/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID In Stock</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit</th>
                                        <th>Quantity Per Unit</th>
                                        <th>Unit of Measure</th>
                                        <!-- <th>Used</th> -->
                                        <th>Minimum Stock</th>
                                        <th>Item Description</th>
                                        <th>Date Collected</th>
                                        <th>Comments</th>
                                        <!-- <th>Time Collected </th> -->
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
                    <h4 class="modal-title" id="modal-title">Consumables - Stock Used</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('consumables_stock_used/saveConsumablesStockUsed') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">

                        <div class="form-group" id="idx">
                            <label for="idx_stock" class="col-sm-4 control-label">ID In Stock</label>
                            <div class="col-sm-8">
                                <input id="idx_stock" name="idx_stock" placeholder="Id stock Used" type="text" class="form-control">
                            </div>
                        </div>

                        <!-- <div class="form-group">
							<label for="id" class="col-sm-4 control-label">Product Name</label>
							<div class="col-sm-8" >
								<select id='id' name="id" class="form-control productSelect">
									<option>-- Select testing type --</option>
									<?php
									foreach($product as $row){
										if ($id == $row['id']) {
											echo "<option value='".$row['id']."' selected='selected'>".$row['product_name']."</option>";
										}
										else {
											echo "<option value='".$row['id']."'>".$row['product_name']."</option>";
										}
									}
										?>
								</select>
							</div>
						</div> -->

                        <div class="form-group">
                            <label for="product_name" class="col-sm-4 control-label">Product Name</label>
                            <div class="col-sm-8">
                                <input id="product_name" name="product_name" type="text" class="form-control" placeholder="Product Name" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quantity" class="col-sm-4 control-label">Quantity</label>
                            <div class="col-sm-8">
                                <input id="quantity" name="quantity" type="number" class="form-control" placeholder="Quantity" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
							<label for="unit_of_measure" class="col-sm-4 control-label">Unit</label>
							<div class="col-sm-8" >
								<select id='unit_of_measure' name="unit_of_measure" class="form-control">
									<option>-- Select Unit --</option>
									<?php
									foreach($product as $row){
										if ($unit_of_measure == $row['unit_of_measure']) {
											echo "<option value='".$row['unit_of_measure']."' selected='selected'>".$row['unit_of_measure']."</option>";
										}
										else {
											echo "<option value='".$row['unit_of_measure']."'>".$row['unit_of_measure']."</option>";
										}
									}
										?>
								</select>
							</div>
						</div> -->

                        <div class="form-group">
                            <label for="unit" class="col-sm-4 control-label">Unit</label>
                            <div class="col-sm-8">
                                <input id="unit" name="unit" type="text" class="form-control" placeholder="Unit (ex. bottle)" required>
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
                            <label for="unit_of_measure" class="col-sm-4 control-label">Unit of Measure</label>
                            <div class="col-sm-8">
                                <input id="unit_of_measure" name="unit_of_measure" type="text" class="form-control" placeholder="Unit (ex. grams)" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="used" class="col-sm-4 control-label">Used</label>
                            <div class="col-sm-8">
                                <input id="used" name="used" type="number" class="form-control" placeholder="Used" required>
                                <div class="val1tip"></div>
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="n_campaigns" class="col-sm-4 control-label">N Campaigns</label>
                            <div class="col-sm-8">
                                <input id="n_campaigns" name="n_campaigns" type="text" class="form-control" placeholder="N Campaigns" required>
                                <div class="val1tip"></div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="minimum_stock" class="col-sm-4 control-label">Minimum Stock</label>
                            <div class="col-sm-8">
                                <input id="minimum_stock" name="minimum_stock" type="number" class="form-control" placeholder="Minimum Stock" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
							<label for="date_collected" class="col-sm-4 control-label">Date product collected</label>
							<div class="col-sm-8">
								<input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Date sample collected" value="<?php echo date("Y-m-d"); ?>">
							</div>
						</div>

						<!-- <div class="form-group">
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
						</div> -->

                        <div class="form-group">
                            <label for="item_description" class="col-sm-4 control-label">Item Description</label>
                            <div class="col-sm-8">
                                <textarea id="item_description" name="item_description" class="form-control" placeholder="Item Description"> </textarea>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="comments" class="col-sm-4 control-label">Comment</label>
                            <div class="col-sm-8">
                                <textarea id="comments" name="comments" class="form-control" placeholder="Comment"> </textarea>
                                <div class="val1tip"></div>
                            </div>
                        </div>


                        <!-- <div class="form-group">
                            <label for="id_person" class="col-sm-4 control-label">Lab Tech</label>
                            <div class="col-sm-8">
                            <select id='id_person' name="id_person" class="form-control">
                                <option select disabled>-- Select lab tech --</option>
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
                            <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required>
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
                            <label for="id_type" class="col-sm-4 control-label">Sample Type</label>
                            <div class="col-sm-8">
                            <select id='id_type' name="id_type" class="form-control">
                                <option>-- Select sample type --</option>
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
                            <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required>
                            </div>
                        </div> -->
                        
                        <!-- 
                        <div class="form-group">
                            <label for="png_control" class="col-sm-4 control-label">P&G Control</label>
                            <div class="col-sm-8">
                            <select id='png_control' name="png_control" class="form-control">
                                <option select disabled>-- Select answer --</option>
								<option value='Yes'>Yes</option>
								<option value='No'>No</option>
                            </select>
                            <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required>
                            </div>
                        </div> -->

                        <!-- <div class="form-group">
								  <label for="cold_chain" class="col-sm-4 control-label">Cold Chain</label>
								  <div class="col-sm-8">
									<select class="form-control" id="cold_chain" name="cold_chain" required>
                                    <option select disabled>-- Select cold chain --</option>
									<?php
                                    echo "<option value='1. Most gel packs frozen solids' >1. Most gel packs frozen solids</option>
                                          <option value='2. Most gel packs partially frozen/mushy' >2. Most gel packs partially frozen/mushy</option> 
                                          <option value='3. Most gel packs entirely liquid contents' >3. Most gel packs entirely liquid contents</option>";
									?>
									</select>
								  </div>
						</div>			 -->

						<!-- <div class="form-group">
								  <label for="cont_intact" class="col-sm-4 control-label">Container - leaks or breakage</label>
								  <div class="col-sm-8">
									<select class="form-control" id="cont_intact" name="cont_intact" required>
                                    <option select disabled>-- Select answer --</option>
									<?php
                                    echo "<option value='Y' >Yes</option>
                                          <option value='N' >No</option> ";
									?>
									</select>
								  </div>
						</div> -->

                        <!-- <div class="form-group">
                                    <label for="comments" class="col-sm-4 control-label">Comments</label>
                                    <div class="col-sm-8">
                                        <textarea id="comments" name="comments" class="form-control" placeholder="Comments"> </textarea>
                                    </div>
                        </div> -->

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
    </div>
    <!-- END MODAL -->

    <!-- MODAL CONFIRMATION DELETE -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dd4b39; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i>  In Stock | Delete <span id="my-another-cool-loader"></span></h4>
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
    .highlight {
        background-color: rgba(0, 255, 0, 0.1) !important;
        font-weight: bold !important;
    }
    .highlight-edit {
        background-color: rgba(0, 0, 255, 0.1) !important;
        font-weight: bold !important;
    }
</style>


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table;
    var rowNum = 1;
    let id_stock = $('#id_stock').val();
    $(document).ready(function() {

        // $('.productSelect').change(function() {
        //     var productId = $(this).val(); // get ID by selected
       
        //     if (productId) {
        //         $.ajax({
        //             url: '<?php echo site_url('Consumables_stock_used/getProductDetails'); ?>',
        //             type: 'POST',
        //             data: {productId: productId},
        //             dataType: 'json',
        //             success: function(response) {
        //                 $('#unit_of_measure').val(response.unit_of_measure || '');
        //             },
        //             error: function(jqXHR, textStatus, errorThrown) {
        //                 console.error('AJAX error:', textStatus, errorThrown);
        //                 $('#unit_of_measure').val(''); // Kosongkan field jika ada error
        //             }
        //         });
        //     } else {
        //         $('#unit_of_measure').val('');
        //     }
        // });

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('consumables_stock_used/deleteConsumablesStockUsed'); ?>/' + id;
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
            $('#product_name').focus(); 
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
            ajax: {"url": "consumables_stock_used/jsonStockUsed", "type": "POST"},
            columns: [
                {"data": "id_stock"},
                {"data": "product_name"},
                {"data": "quantity"},
                {"data": "unit"},
                {"data": "quantity_per_unit"},
                {"data": "unit_of_measure"},
                // {"data": "used"},
                // {"data": "n_campaigns"},
                {"data": "minimum_stock"},
                {"data": "item_description"},
                {"data": "date_collected"},
                {"data": "comments"},
				// {"data": "time_collected"},
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
            // order: [[0, 'desc']],
            // rowCallback: function(row, data, iDisplayIndex) {
            //     var info = this.fnPagingInfo();
            //     var page = info.iPage;
            //     var length = info.iLength;
            //     var index = page * length + (iDisplayIndex + 1);
            //     $('td:eq(0)', row).html(index); // Menetapkan nomor urut ke kolom pertama
            // },
            drawCallback: function(settings) {
                let api = this.api();
                let pageInfo = api.page.info();
                
                // Highlight baris yang baru saja ditambahkan atau diperbarui
                api.rows().every(function() {
                    let data = this.data();
                    let createdDate = new Date(data.date_created);
                    let updatedDate = new Date(data.date_updated);
                    let now = new Date();

                    // Highlight jika baru ditambahkan atau diperbarui dalam 10 detik terakhir
                    if (now - createdDate < 10 * 1000) {
                        $(this.node()).addClass('highlight');
                    } else if (now - updatedDate < 10 * 1000) {
                        $(this.node()).addClass('highlight-edit');
                    }
                });
                
                // Pastikan baris pertama di-highlight jika tabel tidak kosong
                // if (pageInfo.page === 0 && api.rows().count() > 0) {
                //     let firstRow = api.row(0).node();
                //     $(firstRow).addClass('highlight');
                // }
            }
        });

        // Event handler for click to table row
        $('#mytable tbody').on('click', 'tr', function() {
            let rowData = table.row(this).data();
            let rowId = rowData.id_stock;
            $(this).removeClass('highlight');
            $(this).removeClass('highlight-edit');
        });


        $('#addtombol').click(function() {
            $('.val1tip').tooltipster('hide');   
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Consumables - Insert In Stock <span id="my-another-cool-loader"></span>');
            $('#idx_stock').val(id_stock);
            $('#idx_stock').attr('readonly', true);
            // $('#idx').hide();
            $('#product_name').val('');
            // $('#id').val('');
            $('#quantity').val('');
            // $('#unit_of_measure').attr('readonly', true);
            $('#unit').val('');
            $('#quantity_per_unit').val('');
            $('#unit_of_measure').val('');
            // $('#used').val('');
            // $('#n_campaigns').val('');
            $('#item_description').val('');
            $('#comments').val('');
            $('#minimum_stock').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Consumables - Update In Stock<span id="my-another-cool-loader"></span>');
            $('#idx_stock').attr('readonly', true);
            $('#idx_stock').val(data.id_stock);
            // $('#id_stock').attr('readonly', true);
            // $('#idx').hide();
            $('#id_stock').val(data.id_stock);
            	
            // Set the value of the dropdown based on the testing_type
				// $('#id option').each(function() {
				// 	if ($(this).text() === data.product_name) {
				// 		$(this).prop('selected', true);
				// 	}
				// });
            $('#product_name').val(data.product_name);
            $('#quantity').val(data.quantity);
            $('#unit').val(data.unit);
            $('#quantity_per_unit').val(data.quantity_per_unit);
            $('#unit_of_measure').val(data.unit_of_measure);
            // $('#used').val(data.used);
            // $('#unit_of_measure').attr('readonly', true);
            // $('#n_campaigns').val(data.n_campaigns);
            $('#item_description').val(data.item_description);
            $('#comments').val(data.comments);
            $('#minimum_stock').val(data.minimum_stock);
            $('#date_collected').val(data.date_collected).trigger('change');
            // $('#time_collected').val(data.time_collected).trigger('change');
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