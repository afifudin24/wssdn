<?php

class Auth extends Controller {

    private $userModel;

    function __construct()
    {
        if (SessionManager::checkSession()) {
            $payload = SessionManager::getCurrentSession();
            if ($payload->role == 1) {
                header('Location: ' . BASEURL . '/admin');
            } else {
                header('Location: ' . BASEURL . '/operator');
            }
        }

        $this->userModel = $this->model('User_model');
    }

    public function login()
    {
        $this->view('auth/login');
    }

    public function auth()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = isset($_POST['username']) ? $_POST['username'] : '';
            $password = isset($_POST['password']) ? md5($_POST['password']) : '';

            // Jika username atau password tidak diisi, kembalikan ke halaman login
            if (empty($username) || empty($password)) {
                Flasher::setFlash('Username dan password harus diisi.', 'danger');
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            }

            $dbUser = $this->userModel->getUserByUsername($username);

            if (!$dbUser) {
                Flasher::setFlash('Username atau password salah.', 'danger');
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            }

            if ($password === $dbUser['password']) {
                $payload = [
                    'id' => $dbUser['id'],
                    'username' => $username,
                    'nama' => $dbUser['nama'],
                    'role' => $dbUser['role']
                ];

                // Sesuaikan dengan metode pembuatan JWT yang Anda gunakan
                // (di sini diasumsikan menggunakan metode makeJwt yang telah Anda tentukan)
                $jwt = SessionManager::makeJwt($payload);
                setcookie('PPI-Login', $jwt, time() + (60 * 60 * 24 * 30), '/', '', false, true);

                if ($dbUser['role'] == 'admin') {
                    header('Location: ' . BASEURL . '/admin');
                    exit;
                } else {
                    header('Location: ' . BASEURL . '/operator');
                    exit;
                }
            } else {
                Flasher::setFlash('Username atau password salah.', 'danger');
                header('Location: ' . BASEURL . '/auth/login');
                exit;
            }
        } else {
            // Jika bukan metode POST, kembalikan ke halaman login
            header('Location: ' . BASEURL . '/auth/login');
            exit;
        }

    }

}