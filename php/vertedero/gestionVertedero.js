document.addEventListener('DOMContentLoaded', function() {
    listarVertederos();
});

document.getElementById('formVertedero').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('anadirVertedero.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Asegurarse de que la respuesta es JSON
    .then(data => {
        alert(data.mensaje); // Suponiendo que 'data' contiene una propiedad 'mensaje'
        listarVertederos();
    })
    .catch(error => console.error('Error:', error));
});



function listarVertederos() {
    fetch('listarvertedero.php')
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const vertederos = data.vertederos;
            const tabla = document.getElementById('tablaVertederos');
            tabla.innerHTML = ''; // Limpia la tabla antes de agregar datos

            // Crea las filas de la tabla
            vertederos.forEach(vertedero => {
                const fila = document.createElement('tr');
                fila.innerHTML = `
                    <td>${vertedero.id}</td>
                    <td>${vertedero.nombre}</td>
                    <td>${vertedero.fecha_apertura}</td>
                `;
                tabla.appendChild(fila);
            });
        } else {
            console.error(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
}

// También deberías actualizar la función para mostrar un mensaje después de la inserción
function anadirVertedero() {
    document.getElementById('formVertedero').addEventListener('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
    
        fetch('anadirVertedero.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json()) // Asegurarse de que la respuesta es JSON
        .then(data => {
            if (data.success) {
                alert(data.message); // Muestra el mensaje de éxito
                listarVertederos(); // Actualiza la lista de vertederos
            } else {
                alert(data.message); // Muestra un mensaje de error en caso de fallo
            }
        })
        .catch(error => console.error('Error:', error));
    });
}   








function editarVertedero(id) {
    console.log('Editar vertedero con ID:', id);
}

function eliminarVertedero(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este vertedero?')) {
        fetch('eliminarVertedero.php', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {'Content-Type': 'application/json'}
        })
        .then(response => response.json())
        .then(data => {
            alert(data.mensaje); // Suponiendo que 'data' contiene una propiedad 'mensaje'
            listarVertederos();
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

