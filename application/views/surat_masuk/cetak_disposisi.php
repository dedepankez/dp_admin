<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $title; ?> </title>

    <!-- Custom fonts for this template-->
    
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="icon" type="image/png" href="<?= base_url('assets/login_v1/'); ?>images/icons/favicon.ico"/>
    
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/'); ?>datatables/datatables.min.css"/>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">



    <div class="row">
    <div class="col-sm-12">
        <table border="1" style="margin-left: 100px">
        <tr>

            <th>
        <img src="<?= base_url('assets/img/profile/').$config['logo_instansi'] ; ?>" width='70px' height='50px' class='img-thumbnail mb-4' >
            </th>
            <th><h2 style="margin-bottom: 4px;margin-left: 180px"><?= $config['nama_instansi']; ?><br>
                </h2><h8 style="margin-left: 200px"><?= $config['alamat_instansi']; ?></h8><br><h7 style="margin-left: 200px">email :<?= $config['email_instansi']; ?> telp : <?= $config['telp_instansi']; ?></h7>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                
        </tr>
            <tr>
                
                <td colspan="3" align="center"><strong>Lembar Disposisi</strong></td>

            </tr>
            <tr>

                <td colspan="3" align="left">

                    <?php
                    
                    foreach ($join as $n):?>
                    
                    Surat Dari&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp; <b><?= $n['pengirim']; ?></b>     <br>
                    Nomor Surat&nbsp;&nbsp; :&nbsp; <?= $n['nomor']; ?>   <br>
                    Tanggal Surat&nbsp;&nbsp;:&nbsp; <?= format_indo($n['tanggal']); ?>        <br>
                    Perihal&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;<?= $n['perihal']; ?>      <br> <br>
                    



                </td>
            </tr>
            <tr>
                <td colspan="3" align="left">
                    Tanggal Terima&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<?= format_indo($n['diterima']); ?><br>
                    Nomor Agenda&nbsp;&nbsp; :&nbsp;<?= $n['agenda']; ?>        <br>
                    Disposisi Kepada&nbsp;:&nbsp;<?= $n['tujuan']; ?>        <br><br>


                    

                </td>
            </tr>

            <tr>
                <td colspan="3" align="left">Isi Disposisi :&nbsp;<?= $n['isi']; ?><br><br><br>
               


                
                </td>
            </tr>



            <tr>
                <td colspan="3" align="left">Dikembalikan Dan Diserahkan Kepada :&nbsp;<b><?= $n['catatan']; ?></b>
               


                
                </td>
            </tr>

            <tr>
                <td colspan="3" align="left">Catatan&nbsp;&nbsp;&nbsp;&nbsp;: <br><br>
                </td>
            </tr>
            
            <tr>
                <td colspan="3" align="center">
                    <?= $config['nama_instansi']; ?>, <?= format_indo($n['created_at']); ?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <strong>Kepala Instansi</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br><br><br>
                    
                    <br>
                    <?= $config['kepala_instansi']; ?>&nbsp;&nbsp;&nbsp;

                </td>
            </tr>
        </table>
        <?php endforeach; ?>

    </div>
  </div>





































<script type="text/javascript">
    window.print();
</script>
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/bootstrap/js/bootstrap.js'?>"></script>

<!-- Datatables -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>datatables/datatables.min.js"></script>
<!-- ckeditor -->
<script type="text/javascript" src="<?= base_url('assets/'); ?>ckeditor/ckeditor.js"></script>
<script src="<?= base_url('assets/'); ?>canvas_js/canvasjs.min.js"></script>






<!-- pemanggilan Ajax-->
<script>
    //pengconvertan browse image
    $('.custom-file-input').on('change', function() {
        let filename = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(filename);
    });

    $('.form-check-input').on('click', function() {
        const menuId = $(this).data('menu');
        const roleId = $(this).data('role');


        $.ajax({
            url: "<?= base_url('admin/changeaccess'); ?>",
            type: 'post',
            data: {
                menuId: menuId,
                roleId: roleId
            },
            success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
            }
        })
    });
</script>
</body>

</html>
