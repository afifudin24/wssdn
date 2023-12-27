<?php
include "koneksi.php";

$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$agama = $_POST['agama'];
$sekolah_asal = $_POST['sekolah_asal'];

// Handling file upload
$targetDir = "uploads/"; // Change this to the directory where you want to store the uploaded files
$targetFile = $targetDir . basename($_FILES["foto"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if the file is an image
if (isset($_POST["Submit"])) {
    $check = getimagesize($_FILES["foto"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Check if the file already exists
if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size (you can adjust the limit)
if ($_FILES["foto"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Allow certain file formats
$allowedExtensions = array("jpg", "jpeg", "png", "gif");
if (!in_array($imageFileType, $allowedExtensions)) {
    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // If everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// Insert data into the database if file upload is successful
if ($uploadOk == 1) {
    $query = "INSERT INTO data_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal, foto) VALUES ('$nama','$alamat','$jenis_kelamin','$agama','$sekolah_asal','$targetFile')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "Berhasil tambah<br>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
    }
}

?>
<a href="index.php">Kembali</a>
