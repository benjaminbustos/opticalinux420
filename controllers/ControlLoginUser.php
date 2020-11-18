<?php

namespace controllers;

require_once("../models/UsuarioModel.php");

use models\UsuarioModel as UsuarioModel;

class ControlLoginUser{
    public $rut;
    public $clave;

    public function __construct(){
        $this->rut = $_POST['rut'];
        $this->clave = $_POST['clave'];
    }
    
    public function iniciarSesion(){
        session_start();
        if($this->rut=="" || $this->clave==""){
            $_SESSION['error']="Complete los campos";
            header("Location:../index.php");
            return;
        }
        $modelo = new UsuarioModel();
        $array = $modelo->iniciarSesionUser($this->rut,$this->clave);
        if(count($array)==0){
            $_SESSION['error']="Datos incorrectos, intente nuevamente";
            header("Location:../index.php");
            return;
        }
        $_SESSION['usuario']=$array[0];
        header("Location:../views/crearCliente.php");
    }
}
$obj = new ControlLoginUser();
$obj->iniciarSesion();