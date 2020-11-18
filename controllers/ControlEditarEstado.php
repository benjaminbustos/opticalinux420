<?php

namespace controllers;

require_once("../models/UsuarioModel.php");

use models\UsuarioModel as UsuarioModel;

class ControlEditarEstado{
    public $rut;
    public $nombre;
    public $estado;

    public function __construct(){
        $this->rut = $_POST["rut"];
        $this->nombre = $_POST["nombre"];
        $this->estado = $_POST["estado"];
    }

    public function editar(){
        session_start();
        if ($this->rut == "" || $this->nombre == "") {
            $_SESSION["error_edit"] = "Completa todos los campos";
            header("Location: ../views/gestionUsuario.php");
            return;
        }

        $model = new UsuarioModel();
        $count = $model->editarEstado($this->rut,$this->estado);
        if ($count == 1) {
            $_SESSION["ok_edit"] = "Estado Actualizada";
        } else {
            $_SESSION["error_edit"] = "Error en la BD";
        }
        header("Location: ../views/gestionUsuario.php");
    }
}

$obj = new ControlEditarEstado();
$obj->editar();