<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>


    <div class="row">
        <div class="col-lg-8">
            <form action="<?= base_url('frontend_config/blog/kategori_backend'); ?>" method="post">
            <div class="input-group col-md-5">
            <input type="text" class="form-control" placeholder="Search Keyword" name="keyword">
            <div class="input-group-append">
             <input class="btn btn-primary" type="submit" id="button-addon2" autocomplete="off" autofocus name="submit"></input>
            </div>

            </div>
            </form>
            <?= $this->session->flashdata('message'); ?>

            
            <h5 class="mt-2">Total Rows : <?= $total_rows; ?>
                   <a href="" class="btn btn-primary btn-sm ml-5 " data-toggle="modal" data-target="#newModal">Add New Menu</a>
            </h5>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($kategori as $m) : ?>
                        <tr> 
                            <th scope="row"><?= ++$start;  ?> </th>
                            <td><?= $m['kategori'];  ?> </td>
                            <td>
                                <div class="badge badge-polos">
                                <?php echo anchor('frontend_config/blog/edit_kategori_backend/'.$m['id'],'<i  class="fa fa-edit alert-success"> Edit</i>')?>
                                 </div>
                                
                                <div class="badge badge-polos" onclick="javascript:return confirm('anda yakin hapus?')">
                                <?php echo anchor('frontend_config/blog/delete_kategori_backend/'.$m['id'],'<i  class="fa fa-trash "> Delete</i>')?>
                                 </div>

                            </td>

                        </tr>
                      
                    <?php endforeach;  ?>
                </tbody>
            </table>
            <?=$this->pagination->create_links();?>
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
                <h5 class="modal-title" id="newModalLabel">Add New Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('frontend_config/blog/kategori_backend'); ?> " method="post">
                <div class="modal-body">
                    <div class="form-group">

                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori Name">
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

