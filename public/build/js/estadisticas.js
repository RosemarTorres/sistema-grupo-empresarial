document.addEventListener('DOMContentLoaded', () => {
    const selectTipo = document.getElementById('tipoEstadistica');
    
    const graficas = {
        ingresos: null,
        sexo: null,
        empresa: null,
        edad: null
    };

    const cargarEstadisticas = async (tipo) => {
        try {
            const response = await fetch(`/api/estadisticas?tipo=${tipo}`);
            const data = await response.json();

            // Destruir gráficos anteriores si existen
            Object.keys(graficas).forEach(key => {
                if (graficas[key]) graficas[key].destroy();
            });

            // Crear nuevos
            graficas.ingresos = new Chart(document.getElementById('graficaIngresos'), {
                type: 'line',
                data: {
                    labels: data.fechas,
                    datasets: [{
                        label: `Ingresos por ${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`,
                        data: data.ingresosPorDia,
                        borderColor: '#007BFF',
                        backgroundColor: 'rgba(0,123,255,0.1)',
                        fill: true,
                        tension: 0.3
                    }]
                }
            });

            graficas.sexo = new Chart(document.getElementById('graficaSexo'), {
                type: 'pie',
                data: {
                    labels: ['Masculino', 'Femenino', 'Otro'],
                    datasets: [{
                        data: data.sexo,
                        backgroundColor: ['#3498db', '#e74c3c', '#9b59b6']
                    }]
                }
            });

            graficas.empresa = new Chart(document.getElementById('graficaEmpresa'), {
                type: 'bar',
                data: {
                    labels: Object.keys(data.empresa),
                    datasets: [{
                        label: 'Ingresos por Empresa',
                        data: Object.values(data.empresa),
                        backgroundColor: '#2ecc71'
                    }]
                }
            });

            graficas.edad = new Chart(document.getElementById('graficaEdad'), {
                type: 'bar',
                data: {
                    labels: ['18-25', '26-35', '36-45', '46+'],
                    datasets: [{
                        label: 'Edades',
                        data: data.edades,
                        backgroundColor: '#f1c40f'
                    }]
                }
            });

        } catch (err) {
            console.error('Error cargando estadísticas:', err);
        }
    };

    // Evento para cambiar el tipo
    selectTipo.addEventListener('change', () => {
        cargarEstadisticas(selectTipo.value);
    });

    // Cargar por defecto
    cargarEstadisticas(selectTipo.value);
});
