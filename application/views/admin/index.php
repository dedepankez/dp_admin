
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> </h1>

    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$total;?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-dark-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Menu</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$totalmenu;?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-clone fa-2x text-dark-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Sub Menu
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$totalsub;?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?=$totalsub;?>%" aria-valuenow="<?=$totalsub;?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="far fa-fw fa-folder-open fa-2x text-dark-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Role</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$totalrole;?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fa fa-ban fa-2x text-dark-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    </div>

<div class="card">
  <h3 class="card-header text-primary">Featured Fast Transite Button</h3>
  <div class="card-body">
    <section class="col-lg-12 connectedSortable">
    <div class="box-body">
        <strong><p>Silahkan klik menu pilihan yang berada di bawah untuk mengelola konten website anda 
          atau pilih ikon-ikon pada Control Panel di bawah ini : </p></strong>
      
      <a href="<?=base_url('admin');?>" class="btn btn-app"><i class="fa fa-th"></i> Dashboard Super Admin</a>
      <a href="<?=base_url('menu');?>" class="btn btn-app"><i class="fa fa-th-large"></i> Menu</a>
      <a href="<?=base_url('menu/submenu');?>" class="btn btn-app"><i class="fa fa-th-large"></i> Sub Menu</a>
      <a href="<?=base_url('menu/sort');?>" class="btn btn-app"><i class="fa fa-th-large"></i> Grup List Sort</a>
      <a href="<?=base_url('admin/account');?>" class="btn btn-app"><i class="fa fa-users"></i> Users Management</a>

      <a href="<?=base_url('menu_product');?>" class="btn btn-app"><i class="fas fa-edit"></i> Kelola Daftar Menu</a>
      
    </div>

</section>
    
  </div>
</div>





   


<!-- end -->    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content