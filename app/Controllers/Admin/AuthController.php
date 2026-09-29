<?php

class AuthController extends Controller
{
    public function login()
    {
        // Jika sudah login
        if (isset($_SESSION['user'])) {
            $this->redirect('/admin/dashboard');
        }

        $this->view('admin/login');
    }

    public function authenticate()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {

            $_SESSION['error'] = 'Username dan password wajib diisi';

            $this->redirect('/admin/login');
        }

        $userModel = new User();

        $user = $userModel->findByUsername($username);

        if ($user && password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user'] = [
                'id'       => $user['id'],
                'nama'     => $user['nama'],
                'username' => $user['username'],
                'role'     => $user['role']
            ];

            $this->redirect('/admin/dashboard');
        }

        $_SESSION['error'] = 'Username atau password salah';

        $this->redirect('/admin/login');
    }

    public function logout()
    {
        /*
        |----------------------------------------------------------------------
        | Hapus seluruh session
        |----------------------------------------------------------------------
        */

        $_SESSION = [];


        /*
        |----------------------------------------------------------------------
        | Hapus cookie session jika digunakan
        |----------------------------------------------------------------------
        */

        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }


        /*
        |----------------------------------------------------------------------
        | Hancurkan session
        |----------------------------------------------------------------------
        */

        session_destroy();


        /*
        |----------------------------------------------------------------------
        | Mulai session baru untuk flash message
        |----------------------------------------------------------------------
        */

        session_start();

        $_SESSION['success'] =
            'Anda berhasil logout.';


        /*
        |----------------------------------------------------------------------
        | Kembali ke halaman login
        |----------------------------------------------------------------------
        */

        $this->redirect('/admin/login');
    }
}