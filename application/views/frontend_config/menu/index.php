<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>


    <div class="row">
        <div class="col-lg">
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif;  ?>

            <form action="<?= base_url('frontend_config/menu/index'); ?>" method="post">
            <div class="input-group col-md-5">
            <input type="text" class="form-control" placeholder="Search Keyword" name="keyword">
            <div class="input-group-append">
             <input class="btn btn-primary" type="submit" id="button-addon2" autocomplete="off" autofocus name="submit"></input>
            </div>

            </div>
            </form>

            <?= $this->session->flashdata('message'); ?>

            
            <div class="card-body"></div>
            <div class="table-responsive">
                <h5>Total Rows : <?= $total_rows; ?>
                      <a href="" class="btn btn-primary btn-sm ml-5 " data-toggle="modal" data-target="#newModal">Add New Menu</a>
                </h5>
                <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Status</th>
                        <th scope="col">Sort</th>
                        <th scope="col">Action</th>


                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($menu)) : ?>
                        <tr>
                            <td colspan="4">
                                <div class="alert alert-danger" role="alert">
                                 Data Not Found!!
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    
                    <?php foreach ($menu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= ++$start;  ?> </th>
                            <td><?= $sm['menu'];  ?> </td>
                            <td><?= $sm['url'];  ?> </td>
                            <td><?= $sm['status']==0? "Active" : "Unactived";  ?> </td>
                            <td><?= $sm['sort'];  ?> </td>
                            

                            <td>
                            <div class="btn btn-polos btn-flat btn-sm">
                                <?php echo anchor('frontend_config/menu/edit/'.$sm['id'],'<i  class="fa fa-edit alert-success"> Edit</i>')?>
                                 </div>
                            <div class="btn btn-polos btn-flat btn-sm" onclick="javascript:return confirm('anda yakin hapus?')">
                                <?php echo anchor('frontend_config/menu/delete/'.$sm['id'],'<i  class="fa fa-trash alert-danger"> Hapus</i>')?>
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
            <form action="<?= base_url('frontend_config/menu/index'); ?> " method="post">
                <div class="modal-body">
                    <div class="form-group">

                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu Name">
                        <input type="text" class="form-control mt-2" id="url" name="url" placeholder="URL Name">
                        <select class="form-control mt-2" id="status" name="status">
                                              <option value="0">Pilih</option>
                                              <option value="0">Active</option>
                                              <option value="1">Unactived</option>
                                              
                        </select>
                        <input type="text" class="form-control mt-2" id="sort" name="sort" placeholder="Sort">
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






