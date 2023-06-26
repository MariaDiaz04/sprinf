<div>
  <!-- Content -->
  <div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light"><?= $this->ROL->find($usuario->rol_id)->fillable['nombre'] ?>/</span> Editar
    </h4>
  </div>
  <div class="card">
    <h5 class="card-header bg-primary text-white">
      Editar usuario
    </h5>
    <div class="card-body">
      <form action="<?= $this->Route('usuario/actualizar', ['usuario' => $usuario->usuarios_id]) ?>" method="POST" id="usuarioeditar">
        <div class="container-fluid">
          <div class="row pb-2">
            <div class="col-12">
              <div class="row form-group">
                <div class="col-lg-5">
                  <label class="form-label ">Nombre</label>
                  <input type="text" class="form-control mb-1" placeholder="nmaxwell" name="nombre" value="<?= $usuario->nombre ?>">
                </div>
                <div class="col-lg-5">
                  <label class="form-label">Apellido </label>
                  <input type="text" class="form-control" placeholder="Nelle Maxwell" name="apellido" value="<?= $usuario->apellido ?>">
                </div>
                <div class="col-lg-2 ">
                  <label class="form-label">Cedula </label>
                  <input type="number" class="form-control" placeholder="01456220" name="cedula" value="<?= $usuario->cedula ?>">
                </div>
              </div>
            </div>
            <div class="col-12">
              <div class="row form-group">
                <div class="col-lg-3">
                  <label class="form-label ">Teléfono</label>
                  <input type="tel" class="form-control mb-1" placeholder="0423655874" name="telefono" value="<?= $usuario->telefono ?>">
                </div>
                <div class="col-lg-4">
                  <label class="form-label">Fecha de nacimiento</label>
                  <input type="date" class="form-control" name="nacimiento" value="<?= $usuario->nacimiento ?>">
                </div>
                <div class="col-lg-2 d-flex align-items-center pt-3">
                  <label for="status" class="switcher  switcher-lg switcher-primary ">
                    <input id="status" type="checkbox" class="switcher-input " <?php if ($usuario->estatus) {
                                                                                  echo "checked value='1'";
                                                                                } else {
                                                                                  echo "value='0'";
                                                                                } ?> name="estatus">
                    <span class="switcher-indicator">
                      <span class="switcher-yes">
                        <span class="ion ion-md-checkmark"></span>
                      </span>
                      <span class="switcher-no">
                        <span class="ion ion-md-close"></span>
                      </span>
                    </span>
                    <span class="switcher-label">Estado</span>
                  </label>
                </div>

                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-8">
                      <label class="form-label">Procedencia</label>
                      <select class="custom-select" name="procedencia_id">
                        <?php foreach ($procedencia as $procedencias) : ?>
                          <option <?php if ($usuario->procedencia_id == $procedencias->id) echo "selected"; ?> value="<?= $procedencias->id ?>"><?= $procedencias->nombre ?></option>
                        <?php endforeach; ?>

                      </select>
                    </div>
                    <div class="col-lg-4 ">
                      <label class="form-label">Dirección </label>
                      <input type="text" class="form-control" name="direccion" value="<?= $usuario->direccion ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr class="border-light m-0">
          <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">Guardar Registro</button>&nbsp;

            <a href="<?= $this->ROL->find($usuario->rol_id)->fillable['id'] == 2 ? $this->Route('analista') : $this->Route('analista') ?>" class="btn btn-outline-primary">Volver</a>

          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- / Content -->
</div>

<style>
  label.error {
    float: none;
    color: red;
    padding-left: .5em;
    vertical-align: middle;
    font-size: 14px;
  }
</style>

<script>
  $(document).ready(() => {

  });
  $('#status').on('change', function() {
    if ($('#status').val() == 1) {
      $('#status').val(0);
    } else {
      $('#status').val(1);
    }
  });

  jQuery.validator.addMethod("number",
    function(value, element) {
      return /^[0-9\d=#$%@_ -]+$/.test(value);
    },
    "Debe ingresar solo números"
  );
/*   jQuery.validator.addMethod("alpha", function(value, element) {
    return /^[A-Za-zñÑ\d=#$%@_ -]+$/.test(value);
  }, "Use solo letras"); */

  jQuery.validator.addMethod("alpha", function(value, element) {
    return /^[a-z A-Z ñÑ]*$/.test(value); },"Debe ingresar solo letras");
  [a - zA - Z] * $
  $(function() {

    $("#usuarioeditar").validate({
      rules: {
        nombre: {
          minlength: 3,
          required: true,
          alpha: true,
        },
        apellido: {
          minlength: 5,
          required: true,
          alpha: true,
        },
        cedula: {
          minlength: 7,
          required: true,
        },
        email: {
          minlength: 3,
          required: true,

        },
        telefono: {
          minlength: 3,
          number: true,
          required: true,

        },
        nacimiento: {
          minlength: 3,
          required: true,
        },
        contrasena: {
          minlength: 3,
          required: true,
        },

      },
      messages: {
        nombre: {
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          required: 'Complete este campo porfavor',
        },
        apellido: {
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          required: 'Complete este campo porfavor',
        },
        cedula: {
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          required: 'Complete este campo porfavor',
        },
        email: {
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          required: 'Complete este campo porfavor',
        },
        telefono: {
          required: 'Complete este campo porfavor',
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          number: 'Solo numeros porfavor',
        },
        nacimiento: {
          required: 'Complete este campo porfavor',
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
        },
        password: {
          required: 'Complete este campo porfavor',
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
        },
      }
    });
  });
</script>