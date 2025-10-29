<?php
/** @var \Model\FormularioTrabajador $trabajador */

// Normaliza nombre de empresa
$empresa_slug = strtolower(trim($trabajador->empresa));
$empresa_nombre = ucwords(str_replace('-', ' ', $empresa_slug));

// Ruta del logo local
$logoPath = __DIR__ . "/../../../public/build/img/{$empresa_slug}.jpeg";
$logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : '';

// Colores personalizados
$colores = [
    'cosmos' => '#dc0202',
    'constructora-vialca' => '#f65e10',
    'xeax-alimentos' => '#00c08f',
];
$colorEmpresa = $colores[$empresa_slug] ?? '#333';
?>
<?php
if (isset($_GET['print'])) {
    echo '<script>window.onload = function() { window.print(); };</script>';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Planilla de Ingreso - <?= $empresa_nombre ?></title>
    <style>
        @page {
            margin: 100px 40px 60px 40px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            color: #000;
        }

        header {
            position: fixed;
            top: -80px;
            left: 0;
            right: 0;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-bottom: 2px solid <?= $colorEmpresa ?>;
        }

        .logo img {
            max-height: 60px;
        }

        .titulo {
            flex-grow: 1;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: <?= $colorEmpresa ?>;
        }

        footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 11px;
            color: #777;
        }

        footer::after {
            content: "Página {PAGE_NUM} de {PAGE_COUNT}";
        }

        h2, .section-title {
            background-color: <?= $colorEmpresa ?>;
            color:white;
            padding: 6px 10px;
            margin-top: 20px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
            margin-bottom: 15px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>

<header>
    <div class="logo">
        <?php if (!empty($logoBase64)) : ?>
            <img src="data:image/png;base64,<?= $logoBase64 ?>" alt="Logo de <?= $empresa_nombre ?>">
        <?php endif; ?>
    </div>
    <div class="titulo">Planilla de Ingreso - <?= $empresa_nombre ?></div>
</header>

<footer></footer>

<main>
    <div class="section-title">Datos Personales</div>
    <table>
        <tr><th>Nombres</th><td><?= $trabajador->nombres ?></td></tr>
        <tr><th>Apellidos</th><td><?= $trabajador->apellidos ?></td></tr>
        <tr><th>Sexo</th><td><?= $trabajador->sexo ?></td></tr>
        <tr><th>Nacionalidad</th><td><?= $trabajador->nacionalidad ?></td></tr>
        <tr><th>Fecha de Nacimiento</th><td><?= $trabajador->fecha_nacimiento ?></td></tr>
        <tr><th>Edad</th><td><?= $trabajador->edad ?></td></tr>
        <tr><th>Cédula</th><td><?= $trabajador->cedula ?></td></tr>
        <tr><th>Estado Civil</th><td><?= $trabajador->estado_civil ?></td></tr>
        <tr><th>Lugar de Nacimiento</th><td><?= $trabajador->lugar_nacimiento ?></td></tr>
        <tr><th>Número de Hijos</th><td><?= $trabajador->numero_hijos ?></td></tr>
    </table>

    <div class="section-title">Contacto</div>
    <table>
        <tr><th>Correo</th><td><?= $trabajador->correo ?></td></tr>
        <tr><th>Teléfono</th><td><?= $trabajador->telefono ?></td></tr>
        <tr><th>Teléfono Emergencia</th><td><?= $trabajador->telefono_emergencia ?></td></tr>
        <tr><th>Dirección</th><td><?= $trabajador->direccion ?></td></tr>
    </table>
    <div class="section-title">Datos Físicos</div>
    <table>
        <tr><th>Talla de Camisa</th><td><?= $trabajador->talla_camisa ?></td></tr>
        <tr><th>Talla de Pantalón</th><td><?= $trabajador->talla_pantalon ?></td></tr>
        <tr><th>Talla de Calzado</th><td><?= $trabajador->talla_calzado ?></td></tr>
        <tr><th>Peso</th><td><?= $trabajador->peso ?> Kg</td></tr>
        <tr><th>Estatura</th><td><?= $trabajador->estatura ?> m</td></tr>
        <tr><th>Tipo de Sangre</th><td><?= $trabajador->tipo_sangre ?></td></tr>
        <tr><th>Alergias</th><td><?= $trabajador->alergias ?></td></tr>
    </table>
    <div class="section-title">Situación Habitacional</div>
    <table>
        <tr><th>Tenencia de Vivienda</th><td><?= $trabajador->tenencia_vivienda ?></td></tr>
        <tr><th>Vehículo Propio</th><td><?= $trabajador->vehiculo_propio ? 'Sí' : 'No' ?></td></tr>
        <tr><th>Licencia de Conducir</th><td><?= $trabajador->licencia_conducir ? 'Sí' : 'No' ?></td></tr>
    </table>



    <div class="section-title">Formación y Experiencia</div>
    <table>
        <tr><th>Formación Académica</th><td><?= $trabajador->informacion_academica ?></td></tr>
        <tr><th>Formación Complementaria</th><td><?= $trabajador->formacion_complementaria ?></td></tr>
        <tr><th>Experiencia Laboral</th><td><?= $trabajador->experiencia_laboral ?></td></tr>
        <tr><th>Áreas de Interés</th><td><?= $trabajador->areas_interes ?></td></tr>
    </table>
    <div class="section-title">Información Empresarial</div>
    <table>
        <tr><th>Empresa</th><td><?= $trabajador->empresa ?></td></tr>
        <tr><th>Departamento</th><td><?= $trabajador->departamento ?></td></tr>
        <tr><th>Supervisor Inmediato</th><td><?= $trabajador->supervisor_inmediato ?></td></tr>
        <tr><th>Fecha de Ingreso</th><td><?= $trabajador->fecha_ingreso ?></td></tr>
    </table>

    <div class="section-title">Documentos Adjuntos</div>
    <table>
        <tr>
            <th>Documento</th>
            <th>Fecha de Vencimiento</th>
            <th>Adjunto</th>
        </tr>
        <tr>
            <td>RIF</td>
            <td><?= $trabajador->rif_vencimiento ?? 'N/A' ?></td>
            <td><?= empty($trabajador->rif_archivo) ? 'No' : 'Sí' ?></td>
        </tr>
        <tr>
            <td>Cédula</td>
            <td><?= $trabajador->cedula_vencimiento ?? 'N/A' ?></td>
            <td><?= empty($trabajador->cedula_archivo) ? 'No' : 'Sí' ?></td>
        </tr>
    </table>
</main>

</body>
</html>

