<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light"> Consejo Comunal </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Registrar</a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Consejo Comunal</h6>
    <div class="card-body px-3 pt-3">
      <table id="tabla" class="table table-striped table-responsive" style="width:100%">
        <thead>
          <tr>
            <th>Código</th>
            <th>Consejo Comunal</th>
            <th>Vocero</th>
            <th>Sector</th>
            <th>Teléfono</th>
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
    let updateUrl = "<?= APP_URL . $this->Route('consejoComunal/edit') ?>";
    let deleteUrl = "<?= APP_URL . $this->Route('consejoComunal/delete') ?>";

    $(document).ready(() => {

      toggleLoading(false)

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido




      let table = new DataTable('#tabla', {
        ajax: '<?= $this->Route('consejoComunal/ssp') ?>',
        processing: true,
        serverSide: true,
        scrollX: true,
        scrollCollapse: true,
        responsive: true,
        pageLength: 30,

        columnDefs: [{
          data: null,
          render: function(data, type, row, meta) {
            return `<div class="dropdown show">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                        <a class="dropdown-item" onClick="editar('${row[0]}')" href="javascript:void(0)">Editar</a>
                        <a class="dropdown-item text-danger" onClick="remove('${row[0]}')" href="javascript:void(0)">Eliminar</a>
                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 5 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        }]

      });


      $('#actualizar #nombre').on('keyup', function() {
        let value = $(this).val();
        if (!letterAndFewSpecial(value)) {
          $(this).addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid");
        }
      })
      $('#actualizar #nombre_vocero').on('keyup', function() {
        let value = $(this).val();
        if (!onlyLetters(value)) {
          $(this).addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid");
        }
      })
      $('#actualizar #telefono').on('keyup', function() {
        let value = $(this).val();
        if (!phoneNumbers(value)) {
          $(this).addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid");
        }
      })


      $('#guardar').submit(function(e) {
        e.preventDefault()


        let nombre = $('#guardar #nombre').val()
        if (!letterAndFewSpecial(nombre)) {
          $('#guardar #nombre').addClass("is-invalid");
          return false;
        }

        let nombreVocero = $('#guardar #nombre_vocero').val()
        if (!onlyLetters(nombreVocero)) {
          $('#guardar #nombre_vocero').addClass("is-invalid");
          return false;
        }
        let telefono = $('#guardar #telefono').val()
        if (!phoneNumbers(telefono)) {
          $('#guardar #telefono').addClass("is-invalid");
          return false;
        }
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
            Swal.fire({
              position: 'bottom-end',
              icon: 'success',
              title: 'El Consejo Comunal fue creado con exito',
              showConfirmButton: false,
              toast: true,
              timer: 1500
            }).then(() => location.reload())
            $('#crear').modal('hide');
            $('#crear').modal('closed');
            document.getElementById("guardar").reset();
            // actualizar tabla
            toggleLoading(false, '#guardar')
          },
        });

      })

      $('#actualizar #nombre').on('keyup', function() {
        let value = $(this).val();
        if (!letterAndFewSpecial(value)) {
          $(this).addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid");
        }
      })
      $('#actualizar #nombre_vocero').on('keyup', function() {
        let nombre_vocero = $(this).val();
        if (!onlyLetters(nombre_vocero)) {
          $(this).addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid");
        }
      })
      $('#actualizar #telefono').on('keyup', function() {
        let telefono = $(this).val();
        if (!phoneNumbers(telefono)) {
          $(this).addClass("is-invalid");
        } else {
          $(this).removeClass("is-invalid");
        }
      })

      $('#actualizar').submit(function(e) {
        e.preventDefault()

        let nombre = $('#actualizar #nombre').val()
        if (!letterAndFewSpecial(nombre)) {
          $('#actualizar #nombre').addClass("is-invalid");
          return false;
        }

        let nombreVocero = $('#actualizar #nombre_vocero').val()
        if (!onlyLetters(nombreVocero)) {
          $('#actualizar #nombre_vocero').addClass("is-invalid");
          return false;
        }

        let telefono = $('#actualizar #telefono').val()
        console.log(telefono.length);
        if (!phoneNumbers(telefono))  {
          $('#actualizar #telefono').addClass("is-invalid");
          return false;
        }
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
            Swal.fire({
              position: 'bottom-end',
              icon: 'success',
              title: 'El Consejo Comunal fue editado con exito',
              showConfirmButton: false,
              toast: true,
              timer: 1500
            })
            // actualizar tabla
            toggleLoading(false, '#actualizar')

            $('#editar').modal('hide')
          },
        });

      })


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

    function renderUpdateForm(data) {

      // console.log(data)
      $('#editar').modal('show')

      $(`#actualizar #idconsejocomunal`).val(data.consejoComunal.consejo_comunal_id);
      $(`#actualizar #nombre`).val(data.consejoComunal.consejo_comunal_nombre);
      $(`#actualizar #nombre_vocero`).val(data.consejoComunal.nombre_vocero);
      $(`#actualizar #sector_id option[value='${data.consejoComunal.sector_id}']`).attr("selected", true);
      $(`#actualizar #telefono`).val(data.consejoComunal.consejo_comunal_telefono);

    }



    function editar(id) {
      $.ajax({
        type: "POST",
        url: updateUrl,
        data: {
          'id': id
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

    function remove(id) {
      $.ajax({
        type: "POST",
        url: deleteUrl,
        data: {
          'id': id
        },
        error: function(error, status) {
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: error.responseText,
            showConfirmButton: false,
            toast: true,
            timer: 3000
          })

        },
        success: function(data, status) {
          console.log(data);
          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: 'El Consejo Comunal fue borrado con exito',
            showConfirmButton: false,
            toast: true,
            timer: 1500
          })
          $('#tabla').DataTable().ajax.reload();
        },
      });
    }

    function onlyLetters(str) {
      return /^[A-Za-zñáéíóúüÁÉÍÓÚÑÜ ]*$/.test(str);
    }

    function letterAndFewSpecial(str) {
      return (
        /^[A-Za-zñáéíóúüÁÉÍÓÚÑÜ \- \– '"() , “” .]*$/.test(str) &&
        str.trim().length > 0
      );
    }

    function phoneNumbers(number) {
      return /^[04][0-9]{9}$/.test(number);
    }

    function capitalizeText(mySentence) {
      let words = mySentence.toLowerCase();
      words = words.replace(/(^|\s)\S/g, (l) => l.toUpperCase());
      return words;
    }

  </script>