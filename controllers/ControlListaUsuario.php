<?php

namespace controllers;

require_once("../models/UsuarioModel.php");

use models\UsuarioModel as UsuarioModel;

class ControlListaUsuario{
    public $bt_edit;
    public $bt_delete;

    public function __construct(){
        $this->bt_edit = $_POST["bt_edit"];
        $this->bt_delete = $_POST["bt_delete"];
    }

    public function procesar(){
        if (isset($this->bt_edit)) {
            session_start();
            $_SESSION["editar"] = "ON";
            $model = new UsuarioModel();
            $usuario = $model->buscarUsuario($this->bt_edit);
            $_SESSION["lista"] = $usuario[0]; 
            header("Location: ../views/gestionUsuario.php");
        } else {
            //echo "eliminar el rut $this->bt_delete";
            $modelo = new UsuarioModel();
            $modelo->eliminarUsuario($this->bt_delete);
            header("Location: ../views/gestionUsuario.php");
        }
    }        
}
$obj = new ControlListaUsuario();
$obj->procesar();