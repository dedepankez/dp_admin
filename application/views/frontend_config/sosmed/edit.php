<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

<div class="Content-wrapper">
	<section class="Content">
		
		<form action="<?= base_url().'frontend_config/sosmed/update'; ?> " method="post">
                
                    <div class="form-group col-sm-6">
        <input type="hidden" class="form-control" id="id" name="id" value="<?=$sosmed['id'];?>">
        <label>Nama sosmed</label>
        <input type="text" class="form-control" id="class" name="class" value="<?=$sosmed['class'];?>">
        <label class="mt-2">API URL</label>
        <input type="text" class="form-control" id="url" name="url" value="<?=$sosmed['url'];?>">
        <label class="mt-2">Status</label>
        <input type="text" class="form-control" id="status" name="status" value="<?=$sosmed['status'];?>">
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