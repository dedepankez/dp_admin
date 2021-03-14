<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

<div class="Content-wrapper">
	<section class="Content">
		
		<form action="<?= base_url().'frontend_config/blog/update_kategori_backend'; ?> " method="post">
                
                    <div class="form-group col-sm-6">
        <input type="hidden" class="form-control" id="id" name="id" value="<?=$edit['id'];?>">
        <label>Nama Kategori</label>
        <input type="text" class="form-control" id="kategori" name="kategori" value="<?=$edit['kategori'];?>">
                    </div>
                    
                <div class="form-group">
                    <button type="Reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary"onclick="javascript:return confirm('anda yakin mau di ubah?')">Edit</button>
                </div>
            </form>
	
	</section>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->