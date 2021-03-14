
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-10">
            <h3 class="h3 text-gray-800"><?= $title; ?></h3>
        </div>
         <?= $this->session->flashdata('message'); ?>
    </div>

    <?= form_open_multipart('frontend_config/slider/front_slider_update'); ?>
            <div class="col">
            <div class="card mb-3">
            <img src="<?= base_url('assets/img/frontend/slider/').$slider['image']; ?>" class="card-img-top" alt="..." style="height: 200px;">
            <div class="card-body">
            <h3 class="card-title" align="center"><b class="text-primary">Slider 1</b></h3>
            <div class="form-group">
            <input type="hidden" name="id" value="<?= $slider['id']; ?>">      
            <input type="file" name="image"  class="form-control border-left-primary mb-2 text-center">
            <input type="text" class="form-control" name="title" value="<?= $slider['title']; ?>">
            </div>
            <textarea class="ckeditor" id="ckeditor" name="subtitle"><?= $slider['subtitle']; ?></textarea>
            </div>
          
           
            <div class="card mb-2">
            <img src="<?= base_url('assets/img/frontend/slider/').$slider['image2']; ?>" class="card-img-top" alt="..." style="height: 200px;">
            <div class="card-body">
            <h3 class="card-title" align="center"><b class="text-danger">Slider 2</b></h3>
            <div class="form-group">      
            <input type="file" name="image2"  class="form-control border-left-primary mb-2 text-center">
            <input type="text" class="form-control" name="title2" value="<?= $slider['title2']; ?>">
            </div>
            <textarea class="ckeditor" id="ckeditor" name="subtitle2"><?= $slider['subtitle2']; ?></textarea>
            </div>
            

            <div class="card mb-2">
            <img src="<?= base_url('assets/img/frontend/slider/').$slider['image3']; ?>" class="card-img-top" alt="..." style="height: 200px;">
            <div class="card-body">
            <h3 class="card-title" align="center"><b class="text-success">Slider 3</b></h3>
            <div class="form-group">      
            <input type="file" name="image3"  class="form-control border-left-primary mb-2 text-center">
            <input type="text" class="form-control" name="title3" value="<?= $slider['title3']; ?>">
            </div>
            <textarea class="ckeditor" id="ckeditor" name="subtitle3"><?= $slider['subtitle3']; ?></textarea>
            </div>
            <div class="form-group ml-5">
            <button class="btn btn-sm btn-secondary" type="submit"><strong class="text-white"><i class="fa fa-edit text-white"></i> EDIT</strong></button>
            </div>
            </div> 


    
        
         <?= form_close(); ?>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content