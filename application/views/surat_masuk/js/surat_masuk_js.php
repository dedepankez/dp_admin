<script>
    // Upload file (name)
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });

    // Preview Gambar
    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    // DataTables - Surat Masuk
    $(document).ready(function() {
        $('#dataSm').DataTable({
            responsive: true,
            "destroy": true,
            "processing": true,
            "serverSide": true,
            "order": [],

            "ajax": {
                "url": "<?= base_url('surat_masuk/ambildata') ?>",
                "type": "POST"
            },
            scrollY: '270px',
            // dom: 'Brftip',

            "columnDefs": [{
                "targets": [2, 4],
                "orderable": false,
                // "width": 5
            }],
        });
    });

    

    // Modal Ubah (pengaturan)
    

    $(document).on("click", "#ubah-role", function() {
        $(".modal-body #id").val($(this).data('id'));
        $(".modal-body #role").val($(this).data('role'));
    });

    // Modal Hapus
    $(document).on("click", "#hapus-pengguna", function() {
        $(".modal-body #id").val($(this).data('id'));
    });
    $(document).on("click", "#hapus-role", function() {
        $(".modal-body #id").val($(this).data('id'));
    });
    
    $(document).on("click", "#hapus-sm", function() {
        $(".modal-body #id").val($(this).data('id'));
    });
    $(document).on("click", "#hapus-sk", function() {
        $(".modal-body #id").val($(this).data('id'));
    });
</script>

