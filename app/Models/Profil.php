<?php

class Profil extends Model
{
    /*
    |--------------------------------------------------------------------------
    | Ambil Profil Organisasi
    |--------------------------------------------------------------------------
    */

    public function getProfil()
    {
        $sql = "
            SELECT *
            FROM profil_organisasi
            ORDER BY id ASC
            LIMIT 1
        ";

        $stmt = $this->db->query($sql);

        return $stmt->fetch();
    }


    /*
    |--------------------------------------------------------------------------
    | Update Profil
    |--------------------------------------------------------------------------
    */

    public function updateProfil(
        $id,
        $data
    ) {

        $sql = "
            UPDATE profil_organisasi
            SET

                nama_organisasi = :nama_organisasi,

                singkatan = :singkatan,

                sejarah = :sejarah,

                visi = :visi,

                misi = :misi,

                alamat = :alamat,

                email = :email,

                no_hp = :no_hp,

                instagram = :instagram,

                facebook = :facebook,

                youtube = :youtube,

                periode_kepengurusan = :periode_kepengurusan

            WHERE id = :id
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            ':nama_organisasi' =>
                $data['nama_organisasi'],

            ':singkatan' =>
                $data['singkatan'],

            ':sejarah' =>
                $data['sejarah'],

            ':visi' =>
                $data['visi'],

            ':misi' =>
                $data['misi'],

            ':alamat' =>
                $data['alamat'],

            ':email' =>
                $data['email'],

            ':no_hp' =>
                $data['no_hp'],

            ':instagram' =>
                $data['instagram'],

            ':facebook' =>
                $data['facebook'],

            ':youtube' =>
                $data['youtube'],

            ':periode_kepengurusan' =>
                $data['periode_kepengurusan'],

            ':id' =>
                $id

        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update Logo
    |--------------------------------------------------------------------------
    */

    public function updateLogo(
        $id,
        $logo
    ) {

        $sql = "
            UPDATE profil_organisasi
            SET logo = :logo
            WHERE id = :id
        ";


        $stmt = $this->db->prepare($sql);


        return $stmt->execute([

            ':logo' =>
                $logo,

            ':id' =>
                $id

        ]);
    }
}