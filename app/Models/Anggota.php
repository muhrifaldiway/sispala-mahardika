<?php

class Anggota extends Model
{
    protected $table = 'anggota';

    public function getAll()
    {
        $query = "
            SELECT *
            FROM anggota
            ORDER BY id DESC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $query = "
            SELECT *
            FROM anggota
            WHERE id = :id
            LIMIT 1
        ";

        $stmt = $this->db->prepare($query);

        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $query = "
            INSERT INTO anggota
            (
                nama,
                nis,
                jenis_kelamin,
                kelas,
                angkatan,
                jabatan,
                no_hp,
                alamat,
                foto,
                status
            )
            VALUES
            (
                :nama,
                :nis,
                :jenis_kelamin,
                :kelas,
                :angkatan,
                :jabatan,
                :no_hp,
                :alamat,
                :foto,
                :status
            )
        ";

        $stmt = $this->db->prepare($query);

        return $stmt->execute($data);
    }

    public function update($id, $data)
    {
        $query = "
            UPDATE anggota SET

                nama = :nama,
                nis = :nis,
                jenis_kelamin = :jenis_kelamin,
                kelas = :kelas,
                angkatan = :angkatan,
                jabatan = :jabatan,
                no_hp = :no_hp,
                alamat = :alamat,
                foto = :foto,
                status = :status

            WHERE id = :id
        ";

        $data['id'] = $id;

        $stmt = $this->db->prepare($query);

        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $query = "
            DELETE FROM anggota
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($query);

        return $stmt->execute([
            'id' => $id
        ]);
    }

    public function count()
    {
        $query = "
            SELECT COUNT(*) AS total
            FROM anggota
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }
}