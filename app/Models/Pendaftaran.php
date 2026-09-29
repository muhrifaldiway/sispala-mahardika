<?php

class Pendaftaran extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Nama Tabel
    |--------------------------------------------------------------------------
    */

    protected $table = 'pendaftaran';


    /*
    |--------------------------------------------------------------------------
    | Ambil Semua Data
    |--------------------------------------------------------------------------
    */

    public function getAll(
        $keyword = '', 
        $status = ''
        )
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE 1=1
        ";

        $params = [];


        /*
        |--------------------------------------------------------------------------
        | Pencarian
        |--------------------------------------------------------------------------
        */

        if ($keyword !== '') {

            $sql .= "
                AND (
                    nomor_pendaftaran LIKE :keyword1
                    OR nama_lengkap LIKE :keyword2
                    OR nis LIKE :keyword3
                    OR no_hp LIKE :keyword4
                )
            ";

            $search = '%' . $keyword . '%';

            $params[':keyword1'] = $search;
            $params[':keyword2'] = $search;
            $params[':keyword3'] = $search;
            $params[':keyword4'] = $search;
        }


        /*
        |--------------------------------------------------------------------------
        | Filter Status
        |--------------------------------------------------------------------------
        */

        if ($status !== '') {

            $sql .= "
                AND status = :status
            ";

            $params[':status'] = $status;
        }


        /*
        |--------------------------------------------------------------------------
        | Urutan
        |--------------------------------------------------------------------------
        */

        $sql .= "
            ORDER BY id DESC
        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute($params);


        return $stmt->fetchAll();
    }


    /*
    |--------------------------------------------------------------------------
    | Hitung Total Pendaftaran
    |--------------------------------------------------------------------------
    */

    public function countByStatus($status = '')
    {
        if ($status === '') {

            $sql = "
                SELECT COUNT(*) AS total
                FROM {$this->table}
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute();

        } else {

            $sql = "
                SELECT COUNT(*) AS total
                FROM {$this->table}
                WHERE status = :status
            ";

            $stmt = $this->db->prepare($sql);

            $stmt->execute([
                ':status' => $status
            ]);
        }


        $result = $stmt->fetch();

        return (int) ($result['total'] ?? 0);
    }


    /*
    |--------------------------------------------------------------------------
    | Generate Nomor Pendaftaran
    |--------------------------------------------------------------------------
    |
    | Contoh:
    |
    | PMB-2026-0001
    | PMB-2026-0002
    |
    */

    public function generateNomor()
    {
        $tahun = date('Y');

        $prefix = 'PMB-' . $tahun . '-';


        $sql = "
            SELECT nomor_pendaftaran
            FROM {$this->table}
            WHERE nomor_pendaftaran LIKE :prefix
            ORDER BY id DESC
            LIMIT 1
        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':prefix' => $prefix . '%'
        ]);


        $result = $stmt->fetch();


        $nomorTerakhir = 0;


        if ($result) {

            $nomor = $result['nomor_pendaftaran'] ?? '';

            if ($nomor !== '') {

                $parts = explode('-', $nomor);

                $nomorTerakhir = (int) end($parts);
            }
        }


        $nomorBaru = $nomorTerakhir + 1;


        return $prefix .
            str_pad(
                $nomorBaru,
                4,
                '0',
                STR_PAD_LEFT
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan Pendaftaran
    |--------------------------------------------------------------------------
    */

    public function createData($data)
    {
        $sql = "
            INSERT INTO {$this->table}
            (
                nomor_pendaftaran,
                nama_lengkap,
                nis,
                jenis_kelamin,
                kelas,
                angkatan,
                tempat_lahir,
                tanggal_lahir,
                no_hp,
                alamat,
                alasan,
                pengalaman,
                status,
                catatan
            )
            VALUES
            (
                :nomor_pendaftaran,
                :nama_lengkap,
                :nis,
                :jenis_kelamin,
                :kelas,
                :angkatan,
                :tempat_lahir,
                :tanggal_lahir,
                :no_hp,
                :alamat,
                :alasan,
                :pengalaman,
                :status,
                :catatan
            )
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            ':nomor_pendaftaran' =>
                $data['nomor_pendaftaran'] ?? null,

            ':nama_lengkap' =>
                $data['nama_lengkap'] ?? null,

            ':nis' =>
                $data['nis'] ?? null,

            ':jenis_kelamin' =>
                $data['jenis_kelamin'] ?? null,

            ':kelas' =>
                $data['kelas'] ?? null,

            ':angkatan' =>
                $data['angkatan'] ?? null,

            ':tempat_lahir' =>
                $data['tempat_lahir'] ?? null,

            ':tanggal_lahir' =>
                !empty($data['tanggal_lahir'])
                    ? $data['tanggal_lahir']
                    : null,

            ':no_hp' =>
                $data['no_hp'] ?? null,

            ':alamat' =>
                $data['alamat'] ?? null,

            ':alasan' =>
                $data['alasan'] ?? null,

            ':pengalaman' =>
                $data['pengalaman'] ?? null,

            ':status' =>
                $data['status'] ?? 'pending',

            ':catatan' =>
                $data['catatan'] ?? null
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Ambil Data Berdasarkan ID
    |--------------------------------------------------------------------------
    */

    public function find($id)
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE id = :id
            LIMIT 1
        ";


        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);


        return $stmt->fetch();
    }


    /*
    |--------------------------------------------------------------------------
    | Update Data
    |--------------------------------------------------------------------------
    */

    public function updateData($id, $data)
    {
        $sql = "
            UPDATE {$this->table}
            SET
                nama_lengkap = :nama_lengkap,
                nis = :nis,
                jenis_kelamin = :jenis_kelamin,
                kelas = :kelas,
                angkatan = :angkatan,
                tempat_lahir = :tempat_lahir,
                tanggal_lahir = :tanggal_lahir,
                no_hp = :no_hp,
                alamat = :alamat,
                alasan = :alasan,
                pengalaman = :pengalaman,
                status = :status,
                catatan = :catatan
            WHERE id = :id
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            ':nama_lengkap' =>
                $data['nama_lengkap'] ?? null,

            ':nis' =>
                $data['nis'] ?? null,

            ':jenis_kelamin' =>
                $data['jenis_kelamin'] ?? null,

            ':kelas' =>
                $data['kelas'] ?? null,

            ':angkatan' =>
                $data['angkatan'] ?? null,

            ':tempat_lahir' =>
                $data['tempat_lahir'] ?? null,

            ':tanggal_lahir' =>
                !empty($data['tanggal_lahir'])
                    ? $data['tanggal_lahir']
                    : null,

            ':no_hp' =>
                $data['no_hp'] ?? null,

            ':alamat' =>
                $data['alamat'] ?? null,

            ':alasan' =>
                $data['alasan'] ?? null,

            ':pengalaman' =>
                $data['pengalaman'] ?? null,

            ':status' =>
                $data['status'] ?? 'pending',

            ':catatan' =>
                $data['catatan'] ?? null,

            ':id' =>
                $id
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update Status
    |--------------------------------------------------------------------------
    */

    public function updateStatus($id, $status)
    {
        $allowedStatus = [
            'pending',
            'diterima',
            'ditolak'
        ];


        if (!in_array($status, $allowedStatus, true)) {
            return false;
        }


        $sql = "
            UPDATE {$this->table}
            SET
                status = :status
            WHERE id = :id
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            ':status' => $status,

            ':id' => $id

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus Data
    |--------------------------------------------------------------------------
    */

    public function deleteData($id)
    {
        $sql = "
            DELETE FROM {$this->table}
            WHERE id = :id
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([
            ':id' => $id
        ]);
    }
}