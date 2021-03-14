<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar  -->
        <nav class="navbar navbar-expand navbar-light bg-<?= $config['theme_navbar_user'] ; ?> topbar mb-4 static-top shadow">



            <!-- Sidebar Toggle (Topbar)   -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="btn btn-sm <?= $config['jam_theme_user']; ?>" href=""><strong class="<?= $config['jam_font_user']; ?>"><i class="far fa-clock <?= $config['jam_font_user']; ?>"></i> <?php echo format_indo(date('Y-m-d H:i:s'));?></strong></a>
                            
                            </li>
                            
            
                        </ul>
                        

            <!-- Topbar Navbar-->
            <ul class="navbar-nav ml-auto">

                

            <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-dark small"><?= $user['name']; ?> </span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['image']; ?>">
                    </a>
                    
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>
                <li class="nav-link mt-3"><a class="btn btn-sm <?= $config['jam_theme_user']; ?>" href="<?= base_url('frontend'); ?>" target="_blank"><strong class="text-white"><i class="fas fa-fw fa-sign-out-alt text-white"></i></strong></a></li>
            </ul>

        </nav>
        <!-- End of Topbar -->