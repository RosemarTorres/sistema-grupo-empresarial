document.addEventListener('DOMContentLoaded', async () => {
    const campana = document.getElementById('campanaNotificaciones');
    const dropdown = campana.querySelector('.dropdown-notificaciones');
    const lista = document.getElementById('listaNotificaciones');
    const contador = campana.querySelector('.dashboard__notificaciones-contador');

     // Oculta el contador si ya es 0 desde el backend
        if (contador.textContent === '0') {
            contador.style.display = 'none';
        }

    campana.addEventListener('click', async () => {
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';

        if (dropdown.style.display === 'block') {
            const res = await fetch('/api/notificaciones');
            const trabajadores = await res.json();

            lista.innerHTML = '';

            if (trabajadores.length === 0) {
                lista.innerHTML = '<li>No hay nuevas notificaciones</li>';
                return;
            }

            trabajadores.forEach(t => {
                const li = document.createElement('li');
                li.textContent = `Nuevo trabajador: ${t.nombres} ${t.apellidos}`;
                li.addEventListener('click', () => {
                    window.location.href = `/admin/perfil-trabajador?id=${t.id}#resaltado`;
                });
                lista.appendChild(li);
            });
            
            // Marcar como leídas
            await fetch('/api/notificaciones/leidas', {
                method: 'POST'
            });

            // Vaciar contador
            
            contador.textContent = '0';
            contador.style.display = 'none'; //  AÑADIR ESTA LÍNEA
        }
    });
});
