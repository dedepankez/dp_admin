<!DOCTYPE html>
<html>
<head>
<link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

	<title>Print Period</title>

</head>

<body>

<h3 align="center">Print Periode Crud</h3>
<table class="table"  align="center" cellpadding="1">

		<thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pengirim</th>
                                            <th>No. Surat</th>
                                            <th>Tanggal Surat</th>
                                            
                                            
                                        </tr>
        </thead>
		
        <tbody>
                    <?php if (isset($surat_masuk)) : ?>
                        <?php if (empty($surat_masuk)) : ?>
                            <td colspan="5">
                                <h3 class="text-center">Data tidak ditemukan.</h3>
                            </td>
                        <?php else : ?>
                            <?php foreach ($surat_masuk as $num => $sm) : ?>
                                <tr>
                                    <td><?= $num + 1; ?></td>
                                    <td><?= $sm['pengirim']; ?></td>
                                    <td><?= $sm['no_surat']; ?></td>
                                    <td>
                                        <?php if ($sm['tgl_surat'] == 0000 - 00 - 00) : ?>
                                            <p><b>-</b></p>
                                        <?php else : ?>
                                            <?= date("d/m/Y", strtotime($sm['tgl_surat'])); ?>
                                        <?php endif; ?>
                                    </td>
                                    
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">
                                <h3 class="text-center">Belum ada data.</h3>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </tbody>

	



</table>


<script type="text/javascript">
	window.print();
</script>


</body>
</html>
