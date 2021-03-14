<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h5 mb-4 text-gray-800"><?= $title;  ?> || No Agenda : <?= $disposisi['no_agenda']; ?> || No Surat : <?= $disposisi['no_surat']; ?> || Tanggal Surat Diterima : <?= format_indo($disposisi['tgl_diterima']); ?> </h1>
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
                        <a href="" align="center"><img src="<?= base_url('assets/img/upload/').$disposisi['file'] ; ?>" width='200px' height='150px' class='img-thumbnail'></a>
                        <div class="card-body">
                          <h5 class="card-title"><a href="<?= base_url('assets/img/upload/').$disposisi['file'] ; ?>"><?= $disposisi['file']; ?></a></h5>
                          <p class="card-text"> <b class="text-danger">Jika Gambar Tidak Muncul Dikarnakan FILE Berformat DOC | XLX| PDF</b> </p>
                          <p class="card-text"><small class="text-muted"></small></p>
                          <a class="btn btn-sm btn-secondary" href="<?= base_url('surat_masuk'); ?>"><strong class="text-white"><i class="fas fa-fw fa-sign-out-alt text-white"></i> Kembali</strong></a>
                        </div>

                        </div>
                        
                    </div>














</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->