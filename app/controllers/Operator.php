<?php

class Operator extends Controller
{

    private $userModel;
    private $agamaModel;
    private $dataSiswaModel;
    private $dataGuruModel;

    function __construct()
    {
        if (SessionManager::checkSession()) {
            $this->payload = SessionManager::getCurrentSession();
            if ($this->payload->role != 'operator') {
                header('Location: ' . BASEURL . '/login');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }

        $this->userModel = $this->model('User_model');
        $this->agamaModel = $this->model('Agama_model');
        $this->dataSiswaModel = $this->model('Data_Siswa_model');
        $this->dataGuruModel = $this->model('Data_Guru_model');
    }

    public function index()
    {
        $this->view('operator/index');
    }

    public function new()
    {
        $data['agama'] = $this->agamaModel->getAllAgama();

        $this->view('operator/daftarbaru', $data);
    }

    public function newguru()
    {
        $data['agama'] = $this->agamaModel->getAllAgama();

        $this->view('operator/tambahdataguru', $data);
    }

    public function data_guru()
    {
        $recordsPerPage = 5; // Sesuaikan kebutuhan
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $recordsPerPage;

        if (isset($_POST['delete_selected'])) {
            if (isset($_POST['selected_ids']) && is_array($_POST['selected_ids'])) {
                $selectedIds = implode(",", $_POST['selected_ids']);

                $this->dataGuruModel->deleteMultipleDataGuru($selectedIds);
            }
        }
        $data['title'] = "Data Guru";
        $data['dataGuru'] = $this->dataGuruModel->getAllDataGuru($offset, $recordsPerPage);
        $data['totalDataGuru'] = $this->dataGuruModel->getTotalDataGuru();
        $data['pages'] = ceil($data['totalDataGuru'] / $recordsPerPage);

        $this->view('operator/data-guru', $data);
    }

    public function data_siswa()
    {
        $recordsPerPage = 5; // Sesuaikan kebutuhan
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $offset = ($page - 1) * $recordsPerPage;

        if (isset($_POST['delete_selected'])) {
            if (isset($_POST['selected_ids']) && is_array($_POST['selected_ids'])) {
                $selectedIds = implode(",", $_POST['selected_ids']);

                $this->dataSiswaModel->deleteMultipleDataSiswa($selectedIds);
            }
        }
        $data['title'] = "Data Siswa";
        $data['dataSiswa'] = $this->dataSiswaModel->getAllDataSiswa($offset, $recordsPerPage);
        $data['totalDatasiswa'] = $this->dataSiswaModel->getTotalDataSiswa();
        $data['pages'] = ceil($data['totalDatasiswa'] / $recordsPerPage);

        // var_dump($data['totalDatasiswa']);

        $this->view('operator/data-siswa', $data);
    }

    public function updatesiswa($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->dataSiswaModel->updatesiswa($id, $_POST);
            Flasher::setFlash('Siswa berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/operator/data-siswa');
        }

        if ($id) {
            $data['title'] = 'Data Siswa';
            $data['siswa'] = $this->dataSiswaModel->getDataSiswaById($id);
            $data['agama'] = $this->agamaModel->getAllAgama();

            $this->view('operator/updatesiswa', $data);
        } else {
            header('Location: ' . BASEURL . '/operator/data-siswa');
        }
    }

    public function updateguru($id = 0)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->dataGuruModel->updateguru($id, $_POST);
            Flasher::setFlash('Guru berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/operator/data-guru');
        }

        if ($id) {
            $data['title'] = 'Data guru';
            $data['guru'] = $this->dataGuruModel->getDataGuruById($id);
            $data['agama'] = $this->agamaModel->getAllAgama();

            $this->view('operator/updateguru', $data);
        } else {
            header('Location: ' . BASEURL . '/operator/data-guru');
        }
    }

    public function deletesiswa($id = 0)
    {
        
        if ($id) {
            $hapus = $this->dataSiswaModel->hapusDataSiswa($id);
            var_dump($hapus);
            // if ($hapus == 0) {
            //     Flasher::setFlash('Siswa tidak ditemukan', 'danger');
            //     header('Location: ' . BASEURL . '/operator/data-siswa');
            // } else {
            //     Flasher::setFlash('Buku berhasil dihapus', 'success');
            //     header('Location: ' . BASEURL . '/operator/data-siswa');
            // }
        } else {
            header('Location: ' . BASEURL . '/operator/data-siswa');
        }
    }


}