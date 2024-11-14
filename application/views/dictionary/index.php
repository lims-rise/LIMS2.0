<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">Information - Dictionary</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">
		<?php echo anchor(site_url('Dictionary/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export to CSV', 'class="btn btn-success"'); ?></div>
        <table class="table table-bordered table-striped tbody" id="mytable" style="width:100%">
            <thead>
                <tr>
                    <!-- <th width="30px">No</th> -->
                    <th>ID</th>
                    <th>Module</th>
                    <th>Subheadings</th>
                    <th>Column Name</th>
                    <th>Variable Label</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Detail</th>
                    <th>Comments</th>
                    <th>Restriction</th>
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
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <h4 class="modal-title" id="modal-title">Dictionary - Detail</h4>
                </div>
                <form id="formSample" method="post" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="id_det" class="col-sm-4 control-label">ID</label>
                        <div class="col-sm-8">
                            <input id="id_det" name="id_det" placeholder="ID" class="form-control input-sm" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="detmodule" class="col-sm-4 control-label">Module</label>
                        <div class="col-sm-8">
                            <input id="detmodule" name="detmodule" placeholder="Module" class="form-control input-sm" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="detheading" class="col-sm-4 control-label">SubHeadings</label>
                        <div class="col-sm-8">
                            <input id="detheading" name="detheading" placeholder="SubHeadings" class="form-control input-sm" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="detvar_label" class="col-sm-4 control-label">Variable Label</label>
                        <div class="col-sm-8">
                            <input id="detvar_label" name="detvar_label" placeholder="Variable Label" class="form-control input-sm">
                        </div>
                    </div>

                    <section class="content">
                        <div class="row">
                            <div class="box">
                                <div class="box-header"></div>
                                <div class="box-body table-responsive">
                                <!-- <table class="table table-bordered table-striped tbody" id="mytable2x" style="width:100%"> -->
                                    <table id="mytable2" class="table table-bordered table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Factor Value</th>
                                                <th>Factor Label</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Comments</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </section>    

                </div>
                <div class="modal-footer clearfix">
                <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> OK</button>
                </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    

    <!-- MODAL RECEPTION -->
	<div class="modal fade" id="restriction-modal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header"  style="background-color: #f39c12; color: white;">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Restriction</h4>
				</div>
				<div class="modal-body">
					<div id="restriction-content">
						<!-- Content will be loaded here dynamically -->
					</div>
				</div>
				<div class="modal-footer clearfix">
					<!-- <button type="button" id="confirm-save" class="btn btn-primary"><i class="fa fa-save"></i> Ok</button> -->
					<button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

    <!-- MODAL CONFIRMATION DELETE -->
    <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #dd4b39; color: white;">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: white;">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-trash"></i> Information Dictionary | Delete <span id="my-another-cool-loader"></span></h4>
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
    .restriction {
        background-color: #31363F;
        color: #FFFFFF;
        padding: 0px 10px;
        border-radius: 3px;
        font-size: 18px;
        font-weight: bold;
        text-align: center;
    }
    .text {
        font-size: 23px;
    }
</style>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    var table
    var tabledet
    // function showRestriction(id) {
    //     $.ajax({
    //         url: '<?php echo site_url('Dictionary/get_restriction_data'); ?>',
    //         type: 'GET',
    //         data: { id: id },
    //         dataType: 'json',
    //         success: function(response) {
    //             if (response && typeof response === 'object') {

    //                 let confirmationContent = '<ul style="list-style-type:none; font-size: 16px">';
    //                 confirmationContent += '<div><li class="text">New Barcode :</li> <br> <span class="restriction"><i class="fa fa-exclamation-triangle" style="color: white ;"></i> ' + (response.new_restriction_barcode ? response.new_restriction_barcode : 'N/A') + '</span></div> <br>';
    //                 confirmationContent += '<div><li class="text">Barcode Exists :</li> <br> <span class="restriction"><i class="fa fa-exclamation-triangle" style="color: white ;"></i> ' + (response.restriction_barcode_exists ? response.restriction_barcode_exists : 'N/A') + '</span></div>';
    //                 confirmationContent += '</ul>';

    //                 $('#confirmation-content').html(confirmationContent);
    //             } else {
    //                 $('#confirmation-content').html('<p><strong>No restriction available.</strong></p>');
    //             }

    //             // show confirmation modal
    //             $('#confirm-modal').modal('show');
    //         },
    //         error: function(xhr, status, error) {
    //             console.error('AJAX Error:', status, error);
    //             $('#confirmation-content').html('<p>Error retrieving data. Please try again later.</p>');
    //             $('#confirm-modal').modal('show');
    //         }
    //     });
    // }

    function showRestriction(id) {
        $.ajax({
            url: '<?php echo site_url('Dictionary/get_restriction_data'); ?>',
            type: 'GET',
            data: { id: id },
            dataType: 'json',
            success: function(response) {
                if (response && typeof response === 'object') {

                    let restrictionContent = '<ul style="list-style-type:none; font-size: 15px">';
                    restrictionContent += '<div><li class="text">New Barcode :</li> <br> <span class="restriction"><i class="fa fa-exclamation-triangle" style="color: white ;"></i> ' + (response.new_restriction_barcode ? response.new_restriction_barcode : 'N/A') + '</span></div> <br>';

                    if (response.restriction_barcode_exists) {

                        let barcodeExists = response.restriction_barcode_exists;
                        let parts = barcodeExists.split(',');

                        restrictionContent += '<div><li class="text">Barcode Exists :</li> <br>';
                        parts.map(part => {
                            // confirmationContent += '<span class="restriction"><i class="fa fa-exclamation-triangle" style="color: white ;"></i> ' + part.trim() + '</span><br>';
                            restrictionContent += '<span class="restriction" style="display: inline-block; margin-bottom: 5px;"><i class="fa fa-exclamation-triangle" style="color: white ;"></i> ' + part.trim() + '</span><br>';
                        });
                        restrictionContent += '</div>';
                    } else {
                        restrictionContent += '<div><li class="text">Barcode Exists :</li> <br> <span class="restriction"><i class="fa fa-exclamation-triangle" style="color: white ;"></i> N/A</span></div>';
                    }

                    restrictionContent += '</ul>';
                    $('#restriction-content').html(restrictionContent);
                } else {
                    let noRestrictionContent = '<ul style="list-style-type:none; font-size: 16px">';
                        noRestrictionContent += '<div><li class="text"></li> <br> <span class="restriction"><i class="fa fa-exclamation-triangle" style="color: white ;"></i> No restriction available.</span></div> <br>';
                    noRestrictionContent += '</ul>';
                    $('#restriction-content').html(noRestrictionContent);
                }

                // show restriction
                $('#restriction-modal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#restriction-content').html('<p>Error retrieving data, check your connection. Please try again later.</p>');
                $('#restriction-modal').modal('show');
            }
        });
    }


    // var id_dic=$('#id').val();
    $(document).ready(function() {

        function showConfirmation(url) {
            deleteUrl = url; // Set the URL to the variable
            $('#confirm-modal').modal('show');
        }

        // Handle the delete button click
        $(document).on('click', '.btn_delete', function() {
            let id = $(this).data('id');
            let url = '<?php echo site_url('Dictionary/delete'); ?>/' + id;
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

        
        // $('.clockpicker').clockpicker({
        // placement: 'bottom', // clock popover placement
        // align: 'left',       // popover arrow align
        // donetext: 'Done',     // done button text
        // autoclose: true,    // auto close when minute is selected
        // vibrate: true        // vibrate the device when dragging clock hand
        // });                

        // $('.val1tip').tooltipster({
        //     animation: 'swing',
        //     delay: 1,
        //     theme: 'tooltipster-default',
        //     // touchDevices: false,
        //     // trigger: 'hover',
        //     autoClose: true,
        //     position: 'bottom',
        //     // content: $('<span><i class="fa fa-exclamation-triangle"></i> <strong> This text is in bold case !</strong></span>')
        //     // content: $('<span><img src="../assets/img/ttd.jpg" /> <strong>This text is in bold case !</strong></span>')
        //     // content: 'Test tip'
        // });


        // function checkBarcode() { col-sm-8
        // $('.modal-body').click(function() {
        // $('#barcode_sample').click(function() {
        //     $('.val1tip').tooltipster('hide');   
        // // $('#barcode_sample').val('');     
        // });

        // $('.col-sm-8').click(function() {

            // $('.val1tip').tooltipster('hide');   
            // $('#barcode_sample').val('');     
        // });

        // $("#compose-modal").on('hide.bs.modal', function(){
        //     $('.val1tip').tooltipster('hide');   
        //     // $('#barcode_sample').val('');     
        // });


        // $("input").keypress(function(){
        //     // $('#barcode_sample').val('');     
        //     $('.val1tip').tooltipster('hide');   
        // });

        // $('#compose-modal').on('shown.bs.modal', function () {
        //     // $('#barcode_sample').val('');     
        //     $('#sample').focus();
        // });        
                
        //var id_det = $('#id_det').val();                
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
            // select: true;
            processing: true,
            serverSide: true,
            ajax: {"url": "Dictionary/json", "type": "POST"},
            columns: [
                // {
                //     "data": "barcode_sample",
                //     "orderable": false
                // },   
                {"data": "id"},
                {"data": "module"},
                {"data": "subheadings"},
                {"data": "col_name"},
                {"data": "var_label"},
                {"data": "start_date"},
                {"data": "end_date"},
                {"data": "dictionary_id"},
                {"data": "comments"},
                {
                    "data" : "restriction",
                    "orderable": false,
                    "searchable": false,
                    "className" : "text-center"
                },
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'asc']],
            // order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });


        // table2 = $("#mytable2").DataTable({
        //     oLanguage: {
        //         sProcessing: "loading..."
        //     },
        //     // select: true;
        //     processing: true,
        //     serverSide: true,
        //     ajax: {"url": "Dictionary/json", "type": "POST"},
        //     columns: [
        //         // {
        //         //     "data": "barcode_sample",
        //         //     "orderable": false
        //         // },
        //         {"data": "id"},
        //         {"data": "module"},
        //         {"data": "subheadings"},
        //         {"data": "col_name"},
        //         {"data": "var_label"},
        //         {"data": "start_date"},
        //         {"data": "end_date"},
        //         {"data": "detail"},
        //         {"data": "comments"},
        //         {
        //             "data" : "action",
        //             "orderable": false,
        //             "className" : "text-center"
        //         }
        //     ],
        //     order: [[0, 'asc']],
        //     // order: [[0, 'desc']],
        //     rowCallback: function(row, data, iDisplayIndex) {
        //         var info = this.fnPagingInfo();
        //         var page = info.iPage;
        //         var length = info.iLength;
        //         // var index = page * length + (iDisplayIndex + 1);
        //         // $('td:eq(0)', row).html(index);
        //     }
        // });


        tabledet = $("#mytable2").DataTable({
            oLanguage: {
                sProcessing: "Loading sub dictionary..."
            },
            // select: true;
            processing: true,
            serverSide: true,
            // ajax: {"url": "dictionary/jsondet?id1=" + id_det, "type": "POST"},
            ajax: {"url": "Dictionary/jsondet", "type": "POST"},
            // ajax: {"url": "Dictionary/jsondet?id1=" + data.id, "type": "POST"},
            // ajax: {"url": "../../dictionary/jsondet?id1=" + id_det, "type": "POST"},
            columns: [
                {"data": "id"},
                {"data": "factor_value"},
                {"data": "factor_label"},
                {"data": "start_date"},
                {"data": "end_date"},
                {"data": "comments"},
                // {
                //     "data" : "action",
                //     "orderable": false,
                //     "className" : "text-center"  
                // }
            ],
            order: [[0, 'asc']],
            // order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                // var index = page * length + (iDisplayIndex + 1);
                // $('td:eq(0)', row).html(index);
            }
        });         

        // $('#mytable').on('click', '.btn_detail', function(){
        //     $('.val1tip').tooltipster('hide');   
        //     let tr = $(this).parent().parent();
        //     let data = table.row(tr).data();
        //     console.log(data);
        //     // var data = this.parents('tr').data();
        //     $('#mode').val('edit');
        //     $('#modal-title').html('<i class="fa fa-pencil-square"></i> Dictionary - Detail<span id="my-another-cool-loader"></span>');
        //     $('#id_det').val(data.dictionary_id);
        //     $('#detmodule').val(data.module);
        //     $('#detheading').val(data.subheadings);
        //     $('#detvar_label').val(data.var_label);
        //     $('#compose-modal').modal('show');
        //     // tabledet.ajax.url('dictionary/jsondet?id=' + data.dictionary_id).load();
        // });  

        // #tblEmployee tbody tr.even:hover {
        //     background-color: cadetblue;
        //     cursor: pointer;
        // }
        // $('#myTable').DataTable( {
        //     select: true
        // } );

        $('#mytable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('active')) {
                $(this).removeClass('active');
            } else {
                table.$('tr.active').removeClass('active');
                $(this).addClass('active');
            }

            // var data = table.row($(this)).data();
            // if (data) {
            //     tabledet.ajax.url('dictionary/jsondet/\"' + data.dictionary_id + '\"').load();
                // tabledet.ajax.url('dictionary/jsondet?id1=\"' + data.dictionary_id + '\"').load();
                // tabledet.ajax.url('dictionary/jsondet').load();
            // }
        });   

        // $('[data-dismiss=modal]').on('click', function(e) {
        //     var $t = $(this),
        //         target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
        //     $(target)
        //         .find("input,textarea,select")
        //         .val('')
        //         .end()
        //         .find("input[type=checkbox], input[type=radio]")
        //         .prop("checked", "")
        //         .end();
        // });
        // $('.modal').on('hidden.bs.modal', function() {
        //     $(this).find('form')[0].reset();
        // });
        // $('.modal').on('shown.bs.modal', function() {
        //     lastfocus = $(this);
        //     $('input:enabled:visible:not([readonly="readonly"])', this).get(0).select();
        // });                                
    });
</script>