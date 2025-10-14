<div class="content-wrapper">
    <section class="content">
    <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Lab Consumables - Stock Take</h3>
                    </div>
                    <form role="form"  id="formKegHidden" method="post" class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="col-sm-4">
                                    <input class="form-control " id="id_instock" type="hidden"  value="<?php echo $id_instock ?>"  disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                        <div class="box-body">
                            <div style="padding-bottom: 10px;">
                                <?php
                                        $lvl = $this->session->userdata('id_user_level');
                                        if ($lvl != 7){
                                            echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Stock Take </button>";
                                        }
                                ?>
                                <?php echo anchor(site_url('consumables_in_stock/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?>
                            </div>
                            <div class="table-responsive">
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID stock take</th>
                                        <th>Objective</th>
                                        <th>Product name</th>
                                        <th>Number of closed containers</th>
                                        <th>Quantity Used</th>
                                        <th>Unit of measure counted in the lab</th>
                                        <th>Quantity measured per unit</th>
                                        <th>Unit of measure</th>
                                        <th>Number of loose items </th>
                                        <th>Total quantity</th>
                                        <th>Collection date</th>
                                        <th>Collection time</th>
                                        <th>Comments</th>
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
                        <input id="id_stock1" name="id_stock1" type="hidden" class="form-control input-sm">

                        <div class="form-group" id="idx">
                            <label for="idx_instock" class="col-sm-4 control-label">ID Stock Take</label>
                            <div class="col-sm-8">
                                <input id="idx_instock" name="idx_instock" placeholder="Id Stock Take" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_objective" class="col-sm-4 control-label">Objective</label>
                            <div class="col-sm-4">
                                <?php foreach ($objectives as $row): ?>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="id_objective[]" class="idObjectiveSelect" value="<?php echo $row['id_objective']; ?>"> <?php echo $row['objective']; ?>
                                            <input type="hidden" name="id_objective1[]" class="idObjectiveSelect1" value="<?php echo $row['id_objective']; ?>">
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="id_stock" class="col-sm-4 control-label">Product Name</label>
                            <div class="col-sm-8">
                                <select id="id_stock" name="id_stock" class="form-control stockSelect">
                                    <option value="">-- Select Product Name --</option>
                                    <!-- Options will be populated via AJAX -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quantity" class="col-sm-4 control-label">Quantity </label>
                            <div class="col-sm-8">
                                <input id="quantity" name="quantity" type="number" class="form-control" placeholder="Quantity " required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="quantity_take" class="col-sm-4 control-label"> Quantity Take </label>
                            <div class="col-sm-8">
                                <input id="quantity_take" name="quantity_take" type="number" class="form-control" placeholder="Quantity Take " required>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="closed_container" class="col-sm-4 control-label">Number of Closed Containers</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group1">
                                    <input id="closed_container" name="closed_container" type="number" class="form-control" placeholder="Number of Closed Containers" required>
                                   <input id="unit_measure_lab" name="unit_measure_lab" type="text" class="form-control" placeholder="Unit" required>
                                </div>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="loose_items" class="col-sm-4 control-label">Number of loose items </label>
                            <div class="col-sm-8">
                                <input id="loose_items" name="loose_items" type="number" class="form-control" placeholder="Number of loose items " required>
                                <div class="val1tip"></div>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label for="quantity_per_unit" class="col-sm-4 control-label">Quantity Measured per Unit</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group1">
                                    <input id="quantity_per_unit" name="quantity_per_unit" type="number" class="form-control" placeholder="Quantity Measured per Unit" required>
                                   <input id="unit_of_measure" name="unit_of_measure" type="text" class="form-control" placeholder="Unit" required>
                                </div>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="total_quantity" class="col-sm-4 control-label">Total Quantity (Unit of Measure)</label>
                            <div class="col-sm-8">
                                <div class="input-group input-group1">
                                    <input id="total_quantity" name="total_quantity" type="number" class="form-control" placeholder="Total Quantity" required>
                                    <input id="unit_of_measure1" class="form-control unit-of-measure" disabled>
                                </div>
                                <div class="val1tip"></div>
                            </div>
                        </div>

                        <div class="form-container"></div>

                        <div class="form-group">
							<label for="expired_date" class="col-sm-4 control-label">Experied Date</label>
							<div class="col-sm-8">
								<input id="expired_date" name="expired_date" type="date" class="form-control" placeholder="Experied date" value="<?php echo date("Y-m-d"); ?>">
							</div>
						</div>

                        <div class="form-group">
							<label for="date_collected" class="col-sm-4 control-label">Collection Date</label>
							<div class="col-sm-8">
								<input id="date_collected" name="date_collected" type="date" class="form-control" placeholder="Collection Date" value="<?php echo date("Y-m-d"); ?>">
							</div>
						</div>

						<div class="form-group">
							<label for="time_collected" class="col-sm-4 control-label">Collection Time</label>
							<div class="col-sm-8">
								<div class="input-group clockpicker">
									<input id="time_collected" name="time_collected" class="form-control" placeholder="Collection Time" value="<?php 
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
                            <label for="comments" class="col-sm-4 control-label">Comment</label>
                            <div class="col-sm-8">
                                <textarea id="comments" name="comments" class="form-control" placeholder="Comment"> </textarea>
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

    <!-- MODAL LOADING FOR EMAIL NOTIFICATION -->
    <div class="modal fade" id="loading-modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div style="padding: 20px;">
                        <i class="fa fa-spinner fa-spin fa-3x text-primary"></i>
                        <h4 style="margin-top: 20px; color: #337ab7;">Processing...</h4>
                        <p style="margin-top: 10px; color: #666;">
                            System is sending stock notifications to email addresses.<br>
                            Please wait a moment...
                        </p>
                        <div class="progress" style="margin-top: 15px;">
                            <div class="progress-bar progress-bar-striped active" role="progressbar" style="width: 100%">
                                <span class="sr-only">Processing...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MODAL LOADING -->

    <!-- MODAL CONFIRMATION DELETE -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dd4b39; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i>  Stock Take | Delete <span id="my-another-cool-loader"></span></h4>
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

    .highlight {
        background-color: rgba(0, 255, 0, 0.1) !important;
        font-weight: bold !important;
    }
    .highlight-edit {
        background-color: rgba(0, 0, 255, 0.1) !important;
        font-weight: bold !important;
    }

    /* Style untuk pesan error */
    .error-message {
        color: #d9534f; /* Red color for error */
        background-color: #f8d7da; /* Light red background */
        border: 1px solid #f5c6cb; /* Border with light red color */
        padding: 10px; /* Padding inside the error box */
        border-radius: 5px; /* Rounded corners */
        font-size: 14px; /* Font size */
        font-weight: bold; /* Make the text bold */
        margin-top: 10px; /* Add margin from the input field */
        text-align: center; /* Center the error text */
    }

    .error-message:before {
        content: '\26A0 '; /* Add a warning icon before the message */
        font-size: 16px;
    }

    /* Custom styles for loading modal */
    #loading-modal .modal-content {
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    
    #loading-modal .fa-spinner {
        color: #337ab7;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    #loading-modal .progress {
        height: 8px;
    }
    
    #loading-modal .progress-bar {
        background-color: #337ab7;
    }
        margin-right: 5px; /* Space between the icon and text */
    }



