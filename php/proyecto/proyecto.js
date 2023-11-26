document.addEventListener('DOMContentLoaded', function() {
    listarProyectos(); // Llama a esta función al cargar la página para listar proyectos.
});

// Función para enviar formulario y añadir/editar proyecto
document.getElementById('formProyecto').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('anadirproyecto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        listarProyectos(); // Actualizar la lista de proyectos
    })
    .catch(error => console.error('Error:', error));
});

// Función para listar proyectos
function listarProyectos() {
    fetch('listarproyecto.php')
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.error) {
            console.error('Error:', data.error);
            document.getElementById('lista').innerHTML = data.error;
        } else {
            const tabla = construirTabla(data);
            document.getElementById('lista').innerHTML = '';
            document.getElementById('lista').appendChild(tabla);
        }
    })
    .catch(error => console.error('Error:', error));
}

// Función para construir la tabla de proyectos
function construirTabla(proyectos) {
    const tabla = document.createElement('table');
    tabla.className = 'table table-striped';

    const thead = tabla.createTHead();
    const tbody = tabla.createTBody();
    const row = thead.insertRow();

    const headers = ['Nombre', 'Latitud', 'Longitud', 'Región', 'Comuna', 'Fecha Apertura', 'Operativa', 'Acciones'];
    headers.forEach(headerText => {
        const header = document.createElement('th');
        header.textContent = headerText;
        row.appendChild(header);
    });

    proyectos.forEach(proyecto => {
        const row = tbody.insertRow();
        headers.forEach(header => {
            const cell = row.insertCell();
            if (header.toLowerCase() !== 'acciones') {
                cell.textContent = proyecto[header.toLowerCase()];
            }
        });

        // Celda de acciones con botones de editar y eliminar
        const accionesCell = row.insertCell();
        const btnEditar = document.createElement('button');
        btnEditar.className = 'btn btn-primary btn-sm';
        btnEditar.innerHTML = '<i class="fas fa-pencil-alt"></i>'; // Ícono de lápiz para editar
        btnEditar.onclick = function() { editarProyecto(proyecto.id); }; // Asumiendo que cada proyecto tiene un 'id'

        const btnEliminar = document.createElement('button');
        btnEliminar.className = 'btn btn-danger btn-sm';
        btnEliminar.innerHTML = '<i class="fas fa-trash"></i>'; // Ícono de basurero para eliminar
        btnEliminar.onclick = function() { eliminarProyecto(proyecto.id); };

        accionesCell.appendChild(btnEditar);
        accionesCell.appendChild(btnEliminar);
    });

    return tabla;
}

function editarProyecto(id) {
    // Aquí debes enviar al servidor el ID para obtener los datos del proyecto y luego cargarlos en el formulario
    fetch('editarproyecto.php', { // 'getproyecto.php' es un script PHP que debes crear para obtener los datos de un proyecto
        method: 'POST',
        body: JSON.stringify({ id: id }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(proyecto => {
        // Aquí asumes que 'proyecto' es el objeto con los datos del proyecto que quieres editar
        document.getElementById('nombre').value = proyecto.nombre;
        // ... establece el valor de los otros campos del formulario
        // Cambia el texto del botón para indicar que es una edición
        document.getElementById('btnGuardar').value = 'Editar Proyecto';
    })
    .catch(error => console.error('Error:', error));
}

function eliminarProyecto(id) {
    if (confirm('¿Estás seguro de que quieres eliminar este proyecto?')) {
        fetch('eliminarproyecto.php', {
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            listarProyectos(); // Actualizar la lista de proyectos
        })
        .catch(error => console.error('Error:', error));
    }
}







$(document).ready(function() {
    cargarNombresProyectos();
});

function cargarNombresProyectos() {
    $.ajax({
        url: 'obtenerProyecto_nombre.php', // Asegúrate de que la ruta sea correcta
        type: 'GET',
        dataType: 'json',
        success: function(proyectos) {
            var nombreProyectoSelect = $('#nombre');
            proyectos.forEach(function(proyecto) {
                nombreProyectoSelect.append(new Option(proyecto));
            });
        },
        error: function() {
            alert('Error al cargar los nombres de proyectos');
        }
    });
}






   