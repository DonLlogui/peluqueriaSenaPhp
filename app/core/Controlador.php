<?php
class Controlador {
    protected function vista($nombreVista, $datos = []) {
        extract($datos);
        require_once __DIR__ . '/../vista/layout/header.php';
        require_once __DIR__ . '/../vista/' . $nombreVista . '.php';
        require_once __DIR__ . '/../vista/layout/footer.php';
    }
}