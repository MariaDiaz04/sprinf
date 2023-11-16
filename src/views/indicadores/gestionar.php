<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Baremos / <?= $dimension->nombre_trayecto ?> / <?= $dimension->nombre_materia ?> </span>/ <?= $dimension->nombre ?> - <b><?= $dimension->ponderacion_items ?>%</b></div>
        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white"><b>Indicadores</b> </h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="table" style="width:100%">
        <thead>
          <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Ponderación %</th>
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
  <script>
    let deleteUrl = "<?= APP_URL . $this->Route('indicador/borrar') ?>";
    let obtenerUrl = "<?= APP_URL . $this->Route('indicador/obtener/') ?>";


    $(document).ready(() => {

      toggleLoading(false);


      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('ssp/' . $idDimension) ?>',
        processing: true,
        serverSide: true,
        pageLength: 30,

        // columnDefs: [{
        //     visible: false,
        //     targets: [0, 2, 5, 6]
        //   },
        //   {
        //     data: null,
        //     render: function(data, type, row, meta) {
        //       return (row[7]) ? row[7] : 'No evaluado';
        //     }, // combino los botons de acción
        //     targets: 7 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        //   }
        // ]

        columnDefs: [{
          data: null,
          render: function(data, type, row, meta) {
            return `<div class="dropdown show">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                        <a class="dropdown-item" onClick="actualizar('${row[0]}')" href="#">Editar</a>
                        <a class="dropdown-item text-danger" onClick="remove('${row[0]}')" href="#">Eliminar</a>
                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 3 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
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
            // document.getElementById("guardar").reset();
            // actualizar tabla
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: "Creación Exitosa",
              showConfirmButton: false,
              toast: true,
              timer: 1000,
            })
            // .then(() => location.reload());
            document.getElementById("guardar").reset()
            $('#crear').modal('hide')
            toggleLoading(false)
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
            // document.getElementById("guardar").reset();
            // actualizar tabla
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: "Creación Exitosa",
              showConfirmButton: false,
              toast: true,
              timer: 1000,
            })
            // .then(() => location.reload());
            document.getElementById("guardar").reset()
            $('#crear').modal('hide')
            toggleLoading(false)
          },
        });
      })

      $('#actualizarIndicador').submit(function(e) {
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
            // document.getElementById("guardar").reset();
            // actualizar tabla
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: "Actualización Exitosa",
              showConfirmButton: false,
              toast: true,
              timer: 1000,
            })
            // .then(() => location.reload());
            document.getElementById("guardar").reset()
            $('#actualizar').modal('hide')
            toggleLoading(false)
          },
        });
      })

    })

    async function actualizar(id) {
      let indicador = await obtenerIndicador(id)
      console.log(indicador)
      renderEvaluarForm(indicador.indicador)
      return false;
    }

    function renderEvaluarForm(data) {

      $('#actualizar #idIndicador').val(data.id)
      $('#actualizar #dimension_id').val(data.dimension_id)
      $('#actualizar #nombre').val(data.nombre)
      $('#actualizar #ponderacion').val(data.ponderacion)
      $('#actualizar').modal('show')


    }

    async function obtenerIndicador(id) {
      let result;
      try {
        result = await $.ajax({
          url: obtenerUrl + id,
          type: "GET",
        });
        return JSON.parse(result);
      } catch (error) {
        console.error(error);
        return false;
      }
    }

    function remove(id) {
      Swal.fire({
        title: "Se eliminará el indicador, ¿está seguro de realizar la acción?",
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
                title: "Indicador Eliminado Exitosamente",
                showConfirmButton: false,
                toast: true,
                timer: 1000,
              }).then(() => location.reload());
            },
          });
        }
      });
    }

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
  </script>