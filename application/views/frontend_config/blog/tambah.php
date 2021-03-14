<div class="container">
	<h3 align="center">TAMBAH BLOG</h3>
	<div class="row">
		<div class="col sm-12">

			<?= form_open_multipart('frontend_config/blog/tambah_blog'); ?>
						
					<div class="form-group col-sm-6">
					<input type="hidden" name="created_at" value="<?= date('Y-m-d')  ?>">
					<label class="ml-1" for="id_kategori">Kategori</label>
					<select class="form-control" id="id_kategori" name="id_kategori">
					<option>Pilih</option>
					<?php foreach ($kategori as $k):?>
					<option value="<?= $k['id']; ?>"><?= $k['kategori']; ?></option>
					<?php endforeach; ?>
					</select>
					<label class="mt-2 ml-1" for="title" required>Title</label>
					<input type="text" name="title" class="form-control">
					
					<label class="mt-2 ml-1" for="image">Upload Image</label>
					<input type="file" name="image" class="form-control">
					
					<label class="mt-2 ml-1" for="id_kategori">Created_By</label>
					<input class="form-control" type="text" name="created_by" value="<?= $user['name']; ?>" readonly>
					</div>
					<div class="form-group">
					<label class="ml-4"><b>Content</b></label>
					<textarea class="ckeditor" id="ckeditor" name="content" required></textarea>
					</div>
			
			         <div class="form-group-row justify-content-end">
			                <button class="btn btn-sm btn-secondary ml-3" type="submit"><strong class="text-white"><i class="fa fa-user text-white"></i> Simpan</strong></button>
			         </div>
			     <?php form_close() ?>
					
			
		</div>
	</div>
</div>
</div>