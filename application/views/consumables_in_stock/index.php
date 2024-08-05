<div class="content-wrapper">
    <section class="content">
    <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Lab Consumables - In Stock</h3>
                    </div>
                        <div class="box-body">
                            <div style="padding-bottom: 10px;">
                                <?php
                                        $lvl = $this->session->userdata('id_user_level');
                                        if ($lvl != 7){
                                            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> In Stock </button>";
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
                                        <th>Add number of closed containers</th>
                                        <th>Unit of measure counted in the lab</th>
                                        <th>Quantity Measured per Unit</th>
                                        <th>Add number of loose items </th>
                                        <th>Total Quantity</th>
                                        <th>Unit Of Measure</th>
                                        <th>Experied Date</th>
                                        <th>Indonesia Comments</th>
                                        <th>Melbourne Comments</th>
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
                    <h4 class="modal-title" id="modal-title">Consumables - In Stock</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('consumables_in_stock/saveConsumablesInStock') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">

                        <div class="form-group" id="idx">
                            <label for="id_instock" class="col-sm-4 control-label">ID In Stock</label>
                            <div class="col-sm-8">
                                <input id="id_instock" name="id_instock" placeholder="Id In stock" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
							<label for="id" class="col-sm-4 control-label">Product Name</label>
							<div class="col-sm-8" >
								<select id='id' name="id" class="form-control productSelect">
									<option>-- Select testing type --</option>
									<?php
									foreach($productName as $row){
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
						</div>

                        <div class="form-group">
                            <label for="closed_container" class="col-sm-4 control-label">Add number of Closed Containers</label>
                            <div class="col-sm-8">
                                <input id="closed_container" name="closed_container" type="number" class="form-control" placeholder="Add number of Closed Containers" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unit_measure_lab" class="col-sm-4 control-label">Unit of measure counted in the lab</label>
                            <div class="col-sm-8">
                                <input id="unit_measure_lab" name="unit_measure_lab" type="text" class="form-control" placeholder="Unit of measure counted in the lab" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quantity_per_unit" class="col-sm-4 control-label">Quantity Measured per Unit</label>
                            <div class="col-sm-8">
                                <input id="quantity_per_unit" name="quantity_per_unit" type="number" class="form-control" placeholder="Quantity Measured per Unit" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="loose_items" class="col-sm-4 control-label">Add number of loose items </label>
                            <div class="col-sm-8">
                                <input id="loose_items" name="loose_items" type="number" class="form-control" placeholder="Add number of loose items " required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="total_quantity" class="col-sm-4 control-label">Total Quantity (Unit of Measure)</label>
                            <div class="col-sm-8">
                                <input id="total_quantity" name="total_quantity" type="number" class="form-control" placeholder="Total Quantity (Unit of Measure)" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
							<label for="unit_of_measure" class="col-sm-4 control-label">Unit Of Measure</label>
							<div class="col-sm-8" >
								<select id='unit_of_measure' name="unit_of_measure" class="form-control">
									<option>-- Select testing type --</option>
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
							</div>
						</div> -->

                        <div class="form-group">
                            <label for="unit_of_measure" class="col-sm-4 control-label">Unit of Measure</label>
                            <div class="col-sm-8">
                                <input id="unit_of_measure" name="unit_of_measure" type="text" class="form-control" placeholder="Unit of Measure" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
							<label for="expired_date" class="col-sm-4 control-label">Experied Date</label>
							<div class="col-sm-8">
								<input id="expired_date" name="expired_date" type="date" class="form-control" placeholder="Experied date" value="<?php echo date("Y-m-d"); ?>">
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
</div>


<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">



    var table;
    var rowNum = 1;
    $(document).ready(function() {

        $('.productSelect').change(function() {
            var productId = $(this).val(); // Mendapatkan ID produk yang dipilih
            if (productId) {
                $.ajax({
                    url: '<?php echo site_url('Consumables_in_stock/getProductDetails'); ?>', // URL untuk request AJAX
                    type: 'POST',
                    data: { productId: productId }, // Data yang dikirim ke server
                    dataType: 'json', // Format data yang diharapkan dari server
                    success: function(response) {
                        // Mengisi field 'unit_of_measure' dengan nilai yang diterima dari server
                        $('#unit_of_measure').val(response.unit_of_measure || '');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        // Menangani error jika terjadi kesalahan dalam request
                        console.error('AJAX error:', textStatus, errorThrown);
                        $('#unit_of_measure').val(''); // Kosongkan field jika ada error
                    }
                });
            } else {
                $('#unit_of_measure').val(''); // Kosongkan jika tidak ada produk yang dipilih
            }
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

        // Fungsi untuk menghitung total quantity
        function calculateTotalQuantity() {
            var closedContainer = parseFloat($('#closed_container').val()) || 0;
            var quantityPerUnit = parseFloat($('#quantity_per_unit').val()) || 0;
            var looseItems = parseFloat($('#loose_items').val()) || 0;
            var totalQuantity = (closedContainer * quantityPerUnit) + looseItems;
            $('#total_quantity').val(totalQuantity);
        }

        // Panggil fungsi calculateTotalQuantity setiap kali nilai input berubah
        $('#closed_container, #quantity_per_unit, #loose_items').on('input', function() {
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
            ajax: {"url": "consumables_in_stock/jsonInStock", "type": "POST"},
            columns: [
                {"data": "id_instock"},
                {"data": "product_name"},
                {"data": "closed_container"},
                {"data": "unit_measure_lab"},
                {"data": "quantity_per_unit"},
                {"data": "loose_items"},
                {"data": "total_quantity"},
                {"data": "unit_of_measure"},
                {"data": "expired_date"},
                {"data": "indonesia_comments"},
                {"data": "melbourne_comments"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Consumables - In Stock <span id="my-another-cool-loader"></span>');
            $('#idx').hide();
            $('#id').val('');
            $('#closed_container').val('');
            $('#unit_measure_lab').val('');
            $('#quantity_per_unit').val('');
            $('#loose_items').val('');
            $('#total_quantity').attr('readonly', true);
            $('#unit_of_measure').attr('readonly', true);
            $('#indonesia_comments').val('');
            $('#melbourne_comments').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Consumables - Update Product<span id="my-another-cool-loader"></span>');
            $('#id_instock').attr('readonly', true);
            $('#idx').hide();
            $('#id_instock').val(data.id_instock);
            	
            // Set the value of the dropdown based on the testing_type
				$('#id option').each(function() {
					if ($(this).text() === data.product_name) {
						$(this).prop('selected', true);
					}
				});
            $('#closed_container').val(data.closed_container);
            $('#unit_measure_lab').val(data.unit_measure_lab);
            $('#quantity_per_unit').val(data.quantity_per_unit);
            $('#loose_items').val(data.loose_items);
            $('#total_quantity').val(data.total_quantity);
            $('#total_quantity').attr('readonly', true);
            $('#unit_of_measure').val(data.unit_of_measure);
            $('#unit_of_measure').attr('readonly', true);
            $('#expired_date').val(data.expired_date).trigger('change');
            $('#indonesia_comments').val(data.indonesia_comments);
            $('#melbourne_comments').val(data.melbourne_comments);
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