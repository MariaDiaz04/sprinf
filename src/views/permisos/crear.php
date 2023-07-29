<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Control de Permisos /</span> Agregar
</h4>
<!-- Content -->
<div class="card">
    <h5 class="card-header bg-primary text-white">
        Agregar nuevo
    </h5>
    <div class="card-body">
        <form action="<?= APP_URL.$this->Route('permisos/guardar') ?>" method="post" id="permisosguardar">
            <div class="container-fluid">
                <div class="row pb-2">
                    <div class="col-4">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label class="form-label">Usuario</label>
                                <select class="form-select" name="rol_id" id="rol_id">
                                    <?php foreach ($roles as $rol) : ?>
                                        <option value="<?= $rol->id ?>"><?= $rol->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label class="form-label">Módulo</label>
                                <select class="form-select" name="modulo_id" id="modulo_id">
                                    <?php foreach ($modulos as $objmodulo) : ?>
                                        <option value="<?= $objmodulo->modulo_id ?>"><?= $objmodulo->nombre ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>
                    </div>
                  <!--   <div class="col-4"> 
                        <div class="row form-group">
                            <div class="col-lg-12 pt-4 mt-2">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="idmodulo2[]" onclick="disabledSelect()">
                                    <span class="custom-control-label">Dar todos los permisos</span>
                                </label>
                            </div>
                        </div>
                    </div> -->
                </div>
                <div class="row pb-2">

                    <div class="col-3">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label class="form-label">Crear</label>
                                <select class="form-select" name="crear" id="crear">
                                    <option value="1"> Si </option>
                                    <option value="2"> No </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label class="form-label">Consultar</label>
                                <select class="form-select" name="consultar" id="consultar">
                                    <option value="1"> Si </option>
                                    <option value="2"> No </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">

                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label class="form-label">Actualizar</label>
                                <select class="form-select" name="actualizar" id="actualizar">
                                    <option value="1"> Si </option>
                                    <option value="2"> No </option>
                                </select>

                            </div>
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <label class="form-label">Eliminar</label>
                                <select class="form-select" name="eliminar" id="eliminar">
                                    <option value="1"> Si </option>
                                    <option value="2"> No </option>
                                </select>

                            </div>
                        </div>
                    </div>

                </div>
                <hr class="border-light m-0">
                <div class="text-right mt-3">
                    <input type="submit" class="btn btn-primary" value='Guardar Configuración' />&nbsp;
                    <a href="<?=APP_URL. $this->Route('permisos') ?>" class="btn btn-outline-primary">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- / Content -->

<script >
    $('#idmodulo').addClass('disabled')
</script>
<style>
    label.error {
        float: none;
        color: red;
        padding-left: .5em;
        vertical-align: middle;
        font-size: 14px;
    }
</style>