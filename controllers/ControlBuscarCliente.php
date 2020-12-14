<?php

namespace controllers;

use models\ClienteModel as ClienteModel;


require_once("../models/ClienteModel.php");

class BuscarCliente{
    public $rut;

    public function __construct(){
        $this->rut = $_POST["rut"];
    }

    public function buscarCliente(){
        session_start();
        if (isset($_SESSION['usuario'])) {
            $modelo = new ClienteModel();
            $arr = $modelo->buscarClienteRut($this->rut); //[[rut=>?,nombre=>?]] []

            if (count($arr) == 1) {
                echo json_encode($arr[0]);
            } else {
                echo json_encode(null);
            }
        } else {
            echo json_encode(['msg' => 'acceso denegado']);
        }
    }
}

$obj = new BuscarCliente();
$obj->buscarCliente();