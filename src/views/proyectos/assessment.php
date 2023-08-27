<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Proyectos </span>/ Evaluar</div>


      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Baremos <?= $fase->nombre_trayecto . ' - ' . $fase->nombre_fase . ' - ' . $fase->fecha_inicio . '/' . $fase->fecha_cierre ?></h6>
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
            <th>Acción</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!-- MODAL CREAR -->
  <div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Nuevo Proyecto</h5>

        </div>
        <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="guardar">
          <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <!-- los inputs son validados con las funciones que se extraeran del controlador de periodo -->
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Fecha Inicial *</label>
                      <input type="date" class="form-control mb-1" placeholder="..." name="fecha_inicio" id="fecha_inicio">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Fecha Final *</label>
                      <input type="date" class="form-control mb-1" placeholder="..." name="fecha_cierre" id="fecha_cierre">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- footer de acciones -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Guardar" id="guardarSubmit">
            <div id="guardarLoading">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only"></span>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>