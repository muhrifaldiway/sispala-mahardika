<?php

class Berita extends Model
{
    protected $table = 'berita';

    /*
    |--------------------------------------------------------------------------
    | Ambil semua berita
    |--------------------------------------------------------------------------
    */

    public function getAll(
        $keyword = '',
        $limit = 9,
        $offset = 0
    ) {

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
                    OR isi LIKE :keyword
                    OR kategori LIKE :keyword
                )
            ";

            $params[':keyword'] =
                '%' . $keyword . '%';
        }

        $sql .= "
            ORDER BY id DESC
            LIMIT :limit
            OFFSET :offset
        ";

        $stmt = $this->db->prepare($sql);

        if ($keyword !== '') {

            $stmt->bindValue(
                ':keyword',
                '%' . $keyword . '%',
                PDO::PARAM_STR
            );
        }

        $stmt->bindValue(
            ':limit',
            (int) $limit,
            PDO::PARAM_INT
        );

        $stmt->bindValue(
            ':offset',
            (int) $offset,
            PDO::PARAM_INT
        );

        $stmt->execute();

        return $stmt->fetchAll();
    }


    public function count($keyword = '')
    {
        $sql = "
            SELECT COUNT(*) AS total
            FROM {$this->table}
            WHERE 1=1
        ";

        $params = [];

        if ($keyword !== '') {

            $sql .= "
                AND (
                    judul LIKE :keyword
                    OR isi LIKE :keyword
                    OR kategori LIKE :keyword
                )
            ";

            $params[':keyword'] =
                '%' . $keyword . '%';
        }

        $stmt = $this->db->prepare($sql);

        $stmt->execute($params);

        return (int) $stmt->fetch()['total'];
    }


    public function findBySlug($slug)
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE slug = :slug
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':slug' => $slug
        ]);

        return $stmt->fetch();
    }


    public function latest($limit = 3)
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            ORDER BY id DESC
            LIMIT :limit
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->bindValue(
            ':limit',
            (int) $limit,
            PDO::PARAM_INT
        );

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
    | Ambil berita berdasarkan ID
    |--------------------------------------------------------------------------
    */
    public function find($id)
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan berita
    |--------------------------------------------------------------------------
    */
    public function create($data)
    {
        $sql = "
            INSERT INTO {$this->table} (judul, slug, ringkasan, isi, gambar, kategori, status, tanggal_publish, created_at, updated_at)
            VALUES (:judul, :slug, :ringkasan, :isi, :gambar, :kategori, :status, :tanggal_publish, NOW(), NOW())
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':judul', $data['judul']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':ringkasan', $data['ringkasan']);
        $stmt->bindParam(':isi', $data['isi']);
        $stmt->bindParam(':gambar', $data['gambar']);
        $stmt->bindParam(':kategori', $data['kategori']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':tanggal_publish', $data['tanggal_publish']);

        return $stmt->execute();
    }

    /*
    |--------------------------------------------------------------------------
    | Update berita
    |--------------------------------------------------------------------------
    */
    public function update($id, $data)
    {
        $sql = "
            UPDATE {$this->table}
            SET judul = :judul,
                slug = :slug,
                ringkasan = :ringkasan,
                isi = :isi,
                gambar = :gambar,
                kategori = :kategori,
                status = :status,
                tanggal_publish = :tanggal_publish,
                updated_at = NOW()
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':judul', $data['judul']);
        $stmt->bindParam(':slug', $data['slug']);
        $stmt->bindParam(':ringkasan', $data['ringkasan']);
        $stmt->bindParam(':isi', $data['isi']);
        $stmt->bindParam(':gambar', $data['gambar']);
        $stmt->bindParam(':kategori', $data['kategori']);
        $stmt->bindParam(':status', $data['status']);
        $stmt->bindParam(':tanggal_publish', $data['tanggal_publish']);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    /*
    |--------------------------------------------------------------------------
    | Hapus berita
    |--------------------------------------------------------------------------
    */ 
    public function delete($id)
    {
        $sql = "
            DELETE FROM {$this->table}
            WHERE id = :id
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
}