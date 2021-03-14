<script type="text/javascript">

/*digunakan untuk menyembunyikan form tanggal, bulan dan tahun saat halaman di load */
    $(document).ready(function() {

        $("#tanggalfilter").hide();
        $("#tahunfilter").hide();
        $("#bulanfilter").hide();
        $("#cardbayar").hide();

    });

/*digunakan untuk menampilkan form tanggal, bulan dan tahun*/

    function prosesPeriode(){
        var periode = $("[name='periode']").val();

        if(periode == "tanggal"){
            $("#btnproses").hide();
            $("#tanggalfilter").show();
            $("[name='valnilai']").val('tanggal');

        }else if(periode == "bulan"){
            $("#btnproses").hide();
            $("[name='valnilai']").val('bulan');
            $("#bulanfilter").show();

        }else if(periode == "tahun"){
            $("#btnproses").hide();
            $("[name='valnilai']").val('tahun');
            $("#tahunfilter").show();
        }
    }

/*digunakan untuk menytembunyikan form tanggal, bulan dan tahun*/

    function prosesReset(){
        $("#btnproses").show();

        $("#tanggalfilter").hide();
        $("#tahunfilter").hide();
        $("#bulanfilter").hide();
        $("#cardbayar").hide();

        $("#periode").val('');
        $("#tanggalawal").val('');
        $("#tanggalakhir").val('');
        $("#tahun1").val('');
        $("#bulanawal").val('');
        $("#bulanakhir").val('');
        $("#tahun2").val('');
        $("#targetbayar").empty();

    }

</script>
