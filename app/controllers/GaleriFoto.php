<?php

class GaleriFoto extends Controller {
    private $galeriModel;

    function __construct()
    {
 
        $this->galeriModel = $this->model('Galeri_model');

    }
public  function index(){
    $data['judul'] = 'Galeri Foto';
    $data['galeri'] = $this->galeriModel->getAllDataGaleri();

    
    // $this->view('header', $data);
    ob_start();
    $this->view('components/navbar');
    $data['navbar'] = ob_get_clean();
    $this->view('home/header', $data);
    $this->view('galeri/index', $data);
    $this->view('home/footer');
    // $this->view('galeri/index', $data);
    // $this->view('footer');
}

public function tambah(){
    $this->view('galeri/tambah');
}

public function tambahgaleri(){
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        header('Location: ' . BASEURL . '/galerifoto/');
    }
  
  

   $result = $this->galeriModel->tambahGaleri($_POST);
 
   if($result > 0){
          header('Location: ' . BASEURL . '/galerifoto');

   }

}

public function hapusgaleri($id = 0)
{
    
    if ($id) {
        $hapus = $this->galeriModel->hapusGaleri($id);
        
        if ($hapus == 0) {
            Flasher::setFlash('Gambar tidak ditemukan', 'danger');
            header('Location: ' . BASEURL . '/galerifoto');
        } else {
            Flasher::setFlash('Gambar berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/galerifoto');
        }
    } else {
        header('Location: ' . BASEURL . '/galerifoto');
    }
}


}