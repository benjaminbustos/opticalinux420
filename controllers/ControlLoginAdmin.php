<?php

namespace controllers;

require_once("../models/UsuarioModel.php");

use models\UsuarioModel as UsuarioModel;

class ControlLoginAdmin{
    public $rut;
    public $clave;

    public function __construct(){
        $this->rut = $_POST['rut'];
        $this->clave = $_POST['clave'];
    }

    public function iniciarSesionAdmin(){
        session_start();
        if($this->rut=="" || $this->clave==""){
            $_SESSION['error']="Complete los campos";
            header("Location:../admin.php");
            return;
        }
        $modelo = new UsuarioModel();
        $arreglo = $modelo->iniciarSesionAdmin($this->rut,$this->clave);

        if(count($arreglo)==0){
            $_SESSION['error']="Datos incorrectos, intente nuevamente";
            header("Location:../admin.php");
            return;
        }
        $_SESSION['admin']=$arreglo[0];
        header("Location:../views/gestionUsuario.php");
    }
}
$obj = new ControlLoginAdmin();
$obj->iniciarSesionAdmin();