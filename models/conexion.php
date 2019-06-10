<?php

class Conexion
{

    public function conectar()
    {
        $config = parse_ini_file("../resources/config.ini", true);

        $host = $config['connection']['host'];
        $usuario = $config['connection']['user'];
        $password = $config['connection']['password'];
        $bd = $config['connection']['database'];
        $port = $config['connection']['port'];

        $conexion = new mysqli($host, $usuario, $password, $bd, $port);
        if ($conexion->connect_error) {
            return die("Ha tenido un error de conexion");
        }
        return $conexion;
    }
}
