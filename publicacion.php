<?php

include("funciones.php");

$i = 0;

$config = obtenerConfiguracion();

$id_propiedad = $_GET['idPropiedad'];

$propiedad = obtenerPropiedadPorId($id_propiedad);

$restul_fotos_galeria = obtenerFotosGaleria($id_propiedad);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SAWPI - Inmobiliaria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="estilo.css">
</head>

<body class="page-publicacion">
    <div class="container">
        <?php include("header.php"); ?>

        <div class="contenedor-principal">
            <div class="info-publicacion">
                <section class="info-principal-galeria">
                    <div class="dato1">
                        <span class="estado"><?php echo $propiedad['estado'] ?></span>
                        <span class="precio">$ <?php echo number_format($propiedad['precio'], 0, '', '.') ?></span>
                    </div>
                    <h2><?php echo $propiedad['titulo'] ?></h2>
                    <p> <i class="fa-solid fa-location-pin"></i> <?php echo $propiedad['ubicacion'] . ", " . obtenerCiudad($propiedad['ciudad']) . ", " . obtenerPais($propiedad['pais']) ?></p>
                    <div class="contenedor-imagen-principal">
                        <img src="<?php echo "admin/" . $propiedad['url_foto_principal'] ?>" alt="">
                    </div>
                    <div class="galeria" id="galeria">
                        <!-- Utilizo la variable i, para saber el numero de foto. Lo usare luego cuando tenga que recorrer las fotos una por una en el modal -->
                        <?php $i = 0; ?>
                        <?php while ($foto = mysqli_fetch_assoc($restul_fotos_galeria)) : ?>
                            <img src="<?php echo 'admin/fotos/' . $foto['id_propiedad'] . '/' . $foto['nombre_foto'] ?>" onclick="abrirModal(this,<?php echo $i ?>)" alt="s">
                            <?php $i++; ?>
                        <?php endwhile ?>
                    </div>
                </section>
                <section class="descripcion">
                    <h3>Descripción</h3>
                    <div class="fila">
                        <div class="dato">
                            <span class="header">Tipo</span>
                            <span class="valor"><?php echo obtenerTipo($propiedad['tipo']) ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Estado</span>
                            <span class="valor"><?php echo $propiedad['estado'] ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Precio</span>
                            <span class="valor">$ <?php echo number_format($propiedad['precio'], 0, '', '.') ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Habitaciones</span>
                            <span class="valor"><?php echo $propiedad['habitaciones'] ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Baños</span>
                            <span class="valor"><?php echo $propiedad['banios'] ?></span>
                        </div>
                    </div>
                    <div class="fila">
                        <div class="dato">
                            <span class="header">Garage</span>
                            <span class="valor"><?php echo $propiedad['garage'] ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Dimensiones</span>
                            <span class="valor"><?php echo $propiedad['dimensiones'] ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Pisos</span>
                            <span class="valor"><?php echo $propiedad['pisos'] ?></span>
                        </div>
                        <div class="dato">
                            <span class="header">Ciudad</span>
                            <span class="valor"><?php echo obtenerCiudad($propiedad['ciudad']) ?> </span>
                        </div>
                        <div class="dato">
                            <span class="header">Pais</span>
                            <span class="valor"> <?php echo obtenerPais($propiedad['pais']) ?> </span>
                        </div>
                    </div>

                    <?php
                    //Cambiamos los saltos de linea que vienen en la descripcion
                    //por la etiqueta br para producir el salto de linea.
                    $descripcion = str_replace("\n", "<br>", $propiedad['descripcion']);
                    ?>

                    <div class="detalle"><?php echo $descripcion ?></div>
                </section>
                <section class="compartir">
                    <h3>Compartir esta propiedad</h3>
                    <a href="http://facebook.com/sharer.php?u=http://localhost/sapi/publicacion.php?idPublicacion=<?php echo $propiedad['id'] ?>" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>

                    <a href="tel:<?php echo $config['telefono1'] ?>"> <i class="fa-solid fa-phone"></i> </a>

                    <a href="whatsapp://send?text=Buen día, vengo de la pagina web y estoy interesado en la siguiente propiedad: '<?php echo strtoupper($propiedad['titulo'])?>' http://localhost/web-inmobiliaria/publicacion.php?idPropiedad=<?php echo $propiedad['id']?>&phone=<?php echo $propiedad['telefono_propietario']?>" data-action="share/whatsapp/share"> <i class="fa-brands fa-whatsapp"></i> </a>
                </section>
            </div>
            <div class="form-contacto-publicacion">
                <form action="">
                    <h3>Comuníquese con nosotros</h3>
                    <div>
                        <label for="nombre">Nombre</label>
                        <input type="text" placeholder="Ingrese su nombre" name="nombre" required>
                    </div>
                    <div>
                        <label for="email">Dirección de Correo</label>
                        <input type="email" placeholder="Dirección de Correo" name="email" required>
                    </div>
                    <div>
                        <label for="telefono">Teléfono</label>
                        <input type="text" placeholder="Ingrese su teléfono" name="telefono">
                    </div>
                    <div>
                        <label for="mensaje">Consulta</label>
                        <textarea type="text" placeholder="Escriba su consulta" name="mensaje" required></textarea>
                    </div>
                    <input type="submit" value="Enviar Mensaje" name="enviar">
                </form>
            </div>

            <!-- The Modal para visualizar la galería de fotos -->
            <div id="myModal" class="modal">
                <!-- Modal content -->
                <div class="modal-content">
                    <img src="" alt="" id="fotoModal">
                    <span class="close">&times;</span>
                    <span onclick="anterior()"><i class="fa-solid fa-angles-left"></i></span>
                    <span onclick="proxima()"><i class="fa-solid fa-angles-right"></i></span>
                </div>
            </div>
        </div>

    </div>

    <footer >
        <?php include("contenido-footer.php") ?>
    </footer>

    <script src="script.js"></script>
</body>

</html>