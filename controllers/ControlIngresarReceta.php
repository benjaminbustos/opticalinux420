<?php

namespace controllers;

require_once("../models/RecetaModel.php");

use models\RecetaModel as RecetaModel;

class ControlIngresarReceta{

    public $tipo_lente;
    public $esfera_oi;
    public $esfera_od;
    public $cilindro_oi;
    public $cilindro_od;
    public $eje_oi;
    public $eje_od;
    public $prisma;
    public $base;
    public $armazon;
    public $material_cristal;
    public $tipo_cristal;
    public $distancia_pupilar;
    public $valor_lente;
    public $fecha_entrega;
    public $fecha_retiro;
    public $observacion;
    public $rut_cliente;
    public $fecha_visita_medico;
    public $rut_medico;
    public $nombre_medico;
    public $rut_usuario;

    public function __construct(){
        $this->tipo_lente           = $_POST['tipo_lente'];
        $this->esfera_oi            = $_POST['esfera_oi'];
        $this->esfera_od            = $_POST['esfera_od'];
        $this->cilindro_oi          = $_POST['cilindro_oi'];
        $this->cilindro_od          = $_POST['cilindro_od'];
        $this->eje_oi               = $_POST['eje_oi'];
        $this->eje_od               = $_POST['eje_od'];
        $this->prisma               = $_POST['prisma'];
        $this->base                 = $_POST['base'];
        $this->armazon              = $_POST['armazon'];
        $this->material_cristal     = $_POST['material_cristal'];
        $this->tipo_cristal         = $_POST['tipo_cristal'];
        $this->distancia_pupilar    = $_POST['distancia_pupilar'];
        $this->valor_lente          = $_POST['valor_lente'];
        $this->fecha_entrega        = $_POST['fecha_entrega'];
        $this->fecha_retiro         = $_POST['fecha_retiro'];
        $this->observacion          = $_POST['observacion'];
        $this->rut_cliente          = $_POST['rut_cliente'];
        $this->rut_medico           = $_POST['rut_medico'];
        $this->nombre_medico        = $_POST['nombre_medico'];
    }

