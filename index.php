<?php

include("funciones.php");

$config = obtenerConfiguracion();

$result_ciudades = ObtenerTodasLasCiudades();

$result_tipos = obtenerTodosLosTipos();

?>
<!DOCTYPE html>
<html lang="en">

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

<body class="home">
        <?php include("header.php");?>
        <div class="box-buscar-propiedades pos-inferior">
            <div class="box-interior">
                <p>Encuentra la propiedad que busca</p>
                <form action="busqueda.php" method="get">
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
                            <input type="radio" value="Alquiler" name="estado" checked  ="true"> Alquiler
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
        <footer class="inferior">
            <?php include("contenido-footer.php")?>
        </footer>
</body>

</html>