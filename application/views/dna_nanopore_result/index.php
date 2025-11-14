<style>
.custom-file-upload {
  display: inline-block;
  padding: 6px 12px;
  cursor: pointer;
  background-color: #007bff;
  color: white;
  border-radius: 5px;
  font-size: 14px;
  border: 1px solid #007bff;
  transition: background-color 0.2s;
}

.custom-file-upload:hover {
  background-color: #0056b3;
}

input[type="file"] {
  display: none;
}
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-black box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">DNA Module - DNA Nanopore Result</h3>
                    </div>
        
        <div class="box-body">
        <div style="padding-bottom: 10px;">

    <form method="post" enctype="multipart/form-data" action="<?= site_url('dna_nanopore_result/upload_csv'); ?>">
        <div class="form-group">
        <div class="input-group">
            <label class="input-group-btn">
            <span class="btn btn-primary">
                <i class="fa fa-file-excel-o" aria-hidden="true"></i> Choose CSV
                <input type="file" name="csv_file" accept=".csv" required style="display: none;">
            </span>
            </label>
            <input type="text" class="form-control" readonly placeholder="No file chosen">
        </div>
        </div>

    <!-- <label for="csv_file" class="custom-file-upload">
        <i class="fa fa-file-csv" aria-hidden="true"></i> Choose CSV
        </label>
        <input type="file" id="csv_file" name="csv_file" accept=".csv" required> -->
    <!-- <input type="file" name="csv_file" accept=".csv" required> -->
        <button class='btn btn-primary' type="submit"><i class='fa fa-upload' aria-hidden='true'></i>Upload CSV</button>
        <!-- <button class='btn btn-primary' id='addtombol'><i class='fa fa-wpforms' aria-hidden='true'></i> New DNA Nanopore Analysis </button> -->
    </form>

    <hr>

<div class="container mt-3">
    <?php
    $message = $this->session->flashdata('message');
    if (!empty($message)) {
        echo $message;
    }
    ?>
</div>

    <!-- Flash message -->
    <?php if ($this->session->flashdata('success')): ?>
        <p style="color:green;"><?= $this->session->flashdata('success'); ?></p>
    <?php elseif ($this->session->flashdata('error')): ?>
        <p style="color:red;"><?= $this->session->flashdata('error'); ?></p>
    <?php endif; ?>

    <!-- DataTable -->
    <!-- <table id="resultTable" class="display"> -->
        <table class="table table-bordered table-striped tbody" id="resultTable" style="width:100%">
        <thead>
            <tr>
                <th>Sample</th>
                <th>Dups</th>
                <th>GC</th>
                <th>Median_len</th>
                <th>Seqs</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $r): ?>
            <tr>
                <td><?= htmlspecialchars($r->Sample); ?></td>
                <td><?= htmlspecialchars($r->Dups); ?></td>
                <td><?= htmlspecialchars($r->GC); ?></td>
                <td><?= htmlspecialchars($r->Median_len); ?></td>
                <td><?= htmlspecialchars($r->Seqs); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#resultTable').DataTable();
        });
        
document.addEventListener('DOMContentLoaded', function () {
  const fileInput = document.querySelector('input[type="file"][name="csv_file"]');
  const textInput = document.querySelector('.form-control[readonly]');
  
  fileInput.addEventListener('change', function () {
    const fileName = this.files.length > 0 ? this.files[0].name : '';
    textInput.value = fileName;
  });
});


</script>