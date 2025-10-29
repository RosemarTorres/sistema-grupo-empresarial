<?php
$busqueda = $_GET['busqueda'] ?? '';
$filtroEmpresa = $_GET['empresa'] ?? '';

$trabajadoresFiltrados = array_filter($trabajadores, function ($trabajador) use ($busqueda, $filtroEmpresa) {
    $matchBusqueda = true;
    $matchEmpresa = true;

    if ($busqueda) {
        $matchBusqueda = stripos($trabajador->nombres, $busqueda) !== false
                      || stripos($trabajador->apellidos, $busqueda) !== false
                      || stripos($trabajador->cedula, $busqueda) !== false;
    }

    if ($filtroEmpresa) {
        $matchEmpresa = $trabajador->empresa === $filtroEmpresa;
    }

    return $matchBusqueda && $matchEmpresa;
});
?>

<h1 class="perfil__heading">Trabajadores Registrados</h1>

<!-- Filtros -->
<div class="filtros">
    <form method="GET" class="filtros__formulario">
        <input type="text" name="busqueda" placeholder="Buscar por nombre, apellido o cédula" value="<?= htmlspecialchars($busqueda) ?>">
        <select name="empresa">
            <option value="">-- Filtrar por empresa --</option>
            <option value="xeax-alimentos" <?= $filtroEmpresa === 'xeax-alimentos' ? 'selected' : '' ?>>XEAX Alimentos</option>
            <option value="elicar" <?= $filtroEmpresa === 'elicar' ? 'selected' : '' ?>>Elicar</option>
            <option value="constructora-vialca" <?= $filtroEmpresa === 'constructora-vialca' ? 'selected' : '' ?>>Constructora Vialca</option>
            <option value="cosmos" <?= $filtroEmpresa === 'cosmos' ? 'selected' : '' ?>>Cosmos</option>
        </select>
        <button type="submit" class="boton-enviar">
            <i class="fas fa-search"></i> Buscar
        </button>
    </form>
</div>

<?php if (empty($trabajadoresFiltrados)) : ?>
    <p class="perfil__mensaje">No se encontraron resultados.</p>
<?php else : ?>
    <div class="tabla-trabajadores" style="width: 1400px; margin: 0 auto; display: block; padding-left: 15px; ">
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre y Apellido</th>
                    <th>Empresa</th>
                    <th>Documentos</th>
                    <th><i class="fas fa-user"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trabajadoresFiltrados as $trabajador): ?>
                    <tr
                     <?php if($trabajador->registro_via_correo == 1 && !$trabajador->notificacion_vista): ?>
                            class="fila-resaltada"
                            id="resaltado"
                        <?php endif; ?>
                    >
                        <td><?= $trabajador->id ?></td>
                        <td><?= $trabajador->nombres . ' ' . $trabajador->apellidos ?></td>
                        <td><?= $trabajador->empresa ?></td>
                      <td>
                        <?php
                                $alerta = false;

                                $documentos = [
                                    'rif' => [
                                        'vencimiento' => $trabajador->rif_vencimiento ?? null,
                                        'archivo' => $trabajador->rif_archivo ?? null
                                    ],
                                    'cedula' => [
                                        'vencimiento' => $trabajador->cedula_vencimiento ?? null,
                                        'archivo' => $trabajador->cedula_archivo ?? null
                                    ],
                            
                                ];

                                foreach ($documentos as $doc) {
                                    // Documento no adjuntado
                                    if (empty($doc['archivo'])) {
                                        $alerta = true;
                                        break;
                                    }

                                    // Fecha de vencimiento inválida o vencida
                                    if (empty($doc['vencimiento']) || strtotime($doc['vencimiento']) < strtotime(date('Y-m-d'))) {
                                        $alerta = true;
                                        break;
                                    }
                                }

                                if ($alerta) {
                                    echo '<span class="tooltip">
                                       <img src="/img/icons/warning.svg" alt="Alerta" class="icono-alerta" />
                                        <span class="tooltiptext">Hay documentos vencidos o no adjuntados</span>
                                    </span>';
                                } else {
                                    echo '<span class="tooltip">
                                        <img src="/img/icons/check.svg" alt="Correcto" class="icono-ok" />
                                        <span class="tooltiptext">Todos los documentos están vigentes y adjuntados</span>
                                    </span>';
                                }
                                ?>
                        </td>
                        <td>
                            <a href="/admin/perfil-individual?id=<?= $trabajador->id ?>" class="boton-azul">Ver Perfil</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

