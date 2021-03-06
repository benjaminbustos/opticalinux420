<?php

namespace controllers;

use models\RecetaModel as RecetaModel;

require_once("../models/RecetaModel.php");

class GetArmazones{

    public function getMateriales(){
        session_start();
        if (isset($_SESSION['usuario'])) {
            $modelo = new RecetaModel();
            $arr = $modelo->getArmazones();
            echo json_encode($arr);
        } else {
            echo json_encode(["msg" => "Acceso denegado"]);
        }
    }
}
$obj = new GetArmazones();
$obj->getMateriales();