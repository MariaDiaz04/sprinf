<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Control academico </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block flex-shrink-0" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Registrar</a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Control academico</h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="table table-striped table-responsive" style="width:100%">
        <thead class="thead-dark">
          <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>email</th>
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

  <!-- MODAL DATOS CONTACTO -->
  <div class="modal fade" id="datos" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Datos de Contacto</h5>
        </div>
        <div class="modal-body">
          <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
          <div class="container-fluid" id="datosContacto">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row">
                  <div class="col-lg-6">
                    <label class="form-label" for="direccion">Dirección *</label>
                    <input type="text" class="form-control mb-1" placeholder="..." name="direccion" id="direccion" readonly>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label" for="apellido">Teléfono *</label>
                    <input type="text" class="form-control mb-1" placeholder="..." name="telefono" id="telefono" readonly>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- footer de acciones -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cerrar</button>
        </div>
      </div>
    </div>
  </div>


  <script>
    let showDetailsUrl = "<?= APP_URL . $this->Route('control_academico/showDetails') ?>";
    let editUrl = "<?= APP_URL . $this->Route('control_academico/edit') ?>";
    let deleteUrl = "<?= APP_URL . $this->Route('control_academico/delete') ?>";

    $(document).ready(() => {

      toggleLoading(false)


      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('control_academico/ssp') ?>',
        processing: true,
        serverSide: true,
        scrollX: true,
        scrollY: false,
        scrollCollapse: true,
        responsive: true,
        pageLength: 30,

        columnDefs: [{
          data: null,
          render: function(data, type, row, meta) {
            return `<div class="btn-group dropstart">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" id="dropdown-${row[0]}" >
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                        <a class="dropdown-item" onClick="showDetails('${row[0]}')" href="javascript:void(0)">Mostrar Datos de Contacto</a>
                        <a class="dropdown-item" onClick="edit('${row[0]}')" href="javascript:void(0)">Editar</a>
                        <a class="dropdown-item text-danger" onClick="remove('${row[0]}')" href="javascript:void(0)">Eliminar</a>
                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 4 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        }]
      });



      $('#guardar').submit(function(e) {
        e.preventDefault()
        toggleLoading(true);
        url = $(this).attr('action');
        data = $(this).serializeArray();

        nombre = $("#guardar #nombre").val();
        if (!onlyLetters(nombre)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "Nombre de estudiante no valido",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }

        apellido = $("#guardar #apellido").val();
        if (!onlyLetters(apellido)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "Apellido no valido",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }

        telefono = $("#guardar #telefono").val();
        if (!phoneNumbers(telefono)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "Numero de telefono no valido",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }
        cedula = $("#guardar #cedula").val();
        if (!onlyNumbers(cedula)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "Cedula no valida",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }
        email = $("#guardar #email").val();
        if (!onlyEmail(email)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "email no valido",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }
        contrasena = $("#guardar #contrasena").val();
        if (contrasena.length < 8 || contrasena.length > 25) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "La contrasena debe tener entre 8 y 20 caracteres",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
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
              timer: 6000
            })

          },
          success: function(data, status) {
            table.ajax.reload();
            // usar sweetalerts
            Swal.fire({
              position: 'bottom-end',
              icon: 'success',
              title: 'Profesor guardado con exito',
              showConfirmButton: false,
              toast: true,
              timer: 2000
            })
            document.getElementById("guardar").reset();
            // actualizar tabla
            toggleLoading(false, '#guardar')
            $('#crear').modal('hide');
          },
        });

      })

      $('#actualizar').submit(function(e) {
        e.preventDefault()
        toggleLoading(true, '#actualizar');
        url = $(this).attr('action');
        data = $(this).serializeArray();

        nombre = $("#actualizar #nombre").val();
        if (!onlyLetters(nombre)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "Nombre de estudiante no valido",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }

        apellido = $("#actualizar #apellido").val();
        if (!onlyLetters(apellido)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "Apellido no valido",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }

        telefono = $("#actualizar #telefono").val();
        if (!phoneNumbers(telefono)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "Numero de telefono no valido",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }
        cedula = $("#actualizar #cedula").val();
        if (!onlyNumbers(cedula)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "Cedula no valida",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }
        email = $("#actualizar #email").val();
        if (!onlyEmail(email)) {
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: "email no valido",
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });
          toggleLoading(false);
          return false;
        }

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
              title: 'Profesor editado con exito',
              showConfirmButton: false,
              toast: true,
              timer: 3500
            })
            // actualizar tabla
            toggleLoading(false, '#actualizar')
            $('#editar').modal('hide')
          },
        });

      })


      // TOGGLE BUTTON AND SPINNER

    })

    function toggleLoading(show, form = "") {
      if (show) {
        $(`${form} #loading`).show();
        $(`${form} #submit`).hide();
      } else {
        $(`${form} #loading`).hide();
        $(`${form} #submit`).show();
      }
    }

    function showDetails(id) {

      $.ajax({
        type: "POST",
        url: showDetailsUrl,
        data: {
          'cedula': id
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
          datos = JSON.parse(data)
          $('#datos').modal('show')
          $('#datosContacto').find('#telefono').val(datos.telefono)
          $('#datosContacto').find('#direccion').val(datos.direccion)
        },
      });
    }

    function onlyLetters(str) {
      return /^[A-Za-zñáéíóúü ]*$/.test(str);
    }

    function phoneNumbers(number) {
      return /^[04][0-9]{10}$/.test(number);
    }

    function onlyNumbers(number) {
      return /^[0-9]{7,8}$/.test(number);
    }

    function onlyEmail(email) {
      return /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/.test(email)

    }


    function renderUpdateForm(data) {
      $('#editar').modal('show')
      // seleccionar trayecto
      $(`#actualizar #cedula`).val(data.controlAcademico.cedula);
      $(`#actualizar #cedulaEdit`).val(data.controlAcademico.cedula);
      $(`#actualizar #nombre`).val(data.controlAcademico.nombre);
      $(`#actualizar #apellido`).val(data.controlAcademico.apellido);
      $(`#actualizar #direccion`).val(data.controlAcademico.direccion);
      $(`#actualizar #telefono`).val(data.controlAcademico.telefono);
      $(`#actualizar #email`).val(data.controlAcademico.email);

    }

    function edit(id) {
      $.ajax({
        type: "POST",
        url: editUrl,
        data: {
          'cedula': id
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

      Swal.fire({
        title: "¿Seguro que desea eliminar el usuario de control academico?",
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
              'cedula': id
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
                title: 'usuario de control academico borrado con exito',
                showConfirmButton: false,
                toast: true,
                timer: 1500
              })
              $('#example').DataTable().ajax.reload();
            },
          });
        }
      });

    }
  </script>