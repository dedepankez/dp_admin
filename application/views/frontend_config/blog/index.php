<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>
    

<div class="row mt-4">
        <div class="col-12">

            <!-- Flash data -->
            <?php if ($this->session->flashdata('msg')) : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Data berhasil <strong><?= $this->session->flashdata('msg'); ?></strong>
                </div>
            <?php endif; ?>

            <?php if ($this->session->flashdata('err')) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    Data <strong><?= $this->session->flashdata('err'); ?></strong>
                </div>
            <?php endif; ?>

            <div class="row">

                <div class="col">

                    

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="<?= base_url('frontend_config/blog/tambah_blog'); ?>" class="btn btn-primary shadow-sm"><i class="fas fa-fw fa-plus"></i> Tambah Blog</a>
                            <a class="btn btn-sm btn-danger float-right" href="<?= base_url('frontend_config/blog'); ?>"><strong class="text-white"><i class="fas fa-sync text-white"></i> Refresh</strong></a>           
                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped display nowrap" style="width: 100%;" id="dataSm">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Kategori</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Created By</th>
                                            <th>Created At</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

</div>
</div>


            <!-- Modal Hapus -->
            <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
            <div class="modal-header badge-primary">
                <h5 class="modal-title">Hapus <?= $title; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('frontend_config/blog/hapus_blog'); ?>" method="post">
                <div class="modal-body">
                    Apakah anda yakin ingin menghapus data ini?
                    <input type="hidden" name="id" id="id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yakin</button>
                </div>
            </form>
        </div>
    


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->






            
        
