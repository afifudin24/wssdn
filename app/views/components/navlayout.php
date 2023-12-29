<div class="wrap">

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" data-aos="fade-down" data-aos-duration="1000">
        <a class="navbar-brand" href="#"><img src="../img/Logo.png" width="45px" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfile" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownProfile">
                        <a class="dropdown-item" href="<?= BASEURL ?>/profile/tentang_sekolah">Tentang Sekolah</a>
                        <a class="dropdown-item" href="<?= BASEURL ?>/profile/tentang_kepala_sekolah">Kepala Sekolah</a>
                        <a class="dropdown-item" href="<?= BASEURL ?>/profile/sejarah_sekolah">Sejarah Sekolah</a>
                        <a class="dropdown-item" href="<?= BASEURL ?>/profile/visi_misi">Visi, Misi dan Filosofi
                            Pendidikan</a>
                        <a class="dropdown-item" href="#">Jam Sekolah dan Kalender Tahun Pendidikan</a>
                        <a class="dropdown-item" href="<?= BASEURL ?>/profile/prestasi_akademik">Prestasi Akademik</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Manajemen
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= BASEURL ?>/manajemen/kurikulum">Kurikulum</a>
                        <a class="dropdown-item" href="<?= BASEURL ?>/manajemen/sarana_prasarana">Sarana dan
                            Prasarana</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownData" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownData">
                        <a class="dropdown-item" href="<?= BASEURL ?>/dataSiswa/index">Data Siswa</a>
                        <a class="dropdown-item" href="<?= BASEURL ?>/dataGuru/index">Data Guru</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Info
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?= BASEURL ?>/info/agenda">Agenda</a>
                        <a class="dropdown-item" href="<?= BASEURL ?>/info/berita_acara">Berita & Acara</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL ?>/galerifoto">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Alumni</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../kontak/kontak.php">Kontak</a>
                </li>
            </ul>

            <!-- Add this login button -->
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= BASEURL ?>/auth/login">Login</a>
            </li>
        </div>
    </nav>