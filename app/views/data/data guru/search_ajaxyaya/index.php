<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Data Guru</title>
<!-- Load File bootstrap.min.css yang ada difolder css -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
.align-middle{
vertical-align: middle !important;
}
</style>
</head>
<body>
<!-- Membuat Menu Header / Navbar -->
<nav class="navbar navbar-inverse" role="navigation">
<div class="container-fluid">
<div class="navbar-header">
<a class="navbar-brand" href="#" style="color: white;"><b>Pencarian Dengan PHP dan AJAX</b></a>
</div>
<p class="navbar-text navbar-right hidden-xs" style="color: white;padding-right: 10px;">
FOLLOW US ON 
<a target="_blank" style="background: #3b5998; padding: 0 5px; border-radius: 4px; color: #f7f7f7; textdecoration: none;" href="https://www.facebook.com/mynotescode">Facebook</a> 
<a target="_blank" style="background: #00aced; padding: 0 5px; border-radius: 4px; color: #ffffff; textdecoration: none;" href="https://twitter.com/mynotescode">Twitter</a> 
<a target="_blank" style="background: #d34836; padding: 0 5px; border-radius: 4px; color: #ffffff; textdecoration: none;" href="https://plus.google.com/118319575543333993544">Google+</a>
<a target="_blank" style="background: #fff; padding: 0 5px; border-radius: 4px; color: #d34836; textdecoration: none;" href="https://www.youtube.com/channel/UCO394itv-u7Tn4CgI3bMYIg">YouTube</a>
</p>
</div>
</nav>
<div style="padding: 0 15px;">
    <a href="form_simpan.php">Tambah Data</a><br><br>

    <!--
    -- Buatsebuah div dengan class row
    -- class row ini berfungsi untuk membagi-bagi layar
    -- di dalam bootstrap, 1 layar penuh (dari kiri ke kanan) dibagi menjadi 12 bagian / Kolom
    -- Atau lebih tepatnya sering disebut dengan GRID
    -- col-xs-12 artinya jika ukuran layar < 768px, maka gunakan 12 kolom
    -- col-sm-6 artinya jika ukuran layar >= 768px, maka gunakan 6 kolom
    -- Untuk lebih jelasnya soal Grid, silahkan buka link ini : http://viid.me/qb4V8P
    -->
    <div class="row">
    <div class="col-xs-12 col-sm-6">
    <!--
    -- Input Group adalah salah satu komponen yang disediakan bootstrap
    -- Untuk lebih jelasnya soal Input Group, silahkan buka link ini : http://viid.me/qb4Mup
    -->
    <div class="input-group">
    <!-- Buatsebuah textbox dan beri id keyword -->
    <input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
    <span class="input-group-btn">
    <!-- Buatsebuah tombolsearch dan beri id btn-search -->
    <button class="btn btn-primary" type="button" id="btn-search">SEARCH</button>
    <a href="index.php" class="btn btn-warning">RESET</a>
    </span>
    </div>
    </div>
    </div>
    <br>
    <!--
    -- Buatsebuah div dengan id="view" yang digunakan untuk menampung data 
    -- yang ada pada tabelsiswa di database
    -->
    <div id="view"><?php include "view.php"; ?></div>
    </div>
    <!-- Load File jquery.min.js yang ada difolderjs -->
    <script src="js/jquery.min.js.js"></script>
    <!-- Load File bootstrap.min.js yang ada difolderjs -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Load file ajax.js yang ada di folder js-->
    <script src="js/ajax.js"></script>
    </body>
    </html>