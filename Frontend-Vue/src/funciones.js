import Swal from "sweetalert2"; //importacion para ventanas emergentes
import axios from "axios"; //importacion para peticiones http

export function mostrarAlerta(titulo, icono, foco = '') {
    if (foco != "") {
        document.getElementById(foco).focus(); //se centra sobre un elemento
    }

    Swal.fire({
        title: titulo,
        icon: icono,
        customClass: { confirmButton: 'btn btn-primary', popup: 'animated zoonIn' }, //se cambia el color del boton a uno de bootstrap
        buttonsStyling: false, //se desactiva el estilo por defecto del boton
    });
}

export function confirmar(url, id, titulo, mensaje) {
    var urlCompleta = url + id;
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success me-3',
            cancelButton: 'btn btn-danger',
        }, //se cambia el color del boton a uno de bootstrap
    });

    swalWithBootstrapButtons.fire({
        title: titulo,
        text: mensaje,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: '<i class="fa-solid fa-check"></i> Si, eliminar',
        cancelButtonText: '<i class="fa-solid fa-ban"></i> No, cancelar',
    }).then((res) => {//checo que se seleccionó
        if (res.isConfirmed) {
            enviarSolicitud('DELETE', { id: id }, urlCompleta, 'Eliminado con exito');
        } else {
            mostrarAlerta("La operación fue cancelada", 'info');
        }
    });

    /*Swal.fire({
        title: titulo,
        icon: icono,
        customClass: { confirmButton: "btn btn-primary", popup: "animated zoonIn" }, //se cambia el color del boton a uno de bootstrap
        buttonsStyling: false, //se desactiva el estilo por defecto del boton
    });*/
}

export function enviarSolicitud(metodo, parametros, url, mensaje) {
    axios({//se hace la peticion con los datos recibidos
        method: metodo,
        url: url,
        data: parametros,

    }).then((res) => {//cuando la peticion es exitosa
        var estado = res.status;
        if (estado == 200) {
            mostrarAlerta(mensaje, 'success');
            window.setTimeout(function () {//se redirecciona a la pagina principal despues de 1 segundo1
                window.location.href = "/";
            }, 1000);
        } else {
            mostrarAlerta("No se obtuvo una respuesta", "error");
        }
    }).catch((err) => {//cuando la peticion falla
        mostrarAlerta("Servidor dice: " + err.response.data.message, "error");
    });
}

export function mensajeRedireccion(mensaje, icono, action=false) {

    mostrarAlerta(mensaje, icono);
    if (action == true) {
        window.setTimeout(function () {//se redirecciona a la pagina principal despues de 1 segundo1
            window.location.href = "/";
        }, 2000);
    }


}