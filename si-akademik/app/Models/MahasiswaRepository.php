<?php
namespace App\Models;
use App\Core\Database;
use PDO;

class MahasiswaRepository
{
    private PDO $pdo;
    public function __construct(Database $database) { $this->pdo = $database->getConnection(); }
    public function all(string $keyword = ''): array {
        $sql = 'SELECT m.*, p.nama AS prodi_nama FROM mahasiswa m JOIN prodi p ON p.id = m.prodi_id';
        if ($keyword !== '') { $sql .= ' WHERE m.nama LIKE :kw_nama OR m.nim LIKE :kw_nim'; }
        $stmt = $this->pdo->prepare($sql . ' ORDER BY m.nim');
        $stmt->execute($keyword === '' ? [] : ['kw_nama' => '%' . $keyword . '%', 'kw_nim' => '%' . $keyword . '%']);
        return $stmt->fetchAll();
    }
    public function find(int $id): ?array { $s=$this->pdo->prepare('SELECT * FROM mahasiswa WHERE id=:id'); $s->execute(['id'=>$id]); return $s->fetch() ?: null; }
    public function prodiOptions(): array { return $this->pdo->query('SELECT id, nama FROM prodi ORDER BY nama')->fetchAll(); }
    public function create(Mahasiswa $m): void { $s=$this->pdo->prepare('INSERT INTO mahasiswa (nim,nama,email,prodi_id,angkatan,status) VALUES (:nim,:nama,:email,:prodi_id,:angkatan,:status)'); $s->execute($this->values($m)); }
    public function update(Mahasiswa $m): void { $v=$this->values($m); $v['id']=$m->getId(); $s=$this->pdo->prepare('UPDATE mahasiswa SET nim=:nim,nama=:nama,email=:email,prodi_id=:prodi_id,angkatan=:angkatan,status=:status WHERE id=:id'); $s->execute($v); }
    public function delete(int $id): void { $s=$this->pdo->prepare('DELETE FROM mahasiswa WHERE id=:id'); $s->execute(['id'=>$id]); }
    private function values(Mahasiswa $m): array { return ['nim'=>$m->getNim(),'nama'=>$m->getNama(),'email'=>$m->getEmail(),'prodi_id'=>$m->getProdiId(),'angkatan'=>$m->getAngkatan(),'status'=>$m->getStatus()]; }
}
