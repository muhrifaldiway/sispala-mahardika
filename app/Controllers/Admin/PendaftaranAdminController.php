<?php

class PendaftaranAdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $search =
            $_GET['search'] ?? '';

        $status =
            $_GET['status'] ?? '';


        $model =
            new Pendaftaran();


        $data =
            $model->getAll(
                $search,
                $status
            );


        $total =
            count($data);


        $pending =
            $model->countByStatus(
                'pending'
            );


        $diterima =
            $model->countByStatus(
                'diterima'
            );


        $ditolak =
            $model->countByStatus(
                'ditolak'
            );


        $this->view(
            'admin/pendaftaran/index',
            [
                'data'     => $data,
                'search'   => $search,
                'status'   => $status,
                'total'    => $total,
                'pending'  => $pending,
                'diterima' => $diterima,
                'ditolak'  => $ditolak
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
        $model =
            new Pendaftaran();


        $nomor =
            $model->generateNomor();


        $this->view(
            'admin/pendaftaran/create',
            [
                'nomor' => $nomor
            ]
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
            $_SERVER['REQUEST_METHOD']
            !== 'POST'
        ) {

            header(
                'Location: '
                . BASE_URL
                . '/admin/pendaftaran'
            );

            exit;
        }


        $model =
            new Pendaftaran();


        $nomor =
            $model->generateNomor();


        $nama =
            trim(
                $_POST['nama_lengkap']
                ?? ''
            );


        $jenisKelamin =
            $_POST['jenis_kelamin']
            ?? '';


        if (
            $nama === ''
            || $jenisKelamin === ''
        ) {

            $_SESSION['error'] =
                'Nama lengkap dan jenis kelamin wajib diisi.';


            header(
                'Location: '
                . BASE_URL
                . '/admin/pendaftaran/create'
            );

            exit;
        }


        $data = [

            'nomor_pendaftaran'
                => $nomor,

            'nama_lengkap'
                => $nama,

            'nis'
                => trim(
                    $_POST['nis']
                    ?? ''
                ),

            'jenis_kelamin'
                => $jenisKelamin,

            'kelas'
                => trim(
                    $_POST['kelas']
                    ?? ''
                ),

            'angkatan'
                => trim(
                    $_POST['angkatan']
                    ?? ''
                ),

            'tempat_lahir'
                => trim(
                    $_POST['tempat_lahir']
                    ?? ''
                ),

            'tanggal_lahir'
                => !empty(
                    $_POST['tanggal_lahir']
                    ?? ''
                )
                    ? $_POST['tanggal_lahir']
                    : null,

            'no_hp'
                => trim(
                    $_POST['no_hp']
                    ?? ''
                ),

            'alamat'
                => trim(
                    $_POST['alamat']
                    ?? ''
                ),

            'alasan'
                => trim(
                    $_POST['alasan']
                    ?? ''
                ),

            'pengalaman'
                => trim(
                    $_POST['pengalaman']
                    ?? ''
                ),

            'status'
                => 'pending',

            'catatan'
                => ''
        ];


        $model->createData(
            $data
        );


        $_SESSION['success'] =
            'Pendaftaran berhasil ditambahkan.';


        header(
            'Location: '
            . BASE_URL
            . '/admin/pendaftaran'
        );

        exit;
    }


    /*
    |--------------------------------------------------------------------------
    | DETAIL
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $model =
            new Pendaftaran();


        $data =
            $model->find($id);


        if (!$data) {

            $_SESSION['error'] =
                'Data pendaftaran tidak ditemukan.';


            header(
                'Location: '
                . BASE_URL
                . '/admin/pendaftaran'
            );

            exit;
        }


        $this->view(
            'admin/pendaftaran/show',
            [
                'data' => $data
            ]
        );
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $model =
            new Pendaftaran();


        $data =
            $model->find($id);


        if (!$data) {

            $_SESSION['error'] =
                'Data pendaftaran tidak ditemukan.';


            header(
                'Location: '
                . BASE_URL
                . '/admin/pendaftaran'
            );

            exit;
        }


        $this->view(
            'admin/pendaftaran/edit',
            [
                'data' => $data
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
            new Pendaftaran();


        $existing =
            $model->find($id);


        if (!$existing) {

            $_SESSION['error'] =
                'Data pendaftaran tidak ditemukan.';


            header(
                'Location: '
                . BASE_URL
                . '/admin/pendaftaran'
            );

            exit;
        }


        $nama =
            trim(
                $_POST['nama_lengkap']
                ?? ''
            );


        $jenisKelamin =
            $_POST['jenis_kelamin']
            ?? '';


        if (
            $nama === ''
            || $jenisKelamin === ''
        ) {

            $_SESSION['error'] =
                'Nama lengkap dan jenis kelamin wajib diisi.';


            header(
                'Location: '
                . BASE_URL
                . '/admin/pendaftaran/edit/'
                . $id
            );

            exit;
        }


        $status =
            $_POST['status']
            ?? 'pending';


        if (
            !in_array(
                $status,
                [
                    'pending',
                    'diterima',
                    'ditolak'
                ],
                true
            )
        ) {

            $status = 'pending';
        }


        $data = [

            'nama_lengkap'
                => $nama,

            'nis'
                => trim(
                    $_POST['nis']
                    ?? ''
                ),

            'jenis_kelamin'
                => $jenisKelamin,

            'kelas'
                => trim(
                    $_POST['kelas']
                    ?? ''
                ),

            'angkatan'
                => trim(
                    $_POST['angkatan']
                    ?? ''
                ),

            'tempat_lahir'
                => trim(
                    $_POST['tempat_lahir']
                    ?? ''
                ),

            'tanggal_lahir'
                => !empty(
                    $_POST['tanggal_lahir']
                    ?? ''
                )
                    ? $_POST['tanggal_lahir']
                    : null,

            'no_hp'
                => trim(
                    $_POST['no_hp']
                    ?? ''
                ),

            'alamat'
                => trim(
                    $_POST['alamat']
                    ?? ''
                ),

            'alasan'
                => trim(
                    $_POST['alasan']
                    ?? ''
                ),

            'pengalaman'
                => trim(
                    $_POST['pengalaman']
                    ?? ''
                ),

            'status'
                => $status,

            'catatan'
                => trim(
                    $_POST['catatan']
                    ?? ''
                )
        ];


        $model->updateData(
            $id,
            $data
        );


        $_SESSION['success'] =
            'Data pendaftaran berhasil diperbarui.';


        header(
            'Location: '
            . BASE_URL
            . '/admin/pendaftaran'
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
            new Pendaftaran();


        $data =
            $model->find($id);


        if (!$data) {

            $_SESSION['error'] =
                'Data pendaftaran tidak ditemukan.';


            header(
                'Location: '
                . BASE_URL
                . '/admin/pendaftaran'
            );

            exit;
        }


        $model->deleteData(
            $id
        );


        $_SESSION['success'] =
            'Data pendaftaran berhasil dihapus.';


        header(
            'Location: '
            . BASE_URL
            . '/admin/pendaftaran'
        );

        exit;
    }
}