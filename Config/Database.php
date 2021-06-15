<?php
namespace MyApp\Config;

class Database
{
    private static $bdd = null;

    public static function getBdd()
    {
        if (is_null(self::$bdd)) {

            self::$bdd = new \PDO("mysql:host=localhost;dbname=mvc-aht", 'root', '');
        }
        return self::$bdd;
    }
}
?>