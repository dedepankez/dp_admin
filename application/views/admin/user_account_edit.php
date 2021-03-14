<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

    <div class="row">
        <div class="col-lg-8">
            <?php foreach ($join as $e) : ?>
            <?= form_open_multipart('admin/update_account'); ?>

            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?=$e->id;?>">
                    <input type="text" class="form-control" id="email" name="email" value="<?=$e->email;?>" readonly>
                </div>
            </div>

            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label"> Full name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?=$e->name;?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-2"> Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $e->image;  ?> " class="img-thumbnail"></div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <div class="form-group">
                        <select type="text" class="form-control" id="role_id" name="role_id">
                            
                            <option value="<?=$e->role_id;?>"><?=$e->role;?></option>
                            <?php foreach ($role as $m) : ?>

                                <option value="<?= $m['id']; ?>"><?= $m['role']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

            <div class="form-group-row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Edit</button>
                </div>
            </div>
            </form>
            <?php endforeach;  ?>
        </div>
    </div>
</div> <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->