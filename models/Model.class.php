<?php

abstract class Model{

    private static $pdo;

    private static function setDb(){
        self::$pdo = new PDO("mysql:host=localhost;dbname=biblio;charset=utf8", "root", "");
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getDb(){
        if(self::$pdo === null){
            self::setDb();
        }
        return self::$pdo;
    }

}