<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Baremos / <a href="<?= APP_URL . $this->route('baremos/' . $unidadCurricular->codigo_trayecto) ?>"><?= $unidadCurricular->nombre_trayecto ?></a> </span>/ <?= $unidadCurricular->nombre ?> - <b><?= $unidadCurricular->ponderado_baremos ?>%</b></div>

        <?php if ((int)$trayecto->ponderado_baremos >= 100) : ?>
          <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Ya ha sido evaluado 100% para el baremos de <?= $unidadCurricular->nombre_trayecto ?>.">
            <button class="btn btn-primary" style="pointer-events: none;" type="button" disabled>Registrar</button>
          </span>
        <?php else : ?>
          <a class="btn btn-primary btn-round d-block flex-shrink-0" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Registrar</a>
        <?php endif; ?>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Dimensiones</h6>
    <div class="card-body px-3 pt-3">
      <p class="d-flex justify-content-end">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#verResumenBaremos" aria-expanded="false" aria-controls="notas-<?= $idMateria ?>">
          <i class='bx bx-search-alt'></i> Ver Resumen de Baremos
        </button>
      </p>
      <div class="collapse" id="verResumenBaremos">
        <h4 class="mb-4">Información Baremos</h4>
        <table class="table table-striped mb-4" id="resumenBaremos">
          <thead>
            <tr>
              <th>Fase</th>
              <th>Ponderado (%)</th>
            </tr>
          </thead>

          <tbody>

            <?php foreach ($fases as $fase) : ?>
              <tr>
                <td> <?= $fase->nombre_fase ?></td>
                <td><?= $fase->ponderado_baremos ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="1" style="text-align:right">Total:</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="my-3"></div>
      <hr>
      <div class="my-3"></div>

      <table id="example" class="table table-striped table-responsive" style="width:100%">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Materia</th>
            <th>Fase</th>
            <th>Trayecto</th>
            <th>Tipo</th>
            <th>Ponderado <b>(%)</b></th>
            <th>Acción</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th colspan="6" style="text-align:right">Total:</th>
            <th></th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>

  <?php
  include 'modules/crear.php';
  include 'modules/actualizar.php';
  ?>

  <script>
    $(document).ready(() => {
      let tableResumen = new DataTable('#resumenBaremos', {
        footerCallback: function(row, data, start, end, display) {
          let api = this.api();

          // Remove the formatting to get integer data for summation
          let intVal = function(i) {
            return typeof i === 'string' ?
              i.replace(/[\$,]/g, '') * 1 :
              typeof i === 'number' ?
              i :
              0;
          };

          // Total over all pages
          total = api
            .column(1)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

          // Total over this page
          pageTotal = api
            .column(1, {
              page: 'current'
            })
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

          // Update footer
          api.column(1).footer().innerHTML =
            total + '%';
        }
      })
    })
  </script>

  <script>
    let UrlGestionarIndicadores = "<?= APP_URL . $this->Route('indicadores/'); ?>";
    let obtenerDimensionUrl = "<?= APP_URL . $this->Route('dimensiones/obtener/'); ?>";
    let deleteUrl = "<?= APP_URL . $this->Route('dimensiones/borrar') ?>";
    $(document).ready(() => {

      toggleLoading(false)

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let editBtn = "<button class=\"btn btn-outline-secondary btn-color btn-bg-color col-xs-6 mx-2 edit\">Editar</button>";
      let deleteBtn = "<button class=\"btn btn-outline-danger btn-color btn-bg-color col-xs-6 mx-2 remove\">Eliminar</button>";



      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('ssp/' . $codigoMateria) ?>',
        processing: true,
        serverSide: true,
        scrollX: true,
        scrollCollapse: true,
        responsive: true,
        pageLength: 30,

        columnDefs: [{
          visible: false,
          targets: [0, 2, 4]
        }, {
          data: null,
          render: function(data, type, row, meta) {
            return (row[5] == 1) ? '<span class="badge rounded-pill bg-secondary">Grupal</span>' : '<span class="badge rounded-pill bg-secondary">Individual</span>'
          },
          targets: 5,
        }, {
          data: null,
          render: function(data, type, row, meta) {
            return `<div class="dropleft show">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                        <a class="dropdown-item" href="${UrlGestionarIndicadores + row[0]}">Gestionar Indicadores</a>
                        <a class="dropdown-item" onClick="edit('${row[0]}')" href="#">Editar</a>
                        <a class="dropdown-item text-danger" onClick="removeDimension('${row[0]}')" href="#">Eliminar</a>
                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 7 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        }],
        footerCallback: function(row, data, start, end, display) {
          let api = this.api();

          // Remove the formatting to get integer data for summation
          let intVal = function(i) {
            return typeof i === 'string' ?
              i.replace(/[\$,]/g, '') * 1 :
              typeof i === 'number' ?
              i :
              0;
          };

          // Total over all pages
          total = api
            .column(6)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

          // Total over this page
          pageTotal = api
            .column(6, {
              page: 'current'
            })
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

          // Update footer
          api.column(6).footer().innerHTML =
            total + '%';
        }
      });



      $('#guardar').submit(function(e) {
        e.preventDefault()

        toggleLoading(true);


        url = $(this).attr('action');
        data = $(this).serializeArray();

        let indicadores = $('.nuevoIndicador');


        if (indicadores.length == 0) {
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: 'Debe asignar indicadores al crear la dimensión',
            showConfirmButton: false,
            toast: true,
            timer: 2000
          })
          toggleLoading(false)
          return false;
        }

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
            // document.getElementById("guardar").reset();
            // actualizar tabla
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: "Creación Exitosa",
              showConfirmButton: false,
              toast: true,
              timer: 1000,
            }).then(() => location.reload());
            $('#crear').modal('hide')
            toggleLoading(false)
          },
        });
      })




      // TOGGLE BUTTON AND SPINNER
      function toggleLoading(show, form = "") {
        if (show) {
          $(`${form} #loading`).show();
          $(`${form} #submit`).hide();
        } else {
          $(`${form} #loading`).hide();
          $(`${form} #submit`).show();
        }
      }



    })

    async function obtenerDimension(id) {
      let result;
      try {
        result = await $.ajax({
          url: obtenerDimensionUrl + id,
          type: "POST",
          data: {
            id: id
          },
        });
        return JSON.parse(result);
      } catch (error) {
        console.error(error);
        return false;
      }
    }

    async function edit(id) {
      let dimension = await obtenerDimension(id);

      const {
        nombre,
        grupal
      } = dimension.dimension;

      $("#actualizar").modal("show");

      $("#actualizar #id").val(id);
      $("#actualizar #nombreDimension").val(nombre);

      if (grupal == 1) {
        $('#actualizar #grupal').prop('checked', true);
      } else {
        $('#actualizar #grupal').prop('checked', false);
      }

      $("#actualizar").modal("show");
    }

    function removeItem(id) {
      $(`#appenedItem-${id}`).remove()
    }

    function removeDimension(id) {
      Swal.fire({
        title: "Se eliminará la dimensión indicada junto con sus indicadores, ¿está seguro de realizar la acción?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Continuar",
      }).then((result) => {
        if (result.value) {
          $.ajax({
            type: "POST",
            url: deleteUrl,
            data: {
              id: id,
            },
            error: function(error, status) {
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
              // actualizar tabla
              Swal.fire({
                position: "bottom-end",
                icon: "success",
                title: "Proyecto Eliminado Exitosamente",
                showConfirmButton: false,
                toast: true,
                timer: 2000,
              }).then(() => location.reload());
            },
          });
        }
      });
    }
  </script>