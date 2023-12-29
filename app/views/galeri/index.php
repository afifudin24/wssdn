<div class="wrap">
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" data-aos="fade-down" data-aos-duration="1000">
        <a class="navbar-brand" href="#"><img src="img/Logo1.png" width="45px" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <?php echo $data['navbar']; ?>
    </nav>

<div class="container p-5">
    
  <h1 class="text-center my-5">Galeri Foto</h1>
  <?php if (Flasher::check()) : ?>
            <?php $flash = Flasher::flash() ?>
            <div class="alert alert-<?= $flash['tipe'] ?> alert-dismissible  show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <?= $flash['pesan'] ?>
            </div>
        <?php endif; ?>
  <a href="<?= BASEURL ?>/galerifoto/tambah" class="btn btn-primary text-white"  data-aos="fade-up"><i class="bi bi-plus-lg"></i> Tambah Gambar</a>
  <div class="row gallery">
    <?php
    $delay = 0;
  foreach ($data['galeri'] as $data) {
    ?>
   
       <div class="col-md-4 my-4  position-relative" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
    <figure class="text-center">
      <div class="row mx-auto text-center">
        <div class="col-md-12 mx-auto my-1">
        <a class="text-center text-white badge badge-danger delete-button cursor-pointer" style="cursor : pointer;" data-id="<?= $data['id'] ?>">
          <i class="bi bi-trash3-fill"></i> Hapus
        </a>

        </div>
     
      </div>
    
        <a href="<?= BASEURL ?>/imggaleri/<?= $data['path'] ?>" data-lightbox="gallery-item">
            <img src="<?= BASEURL ?>/imggaleri/<?= $data['path'] ?>" class="img-fluid rounded">
          
        </a>
       
        <figcaption class="my-2"><?= $data['title'] ?></figcaption>
    </figure>
</div>

    <?php
  $delay += 100;
  }
    ?>


    <!-- Tambahkan gambar lainnya di sini -->
  </div>
</div>
</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <!-- Tombol untuk mengkonfirmasi hapus -->
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Hapus</button>
            </div>
        </div>
    </div>
</div>