<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Estudiantes </span>/ Gestión</div>

        <a class="btn btn-primary btn-round d-block flex-shrink-0" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Registrar</a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Periodos</h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="table table-striped table-responsive" style="width:100%">
        <thead class="thead-dark">
          <tr>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
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
          <h5 class="modal-title" id="crearLabel">Nuevo Estudiante</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('estudiantes/guardar') ?>" method="post" id="guardar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Cedula *</label>
                      <input type="text" required class="form-control mb-1" placeholder="..." name="cedula" id="cedula">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" required class="form-control mb-1" placeholder="..." name="nombre" id="nombre">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="apellido">Apellido *</label>
                      <input type="text" required class="form-control mb-1" placeholder="..." name="apellido" id="apellido">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="direccion">Dirección</label>
                      <input type="text" required class="form-control mb-1" placeholder="..." name="direccion" id="direccion">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="telefono">Teléfono</label>
                      <input type="number" required class="form-control mb-1" placeholder="..." name="telefono" id="telefono">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="email">Correo Electronico</label>
                      <input type="email" required class="form-control mb-1" placeholder="..." name="email" id="email">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- footer de acciones -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Guardar" id="guardar">
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

  <!-- MODAL ACTUALIZAR -->

  <div class="modal fade" id="editar" tabindex="-1" role="dialog" aria-labelledby="editarLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editarLabel">Editar Estudiante</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('estudiantes/update') ?>" method="post" id="actualizar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Cedula *</label>
                      <input type="text" require disabled class="form-control mb-1" id="cedulaEdit">
                      <input type="hidden" required class="form-control mb-1" name="cedula" id="cedulaEditTwo">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" required class="form-control mb-1" name="nombre" id="nombreEdit" max="55">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="apellido">Apellido *</label>
                      <input type="text" required class="form-control mb-1" name="apellido" id="apellidoEdit" max="55">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="direccion">Dirección</label>
                      <input type="text" required class="form-control mb-1" placeholder="..." name="direccion" id="direccionEdit" max="255">
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="telefono">Teléfono</label>
                      <input type="text" inputmode="numeric" class="form-control mb-1" placeholder="0424XXXXXXX" required name="telefono" id="telefonoEdit">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="email">Correo Electronico</label>
                      <input type="email" required class="form-control mb-1" placeholder="..." name="email" id="emailEdit">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- footer de acciones -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="editarSubmit">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Editar" id="editar">
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

  <script>
    let editUrl = "<?= APP_URL . $this->Route('estudiantes/edit') ?>";
    let showDetailsUrl = "<?= APP_URL . $this->Route('estudiantes/showDetails') ?>";
    let noteUrl = "<?= APP_URL . $this->Route('notes/pdf') ?>";
    let deleteUrl = "<?= APP_URL . $this->Route('estudiantes/delete') ?>";

    $(document).ready(() => {

      toggleLoading(false)

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('estudiantes/ssp') ?>',
        processing: true,
        serverSide: true,
        scrollX: true,
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
                        <a class="dropdown-item" onClick="showDetails('${row[4]}')" href="javascript:void(0)">Mostrar Datos de Contacto</a>
                        <a class="dropdown-item" href="<?= APP_URL . $this->route('historico?cedula=') ?>${row[0]}">Ver Histórico</a>
                        <a class="dropdown-item" onClick="edit('${row[0]}')" href="javascript:void(0)">Editar</a>
                        <a class="dropdown-item" " href="${noteUrl+'/'+row[0]}" target="_blank">Notas</a>
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
            title: "email no valida",
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
              timer: 2000
            })

            console.log(error, status)
          },
          success: function(data, status) {
            table.ajax.reload();
            // usar sweetalerts
            Swal.fire({
              position: 'bottom-end',
              icon: 'success',
              title: 'Estudiante guardado con exito',
              showConfirmButton: false,
              toast: true,
              timer: 2000
            })
            document.getElementById("guardar").reset();
            // actualizar tabla
            toggleLoading(false, '#guardar')
            $('#crear').modal('hide');
            console.log(data, status)
          },
        });

      })

      $('#actualizar').submit(function(e) {
        e.preventDefault()
        toggleLoading(true, '#actualizar');
        url = $(this).attr('action');
        data = $(this).serializeArray();

        nombre = $("#actualizar #nombreEdit").val();
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

        apellido = $("#actualizar #apellidoEdit").val();
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

        telefono = $("#actualizar #telefonoEdit").val();
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
        cedula = $("#actualizar #cedulaEdit").val();
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
        email = $("#actualizar #emailEdit").val();
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
              title: 'Estudiante editado con exito',
              showConfirmButton: false,
              toast: true,
              timer: 2500
            })
            // actualizar tabla
            toggleLoading(false, '#actualizar')
            $('#editar').modal('hide')
          },
        });

      })

      function descargarNotasEstudiante(id) {
        alert(`Editing ${id}`)
        console.log('aasddff');
      }

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

    function showDetails(id) {

      $.ajax({
        type: "POST",
        url: showDetailsUrl,
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
          datos = JSON.parse(data)
          $('#datos').modal('show')
          $('#datosContacto').find('#telefono').val(datos.telefono)
          $('#datosContacto').find('#direccion').val(datos.direccion)
        },
      });
    }


    function renderUpdateForm(data) {
      $('#editar').modal('show')
      // seleccionar trayecto
      $(`#actualizar #cedulaEdit`).val(data.estudiante.cedula);
      $(`#actualizar #cedulaEditTwo `).val(data.estudiante.cedula);
      $(`#actualizar #nombreEdit`).val(data.estudiante.nombre);
      $(`#actualizar #apellidoEdit`).val(data.estudiante.apellido);
      $(`#actualizar #direccionEdit`).val(data.estudiante.direccion);
      $(`#actualizar #telefonoEdit`).val(data.estudiante.telefono);
      $(`#actualizar #emailEdit`).val(data.estudiante.email);

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
        title: "¿Seguro que desea eliminar el estudiante?",
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
                title: 'Estudiante borrada con exito',
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

    function onlyLetters(str) {
      return /^[A-Za-zñáéíóúü ]*$/.test(str);
    }

    function phoneNumbers(number) {
      return /^[04][0-9]{10}$/.test(number);
    }

    function onlyNumbers(number) {
      return /^[0-9]{8}$/.test(number);
    }

    function onlyEmail(email) {
      return /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/.test(email)

    }
  </script>