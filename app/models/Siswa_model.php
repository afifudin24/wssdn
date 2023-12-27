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
    $query = "SELECT * FROM data_siswa 
              WHERE nama LIKE :keyword 
              OR telp LIKE :keyword 
              OR nis LIKE :keyword 
              OR alamat LIKE :keyword";

    $keyword = "%$keyword%"; // Tambahkan wildcard '%' agar pencarian lebih fleksibel

    $this->db->query($query);
    $this->db->bind(':keyword', $keyword);

    return $this->db->resultSet();
}


    public function tambahSiswa($data) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nis = isset($data['nis']) ? htmlspecialchars($data['nis']) : '';
            $nama_siswa = isset($data['nama']) ? htmlspecialchars($data['nama']) : '';
            $alamat = isset($data['alamat']) ? htmlspecialchars($data['alamat']) : '';
            $jenis_kelamin = isset($data['jenis_kelamin']) ? htmlspecialchars($data['jenis_kelamin']) : '';
            $telp = isset($data['telp']) ? htmlspecialchars($data['telp']) : '';
            
            if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                $foto = $_FILES['foto']['name'];
                $ukuranFile = $_FILES['foto']['size'];
                $error = $_FILES['foto']['error'];
                $tmp_name = $_FILES['foto']['tmp_name'];
                move_uploaded_file($tmp_name, "img/".$foto);
            }

            $query = "INSERT INTO ilkomfina VALUES
            (null, :nis, :nama_siswa, :jenis_kelamin, :telp, :alamat, :foto)";

            $this->db->query($query);
            $this->db->bind('nis', $nis);
            $this->db->bind('nama_siswa', $nama_siswa);
            $this->db->bind('alamat', $alamat);
            $this->db->bind('jenis_kelamin', $jenis_kelamin);
            $this->db->bind('telp', $telp);
            $this->db->bind('foto', $foto);

            try {
                $this->db->execute();
            } catch (\PDOException $e) {
                if ($e->errorInfo[1] == 1062) {
                    return 0;
                    die;
                }
            }

            return $this->db->rowCount();
        }
    }

    public function updateSiswa($id, $data) {
        $nis = htmlspecialchars($data['nis']);
        $nama_siswa = htmlspecialchars($data['nama']);
        $alamat = htmlspecialchars($data['alamat']);
        $jenis_kelamin = htmlspecialchars($data['jenis_kelamin']);
        $telp = htmlspecialchars($data['telp']);
        
        // upload gambar
        $foto = $_FILES['foto']['name'];
        $ukuranFile = $_FILES['foto']['size'];
        $error = $_FILES['foto']['error'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp_name, "img/".$foto);
        $sql = "UPDATE ilkomfina SET
        nis = :nis,
        nama = :nama_siswa,
        alamat = :alamat,
        jenis_kelamin = :jenis_kelamin,
        telp = :telp,
        foto = :foto
        WHERE id = :id";

$this->db->query($sql);
$this->db->bind('nis', $nis);
$this->db->bind('nama_siswa', $nama_siswa);
$this->db->bind('alamat', $alamat);
$this->db->bind('jenis_kelamin', $jenis_kelamin);
$this->db->bind('telp', $telp);
$this->db->bind('foto', $foto);
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
}