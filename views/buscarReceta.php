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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <?php
    if (isset($_SESSION['usuario'])) { ?>
        <nav class="blue-grey darken-4 padding-nav">
            <div class="nav-wrapper ">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <a href="#" class="brand-logo ">
                <img class="logo" src="../img/ojo.png">
                    Bienvenido <?= $_SESSION['usuario']['nombre'] ?></a>
                    
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                    <li><a href="crearCliente.php">Crear Cliente<i class="material-icons left">assignment_ind</i></a></li>
                    <li class="active"><a href="buscarReceta.php">Buscar Receta <i class="material-icons left">search</i></a></li>
                    <li><a href="ingresoReceta.php">Ingreso <i class="material-icons left">playlist_add</i></a></li>
                    <li><a href="salir.php">Salir <i class="material-icons left">power_settings_new</i></a></li>
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
                    <a href="#name"><span class="white-text name"><?= $_SESSION['usuario']['nombre'] ?></span></a>
                    <a href="#email"><span class="white-text email"><?= $_SESSION['usuario']['rol'] ?></span></a>
            </li></div>
            <li><a href="crearCliente.php">Crear Cliente</a></li>
            <li class="active"><a href="buscarReceta.php">Buscar Receta</a></li>
            <li><a href="ingresoReceta.php">Ingreso</a></li>
            <li><div class="divider"></div></li>
            <li><a href="salir.php">Salir</a></li>
        </ul>
    <!-- FIN Nav movil --> 

        <div id="app" class="container">
            <h4>Buscar Receta</h4>
            <div class="row">
                <div class="col l6 m4 s12">
                    <form @submit.prevent="buscarRut">
                        <div class="input-field">
                            <input type="text" v-model="rut">
                            <label for="rut">Rut</label>
                        </div>
                        <button class="btn black ancho-100">
                            buscar
                        </button>
                    </form>
                </div>
                <div class="col l6 m4 s12">
                    <form @submit.prevent="buscarFecha">
                        <div class="input-field">
                            <input type="text" class="datepicker" v-model="fecha" id="buscar_fecha">
                            <label for="fecha">Fecha creación</label>
                        </div>
                        <button class="btn black ancho-100">
                            buscar
                        </button>
                    </form>
                </div>
            </div> 
                <table>
                    <tr>
                        <th>Armazon</th>
                        <th>Tipo</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th></th>
                        <th></th>
                    </tr>

                    <tr v-for="r in recetas">
                        <td>{{r.armazon}}</td>
                        <td>{{r.tipo_cristal}}</td>
                        <td>{{r.nombre_cliente}}</td>
                        <td>{{r.fecha_entrega}}</td>
                        <td>
                            <button @click="abrirModal(r)" class="btn-small blue">
                                detalle
                            </button>
                        </td>
                        <td>
                            <button class="button-icon">
                                <img height="30" src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/PDF_file_icon.svg/1200px-PDF_file_icon.svg.png" alt="">
                            </button>
                        </td>
                    </tr>
                </table>

                <!--MODAL A MOSTRAR-->
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h5>Detalle de Receta Nº: {{receta.id}}</h5>
                         <hr>
                        <div class="row">
                            <div class="col l6">
                                Esfera Izq: {{receta.esfera_oi}}
                            </div>
                            <div class="col l6">
                                Esfera Der: {{receta.esfera_od}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col l6">
                                Tipo Lente: {{receta.tipo_lente}}
                            </div>
                            <div class="col l6">
                                Cristal: {{receta.material_cristal}}
                            </div>
                        </div>

                    </div>
                        <div class="modal-footer">
                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
                        </div>
                </div>

                <!--END MODAL-->
            

              
        </div>


    <?php } else { ?>
    <a href="../index.php">
    <img class="matrix" src="../img/matrix.jpg" >
    </a>

    <?php  } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="../js/buscarReceta.js"></script>
    <script src="../js/crearCliente.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
        //MODAL
        var elems = document.querySelectorAll('.modal');
            var instances = M.Modal.init(elems);
        });
    </script>
</body>
</html>