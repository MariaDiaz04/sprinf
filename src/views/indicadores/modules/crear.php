<!-- MODAL CREAR -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearLabel">Creación de Indicador</h5>

      </div>
      <form action="<?= APP_URL . $this->Route('indicador/guardar') ?>" method="post" id="guardar">
        <input type="hidden" name="dimension_id" value="<?= $idDimension ?>">
        <div class="modal-body">
          <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
          <div class="container-fluid">
            <div class="row form-group align-items-end">
              <div class="col-lg-9">
                <label class="form-label" for="nombreItem">Nombre Indicador *</label>
                <input type="text" class="form-control mb-1" name="nombre" placeholder="..." id="nombreItem" onkeydown="return /[[\[\].,a-zA-Z_ñáéíóúü ]/i.test(event.key)" maxlength="255">
              </div>
              <div class="col-lg-3">
                <label class="form-label" for="ponderacionItem">Ponderación (%) *</label>
                <input type="number" class="form-control mb-1" min="0" step="0.01" name="ponderacion" placeholder="..." id="ponderacionItem" value="0" max="100">
              </div>
            </div>
          </div>
        </div>
        <!-- footer de acciones -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Guardar" id="guardarSubmit">
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