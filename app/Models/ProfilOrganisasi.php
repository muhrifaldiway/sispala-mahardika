<?php

class ProfilOrganisasi extends Model
{
    protected $table = 'profil_organisasi';

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
}