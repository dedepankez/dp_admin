<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CETAK DISPOSISI</title>

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url('assets/kasir/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="<?= base_url('assets/kasir/'); ?>css/shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Page Content -->
  <div class="container">

    

    <div class="row">
      <div class="col-lg-12">
      <h2 align="center">CETAK REKAPAN DISPOSISI</h2></div>

<div class="card col-lg-12 table-responsive mt-3">

                        <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Surat</th>
                            <th scope="col">No Agenda</th>
                            <th scope="col">Perihal</th>
                            <th scope="col">Tujuan</th>
                            <th scope="col">Isi Disposisi</th>
                            <th scope="col">Sifat</th>
                            <th scope="col">Batas Waktu</th>
                            <th scope="col">Catatan</th>
                            <th scope="col">Tanggal Dibuat</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=1;
                          foreach ($dispo as $s):
                           ?>
                          <tr>

                            <td scope="row"><?= $i++; ?></td>
                            <td><?= $s['no_surat']; ?></td>
                            <td><?= $s['agenda']; ?></td>
                            <td><?= $s['perihal']; ?></td>
                            <td><?= $s['tujuan']; ?></td>
                            <td><?= $s['isi']; ?></td>
                            <td><?= $s['sifat']; ?></td>
                            <td><?= format_indo($s['batas_waktu']); ?></td>
                            <td><?= $s['catatan']; ?></td>
                            <td><?= format_indo($s['created_at']); ?></td>
                            
                          </tr>
                          
                        </tbody>
                      <?php endforeach; ?>
                      </table>
                      
  
  
</div>
















        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<script type="text/javascript">
  window.print();
</script>


  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url('assets/kasir/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/kasir/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
  <script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
  <script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/bootstrap/js/bootstrap.js'?>"></script>

<!-- Datatables -->
  <script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- ckeditor -->
  <script type="text/javascript" src="<?= base_url('assets/'); ?>ckeditor/ckeditor.js"></script>


</body>

</html>


