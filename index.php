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
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Acceso usuario</title>
</head>
<body>
    <nav class="blue-grey darken-4 padding-nav">
        <div class="nav-wrapper">
        <a href="#" class="brand-logo "> <img class="logo" src="img/ojo.png"> Optica </a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li class="active"><a href="index.php">Ingresar como usuario</a></li>
                <li><a href="admin.php">Ingresar como administrador</a></li>
            </ul>
        </div>
    </nav>
    <div class="container" >
        <div class="row center"  >
            <div class="col l4 m4 s12">
            </div>
            <div class="col l4 m4 s12">
                <img class="img" src="img/avatar-user.svg">
                <h4>Acceso Usuario</h4>
                <form action="controllers/ControlLoginUser.php" method="post">
                    <div class="input-field">
                    <i class="material-icons prefix">account_circle</i>
                        <input id="rut" type="text" name="rut">
                        <label for="rut">Rut</label>
                    </div>
                    <div class="input-field">
                    <i class="material-icons prefix">lock</i>
                        <input id="clave" type="password" name="clave">
                        <label for="clave">Clave de acceso</label>
                    </div>
                    <button class="btn black ancho-100">Entrar</button>
                </form>
                <p class="red-text">
                    <?php
                        if(isset($_SESSION['error'])){
                            echo $_SESSION['error'];
                            unset($_SESSION['error']);
                        }
                    ?>
                </p>
            </div>
        </div>
    </div>
    <div class="card">
            <div class="horizontal">
                <div class="info2">
                    <p>Benjamin Bustos <br>
                        <span class="cargo">Jefe de Area TI</span>
                    </p>
                </div>
                <div class="info2">
                    <p>Sebastian Morales <br>
                        <span class="cargo">Ingeniero de Software</span>
                    </p>
                </div>
                <div class="info2">
                    <p>Matias Rojas <br>
                        <span class="cargo">Jefe de Proyecto</span>
                    </p>
                </div>
            </div>
            <div class="copiright">
                © 2020 Copyright Text
            </div>
    </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    
</body>
</html>