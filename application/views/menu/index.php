<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>


    <div class="row">
        <div class="col-lg-6">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
                     </div>');  ?>


            <?= $this->session->flashdata('message'); ?>

            <a href="" class="btn btn-primary mb-3 " data-toggle="modal" data-target="#newModal">Add New Menu</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr> 
                            <th scope="row"><?= $i;  ?> </th>
                            <td><?= $m['menu'];  ?> </td>
                            <td>
                                <div class="badge badge-polos">
                                <?php echo anchor('menu/edit_menu/'.$m['id'],'<i  class="fa fa-edit alert-success"> Edit</i>')?>
                                 </div>
                                
                                <div class="badge badge-polos" onclick="javascript:return confirm('anda yakin hapus?')">
                                <?php echo anchor('menu/delete_menu/'.$m['id'],'<i  class="fa fa-trash "> Delete</i>')?>
                                 </div>

                            </td>

                        </tr>
                        <?php $i++;  ?>
                    <?php endforeach;  ?>
                </tbody>
            </table>

        </div>

    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->




<!-- Modal -->
<div class="modal fade" id="newModal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?> " method="post">
                <div class="modal-body">
                    <div class="form-group">

                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

