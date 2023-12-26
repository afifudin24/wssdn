<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Ubah Siswa</title>
</head>
<body>
    <h2>Form Ubah Siswa</h2>
    <?php
    include "koneksi.php";
    $id = $_GET['id'];
    $sql = $pdo->prepare("SELECT * FROM ilkomfina WHERE id=:id");
    $sql->bindParam(':id', $id);
    $sql->execute();
    $data = $sql->fetch();
    ?>
    <form action="proses_ubah_siswa.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        <table>
            <tr>
                <td>NIP</td>
                <td><input type="text" name="nis" value="<?php echo $data['nis']; ?>"></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>"></td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    <input type="radio" name="jenis_kelamin" value="Laki-laki" <?php echo ($data['jenis_kelamin'] == 'Laki-laki') ? 'checked' : ''; ?>> Laki-laki
                    <input type="radio" name="jenis_kelamin" value="Perempuan" <?php echo ($data['jenis_kelamin'] == 'Perempuan') ? 'checked' : ''; ?>> Perempuan
                </td>
            </tr>
            <tr>
                <td>Telepon</td>
                <td><input type="text" name="telp" value="<?php echo $data['telp']; ?>"></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><textarea name="alamat"><?php echo $data['alamat']; ?></textarea></td>
            </tr>
            <tr>
                <td>Foto</td>
                <td>
                    <input type="file" name="foto">
                    <?php
                    if (!empty($data['foto'])) {
                        echo "<br><img src='images/" . $data['foto'] . "' width='100'>";
                    }
                    ?>
                </td>
            </tr>
        </table>
        <hr>
        <input type="submit" value="Ubah">
        <a href="index.php"><input type="button" value="Batal"></a>
    </form>
</body>
</html>
