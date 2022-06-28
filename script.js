var index_foto_actual;

function abrirModal(img, index) {
    index_foto_actual = index;
    var modal = document.getElementById("myModal");

    document.getElementById("fotoModal").src = img.src;

    // Get the button that opens the modal

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal 
    //btn.onclick = function() {
    modal.style.display = "block";
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

    //tomo todas la imagenes que hay dentro del div

}

function proxima() {

    var fotosGaleria = document.querySelectorAll('#galeria img');

    if (fotosGaleria.length - 1 == index_foto_actual) {
        index_foto_actual = -1;
    }
    index_foto_actual++;

    document.getElementById("fotoModal").src = fotosGaleria[index_foto_actual].src;

}

function anterior() {

    var fotosGaleria = document.querySelectorAll('#galeria img');

    if (index_foto_actual == 0) {
        index_foto_actual = fotosGaleria.length;
    }
    index_foto_actual--;

    document.getElementById("fotoModal").src = fotosGaleria[index_foto_actual].src;

}