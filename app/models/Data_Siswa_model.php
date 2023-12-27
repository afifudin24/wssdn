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

    public function getDataSiswaById($id) {
        $this->db->query("SELECT * FROM data_siswa where id_siswa = '$id'");
        return $this->db->single();
    }

    public function tambahDataSiswa($data) {
        $nama_data_siswa = htmlspecialchars($data['nama_data_siswa']);

        $sql = "INSERT INTO data_siswa VALUES
        (null, :nama_data_siswa)";
        $this->db->query($sql);
        $this->db->bind('nama_data_siswa', $nama_data_siswa);
        $this->db->execute();
    }

    public function updateDataSiswa($id, $data) {
        $nama_data_siswa = htmlspecialchars($data['nama_data_siswa']);

        $sql = "UPDATE data_siswa SET
                nama_data_siswa = :nama_data_siswa
                WHERE id_data_siswa = :id";
        
        $this->db->query($sql);
        $this->db->bind('nama_data_siswa', $nama_data_siswa);
        $this->db->bind('id', $id);
        $this->db->execute();
    }

    public function hapusDataSiswa($id) {
        //Cek apakah id data_siswa ada dalam database
        $this->db->query("SELECT id_siswa FROM data_siswa WHERE id_siswa = '$id'");
        $result = $this->db->single();
    
        // Extract the count value
        $data = isset($result['count']) ? $result['count'] : 0;
        //Jika row berisikan nilai 0 maka tidak ada data_siswa yang ingin dihapus dalam database
        // if ($data == 0) {
        //     return 0;
        // }

        // $this->db->query("DELETE FROM data_siswa WHERE id_agama = :id");
        // $this->db->bind('id', $id);
        // $this->db->execute();
        return $data;
    }
}