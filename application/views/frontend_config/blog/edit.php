<div class="container">
	<h3 align="center">Edit BLOG</h3>
	<div class="row">
		<div class="col sm-12">

			<?= form_open_multipart('frontend_config/blog/update_blog'); ?>
						
					<div class="form-group col-sm-6">
					<input type="hidden" name="id" value="<?= $blog['id']; ?>">
					<label class="ml-1" for="id_kategori">Kategori</label>
					<select class="form-control" id="id_kategori" name="id_kategori">
					<option value="<?= $blog['id_kategori']; ?>">Default</option>
					<?php foreach ($kategori as $k):?>
					<option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
					<?php endforeach; ?>
					</select>
					<label class="mt-2 ml-1" for="title" required>Title</label>
					<input type="text" name="title" class="form-control" value="<?= $blog['title']; ?>">
					
					<label class="mt-2 ml-1" for="image">Image Sebelumnya</label>
					<a href="<?= base_url('assets/img/frontend/blog/').$blog['image']; ?>"><?= $blog['image']; ?></a>
					<div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
					
					<label class="mt-2 ml-1" for="id_kategori">Created_By</label>
					<input class="form-control" type="text" name="created_by" value="<?= $user['name']; ?>" readonly>
					</div>
					<div class="form-group">
					<label class="ml-4"><b>Content</b></label>
					<textarea class="ckeditor" id="ckeditor" name="content" required><?= $blog['content']; ?></textarea>
					</div>
			
			         <div class="form-group-row justify-content-end">
			                <button class="btn btn-sm btn-secondary ml-3" type="submit"><strong class="text-white"><i class="fa fa-edit text-white"></i> Ubah</strong></button>
			         </div>
			     <?php form_close() ?>
					
			
		</div>
	</div>
</div>
</div>