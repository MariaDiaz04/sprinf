<!-- MODAL CREAR -->
<div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="actualizarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearLabel">Actualización de Dimensión</h5>

      </div>
      <form action="<?= APP_URL . $this->Route('dimensiones/actualizar') ?>" method="post" id="dimensionActualizar">
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
          <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group mb-3">
                  <input type="hidden" name="unidad_id" value="<?= $unidadCurricular->codigo ?>">

                  <div class="col-12">
                    <label class="form-label" for="nombre">Nombre Dimensión *</label>
                    <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre" required>
                  </div>
                </div>
                <div class="row form-group">

                  <div class="col-lg-12 d-flex justify-content-start align-items-end">
                    <div class="form-check ">
                      <label class="form-check-label" for="grupal">
                        Evaluación Grupal
                      </label>
                      <input class="form-check-input" type="checkbox" value="1" id="grupal" name="grupal">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <!-- footer de acciones -->
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Actualizar" id="submit">
            <div id="loading">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only"></span>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>