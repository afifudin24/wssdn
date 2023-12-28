<?php

class Siswa_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllSiswa($keyword = null) {
        $this->db->query("SELECT * FROM ilkomfina");

        return $this->db->resultSet();
    }

    public function getDetailSiswa($id) {
        $this->db->query("SELECT * FROM ilkomfina
        WHERE ilkomfina.id = '$id'");
        return $this->db->single();
    }
    public function cariSiswaByKeyword($keyword)
{
    $query = "SELECT * FROM ilkomfina 
              WHERE nama LIKE :keyword 
              OR telp LIKE :keyword 
              OR nis LIKE :keyword 
              OR alamat LIKE :keyword";

    $keyword = "%$keyword%"; // Tambahkan wildcard '%' agar pencarian lebih fleksibel

    $this->db->query($query);
    $this->db->bind(':keyword', $keyword);

    return $this->db->resultSet();
}


    // public function tambahSiswa($data) {
    //     if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //                     header('Location: ' . BASEURL . '/datasiswa/');
    //                     exit;
    //                 }
                
    //                 $data = $_POST;
            
    //                 // Prepared statement untuk query INSERT
    //                 $query = "INSERT INTO ilkomfina VALUES (null, :nis, :nama, :jenis_kelamin, :telp, :alamat, :foto)";
    //                 $stmt = $this->db->prepare($query);
                    
    //                 // Loop untuk setiap data siswa
    //                 foreach ($data['nis'] as $key => $nis) {
    //                     // Lakukan binding parameter pada prepared statement
    //                     $stmt->bindParam(':nis', $nis);
    //                     $stmt->bindParam(':nama_siswa', $data['nama'][$key]);
    //                     $stmt->bindParam(':alamat', $data['alamat'][$key]);
    //                     $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin'][$key]);
    //                     $stmt->bindParam(':telp', $data['telp'][$key]);
                    
    //                     // Proses upload foto jika dibutuhkan
    //                     $foto = 'default.png'; // Atur default jika tidak ada foto yang diupload
    //                     if (!empty($_FILES['foto']['name'][$key])) {
    //                         $foto = $_FILES['foto']['name'][$key];
    //                         move_uploaded_file($_FILES['foto']['tmp_name'][$key], "img/".$foto);
    //                     }
    //                     $stmt->bindParam(':foto', $foto);
                    
    //                     try {
    //                         // Eksekusi query
    //                         $stmt->execute();
    //                     } catch (\PDOException $e) {
    //                         if ($e->errorInfo[1] == 1062) {
    //                             return 0; // Tangani jika ada kunci duplikat (1062 adalah kode MySQL untuk kunci duplikat)
    //                             die;
    //                         }
    //                         // Tangani pesan kesalahan lain jika diperlukan
    //                         echo "Error: " . $e->getMessage();
    //                     }
                
    //                 return true; // Atau nilai lain yang sesuai dengan kebutuhan Anda
    //             }
    // }

    public function tambahSiswa($data) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Misalnya, kita cek apakah 'nis' sebagai patokan jumlah data yang dikirimkan
            $jumlahData = count($data['nis']);
    
            $query = "INSERT INTO ilkomfina VALUES (null, :nis, :nama, :jenis_kelamin, :telp, :alamat, :foto)";
            $this->db->query($query);
        
            // Prepare statement
            $this->db->prepare($query);
            $rowCount = 0;
    
            for ($i = 0; $i < $jumlahData; $i++) {
                $nis = isset($data['nis'][$i]) ? htmlspecialchars($data['nis'][$i]) : '';
                $nama_siswa = isset($data['nama'][$i]) ? htmlspecialchars($data['nama'][$i]) : '';
                $alamat = isset($data['alamat'][$i]) ? htmlspecialchars($data['alamat'][$i]) : '';
                $jenis_kelamin = isset($data['jenis_kelamin'][$i]) ? htmlspecialchars($data['jenis_kelamin'][$i]) : '';
                $telp = isset($data['telp'][$i]) ? htmlspecialchars($data['telp'][$i]) : '';
                
                // Proses upload foto jika berkas diunggah
                $foto = 'default.png'; // Atur default jika tidak ada foto yang diunggah
                if (isset($_FILES['foto']['name'][$i]) && $_FILES['foto']['error'][$i] == UPLOAD_ERR_OK) {
                    $foto = $_FILES['foto']['name'][$i];
                    move_uploaded_file($_FILES['foto']['tmp_name'][$i], "img/".$foto);
                }
    
                // Binding parameter pada prepared statement
                $this->db->bind(':nis', $nis);
    $this->db->bind(':nama', $nama_siswa);
    $this->db->bind(':jenis_kelamin', $jenis_kelamin);
    $this->db->bind(':telp', $telp);
    $this->db->bind(':alamat', $alamat);
    $this->db->bind(':foto', $foto);
    
                try {
                    // Eksekusi query
                    $this->db->execute();
                        $rowCount ++; // Tambahkan jumlah baris yang berhasil di-insert
                    
                } catch (\PDOException $e) {
                    if ($e->errorInfo[1] == 1062) {
                        return 0;
                        die;
                    }
                    // Tangani pesan kesalahan lain jika diperlukan
                    echo "Error: " . $e->getMessage();
                }
            }
            Flasher::setFlash('Berhasil menambahkan ' . $jumlahData . ' siswa', 'success');
            return $rowCount;
            
        }
    }

    public function updateSiswa($id, $data) {
        $nis = htmlspecialchars($data['nis']);
        $nama_siswa = htmlspecialchars($data['nama']);
        $alamat = htmlspecialchars($data['alamat']);
        $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
        $telp = htmlspecialchars($data['telp']);
        // Periksa apakah ada file foto yang diunggah
    if (!empty($_FILES['foto']['name'])) {
        // Proses upload gambar baru
        $foto = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp_name, "img/".$foto);

        // Update data, termasuk foto baru
        $sql = "UPDATE ilkomfina SET
                nis = :nis,
                nama = :nama_siswa,
                alamat = :alamat,
                jenis_kelamin = :jenis_kelamin,
                telp = :telp,
                foto = :foto
                WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind('foto', $foto);
    } else {
        // Jika tidak ada file yang diunggah, gunakan foto yang sudah ada
        $sql = "UPDATE ilkomfina SET
                nis = :nis,
                nama = :nama_siswa,
                alamat = :alamat,
                jenis_kelamin = :jenis_kelamin,
                telp = :telp
                WHERE id = :id";
        $this->db->query($sql);
    }

