<div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="actualizarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actualizarLabel">Nuevo Proyecto</h5>

      </div>
      <div class="modal-body">
        <form action="<?= APP_URL . $this->Route('proyectos/actualizar') ?>" method="post" id="proyectoGuardar">
          <input type="hidden" readonly name="estatus" value="1">
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group">
                  <div class="col-lg-6">
                    <label class="form-label" for="fase_id">Fase *</label>
                    <select class="form-select" readonly name="fase_id" id="selectFaseId" readonly>
                    </select>
                  </div>

                  <div class="col-lg-6">
                    <label class="form-label" for="nombre">Nombre *</label>
                    <input type="text" class="form-control mb-1" placeholder="..." required readonly name="nombre">
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="row form-group">
                  <div class="col-lg-3">
                    <label class="form-label" for="municipio">Municipio</label>
                    <input type="text" class="form-control mb-1" placeholder="..." required readonly name="municipio">
                  </div>
                  <div class="col-lg-3">
                    <label class="form-label" for="parroquia">Parroquia</label>
                    <input type="text" class="form-control mb-1" placeholder="..." required readonly name="parroquia">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label" for="resumen">Dirección</label>
                    <textarea class="form-control" placeholder="..." required id="resumen" readonly name="direccion" style="height: 50px"></textarea>
                  </div>

                  <div class="col-lg-3">
                    <label class="form-label" for="tutor_in">Tutor Interno</label>
                    <input type="text" class="form-control mb-1" placeholder="..." required readonly name="tutor_in">
                  </div>

                  <div class="col-lg-3">
                    <label class="form-label" for="tutor_ex">Tutor Externo</label>
                    <input type="text" class="form-control mb-1" placeholder="..." required readonly name="tutor_ex">
                  </div>

                  <div class="col-lg-6">
                    <label class="form-label" for="comunidad">Comunidad</label>
                    <textarea class="form-control" placeholder="..." required id="comunidad" readonly name="comunidad" style="height: 50px "></textarea>
                  </div>
                  <div class="col-lg-3">
                    <label class="form-label" for="motor_productivo">Motor Productivo</label>
                    <input type="text" class="form-control mb-1" placeholder="..." required readonly name="motor_productivo">
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label" for="resumen">Resumen</label>
                    <textarea class="form-control" placeholder="..." required id="resumen" readonly name="resumen" style="height: 50px "></textarea>
                  </div>
                </div>
              </div>
              <hr class="border-light m-0">
              <div class="transferEstudiantes">

              </div>
              <hr class="border-light m-0">
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Guardar" id="submit">
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
  </div>
</div>