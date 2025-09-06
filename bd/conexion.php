<?php
class Conexion {
    protected $conexion;

    public function __construct() {
        $host = 'localhost';
        $db   = 'urls';
        $user = 'root';
        $password = '100408ovc';

        try {
            $this->conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $password);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
