<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Ubah Siswa</title>
</head>

<body>
    <h2>Form Ubah Siswa</h2>
    <form action="<?= BASEURL ?>/datasiswa/updatesiswa/<?= $data['siswa']['id'] ?>" method="post" enctype="multipart/form-data">
        <input type="text" name="id" value="<?php echo $data['siswa']['id']; ?>">
        <table>
            <tr>
                <td>NIS</td>
                <td><input type="text" name="nis" value="<?php echo $data['siswa']['nis']; ?>"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['siswa']['nama']; ?>"></td>
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
                <td>Telepon</td>
                <td><input type="text" name="telp" value="<?php echo $data['siswa']['telp']; ?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat"><?php echo $data['siswa']['alamat']; ?></textarea></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td>
                    <input type="file" name="foto">
                    <?php
                    if (!empty($data['siswa']['foto'])) {
                        echo "<br><img src='img/" . $data['siswa']['foto'] . "' width='100'>";
                    }
                    ?>
                </td>
            </tr>
        </table>
        <hr>
       <button type="submit" name="submit">Ubah Data</button>
        <a href="<?= BASEURL ?>/dataSiswa/index"><input type="button" value="Batal"></a>
    </form>
</body>

</html>