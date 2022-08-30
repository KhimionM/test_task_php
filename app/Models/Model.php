<?php 
namespace App\Models;
use App\DB;

class Model extends DB
{
    protected $fillable;
    protected $tablename;

    public function __construct(){
        parent::__construct(DB_NAME, DB_USER, DB_PASS, DB_HOST);
    }

    public function all() {
        return $this->run("SELECT * FROM $this->tablename")->fetchAll();
    }

    public function find(int $id) {
        return $this->run("SELECT * FROM $this->tablename WHERE id = ? ", [$id])->fetch();
    }
    public function deleteAll() {
        return $this->run("DELETE FROM $this->tablename")->fetch();
    }
    public function update(int $id, $data) {
        $sql = "UPDATE $this->tablename SET ";
        $i = 0;
        foreach($data as $key => $value) {
            if ($i > 0) {
                $sql .= ", ". $key . " = ? ";            
            } else {
                $sql .= " " . $key . " = ? ";            
            }
            $i++;
        }
        $sql .= "WHERE id = ? ";
        return $this->run($sql, array_merge(array_values($data), [$id]))->fetch();
    }

    public function create($data) {
        $sql = "INSERT INTO $this->tablename SET ";
        $i = 0;
        foreach($data as $key => $value) {
            if ($i > 0) {
                $sql .= ", ". $key . " = ? ";            
            } else {
                $sql .= " " . $key . " = ? ";            
            }
            $i++;
        }

        return $this->run($sql, array_values($data))->fetch();
    }
}
