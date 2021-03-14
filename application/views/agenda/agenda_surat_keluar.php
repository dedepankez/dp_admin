<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>AGENDA</title>

  <!-- Bootstrap core CSS -->
  <link href="<?= base_url('assets/kasir/'); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template -->
  <link href="<?= base_url('assets/kasir/'); ?>css/shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-info bg-info fixed-top">
    <marquee class="navbar-brand col-sm-10 text-white" href="#"><strong>WELCOME TO <span class="fa fa-book"> </span> AGENDA SURAT KELUAR</strong></marquee>
    <div class="container">
      
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
         
          <li class="nav-item active">
            <a class="nav-link" href="<?= base_url('surat_masuk'); ?>"><strong class="text-white"><i class="fas fa-fw fa-sign-out-alt"></i>BACK</strong>
            </a>

          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

    

    <div class="row">

            <div class="col-sm-12 mt-3">
            <form action="<?= base_url('surat_keluar/agenda'); ?>" method="post">
            <div class="input-group col-md-5">
            <input type="text" class="form-control" placeholder="Masukan /No Surat/Pemohon" name="keyword">
            <div class="input-group-append">
             <input class="btn btn-info" type="submit" id="button-addon2" autocomplete="off" autofocus name="submit"></input>
            </div>


            </div>
            </form>
            </div>
      <div><a class="btn btn-sm btn-danger mt-2 ml-5" href="<?= base_url('surat_keluar/cetak_agenda'); ?>" target="_blank"><strong class="text-white"><i class="fa fa-print text-white"></i> Cetak</strong></a>
        <a class="btn btn-sm btn-info mt-2 ml-2" href="<?= base_url('surat_keluar/filter_period'); ?>"><strong class="text-white"><i class="fa fa-print text-white"></i> Cetak Per Periode</strong></a>
        <button class="btn btn-sm btn-secondary mt-2 ml-2"><strong class="text-white"><i class="fa fa-database text-white"></i> Total Data = <?= $total_rows; ?></strong></button>




      </div>

<div class="card col-lg-12 table-responsive mt-3">

                        <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Surat</th>
                            <th scope="col">Tanggal Dibuat</th>
                            <th scope="col">Jenis Surat</th>
                            <th scope="col">Dusun</th>
                            <th scope="col">RT</th>
                            <th scope="col">RW</th>
                            <th scope="col">Pengelola</th>
                            <th scope="col">Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          
                          foreach ($surat as $s):
                           ?>
                          <tr>

                            <td scope="row"><?= ++$start; ?></td>
                            <td><?= $s['no_surat']; ?></td>
                            <td><?= format_indo($s['created_at']); ?></td>
                            <td><?= $s['jenis_surat']; ?></td>
                            <td><?= $s['dusun']; ?></td>
                            <td><?= $s['rt']; ?></td>
                            <td><?= $s['rw']; ?></td>
                            <td><?= $s['pengelola']; ?></td>
                            <td><?= $s['keterangan']; ?></td>
                            
                          </tr>
                          
                        </tbody>
                      <?php endforeach; ?>
                      </table>
                     
                      <?=$this->pagination->create_links();?>
  
</div>
















        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->




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


