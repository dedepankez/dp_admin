<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

<div class="Content-wrapper">
	<section class="Content">
		
		<form action="<?= base_url().'frontend_config/menu/update'; ?> " method="post">
                
                    <div class="form-group col-sm-6">
        <input type="hidden" class="form-control" id="id" name="id" value="<?=$menu['id'];?>">
        <label>Nama Menu</label>
        <input type="text" class="form-control" id="menu" name="menu" value="<?=$menu['menu'];?>">
        <label class="mt-2">Nama Url</label>
        <input type="text" class="form-control" id="url" name="url" value="<?=$menu['url'];?>">
        <label class="mt-2">Status</label>
        <select class="form-control mt-2" id="status" name="status">
                                              <option value="<?= $menu['status']; ?>">Default</option>
                                              <option value="0">Active</option>
                                              <option value="1">Unactived</option>
                                              
                        </select>
         <label class="mt-2">Sort</label>
        <input type="text" class="form-control" id="sort" name="sort" value="<?=$menu['sort'];?>">
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