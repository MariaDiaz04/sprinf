
  <!-- MODAL ACTUALIZAR -->

  <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarLabel">Editar Estudiante</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('estudiantes/update') ?>" method="post" id="actualizar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Cedula *</label>
                      <input type="text" require disabled class="form-control mb-1" id="cedulaEdit">
                      <input type="hidden" required class="form-control mb-1" name="cedula" id="cedulaEditTwo">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" required aria-describedby="checkNombre" class="form-control mb-1" name="nombre" id="nombreEdit" maxlength="55">
                      <div id="checkNombre" class="invalid-feedback">
                      Por favor, proporcione un nombre válido.
                    </div>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="apellido">Apellido *</label>
                      <input type="text" required aria-describedby="checkApellido" class="form-control mb-1" name="apellido" id="apellidoEdit" maxlength="55">
                      <div id="checkApellido" class="invalid-feedback">
                      Por favor, proporcione un apellido válido.
                    </div>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="direccion">Dirección</label>
                      <input type="text" required class="form-control mb-1" placeholder="..." name="direccion" id="direccionEdit" maxlength="150">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="telefono">Teléfono</label>
                      <input type="text" inputmode="numeric" class="form-control mb-1" placeholder="0424XXXXXXX" aria-describedby="checkTelefono" required name="telefono" id="telefonoEdit" maxlength="11">
                      <div id="checkTelefono" class="invalid-feedback">
                      Por favor, proporcione un numero de telefono válido.
                    </div>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="email">Correo Electronico</label>
                      <input type="email" aria-describedby="checkEmail" required class="form-control mb-1" placeholder="..." name="email" id="emailEdit" maxlength="50">
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

    $("#actualizar #nombreEdit").on('keyup', function() {
      let nombre = $(this).val();
      if (!onlyLetters(nombre)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#actualizar #apellidoEdit").on('keyup', function() {
      let apellido = $(this).val();
      if (!onlyLetters(apellido)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    $("#actualizar #telefonoEdit").on('keyup', function() {
      let telefono = $(this).val();
      if (!phoneNumbers(telefono)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    
    $("#actualizar #emailEdit").on('keyup', function() {
      let email = $(this).val();
      if (!onlyEmail(email)) {
        $(this).addClass("is-invalid");
      } else {
        $(this).removeClass("is-invalid");
      }
    })
    

  })
</script>