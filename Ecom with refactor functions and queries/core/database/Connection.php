<?php
    class Connection{
        
        public static function  getConnection($config){
            try{
                $pdo = new PDO(
                    "{$config['host']};
                    dbname={$config['dbName']}","{$config['username']}","{$config['password']}"
                );
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            } catch(PDOException $e){
                echo $e->getMessage();
                return NUll;
            }
        }
    }