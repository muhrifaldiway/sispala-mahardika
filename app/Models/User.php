<?php

class User extends Model
{
    protected $table = 'users';


    /*
    |--------------------------------------------------------------------------
    | Ambil Semua User
    |--------------------------------------------------------------------------
    */

    public function getAll($search = '')
    {
        $sql = "
            SELECT
                id,
                nama,
                username,
                role,
                status,
                created_at,
                updated_at
            FROM {$this->table}
        ";

        $params = [];

        if (!empty($search)) {

            $sql .= "
                WHERE
                    nama LIKE :search
                    OR username LIKE :search
                    OR role LIKE :search
            ";

            $params[':search'] = '%' . $search . '%';
        }

        $sql .= "
            ORDER BY id DESC
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll();
    }


    /*
    |--------------------------------------------------------------------------
    | Cari User Berdasarkan ID
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
    | Cari Berdasarkan Username
    |--------------------------------------------------------------------------
    */

    public function findByUsername($username)
    {
        $sql = "
            SELECT *
            FROM {$this->table}
            WHERE username = :username
            LIMIT 1
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':username' => $username
        ]);

        return $stmt->fetch();
    }


    /*
    |--------------------------------------------------------------------------
    | Tambah User
    |--------------------------------------------------------------------------
    */

    public function create($data)
    {
        $sql = "
            INSERT INTO {$this->table}
            (
                nama,
                username,
                password,
                role,
                status
            )
            VALUES
            (
                :nama,
                :username,
                :password,
                :role,
                :status
            )
        ";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nama'     => $data['nama'],
            ':username' => $data['username'],
            ':password' => $data['password'],
            ':role'     => $data['role'],
            ':status'   => $data['status']
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Update User
    |--------------------------------------------------------------------------
    */

    public function update($id, $data)
    {
        $sql = "
            UPDATE {$this->table}
            SET
                nama = :nama,
                username = :username,
                role = :role,
                status = :status
        ";

        $params = [
            ':id'       => $id,
            ':nama'     => $data['nama'],
            ':username' => $data['username'],
            ':role'     => $data['role'],
            ':status'   => $data['status']
        ];


        /*
        |----------------------------------------------------------------------
        | Jika Password Diisi
        |---------------------------------------------------------------------- 
        */

        if (!empty($data['password'])) {

            $sql .= ",
                password = :password
            ";

            $params[':password'] =
                $data['password'];
        }


        $sql .= "
            WHERE id = :id
        ";


        $stmt = $this->db->prepare($sql);

        return $stmt->execute($params);
    }


    /*
    |--------------------------------------------------------------------------
    | Hapus User
    |--------------------------------------------------------------------------
    */

    public function delete($id)
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


    /*
    |--------------------------------------------------------------------------
    | Hitung Semua User
    |--------------------------------------------------------------------------
    */

    public function count()
    {
        $sql = "
            SELECT COUNT(*)
            FROM {$this->table}
        ";

        return (int) $this->db
            ->query($sql)
            ->fetchColumn();
    }


    /*
    |--------------------------------------------------------------------------
    | Hitung Berdasarkan Status
    |--------------------------------------------------------------------------
    */

    public function countByStatus($status)
    {
        $sql = "
            SELECT COUNT(*)
            FROM {$this->table}
            WHERE status = :status
        ";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            ':status' => $status
        ]);

        return (int) $stmt->fetchColumn();
    }


    /*
    |--------------------------------------------------------------------------
    | Cek Username
    |--------------------------------------------------------------------------
    */

    public function usernameExists(
        $username,
        $excludeId = null
    ) {

        $sql = "
            SELECT COUNT(*)
            FROM {$this->table}
            WHERE username = :username
        ";

        $params = [
            ':username' => $username
        ];


        if ($excludeId !== null) {

            $sql .= "
                AND id != :id
            ";

            $params[':id'] = $excludeId;
        }


        $stmt = $this->db->prepare($sql);

        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }
}