<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASEURL ?>/data/css/bootstrap.min4.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
    <title>Form Ubah Siswa</title>
</head>

<body>
  
    <form action="<?= BASEURL ?>/datasiswa/updatesiswa/<?= $data['siswa']['id'] ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $data['siswa']['id']; ?>">
    <div class="container">
    <h2 class="mt-2">Form Ubah Siswa</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" class="form-control" name="nis" value="<?php echo $data['siswa']['nis']; ?>">
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" name="nama" value="<?php echo $data['siswa']['nama']; ?>">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="laki-laki" value="Laki-laki" <?php echo ($data['siswa']['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="laki-laki">
                            Laki-laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="perempuan" value="Perempuan" <?php echo ($data['siswa']['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="perempuan">
                            Perempuan
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telp">Telepon</label>
                    <input type="text" class="form-control" name="telp" value="<?php echo $data['siswa']['telp']; ?>">
                </div>
              
               
            </div>
            <div class="col-md-6">
            <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control" name="alamat"><?php echo $data['siswa']['alamat']; ?></textarea>
                </div>
            <div class="form-group">
                    <label for="foto" class="mb-1">Foto</label>
                    <input type="file" class="form-control-file mb-1" name="foto">
                    <?php
                    if (!empty($data['siswa']['foto'])) {
                        echo "<img src='". BASEURL . "/img/" . $data['siswa']['foto'] . "' class='mt-2' width='100'>";
                    }
                    ?>
                </div>
            </div>
           
               
           
        </div>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <button type="button" name="kirim" id="confirmUbahData" class="btn btn-warning" data-toggle="modal" data-target="#confirmUbahModal">Ubah Data</button>
                <a href="<?= BASEURL ?>/dataSiswa/index" class="btn btn-danger ">Batal</a>
            </div>
        </div>
    </div>
  
</form>

    <div class="modal fade" id="confirmUbahModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-success" id="confirmUpdateButton">Ubah Data</button>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
            document.getElementById('confirmUpdateButton').addEventListener('click', function() {
            // Lakukan submit form setelah konfirmasi
            document.querySelector('form').submit();
        });
        });
        // Tangani konfirmasi update ketika tombol "Ya, Ubah Data" ditekan
      
    </script>
     <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="<?= BASEURL ?>/data/js/jquery.min.js"></script> 
    <script src="<?= BASEURL ?>/data/js/bootstrap.min4.js"></script>
</body>

</html>
