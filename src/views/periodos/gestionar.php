<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Periodos </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Periodos</h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Fecha Inicial</th>
            <th>Fecha Final</th>
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
          <h5 class="modal-title" id="crearLabel">Nuevo Periodo</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('periodos/guardar') ?>" method="post" id="guardar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <!-- los inputs son validados con las funciones que se extraeran del controlador de periodo -->
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Fecha Inicial *</label>
                      <input type="date" class="form-control mb-1" placeholder="..." name="fecha_inicial" id="fecha_inicial">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Fecha Final *</label>
                      <input type="date" class="form-control mb-1" placeholder="..." name="fecha_final" id="fecha_final">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- footer de acciones -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Guardar">
          </div>
        </form>
      </div>
    </div>
  </div>


  <script>
    $(document).ready(() => {

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let editBtn = "<button class=\"btn btn-outline-secondary btn-color btn-bg-color col-xs-6 mx-2 edit\">Editar</button>";
      let deleteBtn = "<button class=\"btn btn-outline-danger btn-color btn-bg-color col-xs-6 mx-2 remove\">Eliminar</button>";


      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('periodos/ssp') ?>',
        processing: true,
        serverSide: true,
        columnDefs: [{
          data: null,
          defaultContent: `${editBtn} ${deleteBtn}`, // combino los botons de acción
          targets: 3 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        }]
      });

      table.on('click', 'button', function(e) {
        var action = this.className;
        var data = table.row($(this).parents('tr')).data();

        if (action.includes('remove')) {
          // ejecutar función que se encarge de borrar el elemento
          remove(data[0])
        }

        if (action.includes('edit')) {
          // ejecutar función que se encarge de editar el elemento
          edit(data[0])
        }
      });
    })

    $('#guardar').submit(function(e) {
      e.preventDefault()


      url = $(this).attr('action');
      data = $(this).serializeArray();

      console.log(url);
      console.log(data)


      $.ajax({
        type: "POST",
        url: url,
        data: data,
        error: function(error, status) {
          alert(error.responseText)
        },
        success: function(data, status) {
          alert('creado exitosamente') // usar sweetalerts
          // actualizar tabla
        },
      });

    })

    function edit(id) {
      alert(`Editing ${id}`)
    }

    function remove(id) {
      alert(`Removing ${id}`)
    }
  </script>