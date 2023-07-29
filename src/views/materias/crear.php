<h4 class="font-weight-bold py-3 mb-4">
  <span class="text-muted font-weight-light">Materias /</span> Agregar
</h4>
<!-- Content -->
<div class="card">
  <h5 class="card-header bg-primary text-white">
    Agregar nuevo
  </h5>
  <div class="card-body">
    <form action="<?= $this->Route('materiasGuardar') ?>" method="post" id="materiasGuardar">
      <div class="container-fluid">
        <div class="row pb-2">
          <div class="col-12">
            <div class="row form-group">
              <div class="col-lg-3">
                <label class="form-label ">Nombre</label>
                <input type="text" class="form-control mb-1" placeholder="Algoritmo" name="nombre" minlength="5" required>
                <span id="nombre"></span>
              </div>
              <div class="col-lg-3">
                <label class="form-label ">Tipo</label>
                <br>
                <select class="custom-select form-select" name="tipo">
                  <option value="<?= 'anual' ?>">Anual</option>
                  <option value="<?= 'fase1' ?>">Fase 1</option>
                  <option value="<?= 'fase2' ?>">Fase 2</option>
                </select>
              </div>
              <div class="col-lg-3">
                <label class="form-label ">Trayecto</label>
                <br>
                <select class="custom-select form-select" name="trayecto_id" id="codigo">
                  <option value="">Seleccionar uno</option>
                  <?php foreach ($trayectos as $trayecto) : ?>
                    <option value="<?php echo $trayecto->id; ?>"><?php echo $trayecto->nombre; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr class="border-light m-0">
      <div class="text-right mt-3">
        <input type="submit" class="btn btn-primary" value='Guardar Registro' />&nbsp;
        <a href="<?=APP_URL.$this->Route('materias') ?>" class="btn btn-outline-primary">Volver</a>
      </div>
  </div>
  </form>
</div>
</div>