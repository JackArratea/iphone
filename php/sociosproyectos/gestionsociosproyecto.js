$(document).ready(function() {
    // Realizar una solicitud AJAX para obtener la lista de socios
    $.ajax({
        url: "obtener_socios.php",
        dataType: "json",
        success: function(data) {
            // Llenar el select con la lista de socios
            var selectSocios = $("#socioId");
            $.each(data, function(index, socio) {
                selectSocios.append("<option value='" + socio.id + "'>" + socio.nombre + " " + socio.apellido + "</option>");
            });

            // Agregar un evento de cambio al select "SELECCIONAR SOCIO"
            selectSocios.on("change", function() {
                var selectedSocioId = $(this).val();
                var selectedSocio = data.find(function(socio) {
                    return socio.id == selectedSocioId;
                });

                // Llenar los campos de nombre y apellidos del socio seleccionado
                $("#nombreSocio").val(selectedSocio.nombre);
                $("#apellidosSocio").val(selectedSocio.apellido);
            });
        }
    });

    // Agregar un evento de envío al formulario
    $("#formSocioProyecto").submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        // Realizar una solicitud AJAX para guardar los datos del socio
        $.ajax({
            type: "POST",
            url: "anadirSocioProyecto.php",
            data: formData,
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    // Mostrar mensaje de éxito
                    alert(response.message);

                    // Limpiar el formulario después de agregar con éxito
                    $("#nombreProyecto").val("");
                    $("#socioId").val("");
                    $("#nombreSocio").val("");
                    $("#apellidosSocio").val("");
                } else {
                    // Mostrar mensaje de error
                    alert(response.message);
                }
            },
            error: function() {
                // Manejo de errores de la solicitud AJAX
                alert("Error al procesar la solicitud");
            }
        });
    });
});









function cargarSociosProyectos() {
    $.ajax({
        url: 'listarSocioProyecto.php', // Asegúrate de que la ruta sea correcta
        type: 'GET',
        success: function(response) {
            $('#listaSociosProyectos tbody').html(response);
        },
        error: function() {
            $('#listaSociosProyectos tbody').html('<tr><td colspan="3">Error al cargar los datos.</td></tr>');
        }
    });
}
$(document).ready(function() {
    cargarSociosProyectos();
});








