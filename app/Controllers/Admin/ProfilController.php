<?php

class ProfilController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Halaman Profil Organisasi
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        if (!isset($_SESSION['user'])) {

            $this->redirect(
                '/admin/login'
            );

            return;
        }


        $profilModel =
            new Profil();


        $profil =
            $profilModel->getProfil();


        $this->view(
            'admin/profil/index',
            [

                'profil' =>
                    $profil

            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Update Profil Organisasi
    |--------------------------------------------------------------------------
    */

    public function update()
    {
        if (!isset($_SESSION['user'])) {

            $this->redirect(
                '/admin/login'
            );

            return;
        }


        $id =
            $_POST['id'] ?? null;


        if (!$id) {

            $_SESSION['error'] =
                'Data profil tidak ditemukan.';


            $this->redirect(
                '/admin/profil'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Data Form
        |--------------------------------------------------------------------------
        */

        $data = [

            'nama_organisasi' =>
                trim(
                    $_POST['nama_organisasi'] ?? ''
                ),

            'singkatan' =>
                trim(
                    $_POST['singkatan'] ?? ''
                ),

            'sejarah' =>
                trim(
                    $_POST['sejarah'] ?? ''
                ),

            'visi' =>
                trim(
                    $_POST['visi'] ?? ''
                ),

            'misi' =>
                trim(
                    $_POST['misi'] ?? ''
                ),

            'alamat' =>
                trim(
                    $_POST['alamat'] ?? ''
                ),

            'email' =>
                trim(
                    $_POST['email'] ?? ''
                ),

            'no_hp' =>
                trim(
                    $_POST['no_hp'] ?? ''
                ),

            'instagram' =>
                trim(
                    $_POST['instagram'] ?? ''
                ),

            'facebook' =>
                trim(
                    $_POST['facebook'] ?? ''
                ),

            'youtube' =>
                trim(
                    $_POST['youtube'] ?? ''
                ),

            'periode_kepengurusan' =>
                trim(
                    $_POST['periode_kepengurusan'] ?? ''
                )

        ];


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        if (
            empty(
                $data['nama_organisasi']
            )
        ) {

            $_SESSION['error'] =
                'Nama organisasi wajib diisi.';


            $this->redirect(
                '/admin/profil'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Update Data
        |--------------------------------------------------------------------------
        */

        $profilModel =
            new Profil();


        $profilModel->updateProfil(
            $id,
            $data
        );


        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */

        if (
            isset($_FILES['logo']) &&
            $_FILES['logo']['error'] === UPLOAD_ERR_OK
        ) {

            $allowedTypes = [

                'image/jpeg',

                'image/png',

                'image/webp'

            ];


            $fileType =
                mime_content_type(
                    $_FILES['logo']['tmp_name']
                );


            if (
                !in_array(
                    $fileType,
                    $allowedTypes
                )
            ) {

                $_SESSION['error'] =
                    'Format logo harus JPG, PNG, atau WEBP.';


                $this->redirect(
                    '/admin/profil'
                );

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Maksimal 2 MB
            |--------------------------------------------------------------------------
            */

            if (
                $_FILES['logo']['size']
                >
                2 * 1024 * 1024
            ) {

                $_SESSION['error'] =
                    'Ukuran logo maksimal 2 MB.';


                $this->redirect(
                    '/admin/profil'
                );

                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Folder Upload
            |--------------------------------------------------------------------------
            */

            $uploadDir =
                ROOT_PATH .
                '/public/uploads/logo/';


            if (
                !is_dir(
                    $uploadDir
                )
            ) {

                mkdir(
                    $uploadDir,
                    0777,
                    true
                );
            }


            /*
            |--------------------------------------------------------------------------
            | Nama File Baru
            |--------------------------------------------------------------------------
            */

            $extension =
                strtolower(
                    pathinfo(
                        $_FILES['logo']['name'],
                        PATHINFO_EXTENSION
                    )
                );


            $fileName =
                'logo_' .
                time() .
                '_' .
                uniqid() .
                '.' .
                $extension;


            $destination =
                $uploadDir .
                $fileName;


            /*
            |--------------------------------------------------------------------------
            | Upload
            |--------------------------------------------------------------------------
            */

            if (
                move_uploaded_file(
                    $_FILES['logo']['tmp_name'],
                    $destination
                )
            ) {

                $profilModel->updateLogo(
                    $id,
                    $fileName
                );
            }
        }


        $_SESSION['success'] =
            'Profil organisasi berhasil diperbarui.';


        $this->redirect(
            '/admin/profil'
        );
    }
}