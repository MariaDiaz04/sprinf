<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearLabel"><b>Nuevo Proyecto</b></h5>

      </div>
      <div class="modal-body">
        <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardar">
          <input type="hidden" name="estatus" value="1">
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group">
                  <div class="col-lg-3">
                    <label class="form-label" for="fase_id"><b>Trayecto *</b></label>
                    <select class="form-select" name="fase_id" id="selectFaseId" required>

                      <?php foreach ($fases as $fase) : ?>
                        <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-9">
                    <label class="form-label" for="nombre"><b>Nombre *</b></label>
                    <input type="text" class="form-control mb-1" placeholder="..." required name="nombre">
                  </div>
                </div>
              </div>
              <div class="row form-group mb-3">
                <div class="col-lg-12 mb-3">
                  <label class="form-label" for="consejo_comunal_id"><b>Consejo Comunal *</b></label>
                  <select class="form-select" name="consejo_comunal_id" id="selectParroquia" required>

                    <?php foreach ($consejosComunales as $consejoComunal) : ?>
                      <option value="<?= $consejoComunal->consejo_comunal_id ?>"><?= "$consejoComunal->municipio_nombre - $consejoComunal->parroquia_nombre - $consejoComunal->consejo_comunal_nombre" ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-6 mb-3">
                  <label class="form-label" for="direccion"><b>Dirección</b></label>
                  <textarea class="form-control" placeholder="..." required id="direccion" name="direccion" style="height: 50px"></textarea>
                </div>
                <div class="col-lg-6 mb-3">
                  <label class="form-label" for="motor_productivo"><b>Motor Productivo</b></label>
                  <textarea class="form-control" placeholder="..." required id="motor_productivo" name="motor_productivo" style="height: 50px"></textarea>
                </div>


                <div class="col-lg-6">
                  <label class="form-label" for="tutor_in"><b>Tutor Interno *</b></label>
                  <select class="form-select" name="tutor_in" id="selectFaseId">

                    <?php foreach ($profesores as $profesor) : ?>
                      <option value="<?= $profesor->codigo ?>"><?= "$profesor->cedula - $profesor->nombre $profesor->apellido" ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-lg-6">
                  <label class="form-label" for="tutor_ex"><b>Nombre Completo Tutor Externo *</b></label>
                  <input type="text" class="form-control mb-1" placeholder="..." required name="tutor_ex">
                </div>
                <div class="col-lg-6">
                  <label class="form-label" for="comunidad"><b>Comunidad *</b></label>
                  <textarea class="form-control" placeholder="..." required id="comunidad" name="comunidad" style="height: 50px "></textarea>
                </div>
                <div class="col-lg-6">
                  <label class="form-label" for="tlf_tex"><b>Telefono Tutor Externo *</b></label>
                  <input type="text" class="form-control mb-1" placeholder="..." required name="tlf_tex">
                </div>
                <div class="col-lg-6">
                  <label class="form-label" for="resumen"><b>Resumen *</b></label>
                  <textarea class="form-control" placeholder="..." required id="resumen" name="resumen" style="height: 50px"></textarea>
                </div>
                <div class="col-lg-6">
                  <label class="form-label" for="observaciones"><b>Observaciones </b></label>
                  <textarea class="form-control" placeholder="..." id="observaciones" name="observaciones" style="height: 50px"></textarea>
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