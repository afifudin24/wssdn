<?php
// Load file koneksi.php
include "koneksi.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil Data yang Dikirim dari Form
    $nip = $_POST['nip'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];

    // Check if a photo is uploaded
    if ($_FILES['foto']['name'] !== '') {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];

        // Rename the photo by adding the current timestamp
        $fotobaru = date('dmYHis') . $foto;

        // Set the path folder to store the photo
        $path = "images/" . $fotobaru;

        // Process the photo upload
        if (move_uploaded_file($tmp, $path)) {
            // Insert data into the ilkomfina_guru table
            $sql = $pdo->prepare("INSERT INTO ilkomfina_guru(nip, nama, jenis_kelamin, telp, alamat, foto) VALUES(:nip, :nama, :jk, :telp, :alamat, :foto)");
            $sql->bindParam(':nip', $nip);
            $sql->bindParam(':nama', $nama);
            $sql->bindParam(':jk', $jenis_kelamin);
            $sql->bindParam(':telp', $telp);
            $sql->bindParam(':alamat', $alamat);
            $sql->bindParam(':foto', $fotobaru);
            $sql->execute(); // Execute the insert query

            if ($sql) {
                // If the insertion is successful, redirect to the index page
                header("location: index.php");
            } else {
                // If the insertion fails, display an error message
                echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
                echo "<br><a href='form_simpan_guru.php'>Kembali Ke Form</a>";
            }
        } else {
            // If the photo upload fails, display an error message
            echo "Maaf, Gambar gagal untuk diupload.";
            echo "<br><a href='form_simpan_guru.php'>Kembali Ke Form</a>";
        }
    } else {
        // If no photo is uploaded, insert data into the ilkomfina_guru table without a photo
        $sql = $pdo->prepare("INSERT INTO ilkomfina_guru(nip, nama, jenis_kelamin, telp, alamat) VALUES(:nip, :nama, :jk, :telp, :alamat)");
        $sql->bindParam(':nip', $nip);
        $sql->bindParam(':nama', $nama);
        $sql->bindParam(':jk', $jenis_kelamin);
        $sql->bindParam(':telp', $telp);
        $sql->bindParam(':alamat', $alamat);
        $sql->execute(); // Execute the insert query

        if ($sql) {
            // If the insertion is successful, redirect to the index page
            header("location: index.php");
        } else {
            // If the insertion fails, display an error message
            echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
            echo "<br><a href='form_simpan_guru.php'>Kembali Ke Form</a>";
        }
    }
}
?>