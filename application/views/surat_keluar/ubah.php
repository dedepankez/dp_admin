<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-10">
            <h3 class="h3 text-gray-800"><?= $title; ?></h3>
        </div>
    </div>

    <div class="row my-4">
        <div class="col">
            <?= form_open_multipart('surat_keluar/update'); ?>
                       
            <div class="form-group">
                <label>No. Surat</label>
                <input type="hidden" name="id" value="<?= $surat['id']; ?>">
                <input type="text" class="form-control border-left-primary" name="no_surat" value="<?= $surat['no_surat']; ?>" >
                <label>Jenis Surat</label>
                <input type="text" class="form-control border-left-primary" name="jenis_surat" value="<?= $surat['jenis_surat']; ?>" >
                <label>Pemohon</label>
                <input type="text" class="form-control border-left-primary" name="pemohon" value="<?= $surat['pemohon']; ?>" >
                <label>Dusun</label>
                <input type="text" name="dusun" class="form-control border-left-primary" value="<?= $surat['dusun']; ?>" >
                <label>RT</label>
                <input type="text" name="rt" class="form-control border-left-primary" value="<?= $surat['rt']; ?>" >
                <label>RW</label>
                <input type="text" class="form-control border-left-primary" name="rw" value="<?= $surat['rw']; ?>" >
            </div>
            
        </div>
        <div class="col">
            <div class="form-group">
                <label>Tanggal Surat Dibuat</label>
                <input type="text" class="form-control border-left-primary" name="created_at" value="<?= format_indo($surat['created_at']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Pengelola</label>
                <input type="text" class="form-control border-left-primary" name="pengelola" value="<?= $surat['pengelola']; ?>" >
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control border-left-primary" name="keterangan" value="<?= $surat['keterangan']; ?>" >
            </div>
            <div class="form-group row">
                <div class="col-sm-2"> File</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <a href="<?= base_url('assets/img/upload/') . $surat['file'];  ?>"><?= $surat['file']; ?></a>
                            </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file">
                                <label class="custom-file-label" for="file">Choose file</label>
                            </div>
                        </div>

                    </div>
                </div>

            <button type="submit" class="float-right btn btn-primary">Ubah Data</button>
            <a href="<?= base_url('surat_keluar'); ?>" class="float-right btn btn-warning ml-2">Kembali</a>
        </div>
         <?= form_close(); ?>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->