<?php

class MahasiswaModel
{
    public function __construct(private PDO $db)
    {
    }

    public function all(string $search = ''): array
    {
        $sql = 'SELECT mahasiswa.*, prodi.nama AS nama_prodi 
                FROM mahasiswa 
                LEFT JOIN prodi ON mahasiswa.prodi_id = prodi.id';
        
        $params = [];
        
        if ($search !== '') {
            $sql .= ' WHERE mahasiswa.nim LIKE :search 
                         OR mahasiswa.nama LIKE :search 
                         OR prodi.nama LIKE :search';
            $params['search'] = '%' . $search . '%';
        }
        
        $sql .= ' ORDER BY mahasiswa.nim ASC';
        
        $statement = $this->db->prepare($sql);
        $statement->execute($params);
        return $statement->fetchAll();
    }

    public function find(int $id): ?array
    {
        $statement = $this->db->prepare('SELECT * FROM mahasiswa WHERE id = :id');
        $statement->execute(['id' => $id]);
        return $statement->fetch() ?: null;
    }

    public function save(array $data, ?int $id = null): void
    {

        $params = [
            'nim' => $data['nim'], 
            'nama' => $data['nama'], 
            'email' => $data['email'],
            'prodi_id' => $data['prodi'], 
            'angkatan' => $data['angkatan'], 
            'status' => $data['status'],
        ];

        if ($id === null) {
            $sql = 'INSERT INTO mahasiswa (nim, nama, email, prodi_id, angkatan, status)
                    VALUES (:nim, :nama, :email, :prodi_id, :angkatan, :status)';
        } else {
            $params['id'] = $id;
            $sql = 'UPDATE mahasiswa SET nim=:nim, nama=:nama, email=:email, prodi_id=:prodi_id,
                    angkatan=:angkatan, status=:status WHERE id=:id';
        }

        $this->db->prepare($sql)->execute($params);
    }

    public function delete(int $id): void
    {
        $this->db->prepare('DELETE FROM mahasiswa WHERE id = :id')->execute(['id' => $id]);
    }
}
