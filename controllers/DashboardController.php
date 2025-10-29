<?php

namespace Controllers;

use Model\FormularioTrabajador;

Use Classes\Email;
use MVC\Router;
use Dompdf\Dompdf;
use Dompdf\Options;

class DashboardController {
    
    public static function index(Router $router) {
     $router->render('admin/dashboard/index', [
         'titulo' => 'Panel de Administración'
     ]);

    }

       public static function llenarPlanilla(Router $router) {
    session_start();
    $empresa = $_GET['empresa'] ?? '';

    if (empty($empresa)) {
        header('Location: /admin/dashboard');
        exit;
    }

    $alertas = [];
    $formulario = new FormularioTrabajador();

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formulario->sincronizar($_POST);
   $formulario->registro_via_correo = $_POST['registro_via_correo'] ?? 0;
    $formulario->empresa = $empresa;
    $formulario->fecha_creacion = date('Y-m-d H:i:s');
    $formulario->rif_vencimiento = $_POST['rif_vencimiento'] ?? null;
    $formulario->cedula_vencimiento = $_POST['cedula_vencimiento'] ?? null;
    




    // Manejar archivos
    $documentos = [
    'rif' => 'documento_rif',
    'cedula' => 'documento_cedula'
];

// Archivos: rif_archivo y cedula_archivo
$documentos = ['rif_archivo', 'cedula_archivo'];

foreach ($documentos as $campo) {
    if (!empty($_FILES[$campo]['name'])) {
        $nombreArchivo = uniqid() . '_' . $_FILES[$campo]['name'];
        $rutaDestino = __DIR__ . "/../public/documentos/" . $nombreArchivo;

        if (move_uploaded_file($_FILES[$campo]['tmp_name'], $rutaDestino)) {
            $formulario->{$campo} = $nombreArchivo;
        }
    }
}

    $resultado = $formulario->guardar();

    if ($resultado) {
        header('Location: /admin/perfil-trabajador');
        exit;
    } else {
        $alertas[] = 'Error al guardar la planilla.';
    }
}

    $router->render('admin/llenar-planilla', [
        'titulo' => 'Llenar Planilla - ' . $empresa,
        'empresa' => $empresa,
        'formulario' => $formulario,
        'alertas' => $alertas
    ]);
}
        public static function perfiltrabajador(Router $router) {
            $busqueda = $_GET['busqueda'] ?? '';
            $empresa = $_GET['empresa'] ?? '';

            $condiciones = [];
            $parametros = [];

            if (!empty($busqueda)) {
                $condiciones[] = "(nombres LIKE ? OR apellidos LIKE ? OR cedula LIKE ?)";
                $parametros[] = "%$busqueda%";
                $parametros[] = "%$busqueda%";
                $parametros[] = "%$busqueda%";
            }

            if (!empty($empresa)) {
                $condiciones[] = "empresa = ?";
                $parametros[] = $empresa;
            }

            $sql = "SELECT * FROM planilla";
            if (!empty($condiciones)) {
                $sql .= " WHERE " . implode(' AND ', $condiciones);
            }
            $sql .= " ORDER BY fecha_creacion DESC";

            $trabajadores = FormularioTrabajador::consultarSQL($sql, $parametros);

            $router->render('admin/perfil-trabajador', [
                'titulo' => 'Perfil de Trabajadores',
                'trabajadores' => $trabajadores,
            ]);
        }


    public static function guardarPlanilla() {
        session_start();
        $formulario = new FormularioTrabajador($_POST);
        $formulario->empresa = $_SESSION['empresa'] ?? '';
        $formulario->fecha_creacion = date('Y-m-d H:i:s');

        $resultado = $formulario->guardar();

        if ($resultado) {
            header('Location: /admin/perfil-trabajador');
            exit;
        } else {
            echo json_encode(['error' => 'Error al guardar la planilla.']);
            exit;
        }
    }

    public static function perfilIndividual($router) {
    $id = $_GET['id'] ?? null;
    if(!$id) {
        header('Location: /admin/perfil-trabajador');
        exit;
    }
    $trabajador = FormularioTrabajador::find($id);
    if(!$trabajador) {
        header('Location: /admin/perfil-trabajador');
        exit;
    }
    $router->render('admin/perfil-individual', [
        'trabajador' => $trabajador
    ]);
}

    public static function perfilDetalle(Router $router) {
    session_start();

    $id = $_GET['id'] ?? null;

    if (!$id || !is_numeric($id)) {
        header('Location: /admin/perfil-trabajador');
        exit;
    }

    $trabajador = FormularioTrabajador::find($id);

    if (!$trabajador) {
        header('Location: /admin/perfil-trabajador');
        exit;
    }
    

    $router->render('admin/perfil-individual', [
        'titulo' => 'Perfil del Trabajador',
        'trabajador' => $trabajador
    ]);
}
    