$this->db->bind('nis', $nis);
$this->db->bind('nama_siswa', $nama_siswa);
$this->db->bind('alamat', $alamat);
$this->db->bind('jenis_kelamin', $jenis_kelamin);
$this->db->bind('telp', $telp);

$this->db->bind('id', $id);

try {
    $this->db->execute();
    // Jika berhasil dieksekusi tanpa error, berikan respons 'OK'
    echo "OK";
   
} catch (\PDOException $e) {
    // Tangani kesalahan yang mungkin terjadi
    if ($e->errorInfo[1] == 1062) {
        // Kesalahan kunci duplikat (jika ada)
        echo "Duplikat kunci";
        die;
    } else {
        // Kesalahan lainnya
        echo "Terjadi kesalahan: " . $e->getMessage();
        die;
    }
}
        // return $this->db->rowCount();
    }


    public function hapusSiswa($id) {
        $this->db->query("SELECT * FROM ilkomfina WHERE id = :id");
    $this->db->bind('id', $id);
    $this->db->execute();

    // Ambil jumlah baris hasil query
    $row = $this->db->rowCount();

    // Jika tidak ada data dengan ID yang diberikan, kembalikan nilai 0
    if ($row == 0) {
        return 0;
    }

    // Lakukan query DELETE dengan menggunakan parameter
    $this->db->query("DELETE FROM ilkomfina WHERE id = :id");
    $this->db->bind('id', $id);
    $this->db->execute();

    return 1; // Berhasil menghapus data
    }

    public function importDataFromExcel($data)
    {
       
        $successCount = 0;
        $errorCount = 0;
        foreach ($data as $siswa) {
            $nis = $siswa['nis'];
            $nama = $siswa['nama'];
            $jenis_kelamin = $siswa['jenis_kelamin'];
            $telp = $siswa['telp'];
            $alamat = $siswa['alamat'];
            $foto = $siswa['foto'];
          $result =   $query = "INSERT INTO ilkomfina VALUES (null, :nis, :nama_siswa, :jenis_kelamin, :telp, :alamat, :foto)";

            $this->db->query($query);
            $this->db->bind('nis', $nis);
            $this->db->bind('nama_siswa', $nama);
            $this->db->bind('alamat', $alamat);
            $this->db->bind('jenis_kelamin', $jenis_kelamin);
            $this->db->bind('telp', $telp);
            $this->db->bind('foto', $foto);
            if ($result) {
                $successCount++;
            } else {
                $errorCount++;
            }

            try {
                $this->db->execute();
                 if ($result) {
                $successCount++;
            } else {
                $errorCount++;
            }
            } catch (\PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    return 0;
                    die;
                }
            }

           
        }
     

        if ($successCount > 0) {
            
            Flasher::setFlash("$successCount data berhasil diimport.", 'success');
            return true;
            
        }

        if ($errorCount > 0) {
          
            Flasher::setFlash("$errorCount data gagal diimport.", 'danger');
            return false;
        }
    }
}