<?php

class Info extends Controller {

    private function renderInfoPage($viewName, $extraData = [])
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

    public function agenda()
    {
        $this->renderInfoPage('info/agenda');
    }

    public function berita_acara()
    {
        $this->renderInfoPage('info/berita_acara');
    }

    public function berita_acara_detail()
    {
        $this->renderInfoPage('info/berita_acara_detail');
    }
}