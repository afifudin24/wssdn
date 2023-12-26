<?php

class Siswa_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllSiswa($keyword = null) {
        if(isset($keyword)) {
            $param = '%' . $keyword . '%';
            $sql = "SELECT * FROM ilkomfina WHERE nis LIKE :ni OR nama LIKE :na OR jenis_kelamin LIKE :jk OR telp LIKE :t OR alamat LIKE :a";
            $this->db->query($sql);
            $this->db->bind(':ni', $param);
            $this->db->bind(':na', $param);
            $this->db->bind(':jk', $param);
            $this->db->bind(':t', $param);
            $this->db->bind(':a', $param);
        } else {
            $sql = "SELECT * FROM ilkomfina";
            $this->db->query($sql);
        }

        return $this->db->resultSet();
    }
}