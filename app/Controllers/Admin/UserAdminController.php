<?php

class UsersAdminController extends Controller
{
    private $userModel;


    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        $this->userModel = new User();
    }


    /*
    |--------------------------------------------------------------------------
    | Cek Login
    |--------------------------------------------------------------------------
    */

    private function checkAuth()
    {
        if (!isset($_SESSION['user'])) {

            $this->redirect(
                '/admin/login'
            );

            exit;
        }
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $this->checkAuth();


        $search = trim(
            $_GET['search'] ?? ''
        );


        $users =
            $this->userModel
                ->getAll($search);


        $total =
            $this->userModel
                ->count();


        $aktif =
            $this->userModel
                ->countByStatus('aktif');


        $nonaktif =
            $this->userModel
                ->countByStatus('nonaktif');


        $this->view(
            'admin/users/index',
            [
                'users'     => $users,
                'search'    => $search,
                'total'     => $total,
                'aktif'     => $aktif,
                'nonaktif'  => $nonaktif
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $this->checkAuth();

        $this->view(
            'admin/users/create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        $this->checkAuth();


        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            $this->redirect(
                '/admin/users'
            );

            exit;
        }


        $nama =
            trim($_POST['nama'] ?? '');


        $username =
            trim($_POST['username'] ?? '');


        $password =
            $_POST['password'] ?? '';


        $role =
            trim($_POST['role'] ?? 'admin');


        $status =
            trim($_POST['status'] ?? 'aktif');


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        if (
            $nama === '' ||
            $username === '' ||
            $password === ''
        ) {

            $_SESSION['error'] =
                'Nama, username, dan password wajib diisi.';

            $this->redirect(
                '/admin/users/create'
            );

            exit;
        }


        if (strlen($username) < 3) {

            $_SESSION['error'] =
                'Username minimal 3 karakter.';

            $this->redirect(
                '/admin/users/create'
            );

            exit;
        }


        if (strlen($password) < 6) {

            $_SESSION['error'] =
                'Password minimal 6 karakter.';

            $this->redirect(
                '/admin/users/create'
            );

            exit;
        }


        if (
            !in_array(
                $role,
                ['admin']
            )
        ) {

            $role = 'admin';
        }


        if (
            !in_array(
                $status,
                ['aktif', 'nonaktif']
            )
        ) {

            $status = 'aktif';
        }


        /*
        |--------------------------------------------------------------------------
        | Cek Username
        |--------------------------------------------------------------------------
        */

        if (
            $this->userModel
                ->usernameExists($username)
        ) {

            $_SESSION['error'] =
                'Username tersebut sudah digunakan.';

            $this->redirect(
                '/admin/users/create'
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Hash Password
        |--------------------------------------------------------------------------
        */

        $hashedPassword =
            password_hash(
                $password,
                PASSWORD_DEFAULT
            );


        /*
        |--------------------------------------------------------------------------
        | Simpan
        |--------------------------------------------------------------------------
        */

        try {

            $this->userModel->create([
                'nama'     => $nama,
                'username' => $username,
                'password' => $hashedPassword,
                'role'     => $role,
                'status'   => $status
            ]);


            $_SESSION['success'] =
                'User admin berhasil ditambahkan.';

        } catch (PDOException $e) {

            $_SESSION['error'] =
                'Gagal menambahkan user admin.';
        }


        $this->redirect(
            '/admin/users'
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $this->checkAuth();


        $user =
            $this->userModel
                ->find($id);


        if (!$user) {

            $_SESSION['error'] =
                'User admin tidak ditemukan.';

            $this->redirect(
                '/admin/users'
            );

            exit;
        }


        $this->view(
            'admin/users/edit',
            [
                'user' => $user
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update($id)
    {
        $this->checkAuth();


        $user =
            $this->userModel
                ->find($id);


        if (!$user) {

            $_SESSION['error'] =
                'User admin tidak ditemukan.';

            $this->redirect(
                '/admin/users'
            );

            exit;
        }


        $nama =
            trim($_POST['nama'] ?? '');


        $username =
            trim($_POST['username'] ?? '');


        $password =
            $_POST['password'] ?? '';


        $role =
            trim($_POST['role'] ?? 'admin');


        $status =
            trim($_POST['status'] ?? 'aktif');


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        if (
            $nama === '' ||
            $username === ''
        ) {

            $_SESSION['error'] =
                'Nama dan username wajib diisi.';

            $this->redirect(
                '/admin/users/edit/' . $id
            );

            exit;
        }


        if (strlen($username) < 3) {

            $_SESSION['error'] =
                'Username minimal 3 karakter.';

            $this->redirect(
                '/admin/users/edit/' . $id
            );

            exit;
        }


        if (
            !in_array(
                $role,
                ['admin']
            )
        ) {

            $role = 'admin';
        }


        if (
            !in_array(
                $status,
                ['aktif', 'nonaktif']
            )
        ) {

            $status = 'aktif';
        }


        /*
        |--------------------------------------------------------------------------
        | Cek Username
        |--------------------------------------------------------------------------
        */

        if (
            $this->userModel
                ->usernameExists(
                    $username,
                    $id
                )
        ) {

            $_SESSION['error'] =
                'Username tersebut sudah digunakan oleh admin lain.';

            $this->redirect(
                '/admin/users/edit/' . $id
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        */

        $hashedPassword = '';


        if ($password !== '') {

            if (strlen($password) < 6) {

                $_SESSION['error'] =
                    'Password baru minimal 6 karakter.';

                $this->redirect(
                    '/admin/users/edit/' . $id
                );

                exit;
            }


            $hashedPassword =
                password_hash(
                    $password,
                    PASSWORD_DEFAULT
                );
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        try {

            $this->userModel->update(
                $id,
                [
                    'nama'     => $nama,
                    'username' => $username,
                    'password' => $hashedPassword,
                    'role'     => $role,
                    'status'   => $status
                ]
            );


            /*
            |--------------------------------------------------------------------------
            | Update Session Jika Mengedit Akun Sendiri
            |--------------------------------------------------------------------------
            */

            if (
                isset($_SESSION['user']['id']) &&
                (int) $_SESSION['user']['id'] === (int) $id
            ) {

                $_SESSION['user']['nama'] =
                    $nama;

                $_SESSION['user']['username'] =
                    $username;

                $_SESSION['user']['role'] =
                    $role;
            }


            $_SESSION['success'] =
                'Data user admin berhasil diperbarui.';

        } catch (PDOException $e) {

            $_SESSION['error'] =
                'Gagal memperbarui user admin.';
        }


        $this->redirect(
            '/admin/users'
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | DELETE
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $this->checkAuth();


        /*
        |--------------------------------------------------------------------------
        | Jangan Hapus Akun Sendiri
        |--------------------------------------------------------------------------
        */

        if (
            isset($_SESSION['user']['id']) &&
            (int) $_SESSION['user']['id'] === (int) $id
        ) {

            $_SESSION['error'] =
                'Anda tidak dapat menghapus akun yang sedang digunakan.';

            $this->redirect(
                '/admin/users'
            );

            exit;
        }


        $user =
            $this->userModel
                ->find($id);


        if (!$user) {

            $_SESSION['error'] =
                'User admin tidak ditemukan.';

            $this->redirect(
                '/admin/users'
            );

            exit;
        }


        try {

            $this->userModel
                ->delete($id);


            $_SESSION['success'] =
                'User admin berhasil dihapus.';

        } catch (PDOException $e) {

            $_SESSION['error'] =
                'Gagal menghapus user admin.';
        }


        $this->redirect(
            '/admin/users'
        );

        exit;
    }
}