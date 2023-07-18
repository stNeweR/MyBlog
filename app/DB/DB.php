<?php

namespace App\DB;

use PDO;

class DB
{
    private object $db;

    public function __construct(){
        $dbinfo  = include_once 'dbinfo.php';
        try {
            $this->db = new PDO("mysql:host=$dbinfo[host];dbname=$dbinfo[dbname]", $dbinfo['root'], $dbinfo['password']);
        } catch (\PDOException $exception) {
            var_dump($exception->getMessage());
        }
    }

    public function query($sql, $params = []){
        $stmt = $this->db->prepare($sql);

        if (isset($params)){
            foreach ($params as $param => $value) {
                $stmt->bindValue(":$param", $value);
//                var_dump($param);
//                var_dump($value);
            }
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll($table, $sql = '', $params = []){
        return $this->query("SELECT * FROM $table" . $sql, $params);
    }
}