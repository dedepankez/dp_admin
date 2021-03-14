<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        
        <h2>Team</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">

        <div class="row">

          <?php foreach ($team as $t): ?>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
              <img src="<?= base_url('assets/img/frontend/team/'); ?><?= $t['image']; ?>" style="width: 600px; height: 200px;" alt="">
              <h4><?= $t['name']; ?></h4>
              <span><?= $t['job']; ?></span>
              <p>
                <?= $t['about']; ?>
              </p>
              <div class="social">
                <a href=""><i class="icofont-twitter"></i></a>
                <a href=""><i class="icofont-facebook"></i></a>
                <a href=""><i class="icofont-instagram"></i></a>
                <a href=""><i class="icofont-linkedin"></i></a>
              </div>
            </div>
          </div>
          <?php endforeach ?>

        </div>

      </div>
    </section><!-- End Team Section -->

  </main><!-- End #main -->
