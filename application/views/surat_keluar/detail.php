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
            <div class="form-group">
                <label>No. Surat</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['no_surat']; ?>" readonly>
                <label>Jenis Surat</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['jenis_surat']; ?>" readonly>
                <label>Pemohon</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['pemohon']; ?>" readonly>
                <label>Dusun</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['dusun']; ?>" readonly>
                <label>RT</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['rt']; ?>" readonly>
                <label>RW</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['rw']; ?>" readonly>
            </div>
            
        </div>
        <div class="col">
            <div class="form-group">
                <label>Tanggal Surat</label>
                <input type="text" class="form-control border-left-primary" value="<?= format_indo($surat['created_at']); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Pengelola</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['pengelola']; ?>" readonly>
            </div>

            <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['keterangan']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>File <sup class="text-success">Download</sup></label>
                <?php if ($surat['file'] == '') : ?>
                    <input type="text" class="form-control border-left-danger" value="File tidak ditemukan!" readonly>
                <?php else : ?>
                    <a href="<?= base_url('./assets/img/upload/') . $surat['file']; ?>" class="form-control border-left-primary"><?= $surat['file']; ?></a>
                <?php endif; ?>
            </div>
            <a href="<?= base_url('surat_keluar/ubah/') . $surat['id']; ?>" class="float-right btn btn-primary">Ubah</a>
            <a href="<?= base_url('surat_keluar'); ?>" class="float-right btn btn-warning mr-2">Kembali</a>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->