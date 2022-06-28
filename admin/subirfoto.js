function handleFileSelect(evt) {
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    var f = files[0];

      // Only process image files.
      if (!f.type.match('image.*')) {
        alert("Archivo no soportado");
        return;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumb" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').innerHTML = span.innerHTML;

          document.getElementById('fotoPrincipalActualizada').value = "si";
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    //}
  }

  document.getElementById('foto1').addEventListener('change', handleFileSelect, false);