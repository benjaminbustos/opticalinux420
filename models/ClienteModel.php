<?php

namespace models;

require_once("Conexion.php");

class ClienteModel{
    //metodo insertar un cliente
    public function nuevoCliente($data){
        $stm = Conexion::conector()->prepare("INSERT INTO cliente VALUES(:A,:B,:C,:D,:E,:F)");
        $stm->bindParam(":A",$data['rut']);
        $stm->bindParam(":B",$data['nombre']);
        $stm->bindParam(":C",$data['direccion']);
        $stm->bindParam(":D",$data['telefono']);
        $stm->bindParam(":E",$data['fecha']);
        $stm->bindParam(":F",$data['email']);
        return $stm->execute();
    }
}