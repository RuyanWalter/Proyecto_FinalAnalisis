/* Publico/js/produccion */

// Confirmación de eliminación de tareas o producción
document.addEventListener("DOMContentLoaded", function() {
    const deleteButtons = document.querySelectorAll("form[action='/tarea/eliminar'] button");

    deleteButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            const confirmation = confirm("¿Estás seguro de que deseas eliminar esta tarea?");
            if (!confirmation) {
                event.preventDefault(); // Cancela la acción si el usuario no confirma
            }
        });
    });
});

// Deshabilitar el botón de "Completar" si hay tareas pendientes
document.addEventListener("DOMContentLoaded", function() {
    const completarProduccionButtons = document.querySelectorAll("form[action='/produccion/cambiar_estado'] button");

    completarProduccionButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            const tareasPendientes = document.querySelectorAll("li[data-tarea-pendiente='true']");
            if (tareasPendientes.length > 0) {
                alert("No se puede completar la producción, hay tareas pendientes.");
                event.preventDefault(); // Cancela la acción si hay tareas pendientes
            }
        });
    });
});

// Agregar interactividad al botón de "Actualizar Estado"
document.addEventListener("DOMContentLoaded", function() {
    const actualizarEstadoButtons = document.querySelectorAll("form[action='/produccion/cambiar_estado'] button");

    actualizarEstadoButtons.forEach(button => {
        button.addEventListener("click", function(event) {
            const confirmation = confirm("¿Estás seguro de que deseas cambiar el estado de esta producción?");
            if (!confirmation) {
                event.preventDefault(); // Cancela la acción si el usuario no confirma
            }
        });
    });
});

// Deshabilitar botones una vez que se haga clic para evitar doble envío
document.querySelectorAll("button, input[type='submit']").forEach(button => {
    button.addEventListener("click", function() {
        button.disabled = true; // Desactiva el botón una vez que se haga clic
        setTimeout(function() {
            button.disabled = false; // Reactiva el botón después de 1 segundo
        }, 1000);
    });
});
