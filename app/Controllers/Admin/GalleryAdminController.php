<?php

class GalleryAdminController extends Controller
{
    private $gallery;


    /*
    |--------------------------------------------------------------------------
    | Constructor
    |--------------------------------------------------------------------------
    */

    public function __construct()
    {
        $this->gallery = new Gallery();
    }


    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $gallery = $this->gallery->all();

        return $this->view(
            'admin/gallery/index',
            [
                'gallery' => $gallery
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
            'admin/gallery/create'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store()
    {
        if (
            !isset($_POST['judul']) ||
            trim($_POST['judul']) === ''
        ) {

            $_SESSION['error'] =
                'Judul gallery wajib diisi.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery/create'
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi foto
        |--------------------------------------------------------------------------
        */

        if (
            !isset($_FILES['foto']) ||
            $_FILES['foto']['error'] !== UPLOAD_ERR_OK
        ) {

            $_SESSION['error'] =
                'Foto gallery wajib diupload.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery/create'
            );

            exit;
        }


        $file = $_FILES['foto'];


        /*
        |--------------------------------------------------------------------------
        | Maksimal 2 MB
        |--------------------------------------------------------------------------
        */

        $maxSize =
            2 * 1024 * 1024;


        if ($file['size'] > $maxSize) {

            $_SESSION['error'] =
                'Ukuran foto maksimal 2 MB.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery/create'
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi MIME
        |--------------------------------------------------------------------------
        */

        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        $mimeType =
            mime_content_type(
                $file['tmp_name']
            );


        if (
            !in_array(
                $mimeType,
                $allowedTypes
            )
        ) {

            $_SESSION['error'] =
                'Format foto harus JPG, JPEG, PNG, atau WEBP.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery/create'
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Folder upload
        |--------------------------------------------------------------------------
        */

        $uploadDir =
            ROOT_PATH .
            '/public/uploads/gallery/';


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
        |--------------------------------------------------------------------------
        | Nama file
        |--------------------------------------------------------------------------
        */

        $extension =
            strtolower(
                pathinfo(
                    $file['name'],
                    PATHINFO_EXTENSION
                )
            );


        $fileName =
            'gallery_' .
            time() .
            '_' .
            bin2hex(
                random_bytes(5)
            ) .
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
            !move_uploaded_file(
                $file['tmp_name'],
                $destination
            )
        ) {

            $_SESSION['error'] =
                'Foto gagal diupload.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery/create'
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Data
        |--------------------------------------------------------------------------
        */

        $data = [

            'judul' =>
                trim($_POST['judul']),

            'deskripsi' =>
                trim(
                    $_POST['deskripsi'] ?? ''
                ),

            'foto' =>
                $fileName,

            'status' =>
                $_POST['status'] ?? 'aktif'
        ];


        /*
        |--------------------------------------------------------------------------
        | Simpan database
        |--------------------------------------------------------------------------
        */

        if (
            $this->gallery->create($data)
        ) {

            $_SESSION['success'] =
                'Gallery berhasil ditambahkan.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery'
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Jika database gagal
        |--------------------------------------------------------------------------
        */

        if (
            file_exists($destination)
        ) {

            unlink($destination);
        }


        $_SESSION['error'] =
            'Gallery gagal disimpan.';

        header(
            'Location: ' .
            BASE_URL .
            '/admin/gallery/create'
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
        $gallery =
            $this->gallery->find($id);


        if (!$gallery) {

            http_response_code(404);

            echo '<h1>Gallery tidak ditemukan.</h1>';

            return;
        }


        return $this->view(
            'admin/gallery/edit',
            [
                'gallery' => $gallery
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
        $gallery =
            $this->gallery->find($id);


        if (!$gallery) {

            $_SESSION['error'] =
                'Gallery tidak ditemukan.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery'
            );

            exit;
        }


        if (
            !isset($_POST['judul']) ||
            trim($_POST['judul']) === ''
        ) {

            $_SESSION['error'] =
                'Judul gallery wajib diisi.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery/edit/' .
                $id
            );

            exit;
        }


        $data = [

            'judul' =>
                trim($_POST['judul']),

            'deskripsi' =>
                trim(
                    $_POST['deskripsi'] ?? ''
                ),

            'status' =>
                $_POST['status'] ?? 'aktif'
        ];


        /*
        |--------------------------------------------------------------------------
        | Cek apakah ada foto baru
        |--------------------------------------------------------------------------
        */

        $hasNewPhoto =
            isset($_FILES['foto']) &&
            $_FILES['foto']['error'] === UPLOAD_ERR_OK;


        if (!$hasNewPhoto) {

            if (
                $this->gallery->update(
                    $id,
                    $data
                )
            ) {

                $_SESSION['success'] =
                    'Gallery berhasil diperbarui.';
            } else {

                $_SESSION['error'] =
                    'Gallery gagal diperbarui.';
            }


            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery'
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi ukuran foto
        |--------------------------------------------------------------------------
        */

        $file =
            $_FILES['foto'];


        $maxSize =
            2 * 1024 * 1024;


        if (
            $file['size'] > $maxSize
        ) {

            $_SESSION['error'] =
                'Ukuran foto maksimal 2 MB.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery/edit/' .
                $id
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Validasi MIME
        |--------------------------------------------------------------------------
        */

        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp'
        ];


        $mimeType =
            mime_content_type(
                $file['tmp_name']
            );


        if (
            !in_array(
                $mimeType,
                $allowedTypes
            )
        ) {

            $_SESSION['error'] =
                'Format foto tidak valid.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery/edit/' .
                $id
            );

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | Folder
        |--------------------------------------------------------------------------
        */

        $uploadDir =
            ROOT_PATH .
            '/public/uploads/gallery/';


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
        |--------------------------------------------------------------------------
        | Nama file baru
        |--------------------------------------------------------------------------
        */

        $extension =
            strtolower(
                pathinfo(
                    $file['name'],
                    PATHINFO_EXTENSION
                )
            );


        $fileName =
            'gallery_' .
            time() .
            '_' .
            bin2hex(
                random_bytes(5)
            ) .
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
            !move_uploaded_file(
                $file['tmp_name'],
                $destination
            )
        ) {

            $_SESSION['error'] =
                'Foto gagal diupload.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery/edit/' .
                $id
            );

            exit;
        }


        $data['foto'] =
            $fileName;


        /*
        |--------------------------------------------------------------------------
        | Update database
        |--------------------------------------------------------------------------
        */

        if (
            $this->gallery->updateWithPhoto(
                $id,
                $data
            )
        ) {

            /*
            |--------------------------------------------------------------
            | Hapus foto lama
            |--------------------------------------------------------------
            */

            $oldPhoto =
                ROOT_PATH .
                '/public/uploads/gallery/' .
                $gallery['foto'];


            if (
                file_exists($oldPhoto)
            ) {

                unlink($oldPhoto);
            }


            $_SESSION['success'] =
                'Gallery berhasil diperbarui.';
        } else {

            /*
            |--------------------------------------------------------------
            | Jika gagal, hapus foto baru
            |--------------------------------------------------------------
            */

            if (
                file_exists($destination)
            ) {

                unlink($destination);
            }


            $_SESSION['error'] =
                'Gallery gagal diperbarui.';
        }


        header(
            'Location: ' .
            BASE_URL .
            '/admin/gallery'
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
        $gallery =
            $this->gallery->find($id);


        if (!$gallery) {

            $_SESSION['error'] =
                'Gallery tidak ditemukan.';

            header(
                'Location: ' .
                BASE_URL .
                '/admin/gallery'
            );

            exit;
        }


        if (
            $this->gallery->delete($id)
        ) {

            /*
            |--------------------------------------------------------------
            | Hapus file foto
            |--------------------------------------------------------------
            */

            $photoPath =
                ROOT_PATH .
                '/public/uploads/gallery/' .
                $gallery['foto'];


            if (
                file_exists($photoPath)
            ) {

                unlink($photoPath);
            }


            $_SESSION['success'] =
                'Gallery berhasil dihapus.';
        } else {

            $_SESSION['error'] =
                'Gallery gagal dihapus.';
        }


        header(
            'Location: ' .
            BASE_URL .
            '/admin/gallery'
        );

        exit;
    }
}