<?php

class Galeri extends Controller {

    public function index()
    {
        $data['judul'] = 'Web Sekolah';
        ob_start();
        $this->view('components/navbar');
        $data['navbar'] = ob_get_clean();
        
        // $this->view('home/header', $data);
        // $this->view('home/index', $data);
        $this->view('galeri/galeri');
    }

    private function renderGaleriPage($viewName, $extraData = [])
    {
        ob_start();
        $this->view('components/update_terakhir');
        $data['update'] = ob_get_clean();
        
        // $this->view('template/header');
        // $this->view('components/navlayout');
        // $this->view('template/jumbotron');
        $this->view($viewName, $extraData);
        // $this->view('template/footer', $data);
    }

    public function kurikulum()
    {
        $this->renderGaleriPage('galeri/galeri');
    }

}