<html>

<head>
    <title>Aplikasi CRUD dengan PHP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASEURL ?>/data/css/bootstrap.min4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
</head>

<body>
<div class="container mt-5">
        <h1>Tambah Data Siswa</h1>
        <form method="POST" action="<?= BASEURL ?>/datasiswa/tambahsiswa" enctype="multipart/form-data">
            <div id="inputFields">
            <div class="badge badge-success">Data ke - 1</div>
            <div class="form-group row">
                <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nis" name="nis[]">
                </div>
            </div>
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama[]">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
                <div class="col-sm-10">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin[]" id="laki" value="Laki-laki">
                        <label class="form-check-label" for="laki">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="jenis_kelamin[]" id="perempuan" value="Perempuan">
                        <label class="form-check-label" for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label for="telp" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="telp" name="telp[]">
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="alamat" name="alamat[]"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="foto" name="foto[]">
                </div>
            </div>
            <hr>
        </div>
        <button type="button" class="btn btn-primary" id="addFields">Tambah <i class="bi bi-chevron-double-down"></i></button>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success" name="submit">Simpan Data</button>
                <a href="<?= BASEURL ?>/datasiswa/" class="btn btn-secondary">Batal</a>
            </div>
        </div>
        </form>
        
    </div>


    <script>
        $(document).ready(function() {
            var urutan = 1;
    $("#addFields").click(function() {
        urutan++;
        var newField = ' <div class="badge badge-success">Data ke -' + urutan +' </div> <div class="form-group row">' +
            '<label for="nis[]" class="col-sm-2 col-form-label">NIS</label>' +
            '<div class="col-sm-10">' +
            '<input type="text" class="form-control" id="nis[]" name="nis[]">' +
            '</div>' +
            '</div>' +
            '<div class="form-group row">' +
            '<label for="nama[]" class="col-sm-2 col-form-label">Nama</label>' +
            '<div class="col-sm-10">' +
            '<input type="text" class="form-control" id="nama[]" name="nama[]">' +
            '</div>' +
            '</div>' +
            '<div class="form-group row">' +
            '<label class="col-sm-2 col-form-label">Jenis Kelamin</label>' +
            '<div class="col-sm-10">' +
            '<div class="form-check form-check-inline">' +
            '<input class="form-check-input" type="radio" name="jenis_kelamin[]" value="Laki-laki">' +
            '<label class="form-check-label">Laki-laki</label>' +
            '</div>' +
            '<div class="form-check form-check-inline">' +
            '<input class="form-check-input" type="radio" name="jenis_kelamin[]" value="Perempuan">' +
            '<label class="form-check-label">Perempuan</label>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '<div class="form-group row">' +
            '<label for="telp[]" class="col-sm-2 col-form-label">Telepon</label>' +
            '<div class="col-sm-10">' +
            '<input type="text" class="form-control" id="telp[]" name="telp[]">' +
            '</div>' +
            '</div>' +
            '<div class="form-group row">' +
            '<label for="alamat[]" class="col-sm-2 col-form-label">Alamat</label>' +
            '<div class="col-sm-10">' +
            '<textarea class="form-control" id="alamat[]" name="alamat[]"></textarea>' +
            '</div>' +
            '</div>' +
            '<div class="form-group row">' +
            '<label for="foto[]" class="col-sm-2 col-form-label">Foto</label>' +
            '<div class="col-sm-10">' +
            '<input type="file" class="form-control-file" id="foto[]" name="foto[]">' +
            '</div>' +
            '</div> <hr>';
            ;
        $("#inputFields").append(newField);
    });
});

    </script>

        <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="<?= BASEURL ?>/data/js/jquery.min.js"></script> 
    <script src="<?= BASEURL ?>/data/js/bootstrap.min4.js"></script>
</body>

</html>