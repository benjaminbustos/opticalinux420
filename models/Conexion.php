<?php
    namespace models;

class Conexion{
    /*
    public static $user="root";
    public static $pass="";
    public static $URL="mysql:host=localhost;dbname=optica_2020";
    */
    
    public static $user="unzdzskbuhowwfza";
    public static $pass="06b7QY15Ngz4iJflWP4I";
    public static $URL="mysql:host=bhk6hr0a52u3xsopajvx-mysql.services.clever-cloud.com;dbname=bhk6hr0a52u3xsopajvx";
    
    public static function conector(){
        try{
            return new \PDO(Conexion::$URL, Conexion::$user, Conexion::$pass);
        }catch(\PDOException $e){
            return null;
        }
    }
}