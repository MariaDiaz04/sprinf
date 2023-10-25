<div class="modal fade" id="actualizar" tabindex="-1" role="dialog" aria-labelledby="actualizarLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="actualizarLabel"><b>Actualizar Proyecto</b></h5>

      </div>
      <div class="modal-body">
        <form action="<?= APP_URL . $this->Route('proyectos/actualizar') ?>" method="post" id="proyectoActualizar">
          <input type="hidden" readonly name="estatus">
          <input type="hidden" readonly name="id" id="id">
          <input type="hidden" readonly name="fase_id" id="fase_id">
          <input type="hidden" readonly name="cerrado" id="cerrado">
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group">

                  <div class="col-lg-12">
                    <label class="form-label" for="nombre"><b>Nombre *</b></label>
                    <input type="text" class="form-control mb-1" placeholder="..." required name="nombre" id="nombre">
                  </div>
                </div>
              </div>
              <div class="col-12 mb-3">
                <div class="row form-group">
                  <div class="col-lg-12 mb-3">
                    <label class="form-label" for="consejo_comunal_id"><b>Consejo Comunal *</b></label>
                    <select class="form-select" name="consejo_comunal_id" id="selectConsejoComunal" required>

                      <?php foreach ($consejosComunales as $consejoComunal) : ?>
                        <option value="<?= $consejoComunal->consejo_comunal_id ?>"><?= "$consejoComunal->municipio_nombre - $consejoComunal->parroquia_nombre - $consejoComunal->consejo_comunal_nombre" ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-lg-12">
                    <label class="form-label" for="resumen"><b>Dirección</b></label>
                    <textarea class="form-control" placeholder="..." required name="direccion" id="direccion" style="height: 70px"></textarea>
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
                    <label class="form-label" for="tutor_ex"><b>Nombre Completo Tutor Externo *</b></label>
                    <input type="text" class="form-control mb-1" placeholder="..." required name="tutor_ex" id="tutor_ex">
                  </div>

                  <div class="col-lg-6">
                    <label class="form-label" for="comunidad"><b>Comunidad *</b></label>
                    <textarea class="form-control" placeholder="..." required name="comunidad" id="comunidad" style="height: 70px "></textarea>
                  </div>

                  <div class="col-lg-6">
                    <label class="form-label" for="tlf_tex"><b>Telefono Tutor Externo *</b></label>
                    <input type="text" class="form-control mb-1" placeholder="..." required name="tlf_tex" id="tlf_tex">
                  </div>

                  <div class="col-lg-12">
                    <label class="form-label" for="resumen"><b>Resumen *</b></label>
                    <textarea class="form-control" placeholder="..." required id="resumen" name="resumen" id="resumen" style="height: 70px "></textarea>
                  </div>
                </div>
              </div>

              <hr class="border-light m-0">
              <div class="col-12">
                <div class="row form-group align-items-end">

                  <div class="col-lg-10">
                    <label class="form-label"><b>Estudiantes *</b></label>
                    <select class="form-select" id="selectEstudiante">

                    </select>
                  </div>

                  <div class="col-lg-1 align-middle">
                    <button class="btn btn-primary" id="anadirEstudiante">Añadir</button>
                  </div>

                </div>
              </div>
              <div class="row form-group justify-content-center">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">C.I.</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Apellido</th>
                      <th scope="col">Remover</th>
                    </tr>
                  </thead>
                  <tbody id="cuerpoTablaActualizarEstudiante">

                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" onClick="return false;" data-bs-dismiss="modal">Cancelar</button>
                <input type="submit" class="btn btn-primary" value="Actualizar" id="submit">
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