<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Siswa</title>
    <!-- Load File bootstrap.min.css yang ada difolder css -->
    <link href="<?= BASEURL ?>/data/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .align-middle {
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
            </p>
        </div>
    </nav>
    <div style="padding: 0 15px;">
        <a href="form_simpan.php">Tambah Data</a><br><br>

        <!-- Buat sebuah div dengan class row -->
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <!-- Input Group adalah salah satu komponen yang disediakan bootstrap -->
                <div class="input-group">
                    <!-- Buat sebuah textbox dan beri id keyword -->
                    <input type="text" class="form-control" placeholder="Pencarian..." id="keyword">
                    <span class="input-group-btn">
                        <!-- Buat sebuah tombol search dan beri id btn-search -->
                        <button class="btn btn-primary" type="button" id="btn-search">SEARCH</button>
                        <a href="index.php" class="btn btn-warning">RESET</a>
                    </span>
                </div>
            </div>
        </div>
        <br>
        <!-- Buat sebuah div dengan id="view" yang digunakan untuk menampung data yang ada pada tabel siswa di database -->
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">NO</th>
                    <th class="text-center">FOTO</th>
                    <th>NIS</th>
                    <th>NAMA</th>
                    <th>JENIS KELAMIN</th>
                    <th>TELP</th>
                    <th>ALAMAT</th>
                    <th colspan="2">Aksi</th>
                </tr>
                <?php
        $no = 1;
        foreach ($data['siswa'] as $data) {
        ?>
                <tr>
                    <td class="align-middle text-center"><?php echo $no; ?></td>
                    <td class="align-middle text-center">
                        <img src="foto/<?php echo $data['foto']; ?>" width="80" height="80">
                    </td>
                    <td class="align-middle"><?php echo $data['nis']; ?></td>
                    <td class="align-middle"><?php echo $data['nama']; ?></td>
                    <td class="align-middle"><?php echo $data['jenis_kelamin']; ?></td>
                    <td class="align-middle"><?php echo $data['telp']; ?></td>
                    <td class="align-middle"><?php echo $data['alamat']; ?></td>
                    <td class="align-middle">
                        <?php echo "<a href='form_ubah.php?id=".$data['id']."'>Ubah</a>"; ?><br>
                        <?php echo "<a href='proses_hapus.php?id=".$data['id']."'>Hapus</a>"; ?>
                    </td>
                </tr>
                <?php
            $no++;
        }
        ?>
            </table>
        </div>
    </div>
    <!-- Load File jquery.min.js yang ada di folder js -->
    <script src="<?= BASEURL ?>/data/js/jquery.min.js"></script>
    <!-- Load File bootstrap.min.js yang ada di folder js -->
    <script src="<?= BASEURL ?>/data/js/bootstrap.min.js"></script>
    <!-- Load file ajax.js yang ada di folder js -->
    <script src="<?= BASEURL ?>/data/js/ajax.js"></script>
</body>

</html>