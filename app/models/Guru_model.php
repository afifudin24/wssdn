<?php

class Guru_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllGuru($keyword = null) {
        $this->db->query("SELECT * FROM ilkomfina_guru");

        return $this->db->resultSet();
    }

    public function getDetailGuru($id) {
        $this->db->query("SELECT * FROM ilkomfina_guru
        WHERE ilkomfina_guru.id = '$id'");
        return $this->db->single();
    }
    public function cariGuruByKeyword($keyword)
{
    $query = "SELECT * FROM ilkomfina_guru 
              WHERE nama LIKE :keyword 
              OR telp LIKE :keyword 
              OR nis LIKE :keyword 
              OR alamat LIKE :keyword";

    $keyword = "%$keyword%"; // Tambahkan wildcard '%' agar pencarian lebih fleksibel

    $this->db->query($query);
    $this->db->bind(':keyword', $keyword);

    return $this->db->resultSet();
}



    public function tambahGuru($data) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Misalnya, kita cek apakah 'nis' sebagai patokan jumlah data yang dikirimkan
            $jumlahData = count($data['nis']);
    
            $query = "INSERT INTO ilkomfina_guru VALUES (null, :nis, :nama, :jenis_kelamin, :telp, :alamat, :foto)";
            $this->db->query($query);
        
            // Prepare statement
            $this->db->prepare($query);
            $rowCount = 0;
    
            for ($i = 0; $i < $jumlahData; $i++) {
                $nis = isset($data['nis'][$i]) ? htmlspecialchars($data['nis'][$i]) : '';
                $nama_Guru = isset($data['nama'][$i]) ? htmlspecialchars($data['nama'][$i]) : '';
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
            $this->db->bind(':nama', $nama_Guru);
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
            Flasher::setFlash('Berhasil menambahkan ' . $jumlahData . ' Guru', 'success');
            return $rowCount;
            
        }
    }

    public function updateGuru($id, $data) {
        $nis = htmlspecialchars($data['nis']);
        $nama_Guru = htmlspecialchars($data['nama']);
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
        $sql = "UPDATE ilkomfina_guru SET
                nis = :nis,
                nama = :nama_Guru,
                alamat = :alamat,
                jenis_kelamin = :jenis_kelamin,
                telp = :telp,
                foto = :foto
                WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind('foto', $foto);
    } else {
        // Jika tidak ada file yang diunggah, gunakan foto yang sudah ada
        $sql = "UPDATE ilkomfina_guru SET
                nis = :nis,
                nama = :nama_Guru,
                alamat = :alamat,
                jenis_kelamin = :jenis_kelamin,
                telp = :telp
                WHERE id = :id";
        $this->db->query($sql);
    }

$this->db->bind('nis', $nis);
$this->db->bind('nama_Guru', $nama_Guru);
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


    public function hapusGuru($id) {
        $this->db->query("SELECT * FROM ilkomfina_guru WHERE id = :id");
    $this->db->bind('id', $id);
    $this->db->execute();

    // Ambil jumlah baris hasil query
    $row = $this->db->rowCount();

    // Jika tidak ada data dengan ID yang diberikan, kembalikan nilai 0
    if ($row == 0) {
        return 0;
    }

    // Lakukan query DELETE dengan menggunakan parameter
    $this->db->query("DELETE FROM ilkomfina_guru WHERE id = :id");
    $this->db->bind('id', $id);
    $this->db->execute();

    return 1; // Berhasil menghapus data
    }

    public function importDataFromExcel($data)
    {
       
        $successCount = 0;
        $errorCount = 0;
        foreach ($data as $Guru) {
            $nis = $Guru['nis'];
            $nama = $Guru['nama'];
            $jenis_kelamin = $Guru['jenis_kelamin'];
            $telp = $Guru['telp'];
            $alamat = $Guru['alamat'];
            $foto = $Guru['foto'];
          $result =   $query = "INSERT INTO ilkomfina_guru VALUES (null, :nis, :nama_Guru, :jenis_kelamin, :telp, :alamat, :foto)";

            $this->db->query($query);
            $this->db->bind('nis', $nis);
            $this->db->bind('nama_Guru', $nama);
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