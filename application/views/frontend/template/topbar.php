<!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i><a href="mailto:contact@example.com"><?= $config['email']; ?></a>
        <i class="icofont-phone"></i> <?= $config['telp']; ?>
      </div>
      <div class="social-links">

       <?php
       
       foreach ($sosmed as $s):?>
       
        <a href="https://<?=$s['url']; ?>" class="<?= $s['class']; ?>"><i class="icofont-<?= $s['class']; ?>"></i></i> <small><?= $s['class']; ?></small></a>
       
       <?php endforeach; ?>
       
        
      </div>
    </div>
  </section>