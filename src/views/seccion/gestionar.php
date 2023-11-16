<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Seccion </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Seccion</h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="table table-striped" style="width:100%">
        <thead class="thead-dark">
          <tr>
            <th>codigo</th>
            <th>trayecto</th>
            <th>observacion</th>
            <th>Acción</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!-- MODAL CREAR -->
  <div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Nueva Sección</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('seccion/guardar') ?>" method="post" id="guardar" name="Seccionguardar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <!-- los inputs son validados con las funciones que se extraeran del controlador de periodo -->
                    <div class="col-lg-6">
                      <label class="form-label" for="trayecto_id">Trayecto *</label>
                      <select class="form-select" name="trayecto_id" id="id">
                        <option>Seleccione</option>
                        <?php foreach ($trayectos as $trayecto) : ?>
                          <option value="<?= $trayecto->codigo ?>"><?= "$trayecto->nombre" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Código *</label>
                      <input type="text" class="form-control mb-1" placeholder="IN...." pattern="([A-Z]{2,3})([1-9]){4}$" name="codigo" id="codigo" autocomplete="off">
                      <h6 id="codigoCheck" style="color: red;">
                        ** El código es requerido **
                      </h6>
                    </div>
                  </div>
                  <div class="row form-group">
                    <!-- los inputs son validados con las funciones que se extraeran del controlador de periodo -->
                    <div class="col-lg-12">
                      <label class="form-label" for="nombre">Observación</label>
                      <input type="textarea" class="form-control mb-1" name="observacion" id="observacion" autocomplete="off">
                      <h6 id="observacionCheck" style="color: red;">
                      </h6>
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
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>


  <!-- MODAL ACTUALIZAR -->
  <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Actualizar sección</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('seccion/update') ?>" method="post" id="actualizar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="trayecto_id">Trayectos *</label>
                      <select class="form-select" name="trayecto_id" id="trayecto_idEdit">
                        <?php foreach ($trayectos as $trayecto) : ?>
                          <option value="<?= $trayecto->codigo ?>"><?= "$trayecto->nombre" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Código *</label>
                      <input type="text" class="form-control mb-1" placeholder="IN...." pattern="([A-Z]{2,3})([1-9]){4}$" id="codigoEdit" autocomplete="off" disabled>
                      <input type="hidden" name="codigo" id="codigoEditTwo">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-12">
                      <label class="form-label" for="observacionEdit">Observaciones</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="observacion" id="observacionEdit">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- footer de acciones -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Guardar" id="submit">
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
    let updateUrl = "<?= APP_URL . $this->Route('seccion/edit') ?>";
    let deleteUrl = "<?= APP_URL . $this->Route('seccion/delete') ?>";

    let regexSeccion = /^([A-Z]{2,3})([1-9]){4}/;
    $(document).ready(() => {

      toggleLoading(false)

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido


      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('seccion/ssp') ?>',
        processing: true,
        serverSide: true,
        pageLength: 30,

        columnDefs: [{
          data: null,
          render: function(data, type, row, meta) {
            return `<div class="dropdown show">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                        <a class="dropdown-item" onClick="editar('${row[0]}')" href="javascript:void(0)">Editar</a>
                        <a class="dropdown-item text-danger" onClick="remove('${row[0]}')" href="javascript:void(0)">Eliminar</a>
                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 3 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        }]
      });

      $("#codigoCheck").hide();
      let codigoError = true;
      $("#codigo").keyup(function() {
        validateCodigo();
      });

      function validateCodigo() {
        let codigoValue = $("#codigo").val();
        if (codigoValue.length == "") {
          console.log('entre en vacio');
          $("#codigoCheck").show();
          codigoError = false;
          return false;
        } else if (codigoValue.length < 3 || codigoValue.length > 10) {
          $("#codigoCheck").show();
          $("#codigoCheck").html("**El codigo debe estar entre 3 y 10 digitos");
          codigoError = false;
          return false;
        } else {
          $("#codigoCheck").hide();
          codigoError = true;
        }
      }

      $("#observacionCheck").hide();
      let observacionError = true;
      $("#observacion").keyup(function() {
        validateObservacion();
      });

      function validateObservacion() {
        let observacionValue = $("#observacion").val();
        if (observacionValue.length >= 205) {
          $("#observacionCheck").show();
          $("#observacionCheck").html("**La observación máximo 205 dígitos");
          observacionError = false;
          $('#guardarSubmit').attr('disabled', true);
          return false;
        } else if (observacionValue.length <= 205) {
          $("#observacionCheck").hide();
          observacionError = true;
          $('#guardarSubmit').attr('disabled', false);
        } else {
          $("#observacionCheck").hide();
          observacionError = true;
        }
      }
      $('#guardar').submit(function(e) {
        e.preventDefault()
        toggleLoading(true, '#guardar');
        url = $(this).attr('action');
        data = $(this).serializeArray();
        validateCodigo();
        if (codigoError == false) {
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: 'No se puede crear una seccion sin datos',
            showConfirmButton: false,
            toast: true,
            timer: 2000
          })
          document.getElementById("guardar").reset();
          toggleLoading(false, '#guardar')
          codigoError = true;
        } else {
          $.ajax({
            type: "POST",
            url: url,
            data: data,
            error: function(error, status) {
              toggleLoading(false, '#guardar')
              Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: error.responseText,
                showConfirmButton: false,
                toast: true,
                timer: 2000
              })
              console.log(error)
            },
            success: function(data, status) {
              table.ajax.reload();
              // usar sweetalerts
              console.log(data)
              document.getElementById("guardar").reset();
              toggleLoading(false, '#guardar')
              $('#crear').modal('hide');
              // actualizar tabla
            },
          });

        }

      })

      $('#actualizar').submit(function(e) {
        e.preventDefault()
        toggleLoading(true, '#actualizar');
        url = $(this).attr('action');
        data = $(this).serializeArray();
        $.ajax({
          type: "POST",
          url: url,
          data: data,
          error: function(error, status) {
            toggleLoading(false, '#actualizar')
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
            Swal.fire({
              position: 'bottom-end',
              icon: 'success',
              title: 'Seccion editada con exito',
              showConfirmButton: false,
              toast: true,
              timer: 1500
            })
            // actualizar tabla
            toggleLoading(false, '#actualizar')
            $('#editar').modal('hide')
          },
        });

      })



      // TOGGLE BUTTON AND SPINNER
      function toggleLoading(show, form = '') {
        if (show) {
          $(`${form} #loading`).show();
          $(`${form} #submit`).hide();
        } else {
          $(`${form} #loading`).hide();
          $(`${form} #submit`).show();
        }
      }

    })

    function renderUpdateForm(data) {
      $('#editar').modal('show')
      // seleccionar trayecto
      $(`#actualizar #trayecto_idEdit option[value='${data.seccion.trayecto_id}']`).attr("selected", true);
      $(`#actualizar #codigoEdit`).val(data.seccion.codigo);
      $(`#actualizar #codigoEditTwo`).val(data.seccion.codigo);
      $(`#actualizar #observacionEdit`).val(data.seccion.observacion);

    }

    function editar(id) {
      $.ajax({
        type: "POST",
        url: updateUrl,
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
          renderUpdateForm(JSON.parse(data))
        },
      });
    }

    function remove(id) {
      $.ajax({
        type: "POST",
        url: deleteUrl,
        data: {
          'seccion_id': id
        },
        error: function(error, status) {
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: error.responseText,
            showConfirmButton: false,
            toast: true,
            timer: 3000
          })

        },
        success: function(data, status) {
          console.log(data);
          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: 'Seccion borrada con exito',
            showConfirmButton: false,
            toast: true,
            timer: 1500
          })
          $('#example').DataTable().ajax.reload();
        },
      });
    }
  </script>