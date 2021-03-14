<!DOCTYPE html>
<html>
<head>
<link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

	<title>Print</title>

</head>

<body>

<h3 align="center">Print Crud</h3>
<table class="table"  align="center" cellpadding="1">

		<thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Isi Surat</th>
                                            <th>Nomer Agenda</th>
                                            <th>Pengirim</th>
                                            <th>No. Surat</th>
                                            <th>Tanggal Surat</th>
                                            
                                        </tr>
        </thead>
		
        <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($print as $p) : ?>
                        <tr> 
                            <th scope="row"><?= $i;  ?> </th>
                            <td><?= $p->isi;  ?> </td>
                            <td><?= $p->no_agenda;  ?> </td>
                            <td ><?= $p->pengirim;  ?> </td>
                            <td><?= $p->no_surat;  ?> </td>
                            <td><?= $p->tgl_surat;  ?> </td>
                            
                            

                        </tr>
                        <?php $i++;  ?>
                    <?php endforeach;  ?>
        </tbody>

	



</table>


<script type="text/javascript">
	window.print();
</script>


</body>
</html>
