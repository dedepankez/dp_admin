<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

    <div class="row">
        <div class="col-lg-8">

            <?= form_open_multipart('instansi/update_instansi'); ?>

            <div class="form-group row">
                <input type="hidden" name="id" value="<?= $config['id']; ?>">
                <label for="nama_instansi" class="col-sm-2 col-form-label">Nama Instansi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="<?= $config['nama_instansi'];  ?> ">
                </div>
                <label for="kepala_instansi" class="col-sm-2 col-form-label">Kepala Instansi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="kepala_instansi" name="kepala_instansi" value="<?= $config['kepala_instansi'];  ?> ">
                </div>

                <label for="email_instansi" class="col-sm-2 col-form-label">Email Instansi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email_instansi" name="email_instansi" value="<?= $config['email_instansi'];  ?> ">
                </div>
                <label for="telp_instansi" class="col-sm-2 col-form-label">Telpon Instansi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tlp_instansi" name="telp_instansi" value="<?= $config['telp_instansi'];  ?> ">
                </div>
                <label for="alamat_instansi" class="col-sm-2 col-form-label">Alamat Instansi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tlp_instansi" name="alamat_instansi" value="<?= $config['alamat_instansi'];  ?> ">
                </div>
            </div>

            

            <div class="form-group row">
                <div class="col-sm-2"> Logo</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $config['logo_instansi'];  ?> " class="img-thumbnail"></div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="logo_instansi" name="logo_instansi">
                                <label class="custom-file-label" for="logo_instansi">Choose file</label>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="form-group-row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div> <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
