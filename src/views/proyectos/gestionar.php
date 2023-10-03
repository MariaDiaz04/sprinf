<style>
  .transfer-double {
    background-color: none !important;
    border: none !important;
    box-shadow: none !important;
    width: 100%;
  }

  .transfer-double-content {
    display: flex;
  }

  .transfer-double-content-right {
    flex-grow: 1;
  }

  .transfer-double-content-left {
    flex-grow: 1;
  }
</style>
<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Proyectos </span>/ Gestión</div>

        <div class="d-flex">
          <a class="btn btn-primary btn-round d-block d-inline-block " style="margin-right: 10px;" href="#" data-bs-toggle="modal" data-bs-target="#historico"><span class="ion ion-md-add" id="cargarHistoricoBtn"></span>&nbsp; Registrar Histórico </a>
          <a class="btn btn-primary btn-round d-block d-inline-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>
        </div>

      </h4>

    </div>
  </div>

  <?php

  use PHPUnit\Util\Json;

  if ($cerrarFase) : ?>
    <div class="alert alert-primary" role="alert">
      <p>Todos los proyectos han sido evaluados! 🥳</p>
      <p><a href="<?= APP_URL . $this->Route('configuracion/aperturar-periodo') ?>" class="btn btn-primary">aperturar un nuevo periodo</a></p>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-header bg-primary  d-flex justify-content-between  align-items-center">

      <h6 class="text-white pt-3 "><b>Proyectos</b> - <?= $periodo->fecha_inicio ?> / <?= $periodo->fecha_cierre ?> </h6>
      <form method="POST" action="<?= APP_URL . $this->Route('configuracion/excel')  ?>">
        <div>
          <select class="form-select" name="trayecto_id">
            <?php foreach ($trayectos as $trayecto) : ?>
              <option value="<?= $trayecto->codigo ?>"><?= $trayecto->nombre ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button class="btn btn-primary btn-round d-block ">
          <span class="ion ion-md-add"></span>&nbsp; Matriz de proyecto </button>
      </form>
    </div>

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
                      <label class="form-label" for="fase_id">Fase *</label>
                      <select class="form-select" name="fase_id" id="selectFaseId">

                        <?php foreach ($fases as $fase) : ?>
                          <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="nombre">
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row form-group">

                    <div class="col-lg-6">
                      <label class="form-label" for="resumen">Dirección</label>
                      <textarea class="form-control" placeholder="..." id="resumen" name="resumen" style="height: 50px"></textarea>
                    </div>

                    <div class="col-lg-3">
                      <label class="form-label" for="municipio">Municipio</label>
                      <select class="form-select" name="municipio" id="selectmunicipio">

                      </select>
                    </div>

                    <div class="col-lg-3">
                      <label class="form-label" for="parroquia">Parroquia</label>
                      <select class="form-select" name="parroquia" id="selectparroquia">

                      </select>
                    </div>

                    <div class="col-lg-3">
                      <label class="form-label" for="tutor_in">Tutor Interno</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="tutor_in">
                    </div>

                    <div class="col-lg-3">
                      <label class="form-label" for="tutor_ex">Tutor Externo</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="tutor_ex">
                    </div>

                    <div class="col-lg-6">
                      <label class="form-label" for="comunidad">Comunidad</label>
                      <textarea class="form-control" placeholder="..." id="comunidad" name="comunidad" style="height: 50px "></textarea>
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

  <div class="modal fade" id="historico" role="dialog" aria-labelledby="historicoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="historicoLabel">Nuevo Proyecto Histórico - <?= $periodo->fecha_inicio ?> / <?= $periodo->fecha_cierre ?></h5>
        </div>
        <div class="modal-body">
          <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardarHistorico">
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group mb-3">
                    <div class="col-lg-12">
                      <label class="form-label" for="nombre">Proyecto </label>
                      <select class="form-select" name="id" id="selectProyecto">
                        <?php foreach ($historicoProyectos as $idProyecto => $proyecto) : ?>
                          <option value="<?= $idProyecto ?>" data-nombre="<?= $proyecto->nombre ?>" data-comunidad="<?= $proyecto->comunidad ?>" data-motor_productivo="<?= $proyecto->motor_productivo ?>" data-resumen="<?= $proyecto->resumen ?>" data-direccion="<?= $proyecto->direccion ?>" data-municipio="<?= $proyecto->municipio ?>" data-parroquia="<?= $proyecto->parroquia ?>" data-tutor_in="<?= $proyecto->tutor_in ?>" data-tutor_ex="<?= $proyecto->tutor_ex ?>"><?= "$proyecto->display" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-4">
                      <label class="form-label" for="fase_id">Trayecto</label>
                      <select class="form-select" name="fase_id" id="selectTrayecto">

                        <?php foreach ($fases as $fase) : ?>
                          <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-4 d-flex align-items-end" style="margin-left: auto;">

                      <button class="btn btn-primary" id="cargarInformacion">Cargar Informacion</button>

                    </div>
                  </div>
                  <hr>
                  <div class="row form-group">
                    <div class="col-lg-12">
                      <label class="form-label" for="nombre">Nombre</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre" readonly>
                    </div>
                  </div>
                  <div class="row form-group mb-2">
                    <div class="col-lg-3">
                      <label class="form-label" for="motor_productivo">Motor Productivo</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="motor_productivo" id="motor_productivo" readonly>
                    </div>
                    <div class="col-lg-9">
                      <label class="form-label" for="direccion">Resumen</label>
                      <textarea class="form-control" placeholder="..." id="resumen" name="resumen" style="height: 50px" readonly></textarea>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-3">
                      <label class="form-label" for="parroquia">Municipio</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="municipio" id="municipio" readonly>
                    </div>
                    <div class="col-lg-3">
                      <label class="form-label" for="parroquia">Parroquia</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="parroquia" id="parroquia" readonly>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="comunidad">Comunidad</label>
                      <textarea class="form-control" placeholder="..." id="comunidad" name="comunidad" style="height: 50px " readonly></textarea>
                    </div>
                  </div>

                  <div class="row form-group mb-2">
                    <div class="col-lg-12">
                      <label class="form-label" for="direccion">Dirección</label>
                      <textarea class="form-control" placeholder="..." id="direccion" name="direccion" style="height: 50px" readonly></textarea>
                    </div>
                  </div>
                  <div class="row form-group mb-2">
                    <div class="col-lg-6">
                      <label class="form-label" for="tutor_in">Tutor Interno</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="tutor_in" id="tutor_in">
                    </div>

                    <div class="col-lg-6">
                      <label class="form-label" for="tutor_ex">Tutor Externo</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="tutor_ex" id="tutor_ex">
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="transfer">

            </div>
            <hr class="border-light m-0">
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
  </div>

  <script src="<?= APP_URL ?>assets/js/jquery.transfer.js"></script>
  <script>

  </script>
  <script>
    $(document).ready(function(e) {
      $('#cargarInformacion').click(function(e) {
        e.preventDefault()

        let proyectoSeleccionado = $('#selectProyecto option:selected').data()

        $('#historico #nombre').val(proyectoSeleccionado.nombre)
        $('#historico #motor_productivo').val(proyectoSeleccionado.motor_productivo)
        $('#historico #parroquia').val(proyectoSeleccionado.parroquia)
        $('#historico #municipio').val(proyectoSeleccionado.municipio)
        $('#historico #direccion').val(proyectoSeleccionado.direccion)
        $('#historico #resumen').val(proyectoSeleccionado.resumen)
        $('#historico #comunidad').val(proyectoSeleccionado.comunidad)
        $('#historico #tutor_in').val(proyectoSeleccionado.tutor_in)
        $('#historico #tutor_ex').val(proyectoSeleccionado.tutor_ex)
      })
    })
  </script>
  <script>
    let fetchStudentsUrl = "<?= APP_URL . $this->Route('proyectos/pending-students') ?>";

    var groupDataArray1 = <?= json_encode($historicoEstudiantes); ?>;
    var settings3 = {
      groupDataArray: groupDataArray1,
      groupItemName: "nombre",
      groupArrayName: "integrantes",
      itemName: "nombre",
      valueName: "value",
      rightTabNameText: 'Estudiantes Seleccionados',
      tabNameText: 'Estudiantes del Historico',
      searchPlaceholderText: 'Buscar Estudiantes',
      callable: function(items) {
        console.dir(items);
      },
    };

    var transfer = $(".transfer").transfer(settings3);




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



      $('#proyectoGuardarHistorico').submit(function(e) {
        e.preventDefault()
        toggleLoading(true, '#proyectoGuardarHistorico');
        formData = $(this).serializeArray();
        items = transfer.getSelectedItems();
        data = [...formData];
        counter = 0
        for (const idIntegrante in items) {
          integrante = {}
          if (Object.hasOwnProperty.call(items, idIntegrante)) {
            const element = items[idIntegrante];
            integrante.name = `integrantes[${counter}]`
            integrante.value = element.value
            counter++
            data.push(integrante)
          }
        }

        url = $(this).attr('action');

        $.ajax({
          type: "POST",
          url: url,
          data: data,
          error: function(error, status) {
            toggleLoading(false, '#proyectoGuardarHistorico')
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
            Swal.fire({
              position: 'bottom-end',
              icon: 'success',
              title: 'Creación Exitosa',
              showConfirmButton: false,
              toast: true,
              timer: 2000
            })

            $('#historico').modal('hide')
            table.ajax.reload();
            // usar sweetalerts
            document.getElementById("guardar").reset();
            // actualizar tabla
            toggleLoading(false, '#proyectoGuardarHistorico')
          },
        });
      })

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
      function toggleLoading(show, form = '') {
        if (show) {
          $(`${form} #loading`).show();
          $(`${form} #submit`).hide();
        } else {
          $(`${form} #loading`).hide();
          $(`${form} #submit`).show();
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