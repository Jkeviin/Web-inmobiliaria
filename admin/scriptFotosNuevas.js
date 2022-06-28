function archivo(evt) {
    var noutputs = 100;

    //eliminamos todas las fotos que haya cargado

    $('.contenedor-foto-nueva').remove();
    var files = evt.target.files; // FileList object

    //Obtenemos la imagen del campo "file". 
    for (var i = 0, f; f = files[i]; i++) {

        //
        document.getElementById('fotosGaleriaActualizada').value = "si";

        //Solo admitimos imágenes.
        if (!f.type.match('image.*')) {
            continue;
        }

        var reader = new FileReader();

        reader.onload = (function(theFile) {
            return function(e) {
                noutputs++;
                $('#contenedor-fotos-nuevas').append('<output class = "contenedor-foto-galeria" id=' + noutputs + '></output>');
                // Creamos la imagen.
                document.getElementById(noutputs).innerHTML = ['<img class="foto-galeria"" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
            };
        })(f);

        reader.readAsDataURL(f);
    }
}

document.getElementById('fotos').addEventListener('change', archivo, false);