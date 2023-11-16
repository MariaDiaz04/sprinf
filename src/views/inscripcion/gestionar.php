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
        <div><span class="text-muted font-weight-light">Inscripción / <?= $materia->nombre_trayecto ?> </span>/ <?= $materia->nombre_materia ?></div>
        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white"><b>Inscripciones</b> - <?= $periodo->fecha_inicio ?> / <?= $periodo->fecha_cierre ?></h6>

    <div class="card-body px-3 pt-3">
      <table id="example" class="table" style="width:100%">
        <thead>
          <tr>
            <th>id</th>
            <th>Sección</th>
            <th>estudiante_id</th>
            <th>cedula</th>
            <th>Nombre</th>
            <th>Código de Materia</th>
            <th>Nombre de Materia</th>
            <th>calificacion</th>
            <th>Acción</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <?php
  include 'modules/crear.php';
  include 'modules/actualizar.php';
  ?>
  <script src="<?= APP_URL ?>assets/js/jquery.transfer.js"></script>
  <script>
    var estudiantesPendientes = <?= json_encode($pendientes); ?>;
    var idMateria = "<?= $idMateria ?>";
    var estudiantesSettings = {
      itemName: "nombre",
      valueName: "value",
      rightTabNameText: "Inscritos",
      tabNameText: "Estudiantes",
      dataArray: estudiantesPendientes,
    };

    var transfer = $(".transferEstudiantes").transfer(estudiantesSettings);

    let deleteUrl = "<?= APP_URL . $this->Route('inscripcion/borrar') ?>";
    let obtenerUrl = "<?= APP_URL . $this->Route('inscripcion/obtener') ?>";

    $(document).ready(() => {



      toggleLoading(false)
      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let table = new DataTable('#example', {
        ajax: '<?= APP_URL . $this->Route('inscripcion/ssp/' . $idMateria) ?>',
        processing: true,
        serverSide: true,
        pageLength: 30,

        columnDefs: [{
            visible: false,
            targets: [0, 2, 5, 6]
          },
          {
            data: null,
            render: function(data, type, row, meta) {
              return (row[7]) ? row[7] : 'No evaluado';
            }, // combino los botons de acción
            targets: 7 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
          },
          {
            data: null,
            render: function(data, type, row, meta) {
              return `<div class="dropdown show">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                        <a class="dropdown-item" onClick="evaluar('${row[2]}')" href="#">Evaluar</a>
                        <a class="dropdown-item text-danger" onClick="remove('${row[2]}')" href="#">Eliminar</a>
                      </div>
                    </div>`;
            }, // combino los botons de acción
            targets: 8
          }
        ]



        // columnDefs: [{
        //   data: null,

        //   targets: 5 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        // }]
      });


      $('#guardar').submit(function(e) {
        e.preventDefault()
        formData = $(this).serializeArray();
        data = [...formData];
        items = transfer.getSelectedItems();
        counter = 0;
        if (items.length <= 0) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "Debe añadir Estudiantes",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        } else {
          for (const idIntegrante in items) {
            integrante = {};
            if (Object.hasOwnProperty.call(items, idIntegrante)) {
              const element = items[idIntegrante];
              integrante.name = `estudiante_id[${counter}]`;
              integrante.value = element.value;
              counter++;
              data.push(integrante);
            }
          }
        }


        toggleLoading(true, '#guardar');


        url = $(this).attr('action');

        $.ajax({
          type: "POST",
          url: url,
          data: data,
          error: function(error, status) {
            toggleLoading(false);
            error = JSON.parse(error.responseText);
            Swal.fire({
              position: "bottom-end",
              icon: "error",
              title: status + ": " + error.error.message,
              showConfirmButton: false,
              toast: true,
              timer: 2000,
            });

          },
          success: function(data, status) {
            table.ajax.reload();
            // usar sweetalerts
            document.getElementById("guardar").reset();
            // actualizar tabla
            toggleLoading(false, '#guardar')
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: "Creación Exitosa",
              showConfirmButton: false,
              toast: true,
              timer: 1000,
            })
          },
        });

      })

      $('#evaluarInscripcion').submit(function(e) {
        e.preventDefault()

        toggleLoading(true, '#evaluarInscripcion');


        url = $(this).attr('action');
        data = $(this).serializeArray();

        $.ajax({
          type: "POST",
          url: url,
          data: data,
          error: function(error, status) {
            toggleLoading(false, '#evaluarInscripcion')
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
            // actualizar tabla
            toggleLoading(false, '#evaluarInscripcion')

            $('#evaluar').modal('hide')
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: "Evaluación Exitosa",
              showConfirmButton: false,
              toast: true,
              timer: 1000,
            });
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

      $(function() {
        $('#input-estudiante').on('change', function() {
          let val = $(this).val();
          console.log(val);
          //$('#buscarCarreras').attr('href','/inscribir_nuevo/'+val);
          //$('#buscarCarreras').attr('href','/inscribir_nuevo/'+val);
        });
      });

    })

    async function evaluar(id) {
      let inscripcion = await obtenerInscripcion(id)
      console.log(inscripcion)
      renderEvaluarForm(inscripcion)
      return false;
    }

    async function obtenerInscripcion(id) {
      let result;
      try {
        result = await $.ajax({
          url: obtenerUrl,
          type: "POST",
          data: {
            estudiante_id: id,
            unidad_id: idMateria
          },
        });
        return JSON.parse(result);
      } catch (error) {
        console.error(error);
        return false;
      }
    }

    function renderEvaluarForm(data) {

      $('#evaluar').modal('show')
      $('#actualizarEvaluacion').empty()
      counter = 0;
      data.inscripciones.forEach(inscripcion => {
        console.log(inscripcion)
        let evaluacion =
          `<div class="form-group row mb-2">
          <input type="hidden" name="inscripcion[${counter}][id]" value="${inscripcion.id}">
            <label for="calificacion" class="col-sm-2 col-form-label">${inscripcion.unidad_curricular_id}</label>
            <div class="col-sm-10">
              <input type="number" name="inscripcion[${counter}][calificacion]" class="form-control" id="calificacion" placeholder="0" ${(inscripcion.calificacion != null ? 'value="'+ inscripcion.calificacion + '"' : '')}>
            </div>
          </div>`;

        $('#actualizarEvaluacion').append(evaluacion)
        counter++
      });

      $('#evaluar').modal('show')

      // seleccionar trayecto
      // $(`#evaluarInscripcion #profesor_id option[value='${data.materia.trayecto_id}']`).attr("selected", true);
      // // seleccionar periodo
      // $(`#evaluarInscripcion #seccion_id option[value='${data.materia.periodo}']`).attr("selected", true);


    }


    $('#anadirItem').click(function(e) {
      e.preventDefault();

      let length = document.getElementById("cuerpoTablaItems").children.length;


      let nombreItem = $('#nombreItem').val();
      let ponderacionItem = $('#ponderacionItem').val()
      console.log(nombreItem)
      console.log(ponderacionItem)
      let fila = `<tr id="appenedItem-${length}">
                    <th scope="row">
                    <input type="text" name="indicadores[${length}][nombre]" class="form-control-plaintext" value="${nombreItem}" hidden>     
                    ${nombreItem}
                    </th>
                    
                    <td><a href="#" class="btn btn-secondary" onClick="removeItem(${length})">Eliminar</a href="javascript:void(0)"></td>
                  </tr>`;
      $('#cuerpoTablaItems').append(fila);

    })

    function remove(id) {
      $.ajax({
        type: "POST",
        url: deleteUrl,
        data: {
          estudiante_id: id,
          unidad_id: idMateria
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

          $('#example').DataTable().ajax.reload();
          Swal.fire({
            position: "bottom-end",
            icon: "success",
            title: "Borrado Exitoso",
            showConfirmButton: false,
            toast: true,
            timer: 1000,
          })
        },
      });

      /*input_estudiante.on('input', function() {
      
        let filtro = input_estudiante.val();
        console.log(filtro)
        $.each(resultados, function(index, resultado) {
                selectResultados.append($('<option>', {
                    value: resultado.id,
                    text: resultado.nombre
                }));
            });
      }*/
    }
  </script>