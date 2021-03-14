<div class="container-fluid">

    <!-- Judul & Card -->
    <div class="row">
        <div class="col-10">

            <h3 class="h3 text-gray-800"><?= $title; ?></h3>

            <div class="card shadow-sm my-3">
                <div class="card-body border-left-info rounded-sm">
                    <i class="fa fa-fw fa-info-circle fa-lg"></i> <strong> Silahkan pilih tanggal surat untuk menemukan surat masuk yang diinginkan.</strong>
                </div>
            </div>

        </div>
    </div>
     <!-- PRINT PERIOD -->
    <div class="row">
        <div class="col-10">
            <form action="<?=base_url('crud/print_period');?>" method="post" target="_blank">
                <div class="form-row">
                    <div class="col-3">
                        <label for="startdate">Dari Tanggal:</label>
                        <input type="date" name="startdate" class="form-control shadow-sm border-left-primary" id="startdate" value="<?= set_value('startdate'); ?>">
                        <?= form_error('startdate', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-3">
                        <label for="enddate">Sampai Tanggal: </label>
                        <input type="date" name="enddate" class="form-control shadow-sm border-left-primary" id="enddate" value="<?= set_value('enddate'); ?>">
                        <?= form_error('enddate', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-3">
                        <label for="filterby">Filter berdasarkan:</label>
                        <select name="filterby" class="form-control shadow-sm border-left-primary" id="filterby">
                            <option value="tgl_ditambah">Created_at</option>
                            <option value="tgl_surat">Attribute Field</option>
                            <!-- <option value="tgl_diterima">Tanggal Diterima Surat</option> -->
                        </select>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary shadow-sm" style="margin-top: 2rem;">Cetak</button>
                    </div>
                    

                </div>
            </form>
        </div>
    </div>

    <!-- FILTER -->
    <div class="row mt-5">
        <div class="col-10">
            <form action="" method="post" class="">
                <div class="form-row">
                    <div class="col-3">
                        <label for="startdate">Dari Tanggal:</label>
                        <input type="date" name="startdate" class="form-control shadow-sm border-left-primary" id="startdate" value="<?= set_value('startdate'); ?>">
                        <?= form_error('startdate', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-3">
                        <label for="enddate">Sampai Tanggal: </label>
                        <input type="date" name="enddate" class="form-control shadow-sm border-left-primary" id="enddate" value="<?= set_value('enddate'); ?>">
                        <?= form_error('enddate', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-3">
                        <label for="filterby">Filter berdasarkan:</label>
                        <select name="filterby" class="form-control shadow-sm border-left-primary" id="filterby">
                            <option value="tgl_ditambah">Created_at</option>
                            <option value="tgl_surat">Attribute Field</option>
                            <!-- <option value="tgl_diterima">Tanggal Diterima Surat</option> -->
                        </select>
                    </div>

                    <div class="col">
                        <button type="submit" class="btn btn-primary shadow-sm" style="margin-top: 2rem;">Filter</button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="row mt-3">
        <div class="col-10">
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pengirim</th>
                        <th>No. Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($surat_masuk)) : ?>
                        <?php if (empty($surat_masuk)) : ?>
                            <td colspan="5">
                                <h3 class="text-center">Data tidak ditemukan.</h3>
                            </td>
                        <?php else : ?>
                            <?php foreach ($surat_masuk as $num => $sm) : ?>
                                <tr>
                                    <td><?= $num + 1; ?></td>
                                    <td><?= $sm['pengirim']; ?></td>
                                    <td><?= $sm['no_surat']; ?></td>
                                    <td>
                                        <?php if ($sm['tgl_surat'] == 0000 - 00 - 00) : ?>
                                            <p><b>-</b></p>
                                        <?php else : ?>
                                            <?= date("d/m/Y", strtotime($sm['tgl_surat'])); ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('crud/ubah/') . $sm['id']; ?>" target="_blank" class="btn btn-sm btn-success">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">
                                <h3 class="text-center">Belum ada data.</h3>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /. Container-fluid -->
</div>