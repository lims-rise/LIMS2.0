<div class="content-wrapper">
    <section class="content">


       <div class="row">
             <div class="col-xs-12">
                <div class="box box-primary box-solid">

                    <div class="box-header">
                        <h3 class="box-title">Consumables - Report</h3>
                    </div>
                    <div class="box-body">
                        <!-- <button> </button> -->
                        <!-- <div class="col-md-12 col-xs-12"> -->
                            <a class="btn btn-success btn-sm" id="consumables_in_stock" href="consumables_in_stock/excel"><i class="fa fa-file-excel-o"></i><br /> Stock Take</a>
                            <a class="btn btn-success btn-sm" id="consumables_stock_used" href="consumables_stock_used/excel"><i class="fa fa-file-excel-o"></i><br /> In Stock</a>
                            <a class="btn btn-success btn-sm" id="consumables_new_order" href="consumables_new_order/excel"><i class="fa fa-file-excel-o"></i><br /> Order</a>
                        <!-- </div> -->


                    </div> <!-- </box-body2 > -->

                    <div class="box-body">
                        <table class="table table-bordered">
                            <tr>
                                <td width="250">Select date range :</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="box-body">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                <label for="id_objective" class="control-label">Objective</label>
                                                    <select id='id_objective' name="id_objective" class="form-control idObjectiveSelect">
                                                        <option value='' >-- Select Objective --</option>
                                                            <?php
                                                                foreach($objectives as $row){
                                                                    if ($id == $row['id_objective']) {
                                                                        echo "<option value='".$row['id_objective']."' selected='selected'>".$row['objective']."</option>";
                                                                    }
                                                                    else {
                                                                        echo "<option value='".$row['id_objective']."'>".$row['objective']."</option>";
                                                                    }
                                                                }
                                                            ?>
                                                    </select>
                                                </div>

                                                <div class="col-sm-4">
                                                    <label for="id_stock" class="control-label">Product Name</label>
                                                    <select id="id_stock" name="id_stock" class="form-control stockSelect ">
                                                        <option value="">-- Select Product Name --</option>
                                                        <!-- Options will be populated via AJAX -->
                                                    </select>
                                                </div>

                                                <div class="col-sm-2">
                                                    <label for="date_rep1" class="control-label">Start Date</label>
                                                    <input type="date" id="date_rep1" name="date_rep1" class="form-control input-sm">
                                                </div>

                                                <div class="col-sm-2">
                                                    <label for="date_rep2" class="control-label">End Date</label>
                                                    <input type="date" id="date_rep2" name="date_rep2" class="form-control input-sm">
                                                </div>
                                            </div>

                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-sm-12 text-center">
                                                    <button id="refresh-rep" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-refresh"></i> Refresh
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="box">
                                            <div class="box-header"></div>
                                            <div class="box-body table-responsive">
                                            <div style="padding-bottom: 10px;">
                                                <button class='btn btn-success btn-sm' id='export'> <i class="fa fa-file-excel-o" aria-hidden="true"></i> Export To Excel </button>
                                                <?php //echo anchor(site_url('REP_o2a/index2'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                                                <?php //echo anchor(site_url('REP_o2a/excel/'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
                                                <?php //echo anchor(site_url('kelolamenu/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?>
                                            </div>

                                            <table id="myreptable" class="table display table-bordered table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Objective</th>
                                                            <th>Product Name</th>
                                                            <th>Quantity Used</th>
                                                            <th>Closed Container</th>
                                                            <th>Unit Measure Lab</th>
                                                            <th>Quantity Per Unit</th>
                                                            <th>Loose Items</th>
                                                            <th>Total Quantity</th>
                                                            <th>Unit of Measure</th>
                                                            <th>Date Collected</th>
                                                            <th>Expired Date</th>
                                                            <th>Comments</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div><!-- /.box-body -->
                                        </div><!-- /.box -->
                                    </div><!-- /.col-xs-12 -->
                                </div><!-- /.row -->                                
                                </td>
                            </tr>
                        </table>
                    <!-- </form> -->
                    </div> <!-- </box-body1 > -->
                </div>
            </div>
        </div>

    </section>

</div>
<!-- Chosen CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.min.css">

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

