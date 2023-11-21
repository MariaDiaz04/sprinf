<div class="modal fade" id="historico" role="dialog" aria-labelledby="historicoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-bold" id="historicoLabel"><b>Continuación de Proyecto - <?= $periodo->fecha_inicio ?> / <?= $periodo->fecha_cierre ?></b></h5>
      </div>
      <div class="modal-body">
        <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardarHistorico">
          <input type="hidden" name="estatus" value="1">
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group mb-3">
                  <div class="col-lg-9">
                    <label class="form-label" for="nombre"><b>Proyecto *</b></label>
                    <select class="form-select" name="id" id="selectProyecto" required>
                      <option disabled selected value> -- Seleccione un Proyecto -- </option>
                      <?php foreach ($historicoProyectos as $idProyecto => $proyecto) : ?>
                        <option value="<?= $idProyecto ?>" data-nombre="<?= $proyecto->nombre ?>" data-tlf_tex="<?= $proyecto->tlf_tex ?>" data-comunidad="<?= $proyecto->comunidad ?>" data-resumen="<?= $proyecto->resumen ?>" data-motor_productivo="<?= $proyecto->motor_productivo ?>" data-direccion="<?= $proyecto->direccion ?>" data-consejo_comunal_id="<?= $proyecto->consejo_comunal_id ?>" data-codigo-siguiente-trayecto="<?= $proyecto->codigo_siguiente_trayecto ?>" data-tutor_in="<?= $proyecto->tutor_in ?>" data-tutor_ex="<?= $proyecto->tutor_ex ?>" data-parroquia_id="<?= $proyecto->parroquia_id ?>">
                          <?= "$proyecto->display" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-3">
                    <label class="form-label" for="fase_id"><b>Trayecto A Ingresar *</b></label>
                    <select class="form-select" name="fase_id" id="selectTrayecto" required disabled>
                      <option disabled selected value> -- </option>
                      <?php foreach ($fases as $fase) : ?>
                        <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="row form-group">

                  <div class="col-lg-4 d-flex align-items-end" style="margin-left: auto;">

                    <button class="btn btn-primary" id="cargarInformacion">Cargar Informacion</button>

                  </div>
                </div>
                <hr>
                <div class="row form-group">
                  <div class="col-lg-12">
                    <label class="form-label" for="nombre"><b>Nombre de proyecto*</b></label>
                    <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre" readonly required>
                  </div>
                </div>
                <div class="row form-group mb-2">
                  <div class="col-lg-12">
                    <label class="form-label" for="direccion"><b>Resumen de proyecto*</b></label>
                    <textarea class="form-control" placeholder="..." id="resumen" name="resumen" style="height: 50px" readonly required></textarea>
                  </div>
                </div>

                <div class="row form-group mb-2">
                  <div class="col-lg-6">
                    <label class="form-label" for="selectParroquia"><b>Parroquia *</b></label>
                    <select class="form-select" name="parroquia_id" id="selectParroquia" required disabled>
                      <?php foreach ($parroquias as $parroquia) : ?>
                        <option value="<?= $parroquia->parroquia_id ?>"><?= "$parroquia->parroquia_nombre" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label" for="consejo_comunal_id"><b>Consejo Comunal *</b></label>
                    <select class="form-select" name="consejo_comunal_id" id="selectConsejoComunal" required disabled>
                      <?php foreach ($consejosComunales as $consejoComunal) : ?>
                        <option value="<?= $consejoComunal->consejo_comunal_id ?>"><?= "$consejoComunal->municipio_nombre - $consejoComunal->parroquia_nombre - $consejoComunal->consejo_comunal_nombre" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <div class="row form-group mb-2">

                  <div class="col-lg-6">
                    <label class="form-label" for="motor_productivo"><b>Motor Productivo *</b></label>
                    <textarea class="form-control" placeholder="..." id="motor_productivo" name="motor_productivo" style="height: 50px" readonly required></textarea>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label" for="direccion"><b>Dirección Comunidad *</b></label>
                    <textarea class="form-control" placeholder="..." id="direccion" name="direccion" style="height: 50px" readonly required></textarea>
                  </div>
                </div>
                <div class="row form-group mb-2">
                  <div class="col-lg-6">
                    <label class="form-label" for="comunidad"><b>Comunidad *</b></label>
                    <input type="text" class="form-control mb-1" placeholder="..." name="comunidad" id="comunidad" required readonly>
                  </div>

                  <div class="col-lg-6">
                    <label class="form-label" for="tutor_ex"><b>Nombre Completo Tutor Externo *</b></label>
                    <input type="text" aria-describedby="historicoNombreTutorExt" class="form-control mb-1" placeholder="..." name="tutor_ex" id="tutor_ex" required>
                    <div id="historicoNombreTutorExt" class="invalid-feedback">
                      Por favor, proporcione un nombre válido.
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <label class="form-label" for="tutor_in"><b>Tutor Interno *</b></label>
                    <select class="form-select" name="tutor_in" id="selectTutorIn">

                      <?php foreach ($profesores as $profesor) : ?>
                        <option value="<?= $profesor->codigo ?>"><?= "$profesor->cedula - $profesor->nombre $profesor->apellido" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>

                  <div class="col-lg-6">
                    <label class="form-label" for="tlf_tex"><b>Telefono Tutor Externo *</b></label>
                    <input type="text" aria-describedby="historicoTlfExt" class="form-control mb-1" placeholder="..." name="tlf_tex" id="tlf_tex" required>
                    <div id="historicoTlfExt" class="invalid-feedback">
                      Por favor, proporcione un telefono válido.
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="transfer">

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
        </form>
      </div>
    </div>
  </div>
</div>