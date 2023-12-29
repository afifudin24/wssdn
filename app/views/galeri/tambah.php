<html>

<head>
    <title>Tambah Galeri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= BASEURL ?>/data/css/bootstrap.min4.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
</head>

<body>
<div class="container mt-5">
        <h1>Tambah Data Galeri</h1>
        <form method="POST" action="<?= BASEURL ?>/galerifoto/tambahgaleri" enctype="multipart/form-data">
            <div id="inputFields">
            <div class="badge badge-success">Data ke - 1</div>
            <div class="form-group row">
                <label for="title" class="col-sm-2 col-form-label">Title Galeri</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title[]">
                </div>
            </div>
          
            <div class="form-group row">
                <label for="path" class="col-sm-2 col-form-label">Gambar</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control-file" id="path" name="path[]">
                </div>
            </div>
            <hr>
        </div>
        <button type="button" class="btn btn-primary" id="addFields">Tambah <i class="bi bi-chevron-double-down"></i></button>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <button type="submit" class="btn btn-success" name="submit">Simpan Data</button>
                <a href="<?= BASEURL ?>/galerifoto/" class="btn btn-secondary">Batal</a>
            </div>
        </div>
        </form>
        
    </div>


    <script>
        $(document).ready(function() {
            var urutan = 1;
    $("#addFields").click(function() {
        urutan++;
        var newField = '<div class="badge badge-success">Data ke -' + urutan +'</div>' +
        '<div class="form-group row">' +
        '<label for="title" class="col-sm-2 col-form-label">Title Galeri</label>' +
        '<div class="col-sm-10">' +
        '<input type="text" class="form-control" id="title" name="title[]">' +
        '</div>' +
        '</div>' +
        '<div class="form-group row">' +
        '<label for="path" class="col-sm-2 col-form-label">Gambar</label>' +
        '<div class="col-sm-10">' +
        '<input type="file" class="form-control-file" id="path" name="path[]">' +
        '</div>' +
        '</div>' +
        '<hr>'; // Menambah tag penutup </div> pada bagian akhir

        $("#inputFields").append(newField);
    });
});

    </script>

        <script src="https://code.jquery.com/jquery-3.7.1.slim.js" integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc=" crossorigin="anonymous"></script>
    <script src="<?= BASEURL ?>/data/js/jquery.min.js"></script> 
    <script src="<?= BASEURL ?>/data/js/bootstrap.min4.js"></script>
</body>

</html>