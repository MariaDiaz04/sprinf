<!-- MODAL CREAR -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearLabel">Nuevo Consejo Comunal</h5>

      </div>
      <form action="<?= APP_URL . $this->Route('consejoComunal/guardar') ?>" method="post" id="guardar" name="consejoComunalguardar">
        <div class="modal-body">
          <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
          <input type="hidden" name="estatus" value="1">
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group">
                  <div class="col-lg-6">
                    <label class="form-label" for="nombre">Nombre del Consejo Comunal *</label>
                    <input type="text" aria-describedby="nombreCheck" required class="form-control mb-1" name="nombre" id="nombre" maxlength="255">
                    <div id="nombreCheck" class="invalid-feedback">
                      Por favor proporcione una nombre de consejo comunal válido
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <label class="form-label" for="nombre_vocero">Nombre del Vocero</label>
                    <input type="text" required aria-describedby="nombreVoceroCheck" class="form-control mb-1" name="nombre_vocero" id="nombre_vocero" maxlength="70">
                    <div id="nombreVoceroCheck" class="invalid-feedback">
                      Por favor proporcione un nombre de vocero válido
                    </div>
                  </div>

                </div>
                <div class="row form-group">


                  <div class="col-lg-6">
                    <label class="form-label" for="sector_id">Sector *</label>
                    <select class="form-select" name="sector_id" id="sector_id" required>
                      <option disabled selected value>-- Seleccione --</option>
                      <?php foreach ($sectores as $sector) : ?>
                        <option value="<?= $sector->id ?>"><?= "$sector->nombre" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-lg-6">
                    <label class="form-label" for="telefono">Teléfono</label>
                    <input type="text" inputmode="numeric" required class="form-control mb-1" placeholder="..." name="telefono" id="telefono" required maxlength="11">
                    <span id="stelefono"></span>
                    <div id="telefonoCheck" class="invalid-feedback">
                      Por favor proporcione un número de telefono válido
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- footer de acciones -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Guardar" id="submit">
          <div id="loading">
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
  var keyup_telefono = /^[0-9]{11}$/;
  document.onload = carga();
  function carga() {
    /*--------------VALIDACION PARA CEDULA--------------------*/
    document.getElementById("telefono").maxLength = 11;
    document.getElementById("telefono").onkeypress = function (e) {
      er = /^[0-9]*$/;
      validarkeypress(er, e);
    };
    document.getElementById("telefono").onkeyup = function () {
      r = validarkeyup(
        keyup_telefono,
        this,
        document.getElementById("stelefono"),
        ""
      );
    };
    /*--------------FIN VALIDACION PARA CEDULA--------------------*/
  };

  function validarkeyup(er, etiqueta, etiquetamensaje, mensaje) {
    a = er.test(etiqueta.value);
    if (!a) {
      etiquetamensaje.innerText = mensaje;
      etiquetamensaje.style.color = "red";
      etiqueta.classList.add("is-invalid");
      return 0;
    } else {
      etiquetamensaje.innerText = "";
      etiqueta.classList.remove("is-invalid");
      etiqueta.classList.add("is-valid");
      return 1;
    }
  }
  function validarkeypress(er, e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key);
    a = er.test(tecla);
    if (!a) {
      e.preventDefault();
    }
  }
</script>