document.addEventListener('DOMContentLoaded', () => {
    const mesSelect = document.getElementById('mes');
    const anioSelect = document.getElementById('anio');
    const contenidoDiv = document.getElementById('contenido');

    // Función para actualizar el contenido
    function actualizarCalendario() {
        const mes = mesSelect.value;
        const anio = anioSelect.value;

        // Realiza la solicitud AJAX usando fetch
        fetch(`calendario.php?anio=${anio}&mes=${mes}`)
            .then(response => response.text())
            .then(data => {
                contenidoDiv.innerHTML = data; // Inserta la respuesta en el div
            })
            .catch(error => {
                contenidoDiv.innerHTML = "Error al cargar el calendario.";
                console.error("Error en la solicitud:", error);
            });
    }

    // Escucha los cambios en los selectores
    mesSelect.addEventListener('change', actualizarCalendario);
    anioSelect.addEventListener('change', actualizarCalendario);

    // Cargar el calendario inicial al abrir la página
    actualizarCalendario();
});
