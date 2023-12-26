<html>

<head>
    <title>Multyple Upload</title>

    <!-- Load File bootstrap.min.css yang ada di folder css -->
    <link href="<?= BASEURL ?>/galeri/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <!-- Membuat Menu Header / Navbar -->
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#" style="color: white;"><b>UPLOAD AJAX</b></a>
            </div>
            <p class="navbar-text navbar-right hidden-xs" style="margin-right: auto;">
                <a href="http://www.mynotescode.com" style="color: white;" class="navbar-link">www.mynotescode.com</a>
            </p>
        </div>
    </nav>

    <!-- Isi konten -->
    <div class="row" style="padding: 0 15px;">
        <div class="col-xs-12">
            <!-- Membuat form upload data/gambar -->
            <form method="post" id="multiple_upload_form" enctype="multipart/form-data" action="upload.php">
                <!-- Untuk mengecek apakah sedang di submit atau tidak -->
                <input type="hidden" name="image_form_submit" value="1" />

                <!-- Mengambil gambar -->
                <label>Ambil Gambar</label>
                <input type="file" name="images[]" id="images" multiple accept="image/*" />
            </form>
        </div>

        <hr>

        <!-- Menampilkan gambar yang di ambil -->
        <div class="col-xs-12" id="images_preview"></div>
    </div>

    <!-- Load File jquery.min.js yang ada di folder js -->
    <script type="text/javascript" src="<?= BASEURL ?>/galeri/js/jquery.min.js"></script>

    <!-- Load File jquery.form.js yang ada di folder js -->
    <script type="text/javascript" src="<?= BASEURL ?>/galeri/js/jquery.form.js"></script>

    <!-- Load File main.js yang ada di folder js -->
    <script type="text/javascript" src="<?= BASEURL ?>/galeri/js/main.js"></script>
</body>

</html>