<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Proyectos </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Proyectos</h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Comunidad</th>
            <th>Trayecto</th>
            <th>Fase</th>
            <th>Integrantes</th>
            <th>Estatus</th>
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
          <h5 class="modal-title" id="crearLabel">Nuevo Proyecto</h5>

        </div>
        <div class="modal-body">
          <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardar">
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="nombre">
                    </div>

                    <div class="col-lg-6">
                      <label class="form-label" for="fase_id">Fase *</label>
                      <select class="form-select" name="fase_id" id="selectFaseId">

                        <?php foreach ($fases as $fase) : ?>
                          <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto - $fase->nombre_fase" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row form-group">

                    <div class="col-lg-6">
                      <label class="form-label" for="resumen">Resumen</label>
                      <textarea class="form-control" placeholder="..." id="resumen" name="resumen" style="height: 100px"></textarea>
                    </div>

                    <div class="col-lg-3">
                      <label class="form-label" for="municipio">Municipio</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="municipio">
                    </div>

                    <div class="col-lg-3">
                      <label class="form-label" for="area">Area</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="area">
                    </div>
                  </div>
                </div>

                <div class="col-12">
                  <div class="row form-group align-items-end">

                    <div class="col-lg-10">
                      <label class="form-label">Estudiantes *</label>
                      <select class="form-select" id="selectEstudiante">
                        <?php foreach ($estudiantes as $estudiante) : ?>
                          <option value="<?= $estudiante->id ?>" data-cedula="<?= $estudiante->cedula ?>" data-nombre="<?= $estudiante->nombre ?>" data-apellido="<?= $estudiante->apellido ?>"><?= "$estudiante->cedula - $estudiante->nombre $estudiante->apellido" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-lg-1 align-middle">
                      <button class="btn btn-primary" id="anadirEstudiante">Añadir</button>
                    </div>

                  </div>
                </div>
                <div class="col-12 mb-4">
                  <div class="row form-group justify-content-center">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">C.I.</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Apellido</th>
                          <th scope="col">Remover</th>
                        </tr>
                      </thead>
                      <tbody id="cuerpoTablaEstudiantes">

                      </tbody>
                    </table>
                  </div>
                </div>
                <hr class="border-light m-0">
                <div class="text-right mt-3">
                  <input type="submit" class="btn btn-primary" value='Guardar Registro' />&nbsp;
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <script>
    let fetchStudentsUrl = "<?= APP_URL . $this->Route('proyectos/pending-students') ?>";;
    $(document).ready(() => {

      toggleLoading(false)

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido




      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('proyectos/ssp') ?>',
        processing: true,
        serverSide: true,
        pageLength: 30,

        columnDefs: [{
          visible: false,
          targets: [0, 5]
        }, {
          data: null,
          render: function(data, type, row, meta) {
            return row[6] == 1 ? `<span class="badge rounded-pill bg-success">Evaluado</span>` : `<span class="badge rounded-pill bg-secondary">Pendiente a Evaluar</span>`
          },
          targets: 6
        }, {

          data: null,
          render: function(data, type, row, meta) {
            return `<div class="dropdown show">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                      ${ row[6] == 0 ? ` <a class="dropdown-item" href="<?= APP_URL ?>proyectos/assessment/${row[0]}">Evaluar</a>` : ``}
                        <a class="dropdown-item" onClick="edit('${row[0]}')" href="#">Editar</a>
                        <a class="dropdown-item text-danger" onClick="remove('${row[0]}') href="#">Eliminar</a>
                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 7 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
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

      $('#anadirEstudiante').click(function(e) {
        e.preventDefault();

        let studentsAlreadyAppened = document.getElementById("cuerpoTablaEstudiantes").children.length;



        if (studentsAlreadyAppened >= 5) {
          alert('limite de estudiantes alcanzado');
        } else {
          let selectedStudent = $('#selectEstudiante option:selected');

          let studentId = $(selectedStudent).val();

          if (studentId) {

            if ($("#cuerpoTablaEstudiantes").find(`#appenedStudent-${studentId}`).length > 0) {
              alert('Estudiante ya ha sido añadido')
              return false;
            }

            let fila = `<tr id="appenedStudent-${studentId}" class="studentRow">
                      <th scope="row">
                      <input type="text" name="integrantes[]" class="form-control-plaintext" value="${studentId}" hidden>
                      ${$(selectedStudent).data('cedula')}
                      </th>
                      <td>${$(selectedStudent).data('nombre')}</td>
                      <td>${$(selectedStudent).data('apellido')}</td>
                      <td><button type="button" class="btn btn-secondary" onClick="removeStudent('${studentId}')">Eliminar</button></td>
                    </tr>`;
            $('#cuerpoTablaEstudiantes').append(fila);
          }
        }
      })

      $('#proyectoGuardar').submit(function(e) {
        e.preventDefault()
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
            document.getElementById("proyectoGuardar").reset();
            // actualizar tabla
            toggleLoading(false)
          },
        });
      })

      $('#selectFaseId').change(function(e) {
        let selectedFase = $('#selectFaseId option:selected');

        let faseId = $(selectedFase).val();

        fetchEstudiantes(faseId);
      })

      function fetchEstudiantes(idFase) {
        $.ajax({
          type: "POST",
          url: fetchStudentsUrl,
          data: {
            'idFase': idFase
          },
          error: function(error, status) {
            toggleLoading(false)
            alert(error.responseText)
          },
          success: function(data, status) {
            estudiantes = JSON.parse(data)
            if (estudiantes) {
              renderSelectList(estudiantes)
            } else {
              $('#selectEstudiante').find('option').remove()
            }
          },
        });
      }

      function renderSelectList(data) {
        $('#selectEstudiante').find('option').remove()
        data.forEach(estudiante => {
          let row = `<option 
            value="${estudiante.id}" 
            data-cedula="${estudiante.cedula}" 
            data-nombre="${estudiante.nombre}" 
            data-apellido="${estudiante.apellido}">
            ${estudiante.cedula} - ${estudiante.nombre} ${estudiante.apellido}
          </option>`;

          $('#selectEstudiante').append(row);
        });
      }

    })

    function removeStudent(id) {
      $(`#appenedStudent-${id}`).remove()
    }
  </script>