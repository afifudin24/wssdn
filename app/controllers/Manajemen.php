<?php

class Manajemen extends Controller {

    private function renderManajemenPage($viewName, $extraData = [])
    {
        ob_start();
        $this->view('components/update_terakhir');
        $data['update'] = ob_get_clean();
        
        $this->view('template/header');
        $this->view('components/navlayout');
        $this->view('template/jumbotron');
        $this->view($viewName, $extraData);
        $this->view('template/footer', $data);
    }

    public function kurikulum()
    {
        $this->renderManajemenPage('manajemen/kurikulum');
    }

    public function sarana_prasarana()
    {
        $this->renderManajemenPage('manajemen/sarana_prasarana');
    }
}