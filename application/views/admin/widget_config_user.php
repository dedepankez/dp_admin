
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

    <div class="row">

    
      <div class="col-sm-12">
                            
                                    <form action="<?= base_url().'admin/update_widget_config_user'; ?> " method="post">
                                        
                                            <div class="form-group col-sm-6">
                                                <input type="hidden" name="id" value="<?= $config['id']; ?>">
                                                
                                                <div class="form-group mt-1">
                                                <label for="font_color_user"><strong class="text-dark">Font Color USER</strong></label>
                                                <select class="form-control" id="font_color_user" name="font_color_user" value="<?= $config['font_color_user']; ?>">
                                                  <option value="<?= $config['font_color_user']; ?>"><?= $config['font_color_user']; ?></option>
                                                  <option value="text-danger">red</option>
                                                  <option value="text-white">white</option>
                                                  <option value="text-primary">blue</option>
                                                  <option value="text-info">blue young</option>
                                                  <option value="text-secondary">abu-abu</option>
                                                  <option value="text-warning">yellow</option>
                                                  <option value="text-success">green</option>
                                                  <option value="text-dark">dark</option>
                                                </select>
                                              </div>
                                              <div class="form-group mt-1">
                                                <label for="font_color_heading_user"><strong class="text-dark">Font Color Heading USER</strong></label>
                                                <select class="form-control" id="font_color_heading_user" name="font_color_heading_user" value="<?= $config['font_color_heading_user']; ?>">
                                                  <option value="<?= $config['font_color_heading_user']; ?>"><?= $config['font_color_heading_user']; ?></option>
                                                  <option value="text-danger">red</option>
                                                  <option value="text-white">white</option>
                                                  <option value="text-primary">blue</option>
                                                  <option value="text-info">blue young</option>
                                                  <option value="text-secondary">abu-abu</option>
                                                  <option value="text-warning">yellow</option>
                                                  <option value="text-success">green</option>
                                                  <option value="text-dark">dark</option>
                                                </select>
                                              </div>
                                              <div class="form-group mt-1">
                                                <label for="jam_font_user"><strong class="text-dark">Jam Font USER</strong></label>
                                                <select class="form-control" id="jam_font_user" name="jam_font_user" value="<?= $config['jam_font_user']; ?>">
                                                  <option value="<?= $config['jam_font_user']; ?>"><?= $config['jam_font_user']; ?></option>
                                                  <option value="text-danger">red</option>
                                                  <option value="text-white">white</option>
                                                  <option value="text-primary">blue</option>
                                                  <option value="text-info">blue young</option>
                                                  <option value="text-secondary">abu-abu</option>
                                                  <option value="text-warning">yellow</option>
                                                  <option value="text-success">green</option>
                                                  <option value="text-dark">dark</option>
                                                </select>
                                              </div>

                                              <div class="form-group mt-1">
                                                <label for="jam_theme_user"><strong class="text-dark">Jam Theme USER</strong></label>
                                                <select class="form-control" id="jam_theme_user" name="jam_theme_user" value="<?= $config['jam_theme_user']; ?>">
                                                  <option value="<?= $config['jam_theme_user']; ?>"><?= $config['jam_theme_user']; ?></option>
                                                  <option value="btn-danger">red</option>
                                                  <option value="btn-white">white</option>
                                                  <option value="btn-primary">blue</option>
                                                  <option value="btn-info">blue young</option>
                                                  <option value="btn-secondary">abu-abu</option>
                                                  <option value="btn-warning">yellow</option>
                                                  <option value="btn-success">green</option>
                                                  <option value="btn-dark">dark</option>
                                                </select>
                                              </div>
                                                
                                            </div>


                                            
                               
                                             <div class="form-group col-sm-6">
                                            <button class="btn btn-sm btn-secondary" type="submit"onclick="javascript:return confirm('anda yakin mau di ubah?')"><strong class="text-white"><i class="fa fa-user text-white"></i> Edit</strong></button>
                                            </div>
                                        
                                    </form>
                          
                         </div>

   


<!-- end -->    
</div>
</div>

<!-- /.container-fluid -->

</div>
<!-- End of Main Content