const currentDate = new Date();
// Get the year, month, and day components
const year = currentDate.getFullYear();
const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so add 1 and pad with '0'
const day = String(currentDate.getDate()).padStart(2, '0');
// Create the formatted date string in "YYYY-MM-DD" format and store it in a variable
const formattedDate = `${year}-${month}-${day}`;

    $(document).ready(function() {
        $('.stockSelect').chosen({
            placeholder_text_single: "-- Select Product Name --",
            no_results_text: "No results matched"
        });

        $('.idObjectiveSelect').chosen({
            placeholder_text_single: "-- Select Objective --",
            no_results_text: "No results matched"
        });

        // Event listener untuk dropdown Objective
        $('.idObjectiveSelect').change(function() {
            let id_objective = $(this).val(); 
            if (id_objective) {
                $.ajax({
                    url: '<?php echo site_url('Consumables_report/getStockByObjective'); ?>', 
                    type: 'POST',
                    data: { id_objective: id_objective }, 
                    dataType: 'json', 
                    success: function(response) {
                        let $stockSelect = $('#id_stock');
                        $stockSelect.empty(); // Clear existing options
                        $stockSelect.append('<option value="">-- Select Product Name --</option>');
                        
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
                let $stockSelect = $('#id_stock');
                $stockSelect.empty(); // Clear existing options
                $stockSelect.append('<option value="">-- Select Product Name --</option>'); // Add default option

                // Re-initialize Chosen after clearing options
                $stockSelect.trigger('chosen:updated');
            }
        });

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

        $('#date_rep1').on('click', function (){
            if ($('#date_rep1').val() > $('#date_rep2').val()) {
                $('#date_rep2').val($('#date_rep1').val());
            }
        });

        $('#date_rep2').on('click', function (){
            if ($('#date_rep2').val() < $('#date_rep1').val()) {
                $('#date_rep1').val($('#date_rep2').val());
            }
        });

        $('#date_rep1').on('blur', function (){
            if ($('#date_rep1').val() > $('#date_rep2').val()) {
                $('#date_rep2').val($('#date_rep1').val());
            }
        });

        $('#date_rep2').on('blur', function (){
            if ($('#date_rep2').val() < $('#date_rep1').val()) {
                $('#date_rep1').val($('#date_rep2').val());
            }
        });

        $("#export").on('click', function() {
            let date1 = $('#date_rep1').val();
            let date2 = $('#date_rep2').val();
            let objective = $('#id_objective').val();
            let stock = $('#id_stock').val();
            if (date1 == '') {
                date1 = '2018-01-01';    
            }
            if (date2 == '') {
                date2=formattedDate;
            }
            if (objective == '') {
                objective = 'all'; // atau nilai lain yang sesuai dengan kebutuhanmu
            }
            document.location.href="Consumables_report/excel?date1="+date1+"&date2="+date2+"&objective="+objective+"&stock="+stock;
        });

    $('#refresh-rep ').click(function() {
        let date1 = $('#date_rep1').val();
        let date2 = $('#date_rep2').val();
        let objective = $('#id_objective').val();
        let stock = $('#id_stock').val();
        // console.log(date1, date2, objective, stock);
        let t = $("#myreptable").dataTable({
            initComplete: function() {
                var api = this.api();
                $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
            },
            oLanguage: {
                sProcessing: "loading..."
            },
            processing: true,
            serverSide: true,
            bDestroy: true,
            // paging: false,
            ordering: false,
            info: false,
            bFilter: false,
            ajax: {"url": "Consumables_report/json?date1="+date1+"&date2="+date2+"&objective="+objective+"&stock="+stock, "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false,
                //     "className" : "text-center"
                // },
                {"data": "objective"},
                {"data": "product_name"},
                {"data": "quantity_take"},
                {"data": "closed_container"},
                {"data": "unit_measure_lab"},
                {"data": "quantity_per_unit"},
                {"data": "loose_items"},
                {"data": "total_quantity"},
                {"data": "unit_of_measure"},
                {"data": "date_collected"},
                {"data": "expired_date"},
                {"data": "comments"},
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });
        // $('#compose-modal').modal('show');
    });


    });
</script>