<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Baremos / <?= $unidadCurricular->nombre_trayecto ?> </span>/ <?= $unidadCurricular->nombre ?></div>

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
            <th>Tipo</th>
            <th>Ponderado <b>(%)</b></th>
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
            return `<div class="dropdown show">
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
        }]
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

      $('#dimensionActualizar').submit(function(e) {
        e.preventDefault()

        toggleLoading(true, '#actualizar');


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
            $('#actualizar').modal('hide')
            // .then(() => location.reload());
            toggleLoading(false)
          },
        });
      });


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

      $('#anadirItem').click(function(e) {
        e.preventDefault();

        let length = document.getElementById("cuerpoTablaItems").children.length;

        let nombreItem = $('#nombreItem').val();
        let ponderacionItem = parseFloat($('#ponderacionItem').val())
        if (nombreItem.length == 0) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: 'Ingrese un nombre de indicador',
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          return false;
        }
        if (typeof ponderacionItem === 'number' && ponderacionItem < 100) {

          let fila = `<tr id="appenedItem-${length}" class="nuevoIndicador">
                      <th scope="row">
                      <input type="text" name="indicadores[${length}][nombre]" class="form-control-plaintext" value="${nombreItem}" hidden>
                      <input type="text" name="indicadores[${length}][ponderacion]" class="form-control-plaintext" value="${ponderacionItem}" hidden>
                      ${nombreItem}
                      </th>
                      <td>${ponderacionItem}</td>
                      <td><a href="#" class="btn btn-secondary" onClick="removeItem(${length})">Eliminar</a href="javascript:void(0)"></td>
                    </tr>`;
          $('#cuerpoTablaItems').append(fila);
        } else {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: 'Ponderación no valida',
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
        }

      })

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
      $("#actualizar #nombre").val(nombre);

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