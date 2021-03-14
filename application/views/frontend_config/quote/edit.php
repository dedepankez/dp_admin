<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>
<?= $this->session->flashdata('message'); ?>
<div class="Content-wrapper">
	<section class="Content">
		
		<form action="<?= base_url().'frontend_config/quote/update'; ?> " method="post">
                
                    <div class="form-group col-sm-6">
        <input type="hidden" class="form-control" id="id" name="id" value="<?=$quote['id'];?>">
        <label>VISI</label>
        <textarea type="text" class="ckeditor" id="ckeditor" name="visi"><?= $quote['visi']; ?></textarea>
        <label class="mt-2">MISI</label>
        <textarea type="text" class="ckeditor" id="ckeditor" name="misi"><?= $quote['misi']; ?></textarea>
        <label class="mt-2"> MOTTO</label>
        <textarea type="text" class="ckeditor" id="ckeditor" name="motto"><?= $quote['motto']; ?></textarea>
        
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