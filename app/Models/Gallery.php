<?php

class Gallery extends Model
{
    protected $table = 'gallery';


    /*
    |--------------------------------------------------------------------------
    | Ambil semua gallery
    |--------------------------------------------------------------------------
    */

    public function getAll($keyword = '', $kategori = '')
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE 1=1
        ";

        $params = [];

        if ($keyword !== '') {

            $sql .= "
                AND (
                    judul LIKE :keyword
                    OR deskripsi LIKE :keyword
                )
            ";

            $params[':keyword'] = '%' . $keyword . '%';
        }

        if ($kategori !== '') {

            $sql .= "
                AND kategori = :kategori
            ";

            $params[':kategori'] = $kategori;
        }

        $sql .= "
            ORDER BY id DESC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getCategories()
    {
        $sql = "
            SELECT DISTINCT kategori
            FROM {$this->table}
            WHERE kategori IS NOT NULL
            AND kategori != ''
            ORDER BY kategori ASC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function all()
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            ORDER BY created_at DESC
        ";

        return $this->db->query($sql)->fetchAll(
            PDO::FETCH_ASSOC
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Ambil gallery berdasarkan ID
    |--------------------------------------------------------------------------
    */

    public function find($id)
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE id = ?
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(
            PDO::FETCH_ASSOC
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Simpan gallery
    |--------------------------------------------------------------------------
    */

    public function create($data)
    {
        $sql = "
            INSERT INTO {$this->table}
            (
                judul,
                deskripsi,
                foto,
                status
            )
            VALUES
            (
                ?,
                ?,
                ?,
                ?
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['judul'],
            $data['deskripsi'],
            $data['foto'],
            $data['status']
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update gallery
    |--------------------------------------------------------------------------
    */

    public function update($id, $data)
    {
        $sql = "
            UPDATE {$this->table}
            SET
                judul = ?,
                deskripsi = ?,
                status = ?
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['judul'],
            $data['deskripsi'],
            $data['status'],
            $id
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update gallery + foto
    |--------------------------------------------------------------------------
    */

    public function updateWithPhoto($id, $data)
    {
        $sql = "
            UPDATE {$this->table}
            SET
                judul = ?,
                deskripsi = ?,
                foto = ?,
                status = ?
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            $data['judul'],
            $data['deskripsi'],
            $data['foto'],
            $data['status'],
            $id
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus gallery
    |--------------------------------------------------------------------------
    */

    public function delete($id)
    {
        $sql = "
            DELETE FROM {$this->table}
            WHERE id = ?
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$id]);
    }
}