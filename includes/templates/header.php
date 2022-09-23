<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raíces</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>

<body>
    <header class="header <?php echo $isIndex ? 'index' : '' ?> ">
        <div class="container <?php echo $isIndex ? 'header-content' : 'header-container' ?>">
            <div class="bar">
                <div class="mobile-header">
                    <a href="/">
                        <img src="/build/img/logo.svg" alt="Logotipo de Bienes Raíces">
                    </a>

                    <div class="mobile-menu">
                        <img src="/build/img/barras.svg" alt="Ícono Menú Responsive">
                    </div>
                </div> <!-- .mobile-header -->

                <div class="right">
                    <div class="dark-mode">
                        <img class="dark-mode-btn" src="/build/img/dark-mode.svg" alt="Botón de Modo Oscuro">
                    </div>
                    <nav class="navigation">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                    </nav>
                </div><!-- .right -->
            </div> <!-- .bar -->
            <?php echo $isIndex ? '<h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>' : '' ?>
        </div> <!-- .header-container -->
    </header>