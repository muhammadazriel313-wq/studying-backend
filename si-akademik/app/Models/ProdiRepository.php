<?php
namespace App\Models;
use PDO;
class ProdiRepository
{
    public function __construct(private PDO $pdo) {}
    public function all(): array { return $this->pdo->query('SELECT * FROM prodi ORDER BY kode')->fetchAll(); }
    public function find(int $id): ?array { $s=$this->pdo->prepare('SELECT * FROM prodi WHERE id=:id'); $s->execute(['id'=>$id]); return $s->fetch() ?: null; }
    public function save(array $d, ?int $id=null): void { $v=['kode'=>trim($d['kode']??''),'nama'=>trim($d['nama']??'')]; if($id){$v['id']=$id;$s=$this->pdo->prepare('UPDATE prodi SET kode=:kode,nama=:nama WHERE id=:id');}else{$s=$this->pdo->prepare('INSERT INTO prodi (kode,nama) VALUES (:kode,:nama)');}$s->execute($v); }
    public function delete(int $id): void { $s=$this->pdo->prepare('DELETE FROM prodi WHERE id=:id');$s->execute(['id'=>$id]); }
}
