<?php

class Home extends Controller {

    public function index()
    {
        $data['judul'] = 'Web Sekolah';
        ob_start();
        $this->view('components/navbar');
        $data['navbar'] = ob_get_clean();
        
        $this->view('home/header', $data);
        $this->view('home/index', $data);
        $this->view('home/footer');
    }
}