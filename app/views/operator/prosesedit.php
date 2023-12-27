<?php
//if(isset($_POST['simpan'])) {
	include 'koneksi.php';
	$kode 		= $_POST['id_siswa'];
	$nama 		= $_POST['nama'];
	$alamat 	= $_POST['alamat'];
	$jk 		= $_POST['jenis_kelamin'];
	$agama		= $_POST['agama'];
	$sekolah	=$_POST['sekolah_asal'];



		mysqli_query($koneksi,"update data_siswa set nama='$nama',alamat='$alamat',jenis_kelamin='$jk',agama='$agama',sekolah_asal='$sekolah' where id_siswa='$kode'");
		//if($data){
			header("location:pendaftarsiswa.php");
		//}else{
		//	echo  "maaf anda kurang beruntung";
		//}//
//}
?>