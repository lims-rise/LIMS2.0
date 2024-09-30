<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
                    <div class="box-header">
                        <h3 class="box-title">Master Data - Consumables</h3>
                    </div>
                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <?php
                                    $lvl = $this->session->userdata('id_user_level');
                                    if ($lvl != 7){
                                        echo "<button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New Consumables </button>";
                                    }
                            ?>        
                            <?php echo anchor(site_url('Ref_destination/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
                            <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Product Name</th>
                                        <th>Objective</th>
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

    <!-- MODAL FORM -->
    <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modal-title">Master Data - New Objective</h4>
                </div>
                <form id="formSample"  action= <?php echo site_url('ref_consumables/save') ?> method="post" class="form-horizontal">
                    <div class="modal-body">
                        <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                        <input id="id_consumanbles" name="id_consumables" type="hidden" class="form-control input-sm">

                        <div class="form-group">
							<label for="id_stock" class="col-sm-4 control-label">Product Name</label>
							<div class="col-sm-8" >
								<select id='id_stock' name="id_stock" class="form-control stockSelect">
									<option>-- Select Product Name --</option>
									<?php
									foreach($stockName as $row){
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
							<label for="id_objective" class="col-sm-4 control-label">Objective</label>
							<div class="col-sm-8" >
								<select id='id_objective' name="id_objective" class="form-control stockSelect">
									<option>-- Select Objective --</option>
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
<style>
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

    var table
    $(document).ready(function() {

        $('.stockSelect').chosen({
            placeholder_text_single: "-- Select testing type --",
            no_results_text: "No results matched"
        });

        $('.chosen-container').each(function() {
            $(this).css('width', '100%');
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


        $('#barcode_sample').click(function() {
            $('.val1tip').tooltipster('hide');   
        });

        $("#compose-modal").on('hide.bs.modal', function(){
            $('.val1tip').tooltipster('hide');    
        });


        $("input").keypress(function(){   
            $('.val1tip').tooltipster('hide');   
        });

        $('#compose-modal').on('shown.bs.modal', function () {   
            $('#objective').focus();
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
            ajax: {"url": "ref_consumables/json", "type": "POST"},
            columns: [
                {"data": "id_consumables"},
                {"data": "product_name"},
                {"data": "objective"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'desc']],
            // order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });

        $('#addtombol').click(function() {
            $('.val1tip').tooltipster('hide');   
            $('#mode').val('insert');
            $('#modal-title').html('<i class="fa fa-wpforms"></i> Master Data - New consumables<span id="my-another-cool-loader"></span>');
            $('#id_consumables').val('');
            $('#id_stock').val('');
            $('#id_objective').val('');
            $('#compose-modal').modal('show');
        });

        $('#mytable').on('click', '.btn_edit', function(){
            $('.val1tip').tooltipster('hide');   
            let tr = $(this).parent().parent();
            let data = table.row(tr).data();
            console.log(data);
            $('#mode').val('edit');
            $('#modal-title').html('<i class="fa fa-pencil-square"></i> Master Data - Update consumables<span id="my-another-cool-loader"></span>');
            $('#id_consumables').val(data.id_consumables);

            // Set the value of the dropdown based on the testing_type
            $('#id_stock option').each(function() {
                if ($(this).text() === data.product_name) {
                    $(this).prop('selected', true);
                }
            });
            // Pastikan untuk memperbarui Chosen setelah memilih opsi
            $('#id_stock').trigger('chosen:updated');
            
            $('#id_objective option').each(function() {
				if ($(this).text() === data.objective) {
					$(this).prop('selected', true);
				}
			});
            // Pastikan untuk memperbarui Chosen setelah memilih opsi
            $('#id_objective').trigger('chosen:updated');
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