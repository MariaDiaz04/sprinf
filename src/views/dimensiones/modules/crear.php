<!-- MODAL CREAR -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearLabel">Creación de Dimensión</h5>

      </div>
      <form action="<?= APP_URL . $this->Route('dimensiones/guardar') ?>" method="post" id="guardar">
        <div class="modal-body">
          <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group mb-3">
                  <input type="hidden" name="unidad_id" value="<?= $unidadCurricular->codigo ?>">
                  <input type="hidden" id="valorBaremosActual" data-ponderado="<?= $trayecto->ponderado_baremos ?>">
                  <div class="col-lg-12">
                    <div class="alert alert-secondary" role="alert">
                      Ingrese nombre y ponderación de cada indicador de esta dimensión <?= $unidadCurricular->ponderado_baremos ?>.
                    </div>
                    <label class="form-label" for="nombre">Nombre Dimensión *</label>
                    <input type="text" class="form-control mb-1" placeholder="Desempeño Individual..." name="nombre" id="nombre" maxlength="255" required>
                    <div id="creacionNombreTutorValidation" class="invalid-feedback">
                      Por favor, proporcione un nombre de dimensión válido.
                    </div>
                  </div>
                </div>
                <div class="row form-group mb-3">

                  <div class="col-lg-12 d-flex justify-content-start align-items-end">
                    <div class="form-check ">
                      <input class="form-check-input" type="checkbox" value="1" id="grupal" name="grupal">
                      <label class="form-check-label" for="grupal">
                        Evaluación Grupal
                      </label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="alert alert-secondary" role="alert">
                  Ingrese nombre y ponderación de cada indicador de esta dimensión. <br>Se dispone de <span id="porPonderar" class="font-weight-bold" style="font-weight: bold;"><?= $pendientePorPonderar ?></span>% disponible por ponderar.
                </div>
                <div class="row form-group align-items-end">
                  <div class="col-lg-7">
                    <label class="form-label" for="nombreItem">Nombre Indicador *</label>
                    <input type="text" aria-describedby="creacionNombreIndicadorValido" class="form-control mb-1" placeholder="Responsabilidad..." id="nombreItem" maxlength="255">
                    <div id="creacionNombreIndicadorValido" class="invalid-feedback">
                      Por favor, proporcione un nombre de indicador válido.
                    </div>
                  </div>
                  <div class="col-lg-3 ">
                    <label class="form-label" for="ponderacionItem">Ponderación (%) *</label>
                    <input type="number" aria-describedby="creacionPonderacionIndicadorValido" class="form-control mb-1" placeholder="1.." id="ponderacionItem" onkeydown="return (event.keyCode === 8) ? true : /[0-9 .]/i.test(event.key)" max="100" step="0.01">
                    <div id="creacionPonderacionIndicadorValido" class="invalid-feedback">
                      Por favor, proporcione solo valores númericos.
                    </div>
                  </div>
                  <div class="col-lg-2 align-middle mb-1">
                    <button class="btn btn-primary" id="anadirItem">Añadir</button>
                  </div>

                </div>

                <div class="row form-group justify-content-center">
                  <table class="table table-striped table-responsive">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Nombre Indicador</th>
                        <th scope="col">Ponderación (%)</th>
                        <th scope="col">Remover</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTablaItems">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- footer de acciones -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Guardar" id="guardarSubmit">
          <div id="loading">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only"></span>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(document).ready(() => {
    $('#nombre').on('keyup', function() {
      $(this).val(titleCase($(this).val()))
      const value = $(this).val();
      if (!letterAndFewSpecial(value)) {
        // Si no coincide, muestra un mensaje de error
        $(this).addClass('is-invalid')

      } else {
        // Si coincide, elimina el mensaje de error
        $(this).removeClass('is-invalid')
      }
    })
    $('#nombreItem').on('keyup', function() {
      const value = $(this).val();
      if (!letterAndFewSpecial(value)) {
        // Si no coincide, muestra un mensaje de error
        $(this).addClass('is-invalid')

      } else {
        // Si coincide, elimina el mensaje de error
        $(this).removeClass('is-invalid')
      }
    })
    $('#nombreItem').on("paste", function(evt) {
      catchPaste(evt, this, function(clipData) {
        console.log(clipData);
        if (!letterAndFewSpecial(clipData)) {
          evt.preventDefault();

        }
      });
    });

    $('#guardar #ponderacionItem').on('keyup', function() {
      const value = $(this).val();

      if (value.length > 5) {
        // Establece el valor en el límite
        $(this).val(value.substring(0, 5));
      }

    })
    $('#ponderacionItem').on("paste", function(evt) {
      evt.preventDefault();
    });

  })

  function onlyLetters(str) {
    return /^[A-Za-zñáéíóúü ]*$/.test(str);
  }

  function letterAndFewSpecial(str) {
    return (
      /^[0-9A-Za-zÑñÁáÉéÍíÓóÚúÜü ()% ]+$/.test(str)
    );
  }

  function phoneNumbers(number) {
    return /^[04][0-9]{10}$/.test(number);
  }

  function capitalizeText(mySentence) {
    let words = mySentence.toLowerCase();

    words = words.replace(/(^|\s)\S/g, (l) => l.toUpperCase());

    return words;
  }

  function catchPaste(evt, elem, callback) {
    if (navigator.clipboard && navigator.clipboard.readText) {
      // modern approach with Clipboard API
      navigator.clipboard.readText().then(callback);
    } else if (evt.originalEvent && evt.originalEvent.clipboardData) {
      // OriginalEvent is a property from jQuery, normalizing the event object
      callback(evt.originalEvent.clipboardData.getData('text'));
    } else if (evt.clipboardData) {
      // used in some browsers for clipboardData
      callback(evt.clipboardData.getData('text/plain'));
    } else if (window.clipboardData) {
      // Older clipboardData version for Internet Explorer only
      callback(window.clipboardData.getData('Text'));
    } else {
      // Last resort fallback, using a timer
      setTimeout(function() {
        callback(elem.value)
      }, 100);
    }
  }
</script>