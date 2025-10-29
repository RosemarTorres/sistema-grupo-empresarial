<div class="dashboard_content" style="
    margin-left: 300px;
">
<div class="dashboard__modulos">
    <div class="dashboard__modulo planilla-modulo" id="modulo-planilla">
        <div class="dashboard__modulo-header">
            <h3 class="dashboard__modulo-titulo">
                <i class="fas fa-file-alt"></i>
                Planilla de Ingreso
            </h3>
        </div>
        
        <div class="dashboard__submodulo" id="submodulo-empresas" style="display: none;">
            <div class="dashboard__submodulo-titulo">Seleccione la empresa</div>
            <div class="dashboard__opciones">
                <a href="#" class="dashboard__opcion" data-empresa="xeax-alimentos">XEAX alimentos</a>
                <a href="#" class="dashboard__opcion" data-empresa="elicar">Elicar</a>
                <a href="#" class="dashboard__opcion" data-empresa="constructora-vialca">Constructora Vialca</a>
                <a href="#" class="dashboard__opcion" data-empresa="cosmos">Cosmos</a>
            </div>
        </div>
        
        <div class="dashboard__submodulo" id="submodulo-acciones" style="display: none;">
            <div class="dashboard__submodulo-titulo">Empresa seleccionada: <span id="empresa-seleccionada"></span></div>
            <div class="dashboard__opciones">
                 <a href="#" id="volver-a-empresas" class="dashboard__opcion">
                    ⬅ Volver a empresas
                </a>
                <a href="#" class="dashboard__opcion accion-planilla">Rellenar planilla</a>
                <a href="#" class="dashboard__opcion accion-link">Enviar link</a>
            </div>
        </div>
    </div>

    <a href="/admin/perfil-trabajador" class="dashboard__modulo perfil-modulo modulo-enlace">
        <div class="dashboard__modulo-header">
            <h3 class="dashboard__modulo-titulo">
                <i class="fas fa-users dashboard__icono"></i>
                Perfil de Trabajadores
            </h3>
        </div>
    </a>
</div>
    <div class="dashboard__estadisticas">
    <h3 class="dashboard__estadisticas-titulo">
        <i class="fas fa-chart-bar"></i> Estadísticas de Ingreso
    </h3>
    
    <div class="filtro-estadisticas">
        <label for="tipoEstadistica">Ver estadísticas por:</label>
        <select id="tipoEstadistica">
            <option value="dia" selected>Día</option>
            <option value="mes">Mes</option>
            <option value="anio">Año</option>
        </select>
    </div>

    <!-- Contenedor de Gráficas -->
    <div class="dashboard__graficas">
        <div class="grafica-container">
            <h4>Ingresos</h4>
            <canvas id="graficaIngresos" width="400" height="200"></canvas>
        </div>

        <div class="grafica-container">
            <h4>Sexo</h4>
            <canvas id="graficaSexo" width="400" height="200"></canvas>
        </div>

        <div class="grafica-container">
            <h4>Empresa</h4>
            <canvas id="graficaEmpresa" width="400" height="200"></canvas>
        </div>

        <div class="grafica-container">
            <h4>Edad</h4>
            <canvas id="graficaEdad" width="400" height="200"></canvas>
        </div>
    </div>
</div>



   <div class="dashboard__acciones">
    <form method="GET" action="/admin/descargar-reporte" style="display: flex; align-items: center; gap: 1rem;">
        <label for="filtro">Filtrar por:</label>
        <select name="filtro" id="filtro" required>
            <option value="">-- Seleccionar --</option>
            <option value="dia">Día actual</option>
            <option value="mes">Mes actual</option>
            <option value="anio">Año actual</option>
        </select>

        <button type="submit" class="boton-descargar">
            <i class="fas fa-file-download"></i> Descargar Reporte
        </button>
    </form>
</div>

