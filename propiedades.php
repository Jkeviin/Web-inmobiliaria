<?php
include("funciones.php");

$limInferior = 0;

$config = obtenerConfiguracion();

$result_ciudades = ObtenerTodasLasCiudades();

$result_tipos = obtenerTodosLosTipos();

$result_propiedades = cargarPropiedades($limInferior);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TANIA - Inmobiliaria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
    <!-- Icono casa -->
    <link rel="icon" href="img/casa.png">

    <script>
        function cargarMasPropiedades(str) {
            var conexion;

            if (str == "") {
                document.getElementById("contenedor-propiedades").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) {
                conexion = new XMLHttpRequest();
            }

            conexion.onreadystatechange = function() {
                if (conexion.readyState == 4 && conexion.status == 200) {
                    document.getElementById("contenedor-propiedades").innerHTML += conexion.responseText;
                    document.getElementById("botonCargarMas").value = parseInt(document.getElementById("botonCargarMas").value) + 6;

                }
            }

            conexion.open("GET", "maspropiedades.php?c=" + str, true);
            conexion.send();

        }
    </script>
</head>

<body class="page-propiedades">
    <div class="container">
        <?php include("header.php"); ?>

        <div class="box-buscar-propiedades pos-centrada">
            <div class="box-interior">
                <p>Encuentra la propiedad que busca</p>
                <form action="busqueda.php?" method="get">
                    <select name="ciudad" id="">
                        <option value="">Seleccione Ciudad</option>
                        <?php while ($row = mysqli_fetch_assoc($result_ciudades)) : ?>
                            <option value="<?php echo $row['id'] ?>">
                                <?php echo $row['nombre_ciudad'] ?>
                            </option>
                        <?php endwhile ?>
                    </select>
                    <select name="tipo" id="">
                        <option value="">Tipo de Propiedad</option>
                        <?php while ($row = mysqli_fetch_assoc($result_tipos)) : ?>
                            <option value="<?php echo $row['id'] ?>">
                                <?php echo $row['nombre_tipo'] ?>
                            </option>
                        <?php endwhile ?>
                    </select>
                    <div class="estado">
                        <span>
                            <input type="radio" value="alquiler" name="estado" checked> Alquiler
                        </span>
                        <span>
                            <input type="radio" value="venta" name="estado"> Venta
                        </span>
                    </div>
                                        <!-- Busqueda por rango de precio -->
                                        <div class="rango-precio">
                        <p class="titulo-small">Precio</p>
                        <span class="precio-minimo">
                            <input type="number" name="precio_minimo" placeholder="Precio Mínimo">
                        </span>
                        <span class="precio-maximo">
                            <input type="number" name="precio_maximo" placeholder="Precio Máximo">
                        </span>
                    </div>
                                        <!-- Habitaciones -->
                    <div class="habitaciones">
                        <!-- Titulo small -->
                        <p class="titulo-small">Habitaciones</p>
                        <span>
                            <input type="radio" value="1" name="habitaciones_b">1
                        </span>
                        <span>
                            <input type="radio" value="2" name="habitaciones_b" checked> 2
                        </span>
                        <span>
                            <input type="radio" value="3" name="habitaciones_b"> 3
                        </span>
                        <span>
                            <input type="radio" value="4" name="habitaciones_b"> 4
                        </span>
                        <span>
                            <input type="radio" value="5" name="habitaciones_b"> 5
                        </span>
                    </div>

                    <input type="submit" value="Buscar" name="buscar">
                </form>
            </div>

        </div>

        <div class="contenedor-propiedades" id="contenedor-propiedades">
            <div class="grid">
                <?php while ($propiedad = mysqli_fetch_assoc($result_propiedades)) : ?>
                    <form action="publicacion.php" method="get" id="<?php echo $propiedad['id'] ?>">
                        <input type="hidden" value="<?php echo $propiedad['id'] ?>" name="idPropiedad">
                        <div class="contenedor-propiedad" onclick="document.getElementById('<?php echo $propiedad['id'] ?>').submit();">
                            <div class="contenedor-img">
                                <img src="<?php echo 'admin/' . $propiedad['url_foto_principal'] ?>" alt="">
                                <div class="estado">
                                    <?php echo $propiedad['estado'] ?>
                                </div>
                            </div>
                            <div class="info">
                                <h2><?php echo $propiedad['titulo'] ?></h2>
                                </i><?php echo $propiedad['ubicacion'] ?></p>
                                <span class="precio">$ <?php echo number_format($propiedad['precio'],0,'','.') ?></span>
                                <hr>
                                <table>
                                    <tr>
                                        <th>Ambientes</th>
                                        <th>Baños</th>
                                        <th>Dimensiones</th>
                                    </tr>
                                    <tr>
                                        <td><?php echo $propiedad['habitaciones'] ?></td>
                                        <td><?php echo $propiedad['banios'] ?></td>
                                        <td><?php echo $propiedad['dimensiones'] ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </form>
                <?php endwhile ?>
            </div>
        </div>
        <div class="contenedor-propiedades" id="contenedor-propiedades">

        <button value="0" onclick="cargarMasPropiedades(this.value)" id="botonCargarMas"> Ver Más</button>

        </div>

    <footer>
            <?php include("contenido-footer.php")?>
    </footer>
</body>

</html>