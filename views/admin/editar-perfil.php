<?php /** @var \Model\FormularioTrabajador \$trabajador */ ?> 

<div class="dashboard__formulario-ingreso"  >
    <h2 class="dashboard__formulario-titulo">
        <i class="fas fa-user-edit"></i> Editar Perfil del Trabajador
    </h2>

    <form  method="POST" action="/admin/editar-perfil?id=<?= $trabajador->id ?>" enctype="multipart/form-data" class="dashboard__contenido" style="width: 1400px;
    margin: 0 auto;
    display: block;">
        <input type="hidden" name="id" value="<?= $trabajador->id ?>">

        <!-- Sección: Datos Personales -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-user"></i> Datos Personales</legend>

            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="nombres">Nombres</label>
                    <input type="text" id="nombres" name="nombres" value="<?= $trabajador->nombres ?>" required>
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" id="apellidos" name="apellidos" value="<?= $trabajador->apellidos ?>" required>
                </div>
            </div>

            <div class="dashboard__triple-campos">
                <div class="dashboard__campo-formulario">
                    <label for="sexo">Sexo</label>
                    <select id="sexo" name="sexo" required>
                        <option value="Masculino" <?= $trabajador->sexo === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                        <option value="Femenino" <?= $trabajador->sexo === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                        <option value="Otro" <?= $trabajador->sexo === 'Otro' ? 'selected' : '' ?>>Otro</option>
                    </select>
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="nacionalidad">Nacionalidad</label>
                    <input type="text" id="nacionalidad" name="nacionalidad" value="<?= $trabajador->nacionalidad ?>" required>
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="fecha_nacimiento">Fecha de nacimiento</label>
                    <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= $trabajador->fecha_nacimiento ?>" required>
                </div>
            </div>

            <div class="dashboard__triple-campos">
                <div class="dashboard__campo-formulario">
                    <label for="cedula">Cédula</label>
                    <input type="text" id="cedula" name="cedula" value="<?= $trabajador->cedula ?>" required>
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="edad">Edad</label>
                    <input type="number" id="edad" name="edad" value="<?= $trabajador->edad ?>">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="estado_civil">Estado Civil</label>
                    <input type="text" id="estado_civil" name="estado_civil" value="<?= $trabajador->estado_civil ?>">
                </div>
            </div>

            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="lugar_nacimiento">Lugar de Nacimiento</label>
                    <input type="text" id="lugar_nacimiento" name="lugar_nacimiento" value="<?= $trabajador->lugar_nacimiento ?>">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="numero_hijos">Número de Hijos</label>
                    <input type="number" id="numero_hijos" name="numero_hijos" value="<?= $trabajador->numero_hijos ?>">
                </div>
            </div>
        </fieldset>
        <!-- Sección: Contacto -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-envelope"></i> Contacto</legend>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" id="correo" name="correo" value="<?= $trabajador->correo ?>" required>
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" id="telefono" name="telefono" value="<?= $trabajador->telefono ?>">
                </div>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="telefono_emergencia">Teléfono de Emergencia</label>
                <input type="tel" id="telefono_emergencia" name="telefono_emergencia" value="<?= $trabajador->telefono_emergencia ?>">
            </div>
            <div class="dashboard__campo-formulario">
                <label for="direccion">Dirección</label>
                <textarea id="direccion" name="direccion"><?= $trabajador->direccion ?></textarea>
            </div>
        </fieldset>
        <!-- Sección: Datos Físicos --> 
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-ruler-combined"></i> Datos Físicos</legend>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="talla_camisa">Talla de Camisa</label>
                    <input type="text" id="talla_camisa" name="talla_camisa" value="<?= $trabajador->talla_camisa ?>">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="talla_pantalon">Talla de Pantalón</label>
                    <input type="text" id="talla_pantalon" name="talla_pantalon" value="<?= $trabajador->talla_pantalon ?>">
                </div>
            </div>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="talla_calzado">Talla de Calzado</label>
                    <input type="text" id="talla_calzado" name="talla_calzado" value="<?= $trabajador->talla_calzado ?>">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="peso">Peso (Kg)</label>
                    <input type="number" id="peso" name="peso" value="<?= $trabajador->peso ?>">
                </div>
            </div>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="estatura">Estatura (m)</label>
                    <input type="number" step="0.01" id="estatura" name="estatura" value="<?= $trabajador->estatura ?>">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="tipo_sangre">Tipo de Sangre</label>
                    <input type="text" id="tipo_sangre" name="tipo_sangre" value="<?= $trabajador->tipo_sangre ?>">
                </div>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="alergias">Alergias</label>
                <textarea id="alergias" name="alergias"><?= $trabajador->alergias ?></textarea>
            </div>
        </fieldset>
        <!-- Sección: Situación Habitacional -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-home"></i> Situación Habitacional</legend>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="tenencia_vivienda">Tenencia de Vivienda</label>
                    <input type="text" id="tenencia_vivienda" name="tenencia_vivienda" value="<?= $trabajador->tenencia_vivienda ?>">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="vehiculo_propio">Vehículo Propio</label>
                    <select id="vehiculo_propio" name="vehiculo_propio">
                        <option value="1" <?= $trabajador->vehiculo_propio ? 'selected' : '' ?>>Sí</option>
                        <option value="0" <?= !$trabajador->vehiculo_propio ? 'selected' : '' ?>>No</option>
                    </select>
                </div>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="licencia_conducir">Licencia de Conducir</label>
                <select id="licencia_conducir" name="licencia_conducir">
                    <option value="1" <?= $trabajador->licencia_conducir ? 'selected' : '' ?>>Sí</option>
                    <option value="0" <?= !$trabajador->licencia_conducir ? 'selected' : '' ?>>No</option>
                </select>
            </div>
        </fieldset>
        <!-- Sección: Información Académica y Laboral -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-graduation-cap"></i> Información Académica y Laboral</legend>
            <div class="dashboard__campo-formulario">
                <label for="informacion_familiar">Información Familiar</label>
                <textarea id="informacion_familiar" name="informacion_familiar"><?= $trabajador->informacion_familiar ?></textarea>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="informacion_academica">Formación Académica</label>
                <textarea id="informacion_academica" name="informacion_academica"><?= $trabajador->informacion_academica ?></textarea>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="formacion_complementaria">Formación Complementaria</label>
                <textarea id="formacion_complementaria" name="formacion_complementaria"><?= $trabajador->formacion_complementaria ?></textarea>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="experiencia_laboral">Experiencia Laboral</label>
                <textarea id="experiencia_laboral" name="experiencia_laboral"><?= $trabajador->experiencia_laboral ?></textarea>
            </div>
            <div class="dashboard__campo-formulario">
                <label for="areas_interes">Áreas de Interés</label>
                <textarea id="areas_interes" name="areas_interes"><?= $trabajador->areas_interes ?></textarea>
            </div>
        </fieldset>


        <!-- Sección: Documentos -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-paperclip"></i> Documentos Adjuntos</legend>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="rif_archivo">Adjuntar RIF</label>
                    <input type="file" id="rif_archivo" name="rif_archivo">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="rif_vencimiento">Vencimiento RIF</label>
                    <input type="date" id="vencimiento_rif" name="rif_vencimiento" value="<?= $trabajador->rif_vencimiento ?>">
                </div>
            </div>
            <div class="dashboard__doble-campos">
                <div class="dashboard__campo-formulario">
                    <label for="cedula_archivo">Adjuntar Cédula</label>
                    <input type="file" id="cedula_archivo" name="cedula_archivo">
                </div>
                <div class="dashboard__campo-formulario">
                    <label for="vencimiento_cedula">Vencimiento Cédula</label>
                    <input type="date" id="cedula_vencimiento" name="cedula_vencimiento" value="<?= $trabajador->cedula_vencimiento ?>">
                </div>
            </div>
            
        </fieldset>

        <!-- Sección: Empresa (con fecha de ingreso) -->
        <fieldset class="dashboard__seccion-formulario">
            <legend><i class="fas fa-building"></i> Empresa</legend>
            <div class="dashboard__campo-formulario">
                <label for="empresa">Empresa*</label>
                <input type="text" id="empresa" name="empresa" value="<?= $trabajador->empresa ?>">
            </div>
            <div class="dashboard__campo-formulario">
                <label for="departamento">Departamento*</label>
                <input type="text" id="departamento" name="departamento" value="<?= $trabajador->departamento ?>">
            </div>
            <div class="dashboard__campo-formulario">
                <label for="supervisor_inmediato">Supervisor Inmediato*</label>
                <input type="text" id="supervisor_inmediato" name="supervisor_inmediato" value="<?= $trabajador->supervisor_inmediato ?>">
            </div>
            <div class="dashboard__campo-formulario">
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" id="fecha_ingreso" name="fecha_ingreso" value="<?= $trabajador->fecha_ingreso ?>">
            </div>
        </fieldset>

        <div class="dashboard__acciones-formulario" style="display: flex; justify-content: center; gap: 2rem; margin-top: 2rem;">
            <button type="submit" class="boton-enviar">
                <i class="fas fa-save"></i> Guardar Cambios
            </button>
            
            <a href="/admin/perfil-individual?id=<?= $trabajador->id ?>" class="boton-cancelar">
                <i class="fas fa-times"></i> Cancelar
            </a>
        </div>

    </form>
</div>