</div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  const moduloPlanilla = document.getElementById('modulo-planilla');
  const headerPlanilla = moduloPlanilla.querySelector('.dashboard__modulo-header');
  const submoduloEmpresas = document.getElementById('submodulo-empresas');
  const submoduloAcciones = document.getElementById('submodulo-acciones');
  const opcionesEmpresa = document.querySelectorAll('[data-empresa]');
  const empresaSeleccionada = document.getElementById('empresa-seleccionada');

  // --- CORRECCIÓN: Se elimina el código JS innecesario para el módulo de perfiles ---
  // Ahora es un enlace <a> y funciona sin JavaScript.

  headerPlanilla.addEventListener('click', function(e) {
    e.stopPropagation();
    const mostrar = submoduloEmpresas.style.display !== 'block';

    submoduloEmpresas.style.display = 'none';
    submoduloAcciones.style.display = 'none';

    moduloPlanilla.classList.toggle('is-open', mostrar);

    if (mostrar) {
      submoduloEmpresas.style.display = 'block';
    }
  });

  document.addEventListener('click', function(e) {
  const esClickDentroPlanilla = e.target.closest('#modulo-planilla');
        if (!esClickDentroPlanilla) {
        submoduloEmpresas.style.display = 'none';
        submoduloAcciones.style.display = 'none';
        //  AÑADE ESTA LÍNEA TAMBIÉN AQUÍ
        moduloPlanilla.classList.remove('is-open');
      }
    });

  const volverEmpresas = document.getElementById('volver-a-empresas');
  volverEmpresas.addEventListener('click', function(e) {
    e.preventDefault();
    e.stopPropagation();

    submoduloAcciones.style.display = 'none';
    submoduloEmpresas.style.display = 'block';
  });

  opcionesEmpresa.forEach(opcion => {
    opcion.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation();

      const empresa = this.getAttribute('data-empresa');
      empresaSeleccionada.textContent = empresa;

      submoduloEmpresas.style.display = 'none';
      submoduloAcciones.style.display = 'block';

      document.querySelectorAll('.accion-planilla').forEach(accion => {
        accion.href = `/llenar-planilla?empresa=${encodeURIComponent(empresa)}`;
      });

      document.querySelectorAll('.accion-link').forEach(accion => {
        accion.href = `/enviar-link?empresa=${encodeURIComponent(empresa)}`;
      });
    });
  });

  document.addEventListener('click', function(e) {
    const esClickDentroPlanilla = e.target.closest('#modulo-planilla');

    if (!esClickDentroPlanilla) {
      submoduloEmpresas.style.display = 'none';
      submoduloAcciones.style.display = 'none';
    }
  });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tipoEstadistica = document.getElementById('tipoEstadistica');
    let charts = [];

    const cargarEstadisticas = async (tipo = 'dia') => {
        const res = await fetch(`/api/estadisticas?tipo=${tipo}`);
        const data = await res.json();

        // Destruir gráficos anteriores si existen
        charts.forEach(chart => chart.destroy());
        charts = [];

        charts.push(new Chart(document.getElementById('graficaIngresos'), {
            type: 'line',
            data: {
                labels: data.fechas,
                datasets: [{
                    label: `Ingresos por ${tipo}`,
                    data: data.ingresosPorDia,
                    borderColor: '#007BFF',
                    backgroundColor: 'rgba(0,123,255,0.1)',
                    fill: true,
                    tension: 0.3
                }]
            }
        }));

        charts.push(new Chart(document.getElementById('graficaSexo'), {
            type: 'pie',
            data: {
                labels: ['Masculino', 'Femenino', 'Otro'],
                datasets: [{
                    data: data.sexo,
                    backgroundColor: ['#3498db', '#e74c3c', '#9b59b6']
                }]
            }
        }));

        charts.push(new Chart(document.getElementById('graficaEmpresa'), {
            type: 'bar',
            data: {
                labels: Object.keys(data.empresa),
                datasets: [{
                    label: 'Ingresos por Empresa',
                    data: Object.values(data.empresa),
                    backgroundColor: '#2ecc71'
                }]
            }
        }));

        charts.push(new Chart(document.getElementById('graficaEdad'), {
            type: 'bar',
            data: {
                labels: ['18-25', '26-35', '36-45', '46+'],
                datasets: [{
                    label: 'Edades',
                    data: data.edades,
                    backgroundColor: '#f1c40f'
                }]
            }
        }));
    };

    // Cargar por defecto
    cargarEstadisticas('dia');

    // Cambiar según selección
    tipoEstadistica.addEventListener('change', e => {
        cargarEstadisticas(e.target.value);
    });
});
</script>

