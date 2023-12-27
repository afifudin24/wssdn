<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran Siswa</title>
    <style>
    /* Your CSS styles */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
        display: cover;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }

    h2 {
        color: #007BFF;
        font-size: 28px;
        margin-bottom: 20px;
        justify-content: center;
        align-items: center;
    }

    form {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        width: 80%;
        /* Adjust the form width */
        max-width: 600px;
        margin: auto;
    }

    table {
        width: 100%;
    }

    tr,
    td {
        padding: 10px;
    }

    textarea {
        width: 100%;
        height: 100px;
        resize: vertical;
        padding: 8px;
        box-sizing: border-box;
    }

    input[type="text"],
    select {
        width: calc(100% - 16px);
        padding: 8px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    input[type="submit"] {
        background-color: #007BFF;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #0056b3;
    }

    img {
        max-width: 100%;
        height: auto;
    }
    </style>
</head>

<body>
    <center>
        <h2>Formulir Pendaftaran Siswa</h2>
    </center>


    <form method="POST" action="" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Foto</td>
                <td>
                    <?php
                    if (!empty($data['siswa']['foto'])) {
                        echo '<img src="' . $data['siswa']['foto'] . '" alt="Foto">';
                    } else {
                        echo 'No photo available';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>Ganti Foto</td>
                <td><input type="file" name="foto"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td>
                    <input type="hidden" name="id_siswa" value="<?php echo $data['siswa']['id_siswa']; ?>">
                    <input type="text" name="nama" value="<?php echo $data['siswa']['nama']; ?>"
                        placeholder="Nama lengkap">
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    <textarea type="textarea" name="alamat"><?php echo $data['siswa']['alamat']; ?></textarea>
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki"
                        <?php echo ($data['siswa']['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki
                    <input type="radio" name="jenis_kelamin" value="Perempuan"
                        <?php echo ($data['siswa']['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>> Perempuan
                </td>
            </tr>
            <tr>
                <td>Agama</td>
                <td>
                    <select class="form-control" name="agama" id="agama">
                        <?php foreach ($data['agama'] as $k) : ?>
                        <?php if ($k['id_agama'] == $data['siswa']['agama']) : ?>
                        <option value="<?= $k['id_agama'] ?>" selected><?= $k['nama_agama'] ?></option>
                        <?php else : ?>
                        <option value="<?= $k['id_agama'] ?>"><?= $k['nama_agama'] ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Sekolah Asal</td>
                <td><input type="text" name="sekolah_asal" value="<?php echo $data['siswa']['sekolah_asal']; ?>"></td>
            </tr>
            <tr>
                <td><input type="submit" name="Submit" value="Simpan"></td>
            </tr>
        </table>
    </form>

</body>

</html>