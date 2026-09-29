<?php

class AnggotaAdminController extends Controller
{
    private $anggota;


    public function __construct()
    {
        $this->anggota = new Anggota();
    }


    // =====================================================
    // INDEX
    // =====================================================

    public function index()
    {
        $anggota = $this->anggota->getAll();

        $this->view(
            'admin/anggota/index',
            [
                'anggota' => $anggota
            ]
        );
    }


    // =====================================================
    // CREATE
    // =====================================================

    public function create()
    {
        $this->view(
            'admin/anggota/create'
        );
    }


    // =====================================================
    // STORE
    // =====================================================

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            $this->redirect('/admin/anggota');

            return;
        }


        // -------------------------------------------------
        // Ambil data form
        // -------------------------------------------------

        $nama = trim(
            $_POST['nama'] ?? ''
        );

        $nis = trim(
            $_POST['nis'] ?? ''
        );

        $jenis_kelamin =
            $_POST['jenis_kelamin'] ?? '';

        $kelas = trim(
            $_POST['kelas'] ?? ''
        );

        $angkatan = trim(
            $_POST['angkatan'] ?? ''
        );

        $jabatan = trim(
            $_POST['jabatan'] ?? ''
        );

        $no_hp = trim(
            $_POST['no_hp'] ?? ''
        );

        $alamat = trim(
            $_POST['alamat'] ?? ''
        );

        $status =
            $_POST['status'] ?? 'aktif';


        // -------------------------------------------------
        // VALIDASI NAMA
        // -------------------------------------------------

        if ($nama === '') {

            $_SESSION['error'] =
                'Nama anggota wajib diisi.';

            $this->redirect(
                '/admin/anggota/create'
            );

            return;
        }


        // -------------------------------------------------
        // VALIDASI JENIS KELAMIN
        // -------------------------------------------------

        if (
            $jenis_kelamin !== 'L' &&
            $jenis_kelamin !== 'P'
        ) {

            $_SESSION['error'] =
                'Jenis kelamin wajib dipilih.';

            $this->redirect(
                '/admin/anggota/create'
            );

            return;
        }


        // -------------------------------------------------
        // VALIDASI STATUS
        // -------------------------------------------------

        if (
            $status !== 'aktif' &&
            $status !== 'nonaktif'
        ) {

            $status = 'aktif';
        }


        // =================================================
        // UPLOAD FOTO
        // =================================================

        $foto = null;


        if (
            isset($_FILES['foto']) &&
            $_FILES['foto']['error'] === UPLOAD_ERR_OK
        ) {

            $fileTmp =
                $_FILES['foto']['tmp_name'];

            $fileName =
                $_FILES['foto']['name'];

            $fileSize =
                $_FILES['foto']['size'];


            // ---------------------------------------------
            // Ambil extension
            // ---------------------------------------------

            $extension =
                strtolower(
                    pathinfo(
                        $fileName,
                        PATHINFO_EXTENSION
                    )
                );


            // ---------------------------------------------
            // Format yang diizinkan
            // ---------------------------------------------

            $allowedExtensions = [
                'jpg',
                'jpeg',
                'png',
                'webp'
            ];


            if (
                !in_array(
                    $extension,
                    $allowedExtensions
                )
            ) {

                $_SESSION['error'] =
                    'Format foto harus JPG, JPEG, PNG, atau WEBP.';

                $this->redirect(
                    '/admin/anggota/create'
                );

                return;
            }


            // ---------------------------------------------
            // Maksimal 2 MB
            // ---------------------------------------------

            if ($fileSize > 2 * 1024 * 1024) {

                $_SESSION['error'] =
                    'Ukuran foto maksimal 2 MB.';

                $this->redirect(
                    '/admin/anggota/create'
                );

                return;
            }


            // ---------------------------------------------
            // Folder upload
            // ---------------------------------------------

            $uploadDir =
                ROOT_PATH .
                '/uploads/anggota/';


            // Buat folder jika belum ada

            if (!is_dir($uploadDir)) {

                mkdir(
                    $uploadDir,
                    0777,
                    true
                );
            }


            // ---------------------------------------------
            // Nama file baru
            // ---------------------------------------------

            $newFileName =
                'anggota_' .
                time() .
                '_' .
                uniqid() .
                '.' .
                $extension;


            $destination =
                $uploadDir .
                $newFileName;


            // ---------------------------------------------
            // Pindahkan file
            // ---------------------------------------------

            if (
                move_uploaded_file(
                    $fileTmp,
                    $destination
                )
            ) {

                $foto =
                    $newFileName;

            } else {

                $_SESSION['error'] =
                    'Foto gagal diupload.';

                $this->redirect(
                    '/admin/anggota/create'
                );

                return;
            }
        }


        // =================================================
        // SIMPAN DATABASE
        // =================================================

        $berhasil =
            $this->anggota->create([

                'nama' =>
                    $nama,

                'nis' =>
                    $nis,

                'jenis_kelamin' =>
                    $jenis_kelamin,

                'kelas' =>
                    $kelas,

                'angkatan' =>
                    $angkatan,

                'jabatan' =>
                    $jabatan,

                'no_hp' =>
                    $no_hp,

                'alamat' =>
                    $alamat,

                'foto' =>
                    $foto,

                'status' =>
                    $status

            ]);


        // -------------------------------------------------
        // HASIL
        // -------------------------------------------------

        if ($berhasil) {

            $_SESSION['success'] =
                'Anggota berhasil ditambahkan.';

        } else {

            $_SESSION['error'] =
                'Gagal menyimpan data anggota.';
        }


        $this->redirect(
            '/admin/anggota'
        );
    }

    // =====================================================
