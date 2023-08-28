<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Dimensiones </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Dimensiones</h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Materia</th>
            <th>Fase</th>
            <th>Trayecto</th>
            <th>Grupal</th>
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
          <h5 class="modal-title" id="crearLabel">Nueva Dimension</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('dimensiones/guardar') ?>" method="post" id="guardar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group mb-3">
                    <!-- los inputs son validados con las funciones que se extraeran del controlador de periodo -->
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre">
                    </div>
                    <div class="col-lg-3">
                      <label class="form-label" for="trayecto">Trayecto *</label>
                      <select class="form-select" id="trayecto" name="trayecto">
                        <option value="1">Trayecto I</option>
                        <option value="2">Trayecto II</option>
                        <option value="3">Trayecto III</option>
                        <option value="4">Trayecto IV</option>
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <label class="form-label" for="trayecto">Fase *</label>
                      <select class="form-select" id="trayecto" name="trayecto">
                        <option value="fase_1">Fase I</option>
                        <option value="fase_2">Fase II</option>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group mb-3">
                    <div class="col-lg-6">
                      <label class="form-label" for="trayecto">Evaluador *</label>
                      <select class="form-select" id="trayecto" name="trayecto">
                        <option value="fase_1">Base de datos</option>
                        <option value="fase_1">Base de datos II</option>
                        <option value="fase_2">Proyecto Sociotecnologico</option>
                        <option value="fase_2">Algoritmica y Programación I</option>
                        <option value="fase_2">Proyecto Sociotecnologico</option>
                      </select>
                    </div>
                    <div class="col-lg-6 d-flex justify-content-start align-items-end">
                      <div class="form-check ">
                        <input class="form-check-input" type="checkbox" value="1" id="vinculacion" name="vinculacion">
                        <label class="form-check-label" for="vinculacion">
                          Evaluación Grupal
                        </label>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row form-group align-items-end">
                    <div class="col-lg-5">
                      <label class="form-label" for="nombreItem">Nombre *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." id="nombreItem">
                    </div>
                    <div class="col-lg-4">
                      <label class="form-label" for="ponderacionItem">Ponderación *</label>
                      <input type="number" class="form-control mb-1" placeholder="..." id="ponderacionItem">
                    </div>
                    <div class="col-lg-3 align-middle">
                      <button class="btn btn-primary" id="anadirItem">Añadir</button>
                    </div>
                  </div>

                  <div class="row form-group justify-content-center">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Nombre</th>
                          <th scope="col">Ponderación</th>
                          <th scope="col">Remover</th>
                        </tr>
                      </thead>
                      <tbody id="cuerpoTablaItems">

                      </tbody>
                    </table>
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

      $('#anadirItem').click(function(e) {
        e.preventDefault();


        let nombreItem = $('#nombreItem').val();
        let ponderacionItem = $('#ponderacionItem').val();


        if ($("#cuerpoTablaEstudiantes").find(`#appenedStudent-${studentId}`).length > 0) {
          alert('Estudiante ya ha sido añadido')
          return false;
        }

        console.log($(selectedStudent).data('nombre'))
        let fila = `<tr id="appenedStudent-${studentId}">
                    <th scope="row">
                    <input type="text" name="estudiantes[]" class="form-control-plaintext" value="${studentId}" hidden>
                    ${$(selectedStudent).data('cedula')}
                    </th>
                    <td>${$(selectedStudent).data('nombre')}</td>
                    <td>${$(selectedStudent).data('apellido')}</td>
                    <td><button class="btn btn-secondary" onClick="removeStudent(${studentId})">Eliminar</button></td>
                  </tr>`;
        $('#cuerpoTablaEstudiantes').append(fila);

        //$(`#selectEstudiante option[value='${studentId}']`).remove();

      })

      toggleLoading(false)

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let editBtn = "<button class=\"btn btn-outline-secondary btn-color btn-bg-color col-xs-6 mx-2 edit\">Editar</button>";
      let deleteBtn = "<button class=\"btn btn-outline-danger btn-color btn-bg-color col-xs-6 mx-2 remove\">Eliminar</button>";


      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('dimensiones/ssp') ?>',
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
          targets: 6 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
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