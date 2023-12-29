<?php 

class Galeri_model {
    
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllDataGaleri() {
        $this->db->query("SELECT * from galeri");
        return $this->db->resultSet();
    }

    public function tambahGaleri($data) {
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Misalnya, kita cek apakah 'nis' sebagai patokan jumlah data yang dikirimkan
            $jumlahData = count($data['title']);
    
            $query = "INSERT INTO galeri VALUES (null, :title, :link)";
            $this->db->query($query);
        
            // Prepare statement
            $this->db->prepare($query);
            $rowCount = 0;
    
            for ($i = 0; $i < $jumlahData; $i++) {
                $title = isset($data['title'][$i]) ? htmlspecialchars($data['title'][$i]) : '';
              
                
                // Proses upload foto jika berkas diunggah
                $link = 'default.png'; // Atur default jika tidak ada foto yang diunggah
                if (isset($_FILES['path']['name'][$i]) && $_FILES['path']['error'][$i] == UPLOAD_ERR_OK) {
                    $link = $_FILES['path']['name'][$i];
                    move_uploaded_file($_FILES['path']['tmp_name'][$i], "imggaleri/".$link);
                 
                }
    
                // Binding parameter pada prepared statement
                $this->db->bind(':title', $title);
    $this->db->bind(':link', $link);
    
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
            Flasher::setFlash('Berhasil menambahkan ' . $jumlahData . 'gambar', 'success');
            return $rowCount;
            
        }
    }


    
    public function hapusGaleri($id) {
        $this->db->query("SELECT * FROM galeri WHERE id = :id");
    $this->db->bind('id', $id);
    $this->db->execute();

    // Ambil jumlah baris hasil query
    $row = $this->db->rowCount();

    // Jika tidak ada data dengan ID yang diberikan, kembalikan nilai 0
    if ($row == 0) {
        return 0;
    }

    // Lakukan query DELETE dengan menggunakan parameter
    $this->db->query("DELETE FROM galeri WHERE id = :id");
    $this->db->bind('id', $id);
    $this->db->execute();

    return 1; // Berhasil menghapus data
    }

}