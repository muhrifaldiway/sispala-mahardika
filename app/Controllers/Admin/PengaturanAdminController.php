<?php

class PengaturanAdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |----------------------------------------------------------------------
        | Cek Login
        |----------------------------------------------------------------------
        */

        if (!isset($_SESSION['user'])) {

            $this->redirect('/admin/login');

            return;
        }


        /*
        |----------------------------------------------------------------------
        | Model
        |----------------------------------------------------------------------
        */

        $pengaturanModel = new Pengaturan();

        $pengaturan = $pengaturanModel->get();


        /*
        |----------------------------------------------------------------------
        | Jika Data Tidak Ada
        |----------------------------------------------------------------------
        */

        if (!$pengaturan) {

            $_SESSION['error'] =
                'Data pengaturan website belum tersedia.';

            $this->redirect('/admin/dashboard');

            return;
        }


        /*
        |----------------------------------------------------------------------
        | View
        |----------------------------------------------------------------------
        */

        $this->view(
            'admin/pengaturan/index',
            [
                'pengaturan' => $pengaturan
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update()
    {
        /*
        |----------------------------------------------------------------------
        | Cek Login
        |----------------------------------------------------------------------
        */

        if (!isset($_SESSION['user'])) {

            $this->redirect('/admin/login');

            return;
        }


        /*
        |----------------------------------------------------------------------
        | Pastikan POST
        |----------------------------------------------------------------------
        */

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            $this->redirect('/admin/pengaturan');

            return;
        }


        /*
        |----------------------------------------------------------------------
        | Ambil Data
        |----------------------------------------------------------------------
        */

        $id = $_POST['id'] ?? null;

        $namaWebsite =
            trim($_POST['nama_website'] ?? '');

        $deskripsi =
            trim($_POST['deskripsi'] ?? '');

        $email =
            trim($_POST['email'] ?? '');

        $noHp =
            trim($_POST['no_hp'] ?? '');

        $alamat =
            trim($_POST['alamat'] ?? '');

        $instagram =
            trim($_POST['instagram'] ?? '');

        $facebook =
            trim($_POST['facebook'] ?? '');

        $youtube =
            trim($_POST['youtube'] ?? '');

        $footerText =
            trim($_POST['footer_text'] ?? '');


        /*
        |----------------------------------------------------------------------
        | Validasi
        |----------------------------------------------------------------------
        */

        if (
            empty($id) ||
            empty($namaWebsite)
        ) {

            $_SESSION['error'] =
                'Nama website wajib diisi.';

            $this->redirect('/admin/pengaturan');

            return;
        }


        /*
        |----------------------------------------------------------------------
        | Validasi Email
        |----------------------------------------------------------------------
        */

        if (
            !empty($email) &&
            !filter_var(
                $email,
                FILTER_VALIDATE_EMAIL
            )
        ) {

            $_SESSION['error'] =
                'Format email tidak valid.';

            $this->redirect('/admin/pengaturan');

            return;
        }


        /*
        |----------------------------------------------------------------------
        | Model
        |----------------------------------------------------------------------
        */

        $pengaturanModel =
            new Pengaturan();


        /*
        |----------------------------------------------------------------------
        | Update Data
        |----------------------------------------------------------------------
        */

        $pengaturanModel->updateData([
            'id'            => $id,
            'nama_website'  => $namaWebsite,
            'deskripsi'     => $deskripsi,
            'email'         => $email,
            'no_hp'         => $noHp,
            'alamat'        => $alamat,
            'instagram'     => $instagram,
            'facebook'      => $facebook,
            'youtube'       => $youtube,
            'footer_text'   => $footerText
        ]);


        /*
        |----------------------------------------------------------------------
        | Upload Logo
        |----------------------------------------------------------------------
        */

        if (
            isset($_FILES['logo']) &&
            $_FILES['logo']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            $file =
                $_FILES['logo'];


            /*
            |------------------------------------------------------------------
            | Cek Upload
            |------------------------------------------------------------------
            */

            if (
                $file['error'] !== UPLOAD_ERR_OK
            ) {

                $_SESSION['error'] =
                    'Gagal mengupload logo.';

                $this->redirect('/admin/pengaturan');

                return;
            }


            /*
            |------------------------------------------------------------------
            | Batas Ukuran
            |------------------------------------------------------------------
            */

            $maxSize =
                2 * 1024 * 1024;


            if (
                $file['size'] > $maxSize
            ) {

                $_SESSION['error'] =
                    'Ukuran logo maksimal 2 MB.';

                $this->redirect('/admin/pengaturan');

                return;
            }


            /*
            |------------------------------------------------------------------
            | Validasi MIME
            |------------------------------------------------------------------
            */

            $allowedTypes = [
                'image/jpeg' => 'jpg',
                'image/png'  => 'png',
                'image/webp' => 'webp'
            ];


            $finfo =
                finfo_open(
                    FILEINFO_MIME_TYPE
                );


            $mime =
                finfo_file(
                    $finfo,
                    $file['tmp_name']
                );


            finfo_close($finfo);


            if (
                !isset(
                    $allowedTypes[$mime]
                )
            ) {

                $_SESSION['error'] =
                    'Format logo harus JPG, PNG, atau WEBP.';

                $this->redirect('/admin/pengaturan');

                return;
            }


            /*
            |------------------------------------------------------------------
            | Buat Nama File
            |------------------------------------------------------------------
            */

            $extension =
                $allowedTypes[$mime];


            $filename =
                'logo_' .
                time() .
                '_' .
                bin2hex(
                    random_bytes(5)
                ) .
                '.' .
                $extension;


            /*
            |------------------------------------------------------------------
            | Folder Upload
            |------------------------------------------------------------------
            */

            $uploadDir =
                ROOT_PATH .
                '/public/uploads/logo';


            /*
            |------------------------------------------------------------------
            | Buat Folder Jika Belum Ada
            |------------------------------------------------------------------
            */

            if (
                !is_dir($uploadDir)
            ) {

                mkdir(
                    $uploadDir,
                    0755,
                    true
                );
            }


            /*
            |------------------------------------------------------------------
            | Path File
            |------------------------------------------------------------------
            */

            $destination =
                $uploadDir .
                '/' .
                $filename;


            /*
            |------------------------------------------------------------------
            | Upload
            |------------------------------------------------------------------
            */

            if (
                !move_uploaded_file(
                    $file['tmp_name'],
                    $destination
                )
            ) {

                $_SESSION['error'] =
                    'Logo gagal disimpan.';

                $this->redirect('/admin/pengaturan');

                return;
            }


            /*
            |------------------------------------------------------------------
            | Ambil Pengaturan Lama
            |------------------------------------------------------------------
            */

            $oldData =
                $pengaturanModel->get();


            /*
            |------------------------------------------------------------------
            | Hapus Logo Lama
            |------------------------------------------------------------------
            */

            if (
                !empty($oldData['logo'])
            ) {

                $oldLogo =
                    $uploadDir .
                    '/' .
                    basename(
                        $oldData['logo']
                    );


                if (
                    is_file($oldLogo)
                ) {

                    unlink($oldLogo);
                }
            }


            /*
            |------------------------------------------------------------------
            | Simpan Nama Logo Baru
            |------------------------------------------------------------------
            */

            $pengaturanModel->updateLogo(
                $id,
                $filename
            );
        }


        /*
        |----------------------------------------------------------------------
        | Berhasil
        |----------------------------------------------------------------------
        */

        $_SESSION['success'] =
            'Pengaturan website berhasil diperbarui.';


        $this->redirect(
            '/admin/pengaturan'
        );
    }
}