    public function ingresarReceta(){
        session_start();
        if (isset($_SESSION['usuario'])) {
            $usr = $_SESSION['usuario'];
            $this->rut_usuario = $usr['rut'];
            $this->fecha_visita_medico = date("Y/m/d");
            $model = new RecetaModel();
            $data =["tipolente"=>$this->tipo_lente,
                    "esferaoiz"=>$this->esfera_oi,
                    "esferaode"=>$this->esfera_od,
                    "cilindrooiz"=>$this->cilindro_oi,
                    "cilindroode"=>$this->cilindro_od,
                    "ejeoiz"=>$this->eje_oi,
                    "ejeode"=>$this->eje_od,
                    "prisma"=>$this->prisma,
                    "base"=>$this->base,
                    "armazon"=>$this->armazon,
                    "materialcristal"=>$this->material_cristal,
                    "tipocristal"=>$this->tipo_cristal,
                    "distanciapupilar"=>$this->distancia_pupilar,
                    "valorlente"=>$this->valor_lente,
                    "fechaentrega"=>$this->fecha_entrega,
                    "fecharetiro"=>$this->fecha_retiro,
                    "observacion"=>$this->observacion,
                    "rutcliente"=>$this->rut_cliente,
                    "fechavimed"=>$this->fecha_visita_medico,
                    "rutmedico"=>$this->rut_medico,
                    "nombremedico"=>$this->nombre_medico,
                    "rutusuario"=>$this->rut_usuario];

            if ($this->rut_cliente == ""){
                echo json_encode(["msg"=>"ingrese un rut valido"]);
                return;
            }
            
            if ($this->tipo_lente == "" || $this->tipo_cristal == "" || $this->material_cristal == "" || $this->armazon == "" || $this->distancia_pupilar == "" 
                || $this->esfera_oi == "" || $this->esfera_od == "" || $this->cilindro_oi == "" || $this->cilindro_od == "" || $this->eje_oi == ""
                || $this->eje_od == "" || $this->rut_medico == "" || $this->nombre_medico == "" || $this->fecha_entrega =="" || $this->fecha_retiro == "" || $this->valor_lente == "") {
                    echo json_encode(["msg"=>"complete los campos obligatorios"]);
            
            } else {
                if ($this->prisma != "") {
                    if (is_numeric($this->prisma)) {
                        if ($this->prisma < 1 || $this->prisma > 5 ) {
                            $mensaje["msg2"] = "error... El valor del prisma debe estar entre 1 y 5";   
                        }
                    } else {                
                        $mensaje["msg2"] = "error... El valor del prisma debe ser numerico";
                    }
                } else {
                    $this->base = "";
                }
                        
                if (is_numeric($this->distancia_pupilar)) {
                    if ($this->distancia_pupilar < 40 || $this->distancia_pupilar > 75){
                        $mensaje["msg3"] ="error... La distancia pupilar debe estar entre 40 y 75";
                    }
                } else {
                    $mensaje["msg3"] ="error... La distancia pupilar debe ser numerica";
                }
            
                if (is_numeric($this->esfera_oi)) {
                    if ($this->esfera_oi < -99 || $this->esfera_oi > 99){
                        array_push($mensaje, "msg4", "error... La dificultad visual de la Esfera Izquierda debe estar entre -99 y +99");
                    }
                } else {
                    $mensaje["msg4"] ="error... El valor de la esfera izquierda debe ser numerico";
                } 
            
                if (is_numeric($this->esfera_od)) {
                    if ($this->esfera_od < -99 || $this->esfera_od > 99){
                        $mensaje["msg5"] ="error... La dificultad visual de la Esfera Izquierda debe estar entre -99 y +99";
                    }            
                } else {
                    $mensaje["msg5"] ="error... El valor de la esfera derecha debe ser numerico";
                }
            
                if (is_numeric($this->cilindro_oi)) {
                    if ($this->cilindro_oi < -99 || $this->cilindro_oi > 99){
                        $mensaje["msg6"] ="error... El cilindro izquierdo debe estar entre -99 y +99";
                    }
                } else {
                    $mensaje["msg6"] ="error... El valor del cilindro izquierdo debe ser numerico";
                }
            
                if (is_numeric($this->cilindro_od)) {
                    if ($this->cilindro_od < -99 || $this->cilindro_od > 99){
                        $mensaje["msg7"] ="el cilindro derecho debe estar entre -99 y +99";
                    }
                } else {
                    $mensaje["ms7"] ="error... El valor del cilindro derecho debe ser numerico";
                }
            
                if (is_numeric($this->eje_od)) {
                    if ($this->eje_od < 1|| $this->eje_od > 180){
                        $mensaje["msg8"] ="error... El angulo del eje derecho debe ser entre 1 y 180 grados";
                    }               
                } else {
                    $mensaje["msg8"] ="error... El angulo del eje derecho debe ser numerico";
                }
            
                if (is_numeric($this->eje_oi)) {
                    if ($this->eje_oi < 1|| $this->eje_oi > 180){
                        $mensaje["msg9"] ="error... El angulo del eje izquierdo debe ser entre 1 y 180 grados";
                    }               
                } else {
                    $mensaje["msg9"] ="error... El angulo del eje izquierdo debe ser numerico";
                }
            
                if (is_numeric($this->valor_lente)) {
                    if ($this->valor_lente < 0|| $this->valor_lente > 999999999){
                        $mensaje["msg10"] ="error... El valor maximo del lente es de $999.999.999";
                    }               
                } else {
                    $mensaje["msg10"] ="error... El precio debe ser numerico";
                }
            
                if (strlen($this->observacion) > 1000 ){
                    $mensaje["msg11"] ="error... Observacion demasiado larga, maximo 1000 caracteres";
                }  
            
                if ((isset($mensaje))){
                    echo json_encode($mensaje); 
                    return;
                }
            
                $count = $model->insertarReceta($data);
                    if ($count == 1) {
                        echo json_encode(["msg"=>"receta creada"]);
                    } else {
                        echo json_encode(["msg"=>"no se ha podido generar la receta"]);   
                    }
            }

        } else {
            echo json_encode(["msg"=>"session no iniciada"]);
        }
    }

}    
