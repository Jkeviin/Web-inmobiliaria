function eliminarFoto(idFoto, idContenedor) {

    fotosAEliminar = idFoto + "," + fotosAEliminar;
    document.getElementById('fotosAEliminar').value = fotosAEliminar;

    //Eliminamos el el contenedor de la foto

    $('#' + idContenedor).remove();
}

/****************************************************/
/***** VENTANA MODAL PARA ACEPTAR LA ELIMINACION DE UNA PROIEDAD*********/
// Get the modal
//variable global que manendrá el id a eliminar en caso que confirme
var idEliminar;

function abrirModal(id) {
    idEliminar = id;
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById(id);

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal 
    //btn.onclick = function() {
    modal.style.display = "flex";
    //}

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
}

function eliminarPropiedad() {
    window.location.href = "eliminar-propiedad.php?idPropiedad=" + idEliminar;
}



/*tipo de muestra de las publicaciones */
function tipoDeMuestra(formato) {
    if (formato == "f") {
        document.getElementById("personalizada").style.display = "none";
    } else {
        document.getElementById("personalizada").style.display = "block";
    }
}