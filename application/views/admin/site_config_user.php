
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

    <div class="row">

    
      <div class="col-sm-12">
                            
                                    <form action="<?= base_url().'admin/update_site_config_user'; ?> " method="post">
                                        
                                            <div class="form-group col-sm-6">
                                                <label><strong class="text-dark">Site Title USER</strong></label>
                                                <input type="hidden" name="id" value="<?= $config['id']; ?>">
                                                <input type="text" class="form-control" id="site_title_user" name="site_title_user" value="<?= $config['site_title_user']; ?>">
                                                <label class="mt-1"><strong class="text-dark">Icon Sidebar USER</strong></label>
                                                <input type="text" class="form-control" id="icon_sidebar_user" name="icon_sidebar_user" value="<?= $config['icon_sidebar_user']; ?>">
                                                <div class="form-group mt-1">
                                                <label for="theme_sidebar_user"><strong class="text-dark">Theme Sidebar USER</strong></label>
                                                <select class="form-control" id="theme_sidebar_user" name="theme_sidebar_user" value="<?= $config['theme_sidebar_user']; ?>">
                                                  <option value="<?= $config['theme_sidebar_user']; ?>"><?= $config['theme_sidebar_user']; ?></option>
                                                  <option value="danger">red</option>
                                                  <option value="primary">blue</option>
                                                  <option value="info">blue young</option>
                                                  <option value="secondary">abu-abu</option>
                                                  <option value="warning">yellow</option>
                                                  <option value="success">green</option>
                                                  <option value="dark">dark</option>
                                                </select>
                                              </div>
                                              <div class="form-group mt-1">
                                                <label for="theme_navbar_user"><strong class="text-dark">Theme Navbar USER</strong></label>
                                                <select class="form-control" id="theme_navbar_user" name="theme_navbar_user" value="<?= $config['theme_navbar_user']; ?>">
                                                  <option value="<?= $config['theme_navbar_user']; ?>"><?= $config['theme_navbar_user']; ?></option>
                                                  <option value="danger">red</option>
                                                  <option value="primary">blue</option>
                                                  <option value="info">blue young</option>
                                                  <option value="secondary">abu-abu</option>
                                                  <option value="warning">yellow</option>
                                                  <option value="success">green</option>
                                                  <option value="dark">dark</option>
                                                  <option value="white">white</option>
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