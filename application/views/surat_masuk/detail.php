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
                <label>Kode</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['id_kode']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>No Agenda</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['no_agenda']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Pengirim</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['pengirim']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>No. Surat</label>
                <input type="text" class="form-control border-left-primary" value="<?= $surat['no_surat']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Isi Ringkas</label>
                <textarea id="indeks" cols="30" rows="3" class="form-control border-left-primary" readonly><?= $surat['isi']; ?></textarea>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label>Tanggal Surat</label>
                <input type="text" class="form-control border-left-primary" value="<?= date('d/m/Y', strtotime($surat['tgl_surat'])); ?>" readonly>
            </div>
            <div class="form-group">
                <label>Tanggal Diterima</label>
                <input type="text" class="form-control border-left-primary" value="<?= date('d/m/Y', strtotime($surat['tgl_diterima'])); ?>" readonly>
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
            <a href="<?= base_url('surat_masuk/ubah/') . $surat['id']; ?>" class="float-right btn btn-primary">Ubah</a>
            <a href="<?= base_url('surat_masuk'); ?>" class="float-right btn btn-warning mr-2">Kembali</a>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->