public static function perfilPDF(Router $router) {
    $id = $_GET['id'] ?? null;


    if (!$id || !is_numeric($id)) {
       
        header('Location: /admin/dashboard/perfil-trabajador');
        exit;
    }

    $trabajador = FormularioTrabajador::find($id);

    if (!$trabajador) {
        header('Location: /admin/dashboard/perfil-trabajador');
        exit;
    }

    // Generar HTML
    ob_start();
    include __DIR__ . '/../views/admin/pdf/perfil-pdf.php';
    $html = ob_get_clean();

    // Crear PDF con Dompdf
    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // Descargar PDF
    $dompdf->stream('Perfil-Trabajador-' . $trabajador->nombres . '.pdf', [
        'Attachment' => true
    ]);
}

    

    public static function editarPerfil($router) {
    $id = $_GET['id'] ?? null;
    if(!$id) {
        header('Location: /admin/perfil-trabajador');
        exit;
    }
    $trabajador = \Model\FormularioTrabajador::find($id);
    if(!$trabajador) {
        header('Location: /admin/perfil-trabajador');
        exit;
    }

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $trabajador->sincronizar($_POST);
        $resultado = $trabajador->guardar();
        error_log('Resultado de guardar: ' . print_r($resultado, true));
        header('Location: /admin/perfil-individual?id=' . $trabajador->id);
        exit;
    }

    $router->render('admin/editar-perfil', [
        'trabajador' => $trabajador
    ]);
}

    
    public static function enviarLink(Router $router) { 
        $empresa = $_GET['empresa'] ?? '';
        $alertas = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $correo = $_POST['correo'] ?? '';
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $link = $_ENV['HOST'] . "/llenar-planilla?empresa=" . urlencode($empresa) . "&viaCorreo=1";


                // Personalización del mensaje
                $empresaNombre = ucwords(str_replace('-', ' ', $empresa));
                $mensaje = "
                    <p><strong>¡Bienvenido/a al Holding!</strong></p>
                    <p>Nos complace tenerte con nosotros y estamos emocionados por tu incorporación al equipo.</p>
                    <p>Para completar tu proceso de ingreso, te pedimos que llenes la planilla adjunta con la información necesaria:</p>
                    <p><a href='$link'>Planilla de Ingreso</a></p>
                    <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>
                    <p>¡Esperamos verte pronto!</p>
                    <br>
                    <p>Saludos cordiales,</p>
                    <p><strong>Coordinación de Recursos Humanos</strong><br>
                    $empresaNombre<br>
                    Teléfono: [Teléfono]<br>
                    Correo: [Correo Electrónico]</p>
                ";

                $email = new Email($correo, $empresaNombre, null);
                $email->enviarFormularioPersonalizado($mensaje, "Planilla de Ingreso - $empresaNombre");

                //  Renderizar directamente la vista de éxito
                $router->render('auth/mensaje-enviado', [
                    'titulo' => 'Correo Enviado Exitosamente'
                ]);
                return;
            } else {
                $alertas['error'] = 'Correo inválido.';
            }
        }

        $router->render('admin/enviar-link', [
            'empresa' => $empresa,
            'alertas' => $alertas
        ]);
    }

    public static function apiEstadisticas() {
    $tipo = $_GET['tipo'] ?? 'dia';

    switch($tipo) {
        case 'mes':
            $datos = FormularioTrabajador::estadisticasPorMes();
            break;
        case 'anio':
            $datos = FormularioTrabajador::estadisticasPorAnio();
            break;
        default:
            $datos = FormularioTrabajador::estadisticasPorDia();
    }

    header('Content-Type: application/json');
    echo json_encode($datos);
}

        public static function descargarReportePDF() {
        $filtro = $_GET['filtro'] ?? null;
        $todos = FormularioTrabajador::all();
        $trabajadores = [];

        $hoy = date('Y-m-d');
        $mesActual = date('Y-m');
        $anioActual = date('Y');

        foreach ($todos as $trabajador) {
            $fecha = substr($trabajador->fecha_creacion, 0, 10); // Formato: YYYY-MM-DD

            if ($filtro === 'dia' && $fecha === $hoy) {
                $trabajadores[] = $trabajador;
            } elseif ($filtro === 'mes' && strpos($fecha, $mesActual) === 0) {
                $trabajadores[] = $trabajador;
            } elseif ($filtro === 'anio' && strpos($fecha, $anioActual) === 0) {
                $trabajadores[] = $trabajador;
            } elseif (!$filtro) {
                // Sin filtro = incluir todos
                $trabajadores[] = $trabajador;
            }
        }

        // Inicia generación PDF
        ob_start();
        include __DIR__ . '/../views/admin/pdf/reporte-estadisticas.php';
        $html = ob_get_clean();

        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('reporte-ingreso-trabajadores.pdf', ['Attachment' => true]);
    }

  //  API para obtener trabajadores no notificados
     //**
     
    public static function apiNotificaciones() {
        $trabajadores = FormularioTrabajador::trabajadoresNoNotificados();
        echo json_encode($trabajadores);
    }

    public static function apiMarcarNotificaciones() {
    $trabajadores =FormularioTrabajador::marcarNotificacionesComoVistas();
    echo json_encode(['success' => true]);
}
  public static function marcarNotificacionesLeidas() {
    $trabajadores = FormularioTrabajador::marcarNotificacionesComoVistas();
    echo json_encode(['status' => 'ok']);
}

}





