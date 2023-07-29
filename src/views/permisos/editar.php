<div>
  <!-- Content -->
  <div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light">Permisos/</span> Editar
    </h4>
  </div>
  <div class="card">
    <h5 class="card-header bg-primary text-white">
      Editar permisos
    </h5>
    <div class="card-body">
      <form action="<?= APP_URL . $this->Route("permisos/actualizar/$permisos->idpermisos") ?>" method="POST" id="permisoseditar">
        <div class="container-fluid">
          <div class="row pb-2">
            <div class="col-12">
              <div class="row form-group">
                <div class="col-lg-6">
                  <label class="form-label">Rol</label>
                  <select class="form-select" name="rol_id" id="rol_id">
                    <?php foreach ($roles as $rol) : ?>
                      <option <?php if ($permisos->rol_id == $rol->id) echo "selected"; ?>disabled readonly value="<?= $rol->id ?>"><?= $rol->nombre ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-lg-6">
                  <label class="form-label">Modulo</label>
                  <select class="form-select" name="modulo_id" id="modulo_id">
                    <?php foreach ($modulos as $modulo) : ?>
                      <option <?php if ($permisos->modulo_id == $modulo->modulo_id) echo "selected"; ?>disabled readonly value="<?= $modulo->modulo_id ?>"><?= $modulo->nombre ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row pb-2">

            <div class="col-3">
              <div class="row form-group">
                <div class="col-lg-12">
                  <label class="form-label">Consultar</label>
                  <select class="form-select" name="consultar" id="consultar">
                    <?php if ($permisos->consultar == 1) : ?>
                      <option selected value="1" style="display:none;">Si</option>
                    <?php else : ?>
                      <option selected value="2" style="display:none;">No</option>
                    <?php endif; ?>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="row form-group">
                <div class="col-lg-12">
                  <label class="form-label">Crear</label>
                  <select class="form-select" name="crear" id="crear">
                    <?php if ($permisos->crear == 1) : ?>
                      <option selected value="1" style="display:none;">Si</option>
                    <?php else : ?>
                      <option selected value="2" style="display:none;">No</option>
                    <?php endif; ?>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="row form-group">
                <div class="col-lg-12">
                  <label class="form-label">Actualizar</label>
                  <select class="form-select" name="actualizar" id="actualizar">
                    <?php if ($permisos->actualizar == 1) : ?>
                      <option selected value="1" style="display:none;">Si</option>
                    <?php else : ?>
                      <option selected value="2" style="display:none;">No</option>
                    <?php endif; ?>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="col-3">
              <div class="row form-group">
                <div class="col-lg-12">
                  <label class="form-label">Eliminar</label>
                  <select class="form-select" name="eliminar" id="eliminar">
                    <?php if ($permisos->eliminar == 1) : ?>
                      <option selected value="1" style="display:none;">Si</option>
                    <?php else : ?>
                      <option selected value="2" style="display:none;">No</option>
                    <?php endif; ?>
                    <option value="1">Si</option>
                    <option value="2">No</option>
                  </select>
                </div>
              </div>
            </div>

          </div>
          <hr class="border-light m-0">
          <div class="text-right mt-3">
            <input type="submit" class="btn btn-primary" value='Guardar Configuración' />&nbsp;
            <a href="<?= APP_URL . $this->Route('permisos') ?>" class="btn btn-outline-primary">Volver</a>
          </div>


        </div>
      </form>
    </div>
  </div>
  <!-- / Content -->
</div>

<style>
  label.error {
    float: none;
    color: red;
    padding-left: .5em;
    vertical-align: middle;
    font-size: 14px;
  }
</style>