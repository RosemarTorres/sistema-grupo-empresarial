
<?php
/** @var \Model\FormularioTrabajador $trabajador */
?>

<div class="perfil-trabajador" style="width: 1400px;
    margin: 0 auto;
    display: block;" >
    

    <div class="perfil-trabajador__contenido" >
        <h1 class="perfil-trabajador__titulo">Perfil del Trabajador</h1>

        <div class="perfil-trabajador__seccion">
            <h2>Datos Personales</h2>
            <p><strong>Nombre completo:</strong> <?= $trabajador->nombres . ' ' . $trabajador->apellidos ?></p>
            <p><strong>Sexo:</strong> <?= $trabajador->sexo ?></p>
            <p><strong>Nacionalidad:</strong> <?= $trabajador->nacionalidad ?></p>
            <p><strong>Fecha de nacimiento:</strong> <?= $trabajador->fecha_nacimiento ?></p>
            <p><strong>Edad:</strong> <?= $trabajador->edad ?></p>
            <p><strong>Cédula:</strong> <?= $trabajador->cedula ?></p>
            <p><strong>Estado civil:</strong> <?= $trabajador->estado_civil ?></p>
            <p><strong>Lugar de nacimiento:</strong> <?= $trabajador->lugar_nacimiento ?></p>
            <p><strong>Número de hijos:</strong> <?= $trabajador->numero_hijos ?></p>
        </div>

        <div class="perfil-trabajador__seccion">
            <h2>Contacto</h2>
            <p><strong>Correo:</strong> <?= $trabajador->correo ?></p>
            <p><strong>Teléfono:</strong> <?= $trabajador->telefono ?></p>
            <p><strong>Tel. Emergencia:</strong> <?= $trabajador->telefono_emergencia ?></p>
            <p><strong>Dirección:</strong> <?= $trabajador->direccion ?></p>
        </div>

        <div class="perfil-trabajador__seccion">
            <h2>Datos Físicos</h2>
            <p><strong>Talla de camisa:</strong> <?= $trabajador->talla_camisa ?></p>
            <p><strong>Talla de pantalón:</strong> <?= $trabajador->talla_pantalon ?></p>
            <p><strong>Talla de calzado:</strong> <?= $trabajador->talla_calzado ?></p>
            <p><strong>Peso:</strong> <?= $trabajador->peso ?> Kg</p>
            <p><strong>Estatura:</strong> <?= $trabajador->estatura ?> m</p>
            <p><strong>Tipo de sangre:</strong> <?= $trabajador->tipo_sangre ?></p>
            <p><strong>Alergias:</strong> <?= $trabajador->alergias ?></p>
        </div>

        <div class="perfil-trabajador__seccion">
            <h2>Situación Habitacional</h2>
            <p><strong>Tenencia de vivienda:</strong> <?= $trabajador->tenencia_vivienda ?></p>
            <p><strong>Vehículo propio:</strong> <?= $trabajador->vehiculo_propio ? 'Sí' : 'No' ?></p>
            <p><strong>Licencia de conducir:</strong> <?= $trabajador->licencia_conducir ? 'Sí' : 'No' ?></p>
        </div>

        <div class="perfil-trabajador__seccion">
            <h2>Información Académica y Laboral</h2>
            <p><strong>Información familiar:</strong> <?= $trabajador->informacion_familiar ?></p>
            <p><strong>Formación académica:</strong> <?= $trabajador->informacion_academica ?></p>
            <p><strong>Formación complementaria:</strong> <?= $trabajador->formacion_complementaria ?></p>
            <p><strong>Experiencia laboral:</strong> <?= $trabajador->experiencia_laboral ?></p>
            <p><strong>Áreas de interés:</strong> <?= $trabajador->areas_interes ?></p>
        </div>

        <div class="perfil-trabajador__seccion">
            <h2>Información Empresarial</h2>
            <p><strong>Empresa:</strong> <?= $trabajador->empresa ?></p>
            <p><strong>Departamento:</strong> <?= $trabajador->departamento ?></p>
            <p><strong>Supervisor inmediato:</strong> <?= $trabajador->supervisor_inmediato ?></p>
            <p><strong>Fecha de ingreso:</strong> <?= $trabajador->fecha_ingreso ?></p>
        </div>
    
        <div class="perfil-trabajador__seccion">
    <h2>Documentos Adjuntos</h2>
    <?php
        $documentos = [
            'RIF' => ['vencimiento' => $trabajador->rif_vencimiento ?? '', 'archivo' => $trabajador->rif_archivo ?? ''],
            'Cédula' => ['vencimiento' => $trabajador->cedula_vencimiento ?? '', 'archivo' => $trabajador->cedula_archivo ?? ''],
            
        ];

        foreach ($documentos as $nombre => $datos) {
            $fecha = $datos['vencimiento'];
            $archivo = $datos['archivo'];
            $icono = '';
            $mensaje = '';
            $accion = '';

            if (empty($archivo)) {
                $icono = ' <img src="/img/icons/exclamacion.svg" alt="Alerta" class="icono-alerta" />';
                $mensaje = 'No adjuntado';
            } elseif (empty($fecha) || strtotime($fecha) < time()) {
                $icono = '<img src="/img/icons/exclamacion.svg" alt="Alerta" class="icono-alerta" />';
                $mensaje = 'Vencido o sin fecha';
                $accion = '<a href="/documentos/' . htmlspecialchars($archivo) . '" target="_blank" class="boton boton-pequeno">Ver</a>';
            } else {
                $icono = '<img src="/img/icons/check.svg" alt="Correcto" class="icono-ok" />';
                $mensaje = 'Vigente';
                $accion = '<a href="/documentos/' . htmlspecialchars($archivo) . '" target="_blank" class="boton boton-pequeno">Ver</a>';
            }

            echo '<p>';
            echo '<strong>' . $nombre . ':</strong> ';
            echo '<span class="tooltip">' . $icono . '<span class="tooltiptext">Estado: ' . $mensaje . '</span></span> ';
            if (!empty($fecha)) {
                echo '<span class="fecha-vencimiento">Vence: ' . htmlspecialchars($fecha) . '</span> ';
            }
            echo $accion;
            echo '</p>';
        }
    ?>
</div>

    <div class="perfil-trabajador__acciones">
       <div> <a href="/admin/editar-perfil?id=<?= $trabajador->id ?>" class="boton editar">
            <i class="fas fa-edit"></i> Editar
        </a>
        </div>
        <div>
        <form method="POST" action="/admin/dashboard/eliminar-perfil" onsubmit="return confirm('¿Estás seguro de eliminar este perfil?');">
            <input type="hidden" name="id" value="<?= $trabajador->id ?>">
            <button type="submit" class="boton eliminar">
                <i class="fas fa-trash-alt"></i> Eliminar
            </button>
        </form>
        </div>

        <div>
        <button onclick="window.print()" class="boton imprimir">
        <i class="fas fa-print"></i> Imprimir
        </button>
        </div>

     <div>
       <a href="/admin/dashboard/perfil-pdf?id=<?= $trabajador->id ?>" class="boton pdf">
          <i class="fas fa-file-pdf"></i> Descargar PDF
       </a>
      </div>
      <div>
        <a href="/admin/perfil-trabajador" class="boton">
             Regresar
        </a>
      </div>

    </div>
</div>
<script>
    // Script para manejar la impresión del perfil
    document.querySelector('.boton.imprimir').addEventListener('click', function() {
        window.print();
    });
