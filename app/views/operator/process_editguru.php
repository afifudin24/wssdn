<?php
require("koneksi.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $id_guru = $_POST["id_guru"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $jenis_kelamin = $_POST["jenis_kelamin"];
    $agama = $_POST["agama"];
    $lulusan = $_POST["lulusan"];

    // Update data in the database
    $update_query = "UPDATE data_guru SET nama='$nama', alamat='$alamat', jenis_kelamin='$jenis_kelamin', agama='$agama', lulusan='$lulusan' WHERE id_guru='$id_guru'";
    $result = mysqli_query($koneksi, $update_query);

    // Check if the update was successful
    if ($result) {
        // Redirect to pendaftarguru.php after successful update
        header("Location: pendaftarguru.php");
        exit();
    } else {
        // Handle the case where the update failed
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // Redirect to pendaftarguru.php if the form is not submitted
    header("Location: pendaftarguru.php");
    exit();
}
?>
