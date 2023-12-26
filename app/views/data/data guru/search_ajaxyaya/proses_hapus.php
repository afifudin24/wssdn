<?php
// Include / load file koneksi.php
include "koneksi.php";

// Check if the "id" parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the photo name before deletion
    $sqlPhoto = $pdo->prepare("SELECT foto FROM ilkomfina_guru WHERE id=:id");
    $sqlPhoto->bindParam(':id', $id);
    $sqlPhoto->execute();
    $photoData = $sqlPhoto->fetch();
    $photoName = $photoData['foto'];

    // Delete the data from the ilkomfina_guru table
    $sqlDelete = $pdo->prepare("DELETE FROM ilkomfina_guru WHERE id=:id");
    $sqlDelete->bindParam(':id', $id);
    $sqlDelete->execute();

    if ($sqlDelete) {
        // If the deletion is successful, delete the associated photo file
        if (!empty($photoName) && file_exists("images/" . $photoName)) {
            unlink("images/" . $photoName);
        }
        // Redirect to the index page
        header("location: index.php");
    } else {
        // If the deletion fails, display an error message
        echo "Maaf, Terjadi kesalahan saat mencoba untuk menghapus data dari database.";
        echo "<br><a href='index.php'>Kembali Ke Halaman Utama</a>";
    }
} else {
    // If the "id" parameter is not set, display an error message
    echo "Maaf, Terjadi kesalahan. ID tidak ditemukan.";
    echo "<br><a href='index.php'>Kembali Ke Halaman Utama</a>";
}
?>