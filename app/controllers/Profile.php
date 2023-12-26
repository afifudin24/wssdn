<?php

class Profile extends Controller {

    private function renderProfilePage($viewName, $extraData = [])
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

    public function tentang_sekolah()
    {
        $this->renderProfilePage('profile/tentang_sekolah');
    }

    public function tentang_kepala_sekolah()
    {
        $this->renderProfilePage('profile/tentang_kepala_sekolah');
    }

    public function sejarah_sekolah()
    {
        $this->renderProfilePage('profile/sejarah_sekolah');
    }

    public function prestasi_akademik()
    {
        $this->renderProfilePage('profile/prestasi_akademik');
    }

    public function visi_misi()
    {
        $this->renderProfilePage('profile/visi_misi');
    }
}
?>