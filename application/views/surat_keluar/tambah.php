<div class="container-fluid">

    <div class="row">
        <div class="col-12 mb-4">
            <h3 class="judul h3 text-gray-800"><?= $title; ?></h3>
            <?= form_open_multipart() ?>
            <div class="row mt-4">
                <div class="col">

                    <div class="form-group">
                        <label for="no_surat">No. Surat</label>
                        <input type="hidden" name="created_at" value="<?= date('Y-m-d'); ?>">
                        <input type="text" name="no_surat" id="no_surat" class="form-control <?= form_error('no_surat') ? 'is-invalid' : 'border-left-primary' ?>" value="<?= set_value('no_surat') ?>">
                        <div class="invalid-feedback">
                            <?= form_error('no_surat') ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jenis_surat">Jenis Surat</label>
                        <input type="text" name="jenis_surat" id="jenis_surat" class="form-control <?= form_error('jenis_surat') ? 'is-invalid' : 'border-left-primary' ?>" value="<?= set_value('jenis_surat') ?>">
                        <div class="invalid-feedback">
                            <?= form_error('jenis_surat') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pemohon">Pemohon</label>
                        <input type="text" name="pemohon" id="pemohon" class="form-control <?= form_error('pemohon') ? 'is-invalid' : 'border-left-primary' ?>" value="<?= set_value('pemohon') ?>">
                        <div class="invalid-feedback">
                            <?= form_error('pemohon') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="dusun">Dusun</label>
                        <input type="text" name="dusun" id="dusun" class="form-control <?= form_error('dusun') ? 'is-invalid' : 'border-left-primary' ?>" value="<?= set_value('dusun') ?>">
                        <div class="invalid-feedback">
                            <?= form_error('dusun') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="rt">RT</label>
                        <input type="text" name="rt" id="rt" class="form-control <?= form_error('rt') ? 'is-invalid' : 'border-left-primary' ?>" value="<?= set_value('rt') ?>">
                        <div class="invalid-feedback">
                            <?= form_error('rt') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="rw">RW</label>
                        <input type="text" name="rw" id="rw" class="form-control <?= form_error('rw') ? 'is-invalid' : 'border-left-primary' ?>" value="<?= set_value('rw') ?>">
                        <div class="invalid-feedback">
                            <?= form_error('rw') ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pengelola">Pengelola</label>
                        <input type="text" name="pengelola" id="pengelola" class="form-control <?= form_error('pengelola') ? 'is-invalid' : 'border-left-primary' ?>" value="<?= set_value('pengelola') ?>">
                        <div class="invalid-feedback">
                            <?= form_error('pengelola') ?>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="keterangan">Keterangan</label> <sup>*opsional</sup>
                        <input type="text" name="keterangan" id="keterangan" class="form-control border-left-primary" value="<?= set_value('keterangan') ?>">
                    </div>
                    <div class="form-group">
                        <label for="file">Upload File</label>
                        <div class="custom-file">
                            <input type="file" name="file" class="custom-file-input" id="file">
                            <label class="custom-file-label" for="file">Choose file</label>
                            <small class="text-sm text-info">Format file yang diizinkan .jpg, .png, .pdf dan ukuran maks 2 MB!</small>
                        </div>
                        <?= $this->session->flashdata('err'); ?>
                    </div>
                    <!-- User Saved -->
                    
                    <div class="form-group">
                        <button type="submit" class="float-right btn btn-primary">Tambah Data</button>
                        <a href="<?= base_url('surat_keluar'); ?>" class="float-right btn btn-warning mr-2">Kembali</a>
                    </div>
                </div>
            </div>
            <?= form_close() ?>
        </div>
    </div>

</div>

</div>