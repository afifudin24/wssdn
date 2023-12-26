<?php

class DataSiswa extends Controller {

    private $siswaModel;

    function __construct()
    {
        // if (SessionManager::checkSession()) {
        //     $this->payload = SessionManager::getCurrentSession();
        //     if ($this->payload->role != 1) {
        //         header('Location: ' . BASEURL . '/login');
        //     }
        // } else {
        //     header('Location: ' . BASEURL . '/login');
        // }

        $this->siswaModel = $this->model('Siswa_model');

    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['siswa'] = $this->siswaModel->getAllSiswa(isset($keyword) ? $keyword : null);
        // $this->view('header', $data);
        $this->view('dataSiswa/index', $data);
        // $this->view('footer');
    }
}