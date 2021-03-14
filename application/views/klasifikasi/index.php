<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

    <div class="row">
        <div class="col-xl-12">

            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
                     </div>');  ?>


            <?= $this->session->flashdata('message'); ?>
            

            
            <form action="<?= base_url('klasifikasi'); ?>" method="post">
            <div class="input-group col-md-7 mb-2">
            <a href="" class="btn btn-primary" data-toggle="modal" data-target="#newModal">Add New Klasifikasi</a>
            <input type="text" class="form-control ml-5" placeholder="Search Keyword" name="keyword">
            <div class="input-group-append">
             <input class="btn btn-primary" type="submit" id="button-addon2" autocomplete="off" autofocus name="submit"></input>
            </div>

            </div>
            </form>
            <div class="card-body">
            <table class="table table-hover table-responsive table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Uraian</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach ($klasifikasi as $m) : ?>
                        <tr> 
                            <td scope="row"><?= ++$start;  ?> </td>
                            <td><?= $m['nama'];  ?> </td>
                            <td><?= $m['kode'];  ?> </td>
                            <td><?= $m['uraian'];  ?> </td>
                            <td><?= format_indo($m['created_at']) ;  ?> 
                            <td>
                                <div class="dropdown">
                    <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-fw fa-list"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class='dropdown-item text-info' href="<?= base_url('klasifikasi/edit/').$m['id']; ?>"><i class='fa fa-edit'></i> Edit</a>
                        <a href='<?= base_url('klasifikasi/hapus/').$m['id']; ?>' class='dropdown-item text-danger' onclick="javascript:return confirm('anda yakin hapus?')"><i class='fa fa-trash'></i> Hapus</a>
                        
                        
                        
                    </div>
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
                <h5 class="modal-title" id="newModalLabel">Tambah Klasifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('klasifikasi/tambah'); ?>" method="post">
      <div class="modal-body">
               <div class="form-group">
                <input type="hidden" name="created_at" value="<?= date('Y-m-d'); ?>">
               <label for="nama" class="ml-2"><b>Nama</b></label><input type="text"name="nama" id="nama" class="form-control border-left-primary">

               <label for="kode" class="mt-1 ml-2"><b>Kode</b></label>
               <input type="text"name="kode" id="kode" class="form-control border-left-primary">

               <label for="uraian" class="mt-1 ml-2"><b>Uraian</b></label>
               <textarea type="text"name="uraian" id="ckeditor" class="ckeditor border-left-primary"></textarea> 

               </div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary">Reset</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
        </div>
    </div>
</div>


