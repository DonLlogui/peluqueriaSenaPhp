<?php
require_once __DIR__ . '/../core/Controlador.php';

class InicioControlador extends Controlador {
    public function index() {
        $this->vista('home');
    }
}