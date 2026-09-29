<?php

class BeritaAdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $beritaModel = new Berita();

        $berita = $beritaModel->all();

        return $this->view(
            'admin/berita/index',
            [
                'berita' => $berita
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
        return $this->view(
            'admin/berita/create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header(
                'Location: ' .
                BASE_URL .
                '/admin/berita'
            );

            exit;
        }


        $judul =
            trim($_POST['judul'] ?? '');

        $ringkasan =
            trim($_POST['ringkasan'] ?? '');

        $isi =
            trim($_POST['isi'] ?? '');

        $kategori =
            trim($_POST['kategori'] ?? '');

        $status =
            $_POST['status'] ?? 'draft';


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        if ($judul === '') {

            $_SESSION['error'] =
                'Judul berita wajib diisi.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/berita/create'
            );

            exit;
        }


        if ($isi === '') {

            $_SESSION['error'] =
                'Isi berita wajib diisi.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/berita/create'
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $slug =
            $this->makeSlug($judul);


        /*
        |--------------------------------------------------------------------------
        | Tanggal Publish
        |--------------------------------------------------------------------------
        */

        $tanggalPublish = null;


        if ($status === 'publish') {

            $tanggalPublish =
                date('Y-m-d H:i:s');
        }


        /*
        |--------------------------------------------------------------------------
        | Upload Gambar
        |--------------------------------------------------------------------------
        */

        $gambar = null;


        if (
            isset($_FILES['gambar']) &&
            $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            $gambar =
                $this->uploadGambar(
                    $_FILES['gambar']
                );


            if (!$gambar) {

                header(
                    'Location: ' .
                    BASE_URL .
                    '/admin/berita/create'
                );

                exit;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Simpan
        |--------------------------------------------------------------------------
        */

        $model =
            new Berita();


        $model->create(
            [
                'judul' =>
                    $judul,

                'slug' =>
                    $slug,

                'ringkasan' =>
                    $ringkasan,

                'isi' =>
                    $isi,

                'gambar' =>
                    $gambar,

                'kategori' =>
                    $kategori,

                'status' =>
                    $status,

                'tanggal_publish' =>
                    $tanggalPublish
            ]
        );


        $_SESSION['success'] =
            'Berita berhasil ditambahkan.';


        header(
            'Location: ' .
            BASE_URL .
            '/admin/berita'
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
        $model =
            new Berita();


        $berita =
            $model->find($id);


        if (!$berita) {

            $_SESSION['error'] =
                'Berita tidak ditemukan.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/berita'
            );

            exit;
        }


        return $this->view(
            'admin/berita/edit',
            [
                'berita' => $berita
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
        $model =
            new Berita();


        $berita =
            $model->find($id);


        if (!$berita) {

            $_SESSION['error'] =
                'Berita tidak ditemukan.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/berita'
            );

            exit;
        }


        $judul =
            trim($_POST['judul'] ?? '');

        $ringkasan =
            trim($_POST['ringkasan'] ?? '');

        $isi =
            trim($_POST['isi'] ?? '');

        $kategori =
            trim($_POST['kategori'] ?? '');

        $status =
            $_POST['status'] ?? 'draft';


        /*
        |--------------------------------------------------------------------------
        | Validasi
        |--------------------------------------------------------------------------
        */

        if ($judul === '' || $isi === '') {

            $_SESSION['error'] =
                'Judul dan isi berita wajib diisi.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/berita/edit/' .
                $id
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $slug =
            $this->makeSlug($judul);


        /*
        |--------------------------------------------------------------------------
        | Tanggal Publish
        |--------------------------------------------------------------------------
        */

        $tanggalPublish =
            $berita['tanggal_publish'];


        if ($status === 'publish') {

            if (empty($tanggalPublish)) {

                $tanggalPublish =
                    date('Y-m-d H:i:s');
            }

        } else {

            $tanggalPublish = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Gambar Lama
        |--------------------------------------------------------------------------
        */

        $gambar =
            $berita['gambar'];


        /*
        |--------------------------------------------------------------------------
        | Upload Gambar Baru
        |--------------------------------------------------------------------------
        */

        if (
            isset($_FILES['gambar']) &&
            $_FILES['gambar']['error'] !== UPLOAD_ERR_NO_FILE
        ) {

            $gambarBaru =
                $this->uploadGambar(
                    $_FILES['gambar']
                );


            if (!$gambarBaru) {

                header(
                    'Location: ' .
                    BASE_URL .
                    '/admin/berita/edit/' .
                    $id
                );

                exit;
            }


            /*
            | Hapus gambar lama
            */

            if (!empty($gambar)) {

                $fileLama =
                    ROOT_PATH .
                    '/public/uploads/berita/' .
                    $gambar;


                if (
                    file_exists($fileLama)
                ) {

                    unlink($fileLama);
                }
            }


            $gambar =
                $gambarBaru;
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $model->update(
            $id,
            [
                'judul' =>
                    $judul,

                'slug' =>
                    $slug,

                'ringkasan' =>
                    $ringkasan,

                'isi' =>
                    $isi,

                'gambar' =>
                    $gambar,

                'kategori' =>
                    $kategori,

                'status' =>
                    $status,

                'tanggal_publish' =>
                    $tanggalPublish
            ]
        );


        $_SESSION['success'] =
            'Berita berhasil diperbarui.';


        header(
            'Location: ' .
            BASE_URL .
            '/admin/berita'
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
        $model =
            new Berita();


        $berita =
            $model->find($id);


        if (!$berita) {

            $_SESSION['error'] =
                'Berita tidak ditemukan.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/berita'
            );

            exit;
        }


        /*
        | Hapus gambar
        */

        if (!empty($berita['gambar'])) {

            $file =
                ROOT_PATH .
                '/public/uploads/berita/' .
                $berita['gambar'];


            if (
                file_exists($file)
            ) {

                unlink($file);
            }
        }


        /*
        | Hapus database
        */

        $model->delete($id);


        $_SESSION['success'] =
            'Berita berhasil dihapus.';


        header(
            'Location: ' .
            BASE_URL .
            '/admin/berita'
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | MAKE SLUG
    |--------------------------------------------------------------------------
    */

    private function makeSlug($text)
    {
        $text =
            strtolower(
                trim($text)
            );


        $text =
            preg_replace(
                '/[^a-z0-9\s-]/',
                '',
                $text
            );


        $text =
            preg_replace(
                '/[\s-]+/',
                '-',
                $text
            );


        return trim(
            $text,
            '-'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | UPLOAD GAMBAR
    |--------------------------------------------------------------------------
    */

    private function uploadGambar($file)
    {
        if (
            !isset($file['tmp_name']) ||
            !is_uploaded_file($file['tmp_name'])
        ) {

            $_SESSION['error'] =
                'File gambar tidak valid.';

            return false;
        }


        /*
        | Ukuran maksimal 2 MB
        */

        $maxSize =
            2 * 1024 * 1024;


        if (
            $file['size'] > $maxSize
        ) {

            $_SESSION['error'] =
                'Ukuran gambar maksimal 2 MB.';

            return false;
        }


        /*
        | Validasi MIME
        */

        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        $mime =
            mime_content_type(
                $file['tmp_name']
            );


        if (
            !in_array(
                $mime,
                $allowedTypes
            )
        ) {

            $_SESSION['error'] =
                'Format gambar harus JPG, PNG, atau WEBP.';

            return false;
        }


        /*
        | Extension
        */

        $extension =
            strtolower(
                pathinfo(
                    $file['name'],
                    PATHINFO_EXTENSION
                )
            );


        /*
        | Nama file unik
        */

        $fileName =
            uniqid(
                'berita_',
                true
            ) .
            '.' .
            $extension;


        /*
        | Folder
        */

        $uploadDir =
            ROOT_PATH .
            '/public/uploads/berita/';


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
        | Upload
        */

        $destination =
            $uploadDir .
            $fileName;


        if (
            !move_uploaded_file(
                $file['tmp_name'],
                $destination
            )
        ) {

            $_SESSION['error'] =
                'Gagal mengupload gambar.';

            return false;
        }


        return $fileName;
    }
}