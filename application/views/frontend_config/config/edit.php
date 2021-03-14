<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-10">
            <h3 class="h3 text-gray-800"><?= $title; ?></h3>
        </div>
         <?= $this->session->flashdata('message'); ?>
    </div>

    <div class="row my-4">
        <div class="col">
            <?= form_open_multipart('frontend/front_config_update'); ?>
                       
            <div class="form-group">
                <label>Web Title</label>
                <input type="hidden" name="id" value="<?= $front_config['id']; ?>">
                <input type="text" class="form-control border-left-primary" name="web_title" value="<?= $front_config['web_title']; ?>" >
                <label>Jalan</label>
                <input type="text" class="form-control border-left-primary" name="jalan" value="<?= $front_config['jalan']; ?>" >
                <label>Kecamatan</label>
                <input type="text" class="form-control border-left-primary" name="kecamatan" value="<?= $front_config['kecamatan']; ?>" >
                <label>Kabupaten</label>
                <input type="text" name="kabupaten" class="form-control border-left-primary" value="<?= $front_config['kabupaten']; ?>" >
                <label>Provinsi</label>
                <input type="text" name="provinsi" class="form-control border-left-primary" value="<?= $front_config['provinsi']; ?>" >
                <label>Email</label>
                <input type="text" class="form-control border-left-primary" name="email" value="<?= $front_config['email']; ?>" >
                <label>Telpon</label>
                <input type="text" class="form-control border-left-primary" name="telp" value="<?= $front_config['telp']; ?>">
                <label>Map</label>
                <input type="text" class="form-control border-left-primary" name="map" value="<?= $front_config['map']; ?>">
                <label class="mt-2"><strong>AKSES KOMENTAR</strong></label>
                    <select class="form-control mt-2" id="access_comment" name="access_comment">
                                              <option value="<?= $front_config['access_comment']; ?>"><?= $front_config['access_comment']==0? "Comment Actived" : "Comment Not Actived"; ?></option>
                                              <option value="0">Active</option>
                                              <option value="1">Unactived</option>
                                              
                        </select>
                <label class="mt-2"><a href="<?= base_url('assets/img/frontend/about/'). $front_config['about_image'];  ?>"><?= $front_config['about_image']; ?></a> Klik Untuk Lihat File</label>
                <div class="custom-file border-left-primary mt-2">
                                <input type="file" class="custom-file-input" id="about_image" name="about_image">
                                <label class="custom-file-label" for="file">Choose file</label>
                </div>
                <div class="form-group mt-4">
                 <button type="submit" class="float-right btn btn-primary">Ubah Data</button>
                </div>
            </div>
            
        </div>
        <div class="col">
            <div class="form-group">
                <label>About</label>
                <textarea type="text" class="ckeditor" id="ckeditor" name="about"  ><?= $front_config['about']; ?></textarea>
                <label class="mt-2">About 2</label>
                <textarea type="text" class="ckeditor" id="ckeditor" name="about2"><?= $front_config['about2']; ?></textarea>
            </div>
         <?= form_close(); ?>
    </div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->