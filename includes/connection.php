<?php
class ConnectionHelper{
    private static $connection;

    public static function getConnection(){
        if(self::$connection==null){
            self::$connection=new PDO('mysql:host=localhost;dbname=dbbloodbank', 'root','');
        }
        return self::$connection;
    }
}
?>