<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITE_NAME; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="<?php echo BASE_URL; ?>" class="logo">
                <i class="fas fa-cut"></i>
                <span>Barber<span class="accent">Shop</span></span>
            </a>
            <ul class="nav-links">
                <li><a href="<?php echo BASE_URL; ?>" class="active">Inicio</a></li>
                <li><a href="<?php echo BASE_URL; ?>servicios">Servicios</a></li>
                <li><a href="#nosotros">Nosotros</a></li>
                <li><a href="#contacto">Contacto</a></li>
                <li><a href="<?php echo BASE_URL; ?>citas" class="btn-nav">Reservar Cita</a></li>
            </ul>
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <main>