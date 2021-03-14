<!-- ======= Blog Section ======= -->
    <section id="blog" class="blog mt-3">
      <div class="container">

        <div class="row">

          <div class="col-lg-8 entries">

            <?php foreach ($blog as $b): ?>
              
            
            <article class="entry mt-2">

              <div class="entry-img">
                <img src="<?= base_url('assets/img/frontend/blog/').$b['image']; ?>" alt="" class="img-fluid">
              </div>

              <h2 class="entry-title">
                <a href="blog-single.html"><?= $b['title']; ?></a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href=""><?= $b['created_by']; ?></a></li>
                  <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a href=""><time datetime="2020-01-01"><?= format_indo($b['created_at']); ?></time></a></li>
                  <?php if ($config['access_comment']==0):?>
                  <li class="d-flex align-items-center"><i class="icofont-comment"></i> <a href="blog-single.html">12 Comments</a></li>
                  <?php endif; ?>
                </ul>
              </div>

              <div class="entry-content">
                <p>
                  <?= substr($b['content'], 0,350); ?>
                </p>
                <div class="read-more">
                  <a href="<?= base_url('frontend_config/blog/detail/').$b['id']; ?>">Read More</a>
                </div>
              </div>
              <?php endforeach ?>
            <div class="blog-pagination">
              <?=$this->pagination->create_links();?>
            </div>

          </div><!-- End blog entries list -->

          <div class="col-lg-4">

            <div class="sidebar">

              <h3 class="sidebar-title">Search</h3>
              
              <form action="<?= base_url('frontend/blog'); ?>" method="post">
            <div class="input-group">
            <input type="text" class="form-control" placeholder="Search Keyword" name="keyword">
            <div class="input-group-append">
             <input class="btn btn-dark" type="submit" id="button-addon2" autocomplete="off" autofocus name="submit"></input>
            </div>

            </div>
            </form>

              <h3 class="sidebar-title mt-2">Categories</h3>
              <div class="sidebar-item categories">
                <ul>
                  <?php foreach ($kategori as $k): ?>
                    <li><a href="<?= base_url('frontend/blog_by_kategori/'). $k['id']; ?>"><?= $k['kategori']; ?><span></span></a></li>
                  <?php endforeach ?>
                  
                </ul>

              </div><!-- End sidebar categories-->

              <h3 class="sidebar-title">Recent Posts</h3>
              <div class="sidebar-item recent-posts">
                <?php foreach ($rp as $r): ?>
                  <div class="post-item clearfix">
                  <img src="<?= base_url('assets/img/frontend/blog/').$r['image']; ?>" alt="">
                  <h4><a href="<?= base_url('frontend_config/blog/detail/').$r['id']; ?>"><?= $r['title']; ?></a><br><small><?= $r['created_by']; ?></small></h4>

                  <time datetime="2020-01-01"><?= format_indo($r['created_at']); ?></time>
                </div>
                <?php endforeach ?>
                

              </div>
              <!-- End sidebar recent posts-->

              <!-- <h3 class="sidebar-title">Tags</h3>
              <div class="sidebar-item tags">
                <ul>
                  <li><a href="#">App</a></li>
                  <li><a href="#">IT</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Business</a></li>
                  <li><a href="#">Mac</a></li>
                  <li><a href="#">Design</a></li>
                  <li><a href="#">Office</a></li>
                  <li><a href="#">Creative</a></li>
                  <li><a href="#">Studio</a></li>
                  <li><a href="#">Smart</a></li>
                  <li><a href="#">Tips</a></li>
                  <li><a href="#">Marketing</a></li>
                </ul>

              </div> -->

              <!-- End sidebar tags-->

            </div><!-- End sidebar -->

          </div><!-- End blog sidebar -->

        </div>

      </div>
    </section><!-- End Blog Section -->

  </main><!-- End #main -->