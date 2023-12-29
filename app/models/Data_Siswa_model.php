<?php 

class Data_Siswa_model {
    
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllDataSiswa($offset, $recordsPerPage) {
        $this->db->query("SELECT data_siswa.*, agama.nama_agama FROM data_siswa
        JOIN agama ON data_siswa.agama = agama.id_agama LIMIT $offset, $recordsPerPage");
        return $this->db->resultSet();
    }

    public function getTotalDataSiswa() {
        $this->db->query("SELECT COUNT(*) as count FROM data_siswa");
        $result = $this->db->single();
    
        // Extract the count value
        return isset($result['count']) ? $result['count'] : 0;
    }    


    public function deleteMultipleDataSiswa($selectedIds) {
        $deleteQuery = "DELETE FROM data_siswa WHERE id_siswa IN ($selectedIds)";
        $this->db->query($deleteQuery);
        $this->db->execute();
    }

    public function getDetailSiswa($id) {
        $this->db->query("SELECT * FROM data_siswa
        WHERE data_siswa.id = '$id'");
        return $this->db->single();
    }

    public function tambahSiswa($data) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Misalnya, kita cek apakah 'nis' sebagai patokan jumlah data yang dikirimkan
            // $jumlahData = count($data['nama']);
    
            $query = "INSERT INTO data_siswa VALUES (null,  :nama, :alamat, :jenis_kelamin, :agama, :sekolah_asal, :foto)";
            $this->db->query($query);
        
            // Prepare statement
            $this->db->prepare($query);
            $rowCount = 0;
    
            // for ($i = 0; $i < $jumlahData; $i++) {
                
            // }
            // Flasher::setFlash('Berhasil menambahkan ' . $jumlahData . ' siswa', 'success');
            $nama_siswa = isset($data['nama']) ? htmlspecialchars($data['nama']) : '';
                $alamat = isset($data['alamat']) ? htmlspecialchars($data['alamat']) : '';
                $jenis_kelamin = isset($data['jenis_kelamin']) ? htmlspecialchars($data['jenis_kelamin']) : '';
                $agama = isset($data['agama']) ? htmlspecialchars($data['agama']) : '';
                $sekolah_asal = isset($data['sekolah_asal']) ? htmlspecialchars($data['sekolah_asal']) : '';
                
                // Proses upload foto jika berkas diunggah
                $foto = 'default.png'; // Atur default jika tidak ada foto yang diunggah
                if (isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                    $foto = $_FILES['foto']['name'];
                    move_uploaded_file($_FILES['foto']['tmp_name'], "img/".$foto);
                }
    
                // Binding parameter pada prepared statement
                $this->db->bind(':nama', $nama_siswa);
                $this->db->bind(':alamat', $alamat);
                $this->db->bind(':jenis_kelamin', $jenis_kelamin);
                $this->db->bind(':agama', $agama);
                $this->db->bind(':sekolah_asal', $sekolah_asal);
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
            return $rowCount;
            
        }
    }

    public function updateSiswa($id, $data) {
        $nama_siswa = htmlspecialchars($data['nama']);
        $alamat = htmlspecialchars($data['alamat']);
        $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
        $agama = htmlspecialchars($data['agama']);
        $sekolah_asal = htmlspecialchars($data['sekolah_asal']);
    
        // Check if a new photo is uploaded
        if (!empty($_FILES['foto']['name'])) {
            // Process and upload the new photo
            $foto = $_FILES['foto']['name'];
            $ukuranFile = $_FILES['foto']['size'];
            $error = $_FILES['foto']['error'];
            $tmp_name = $_FILES['foto']['tmp_name'];
            move_uploaded_file($tmp_name, "img/".$foto);
        } else {
            // No new photo uploaded, retain the existing photo
            $foto = $data['siswa']['foto'];
        }
    
        // Update data, including the new or existing photo
        $sql = "UPDATE data_siswa SET
                nama = :nama_siswa,
                alamat = :alamat,
                jenis_kelamin = :jenis_kelamin,
                agama = :agama,
                sekolah_asal = :sekolah_asal,
                foto = :foto
                WHERE id = :id";
    
        $this->db->query($sql);
        $this->db->bind('nama_siswa', $nama_siswa);
        $this->db->bind('alamat', $alamat);
        $this->db->bind('jenis_kelamin', $jenis_kelamin);
        $this->db->bind('agama', $agama);
        $this->db->bind('sekolah_asal', $sekolah_asal);
        $this->db->bind('foto', $foto);
        $this->db->bind('id', $id);
    
        try {
            $this->db->execute();
            // If executed successfully without error, respond with 'OK'
            echo "OK";
        } catch (\PDOException $e) {
            // Handle possible errors
            if ($e->errorInfo[1] == 1062) {
                // Duplicate key error (if any)
                echo "Duplikat kunci";
                die;
            } else {
                // Other errors
                echo "Terjadi kesalahan: " . $e->getMessage();
                die;
            }
        }
    }
    
    public function hapusDataSiswa($id) {
        $this->db->query("SELECT * FROM data_siswa WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();

        // Ambil jumlah baris hasil query
        $row = $this->db->rowCount();

        // Jika tidak ada data dengan ID yang diberikan, kembalikan nilai 0
        if ($row == 0) {
            return 0;
        }

        // Lakukan query DELETE dengan menggunakan parameter
        $this->db->query("DELETE FROM data_siswa WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();

        return 1; // Berhasil menghapus data
    }

}