<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearLabel">Nueva Sección</h5>

      </div>
      <form action="<?= APP_URL . $this->Route('inscripcion/crear') ?>" method="post" id="guardar" ">
        <div class=" modal-body">
        <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
        <input type="hidden" name="unidad_curricular_id" value="<?= $idMateria ?>">
        <div class="container-fluid">
          <div class="row pb-2">
            <div class="col-12">
              <div class="row form-group">
                <div class="col-lg-6">
                  <label class="form-label" for="profesor_id">Profesor *</label>
                  <select class="form-select" name="profesor_id" id="profesor_id">
                    <option value="" disabled="disabled" selected="selected" id="ningunProfesor">-- Ninguno --</option>
                    <?php foreach ($profesores as $profesor) : ?>
                      <option value="<?= $profesor->codigo ?>"><?= "$profesor->nombre $profesor->apellido" ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-6">
                  <label class="form-label" for="seccion_id">Seccion *</label>
                  <select class="form-select" name="seccion_id" id="seccion_id">
                    <option value="" disabled="disabled" selected="selected" id="ningunaSeccion">-- Ninguno --</option>
                    <?php foreach ($secciones as $seccion) : ?>
                      <option value="<?= $seccion->codigo ?>"><?= "$seccion->codigo" ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="transferEstudiantes">

                </div>
              </div>

            </div>
          </div>
        </div>
    </div>
    <!-- footer de acciones -->
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
      <input type="submit" class="btn btn-primary" value="Guardar" id="submit">
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