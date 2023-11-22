<!-- MODAL ACTUALIZAR -->
<div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editar" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editar">Actualizar Docente</h5>

      </div>
      <form action="<?= APP_URL . $this->Route('profesores/actualizar') ?>" method="post" id="actualizar">
        <div class="modal-body">
          <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
          <input type="hidden" name="estatus" value="1">
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group">
                  <div class="col-lg-6">
                    <label class="form-label" for="nombre">Cedula *</label>
                    <input type="text" disabled class="form-control mb-1" id="cedulaEdit">
                    <input type="hidden" class="form-control mb-1" placeholder="..." name="cedula" id="cedula">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label" for="nombre">Nombre *</label>
                    <input type="text" aria-describedby="checkNombre" class="form-control mb-1" placeholder="..." name="nombre" id="nombre">
                    <div id="checkNombre" class="invalid-feedback">
                      Por favor, proporcione un nombre válido.
                    </div>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-6">
                    <label class="form-label" for="apellido">Apellido *</label>
                    <input type="text" aria-describedby="checkApellido" class="form-control mb-1" placeholder="..." name="apellido" id="apellido">
                    <div id="checkApellido" class="invalid-feedback">
                      Por favor, proporcione un apellido válido.
                    </div>
                  </div>

                  <!-- <div class="row form-group"> -->
                  <div class="col-lg-6">
                    <label class="form-label" for="direccion">Dirección</label>
                    <input type="text" class="form-control mb-1" placeholder="..." name="direccion" id="direccion">
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-lg-6">
                    <label class="form-label" for="telefono">Teléfono</label>
                    <input type="number" aria-describedby="checkTelefono" class="form-control mb-1" placeholder="..." name="telefono" id="telefono">
                    <div id="checkTelefono" class="invalid-feedback">
                      Por favor, proporcione un numero de telefono válido.
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label" for="email">Correo Electronico</label>
                    <input type="text" aria-describedby="checkEmail" class="form-control mb-1" placeholder="..." name="email" id="email">
                    <div id="checkEmail" class="invalid-feedback">
                      Por favor, proporcione un Correo Electronico válido.
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- footer de acciones -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="editarSubmit">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Editar" id="editar">
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

    $("#actualizar #nombre").on('keyup', function() {
      let nombre = $(this).val();
      if (!onlyLetters(nombre)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#actualizar #apellido").on('keyup', function() {
      let apellido = $(this).val();
      if (!onlyLetters(apellido)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#actualizar #telefono").on('keyup', function() {
      let telefono = $(this).val();
      if (!phoneNumbers(telefono)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    
    $("#actualizar #email").on('keyup', function() {
      let email = $(this).val();
      if (!onlyEmail(email)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#actualizar #contrasena").on('keyup', function() {
      let contrasena = $(this).val();
      if (contrasena.length < 8 || contrasena.length > 25) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })

  })
</script>