// EDIT
// =====================================================

public function edit($id)
{
    $anggota = $this->anggota->find($id);

    if (!$anggota) {

        $_SESSION['error'] =
            'Data anggota tidak ditemukan.';

        $this->redirect(
            '/admin/anggota'
        );

        return;
    }

    $this->view(
        'admin/anggota/edit',
        [
            'anggota' => $anggota
        ]
    );
}


// =====================================================
// UPDATE
// =====================================================

public function update($id)
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        $this->redirect(
            '/admin/anggota'
        );

        return;
    }


    // -------------------------------------------------
    // Cari anggota
    // -------------------------------------------------

    $anggota =
        $this->anggota->find($id);


    if (!$anggota) {

        $_SESSION['error'] =
            'Data anggota tidak ditemukan.';

        $this->redirect(
            '/admin/anggota'
        );

        return;
    }


    // -------------------------------------------------
    // Ambil data form
    // -------------------------------------------------

    $nama =
        trim($_POST['nama'] ?? '');

    $nis =
        trim($_POST['nis'] ?? '');

    $jenis_kelamin =
        $_POST['jenis_kelamin'] ?? '';

    $kelas =
        trim($_POST['kelas'] ?? '');

    $angkatan =
        trim($_POST['angkatan'] ?? '');

    $jabatan =
        trim($_POST['jabatan'] ?? '');

    $no_hp =
        trim($_POST['no_hp'] ?? '');

    $alamat =
        trim($_POST['alamat'] ?? '');

    $status =
        $_POST['status'] ?? 'aktif';


    // -------------------------------------------------
    // Validasi
    // -------------------------------------------------

    if ($nama === '') {

        $_SESSION['error'] =
            'Nama anggota wajib diisi.';

        $this->redirect(
            '/admin/anggota/edit/' . $id
        );

        return;
    }


    if (
        $jenis_kelamin !== 'L'
        &&
        $jenis_kelamin !== 'P'
    ) {

        $_SESSION['error'] =
            'Jenis kelamin wajib dipilih.';

        $this->redirect(
            '/admin/anggota/edit/' . $id
        );

        return;
    }


    if (
        $status !== 'aktif'
        &&
        $status !== 'nonaktif'
    ) {

        $status = 'aktif';
    }


    // =================================================
    // FOTO
    // =================================================

    // Default gunakan foto lama

    $foto =
        $anggota['foto'];


    // Jika upload foto baru

    if (
        isset($_FILES['foto'])
        &&
        $_FILES['foto']['error'] === UPLOAD_ERR_OK
    ) {

        $fileTmp =
            $_FILES['foto']['tmp_name'];

        $fileName =
            $_FILES['foto']['name'];

        $fileSize =
            $_FILES['foto']['size'];


        // Extension

        $extension =
            strtolower(
                pathinfo(
                    $fileName,
                    PATHINFO_EXTENSION
                )
            );


        // Format

        $allowedExtensions = [
            'jpg',
            'jpeg',
            'png',
            'webp'
        ];


        if (
            !in_array(
                $extension,
                $allowedExtensions
            )
        ) {

            $_SESSION['error'] =
                'Format foto harus JPG, JPEG, PNG, atau WEBP.';

            $this->redirect(
                '/admin/anggota/edit/' . $id
            );

            return;
        }


        // Maksimal 2 MB

        if ($fileSize > 2 * 1024 * 1024) {

            $_SESSION['error'] =
                'Ukuran foto maksimal 2 MB.';

            $this->redirect(
                '/admin/anggota/edit/' . $id
            );

            return;
        }


        // Folder upload

        $uploadDir =
            ROOT_PATH .
            '/uploads/anggota/';


        if (!is_dir($uploadDir)) {

            mkdir(
                $uploadDir,
                0777,
                true
            );
        }


        // Nama file baru

        $newFileName =
            'anggota_' .
            time() .
            '_' .
            uniqid() .
            '.' .
            $extension;


        $destination =
            $uploadDir .
            $newFileName;


        // Upload

        if (
            move_uploaded_file(
                $fileTmp,
                $destination
            )
        ) {

            // Hapus foto lama

            if (
                !empty($anggota['foto'])
            ) {

                $oldPhoto =
                    $uploadDir .
                    $anggota['foto'];


                if (file_exists($oldPhoto)) {

                    unlink($oldPhoto);

                }

            }


            // Gunakan foto baru

            $foto =
                $newFileName;

        } else {

            $_SESSION['error'] =
                'Foto gagal diupload.';

            $this->redirect(
                '/admin/anggota/edit/' . $id
            );

            return;
        }

    }


    // =================================================
    // UPDATE DATABASE
    // =================================================

    $berhasil =
        $this->anggota->update(
            $id,
            [

                'nama' =>
                    $nama,

                'nis' =>
                    $nis,

                'jenis_kelamin' =>
                    $jenis_kelamin,

                'kelas' =>
                    $kelas,

                'angkatan' =>
                    $angkatan,

                'jabatan' =>
                    $jabatan,

                'no_hp' =>
                    $no_hp,

                'alamat' =>
                    $alamat,

                'foto' =>
                    $foto,

                'status' =>
                    $status

            ]
        );


    // -------------------------------------------------
    // Hasil
    // -------------------------------------------------

    if ($berhasil) {

        $_SESSION['success'] =
            'Data anggota berhasil diperbarui.';

    } else {

        $_SESSION['error'] =
            'Gagal memperbarui data anggota.';

    }


    $this->redirect(
        '/admin/anggota'
    );
}

// =====================================================
// DELETE
// =====================================================

public function delete($id)
{
    // -------------------------------------------------
    // Pastikan request POST
    // -------------------------------------------------

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

        $this->redirect(
            '/admin/anggota'
        );

        return;
    }


    // -------------------------------------------------
    // Cari anggota
    // -------------------------------------------------

    $anggota =
        $this->anggota->find($id);


    if (!$anggota) {

        $_SESSION['error'] =
            'Data anggota tidak ditemukan.';

        $this->redirect(
            '/admin/anggota'
        );

        return;
    }


    // -------------------------------------------------
    // Hapus database
    // -------------------------------------------------

    $berhasil =
        $this->anggota->delete($id);


    if ($berhasil) {

        // ---------------------------------------------
        // Hapus foto
        // ---------------------------------------------

        if (!empty($anggota['foto'])) {

            $photoPath =
                ROOT_PATH .
                '/uploads/anggota/' .
                $anggota['foto'];


            if (file_exists($photoPath)) {

                unlink($photoPath);

            }

        }


        $_SESSION['success'] =
            'Anggota berhasil dihapus.';

    } else {

        $_SESSION['error'] =
            'Gagal menghapus data anggota.';

    }


    $this->redirect(
        '/admin/anggota'
    );
}

}