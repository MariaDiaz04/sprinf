<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Clases </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>
  <div class="card">
    <h6 class="card-header bg-primary text-white">Clases</h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th>Código</th>
            <th>Materia</th>
            <th>Profesor</th>
            <th>Seccion</th>
            <th>Fase</th>
            <th>Trayecto</th>
            <th>Estudiantes</th>
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
          <h5 class="modal-title" id="crearLabel">Nueva Clase</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('clases/guardar') ?>" method="post" id="clasesGuardar">
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group mb-2">
                  <div class="col-lg-6">
                    <label class="form-label" for="profesor_id">Profesor *</label>
                    <select class="form-select" name="profesor_id">

                      <?php foreach ($profesores as $profesor) : ?>
                        <option value="<?= $profesor->codigo ?>"><?= "$profesor->nombre $profesor->apellido" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-lg-6">
                    <label class="form-label" for="seccion_id">Sección *</label>
                    <select class="form-select" name="seccion_id">
                      <?php foreach ($secciones as $seccion) : ?>
                        <option value="<?= $seccion->codigo ?>"><?= "$seccion->trayecto - $seccion->codigo" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row form-group mb-2">
                <div class="col-lg-12">
                  <label class="form-label" for="unidad_curricular_id">Unidad Curricular *</label>
                  <select class="form-select" name="unidad_curricular_id">

                    <?php foreach ($materias as $unidad) : ?>
                      <option value="<?= $unidad->codigo ?>"><?= "$unidad->nombre_trayecto - $unidad->nombre_fase - $unidad->nombre" ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>

              <hr class="border-light my-3">

              <div class="row form-group align-items-end">
                <div class="col-lg-10">
                  <label class="form-label" for="estudiantes">Estudiantes</label>
                  <select class="selectpicker" id="estudiantes" data-live-search="true">

                    <?php foreach ($estudiantes as $estudiante) : ?>
                      <option value="<?= $estudiante->id ?>" data-tokens="<?= $estudiante->cedula ?> <?= $estudiante->nombre ?> <?= $estudiante->apellido ?>" data-cedula="<?= $estudiante->cedula ?>" data-nombre="<?= $estudiante->nombre ?>" data-apellido="<?= $estudiante->apellido ?>"><?= "$estudiante->nombre $estudiante->apellido - C.I. $estudiante->cedula" ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-lg-2 align-middle">
                  <button class="btn btn-primary" id="anadirEstudiante">Añadir</button>
                </div>
              </div>

              <div class="row form-group justify-content-center">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">Cedula</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Apellido</th>
                      <th scope="col">Remover</th>
                    </tr>
                  </thead>
                  <tbody id="cuerpoTablaEstudiantes">

                  </tbody>
                </table>
              </div>
              <div class="text-right mt-3">
                <input type="submit" class="btn btn-primary" value='Abrir Clase' />&nbsp;
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
        ajax: '<?= $this->Route('clases/ssp') ?>',
        processing: true,
        serverSide: true,
        columnDefs: [{
          targets: 7, // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
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
          }
        }]
      });


      // table.on('click', 'tbody td', function() {
      //   editor.inline(this);
      // });

      table.on('click', 'button', function(e) {
        var action = this.className;
        let id = this.id
        var data = table.row($(this).parents('tr')).data();
        if (action.includes('dropdown-toggle')) {
          console.log('arbrir dropdown')
          console.log(id)
          $(`#${id}`).dropdown();
          console.log($(`#${id}`))
          console.log($(`#${id}`).dropdown())
        }
        if (action.includes('remove')) {
          // ejecutar función que se encarge de borrar el elemento
          remove(data[0])
        }

        if (action.includes('edit')) {
          // ejecutar función que se encarge de editar el elemento
          edit(data[0])
        }
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

      // logica para añadir estudiante a tabla de creación de clase

      $('#anadirEstudiante').click(function(e) {
        e.preventDefault();

        let studentsAlreadyAppened = document.getElementById("cuerpoTablaEstudiantes").children.length;




        let selectedStudent = $('#estudiantes option:selected');
        console.log(selectedStudent)

        let studentId = $(selectedStudent).val();

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

      })

      $('#clasesGuardar').submit(function(e) {
        e.preventDefault()
        url = $(this).attr('action');
        data = $(this).serializeArray();

        console.log(url)
        console.log(data)

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
            document.getElementById("clasesGuardar").reset();
            // actualizar tabla
            toggleLoading(false)
          },
        });
      })
    })

    function edit(id) {
      alert(`Editing ${id}`)
    }

    function remove(id) {
      alert(`Removing ${id}`)
    }
  </script>