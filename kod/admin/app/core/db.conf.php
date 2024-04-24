<?php

class Database {
    
    protected $host   = Settings::DB['host'];
    protected $dbname = Settings::DB['dbname'];
    protected $user   = Settings::DB['user'];
    protected $pass   = Settings::DB['pass'];

    public function StartUp() {
            try{
                $pdo = new PDO(
                    "mysql:host=$this->host;dbname=$this->dbname", 
                    $this->user, 
                    $this->pass
                );
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
                return $pdo;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
}
