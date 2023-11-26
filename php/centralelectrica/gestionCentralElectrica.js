document.addEventListener('DOMContentLoaded', function() {
    listarCentralesElectricas(); // Llama a esta función al cargar la página para listar centrales eléctricas.
});


document.getElementById('formCentralElectrica').addEventListener('submit', function(e) {
    e.preventDefault();
    var formData = new FormData(this);

    fetch('anadirCentral.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Cambiar a .json() si la respuesta es JSON
    .then(data => {
        alert(data); // Muestra la respuesta del servidor (éxito o error)
        listarCentralesElectricas(); // Actualiza la lista de centrales eléctricas
    })
    .catch(error => console.error('Error:', error));
});

// Función para listar centrales eléctricas
function listarCentralesElectricas() {
    fetch('listarCentral.php') // Asume que tienes un script PHP para listar
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json(); // Asegúrate de que tu PHP devuelva un JSON
    })
    .then(centrales => {
        const lista = document.getElementById('listaCentralesElectricas');
        lista.innerHTML = '';
        centrales.forEach(central => {
            const item = document.createElement('div');
            item.innerHTML = `
                <p>Nombre: ${central.nombre}</p>
                <p>Tipo de Generación: ${central.tipo_generacion}</p>
                <button onclick="editarCentralElectrica(${central.id})">Editar</button>
                <button onclick="eliminarCentralElectrica(${central.id})">Eliminar</button>
            `;
            lista.appendChild(item);
        });
    })
    .catch(error => console.error('Error:', error));
}





function editarCentralElectrica(id) {
    console.log('Editar central eléctrica con ID:', id);
}






function eliminarCentralElectrica(id) {
    if (confirm('¿Estás seguro de que quieres eliminar esta central eléctrica?')) {
        fetch('eliminarCentralElectrica.php', { // Asume que tienes un script PHP para eliminar
            method: 'POST',
            body: JSON.stringify({ id: id }),
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.text()) // Cambiar a .json() si la respuesta es JSON
        .then(data => {
            alert(data); // Muestra la respuesta del servidor (éxito o error)
            listarCentralesElectricas(); // Actualiza la lista de centrales eléctricas
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