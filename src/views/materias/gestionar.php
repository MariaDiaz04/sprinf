<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Materias </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Materias</h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Trayecto</th>
            <th>Fase</th>
            <th>Dimensiones</th>
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
          <h5 class="modal-title" id="crearLabel">Nueva Materia</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('materias/guardar') ?>" method="post" id="guardar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
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
                    <div class="col-lg-6">
                      <label class="form-label" for="trayecto">Trayecto *</label>
                      <select class="form-select" id="trayecto" name="trayecto">
                        <option value="1">Trayecto I</option>
                        <option value="2">Trayecto II</option>
                        <option value="3">Trayecto III</option>
                        <option value="4">Trayecto IV</option>
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


  <script>
    $(document).ready(() => {

      toggleLoading(false)

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido




      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('materias/ssp') ?>',
        processing: true,
        serverSide: true,
        columnDefs: [{
          data: null,
          render: function(data, type, row, meta) {
            return `<div class="dropdown show">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                        <a class="dropdown-item" onClick="edit('${row[0]}')" href="#">Editar</a>
                        <a class="dropdown-item text-danger" onClick="remove('${row[0]}') href="#">Eliminar</a>
                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 5 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
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
            alert(error.responseText)
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
  </script>