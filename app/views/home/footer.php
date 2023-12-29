<script src="https://unpkg.com/aos@next/dist/aos.js"></script>

<script>
AOS.init();
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script>
         $('.delete-button').click(function () {
            // Ambil ID dari data yang akan dihapus dari data-id atribut
            const id = $(this).data('id');

            // Tambahkan ID ke URL aksi hapus pada modal
            const modal = $('#confirmDeleteModal');
            modal.find('#confirmDeleteButton').attr('data-href', '<?= BASEURL ?>/galerifoto/hapusgaleri/' + id);
            modal.modal('show');
        });

        // Event listener saat tombol konfirmasi hapus di-klik dalam modal
        $('#confirmDeleteButton').click(function () {
            // Ambil URL aksi hapus dari data-href atribut pada tombol
            const deleteUrl = $(this).attr('data-href');

            // Lakukan aksi hapus dengan pergi ke URL aksi hapus
            window.location.href = deleteUrl;
        });
            
    
</script>
<script src="<?= BASEURL ?>/data/js/bootstrap.min4.js"></script>
<!-- Memuat Lightbox untuk tampilan gambar -->
<!-- Memuat Lightbox versi 2.11.3 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

</body>

</html>