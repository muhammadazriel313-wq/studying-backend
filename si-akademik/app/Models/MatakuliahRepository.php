<?php
namespace App\Models;
use PDO;
class MatakuliahRepository
{
    public function __construct(private PDO $pdo) {}
    public function all(): array { return $this->pdo->query('SELECT mk.*,p.nama AS prodi_nama FROM matakuliah mk JOIN prodi p ON p.id=mk.prodi_id ORDER BY mk.kode')->fetchAll(); }
    public function find(int $id): ?array { $s=$this->pdo->prepare('SELECT * FROM matakuliah WHERE id=:id');$s->execute(['id'=>$id]);return $s->fetch() ?: null; }
    public function save(array $d, ?int $id=null): void { $v=['kode'=>trim($d['kode']??''),'nama'=>trim($d['nama']??''),'sks'=>(int)($d['sks']??0),'prodi_id'=>(int)($d['prodi_id']??0)];if($id){$v['id']=$id;$s=$this->pdo->prepare('UPDATE matakuliah SET kode=:kode,nama=:nama,sks=:sks,prodi_id=:prodi_id WHERE id=:id');}else{$s=$this->pdo->prepare('INSERT INTO matakuliah (kode,nama,sks,prodi_id) VALUES (:kode,:nama,:sks,:prodi_id)');}$s->execute($v); }
    public function delete(int $id): void {$s=$this->pdo->prepare('DELETE FROM matakuliah WHERE id=:id');$s->execute(['id'=>$id]);}
}
