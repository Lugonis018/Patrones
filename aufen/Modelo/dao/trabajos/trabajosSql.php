<?php
class trabajosSql
{
    /*public static function  indentificarUsuario()
    {
        $query="SELECT * FROM trabajos WHERE usuario=? AND clave=?";
        return $query;
    }

    public static function  registrarUsuario()
    {
        $query="INSERT INTO usuario(usuario,clave)VALUES(?,?)";
        return $query;
    }*/

    public static function validateIfExistsTrabajo()
    {
        $query = "SELECT * FROM trabajos WHERE nombre=?";
        return $query;
    }
}
?>
