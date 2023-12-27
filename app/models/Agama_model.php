<?php 

class Agama_model {
    
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllAgama() {
        $this->db->query("SELECT * FROM agama");
        return $this->db->resultSet();
    }

    public function getAgamaById($id) {
        $this->db->query("SELECT * FROM agama where id_agama = '$id'");
        return $this->db->single();
    }

    public function tambahAgama($data) {
        $nama_agama = htmlspecialchars($data['nama_agama']);

        $sql = "INSERT INTO agama VALUES
        (null, :nama_agama)";
        $this->db->query($sql);
        $this->db->bind('nama_agama', $nama_agama);
        $this->db->execute();
    }

    public function updateAgama($id, $data) {
        $nama_agama = htmlspecialchars($data['nama_agama']);

        $sql = "UPDATE agama SET
                nama_agama = :nama_agama
                WHERE id_agama = :id";
        
        $this->db->query($sql);
        $this->db->bind('nama_agama', $nama_agama);
        $this->db->bind('id', $id);
        $this->db->execute();
    }

    public function hapusAgama($id) {
        //Cek apakah id Agama ada dalam database
        $this->db->query("SELECT id FROM agama WHERE id_agama = '$id'");
        $row = $this->db->numRows();
        //Jika row berisikan nilai 0 maka tidak ada Agama yang ingin dihapus dalam database
        if ($row == 0) {
            return 0;
        }

        $this->db->query("DELETE FROM agama WHERE id_agama = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return 1;
    }
}