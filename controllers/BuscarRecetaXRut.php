<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

require_once("../models/RecetaModel.php");

class BuscarRecetaXRut{
    public $rut;

    public function __construct(){
        $this->rut = $_POST['rut'];
    }

    public function recetas(){
        session_start();
        if (isset($_SESSION['usuario'])) {
            $modelo = new RecetaModel();
            $arr = $modelo->recetasXRut($this->rut);
            echo json_encode($arr);
        } else {
            echo json_encode(["msg" => "Acceso Denegado"]);
        }
    }
}

$obj = new BuscarRecetaXRut();
$obj->recetas();