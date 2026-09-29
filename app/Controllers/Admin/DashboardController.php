<?php

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | CEK LOGIN
        |--------------------------------------------------------------------------
        */

        if (!isset($_SESSION['user'])) {

            $this->redirect('/admin/login');

            exit;
        }


        /*
        |--------------------------------------------------------------------------
        | DATABASE
        |--------------------------------------------------------------------------
        |
        | Karena DashboardController membutuhkan beberapa statistik,
        | kita menggunakan Database secara langsung.
        |
        */

        $database = new Database();

        $db = $database->getConnection();


        /*
        |--------------------------------------------------------------------------
        | DEFAULT STATISTIK
        |--------------------------------------------------------------------------
        */

        $totalAnggota = 0;

        $totalBerita = 0;

        $totalGaleri = 0;

        $totalPendaftaran = 0;

        $pendaftaranPending = 0;

        $pendaftaranDiterima = 0;

        $pendaftaranDitolak = 0;


        /*
        |--------------------------------------------------------------------------
        | TOTAL ANGGOTA
        |--------------------------------------------------------------------------
        */

        try {

            $stmt = $db->query(
                "SELECT COUNT(*) 
                 FROM anggota"
            );

            $totalAnggota = (int) $stmt->fetchColumn();

        } catch (PDOException $e) {

            $totalAnggota = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL BERITA
        |--------------------------------------------------------------------------
        */

        try {

            $stmt = $db->query(
                "SELECT COUNT(*) 
                 FROM berita"
            );

            $totalBerita = (int) $stmt->fetchColumn();

        } catch (PDOException $e) {

            $totalBerita = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL GALERI
        |--------------------------------------------------------------------------
        */

        try {

            $stmt = $db->query(
                "SELECT COUNT(*) 
                 FROM galeri"
            );

            $totalGaleri = (int) $stmt->fetchColumn();

        } catch (PDOException $e) {

            $totalGaleri = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | TOTAL PENDAFTARAN
        |--------------------------------------------------------------------------
        */

        try {

            $stmt = $db->query(
                "SELECT COUNT(*) 
                 FROM pendaftaran"
            );

            $totalPendaftaran = (int) $stmt->fetchColumn();

        } catch (PDOException $e) {

            $totalPendaftaran = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | PENDAFTARAN PENDING
        |--------------------------------------------------------------------------
        */

        try {

            $stmt = $db->prepare(
                "SELECT COUNT(*)
                 FROM pendaftaran
                 WHERE status = :status"
            );

            $stmt->execute([
                ':status' => 'pending'
            ]);

            $pendaftaranPending =
                (int) $stmt->fetchColumn();

        } catch (PDOException $e) {

            $pendaftaranPending = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | PENDAFTARAN DITERIMA
        |--------------------------------------------------------------------------
        */

        try {

            $stmt = $db->prepare(
                "SELECT COUNT(*)
                 FROM pendaftaran
                 WHERE status = :status"
            );

            $stmt->execute([
                ':status' => 'diterima'
            ]);

            $pendaftaranDiterima =
                (int) $stmt->fetchColumn();

        } catch (PDOException $e) {

            $pendaftaranDiterima = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | PENDAFTARAN DITOLAK
        |--------------------------------------------------------------------------
        */

        try {

            $stmt = $db->prepare(
                "SELECT COUNT(*)
                 FROM pendaftaran
                 WHERE status = :status"
            );

            $stmt->execute([
                ':status' => 'ditolak'
            ]);

            $pendaftaranDitolak =
                (int) $stmt->fetchColumn();

        } catch (PDOException $e) {

            $pendaftaranDitolak = 0;
        }


        /*
        |--------------------------------------------------------------------------
        | DATA TERBARU PENDAFTARAN
        |--------------------------------------------------------------------------
        */

        $pendaftaranTerbaru = [];


        try {

            $stmt = $db->query(
                "SELECT
                    id,
                    nomor_pendaftaran,
                    nama_lengkap,
                    kelas,
                    status,
                    tanggal_daftar
                 FROM pendaftaran
                 ORDER BY tanggal_daftar DESC
                 LIMIT 5"
            );

            $pendaftaranTerbaru =
                $stmt->fetchAll();

        } catch (PDOException $e) {

            $pendaftaranTerbaru = [];
        }

        /*
        |--------------------------------------------------------------------------
        | DATA PROFIL ORGANISASI
        |--------------------------------------------------------------------------
        */
        $profilOrganisasi = [];

        try {
            $stmt = $db->query(
                "SELECT * FROM profil_organisasi"
            );
            $profilOrganisasi = $stmt->fetch();
        } catch (PDOException $e) {
            $profilOrganisasi = [];
        }

        /*
        |--------------------------------------------------------------------------
        | KIRIM DATA KE VIEW
        |--------------------------------------------------------------------------
        */

        $this->view(
            'admin/dashboard',
            [
                'totalAnggota' =>
                    $totalAnggota,

                'totalBerita' =>
                    $totalBerita,

                'totalGaleri' =>
                    $totalGaleri,

                'totalPendaftaran' =>
                    $totalPendaftaran,

                'pendaftaranPending' =>
                    $pendaftaranPending,

                'pendaftaranDiterima' =>
                    $pendaftaranDiterima,

                'pendaftaranDitolak' =>
                    $pendaftaranDitolak,

                'pendaftaranTerbaru' =>
                    $pendaftaranTerbaru,
                
                'profilOrganisasi' => 
                    $profilOrganisasi,
            ]
        );
    }
}