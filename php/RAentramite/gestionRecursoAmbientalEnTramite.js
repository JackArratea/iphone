document.addEventListener('DOMContentLoaded', function() {
    listarRecursosAmbientalesEnTramite(); // Función para listar los recursos ambientales en trámite actuales.
});

document.getElementById('formRecursoAmbientalEnTramite').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('anadirRecursoAmbientalEnTramite.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Muestra la respuesta del servidor
        listarRecursosAmbientalesEnTramite(); // Actualiza la lista de recursos
    })
    .catch(error => console.error('Error:', error));
});

function listarRecursosAmbientalesEnTramite() {
    fetch('listarRecursoAmbientalEnTramite.php')
    .then(response => response.json())
    .then(recursos => {
        const tbody = document.querySelector('#listaRecursosAmbientalesEnTramite tbody');
        tbody.innerHTML = ''; // Limpia la tabla actual
        recursos.forEach(recurso => {
            // Crea una fila de la tabla para cada recurso
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${recurso.numero}</td>
                <td>${recurso.nombre}</td>
                <td>${recurso.causa}</td>
                <td>${recurso.descripcion}</td>
                <td>${recurso.fecha_apertura}</td>
                <td>${recurso.region}</td>
                <td>${recurso.comuna}</td>
                <td>
                    <button onclick="editarRecursoAmbientalEnTramite(${recurso.id})">Editar</button>
                    <button onclick="eliminarRecursoAmbientalEnTramite(${recurso.id})">Eliminar</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    })
    .catch(error => console.error('Error:', error));
}







function editarRecursoAmbientalEnTramite(id) {
    console.log('Editar recurso con ID:', id);
}






function eliminarRecursoAmbientalEnTramite(id) {
    fetch('eliminarRecursoAmbientalEnTramite.php', {
        method: 'POST',
        body: JSON.stringify({ id: id }), // Envía el ID como un objeto JSON
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            listarRecursosAmbientalesEnTramite();
        } else {
            console.error(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
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