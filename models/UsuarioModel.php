<?php

namespace models;

require_once("Conexion.php");

class UsuarioModel{
    public function nuevoUsuario($data){
        $stm = Conexion::conector()->prepare("INSERT INTO usuario VALUES(:A,:B,'vendedor',md5(123456),1)");
        $stm->bindParam(":A",$data['rut']);
        $stm->bindParam(":B",$data['nombre']);
        return $stm->execute();
    }
    
    public function iniciarSesionUser($rut,$clave){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rut=:A AND clave=:B AND estado=1");
        $stm->bindParam(":A",$rut);
        $stm->bindParam(":B",md5($clave));
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function iniciarSesionAdmin($rut,$clave){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rut=:A AND clave=:B AND rol='administrador'");
        $stm->bindParam(":A",$rut);
        $stm->bindParam(":B",md5($clave));
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllUser(){  
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rol='vendedor'");
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function buscarUsuario($rut){
        $stm = Conexion::conector()->prepare("SELECT * FROM usuario WHERE rut=:A");
        $stm->bindParam(":A",$rut); 
        $stm->execute();
        return $stm->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function eliminarUsuario($rut){
        $stm = Conexion::conector()->prepare("DELETE FROM usuario WHERE rut=:A");
        $stm->bindParam(":A",$rut); 
        return $stm->execute();
    }

    public function editarEstado($rut,$estado){
        $stm = Conexion::conector()->prepare("UPDATE usuario SET estado=:A WHERE rut=:B ");
        $stm->bindParam(":A", $estado);
        $stm->bindParam(":B", $rut);
        return $stm->execute();
    }
}
?>