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
      <table id="example" class="display" style="width:100%">
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
    var estudiantesSettings = {
      itemName: "nombre",
      valueName: "value",
      rightTabNameText: "Inscritos",
      tabNameText: "Estudiantes",
      dataArray: estudiantesPendientes,
    };

    var transfer2 = $(".transferEstudiantes").transfer(estudiantesSettings);

    let deleteUrl = "<?= APP_URL . $this->Route('inscripcion/delete') ?>";

    $(document).ready(() => {

      $('#crear').modal('show')

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
          }
        ]

        // columnDefs: [{
        //   data: null,
        //   render: function(data, type, row, meta) {
        //     return `<div class="dropdown show">
        //               <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        //               <i class="bx bx-dots-vertical-rounded"></i>
        //               </button>
        //               <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
        //                 ${(row[5] ? `<a class="dropdown-item" onClick="edit('${row[0]}')" href="#">Gestionar Inscripciones</a>`:'' )}
        //                 <a class="dropdown-item" onClick="edit('${row[0]}')" href="#">Editar</a>
        //                 <a class="dropdown-item text-danger" onClick="remove('${row[0]}')" href="#">Eliminar</a>
        //               </div>
        //             </div>`;
        //   }, // combino los botons de acción
        //   targets: 5 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        // }]
      });



      $('#guardar').submit(function(e) {
        e.preventDefault()

        toggleLoading(true, '#guardar');


        url = $(this).attr('action');
        data = $(this).serializeArray();

        $.ajax({
          type: "POST",
          url: url,
          data: data,
          error: function(error, status) {
            toggleLoading(false, '#guardar')
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
            toggleLoading(false, '#guardar')
          },
        });

      })

      $('#actualizar').submit(function(e) {
        e.preventDefault()

        toggleLoading(true, '#actualizar');


        url = $(this).attr('action');
        data = $(this).serializeArray();

        $.ajax({
          type: "POST",
          url: url,
          data: data,
          error: function(error, status) {
            toggleLoading(false, '#actualizar')
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
            toggleLoading(false, '#actualizar')

            $('#editar').modal('hide')
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
    })

    function edit(id) {
      $.ajax({
        type: "POST",
        url: updateUrl,
        data: {
          'codigo': id
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

          renderUpdateForm(JSON.parse(data))
        },
      });
    }

    function renderUpdateForm(data) {

      $('#editar').modal('show')

      // seleccionar trayecto
      $(`#actualizar #trayecto_id option[value='${data.materia.trayecto_id}']`).attr("selected", true);
      // seleccionar periodo
      $(`#actualizar #periodo option[value='${data.materia.periodo}']`).attr("selected", true);

      $(`#actualizar #codigo`).val(data.materia.materia_id);
      $(`#actualizar #nombre`).val(data.materia.nombre);
      $(`#actualizar #eje`).val(data.materia.eje);

      $(`#actualizar #htasist`).val(data.materia.htasist);
      $(`#actualizar #htind`).val(data.materia.htind);
      $(`#actualizar #ucredito`).val(data.materia.ucredito);
      $(`#actualizar #hrs_acad`).val(data.materia.hrs_acad);

    }

    function remove(id) {
      $.ajax({
        type: "POST",
        url: deleteUrl,
        data: {
          'codigo': id
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
          alert('Materia borrada exitosamente')
          $('#example').DataTable().ajax.reload();
        },
      });
    }
  </script>