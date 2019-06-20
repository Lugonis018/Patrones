<?php

class ConexionBD {

    private static $host = "localhost";
    private static $user = "root";
    private static $pwd = "";
    private static $bd = "mydb";

    public static function conectar() {
        return mysqli_connect(ConexionBD::$host, conexionBD::$user, conexionBD::$pwd, conexionBD::$bd);
    }
}