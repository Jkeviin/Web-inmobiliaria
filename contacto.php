<?php
include("funciones.php");


$config = obtenerConfiguracion();

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

<body class="page-contacto">
    <div class="container">
        <?php include("header.php"); ?>

        <div class="contenedor-contacto">
            <div class="col info">
                <div>
                    <h3> <i class="fa-solid fa-location-dot"></i> Nuestra Oficina Central</h3>
                    <p><?php echo $config['oficina_central'] ?></p>
                </div>

                <div>
                <h3><i class="fa-solid fa-phone"></i> Nuestros teléfonos</h3>
                    <p><?php echo $config['telefono1'] ?></p>
                    <p><?php echo $config['telefono2'] ?></p>
                </div>
                

                <div>
                    <h3><i class="fa-solid fa-envelope"></i> Correo Electrónico</h3>
                    <p><?php echo $config['email_contacto'] ?></p>
                </div>

                <div>
                    <h3><i class="fa-solid fa-clock"></i> Horarios de atención en Oficina</h3>
                    <p><?php echo $config['horarios'] ?></p>
                </div>

            </div>
            <div class="col formulario">
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
            <div class="col">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d3476.9558109071627!2d-66.34241857118006!3d-33.28432508428671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sar!4v1645188876080!5m2!1ses-419!2sar" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

        </div>

    </div>

    <footer class="inferior">
            <?php include("contenido-footer.php")?>
        </footer>
</body>

</html>