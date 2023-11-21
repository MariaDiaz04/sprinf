<div class="modal fade" id="evaluar" tabindex="-1" role="dialog" aria-labelledby="evaluarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="evaluarLabel">Calificaciones</h5>

      </div>
      <form action="<?= APP_URL . $this->Route('inscripcion/evaluar') ?>" method="post" id="evaluarInscripcion" ">
        <div class=" modal-body">
        <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
        <input type="hidden" name="unidad_curricular_id" value="<?= $idMateria ?>">
        <div class="container-fluid">
          <div class="row pb-2">
            <div class="col-12">
              <div class="row form-group">
                <div class="col-lg-12">
                  <div class="alert alert-secondary" role="alert">
                    Ingrese calificaciones por fase de estudiante, se tiene un limite de 20 puntos.
                  </div>
                  <div id="actualizarEvaluacion"></div>

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