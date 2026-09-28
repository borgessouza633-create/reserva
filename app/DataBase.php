<?php
namespace App;
use PDO;
use PDOExecption;
class DataBase{
    const HOST = 'localhost';
    const USER = 'root';
    const PASS = '';
    const DB = 'reserva';
    private $connection;
    private $table;

    public function __construct($table = null){
        $this->table = $table;
       $this->setConnection();
    }
    
    private function setConnection(){
        try{
            $this->connection = new PDO('mysql:host=' . self::HOST . ';dbname=' . self::DB . ';charset=utf8mb4',self::USER,self::PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }        
    }
    public function execute($query, $values = null){
        try{echo "<pre>";
          print_r($query);
          echo "<pre>";
            $statement = $this->connection->prepare($query);
            $statement->execute($values);
            return $statement;
        }catch(PDOException $e){
            die('ERROR: '.$e->getMessage());
        }
    }

    public function insert($array){
          $fields = array_keys($array);
          $blinds = array_pad([], count($array), '?');
          $query = "INSERT INTO ".$this->table." (".implode(',', $fields).") VALUES (".implode(',', $blinds).")";
          $this->execute($query,array_values($array));
          return $this->connection->lastInsertId();
          
    }
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        $query = "SELECT * FROM ".$this->table;
        $where = strlen($where) ? " WHERE ".$where : '';
        $order = strlen($order) ? " ORDER BY ".$order : '';
        $limit = strlen($limit) ? " LIMIT ".$limit : '';

        $query = "SELECT ".$fields." FROM ".$this->table.$where.$order.$limit;
        return $this->execute($query);
    }
     
    public function update($where, $array){
        $fields = array_keys($array);
        
        $query = "UPDATE ". $this->table." SET " .implode('=?,',$fields). '=? WHERE' .$where;
        $this->execute($query,array_values($array));
        return true;
    }
    public function delete($where){
        $query = "DELETE FROM ".$this->table." WHERE ".$where;
        $this->execute($query);
        return true;
    }


}