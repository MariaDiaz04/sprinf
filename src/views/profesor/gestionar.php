<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Profesores </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Profesores</h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="table table-striped" style="width:100%">
        <thead class="thead-dark">
          <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>email</th>
            <th>Acción</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!-- MODAL CREAR -->
  <div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Nuevo Docente</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('profesores/guardar') ?>" method="post" id="guardar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Cedula *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="cedula" id="cedula">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="apellido">Apellido *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="apellido" id="apellido">
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
                      <input type="number" class="form-control mb-1" placeholder="..." name="telefono" id="telefono">
                    </div>
                  </div>

                  <!-- <div class="row form-group"> -->
                  <br>
                  <hr>
                  <h5 class="modal-title" id="crearLabel">Usuario Docente</h5>
                  <br>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="email">Correo Electronico</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="email" id="email">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="contrasena">Contraseña</label>
                      <input type="password" class="form-control mb-1" placeholder="..." name="contrasena" id="contrasena">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- footer de acciones -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>

            <input type="submit" class="btn btn-primary" value="Guardar" id="guardarSubmit">
            <div id="guardarLoading">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- MODAL DATOS CONTACTO -->
  <div class="modal fade" id="datos" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Datos de Contacto</h5>
        </div>
        <div class="modal-body">
          <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
          <div class="container-fluid" id="datosContacto">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row">
                  <div class="col-lg-6">
                    <label class="form-label" for="direccion">Dirección *</label>
                    <input type="text" class="form-control mb-1" placeholder="..." name="direccion" id="direccion" readonly>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label" for="apellido">Teléfono *</label>
                    <input type="text" class="form-control mb-1" placeholder="..." name="telefono" id="telefono" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- footer de acciones -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <script>
    let showDetailsUrl = "<?= APP_URL . $this->Route('profesores/showDetails') ?>";
    $(document).ready(() => {

      toggleLoading(false)

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('profesores/ssp') ?>',
        processing: true,
        serverSide: true,
        pageLength: 30,

        columnDefs: [{
          data: null,
          render: function(data, type, row, meta) {
            return `<div class="btn-group dropstart">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" id="dropdown-${row[0]}" >
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                        <a class="dropdown-item" onClick="showDetails('${row[4]}')" href="#">Mostrar Datos de Contacto</a>
                        <a class="dropdown-item" onClick="edit('${row[0]}')" href="#">Editar</a>
                        <a class="dropdown-item text-danger" onClick="remove('${row[0]}') href="#">Eliminar</a>
                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 4 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        }]
      });



      $('#guardar').submit(function(e) {
        e.preventDefault()

        toggleLoading(true);

        url = $(this).attr('action');
        data = $(this).serializeArray();
        $.ajax({
          type: "POST",
          url: url,
          data: data,
          error: function(error, status) {
            toggleLoading(false)
            Swal.fire({
              position: 'bottom-end',
              icon: 'error',
              title: error.responseText,
              showConfirmButton: false,
              toast: true,
              timer: 2000
            })

          },
          success: function(data, status) {
            table.ajax.reload();
            // usar sweetalerts
            document.getElementById("guardar").reset();
            // actualizar tabla
            toggleLoading(false)
          },
        });

      })


      function edit(id) {
        alert(`Editing ${id}`)
      }

      function remove(id) {
        alert(`Removing ${id}`)
      }

      // TOGGLE BUTTON AND SPINNER
      function toggleLoading(show) {
        if (show) {
          $('#guardarLoading').show();
          $('#guardarSubmit').hide();
        } else {
          $('#guardarLoading').hide();
          $('#guardarSubmit').show();
        }

      }
    })

    function showDetails(id) {

      $.ajax({
        type: "POST",
        url: showDetailsUrl,
        data: {
          'codigo': id
        },
        error: function(error, status) {
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: error.responseText,
            showConfirmButton: false,
            toast: true,
            timer: 2000
          })

        },
        success: function(data, status) {
          datos = JSON.parse(data)
          $('#datos').modal('show')
          $('#datosContacto').find('#telefono').val(datos.telefono)
          $('#datosContacto').find('#direccion').val(datos.direccion)
        },
      });
    }
  </script>