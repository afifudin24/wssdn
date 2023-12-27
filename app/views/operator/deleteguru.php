<?php
require("koneksi.php");

// Check if the 'id_guru' parameter is set in the URL
if (isset($_GET['id_guru'])) {
    // Get the id_guru value from the URL
    $id_guru = $_GET['id_guru'];

    // Delete data from the database
    $delete_query = "DELETE FROM data_guru WHERE id_guru = $id_guru";
    $result = mysqli_query($koneksi, $delete_query);

    // Check if the deletion was successful
    if ($result) {
        // Redirect to the pendaftarguru.php page
        header("Location: pendaftarguru.php");
        exit();
    } else {
        // Handle the case where the deletion failed
        echo "Error: " . mysqli_error($koneksi);
    }
} else {
    // Redirect to the pendaftarguru.php page if 'id_guru' is not set
    header("Location: pendaftarguru.php");
    exit();
}
?>
