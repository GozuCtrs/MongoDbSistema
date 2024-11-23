document.addEventListener("DOMContentLoaded", () => {
    async function cargarUsuarios() {
        const input = document.getElementById('datusuario');
        const datalist = document.getElementById('usuariosList');

        // Mostrar mensaje de carga mientras se obtienen los datos
        datalist.innerHTML = '<option>Cargando usuarios...</option>';

        try {
            // Solicitar datos al servidor
            const response = await fetch(`/controllers/controladorCargarUsuariosDatalist.php?nocache=${Date.now()}`);
            
            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status}`);
            }
            
            const usuarios = await response.json();

            // Limpiar datalist y agregar usuarios
            datalist.innerHTML = '';
            usuarios.forEach(usuario => {
                const option = document.createElement('option');
                option.value = usuario;
                datalist.appendChild(option);
            });
        } catch (error) {
            console.error("Error cargando usuarios:", error);
            datalist.innerHTML = '<option>Error al cargar usuarios</option>';
        }
    }

    cargarUsuarios();
});
