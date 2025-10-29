<?php  
/** @var Router $router */
/** @var string $empresa */
/** @var array $alertas */
/** @var FormularioTrabajador $formulario */
?>

<div class="dashboard__formulario-ingreso">
    <h2 class="dashboard__formulario-titulo">
        <i class="fas fa-file-alt"></i> 
        Formulario de Ingreso - <?= htmlspecialchars($empresa) ?>
    </h2>
    
    <form method="POST" action="/llenar-planilla?empresa=<?= urlencode($empresa) ?>" enctype="multipart/form-data" class="dashboard__contenido">
        <input type="hidden" name="empresa" value="<?= htmlspecialchars($empresa) ?>">
            <?php if (isset($_GET['viaCorreo']) && $_GET['viaCorreo'] === '1'): ?>
                <input type="hidden" name="registro_via_correo" value="1">
            <?php endif; ?>

        <!-- Sección 1: Datos Personales -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-user"></i> Datos Personales</legend>

            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="nombres">Nombres*</label>
                    <input type="text" id="nombres" name="nombres" required>
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="apellidos">Apellidos*</label>
                    <input type="text" id="apellidos" name="apellidos" required>
                </div>
            </div>

            <div class="dashboard__triple-campos">
                <div class="dashboard__campo-formulario">
                    <label for="sexo">Sexo*</label>
                    <select id="sexo" name="sexo" required>
                        <option value="">Seleccionar...</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div class="dashboard__campo-formulario">
                    <label for="nacionalidad">Nacionalidad*</label>
                    <input type="text" id="nacionalidad" name="nacionalidad" required>
                </div>

                <div class="dashboard__campo-formulario">
                    <label for="fecha_nacimiento">Fecha Nacimiento*</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
                </div>
            </div>

            <div class="dashboard__triple-campos">
                <div class="dashboard__campo-formulario">
                    <label for="edad">Edad*</label>
                    <input type="number" id="edad" name="edad" required>
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="cedula">Cédula*</label>
                    <input type="text" id="cedula" name="cedula" required>
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="estado_civil">Estado Civil*</label>
                    <input type="text" id="estado_civil" name="estado_civil" required>
                </div>
            </div>

            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="lugar_nacimiento">Lugar de Nacimiento*</label>
                    <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" required>
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="numero_hijos">Número de Hijos*</label>
                    <input type="number" id="numero_hijos" name="numero_hijos" required>
                </div>
            </div>
        </fieldset>

        <!-- Sección 2: Datos de Contacto -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-address-book"></i> Datos de Contacto</legend>

            <div class="dashboard__triple-campos">
                <div class="dashboard__campo-formulario">
                    <label for="correo">Correo Electrónico*</label>
                    <input type="email" id="correo" name="correo" required>
                </div>

                <div class="dashboard__campo-formulario">
                    <label for="telefono">Teléfono*</label>
                    <input type="tel" id="telefono" name="telefono" required>
                </div>

                <div class="dashboard__campo-formulario">
                    <label for="telefono_emergencia">Teléfono Emergencia*</label>
                    <input type="tel" id="telefono_emergencia" name="telefono_emergencia" required>
                </div>
            </div>

            <div class="dashboard__campo-formulario">
                <label for="direccion">Dirección Completa*</label>
                <textarea id="direccion" name="direccion" rows="3" required></textarea>
            </div>
        </fieldset>

        <!-- Sección 3: Información Física -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-ruler-combined"></i> Datos Físicos</legend>
            <div class="dashboard__triple-campos">
                <div class="dashboard__campo-formulario">
                    <label for="talla_camisa">Talla Camisa</label>
                    <input type="text" id="talla_camisa" name="talla_camisa">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="talla_pantalon">Talla Pantalón</label>
                    <input type="text" id="talla_pantalon" name="talla_pantalon">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="talla_calzado">Talla Calzado</label>
                    <input type="text" id="talla_calzado" name="talla_calzado">
                </div>
            </div>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="peso">Peso (kg)</label>
                    <input type="number" step="0.01" id="peso" name="peso">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="estatura">Estatura (m)</label>
                    <input type="number" step="0.01" id="estatura" name="estatura">
                </div>
            </div>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="tipo_sangre">Tipo de Sangre</label>
                    <input type="text" id="tipo_sangre" name="tipo_sangre">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="alergias">Alergias</label>
                    <input type="text" id="alergias" name="alergias">
                </div>
            </div>
        </fieldset>

        <!-- Sección 4: Información Adicional -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-home"></i> Información Adicional</legend>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="tenencia_vivienda">Tenencia Vivienda</label>
                    <input type="text" id="tenencia_vivienda" name="tenencia_vivienda">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="vehiculo_propio">Vehículo Propio</label>
                    <select id="vehiculo_propio" name="vehiculo_propio">
                        <option value="1">Sí</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="licencia_conducir">Licencia de Conducir</label>
                <select id="licencia_conducir" name="licencia_conducir">
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </div>
        </fieldset>

        <!-- Sección 5: Formación y Experiencia -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-university"></i> Formación y Experiencia</legend>
            <div class="dashboard__campo-formulario">
                <label for="informacion_familiar">Información Familiar</label>
                <textarea id="informacion_familiar" name="informacion_familiar"></textarea>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="informacion_academica">Formación Académica</label>
                <textarea id="informacion_academica" name="informacion_academica"></textarea>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="formacion_complementaria">Formación Complementaria</label>
                <textarea id="formacion_complementaria" name="formacion_complementaria"></textarea>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="experiencia_laboral">Experiencia Laboral</label>
                <textarea id="experiencia_laboral" name="experiencia_laboral"></textarea>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="areas_interes">Áreas de Interés</label>
                <textarea id="areas_interes" name="areas_interes"></textarea>
            </div>
        </fieldset>

        <!-- Sección 6: Información Laboral -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-briefcase"></i> Información Laboral</legend>

            <div class="dashboard__campo-formulario">
                <label for="departamento">Departamento*</label>
                <input type="text" id="departamento" name="departamento" required>
            </div>

            <div class="dashboard__campo-formulario">
                <label for="supervisor_inmediato">Supervisor Inmediato*</label>
                <input type="text" id="supervisor_inmediato" name="supervisor_inmediato" required>
                
            </div>
            <div class="dashboard__campo-formulario">
                <label for="fecha_ingreso">Fecha de Ingreso*</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" required>
                
            </div>
        </fieldset>
            <!-- Sección 7: Documentos Adjuntos -->
    <fieldset class="dashboard__seccion-formulario">
        <legend><i class="fas fa-paperclip"></i> Documentos Adjuntos</legend>

        <!-- Documento: RIF -->
        <div class="dashboard__doble-campos">
            <div class="dashboard__campo-formulario">
                <label for="rif_archivo">Adjuntar RIF*</label>
                <input type="file" id="rif_archivo" name="rif_archivo" accept=".pdf,.jpg,.jpeg,.png" required>
                <small class="dashboard__ayuda">Formatos: PDF, JPG, PNG (Máx. 5MB)</small>
                
            </div>
               <div class="dashboard__campo-formulario">
                <label for="rif_vencimiento">Fecha de Vencimiento del RIF</label>
                <input type="date" id="rif_vencimiento" name="rif_vencimiento">
                </div>
         </div>

        <!-- Documento: Cédula -->
        <div class="dashboard__doble-campos">
            <div class="dashboard__campo-formulario">
                <label for="cedula_archivo">Adjuntar Cédula*</label>
                <input type="file" id="cedula_archivo" name="cedula_archivo" accept=".pdf,.jpg,.jpeg,.png" required>
                <small class="dashboard__ayuda">Formatos: PDF, JPG, PNG (Máx. 5MB)</small>
            </div>
                <div class="dashboard__campo-formulario">
                <label for="cedula_vencimiento">Fecha de Vencimiento de la Cédula</label>
                <input type="date" id="cedula_vencimiento" name="cedula_vencimiento">
                </div>
        </div>
    </fieldset>


        <!-- Botón de envío -->
        <div class="dashboard__acciones-formulario">
            <button type="submit" class="boton-enviar">
                <i class="fas fa-save"></i> Guardar Planilla
            </button>
        </div>
    </form>
</div>
