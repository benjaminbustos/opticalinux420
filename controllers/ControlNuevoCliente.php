<?php

namespace controllers;

require_once("../models/ClienteModel.php");

use models\ClienteModel as ClienteModel;

class ControlNuevoCliente{
    public $rut;
    public $nombre;
    public $direccion;
    public $telefono;
    public $fecha;
    public $email;

    public function __construct(){
        $this->rut = $_POST['rut'];
        $this->nombre = $_POST['nombre'];
        $this->direccion = $_POST['direccion'];
        $this->telefono = $_POST['telefono'];
        $this->fecha = $_POST['fecha'];
        $this->email = $_POST['email'];
    }
    
    public function crearCliente(){
        session_start();
        if($this->rut=="" || $this->nombre=="" || $this->direccion=="" || $this->telefono=="" || $this->fecha=="" || $this->email==""){
            $_SESSION['error']="Complete los campos";
            header("Location:../views/crearCliente.php");
            return;
        }
            $model = new ClienteModel();

            $count = $model->nuevoCliente(
                ['rut'=>$this->rut,'nombre'=>$this->nombre,'direccion'=>$this->direccion,
                'telefono'=>$this->telefono,'fecha'=>$this->fecha,'email'=>$this->email]
            );

            if($count==1){
                $_SESSION['resp']="Cliente agregado correctamente";
            }else{
                $_SESSION['error']="Hubo un error en la base de datos";
            }
            header("Location:../views/crearCliente.php");
        
    }
}

$obj = new ControlNuevoCliente();
$obj->crearCliente();