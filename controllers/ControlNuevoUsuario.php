<?php

namespace controllers;

require_once("../models/UsuarioModel.php");

use models\UsuarioModel as UsuarioModel;

class ControlNuevoUsuario{
    public $rut;
    public $nombre;

    public function __construct() {
        $this->rut = $_POST["rut"];
        $this->nombre = $_POST["nombre"];
    }
    
    public function guardarUsuario(){
        session_start();
        if ($this->rut=="" || $this->nombre=="") {
            $_SESSION["error"] = "campos vacios";
            header("Location: ../views/gestionUsuario.php");
            return;
        }

        $model = new UsuarioModel();  // generar la importacion , q es donde necesitamos
                                    // enviar los datos del formulario para q se inserten
            
        $count = $model->nuevoUsuario(    //generar un arreglo asociativo con los datos obtenidos en el constructor
            ["rut"=>$this->rut,"nombre"=>$this->nombre]
        );
        if ($count == 1) {
            $_SESSION["respuesta"] = "Usuario Creado con exito";
        }else{
            $_SESSION["error"] = "Hubo un error a nivel de BD";
        }
        header("Location: ../views/gestionUsuario.php");
    
    }

}

$obj = new ControlNuevoUsuario();
$obj->guardarUsuario();