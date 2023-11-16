<div>
  <?php if ($permisos == null) : ?>
    <div class="col-12 text-muted py-5 my-5">
      <h4 class="text-center my-5">No tiene permisos para ver este modulo (contacte con soporte tecnico)</h4>
    </div>
  <?php elseif ($permisos->consultar != 1) : ?>
    <div class="col-12 text-muted py-5 my-5">
      <h4 class="text-center my-5">No tiene permisos para ver este modulo (contacte con soporte tecnico) </h4>
    </div>
  <?php elseif ($permisos->consultar == 1) : ?>

    <div>
      <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
        <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
          <div><span class="text-muted font-weight-light">Unidades Curriculares / <?= $trayecto->nombre ?> </span>/ Gestión</div>
          <?php if ($permisos->crear == 1) : ?>

            <a class="btn btn-primary btn-round d-block flex-shrink-0" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>
          <?php endif; ?>

        </h4>
      </div>
    </div>

    <div class="card">
      <h6 class="card-header bg-primary text-white">Unidades Curriculares</h6>
      <div class="card-body px-3 pt-3">
        <table id="example" class="table table-striped" style="width:100%">
          <thead class="thead-dark">
            <tr>
              <th>Trayecto</th>
              <th>Código</th>
              <th>Nombre</th>
              <th>Periodo</th>
              <th>Fase</th>
              <th>Estatus en Baremos</th>
              <th>Acción</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  <?php endif; ?>

  <!-- MODAL CREAR -->
  <div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Nueva Unidad Curricular</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('materias/guardar') ?>" method="post" id="guardar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="trayecto_id">Trayectos *</label>
                      <select class="form-select" name="trayecto_id">
                        <?php foreach ($trayectos as $trayecto) : ?>
                          <option value="<?= $trayecto->codigo ?>"><?= "$trayecto->nombre - $trayecto->fecha_inicio / $trayecto->fecha_cierre" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="periodo">Periodo *</label>
                      <select class="form-select" id="periodo" name="periodo">
                        <option value="fase_1">Fase 1</option>
                        <option value="fase_2">Fase 2</option>
                        <option value="anual">Anual</option>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group">
                    <!-- los inputs son validados con las funciones que se extraeran del controlador de periodo -->
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Código *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="codigo" id="codigo">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre">
                    </div>
                  </div>

                  <div class="row form-group">
                    <!-- horas -->
                    <div class="col-lg-4">
                      <label class="form-label" for="htasist">Horas Total Asist *</label>
                      <input type="number" class="form-control mb-1" placeholder="..." name="htasist" id="htasist">
                    </div>
                    <div class="col-lg-4">
                      <label class="form-label" for="htind">Horas Total ind *</label>
                      <input type="number" class="form-control mb-1" placeholder="..." name="htind" id="htind">
                    </div>

                    <div class="col-lg-4">
                      <label class="form-label" for="ucredito">Horas Academicas *</label>
                      <input type="number" class="form-control mb-1" placeholder="..." name="ucredito" id="ucredito">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="hrs_acad">UCredito *</label>
                      <input type="number" class="form-control mb-1" placeholder="..." name="hrs_acad" id="hrs_acad">
                    </div>

                    <div class="col-lg-6">
                      <label class="form-label" for="eje">Eje *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="eje" id="eje">
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

  <!-- MODAL ACTUALIZAR -->
  <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Actualizar Unidad Curricular</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('materias/update') ?>" method="post" id="actualizar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="trayecto_id">Trayectos *</label>
                      <select class="form-select" name="trayecto_id">
                        <?php foreach ($trayectos as $trayecto) : ?>
                          <option value="<?= $trayecto->codigo ?>"><?= "$trayecto->nombre - $trayecto->fecha_inicio / $trayecto->fecha_cierre" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="periodo">Periodo *</label>
                      <select class="form-select" id="periodo" name="periodo">
                        <option value="fase_1">Fase 1</option>
                        <option value="fase_2">Fase 2</option>
                        <option value="anual">Anual</option>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group">
                    <!-- los inputs son validados con las funciones que se extraeran del controlador de periodo -->
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Código *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="codigo" id="codigo" readonly>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre">
                    </div>
                  </div>

                  <div class="row form-group">
                    <!-- horas -->
                    <div class="col-lg-4">
                      <label class="form-label" for="htasist">Horas Total Asist *</label>
                      <input type="number" class="form-control mb-1" placeholder="..." name="htasist" id="htasist">
                    </div>
                    <div class="col-lg-4">
                      <label class="form-label" for="htind">Horas Total ind *</label>
                      <input type="number" class="form-control mb-1" placeholder="..." name="htind" id="htind">
                    </div>

                    <div class="col-lg-4">
                      <label class="form-label" for="ucredito">Horas Academicas *</label>
                      <input type="number" class="form-control mb-1" placeholder="..." name="ucredito" id="ucredito">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="hrs_acad">UCredito *</label>
                      <input type="number" class="form-control mb-1" placeholder="..." name="hrs_acad" id="hrs_acad">
                    </div>

                    <div class="col-lg-6">
                      <label class="form-label" for="eje">Eje *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="eje" id="eje">
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
    let updateUrl = "<?= APP_URL . $this->Route('materias/edit') ?>";
    let deleteUrl = "<?= APP_URL . $this->Route('materias/delete') ?>";

    $(document).ready(() => {

      toggleLoading(false)

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('ssp/' . $idTrayecto) ?>',
        processing: true,
        serverSide: true,
        pageLength: 30,

        columnDefs: [{
          visible: false,
          targets: [0, 4]
        }, {
          data: null,
          render: function(data, type, row, meta) {
            return row[3] > 1 ? 'Anual' : row[4];
          },
          targets: 3
        }, {
          data: null,
          render: function(data, type, row, meta) {
            return row[6] >= 1 ? '<span class="badge rounded-pill bg-primary">Vincula</span>' : '<span class="badge rounded-pill bg-secondary">No vincula</span>';
          },
          targets: 5
        }, {
          data: null,
          render: function(data, type, row, meta) {
            return `<div class="dropdown show">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[1]}">
                        ${(row[5] ? `<a class="dropdown-item" target="_blank" href="<?= APP_URL . $this->Route("materias/" . $idTrayecto) ?>/${row[1]}">Inscripciones</a>`:'' )}
                        <?php if ($permisos->actualizar == 1) : ?>
                        <a class="dropdown-item" onClick="edit('${row[1]}')" href="#">Editar</a>
                        <?php endif; ?>
                        <?php if ($permisos->eliminar == 1) : ?>
                        <a class="dropdown-item text-danger" onClick="remove('${row[1]}')" href="#">Eliminar</a>
                        <?php endif; ?>

                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 6 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        }]
      });



      $('#guardar').submit(function(e) {
        e.preventDefault()
        toggleLoading(true, '#guardar');
        url = $(this).attr('action');
        data = $(this).serializeArray();
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
            Swal.fire({
              position: 'bottom-end',
              icon: 'success',
              title: 'Unidad Curricular creada con exito',
              showConfirmButton: false,
              toast: true,
              timer: 1500
            }).then(() => location.reload())
            $('#crear').modal('hide');
            $('#crear').modal('closed');
            document.getElementById("guardar").reset();
            // actualizar tabla
            toggleLoading(false, '#guardar')
          },
        });

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
              title: 'Unidad Curricular editada con exito',
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

    function edit(id) {
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

    function renderUpdateForm(data) {

      $('#editar').modal('show')

      // seleccionar trayecto
      $(`#actualizar #trayecto_id option[value='${data.materia.trayecto_id}']`).attr("selected", true);
      // seleccionar periodo
      $(`#actualizar #periodo option[value='${data.materia.periodo}']`).attr("selected", true);

      $(`#actualizar #codigo`).val(data.materia.codigo);
      $(`#actualizar #nombre`).val(data.materia.nombre);
      $(`#actualizar #eje`).val(data.materia.eje);

      $(`#actualizar #htasist`).val(data.materia.htasist);
      $(`#actualizar #htind`).val(data.materia.htind);
      $(`#actualizar #ucredito`).val(data.materia.ucredito);
      $(`#actualizar #hrs_acad`).val(data.materia.hrs_acad);

    }

    function remove(id) {
      $.ajax({
        type: "POST",
        url: deleteUrl,
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
          console.log(data);
          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: 'Unidad Curricular borrada con exito',
            showConfirmButton: false,
            toast: true,
            timer: 1500
          })
          $('#example').DataTable().ajax.reload();
        },
      });
    }
  </script>