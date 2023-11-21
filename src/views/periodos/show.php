<h4 class="font-weight-bold py-3 mb-4">
  <span class="text-muted font-weight-light">Proyecto /</span> Detalles
</h4>

<div class="card">
  <h5 class="card-header bg-primary text-white">
    Detalles de Proyecto
  </h5>
  <div class="card-body">
    <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardar">
      <input type="hidden" name="estatus" value="1">
      <div class="container-fluid">
        <div class="row pb-2">
          <div class="col-12">
            <div class="row form-group">
              <div class="col-lg-6">
                <label class="form-label" for="nombre">Nombre *</label>
                <input type="text" class="form-control mb-1" placeholder="..." name="nombre" value="<?= $proyecto->nombre ?>" readonly>
              </div>

              <div class="col-lg-3">
                <label class="form-label" for="trayecto_id">Trayecto *</label>
                <input type="text" class="form-control mb-1" value="<?= $proyecto->nombre_trayecto ?>" readonly>
              </div>

              <div class="col-lg-3">

                <label class="form-label" for="tutor_id">Tutor</label>
                <input type="text" class="form-control mb-1" value="<?= $proyecto->nombre_tutor ?>" readonly>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row form-group">

              <div class="col-lg-6">
                <label class="form-label" for="descripcion">Descripción</label>
                <textarea readonly class="form-control" placeholder="..." id="descripcion" name="descripcion" style="height: 100px"><?= $proyecto->descripcion ?></textarea>
              </div>

              <div class="col-lg-3">
                <label class="form-label" for="municipio">Municipio</label>
                <input type="text" class="form-control mb-1" placeholder="..." name="municipio" value="<?= $proyecto->municipio ?>" readonly>
              </div>

              <div class="col-lg-3">
                <label class="form-label" for="area">Area</label>
                <input type="text" class="form-control mb-1" placeholder="..." name="area" value="<?= $proyecto->area ?>" readonly>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="row form-group">

              <div class="col-lg-4">
                <label class="form-label" for="repositorio_codigo" for="descripcion">Repositorio de Código</label>
                <input type="text" class="form-control mb-1" placeholder="..." name="repositorio_codigo" value="<?= $proyecto->repositorio_codigo ?>" readonly>
              </div>

              <div class="col-lg-4">
                <label class="form-label" for="repositorio_documentacion">Documentación</label>
                <input type="text" class="form-control mb-1" placeholder="..." name="repositorio_documentacion" value="<?= $proyecto->repositorio_documentacion ?>" readonly>
              </div>

              <div class="col-lg-4">
                <label class="form-label" for="url">URL</label>
                <input type="text" class="form-control mb-1" placeholder="..." name="url" value="<?= $proyecto->url ?>" readonly>
              </div>
            </div>
          </div>

          <div class="col-12 mb-4">
            <div class="row form-group justify-content-center">
              <table class="table table-striped table-responsive">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">C.I.</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                  </tr>
                </thead>
                <tbody id="cuerpoTablaEstudiantes">
                  <?php foreach ($estudiantes as $estudiante) : ?>
                    <tr id="appenedStudent-${studentId}">
                      <th scope="row">
                        <?= $estudiante->cedula ?>
                      </th>
                      <td><?= $estudiante->nombre ?></td>
                      <td><?= $estudiante->apellido ?></td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <hr class="border-light m-0">
          <div class="text-right mt-3">
          </div>
        </div>
      </div>
    </form>
  </div>
</div>