<main id="main">

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials mt-3">
      <div class="container">
        <div class="section-title mt-1">
          <h2>Category <?= $getkat['kategori']; ?></h2>
          <form action="<?= base_url('frontend/blog'); ?>" method="post">
            <div class="input-group col-lg-4">
            <input type="text" class="form-control" placeholder="Search Keyword" name="keyword">
            <div class="input-group-append">
             <input class="btn btn-dark" type="submit" id="button-addon2" autocomplete="off" autofocus name="submit"></input>
            </div>

            </div>
        </div>
        </form>

        <div class="row">
          <?php foreach ($getblogkat as $bk) :?>
          <div class="col-lg-4 mb-2">
            <div class="testimonial-item mt-4">
              <img src="<?= base_url('assets/img/frontend/blog/'). $bk['image']; ?>" class="testimonial-img" alt="">
              <h3><?= $bk['title']; ?></h3>
              <h4><?= $bk['created_by']; ?></h4>
              <p>
                <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                <?= substr($bk['content'], 0,100); ?>
                <i class="bx bxs-quote-alt-right quote-icon-right"></i>
              </p>
              <div class="read-more text-right">
                  <a href="<?= base_url('frontend_config/blog/detail/').$bk['id']; ?>">Read More</a>
                </div>
            </div>
          </div>
        <?php endforeach; ?>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

  </main><!-- End #main -->