document.addEventListener('DOMContentLoaded', function() {
    listarMinas(); // Llama a esta función al cargar la página para listar minas.
});

// Función para enviar formulario y añadir/editar mina
document.getElementById('formMina').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('anadirMina.php', { // La URL a tu script PHP para añadir/editar minas
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Cambiar a .json() si la respuesta es JSON
    .then(data => {
        alert(data); // Muestra la respuesta del servidor (éxito o error)
        listarMinas(); // Actualiza la lista de minas
    })
    .catch(error => console.error('Error:', error));
});

// Función para listar minas
function listarMinas() {
    fetch('listarmina.php') // La URL a tu script PHP para listar minas
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Asegúrate de que tu PHP devuelva un JSON
    })
    .then(minas => {
        const lista = document.getElementById('listaMinas');
        lista.innerHTML = ''; // Limpia la lista actual
        minas.forEach(mina => {
            // Crea y añade elementos a la lista para cada mina
            // Aquí deberías crear el HTML que representa cada mina,
            // incluyendo botones o enlaces para editar y eliminar.
            const item = document.createElement('div');
            item.innerHTML = `
                <p>Name: ${mina.nombre}</p>
                <p>Mineral: ${mina.mineral}</p>
                <button onclick="editarMina(${mina.id})">Edit</button>
                <button onclick="eliminarMina(${mina.id})">Delete</button>
            `;
            lista.appendChild(item);
        });
    })
    .catch(error => console.error('Error:', error));
}

// Función para editar mina (necesitarás un formulario o una interfaz para editar)
function editarMina(id) {
    // Solicita los datos actuales de la mina al servidor
    fetch('editarmina.php', {
        method: 'POST',
        body: JSON.stringify({ id: id }),
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(mina => {
        // Suponiendo que tienes un formulario con campos para 'nombre' y 'mineral'
        document.getElementById('nombre').value = mina.nombre;
        document.getElementById('mineral').value = mina.mineral;
        // Actualiza el botón de guardar para que sepa que está en modo de edición
        const botonGuardar = document.getElementById('btnGuardarMina');
        botonGuardar.textContent = 'Actualizar Mina';
        botonGuardar.onclick = function() {
            actualizarMina(id); // Función que maneja la actualización
        };
        // Si estás usando un modal, aquí deberías abrirlo
    })
    .catch(error => console.error('Error:', error));
}

function actualizarMina(id) {
    var formData = new FormData(document.getElementById('formMina'));
    formData.append('id', id); // Asegúrate de enviar también el ID

    fetch('actualizarMina.php', { // La URL a tu script PHP para actualizar minas
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // Muestra la respuesta del servidor (éxito o error)
        listarMinas();
    })
    .catch(error => console.error('Error:', error));
}



// Función para eliminar mina
function eliminarMina(id) {
    if (confirm('¿Estás seguro de que quieres eliminar esta mina?')) {
        fetch('eliminarMina.php', { // La URL a tu script PHP para eliminar minas
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text()) // Cambiar a .json() si la respuesta es JSON
        .then(data => {
            alert(data); // Muestra la respuesta del servidor (éxito o error)
            listarMinas(); // Actualiza la lista de minas
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