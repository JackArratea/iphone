document.addEventListener('DOMContentLoaded', function() {
    listarRecursosAmbientalesNoEnTramite(); // Función para listar los recursos ambientales no en trámite actuales.
});

document.getElementById('formRecursoAmbientalNoEnTramite').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('anadirRecursoAmbientalNoEnTramite.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Muestra la respuesta del servidor
        listarRecursosAmbientalesNoEnTramite(); // Actualiza la lista de recursos
    })
    .catch(error => console.error('Error:', error));
});






// Agrega esto después del código existente en gestionRecursoAmbientalNoEnTramite.js

// Función para listar los recursos ambientales en la tabla
function listarRecursosAmbientalesNoEnTramite() {
    $.ajax({
        url: 'listarRecursoAmbientalNoEnTramite.php', // Reemplaza con la URL correcta de tu script PHP para obtener los datos
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data.success) {
                const recursos = data.recursos; // Supongo que los datos del recurso se devuelven en un arreglo llamado "recursos"

                // Limpiar la tabla antes de agregar nuevos datos
                $('#tablaRecursosAmbientales').empty();

                // Iterar sobre los recursos y agregarlos a la tabla
                recursos.forEach(function (recurso) {
                    $('#tablaRecursosAmbientales').append(`
                        <tr>
                            <td>${recurso.numero}</td>
                            <td>${recurso.nombreProyecto}</td>
                            <td>${recurso.fecha_dictamen}</td>
                            <td>${recurso.descripcion}</td>
                            <td>${recurso.causa}</td>
                            <td>${recurso.fecha_apertura}</td>
                            <td>${recurso.region}</td>
                            <td>${recurso.comuna}</td>
                            <td>${recurso.status}</td>
                        </tr>
                    `);
                });
            } else {
                // Manejar el caso de error si es necesario
                console.error(data.message);
            }
        },
        error: function (xhr, status, error) {
            // Manejar errores de AJAX si es necesario
            console.error(error);
        }
    });
}

// Llamar a la función para listar recursos cuando la página se carga
$(document).ready(function () {
    listarRecursosAmbientalesNoEnTramite();
});













function editarRecursoAmbientalNoEnTramite(id) {
    console.log('Editar recurso con ID:', id);
    // Implementar lógica de edición
}

function eliminarRecursoAmbientalNoEnTramite(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este recurso?')) {
        fetch('eliminarRecursoAmbientalNoEnTramite.php', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text())
        .then(data => {
            alert(data); // Muestra la respuesta del servidor
            listarRecursosAmbientalesNoEnTramite(); // Actualiza la lista de recursos
        })
        .catch(error => console.error('Error:', error));
    }
}
     











$(document).ready(function() {
    cargarNombresProyectos();
});

var proyectosData = {};

function cargarNombresProyectos() {
    $.ajax({
        url: 'obtenerProyecto_nombre.php',
        type: 'GET',
        dataType: 'json',
        success: function(proyectos) {
            var nombreProyectoSelect = $('#nombreProyecto');
            nombreProyectoSelect.empty();

            proyectos.forEach(function(proyecto) {
                nombreProyectoSelect.append(new Option(proyecto.nombre, proyecto.nombre));
                proyectosData[proyecto.nombre] = proyecto.fecha_apertura; // Almacenar fecha de apertura
            });

            // Actualizar la fecha de apertura basada en el proyecto seleccionado inicialmente
            actualizarFechaApertura();
        },
        error: function() {
            alert('Error al cargar los nombres de proyectos');
        }
    });
}

function actualizarFechaApertura() {
    var nombreSeleccionado = $('#nombreProyecto').val();
    var fechaApertura = proyectosData[nombreSeleccionado] || '';
    $('#fechaApertura').val(fechaApertura);
}


$('#nombreProyecto').change(function() {
    actualizarFechaApertura();
});