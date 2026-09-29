<?php

class Pengaturan extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Nama Tabel
    |--------------------------------------------------------------------------
    */

    protected $table = 'pengaturan';


    /*
    |--------------------------------------------------------------------------
    | Ambil Pengaturan
    |--------------------------------------------------------------------------
    */

    public function get()
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            ORDER BY id ASC
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetch();
    }


    /*
    |--------------------------------------------------------------------------
    | Update Pengaturan
    |--------------------------------------------------------------------------
    */

    public function updateData($data)
    {
        $sql = "
            UPDATE {$this->table}
            SET
                nama_website = :nama_website,
                deskripsi = :deskripsi,
                email = :email,
                no_hp = :no_hp,
                alamat = :alamat,
                instagram = :instagram,
                facebook = :facebook,
                youtube = :youtube,
                footer_text = :footer_text
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nama_website' => $data['nama_website'],
            ':deskripsi'    => $data['deskripsi'],
            ':email'        => $data['email'],
            ':no_hp'        => $data['no_hp'],
            ':alamat'       => $data['alamat'],
            ':instagram'    => $data['instagram'],
            ':facebook'     => $data['facebook'],
            ':youtube'      => $data['youtube'],
            ':footer_text'  => $data['footer_text'],
            ':id'           => $data['id']
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update Logo
    |--------------------------------------------------------------------------
    */

    public function updateLogo($id, $logo)
    {
        $sql = "
            UPDATE {$this->table}
            SET logo = :logo
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':logo' => $logo,
            ':id'   => $id
        ]);
    }
}