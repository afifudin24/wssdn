<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Siswa Baru</title>
    <style>
    body {

        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-image: url('<?= BASEURL ?>/img/nana.jpg.jpg');
        background-size: cover;
        background-position: center;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .container {
        text-align: center;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    h3 {
        color: #333;
        margin-bottom: 10px;
    }

    h2 {
        color: #007BFF;
        margin-bottom: 20px;
    }

    h3.menu-title {
        color: #333;
        margin-bottom: 15px;
    }

    ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
    }

    li {
        margin-bottom: 15px;
    }

    a {
        text-decoration: none;
        color: #007BFF;
        font-weight: bold;
        font-size: 18px;
        transition: color 0.3s ease-in-out;
    }

    a:hover {
        color: #0056b3;
    }
    </style>
</head>

<body>
    <div class="container">
        <h3>Pendaftaran Siswa Baru</h3>
        <h2>Digital Talent</h2>
        <h3 class="menu-title">Menu</h3>
        <ul>
            <li><a href="<?= BASEURL ?>/operator/new">Daftar Baru</a></li>
            <li><a href="<?= BASEURL ?>/operator/data-siswa">siswa</a></li>
            <li><a href="<?= BASEURL ?>/operator/data-guru">guru</a></li>
        </ul>
    </div>
</body>

</html>