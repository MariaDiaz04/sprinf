<h4 class="font-weight-bold py-3 mb-4">
            <span class="text-muted font-weight-light">Sección  /</span> Agregar
          </h4>

          <div class="card">
            <h5 class="card-header bg-primary text-white">
            Agregar nuevo
            </h5>

            <div class="card-body">
              <form action="<?= $this->Route('seccionGuardar') ?>" method="post" id="seccionGuardar">
                <div class="container-fluid">
                  <div class="row pb-2">
                    <!-- <div class="row form-group"> -->
                      
                      <div class="col-lg-2">
                        <label class="form-label ">Nombre</label>
                        <input type="text" class="form-control mb-1" placeholder="INF0001" name="nombre" minlength="5" required >
                        <span id="nombre"></span>
                      </div>

                      <div class="col-lg-3">
                        <label class="form-label ">Trayecto</label>
                        <br>
                        <select class="custom-select  form-select" name="trayecto_id" id="codigo">
                          <option disabled selected>Seleccione el Trayecto</option>
                            <?php foreach ($trayecto as $objtrayecto) : ?>
                            <option value="<?= $objtrayecto->id ?>"><?= $objtrayecto->nombre ?></option>
                            <?php endforeach;?>
                        </select>
                      </div>
                      
                      <!-- <div class="col-lg-2 ">
                        <label class="form-label ">Fase</label>
                        <input type="text" class="form-control mb-1" placeholder="Fase 1" name="nombre" minlength="5" required >
                        <span id="nombre"></span>
                      </div> -->
                      
                      <div class="col-lg-3  ">
                        <label class="form-label ">Materias</label>
                        <select class="custom-select  form-select" name="materia_id" id="codigo">
                          <option disabled selected>Seleccione la Materia</option>
                          <?php foreach ($materias as $objmaterias) : ?>
                          <option value="<?= $objmaterias->id ?>"><?= $objmaterias->nombre ?></option>
                          <?php endforeach;?>
                        </select>
                      </div>

                      <div class="col-lg-2">
                        <br>
                        <button class="btn btn-primary" id="anadirEstudiante">Añadir</button>
                      </div>

                    <!-- </div> -->
                  </div>

                  <div class="row form-group justify-content-center">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Còdigo</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Tipo</th>
                          <th scope="col">Activo</th>
                        </tr>
                      </thead>
                      <tbody id="materias">

                      </tbody>
                    </table>
                  </div>

                </div>
              </form>
            </div>
          </div>

          <!-- Content -->
          <!--
          <div class="card">
            <h5 class="card-header bg-primary text-white">
              Agregar nuevo
            </h5>
            <div class="card-body">
              <form action="<?= $this->Route('seccionGuardar') ?>" method="post" id="seccionGuardar">
                <div class="container-fluid">
                  <div class="row pb-2">
                    <div class="col-12">
                      <div class="row form-group">
                        <div class="col-lg-2">
                          <label class="form-label ">Nombre</label>
                          <input type="text" class="form-control mb-1" placeholder="INF0001" name="nombre" minlength="5" required >
                          <span id="nombre"></span>
                        </div>
                        <div class="col-lg-3">
                          <label class="form-label ">Trayecto</label>
                          <br>
                          <select class="custom-select  form-select" name="trayecto_id" id="codigo">
                                <option disabled selected>Seleccione el Trayecto</option>
                                    <?php foreach ($trayecto as $objtrayecto) : ?>
                                    <option value="<?= $objtrayecto->id ?>"><?= $objtrayecto->nombre ?></option>
                                    <?php endforeach;?>
                            </select>
                          <div class="col-lg-4 ">
                          <label class="form-label ">Fase</label>
                          <input type="text" class="form-control mb-1" placeholder="Fase 1" name="nombre" minlength="5" required >
                          <span id="nombre"></span>
                          </div>
                        <div class="col-lg-6  ">
                          <label class="form-label ">Materias</label>
                          <input type="text" class="form-control mb-1" placeholder="Fase 1" name="nombre" minlength="5" required >
                          <span id="nombre"></span>
                        </div>
                        <div class="col-lg-1 align-middle">
                <button class="btn btn-primary" id="anadirEstudiante">Añadir</button>
              </div>

              <div class="col-12 mb-4">
            <div class="row form-group justify-content-center">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Còdigo.</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Tipo</th>
                   
                  </tr>
                </thead>
                <tbody id="materias">

                </tbody>
              </table>
            </div>
          </div>

                          
                        </div>
                       </div>
                     </div>
                 </div>
             </div>

                  <hr class="border-light m-0">
                  <div class="text-right mt-3">
                    <input type="submit" class="btn btn-primary" value='Guardar Registro' />&nbsp;
                    <a href="<?= $this->Route('seccion') ?>" class="btn btn-outline-primary">Volver</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- / Content -->


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
          </script> 