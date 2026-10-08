<?php
class Router {
    private $rutas = [];

    public function get($uri, $accion) {
        $this->rutas['GET'][trim($uri, '/')] = $accion;
    }

    public function post($uri, $accion) {
        $this->rutas['POST'][trim($uri, '/')] = $accion;
    }

    public function ejecutar() {
        // 1. Obtener la URI completa
        $uri = $_SERVER['REQUEST_URI'];
        
        // 2. Eliminar query strings si existen (ej: ?id=1)
        if (($pos = strpos($uri, '?')) !== false) {
            $uri = substr($uri, 0, $pos);
        }
        
        // 3. Obtener la base del proyecto (ej: /barbershop/public/)
        $base = parse_url(BASE_URL, PHP_URL_PATH);
        
        // 4. Si la URI comienza con la base, la recortamos
        if ($base !== '/' && strpos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }
        
        // 5. Limpiar slashes al inicio y final
        $uri = trim($uri, '/');
        
        // 6. Si por alguna razón queda "index.php", lo convertimos en vacío
        if ($uri === 'index.php' || $uri === 'index.php/') {
            $uri = '';
        }

        $method = $_SERVER['REQUEST_METHOD'];


        // 7. Buscar la ruta
        if (isset($this->rutas[$method][$uri])) {
            $accion = $this->rutas[$method][$uri];
            [$controlador, $metodo] = explode('@', $accion);
            
            $archivo = __DIR__ . '/../controlador/' . $controlador . '.php';
            
            if (file_exists($archivo)) {
                require_once $archivo;
                $obj = new $controlador();
                $obj->$metodo();
            } else {
                die("Error: No se encontró el archivo del controlador en: $archivo");
            }
        } else {
            http_response_code(404);
            echo "<h1>404 - Página no encontrada</h1>";
            echo "<p>Ruta solicitada: <strong>$uri</strong></p>";
            echo "<p><a href='" . BASE_URL . "'>Ir al inicio</a></p>";
        }
    }
}