<?php
include "../bd/conexion.php";
/* */

class Url extends Conexion{
    public function insertarUrlCorta($url_larga,$url_hash,$url_corta,$expiracion){
        $sql= $this->conexion->prepare(
            "INSERT INTO url (url_larga, url_hash, url_corta) VALUES (?,?,?,?)");
        return $sql->execute([$url_larga, $url_hash,$url_corta,$expiracion]);

    }
}