</style>
<!-- Chosen CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">



    var table;
    var rowNum = 1;
    let id_instock = $('#id_instock').val();
    $(document).ready(function() {

        $('.stockSelect').chosen({
            placeholder_text_single: "-- Select Product Name --",
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
            let url = '<?php echo site_url('consumables_in_stock/deleteConsumablesInStock'); ?>/' + id;
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

        $('.idObjectiveSelect').change(function() {
            let id_objectives = [];
            $('.idObjectiveSelect:checked').each(function() {
                id_objectives.push($(this).val());
            });

            let $stockSelect = $('#id_stock');
            $stockSelect.empty(); // Clear existing options
            $stockSelect.append('<option value="">-- Select Product Name --</option>'); // Add default option

            if (id_objectives.length > 0) {
                console.log(id_objectives);
                $.ajax({
                    url: '<?php echo site_url('Consumables_in_stock/getStockByObjective'); ?>',
                    type: 'POST',
                    data: { id_objectives: id_objectives }, // Ensure parameter name is correct
                    dataType: 'json',
                    success: function(response) {
                        // Add new options based on response
                        $.each(response, function(index, item) {
                            $stockSelect.append('<option value="' + item.id_stock + '">' + item.product_name + '</option>');
                        });

                        // Re-initialize Chosen after updating options
                        $stockSelect.trigger('chosen:updated');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                    }
                });
            } else {
                // Re-initialize Chosen after clearing options
                $stockSelect.trigger('chosen:updated');
            }
        });


        // $('.stockSelect').change(function() {
        //     let idStock = $(this).val();
        //     if (idStock) {
        //         $.ajax({
        //             url: '<?php echo site_url('Consumables_in_stock/getStockDetails'); ?>',
        //             type: 'POST',
        //             data: { idStock: idStock }, 
        //             dataType: 'json',
        //             success: function(response) {
             
        //                 console.log(response);
        //                 $('#unit_measure_lab').val(response.unit || '');
        //                 $('#unit_of_measure').val(response.unit_of_measure || '');
        //                 $('#unit_of_measure1').val(response.unit_of_measure || '');
        //                 $('#quantity_per_unit').val(response.quantity_per_unit || '');
        //                 $('#quantity').val(response.quantity || '');
        //                 calculateTotalQuantity(); 
        //             },
        //             error: function(jqXHR, textStatus, errorThrown) {
        //                 // Menangani error jika terjadi kesalahan dalam request
        //                 console.error('AJAX error:', textStatus, errorThrown);
        //                 $('#unit_measure_lab').val('');
        //                 $('#unit_of_measure').val('');
        //                 $('#unit_of_measure1').val('');
        //                 $('#quantity_per_unit').val('');
        //                 $('#quantity').val('');
        //             }
        //         });
        //     } else {
        //         $('#unit_measure_lab').val('');
        //         $('#unit_of_measure').val('');
        //         $('#unit_of_measure1').val('');
        //         $('#quantity_per_unit').val('');
        //         $('#quantity').val('');
        //     }
        // });
        // $('.stockSelect').change(function () {
        //     let idStock = $(this).val();
        //     let idObjectives = [];

        //     $('.idObjectiveSelect:checked').each(function () {
        //         idObjectives.push($(this).val());
        //     });

        //     if (idStock) {
        //         $.ajax({
        //             url: '<?php echo site_url('Consumables_in_stock/getStockDetails'); ?>',
        //             type: 'POST',
        //             data: {
        //                 idStock: idStock,
        //                 idObjectives: idObjectives // kirim data ke server
        //             },
        //             dataType: 'json',
        //             success: function (response) {
        //                 console.log(response);

        //                 $('#unit_measure_lab').val(response.unit || '');
        //                 $('#unit_of_measure').val(response.unit_of_measure || '');
        //                 $('#unit_of_measure1').val(response.unit_of_measure || '');
        //                 $('#quantity_per_unit').val(response.quantity_per_unit || '');
        //                 $('#quantity').val(response.quantity || '');

        //                 // Cek objective yang tidak sesuai
        //                 // if (response.invalid_objectives && response.invalid_objectives.length > 0) {
        //                 //     let invalidNames = response.invalid_objective_names.join(', ');
        //                 //     alert('⚠️ Objective berikut tidak terdaftar untuk produk ini:\n' + invalidNames + '\nSilakan cek kembali atau daftarkan di modul lain.');
        //                 // }
        //                 if (response.invalid_objectives && response.invalid_objectives.length > 0) {
        //                     let invalidNames = response.invalid_objective_names.join(', ');
                            
        //                     Swal.fire({
        //                         icon: 'warning',
        //                         title: 'Objective Mismatch',
        //                         html: 'This product is not registered for the following objectives:<br><strong>' + invalidNames + '</strong>.<br>Please review or register them through a consumables module.',
        //                         confirmButtonText: 'OK'
        //                     });

        //                 }


        //                 calculateTotalQuantity();
        //             },
        //             error: function (jqXHR, textStatus, errorThrown) {
        //                 console.error('AJAX error:', textStatus, errorThrown);
        //             }
        //         });
        //     }
        // });
        $('.stockSelect').change(function () {
            let idStock = $(this).val();
            let selectedProductName = $('#id_stock option:selected').text();
            if (idStock) {
                $.ajax({
                    url: '<?php echo site_url('Consumables_in_stock/getStockDetails'); ?>',
                    type: 'POST',
                    data: { idStock: idStock, idObjectives: getSelectedObjectives() }, 
                    dataType: 'json',
                    success: function (response) {
                        $('#unit_measure_lab').val(response.unit || '');
                        $('#unit_of_measure').val(response.unit_of_measure || '');
                        $('#unit_of_measure1').val(response.unit_of_measure || '');
                        $('#quantity_per_unit').val(response.quantity_per_unit || '');
                        $('#quantity').val(response.quantity || '');
                        calculateTotalQuantity();

                        // Handle invalid objectives
                        let invalidObj = response.invalid_objectives;

                        // Normalize: convert to array if it's an object
                        if (invalidObj && typeof invalidObj === 'object' && !Array.isArray(invalidObj)) {
                            invalidObj = Object.values(invalidObj);
                        }

                        if (invalidObj && invalidObj.length > 0) {
                            const invalidNames = response.invalid_objective_names.join(', ');
                            Swal.fire({
                                icon: 'warning',
                                title: 'Objective Mismatch',
                                html: 'The Objective <strong>"' + invalidNames + '"</strong> is not registered for the following product:<br><strong>' + selectedProductName + '</strong>.<br>Please review or register them through a consumables module.',
                                confirmButtonText: 'OK'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Reset product name dropdown
                                    $('#id_stock').val('').trigger('change');

                                    // Optional: Kosongkan juga field info produk lain
                                    $('#id_stock').trigger('chosen:updated');
                                    $('#unit_measure_lab').val('');
                                    $('#unit_of_measure').val('');
                                    $('#unit_of_measure1').val('');
                                    $('#quantity_per_unit').val('');
                                    $('#quantity').val('');
                                }
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('AJAX error:', textStatus, errorThrown);
                        $('#unit_measure_lab').val('');
                        $('#unit_of_measure').val('');
                        $('#unit_of_measure1').val('');
                        $('#quantity_per_unit').val('');
                        $('#quantity').val('');
                    }
                });
            } else {
                $('#unit_measure_lab').val('');
                $('#unit_of_measure').val('');
                $('#unit_of_measure1').val('');
                $('#quantity_per_unit').val('');
                $('#quantity').val('');
            }
        });

        function getSelectedObjectives() {
            let selected = [];
            $('.idObjectiveSelect:checked').each(function () {
                selected.push($(this).val());
            });
            return selected;
        }


        
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
            autoClose: true,
            position: 'bottom',
        });

        // Panggil fungsi calculateTotalQuantity setiap kali nilai input berubah
        $('#closed_container, #quantity_per_unit, #loose_items, #quantity').on('input', function() {
            calculateTotalQuantity();
            // calculateQuantityUsed();
        });

        $('#quantity_per_unit').on('change', function() {
            calculateTotalQuantity();
            // calculateQuantityUsed();
        });

        // Fungsi untuk menghitung total quantity
        function calculateTotalQuantity() {
            let closedContainer = parseFloat($('#closed_container').val()) || 0;
            let quantityPerUnit = parseFloat($('#quantity_per_unit').val()) || 0;
            let looseItems = parseFloat($('#loose_items').val()) || 0;
            let totalQuantity = (closedContainer * quantityPerUnit) + looseItems;
            $('#total_quantity').val(totalQuantity);
        }

        // Inisialisasi clockpicker
        $('.clockpicker').clockpicker({
            autoclose: true
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        });

        // Variable to track if form is being submitted
        let isFormSubmitting = false;

        $('#compose-modal').on('hide.bs.modal', function (e) {
            // Jika form sedang disubmit, jangan lakukan cleanup
            if (isFormSubmitting) {
                return;
            }
            
            // Bersihkan form hanya jika bukan karena submit
            $('#formSample').find('input, textarea').val('');
            $('#formSample').find('input[type=checkbox], input[type=radio]').prop('checked', false);
            // Bersihkan nilai yang dipilih dalam select
            $('#formSample select').val('').trigger('change');
            location.reload();
        });

        // Handle form submission to show loading modal
        $('#formSample').on('submit', function(e) {
            console.log('Form submit triggered'); // Debug log
            
            // Set flag to prevent modal cleanup
            isFormSubmitting = true;
            
            // Show loading modal immediately (but don't hide compose modal yet)
            setTimeout(function() {
                $('#compose-modal').modal('hide');
                $('#loading-modal').modal('show');
            }, 100);
            
            console.log('Form submission proceeding...'); // Debug log
            
            // Let the form submit normally
            return true; // Allow form submission to continue
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
                {"data": "objective"},
                {"data": "product_name"},
                {"data": "closed_container"},
                {"data": "quantity_take"},
                {"data": "unit_measure_lab"},
                {"data": "quantity_per_unit"},
                {"data": "unit_of_measure"},
                {"data": "loose_items"},
                {"data": "quantity_with_unit"},
                {"data": "date_collected"},
                {"data": "time_collected"},
                {"data": "comments"},
                {
                    "data": "action",
                    "orderable": false,
                    "className": "text-center"
                }
            ],
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
                
            }
        });

        // Event handler for click to table row
        $('#mytable tbody').on('click', 'tr', function() {
            let rowData = table.row(this).data();
            let rowId = rowData.id_instock;
            $(this).removeClass('highlight');
            $(this).removeClass('highlight-edit');
        });


        // Function to calculate total closed containers
        function calculateTotalClosedContainers() {
            let closedContainerValue = parseFloat($('#closed_container').val()) || 0; // Get the Number of Closed Containers value
            let quantity = parseFloat($('#quantity').val()) || 0; // Assuming there's an input field with id 'quantity'
            let takeQuantity = parseFloat($('#quantity_take').val()) || 0;
            let selectedObjectives = $('.idObjectiveSelect:checked').length; // Count checked objectives


            let totalClosedContainers = closedContainerValue * selectedObjectives; // Calculate total
            takeQuantity = quantity - totalClosedContainers;

            // Update Total of Closed Containers field
            $('#total_closed_containers').val(totalClosedContainers);
            $('#quantity_take').val(takeQuantity);

            // Disable or enable the closed_container input field based on the condition
            if (totalClosedContainers > quantity) {
                // Disable the closed_container input if total exceeds quantity
                $('#closed_container').prop('disabled', false);
                // Optionally, show a message indicating the validation failed
                       // Show and style the error message
                $('#closed_container_error').text('Total Closed Containers cannot be greater than Quantity')
                    .addClass('error-message') // Apply the error message style
                    .show();
            } else {
                // Enable the closed_container input if total is less than or equal to quantity
                $('#closed_container').prop('disabled', false);
                // Hide the error message
                $('#closed_container_error').hide();
            }
        }

        // Event listener for changes in Number of Closed Containers
        $('#closed_container').on('input', function() {
            calculateTotalClosedContainers(); // Recalculate total when the value changes
        });

        // Event listener for changes in objectives (checkbox changes)
        $('.idObjectiveSelect').on('change', function() {
            calculateTotalClosedContainers(); // Recalculate total when objectives are checked/unchecked
        });

        // Add a new input field for Total of Closed Containers (if not already present)
        if (!$('#total_closed_containers').length) {
            // Add the input field dynamically within the container
            $('.form-container').append(
                '<div class="form-group">\
                    <label for="total_closed_containers" class="col-sm-4 control-label">Total of Closed Containers</label>\
                    <div class="col-sm-8">\
                        <input type="number" class="form-control" id="total_closed_containers" name="total_closed_containers" placeholder="Total of Closed Containers" readonly>\
                    </div>\
                </div>'
            );
        }

        // Add an error message element for feedback (this will appear if the validation fails)
        if (!$('#closed_container_error').length) {
            $('.form-container').append(
                '<div class="form-group" id="closed_container_error" style="color: red; display: none;">\
                    Total Closed Containers cannot be greater than Quantity.\
                </div>'
            );
        }




        // Ensure existing functionality is retained
        $('#id_stock').change(function() {
            let selectedProduct = $(this).val(); // Get the selected product value
            if (selectedProduct) {
                $('#closed_container').attr('readonly', false); // Enable field
            } else {
                $('#closed_container').attr('readonly', true); // Disable field
            }
        });


        $('#addtombol').click(function() {
             // Initially disable the "Number of Closed Containers" field

            // Enable the field when a product is selected
            $('#id_stock').change(function() {
                let selectedProduct = $(this).val(); // Get the selected product value
                if (selectedProduct) {
                    $('#closed_container').attr('readonly', false); // Enable field
                } else {
                    $('#closed_container').attr('readonly', true);// Disable field
                }
            });

            $('.val1tip').tooltipster('hide');   
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Consumables - Insert Stock Take <span id="my-another-cool-loader"></span>');
            $('#idx_instock').val(id_instock);
            $('#idx_instock').attr('readonly', true);
            $('#id_objective').val('');
            $('#id_objective').attr('readonly', false).attr('onmousedown', 'return true;');
            $('#closed_container').val('');
            $('#closed_container').attr('readonly', true);
            $('#total_closed_container').val('');
            $('#total_closed_container').attr('readonly', true);
            $('#unit_measure_lab').val('');
            $('#unit_measure_lab').attr('readonly', true);
            $('#quantity_per_unit').val('');
            $('#quantity_per_unit').attr('readonly', true);
            $('#loose_items').val('');
            $('#total_quantity').val('');
            $('#total_quantity').attr('readonly', true);
            $('#quantity').val('');
            $('#quantity').attr('readonly', true);
            $('#quantity_take').val('');
            $('#quantity_take').attr('readonly', true);
            $('#unit_of_measure').val('');
            $('#unit_of_measure').attr('readonly', true);
            $('#unit_of_measure1').val('');
            $('#unit_of_measure1').attr('readonly', true);
            $('#comments').val('');
            $('#closed_container').val('');
            $('#total_closed_containers').val(''); // Reset Total of Closed Containers
            $('.idObjectiveSelect').prop('checked', false); // Reset checkboxes
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Consumables - Update Stock Take <span id="my-another-cool-loader"></span>');

            $('#idx_instock').attr('readonly', true);
            $('#idx_instock').val(data.id_instock);


            	
            // Reset all checkboxes before setting them
            $('.idObjectiveSelect').prop('checked', false).prop('disabled', true);

            // Pastikan data.id_objective valid dan adalah array
            if (Array.isArray(data.id_objective)) {
                data.id_objective.forEach(function(obj) {
                    // Cek dan centang checkbox berdasarkan value
                    $('.idObjectiveSelect[value="' + obj + '"]').prop('checked', true);
                });
            } else if (data.id_objective && typeof data.id_objective === 'string') {
                // Jika data.id_objective adalah string, ubah menjadi array
                data.id_objective.split(',').map(Number).forEach(function(obj) {
                    $('.idObjectiveSelect[value="' + obj + '"]').prop('checked', true);
                    $('.idObjectiveSelect1').val([obj]);
                });
            }

            // Trigger change event jika diperlukan
            $('.idObjectiveSelect').trigger('change');





            // Tunggu hingga AJAX selesai dan dropdown diisi
            // let interval = setInterval(function() {
            //     // Cek apakah lebih dari satu opsi tersedia (default + data baru)
            //     if ($('#id_stock').find('option').length > 1) {
            //         // Set nilai dropdown produk berdasarkan id_stock
            //         $('#id_stock').val(data.id_stock).prop('disabled', true); // Set the value of product dropdown
            //         $('#id_stock').trigger('chosen:updated'); // Update Chosen
            //         $('#id_stock1').val(data.id_stock); // Set the value of product dropdown
            //         $('#id_stock1').trigger('chosen:updated'); // Update Chosen
            //         clearInterval(interval); // Hentikan interval
            //     }
            // }, 100); // Cek setiap 100ms hingga dropdown terisi

            let interval = setInterval(function() {
                if ($('#id_stock').find('option').length > 1) {
                    $('#id_stock').val(data.id_stock).prop('disabled', true);
                    $('#id_stock').trigger('chosen:updated');
                    $('#id_stock1').val(data.id_stock);
                    $('#id_stock1').trigger('chosen:updated');
                    clearInterval(interval);

                    // Setelah dropdown selesai diisi dan dipilih, panggil AJAX
                    let idStock = $('#id_stock1').val();
                    if (idStock) {
                        $.ajax({
                            url: '<?php echo site_url('Consumables_in_stock/getStockDetails'); ?>',
                            type: 'POST',
                            data: { idStock: idStock },
                            dataType: 'json',
                            success: function(response) {
                                console.log(response);
                                $('#quantity').val(response.quantity || '');
                                $('#quantity').attr('readonly', true);
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                console.error('AJAX error:', textStatus, errorThrown);
                                $('#quantity').val('');
                            }
                        });
                    } else {
                        $('#quantity').val('');
                    }
                }
            }, 100);


            $('#id_objective').attr('readonly', true).attr('onmousedown', 'return false;');
            $('#closed_container').val(data.closed_container);
            $('#closed_container').attr('readonly', true);
            $('#total_closed_containers').val(data.total_closed_container);
            $('#total_closed_containers').attr('readonly', true);
            $('#unit_measure_lab').val(data.unit_measure_lab);
            $('#unit_measure_lab').attr('readonly', true);
            $('#quantity_per_unit').val(data.quantity_per_unit);
            $('#quantity_per_unit').attr('readonly', true);
            $('#loose_items').val(data.loose_items);
            $('#total_quantity').val(data.total_quantity);
            $('#total_quantity').attr('readonly', true);
            $('#quantity_take').val(data.quantity_take);
            $('#quantity_take').attr('readonly', true);
            $('#unit_of_measure').val(data.unit_of_measure);
            $('#unit_of_measure').attr('readonly', true);
            $('#unit_of_measure1').val(data.unit_of_measure);
            $('#unit_of_measure1').attr('readonly', true);
            $('#expired_date').val(data.expired_date).trigger('change');
            $('#comments').val(data.comments);
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