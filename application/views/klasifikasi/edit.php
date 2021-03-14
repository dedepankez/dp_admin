<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>


    <div class="Content-wrapper">
        <section class="Content">
            
            <form action="<?= base_url().'klasifikasi/update'; ?> " method="post">
                    
                        <div class="form-group col-sm-6">
                            <input type="hidden" name="id" value="<?= $k['id']; ?>">
                            <label class="ml-2"><i class="fa fa-user"></i><b> Nama</b></label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $k['nama']; ?>">

                            <label class="ml-2"><i class="fa fa-user"></i><b> Kode</b></label>
                            <input type="text" class="form-control" id="kode" name="kode" value="<?= $k['kode']; ?>">

                                <label class="ml-2"><i class="fa fa-user"></i><b> Uraian</b></label>
                                <textarea type="text" name="uraian" id="ckeditor" class="ckeditor border-left-primary"><?= $k['uraian']; ?></textarea>


                        </div>
                        
           
                    <div class="form-group">
                        <button class="btn btn-sm btn-info ml-4" type="submit"><strong class="text-white"><i class="fa fa-user text-white"></i> EDIT</strong></button>
                    </div>
                </form>
        
        </section>
    </div>


            

  
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->






