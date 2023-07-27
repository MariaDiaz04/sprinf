<h4 class="font-weight-bold py-3 mb-4">
  <span class="text-muted font-weight-light">Proyecto /</span> Detalles
</h4>

<div class="card">
  <h5 class="card-header bg-primary text-white">
    Detalles de Baremos
  </h5>
  <div class="card-body">
    <form action="<?= APP_URL . $this->Route("baremos/update") ?>" method="POST" id="proyectoActualizar">
      <input type="hidden" name="estatus" value="1">
      <input type="hidden" name="id" value="<?= $baremos->id ?>">
      <div class="container-fluid">
        <div class="row pb-2">
          <div class="col-12">
            <div class="row form-group">
              <div class="col-lg-3">
                <label class="form-label" for="trayecto_id">Trayecto *</label>
                <select class="form-select" name="trayecto_id">

                  <?php foreach ($trayectos as $trayecto) : ?>
                    <option value="<?= $trayecto->id ?>" <?= ($trayecto->id == $baremos->trayecto_id ? 'selected' : '') ?>><?= $trayecto->nombre ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>

          <hr class="border-light m-0">
          <div class="text-right mt-3">
            <input type="submit" class="btn btn-primary" value='Actualizar Registro' />&nbsp;
          </div>
        </div>
      </div>
    </form>
  </div>
</div>