 <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>

              <?php
              foreach ($menu as $m):?>
              
               <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('frontend/').$m['url']; ?>"><?= $m['menu']; ?></a></li>
              
              <?php endforeach; ?>
             
              
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Blog Category</h4>
            <ul>
              <?php foreach ($kategori as $k): ?>
              <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('frontend/blog_by_kategori/').$k['id']; ?>"><?= $k['kategori']; ?></a></li>
              <?php endforeach ?>
              
              
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-contact">
            <h4>Contact Us</h4>
            <p>

              <?= $config['jalan']; ?> <br>
              <strong>Kecamatan :</strong> <?= $config['kecamatan']; ?> <br>
              <strong>Kabupaten :</strong> <?= $config['kabupaten']; ?> <br>
              <strong>Provinsi :</strong> <?= $config['provinsi']; ?><br>
              <strong>Phone:</strong> <?= $config['telp']; ?><br>
              <strong>Email:</strong> <?= $config['email']; ?><br>
              
            </p>

          </div>

          <div class="col-lg-3 col-md-6 footer-info">
            <h3>About <?= $config['web_title']; ?></h3>
            <p><?= $config['about']; ?></p>
            <div class="social-links mt-3">
              <?php
       
       foreach ($sosmed as $s):?>
              <a href="<?= $s['url']; ?>" class="<?= $s['class']; ?>"><i class="bx bxl-<?= $s['class']; ?>"></i></a>
              <?php endforeach; ?>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; <?= date('Y'); ?> Copyright <strong><span class="credits"><?= $config['web_title']; ?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/ -->
        Themes by <a href="https://bootstrapmade.com/">ETERNA || BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?= base_url('assets/frontend/'); ?>assets/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/frontend/'); ?>assets/js/main.js"></script>

</body>

</html>