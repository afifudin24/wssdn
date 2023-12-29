<?php 

class Data_Guru_model {
    
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllDataGuru($offset, $recordsPerPage) {
        $this->db->query("SELECT data_guru.*, agama.nama_agama FROM data_guru
        JOIN agama ON data_guru.agama = agama.id_agama LIMIT $offset, $recordsPerPage");
        return $this->db->resultSet();
    }

    public function getTotalDataGuru() {
        $this->db->query("SELECT COUNT(*) as count FROM data_guru");
        $result = $this->db->single();
    
        // Extract the count value
        return isset($result['count']) ? $result['count'] : 0;
    }    


    public function deleteMultipleDataGuru($selectedIds) {
        $deleteQuery = "DELETE FROM data_guru WHERE id_guru IN ($selectedIds)";
        $this->db->query($deleteQuery);
        $this->db->execute();
    }

    public function getDataGuruById($id) {
        $this->db->query("SELECT * FROM data_guru where id_guru = '$id'");
        return $this->db->single();
    }

    public function getDetailGuru($id) {
        $this->db->query("SELECT * FROM data_guru
        WHERE data_guru.id = '$id'");
        return $this->db->single();
    }

    public function tambahGuru($data) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Misalnya, kita cek apakah 'nis' sebagai patokan jumlah data yang dikirimkan
            // $jumlahData = count($data['nama']);
    
            $query = "INSERT INTO data_guru VALUES (null,  :nama, :foto, :alamat, :jenis_kelamin, :agama, :lulusan)";
            $this->db->query($query);
        
            // Prepare statement
            $this->db->prepare($query);
            $rowCount = 0;
    
            // for ($i = 0; $i < $jumlahData; $i++) {
                
            // }
            // Flasher::setFlash('Berhasil menambahkan ' . $jumlahData . ' Guru', 'success');
            $nama_Guru = isset($data['nama']) ? htmlspecialchars($data['nama']) : '';
                $alamat = isset($data['alamat']) ? htmlspecialchars($data['alamat']) : '';
                $jenis_kelamin = isset($data['jenis_kelamin']) ? htmlspecialchars($data['jenis_kelamin']) : '';
                $agama = isset($data['agama']) ? htmlspecialchars($data['agama']) : '';
                $lulusan = isset($data['lulusan']) ? htmlspecialchars($data['lulusan']) : '';
                
                // Proses upload foto jika berkas diunggah
                $foto = 'default.png'; // Atur default jika tidak ada foto yang diunggah
                if (isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                    $foto = $_FILES['foto']['name'];
                    move_uploaded_file($_FILES['foto']['tmp_name'], "img/".$foto);
                }
    
                // Binding parameter pada prepared statement
                $this->db->bind(':nama', $nama_Guru);
                $this->db->bind(':foto', $foto);
                $this->db->bind(':alamat', $alamat);
                $this->db->bind(':jenis_kelamin', $jenis_kelamin);
                $this->db->bind(':agama', $agama);
                $this->db->bind(':lulusan', $lulusan);
    
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

    public function updateGuru($id, $data) {
        $nama = htmlspecialchars($data['nama']);
        $alamat = htmlspecialchars($data['alamat']);
        $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
        $agama = htmlspecialchars($data['agama']);
        $lulusan = htmlspecialchars($data['lulusan']);
    
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
            $foto = $data['guru']['foto'];
        }
    
        // Update data, including the new or existing photo
        $sql = "UPDATE data_guru SET
                nama = :nama,
                alamat = :alamat,
                jenis_kelamin = :jenis_kelamin,
                agama = :agama,
                lulusan = :lulusan,
                foto = :foto
                WHERE id = :id";
    
        $this->db->query($sql);
        $this->db->bind('nama', $nama);
        $this->db->bind('alamat', $alamat);
        $this->db->bind('jenis_kelamin', $jenis_kelamin);
        $this->db->bind('agama', $agama);
        $this->db->bind('lulusan', $lulusan);
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
    
    public function hapusDataGuru($id) {
        $this->db->query("SELECT * FROM data_guru WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();

        // Ambil jumlah baris hasil query
        $row = $this->db->rowCount();

        // Jika tidak ada data dengan ID yang diberikan, kembalikan nilai 0
        if ($row == 0) {
            return 0;
        }

        // Lakukan query DELETE dengan menggunakan parameter
        $this->db->query("DELETE FROM data_guru WHERE id = :id");
        $this->db->bind('id', $id);
        $this->db->execute();

        return 1; // Berhasil menghapus data
    }
}