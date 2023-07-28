          <h4 class="font-weight-bold py-3 mb-4">
            <span class="text-muted font-weight-light"><?php echo $this->ROL->find($rol)->fillable['nombre']; ?> /</span> Agregar
          </h4>
          <!-- Content -->
          <div class="card">
            <h5 class="card-header bg-primary text-white">
              Agregar nuevo
            </h5>
            <div class="card-body">
              <form action="<?= $this->Route('usuarioGuardar') ?>" method="post" id="usuarioguardar">
                <div class="container-fluid">
                  <div class="row pb-2">
                    <div class="col-12">
                      <div class="row form-group">
                        <div class="col-lg-5">
                          <label class="form-label ">Nombre</label>
                          <input type="text" class="form-control mb-1" placeholder="Juan Andres" name="nombre">
                        </div>
                        <div class="col-lg-5">
                          <label class="form-label">Apellido </label>
                          <input type="text" class="form-control" placeholder="Pacheco Martinez" name="apellido">
                        </div>
                        <div class="col-lg-2 ">
                          <label class="form-label">Cedula </label>
                          <input autocomplete="off" type="number" class="form-control" placeholder="424308987" name="cedula">
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row form-group">
                        <div class="col-lg-5">
                          <label class="form-label ">Correo</label>
                          <input type="email" class="form-control mb-1" value="" placeholder="ejemplo@domian.com" name="email">
                        </div>
                        <div class="col-lg-3">
                          <label class="form-label ">Teléfono</label>
                          <input type="number" class="form-control mb-1" value="" placeholder="0212424655874" name="telefono" id="html5-tel-input">
                        </div>
                        <div class="col-lg-4">
                          <label class="form-label">Fecha de nacimiento</label>
                          <input type="date" class="form-control" value="" name="nacimiento">
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="row form-group">
                        <div class="col-lg-4">
                          <label class="form-label">Dirección</label>
                          <input type="text" class="form-control" value="" placeholder="Av Venezuela con Moran" name="direccion">
                        </div>
                        <div class="col-lg-4">
                          <label class="form-label">Contraseña</label>
                          <input type="password" class="form-control" value="" placeholder="* * * * *" name="contrasena" required>
                        </div>
                     <!--    <div class="col-lg-4">
                          <label class="form-label">Procedencia</label>
                          <select class="custom-select" name="procedencia">
                             <?php foreach ($procedencia as $procedencias) : ?>
                              <option value="<?= $procedencias->id ?>"><?= $procedencias->nombre ?></option>
                            <?php endforeach; ?>

                          </select> 
                        </div>-->
                        <input type="text" name="rol" value="<?= $rol ?>" hidden>
                      </div>
                    </div>
                  </div>
                  <hr class="border-light m-0">
                  <div class="text-right mt-3">
                    <input type="submit" class="btn btn-primary" value='Guardar Registro' />&nbsp;
                    <?php if ($this->ROL->find($rol)->fillable['id'] == 2) : ?>
                      <a href="<?= $this->Route('profesor') ?>" class="btn btn-outline-primary">Volver</a>
                    <?php endif ?>
                    <?php if ($this->ROL->find($rol)->fillable['id'] == 4) : ?>
                      <a href="<?= $this->Route('estudiante') ?>" class="btn btn-outline-primary">Volver</a>
                    <?php endif ?>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- / Content -->


        <!--   <style>
            label.error {
              float: none;
              color: red;
              padding-left: .5em;
              vertical-align: middle;
              font-size: 14px;
            }
          </style> -->
<!-- 
          <script>
            jQuery.validator.addMethod("number",
              function(value, element) {
                return /^[0-9\d=#$%@_ -]+$/.test(value);
              },
              "Debe ingresar solo números"
            );
            jQuery.validator.addMethod("alpha", function(value, element) {
              return /^[a-z A-Z ñÑ]*$/.test(value);
            }, "Debe ingresar solo letras");


            $(function() {
              $("#usuarioguardar").validate({
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
                    number: true
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
                    date: true,
                    required: true,
                  },
                  contrasena: {
                    minlength: 6,
                    required: true,
                  },
                  direccion: {
                    minlength: 6,
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
                  contrasena: {
                    required: 'Complete este campo porfavor',
                    minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
                  },
                  direccion: {
                    minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
                    required: 'Complete este campo porfavor',
                  },
                }
              });
            });
          </script> -->