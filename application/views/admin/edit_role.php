<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

<div class="Content-wrapper">
	<section class="Content">
		<?php foreach ($edit as $m) : ?>
		<form action="<?= base_url().'admin/update_role'; ?> " method="post">
                <div class="form-group">
                    <div class="form-group">
                    	<input type="hidden" class="form-control" id="id" name="id" value="<?=$m->id;?>">
                        <input type="text" class="form-control" id="role" name="role" value="<?=$m->role;?>">
                    </div>
                </div>
                <div class="form-group">
                    <button type="Reset" class="btn btn-secondary">Reset</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </form>
	<?php endforeach;  ?>
	</section>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->