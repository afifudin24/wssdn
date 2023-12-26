<?php

class Kontak extends Controller {

    public function index()
    {
        $data['judul'] = 'Web Sekolah';
 
        
        $this->view('template/header');
        $this->view('components/navlayout');
        $this->view('kontak/kontak');
        // $this->view('kontak/footer');
    }
}