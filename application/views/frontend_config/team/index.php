<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title;  ?> <a class="btn btn-sm btn-secondary" href=""><strong class="text-white"><i class="fa fa-edit text-white"></i> Edit Front Team</strong></a></h1>
    <?= $this->session->flashdata('message'); ?>
    <div class="card-deck">
        <?php foreach ($team as $t) : ?>
    <div class="card">
    <img src="<?= base_url('assets/img/frontend/team/').$t['image']; ?>" class="card-img-top" alt="..." style="height: 343px;width: 343px;">
    <div class="card-body">
      <h5 class="card-title" align="center"><a class="btn btn-sm btn-secondary" href="<?= base_url('frontend_config/team/edit/').$t['id']; ?>"><strong class="text-white"><i class="fa fa-edit text-white"></i> <?= $t['name']; ?></strong></a></h5>
      <p class="card-text" align="center"><small class="text-info"><?= $t['job']; ?></small></p>
      <p class="card-text" align="center"><span class="text-dark"><?= $t['about']; ?></span></p>
      
    </div>
  </div>
    <?php endforeach; ?>
</div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->








