<?php
include("funciones.php");

$id_ciudad = $_GET['ciudad'];
$id_tipo = $_GET['tipo'];
$estado = $_GET['estado'];
$precio_minimo = $_GET['precio_minimo'];
$precio_maximo = $_GET['precio_maximo'];
$habitaciones_b = $_GET['habitaciones_b'];

$result_busqueda = realizarBusqueda($id_ciudad, $id_tipo, $estado, $precio_minimo, $precio_maximo, $habitaciones_b);

/* Notice
: Undefined index: habitaciones in
H:\xampp\htdocs\Web-inmobiliaria\busqueda.php
on line
9

Sale lo anterior porque no se ha definido la variable habitaciones en el formulario de busqueda.php
*/

$config = obtenerConfiguracion();

$result_ciudades = ObtenerTodasLasCiudades();

$result_tipos = obtenerTodosLosTipos();


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
</head>

<body class="page-busqueda">
    <div class="container">
        <?php include("header.php"); ?>

        <div class="box-buscar-propiedades pos-centrada">
            <div class="box-interior">
                <p>Encuentra la propiedad que busca</p>
                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="get">
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
                            <input type="radio" value="Alquiler" name="estado" checked="true">Alquiler
                        </span>
                        <span>
                            <input type="radio" value="Venta" name="estado"> Venta
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

        <div class="contenedor-busqueda">
            <h3>Resultado Busqueda: </h3>

            <?php if (mysqli_num_rows($result_busqueda) > 0) : ?>
            <?php while ($propiedad = mysqli_fetch_assoc($result_busqueda)) : ?>
                <form action="publicacion.php" method="get" id="<?php echo $propiedad['id'] ?>">
                    <input type="hidden" value="<?php echo $propiedad['id'] ?>" name="idPropiedad">
                    <div class="resultado" onclick="document.getElementById('<?php echo $propiedad['id'] ?>').submit();">
                        <div class="contenedor-imagen">
                            <img src="<?php echo "admin/" . $propiedad['url_foto_principal'] ?>" alt="">
                        </div>
                        <div class="info">
                            <span class="titulo"><?php echo $propiedad['titulo'] ?></span>
                            <p> <i class="fa-solid fa-location-pin"></i> <?php echo $propiedad['ubicacion'] . ", " . obtenerCiudad($propiedad['ciudad']) . ", " . obtenerPais($propiedad['pais']) ?></p>
                            <div class="detalles">
                                <div class="dato1 dato_Tipo">
                                    <span class="header">Tipo</span>
                                    <span class="texto"><?php echo obtenerTipo($propiedad['tipo']) ?></span>
                                </div>
                                <div class="dato1 dato_Estado">
                                    <span class="header">Estado</span>
                                    <span class="texto"><?php echo $propiedad['estado'] ?></span>
                                </div>
                                <div class="dato1">
                                    <span class="header">Habitaciones</span>
                                    <!-- Icono habitacion -->
                                    <i class="fa-solid fa-bed dato_icono"></i>
                                    <span class="texto "><?php echo $propiedad['habitaciones'] ?></span>
                                </div>
                                <div class="dato1 baño">
                                    <span class="header">Baños</span>
                                    <!-- Icono baño -->
                                    <i class="fa-solid fa-bath dato_icono"></i>
                                    <span class="texto"><?php echo $propiedad['banios'] ?></span>
                                </div>
                                <div class="dato1">
                                    <span class="header">Precio</span>
                                    <!-- Icono Precio -->
                                    <i class="fa-solid fa-money-bill dato_icono"></i>
                                    <span class="texto"><?php echo number_format($propiedad['precio'],0,'','.') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php endwhile ?>
            <?php else : ?>
                <h1>No hay resultados</h1>
            <?php endif ?>
        </div>

    </div>

    <footer>
            <?php include("contenido-footer.php")?>
        </footer>
</body>

</html>