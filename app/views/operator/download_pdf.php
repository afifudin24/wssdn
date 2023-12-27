<?php
require('koneksi.php');
require('pdf.php'); // Adjust the path based on your project structure

// Constants for pagination
$recordsPerPage = 5; // Adjust as needed
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $recordsPerPage;

// Fetch data for the table
$query = mysqli_query($koneksi, "SELECT * FROM data_siswa, agama WHERE data_siswa.agama = agama.id_agama LIMIT $offset, $recordsPerPage");
$quer = mysqli_num_rows($query);

// Create a PDF document
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Data Siswa');

// Output data to the PDF
$pdf->Ln(10);

while ($data = mysqli_fetch_array($query)) {
    $jenis_kelamin = $data['jenis_kelamin'] == '1' ? 'perempuan' : 'Laki-laki';

    $pdf->Cell(40, 10, 'Nama: ' . $data['nama']);
    $pdf->Cell(40, 10, 'Alamat: ' . $data['alamat']);
    $pdf->Cell(40, 10, 'Jenis Kelamin: ' . $jenis_kelamin);
    $pdf->Cell(40, 10, 'Agama: ' . $data['nama_agama']);
    $pdf->Cell(40, 10, 'Sekolah Asal: ' . $data['sekolah_asal']);
    $pdf->Ln(10);
}

// Set header for PDF download
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename='data_siswa.pdf'");
$pdf->Output();
?>
