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

    public function cariSiswa()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : null;
        var_dump($keyword);
        

        // Lakukan pencarian siswa berdasarkan keyword
        $results = $this->siswaModel->cariSiswaByKeyword($keyword);

        // Set header untuk menandakan bahwa respons adalah JSON
        header('Content-Type: application/json');

        // Kirim hasil pencarian sebagai respons JSON
        echo json_encode($results);
        exit; // Pastikan untuk menghentikan eksekusi setelah mengirim respons
    }
}


    public function form_simpan()
    {
      

        $this->siswaModel->tambahSiswa($_POST);
        Flasher::setFlash('Buku berhasil ditambahkan', 'success');
        // header('Location: ' . BASEURL . '/dataSiswa/index');
        $this->view('dataSiswa/form-simpan');
    }

    public function tambahSiswa(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/datasiswa/');
        }

        $this->siswaModel->tambahSiswa($_POST);
        Flasher::setFlash('Berhasil menambahkan siswa', 'success');
        header('Location: ' . BASEURL . '/datasiswa');
    }
    public function updatesiswa($id = 0){
       
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASEURL . '/datasiswa/');
        } else if
        ($_SERVER['REQUEST_METHOD'] == 'POST') {
          var_dump($id);
          var_dump($_POST);
         
            $this->siswaModel->updateSiswa($id, $_POST);
            Flasher::setFlash('Siswa berhasil diubah', 'success');
            header('Location: ' . BASEURL . '/dataSiswa/index');
        }
        // $this->siswaModel->tambahSiswa($_POST);
        // Flasher::setFlash('Berhasil menambahkan siswa', 'success');
        // header('Location: ' . BASEURL . '/datasiswa');
    }


    public function form_ubah($id = 0)
    {
       

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