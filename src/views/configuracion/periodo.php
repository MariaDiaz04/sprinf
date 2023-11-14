<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Configuracion </span>/ Aperturar Periodo</div>


      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Aperturar Nuevo Lapso</h1>
    </h6>
    <div class="card-body px-3 pt-3">
      <div class="alert alert-primary" role="alert">
        <b>Periodo Actual: <?= $periodo->fecha_inicio ?> / <?= $periodo->fecha_cierre ?></b>
      </div>
      <div class="alert alert-light" role="alert">
        Al aperturar un nuevo trayecto, la siguiente información será enviada al historico:
        <ul>
          <li>Proyectos <span class="text-muted">(Junto con sus calificaciones)</span></li>
          <li>Inscripciones <span class="text-muted">(Junto con sus calificaciones)</span></li>
        </ul>
      </div>
      <form action="<?= APP_URL . $this->Route('configuracion/cerrar') ?>" method="post" id="cerrar">
        <!-- TODO: formulario de nuevo periodo -->
        <input type="hidden" name="estatus" value="1">
        <div class="container-fluid">
          <div class="row pb-2">
            <div class="col-12">
              <div class="row form-group">

                <div class="col-lg-6">
                  <label class="form-label" for="municipio">Inicio Siguiente Periodo</label>
                  <input type="date" class="form-control mb-1" name="fecha_inicio" value="<?= $inicio ?>">
                </div>

                <div class="col-lg-6">
                  <label class="form-label" for="area">Final Siguiente Periodo</label>
                  <input type="date" class="form-control mb-1" name="fecha_cierre" value="<?= $cierre ?>">
                </div>
              </div>
            </div>

            <div class="text-right mt-3 d-flex justify-content-end">
              <input type="submit" class="btn btn-primary" value="Aperturar" id="submit">
              <div id="loading">
                <div class="spinner-border text-primary" role="status">
                  <span class="sr-only"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      toggleLoading(false)

      function toggleLoading(show, form = '') {
        if (show) {
          $(`${form} #loading`).show();
          $(`${form} #submit`).hide();
        } else {
          $(`${form} #loading`).hide();
          $(`${form} #submit`).show();
        }

      }

      $('#cerrar').submit(function(e) {
        e.preventDefault()

        url = $(this).attr('action');
        data = $(this).serializeArray();

        $.ajax({
          type: "POST",
          url: url,
          data: data,
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
            Swal.fire({
              position: "bottom-end",
              icon: "success",
              title: "Nuevo Periodo Aperturado Exitosamente",
              showConfirmButton: false,
              toast: true,
              timer: 2000,
            }).then(() => window.location.replace("<?= APP_URL . $this->Route('proyectos') ?>"));
          },
        });
      })

    })
  </script>