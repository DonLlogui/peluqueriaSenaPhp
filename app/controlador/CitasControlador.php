<?php
require_once __DIR__ . '/../core/Controlador.php';
require_once __DIR__ . '/../modelo/Cita.php';
require_once __DIR__ . '/../modelo/Servicio.php';
require_once __DIR__ . '/../modelo/Model.php';

class CitasControlador extends Controlador {
    private $modeloCita;
    private $modeloServicio;
    private $modeloBarbero;

    public function __construct() {
        $this->modeloCita = new Cita();
        $this->modeloServicio = new Servicio();
        
        // Modelo genérico para barberos
        $this->modeloBarbero = new class extends Model {
            protected $tabla = 'barberos';
        };
    }

    public function index() {
        // Si es admin, ve todas las citas; si es cliente, solo las suyas
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        
        if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin') {
            $citas = $this->modeloCita->obtenerConDetalles();
        } elseif ($usuario_id) {
            $citas = $this->modeloCita->obtenerPorUsuario($usuario_id);
        } else {
            $citas = [];
        }
        
        $this->vista('citas/index', [
            'citas' => $citas,
            'es_admin' => ($_SESSION['usuario_rol'] ?? '') === 'admin'
        ]);
    }

    public function crear() {
        $servicios = $this->modeloServicio->todos();
        $barberos = $this->modeloBarbero->todos();
        
        // Si viene un servicio desde la URL (?servicio=1)
        $servicio_seleccionado = $_GET['servicio'] ?? '';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_SESSION['usuario_id'] ?? 1; // Default para pruebas
            $barbero_id = $_POST['barbero_id'];
            $servicio_id = $_POST['servicio_id'];
            $fecha = $_POST['fecha'];
            $hora = $_POST['hora'];
            $observaciones = $_POST['observaciones'] ?? '';
            
            // Validar disponibilidad
            if (!$this->modeloCita->hayCitaDisponible($barbero_id, $fecha, $hora)) {
                $error = "El barbero ya tiene una cita agendada en ese horario";
                $this->vista('citas/crear', [
                    'servicios' => $servicios,
                    'barberos' => $barberos,
                    'servicio_seleccionado' => $servicio_seleccionado,
                    'error' => $error
                ]);
                return;
            }
            
            $this->modeloCita->crear(
                $usuario_id,
                $barbero_id,
                $servicio_id,
                $fecha,
                $hora,
                $observaciones
            );
            
            header('Location: ' . BASE_URL . 'citas?exito=1');
            exit;
        }
        
        $this->vista('citas/crear', [
            'servicios' => $servicios,
            'barberos' => $barberos,
            'servicio_seleccionado' => $servicio_seleccionado
        ]);
    }

    public function actualizarEstado() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['cita_id'];
            $estado = $_POST['estado'];
            $this->modeloCita->actualizarEstado($id, $estado);
            header('Location: ' . BASE_URL . 'citas');
            exit;
        }
    }
}