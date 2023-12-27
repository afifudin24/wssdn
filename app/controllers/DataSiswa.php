<?php

class DataSiswa extends Controller {

    private $siswaModel;
    private $agamaModel;

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
        $this->agamaModel = $this->model('Agama_model');

    }

    public function index()
    {
        $data['title'] = 'Data Siswa';
        $data['siswa'] = $this->siswaModel->getAllSiswa(isset($keyword) ? $keyword : null);
        // $this->view('header', $data);
        $this->view('dataSiswa/index', $data);
        // $this->view('footer');
    }

    public function form_simpan()
    {
        // if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        //     header('Location: ' . BASEURL . '/dataSiswa/index');
        // }

        $this->siswaModel->tambahSiswa($_POST);
        Flasher::setFlash('Buku berhasil ditambahkan', 'success');
        // header('Location: ' . BASEURL . '/dataSiswa/index');
        $this->view('dataSiswa/form-simpan');
    }

    public function form_ubah($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->siswaModel->formUbah($id, $_POST);
            Flasher::setFlash('Siswa berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/dataSiswa/index');
        }

        if ($id) {
            $data['siswa'] = $this->siswaModel->getDetailSiswa($id);
            $data['agama'] = $this->agamaModel->getAllAgama();

            $this->view('dataSiswa/form-ubah', $data);
        } else {
            header('Location: ' . BASEURL . '/dataSiswa/index');
        }
    }

    public function hapus_data($id = 0)
    {
        if ($id) {
            $hapus = $this->siswaModel->hapusSiswa($id);
            if ($hapus == 0) {
                Flasher::setFlash('Buku tidak ditemukan', 'danger');
                header('Location: ' . BASEURL . '/dataSiswa/index');
            } else {
                Flasher::setFlash('Buku berhasil dihapus', 'success');
                header('Location: ' . BASEURL . '/dataSiswa/index');
            }
        } else {
            header('Location: ' . BASEURL . '/dataSiswa/index');
        }
    }
}