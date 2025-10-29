

<?php
setlocale(LC_TIME, 'es_ES.UTF-8'); // Para nombres de mes/día en español
date_default_timezone_set('America/Caracas'); // Ajusta tu zona si es distinta

$fechaDescarga = date('d/m/Y');

$registrosHoy = 0;
$registrosMes = 0;
$registrosAnio = 0;

$hoy = date('Y-m-d');
$mesActual = date('Y-m');
$anioActual = date('Y');

foreach ($trabajadores as $trabajador) {
    $fechaIngreso = substr($trabajador->fecha_creacion, 0, 10); // Asegúrate de que venga como YYYY-MM-DD

    if ($fechaIngreso === $hoy) $registrosHoy++;
    if (strpos($fechaIngreso, $mesActual) === 0) $registrosMes++;
    if (strpos($fechaIngreso, $anioActual) === 0) $registrosAnio++;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 10px;
            margin-bottom: 10px;
        }

        header img {
            height: 70px;
            margin-bottom: 5px;
        }

        h1 {
            margin: 0;
            font-size: 18px;
        }

        .fecha {
            text-align: right;
            margin: 10px 20px 0 0;
            font-style: italic;
            font-size: 12px;
        }

        .resumen {
            margin: 10px 20px 20px 20px;
            font-size: 13px;
        }

        .resumen strong {
            display: inline-block;
            min-width: 150px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto 20px;
        }

        table, th, td {
            border: 1px solid #999;
        }

        th {
            background-color: #eaeaea;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #00bf8e;
            color: white;
            text-align: center;
            font-size: 11px;
            padding: 10px;
        }

        .contenido {
            margin: 0 20px 60px;
        }
    </style>
</head>
<body>

<header>
    <?php
    $logoPath = __DIR__ . '/../../../public/build/img/empresas-logo.jpeg';
    $logoBase64 = file_exists($logoPath) ? base64_encode(file_get_contents($logoPath)) : '';
    ?>
    <?php if ($logoBase64): ?>
        <img src="data:image/jpeg;base64,<?= $logoBase64 ?>" alt="Logo Grupo L&H" height="70">
    <?php endif; ?>
    <h1>Reporte de Ingreso de Planillas</h1>
</header>

<div class="fecha">
    Fecha del Reporte: <?= $fechaDescarga ?>
</div>

<div class="resumen">
    <p><strong>Registros del día:</strong> <?= $registrosHoy ?></p>
    <p><strong>Registros del mes:</strong> <?= $registrosMes ?></p>
    <p><strong>Registros del año:</strong> <?= $registrosAnio ?></p>
</div>

<div class="contenido">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombres y Apellidos</th>
                <th>Edad</th>
                <th>Cédula</th>
                <th>Empresa</th>
                <th>Cargo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($trabajadores as $trabajador): ?>
                <tr>
                    <td><?= $trabajador->id ?></td>
                    <td><?= $trabajador->nombres . ' ' . $trabajador->apellidos ?></td>
                    <td><?= $trabajador->edad ?></td>
                    <td><?= $trabajador->cedula ?></td>
                    <td><?= ucwords(str_replace('-', ' ', $trabajador->empresa)) ?></td>
                    <td><?= $trabajador->departamento ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<footer>
    Av. Fermin Toro Grupo Empresarial LH. San Juan de los Morros, Estado Guárico <br>
    Correo: info@grupoempresarial.com | RIF: J413126621
</footer>

</body>
</html>

