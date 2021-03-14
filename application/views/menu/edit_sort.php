<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

<div class="Content-wrapper">
	<section class="Content">
		<?php foreach ($subMenu as $e) : ?>
		<form action="<?= base_url().'menu/update_sort'; ?> " method="post">
                
                    <div class="form-group">
                    	<input type="hidden" class="form-control" id="id" name="id" value="<?=$e->id;?>">
                    </div>

                    

                    <div class="form-group">
                        <input type="text" class="form-control" id="sort" name="sort" value="<?=$e->sort;?>">
                    </div>
                    
                <div class="form-group">
                    <button type="Reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary"onclick="javascript:return confirm('anda yakin mau di ubah?')">Edit</button>
                </div>
            </form>
	<?php endforeach;  ?>
	</section>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->