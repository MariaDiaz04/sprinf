
  <!-- MODAL CREAR -->
  <div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Nuevo Estudiante</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('estudiantes/guardar') ?>" method="post" id="guardar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Cedula *</label>
                      <input type="text" aria-describedby="checkCedula" required class="form-control mb-1" placeholder="..." name="cedula" id="cedula" maxlength="8">
                      <div id="checkCedula" class="invalid-feedback">
                      Por favor, proporcione una cédula válida. Omita los puntos.
                        </div>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" aria-describedby="checkNombre" required class="form-control mb-1" placeholder="..." name="nombre" id="nombre" maxlength="40">
                      <div id="checkNombre" class="invalid-feedback">
                      Por favor, proporcione un nombre válido.
                    </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="apellido">Apellido *</label>
                      <input type="text" aria-describedby="checkApellido" required class="form-control mb-1" placeholder="..." name="apellido" id="apellido" maxlength="40">
                      <div id="checkApellido" class="invalid-feedback">
                        Por favor, proporcione un apellido válido.
                        </div>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="direccion">Dirección</label>
                      <input type="text" required class="form-control mb-1" placeholder="..." name="direccion" id="direccion" maxlength="100">
                      
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="telefono">Teléfono</label>
                      <input type="text" inputmode="numeric" class="form-control mb-1" placeholder="04XXXXXXXXX" name="telefono" id="telefono" required maxlength="11">
                      <div id="checkEmail" class="invalid-feedback">
                      Por favor, proporcione un numero de telefono válido.
                    </div>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="email">Correo Electronico</label>
                      <input type="email" aria-describedby="checkEmail" required class="form-control mb-1" placeholder="..." name="email" id="email" maxlength="50">
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
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Guardar" id="guardar">
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

    $("#guardar #nombre").on('keyup', function() {
      let nombre = $(this).val();
      if (!onlyLetters(nombre)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#guardar #apellido").on('keyup', function() {
      let apellido = $(this).val();
      if (!onlyLetters(apellido)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#guardar #telefono").on('keyup', function() {
      let telefono = $(this).val();
      if (!phoneNumbers(telefono)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#guardar #cedula").on('keyup', function() {
      let cedula = $(this).val();
      if (!onlyNumbers(cedula)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#guardar #email").on('keyup', function() {
      let email = $(this).val();
      if (!onlyEmail(email)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#guardar #contrasena").on('keyup', function() {
      let contrasena = $(this).val();
      if (contrasena.length < 8 || contrasena.length > 25) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })

  })
</script>