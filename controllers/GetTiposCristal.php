<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

require_once("../models/RecetaModel.php");

class GetTipoCristal{

    public function getMateriales(){
        session_start();
        if (isset($_SESSION['usuario'])) {
            $modelo = new RecetaModel();
            $arr = $modelo->getTiposCristal();
            echo json_encode($arr);
        } else {
            echo json_encode(["msg" => "Acceso denegado"]);
        }
    }
}
$obj = new GetTipoCristal();
$obj->getMateriales();