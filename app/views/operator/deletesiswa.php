<?php
include 'koneksi.php';
$kode =$_GET['id_siswa'];

$data = mysqli_query ($koneksi,"DELETE  FROM data_siswa WHERE id_siswa='$kode'") or die("error hapus data".mysql_error());
	
	header ("location:pendaftarsiswa.php");
?>