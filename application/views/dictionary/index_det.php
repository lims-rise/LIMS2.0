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

        <form id="formSample" method="post" class="form-horizontal">
                <div class="modal-body">
                <input id="id_det" name="id_det" type="hidden" class="form-control input-sm" value="<?php echo $dictionary_id; ?>" disabled>
                <div class="form-group">
                    <label for="detmodule" class="col-sm-4 control-label">Module</label>
                    <div class="col-sm-8">
                        <input id="detmodule" name="detmodule" placeholder="Module" class="form-control input-sm" value="<?php echo $module; ?>" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detheading" class="col-sm-4 control-label">SubHeadings</label>
                    <div class="col-sm-8">
                        <input id="detheading" name="detheading" placeholder="SubHeadings" class="form-control input-sm" value="<?php echo $subheadings; ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="detvar_label" class="col-sm-4 control-label">Variable Label</label>
                    <div class="col-sm-8">
                        <input id="detvar_label" name="detvar_label" placeholder="Variable Label" class="form-control input-sm" value="<?php echo $var_label; ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                    <label for="detvar_label" class="col-sm-4 control-label">Format</label>
                    <div class="col-sm-8">
                        <input id="det_format" name="det_format" placeholder="Format" class="form-control input-sm" value="<?php echo $format; ?>" disabled>
                    </div>
                </div>

                <div class="form-group">
                        <label for="description" class="col-sm-4 control-label">Description</label>
                        <div class="col-sm-8">
                            <textarea id="description" name="description" class="form-control" placeholder="Description" disabled><?= htmlspecialchars($description) ?> </textarea>
                        </div>
                </div>

                <section class="content">
                    <div class="row">
                        <div class="box">
                            <div class="box-header"></div>
                            <div class="box-body table-responsive">
                            <!-- <table class="table table-bordered table-striped tbody" id="mytable2x" style="width:100%"> -->
                                <table id="mytable2" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Factor Value</th>
                                            <th>Factor Label</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Comments</th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>    

                </div>
                <div class="modal-footer clearfix">
                <!-- <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-times"></i> OK</button> -->
                <button type="button" name="cancel" value="cancel" class="btn btn-warning" onclick="javascript:history.go(-1);"><i class="fa fa-times"></i> Close</button>
                </div>
                </form>

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
    <!-- <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header box"> -->
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> -->
                    <!-- <h4 class="modal-title" id="modal-title">Dictionary - Detail</h4>
                </div> -->

            <!-- </div>/.modal-content -->
        <!-- </div>/.modal-dialog -->
    <!-- </div>/.modal         -->

</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">

    // var table
    var tabledet
    // var id_dic=$('#id').val();
    $(document).ready(function() {
        var id_det = $('#id_det').val();                
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
            ajax: {"url": "Dictionary/json", "type": "POST"},
            columns: [
                {"data": "module"},
                {"data": "subheadings"},
                {"data": "var_label"},
                {"data": "format"},
                {"data": "description"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'asc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
            }
        });


        table2 = $("#mytable2").DataTable({
            oLanguage: {
                sProcessing: "Loading sub dictionary..."
            },
            processing: true,
            serverSide: true,
            paging: false,
            ordering: false,
            info: false,
            bFilter: false,

            ajax: {"url": "../../dictionary/jsondet?id1=" + id_det, "type": "POST"},

            columns: [
                {"data": "id"},
                {"data": "factor_value"},
                {"data": "factor_label"},
                {"data": "start_date"},
                {"data": "end_date"},
                {"data": "comments"},

            ],
            order: [[0, 'asc']],
            // order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;

            }
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