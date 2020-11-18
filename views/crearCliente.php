<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 

    session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <?php

    if (isset($_SESSION['usuario'])) { ?>
        <nav class="blue-grey darken-4 padding-nav">
            <div class="nav-wrapper ">
                <a href="#" class="brand-logo ">
                <img class="logo" src="../img/ojo.png">
                    Bienvenido <?= $_SESSION['usuario']['nombre'] ?></a>
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li class="active"><a href="#">Crear Cliente</a></li>
                    <li><a href="#">Buscar Receta</a></li>
                    <li><a href="#">Ingreso</a></li>
                    <li><a href="salir.php">Salir</a></li>
                </ul>
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col l4 m4 s12"></div>
                <div class="col l4 m4 s12">
                    <h4>Ingresar cliente</h4>
                    <form action="../controllers/ControlNuevoCliente.php" method="POST">
                        <div class="input-field">
                            <input id="rut" type="text" name="rut">
                            <label for="rut">Rut del cliente</label>
                        </div>
                        <div class="input-field">
                            <input id="nombre" type="text" name="nombre">
                            <label for="nombre">Nombre del cliente</label>
                        </div>
                        <div class="input-field">
                            <input id="direccion" type="text" name="direccion">
                            <label for="direccion">Direccion del cliente</label>
                        </div>
                        <div class="input-field">
                            <input id="telefono" type="text" name="telefono">
                            <label for="telefono">Numero de contacto</label>
                        </div>
                        <div class="input-field">
                            <input id="fecha" type="text" name="fecha" class="datepicker">
                            <label for="fecha">Fecha creación</label>
                        </div>
                        <div class="input-field">
                            <input id="email" type="email" name="email">
                            <label for="email">Email de contacto</label>
                        </div>
                        <button class="btn black ancho-100">Crear</button>
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
                            if(isset($_SESSION['resp'])){
                                echo $_SESSION['resp'];
                                unset($_SESSION['resp']);
                            }
                        ?>
                    </p>
                </div>
            </div>
        </div>


    <?php } else { ?>
        <a href="../index.php">
        <img class="matrix" src="../img/matrix.jpg" >
        </a>

    <?php  } ?>
    <script src="../js/crearCliente.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>