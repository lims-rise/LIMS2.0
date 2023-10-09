<div class="content-wrapper">
    <section class="content">


<!--        <div class="row">
             <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">SETTING TAMPILAN MENU</h3>
                    </div>

                    <div class="box-body">
                        <?php // echo form_open('kelolamenu/simpan_setting')?>
                        <table class="table table-bordered">
                            <tr><td width="250">Tampilkan Menu Berdasarkan Level</td><td>
                                    
                                    <?php
                                    // echo form_dropdown('tampil_menu',array('ya'=>'YA','tidak'=>'TIDAK'),$setting['value'],array('class'=>'form-control'));
                                    ?>
                                </td></tr>
                            <tr><td></td><td><button type="submit" class="btn btn-danger btn-sm">Simpan Perubahan</button></td></tr>
                        </table>
                    </form>
                    </div>
                </div>
            </div>
        </div> -->

        <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header"></div>
                                <div class="box-body table-responsive">
                                <div style="padding-bottom: 10px;">
                                <button class='btn btn-default' id='tombol'> Tambah Data2 </button>
                                    <?php  echo anchor(site_url('delivery_report/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                                    <?php //echo anchor(site_url('kelolamenu/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
                                    <?php //echo anchor(site_url('kelolamenu/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>

                                <table id="example1" class="table display table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>ID</th>
                                                <th>Items</th>
                                                <th>Date Launch</th>
                                                <th>Notes</th>
												<th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

        <!-- <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">

                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA MENU</h3>
                    </div>

                    <div class="box-body">
                        <div style="padding-bottom: 10px;">
                            <?php // echo anchor(site_url('kelolamenu/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                            <?php //echo anchor(site_url('kelolamenu/excel'), '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Ms Excel', 'class="btn btn-success btn-sm"'); ?>
                            <?php //echo anchor(site_url('kelolamenu/word'), '<i class="fa fa-file-word-o" aria-hidden="true"></i> Export Ms Word', 'class="btn btn-primary btn-sm"'); ?></div>
                        <table class="table table-bordered table-striped" id="mytable">
                            <thead>
                                <tr>
                                    <th width="30px">No</th>
                                    <th>Title</th>
                                    <th>Url</th>
                                    <th>Icon</th>
                                    <th>Is Main Menu</th>
                                    <th>Is Aktif</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div> -->
    </section>


        <!-- MODAL FORM -->
        <div class="modal fade" id="compose-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="modal-title"></h4>
                    </div>
                    <form id="formSample" action="module/ref_items/save.php" method="post" class="form-horizontal">
                        <div class="modal-body">
                            <div class="form-group">
<!--                                <label for="kode" class="col-sm-4 control-label">Kode</label>  -->
                                <div class="col-sm-8">
                                    <input id="mode" name="mode" type="hidden" class="form-control input-sm">
                                    <input id="id_items" name="id_items" type="hidden" class="form-control input-sm">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-sm-4 control-label">Item Description</label>
                                <div class="col-sm-8">
                                    <input id="description" name="description" type="text" class="form-control input-sm" placeholder="Item Description" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date_launch" class="col-sm-4 control-label">Date Launch</label>
                                <div class="col-sm-8">
                                    <input id="date_launch" name="date_launch" type="text" class="form-control input-sm" placeholder="Date Launch">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes" class="col-sm-4 control-label">Notes</label>
                                <div class="col-sm-8">
                                    <textarea id="notes" name="notes" class="form-control input-sm" placeholder="Notes"> </textarea>
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
<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
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

    $('#tombol').click(function() {
        // $('#mode').val('append');
        // $('#id_items').val('');
        // $('#description').val('');
        // $('#date_launch').val('');
        // $('#notes').val('');
        $('#compose-modal').modal('show');
    });

        var t = $("#mytable").dataTable({
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
            ajax: {"url": "kelolamenu/json", "type": "POST"},
            columns: [
                {
                    "data": "id_menu",
                    "orderable": false
                },{"data": "title"},{"data": "url"},{"data": "icon"},{"data": "is_main_menu"},{"data": "is_aktif"},
                {
                    "data" : "action",
                    "orderable": false,
                    "className" : "text-center"
                }
            ],
            order: [[0, 'desc']],
            rowCallback: function(row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });
    });
</script>