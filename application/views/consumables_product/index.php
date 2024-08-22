<div class="content-wrapper">
    <section class="content">
    <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Lab Consumables - Consumables</h3>
                    </div>
        
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <?php
                                    $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 7){
                                        echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Consumables </button>";
                                    }
                            ?>
                            <?php //echo anchor(site_url('tbl_delivery/new'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Delivery', 'class="btn btn-danger btn-sm"'); ?>
                            <?php //echo anchor(site_url('tbl_delivery/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> New Sample', 'class="btn btn-danger btn-sm"'); ?>
                            <?php //echo anchor(site_url('o3_sample_reception/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                        </div>
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Unit of Measure</th>
                                        <!-- <th>Units</th> -->
                                        <th>Item Description</th>
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
                    <h4 class="modal-title" id="modal-title">Consumables - New Product</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('consumables_product/saveConsumablesProduct') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">

                        <div class="form-group" id="idx">
                            <label for="id" class="col-sm-4 control-label">ID Product</label>
                            <div class="col-sm-8">
                                <input id="id" name="id" placeholder="Project ID" type="text" class="form-control">
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="product_name" class="col-sm-4 control-label">Product Name</label>
                            <div class="col-sm-8">
                                <input id="product_name" name="product_name" type="text" class="form-control" placeholder="Product Name" required>
                                <div class="val1tip"></div>
                            </div>
                        </div> -->
                        
                        <div class="form-group">
							<label for="id" class="col-sm-4 control-label">Product Name</label>
							<div class="col-sm-8" >
								<select id='id_stock' name="id_stock" class="form-control stockSelect">
									<option>-- Select testing type --</option>
									<?php
									foreach($stock as $row){
										if ($id == $row['id_stock']) {
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
                            <label for="quantity" class="col-sm-4 control-label">Quantity</label>
                            <div class="col-sm-8">
                                <input id="quantity" name="quantity" type="number" class="form-control" placeholder="Quantity" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="unit_of_measure" class="col-sm-4 control-label">Unit of Measure</label>
                            <div class="col-sm-8">
                                <input id="unit_of_measure" name="unit_of_measure" type="text" class="form-control" placeholder="Unit of Measure" required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <!-- <div class="form-group">
                            <label for="units" class="col-sm-4 control-label">Units</label>
                            <div class="col-sm-8">
                                <input id="units" name="units" type="text" class="form-control" placeholder="Units" required>
                                <div class="val1tip"></div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <label for="item_description" class="col-sm-4 control-label">Item Description</label>
                            <div class="col-sm-8">
                                <input id="item_description" name="item_description" type="text" class="form-control" placeholder="Item Description" required>
                                <div class="val1tip"></div>
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
        

        $('.stockSelect').change(function() {
            var idStock = $(this).val(); // get ID by selected
       
            if (idStock) {
                $.ajax({
                    url: '<?php echo site_url('Consumables_product/getStockDetails'); ?>',
                    type: 'POST',
                    data: {idStock: idStock},
                    dataType: 'json',
                    success: function(response) {
                        $('#unit_of_measure').val(response.unit_of_measure || '');
                        $('#item_description').val(response.item_description || '');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        $('#unit_of_measure').val(''); // Kosongkan field jika ada error
                        $('#item_description').val(''); // Kosongkan field jika ada error
                    }
                });
            } else {
                $('#unit_of_measure').val('');
                $('#item_description').val('');
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
            ajax: {"url": "consumables_product/jsonProduct", "type": "POST"},
            columns: [
                {"data": "id"},
                {"data": "product_name"},
                {"data": "quantity"},
                {"data": "unit_of_measure"},
                // {"data": "units"},
                {"data": "item_description"},
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
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Consumables - New Product<span id="my-another-cool-loader"></span>');
            $('#idx').hide();
            $('#id_stock').val('');
            // $('#product_name').val('');
            $('#unit_of_measure').val('');
            $('#item_description').val('');
            $('#quantity').val('');
            // $('#units').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Consumables - Update Product<span id="my-another-cool-loader"></span>');
            $('#idx').hide();
            $('#id').val(data.id);
            $('#id').attr('readonly', true);
            // $('#product_name').val(data.product_name);

            // Set the value of the dropdown based on the testing_type
				$('#id_stock option').each(function() {
					if ($(this).text() === data.product_name) {
						$(this).prop('selected', true);
					}
				});

            $('#unit_of_measure').val(data.unit_of_measure);
            $('#quantity').val(data.quantity);
            // $('#units').val(data.units);
            $('#item_description').val(data.item_description);
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