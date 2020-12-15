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
                    <li><a href="crearCliente.php">Crear Cliente</a></li>
                    <li><a href="buscarReceta.php">Buscar Receta</a></li>
                    <li class="active"><a href="ingresoReceta.php">Ingreso</a></li>
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
                    <a href="#name"><span class="white-text name"><?= $_SESSION['usuario']['nombre'] ?></span></a>
                    <a href="#email"><span class="white-text email"><?= $_SESSION['usuario']['rol'] ?></span></a>
            </li></div>
            <li><a href="crearCliente.php">Crear Cliente</a></li>
            <li><a href="buscarReceta.php">Buscar Receta</a></li>
            <li class="active"><a href="ingresoReceta.php">Ingreso</a></li>
            <li><div class="divider"></div></li>
            <li><a href="salir.php">Salir</a></li>
        </ul>
    <!-- FIN Nav movil --> 

        <div id="app" class="container">
            <div class="row">
                <div class="col l4 m4 s12">
                <h5 class="center">Buscar Cliente</h5>
                    <form @submit.prevent="buscar">
                        <div class="input-field">
                            <input type="text" v-model="rut">
                            <label for="rut">Rut</label>
                        </div>
                        <button class="btn black ancho-100">
                            buscar
                        </button>
                    </form>
                    
                </div>
                <div class="col l8 m8 s12">
                    <p>
                        <ul v-if="esta" class="collection">
                            <li class="collection-item">Nombre: {{cliente.nombre_cliente}}</li>
                            <li class="collection-item">Direccion: {{cliente.direccion_cliente}}</li>
                            <li class="collection-item">Telefono: {{cliente.telefono_cliente}}</li>
                            <li class="collection-item">Email: {{cliente.email_cliente}}</li>
                        </ul>
                    </p>

                </div>
            </div> 
            <!-- INGRESAR RECETA --> 
            <form @submit.prevent="crearReceta">
            <div class="card-panel">
                <div class="row" >
                    <div class="col l6 m6 s12">
                        <span>tipo lente : </span>
                        <label>
                            <input type="radio" id="lejos" value="lejos" v-model="tipo_lentes" >
                            <span>lejos</span>
                        </label>
                        <label>
                            <input type="radio" id="cerca" value="cerca" v-model="tipo_lentes">
                            <span>cerca</span>
                        </label>
                    </div>
                    <div class="col l6 m6 s12">
                    </div>
                </div>
                <div class="row">
                    <div class="col l6 m6 s12" >
                        <div class="col l6 m6 s12" >
                            <h6>Tipo Cristal</h6>
                            <select v-model="id_tipo_cristal" class="browser-default">
                                <option v-for="t in tipos" :value="t.id_tipo_cristal">
                                    {{t.tipo_cristal}}
                                </option>
                            </select>
                            <h6>Base</h6>
                            <select v-model="base_sel" class="browser-default">
                                <option>Seleccione una opcion</option>
                                <option value="superior">Superior</option>
                                <option value="inferior">Inferior</option>
                                <option value="interna">Interna</option>
                                <option value="externa">Externa</option>
                            </select>
                        </div>
                        <div class="col l6 m6 s12">
                            <h6>Material Cristal</h6>
                            <select v-model="id_material_cristal" class="browser-default">
                                <option v-for="m in materiales" :value="m.id_material_cristal">
                                    {{m.material_cristal}}
                                </option>
                            </select>
                            <h6>Armazon</h6>
                            <select v-model="id_armazon" class="browser-default">
                                <option v-for="a in armazones" :value="a.id_armazon">
                                    {{a.nombre_armazon}}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col l6 m6 s12" style=" transform: translateY(-20%); ">
                        <div class="col l6 m6 s12" style="border: 1px solid blue;">
                            <h6 class="center">Ojo izquierdo</h6>
                            <div class="input-field margin-inputs back-field col l8">
                                <input type="text" v-model="i_esfera">
                                <label for="esfera">Esfera</label>
                            </div>
                            <div class="input-field margin-inputs back-field col l8">
                                <input type="text" v-model="i_cilindro">
                                <label for="esfera">Cilindro</label>
                            </div>
                            <div class="input-field margin-inputs back-field col l8">
                                <input type="text" v-model="i_eje">
                                <label for="esfera">Eje</label>
                            </div>
                        </div>
                        <div class="col l6 m6 s12 " style="border: 1px solid red;" >
                            <h6 class="center">Ojo derecho</h6>
                            <div class="input-field margin-inputs back-field col l8 ">
                                <input type="text" v-model="d_esfera" >
                                <label for="esfera">Esfera</label>
                            </div>
                            <div class="input-field margin-inputs back-field col l8">
                                <input type="text" v-model="d_cilindro">
                                <label for="esfera">Cilindro</label>
                            </div>
                            <div class="input-field margin-inputs back-field col l8 ">
                                <input type="text" v-model="d_eje">
                                <label for="esfera">Eje</label>
                            </div>
                        </div>
                    </div>
                </div>

                <hr >

                <div class="row">
                    <div class="col l4 m6 s12" style="border: 1px solid red;">
                        <div class="input-field margin-inputs back-field col l8">
                            <input type="text" v-model="prisma" >
                            <label for="prisma">Prisma</label>
                        </div>
                        <div class="input-field margin-inputs back-field col l8">
                            <input type="text" v-model="distancia_p">
                            <label for="esfera">Distancia pupilar</label>
                        </div>
                        <div class="input-field back-field col l10">
                            <textarea v-model="observacion" class="materialize-textarea" rows="10"></textarea>
                            <label for="textarea1">Observacion</label>
                            <!--{{.lenght}} -->
                        </div>
                    </div>

                    <div class="col l4 m6 s12" style="border: 1px solid blue;">
                        <div class="input-field back-field col l8">
                            <input type="text" class="datepicker" name="fecha" id="fecha_entrega">
                            <label for="fecha">Fecha de entrega</label>
                        </div>
                        <div class="input-field back-field col l8">
                            <input type="text" v-model="valor">
                            <label for="valor">Valor del lente</label>
                        </div>
                        <div class="input-field back-field col l8">
                            <input type="text" v-model="rut_med">
                            <label for="valor">Rut del medico</label>
                        </div>
                        <div class="input-field back-field col l8">
                            <input type="text" v-model="nom_med">
                            <label for="valor">Nombre del medico</label>
                        </div>
                    </div>

                    <div class="col l4 m6 s12" style="border: 1px solid green;">
                        <div class="input-field back-field col l8">
                            <input type="text" class="datepicker" name="fecha" id="fecha_retiro">
                            <label for="fecha">Fecha de retiro</label>
                        </div>
                        
                    </div>
                </div>
                <div class="input-field back-field-desactived right-align">
                    <button v-on:click="crearReceta()" class="btn black ancho-100">Crear</button>
                </div>
            </div>
            </form>
               
        </div>


    <?php } else { ?>
        <a href="../index.php">
        <img class="matrix" src="../img/matrix.jpg" >
        </a>

    <?php  } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="../js/ingresarReceta.js"></script>
    <script src="../js/crearCliente.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.sidenav');
        var instances = M.Sidenav.init(elems);
        });
    </script>
</body>
</html>