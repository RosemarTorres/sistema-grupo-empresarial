
<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\AuthController;
use Controllers\DashboardController;

$router = new Router();

// -----------------------------------------------
// Rutas de Autenticación
// -----------------------------------------------

//LOGIN
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

//FORMULARIO DE REGISTRO
$router->get('/registro', [AuthController::class, 'registro']);
$router->post('/registro', [AuthController::class, 'registro']);

//FORMULARIO DE OLVIDO PASSWORD
$router->get('/olvide', [AuthController::class, 'olvide']);
$router->post('/olvide', [AuthController::class, 'olvide']);

//COLOCAR EL NUEVO PASSWORD
$router->get('/reestablecer', [AuthController::class, 'reestablecer']);
$router->post('/reestablecer', [AuthController::class, 'reestablecer']);

//CONFIRMAR LA CUENTA
$router->get('/mensaje', [AuthController::class, 'mensaje']);
$router->get('/confirmar-cuenta', [AuthController::class, 'confirmar']);

//AREA DE ADMINISTRACION
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

//LLENAR PLANILLA
$router->get('/llenar-planilla', [DashboardController::class, 'llenarPlanilla']);
$router->post('/llenar-planilla', [DashboardController::class, 'llenarPlanilla']);

//perfil trabajador
$router->get('/admin/perfil-trabajador', [DashboardController::class, 'perfiltrabajador']);
//perfil individual
$router->get('/admin/perfil-individual', [DashboardController::class, 'perfilIndividual']);

//perfil PDF
$router->get('/admin/dashboard/perfil-pdf', [DashboardController::class, 'perfilPDF']);

//perfil PDF para imprimir
$router->get('/admin/dashboard/perfil-print', [DashboardController::class, 'perfilPrint']);

//editar perfil trabajador
$router->get('/admin/editar-perfil', [DashboardController::class, 'editarPerfil']);
$router->post('/admin/editar-perfil', [DashboardController::class, 'editarPerfil']);


//eliminar perfil trabajador
$router->post('/admin/dashboard/eliminar-perfil', [DashboardController::class, 'eliminarPerfil']);

$router->get('/admin/dashboard/perfil', [DashboardController::class, 'perfilDetalle']);

//enviar link de planilla
$router->get('/enviar-link', [DashboardController::class, 'enviarLink']);
$router->post('/enviar-link', [DashboardController::class, 'enviarLink']);

//enviar mensaje de confirmación correo
$router->get('/auth/mensaje-enviado', [DashboardController::class, 'enviarLink']);

// API para obtener estadísticas
$router->get('/api/estadisticas', [DashboardController::class, 'apiEstadisticas']);

//descargar reporte PDF
$router->get('/admin/descargar-reporte', [DashboardController::class, 'descargarReportePDF']);

// API notificaciones
$router->get('/api/notificaciones', [DashboardController::class, 'apiNotificaciones']);
$router->post('/api/notificaciones/leidas', [DashboardController::class, 'apiMarcarNotificaciones']);




$router->comprobarRutas();