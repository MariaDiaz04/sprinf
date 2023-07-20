<h4 class="font-weight-bold py-3 mb-4">
  <span class="text-muted font-weight-light">Proyecto /</span> Crear
</h4>

<div class="card">
  <h5 class="card-header bg-primary text-white">
    Crear Nuevo Proyecto
  </h5>
  <div class="card-body">
    <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardar">
      <div class="container-fluid">
        <div class="row pb-2">
          <div class="col-12">
            <div class="row form-group">
              <div class="col-lg-6">
                <label class="form-label" for="nombre">Nombre</label>
                <input type="text" class="form-control mb-1" placeholder="..." name="nombre">
              </div>

              <div class="col-lg-3">
                <label class="form-label" for="trayecto">Trayecto</label>
                <select class="form-select" name="trayecto">

                  <?php foreach ($trayectos as $trayecto) : ?>
                    <option value="<?= $trayecto->id ?>"><?= $trayecto->nombre ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-lg-3">
                <label class="form-label" for="tutor">Tutor</label>
                <select class="form-select" name="tutor">
                  <?php foreach ($tutores as $tutor) : ?>
                    <option value="<?= $tutor->id ?>"><?= "$tutor->cedula - $tutor->nombre $tutor->apellido" ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>