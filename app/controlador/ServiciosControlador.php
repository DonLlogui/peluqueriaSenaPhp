<?php
require_once __DIR__ . '/../core/Controlador.php';
require_once __DIR__ . '/../modelo/Servicio.php';

class ServiciosControlador extends Controlador {
    private $modelo;

    public function __construct() {
        $this->modelo = new Servicio();
    }

    public function index() {
        $servicios = $this->modelo->todos();
        $this->vista('servicios/index', ['servicios' => $servicios]);
    }

    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->modelo->crear(
                $_POST['nombre'],
                $_POST['descripcion'],
                $_POST['precio'],
                $_POST['duracion']
            );
            header('Location: ' . BASE_URL . 'servicios');
            exit;
        }
        $this->vista('servicios/crear');
    }
}