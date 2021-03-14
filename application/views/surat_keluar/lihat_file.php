<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h5 mb-4 text-gray-800"><?= $title;  ?> || No Surat : <?= $sk['no_surat']; ?> || Tanggal Surat : <?= format_indo($sk['created_at']); ?> </h1>
    <div class="row">

        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    


                    <div class="card text-center">
                        <div class="card-header">
                        <b>File</b>
                        </div>
                        <div class="card">
                        <a href="" align="center"><img src="<?= base_url('assets/img/upload/').$sk['file'] ; ?>" width='200px' height='150px' class='img-thumbnail'></a>
                        <div class="card-body">
                          <h5 class="card-title"><a href="<?= base_url('assets/img/upload/').$sk['file'] ; ?>"><?= $sk['file']; ?></a></h5>
                          <p class="card-text"> <b class="text-danger">Jika Gambar Tidak Muncul Dikarnakan FILE Berformat DOC | XLX| PDF</b> </p>
                          <p class="card-text"><small class="text-muted"></small></p>
                          <a class="btn btn-sm btn-secondary" href="<?= base_url('surat_keluar'); ?>"><strong class="text-white"><i class="fas fa-fw fa-sign-out-alt text-white"></i> Kembali</strong></a>
                        </div>

                        </div>
                        
                    </div>














</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->