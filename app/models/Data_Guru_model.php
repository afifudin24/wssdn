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

    public function tambahDataGuru($data) {
        $nama_data_guru = htmlspecialchars($data['nama_data_guru']);

        $sql = "INSERT INTO data_guru VALUES
        (null, :nama_data_guru)";
        $this->db->query($sql);
        $this->db->bind('nama_data_guru', $nama_data_guru);
        $this->db->execute();
    }

    public function updateDataGuru($id, $data) {
        $nama_data_guru = htmlspecialchars($data['nama_data_guru']);

        $sql = "UPDATE data_guru SET
                nama_data_guru = :nama_data_guru
                WHERE id_data_guru = :id";
        
        $this->db->query($sql);
        $this->db->bind('nama_data_guru', $nama_data_guru);
        $this->db->bind('id', $id);
        $this->db->execute();
    }

    public function hapusDataGuru($id) {
        //Cek apakah id data_guru ada dalam database
        $this->db->query("SELECT id FROM data_guru WHERE id_data_guru = '$id'");
        $row = $this->db->numRows();
        //Jika row berisikan nilai 0 maka tidak ada data_Guru yang ingin dihapus dalam database
        if ($row == 0) {
            return 0;
        }

        $this->db->query("DELETE FROM data_Guru WHERE id_agama = :id");
        $this->db->bind('id', $id);
        $this->db->execute();
        return 1;
    }
}