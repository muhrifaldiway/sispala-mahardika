<?php

class PublicPendaftaranController extends Controller
{
    public function index()
    {
        $this->view(
            'public/pendaftaran'
        );
    }


    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            $this->redirect(
                '/pendaftaran'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | INPUT
        |--------------------------------------------------------------------------
        */

        $nama =
            trim($_POST['nama_lengkap'] ?? '');

        $nis =
            trim($_POST['nis'] ?? '');

        $jenisKelamin =
            $_POST['jenis_kelamin'] ?? '';

        $kelas =
            trim($_POST['kelas'] ?? '');

        $angkatan =
            trim($_POST['angkatan'] ?? '');

        $tempatLahir =
            trim($_POST['tempat_lahir'] ?? '');

        $tanggalLahir =
            $_POST['tanggal_lahir'] ?? '';

        $noHp =
            trim($_POST['no_hp'] ?? '');

        $alamat =
            trim($_POST['alamat'] ?? '');

        $alasan =
            trim($_POST['alasan'] ?? '');

        $pengalaman =
            trim($_POST['pengalaman'] ?? '');


        /*
        |--------------------------------------------------------------------------
        | VALIDASI
        |--------------------------------------------------------------------------
        */

        if (
            $nama === '' ||
            !in_array(
                $jenisKelamin,
                ['L', 'P'],
                true
            )
        ) {

            $_SESSION['error'] =
                'Nama lengkap dan jenis kelamin wajib diisi.';

            $_SESSION['old'] =
                $_POST;

            $this->redirect(
                '/pendaftaran'
            );

            return;
        }


        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        try {

            $model =
                new Pendaftaran();


            $nomor =
                $model->generateNomor();


            $model->createData([

                'nomor_pendaftaran' =>
                    $nomor,

                'nama_lengkap' =>
                    $nama,

                'nis' =>
                    $nis,

                'jenis_kelamin' =>
                    $jenisKelamin,

                'kelas' =>
                    $kelas,

                'angkatan' =>
                    $angkatan,

                'tempat_lahir' =>
                    $tempatLahir,

                'tanggal_lahir' =>
                    $tanggalLahir,

                'no_hp' =>
                    $noHp,

                'alamat' =>
                    $alamat,

                'alasan' =>
                    $alasan,

                'pengalaman' =>
                    $pengalaman,

                'status' =>
                    'pending'
            ]);


            unset(
                $_SESSION['old']
            );


            $_SESSION['success'] =
                'Pendaftaran berhasil dikirim. Nomor pendaftaran Anda: '
                . $nomor;


            $_SESSION['nomor_pendaftaran'] =
                $nomor;


            $this->redirect(
                '/pendaftaran'
            );

        } catch (PDOException $e) {

            $_SESSION['error'] =
                'Pendaftaran gagal disimpan. Silakan coba kembali.';

            $_SESSION['old'] =
                $_POST;

            $this->redirect(
                '/pendaftaran'
            );
        }
    }
}