<?php
// Include / load file koneksi.php
include "koneksi.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil Data yang Dikirim dari Form
    $id = $_POST['id'];
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // Check if a new photo is uploaded
    if ($_FILES['foto']['name'] !== '') {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        // Rename the photo by adding the current timestamp
        $fotobaru = date('dmYHis') . $foto;

        // Set the path folder to store the photo
        $path = "images/" . $fotobaru;

        // Process the photo upload
        if (move_uploaded_file($tmp, $path)) {
            // Delete the old photo file if it exists
            $oldPhoto = $_POST['old_foto'];
            if (file_exists("images/" . $oldPhoto)) {
                unlink("images/" . $oldPhoto);
            }

            // Update the data in the ilkomfina_guru table
            $sql = $pdo->prepare("UPDATE ilkomfina_guru SET nip=:nip, nama=:nama, jenis_kelamin=:jk, telp=:telp, alamat=:alamat, foto=:foto WHERE id=:id");
            $sql->bindParam(':id', $id);
            $sql->bindParam(':nip', $nip);
            $sql->bindParam(':nama', $nama);
            $sql->bindParam(':jk', $jenis_kelamin);
            $sql->bindParam(':telp', $telp);
            $sql->bindParam(':alamat', $alamat);
            $sql->bindParam(':foto', $fotobaru);
            $sql->execute(); // Execute the update query

            if ($sql) {
                // If the update is successful, redirect to the index page
                header("location: index.php");
            } else {
                // If the update fails, display an error message
                echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
                echo "<br><a href='form_ubah_guru.php?id=" . $id . "'>Kembali Ke Form</a>";
            }
        } else {
            // If the photo upload fails, display an error message
            echo "Maaf, Gambar gagal untuk diupload.";
            echo "<br><a href='form_ubah_guru.php?id=" . $id . "'>Kembali Ke Form</a>";
        }
    } else {
        // If no new photo is uploaded, update the data without changing the existing photo
        $sql = $pdo->prepare("UPDATE ilkomfina_guru SET nip=:nip, nama=:nama, jenis_kelamin=:jk, telp=:telp, alamat=:alamat WHERE id=:id");
        $sql->bindParam(':id', $id);
        $sql->bindParam(':nip', $nip);
        $sql->bindParam(':nama', $nama);
        $sql->bindParam(':jk', $jenis_kelamin);
        $sql->bindParam(':telp', $telp);
        $sql->bindParam(':alamat', $alamat);
        $sql->execute(); // Execute the update query

        if ($sql) {
            // If the update is successful, redirect to the index page
            header("location: index.php");
        } else {
            // If the update fails, display an error message
            echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
            echo "<br><a href='form_ubah_guru.php?id=" . $id . "'>Kembali Ke Form</a>";
        }
    }
}
?>