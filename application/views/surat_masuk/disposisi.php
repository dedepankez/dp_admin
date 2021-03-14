<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h5 mb-4 text-gray-800"><?= $title;  ?> || No Agenda : <?= $disposisi['no_agenda']; ?> || No Surat : <?= $disposisi['no_surat']; ?> || Tanggal Surat Diterima : <?= format_indo($disposisi['tgl_diterima']); ?> || <br>Surat Dari : <?=$disposisi['pengirim'];?></h1>
     <button class="btn btn-sm btn-primary"><strong class="text-white" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus text-white"></i> TAMBAH DISPOSISI</strong></button>
    <div class="row">

        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>

    </div>
    
                    <div class="card text-center">
                        <div class="card-header bg-info">
                        <b>Data Disposisi</b>
                        </div>
                      <div class="card-body">
                                    <table class="table table-hover table-stripped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col"class="text-dark">No</th>
                                                <th scope="col"class="text-dark">Tujuan</th>
                                                <th scope="col"class="text-dark">Perihal</th>
                                                <th scope="col"class="text-dark">Isi</th>
                                                <th scope="col"class="text-dark">Sifat</th>
                                                <th scope="col"class="text-dark">Batas Waktu</th>
                                                <th scope="col"class="text-dark">Catatan Dikembalikan Kepada</th>
                                                <th scope="col"class="text-dark">Action</th>
                        
                        
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                            $i = 1;
                                            foreach ($isidis as $d):?>
                                            
                    <td class="text-info"><?= $i++; ?></td>
                    <td class="text-info"><?= $d['tujuan']; ?></td>
                    <td class="text-info"><?= $d['perihal']; ?></td>
                    <td class="text-info"><?= $d['isi']; ?></td>
                    <td class="text-info"><?= $d['sifat']; ?></td>
                    <td class="text-info"><?= format_indo($d['batas_waktu']); ?></td>
                    <td class="text-info"><?= $d['catatan']; ?></td>
                   
                                            <td>
                    <div class="dropdown">
                    <button class="btn btn-sm btn-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-list"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href='<?= base_url('surat_masuk/hapus_disposisi/').$d['id']; ?>' class='dropdown-item text-danger'><i class='fa fa-trash'></i> Hapus</a>
                        <a href='<?= base_url('surat_masuk/lihat_disposisi/').$d['id']; ?>' class='dropdown-item'><i class='fa fa-eye'></i> Lihat</a>
                        <a href='<?= base_url('surat_masuk/cetak_disposisi/').$d['id']; ?>' class='dropdown-item text-success'><i class='fa fa-print'></i> Cetak</a>
                        
                        
                    </div>
                </div>
                                            </td>
                                           
                                        </tbody>
                                        <?php endforeach; ?>
                                    </table>
                                    
                        
                                    
                                    
                                    
                                     </div>
</div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Disposisi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url('surat_masuk/tambah_disposisi'); ?>" method="post">
      <div class="modal-body">
               <div class="form-group">
                <input type="hidden" name="id_surat_masuk" value="<?= $disposisi['id']; ?>">
                <input type="hidden" name="created_at" value="<?= date('Y-m-d'); ?>">
                <label for="perihal" class="ml-2"><b>Perihal</b></label><input type="text"name="perihal" id="perihal" class="form-control border-left-primary">
               <label for="tujuan" class="ml-2"><b>Tujuan</b></label><input type="text"name="tujuan" id="tujuan" class="form-control border-left-primary">

               <label for="isi" class="mt-1 ml-2"><b>Isi</b></label>
               <input type="text"name="isi" id="isi" class="form-control border-left-primary">

              <label for="sifat" class="mt-1 ml-2"><b>Sifat</b></label>
                <select class="form-control" id="sifat" name="sifat">
                    <option>Pilih</option>
                    <option value="Terbuka">Terbuka</option>
                    <option value="Rahasia">Rahasia</option>
                    <option value="Segera">Segera</option>
                    <option value="Umum">Umum</option>
                    <option value="Terbatas">Terbatas</option>
                </select>

                <label for="batas_waktu" class="mt-1 ml-2"><b>Batas Waktu</b></label>
               <input type="date"name="batas_waktu" id="batas_waktu" class="form-control border-left-primary">

               <label for="catatan" class="mt-1 ml-2"><b>Catatan Dikembalikan Kepada</b></label>
               <input type="text"name="catatan" id="catatan" class="form-control border-left-primary">

               </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary">Reset</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>