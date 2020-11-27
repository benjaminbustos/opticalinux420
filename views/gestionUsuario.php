<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 

    use models\UsuarioModel as UsuarioModel;
    require_once("../models/UsuarioModel.php");
    $model = new UsuarioModel();
    $lista_Usuarios = $model->getAllUser();
    session_start();
?>   
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php

    if (isset($_SESSION['admin'])) { ?>
        <nav class="blue-grey darken-4" style="padding-left: 30px; padding-right: 30px;">
            <div class="nav-wrapper ">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a href="#" class="brand-logo ">
                <img class="logo" src="../img/ojo.png">
                    Bienvenido <?= $_SESSION['admin']['nombre'] ?></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li class="active"><a href="#">Gestion Usuario</a></li>
                    <li><a href="salir.php">Salir</a></li>
                </ul>
            </div>
        </nav>
        <!-- Nav movil --> 
        <ul id="slide-out" class="sidenav">
            <li><div class="user-view">
                    <div class="background" >
                        <img width="300" src="https://images3.alphacoders.com/103/1032371.jpg" >
                    </div>
                    <a href="#user"><img class="circle" src="../img/ojo.png"></a>
                    <a href="#name"><span class="white-text name"><?= $_SESSION['admin']['nombre'] ?></span></a>
                    <a href="#email"><span class="white-text email"><?= $_SESSION['admin']['rol'] ?></span></a>
            </li></div>
            <li class="active"><a href="#">Gestion Usuario</a></li>
            <li><div class="divider"></div></li>
            <li><a href="salir.php">Salir</a></li>
        </ul>
    <!-- FIN Nav movil --> 
        
        <div class="container">
            <div class="row">
                <div class="col l4 m4 s12">
                    <?php if(!isset($_SESSION['editar'])) { ?>
                        <!--INICIO CREAR USUARIO-->
                        <h5 class="center">Crear usuario</h5>
                            <form action="../controllers/ControlNuevoUsuario.php" method="POST">
                                <div class="input-field">
                                    <input id="rut" type="text" name="rut">
                                    <label for="rut">Rut</label>
                                </div>
                                <div class="input-field">
                                    <input id="nombre" type="text" name="nombre">
                                    <label for="nombre">Nombre</label>
                                </div>
                                <button class="btn black ancho-100">Crear usuario</button>
                            </form>
                            <p class="red-text">
                                <?php
                                    if(isset($_SESSION['error'])){
                                        echo $_SESSION['error'];
                                        unset ($_SESSION['error']);
                                    }
                                ?>
                            </p>
                            <p class="green-text">
                                <?php
                                    if(isset($_SESSION['respuesta'])){
                                        echo $_SESSION['respuesta'];
                                        unset ($_SESSION['respuesta']);
                                    }
                                ?>
                            </p>
                        <!--FIN CREAR USUARIO-->
                    <?php }else {?>
                        <!--EDITAR ESTADO DEL USUARIO--->
                        <h5 class="center">Editar usuario</h5>
                        <form action="../controllers/ControlEditarEstado.php" method="POST" onsubmit="return confirm('Esta Seguro?')">
                                <div class="input-field">
                                    <input readonly id="rut" type="text" name="rut" value="<?=$_SESSION['lista']['rut']?>">
                                    <label for="rut">Rut</label>
                                </div>
                                <div class="input-field">
                                    <input readonly id="nombre" type="text" name="nombre"value="<?=$_SESSION['lista']['nombre']?>">
                                    <label for="nombre">Nombre</label>
                                </div>
                                <div class="input-field">
                                    <select name="estado">
                                        <option value=0>Bloqueado</option>
                                        <option value=1>Habilitado</option>
                                    </select>
                                </div>
                            <button class="btn orange ancho-100">Editar usuario</button>
                        </form>
                        <!--FIN EDITAR ESTADO DEL USUARIO--->
                        <?php
                                unset( $_SESSION['editar']);
                                unset($_SESSION['lista']);
                                } 
                        ?> 
                </div>      
                    <div class="col l8 m8 s12" style="transform: translateX(5%);">
                        <h5 class="center">Listado de Usuarios</h5>
                            <form action="../controllers/ControlListaUsuario.php" method="post">
                                <table class="striped" >
                                    <tr>
                                        <th>Rut</th>
                                        <th>Nombre</th>
                                        <th>Estado</th>
                                        <th>Actions</th>
                                    </tr>
                                    <?php foreach ($lista_Usuarios as $item) {  ?>
                                        <?php if($item["estado"]==0){  //para dar el color rojo cuando esta bloqeado?>
                                        <tr class="red-text">
                                            <td><?=$item["rut"]?></td>
                                            <td><?=$item["nombre"]?></td>
                                            <td>
                                                <?php if($item["estado"]==0){?>
                                                    <p class="red-text">
                                                        Bloqueado
                                                    </p>    
                                                <?php }else { ?>
                                                    <p>
                                                        Habilitado
                                                    </p>
                                                <?php } ?>
                                            </td>
                                        <?php } else {?>
                                        <tr>
                                            <td><?=$item["rut"]?></td>
                                            <td><?=$item["nombre"]?></td>
                                            <td>
                                                <?php if($item["estado"]==0){?>
                                                    <p>
                                                        Bloqueado
                                                    </p>    
                                                <?php }else { ?>
                                                    <p>
                                                        Habilitado
                                                    </p>
                                                <?php } ?>
                                            </td>
                                        <?php } ?> 
                                            <td>
                                                <button name="bt_edit" value="<?=$item["rut"]?>" class="btn-floating waves-effect orange">
                                                    <i class="material-icons">edit</i></button>
                                                <button name="bt_delete" value="<?=$item["rut"]?>" class="btn-floating waves-effect red">
                                                    <i class="material-icons">delete</i></button>
                                            </td>
                                        </tr>
                                        
                                    <?php } ?>
                                </table> 
                            </form>
                        </div>
                
            </div>
        </div>
    

    <?php } else { ?>
        <a href="../index.php">
        <img class="matrix" src="../img/matrix.jpg" >
        </a>
        
        

    <?php  } ?>    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="../js/gestionusuario.js"></script>  
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
        });
    </script>
</body>
</html>