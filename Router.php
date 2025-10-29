<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    public function comprobarRutas()
    {
        // Obtener URL y método de forma más confiable
        $url_actual = $_SERVER['REQUEST_URI'] ?? '/';
        $url_actual = strtok($url_actual, '?'); // Eliminar query params
        $method = $_SERVER['REQUEST_METHOD'];

        // Normalizar URL
        $url_actual = rtrim($url_actual, '/');
        if ($url_actual === '') {
            $url_actual = '/';
        }

        // Buscar la ruta correspondiente
        if ($method === 'GET') {
            $fn = $this->getRoutes[$url_actual] ?? null;
        } else {
            $fn = $this->postRoutes[$url_actual] ?? null;
        }

        if ($fn) {
            call_user_func($fn, $this);
        } else {
            // Debug: Mostrar rutas disponibles
            error_log("Rutas GET disponibles: " . print_r(array_keys($this->getRoutes), true));
            error_log("Rutas POST disponibles: " . print_r(array_keys($this->postRoutes), true));
            error_log("URL solicitada: " . $url_actual);
            
            http_response_code(404);
            echo "Página No Encontrada o Ruta no válida";
        }
    }

    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        // Verificar si la vista existe
        $viewPath = __DIR__ . "/views/$view.php";
        if (!file_exists($viewPath)) {
            error_log("Vista no encontrada: " . $viewPath);
            throw new \Exception("La vista $view no existe");
        }

        ob_start();
        include $viewPath;
        $contenido = ob_get_clean();

        // Determinar layout
        $url_actual = $_SERVER['REQUEST_URI'] ?? '/';
        $layout = str_contains($url_actual, '/admin') ? 'admin-layout.php' : 'layout.php';
        $layoutPath = __DIR__ . "/views/$layout";

        if (!file_exists($layoutPath)) {
            error_log("Layout no encontrado: " . $layoutPath);
            throw new \Exception("El layout $layout no existe");
        }

        include $layoutPath;
    }

}
