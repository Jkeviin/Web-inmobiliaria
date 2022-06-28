<div class="contenedor-header">
    <header>
        <div class="logo">
            <a href="index.php">
                <h1>SAWPI</h1>
                <p>Inmobiliaria</p>
            </a>

        </div>

        <nav>
            <a href="index.php">Home</a>
            <a href="propiedades.php">Propiedades</a>
            <a href="contacto.php">Contacto</a>
        </nav>

        <div class="info-contacto">
            <span class="info">
                <i class="fa-solid fa-phone"></i> <?php echo $config['telefono1'] ?>
            </span>
            <span class="info">
                <?php if ($config['facebook'] != null) : ?>
                    <a href="<?php echo $config['facebook'] ?>"><i class="fa-brands fa-facebook-f"></i></a>
                <?php endif ?>
            </span>
            <span class="info">
                <?php if ($config['twitter'] != null) : ?>
                    <a href="<?php echo $config['twitter'] ?>"><i class="fa-brands fa-twitter"></i></a>
                <?php endif ?>
            </span>
        </div>
    </header>
</div>