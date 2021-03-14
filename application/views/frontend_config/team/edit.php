<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800" align="center"><?= $title;  ?> </h1>

<div class="Content-wrapper">
	<section class="Content">
		          <?= form_open_multipart('frontend_config/team/update'); ?>
                <div class="card col-sm-6 mx-auto">
                <img src="<?= base_url('assets/img/frontend/team/').$team['image']; ?>" class="card-img-top ml-6" alt="..." style="height: 343px;width: 100%;">
                <div class="custom-file border-left-primary mt-2">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="file">Kosongkan Jika TIdak Dirubah</label>
                </div>
                <input type="hidden" name="id" value="<?= $team['id']; ?>">
                <div class="card-body">
                <input type="text" name="name" class="form-control" value="<?= $team['name']; ?>">
                <input type="text" name="job" class="form-control mt-2" value="<?= $team['job']; ?>">
                <textarea  type="text" name="about" class="form-control mt-2"><?= $team['about']; ?></textarea>
                </div>
		
                    
                <div class="form-group mx-auto">
                    <button type="Reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary"onclick="javascript:return confirm('anda yakin mau di ubah?')">Edit</button>
                </div>
           <?= form_close(); ?>
	
</div>	
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->