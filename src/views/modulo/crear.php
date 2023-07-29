<h4 class="font-weight-bold py-3 mb-4">
    <span class="text-muted font-weight-light">Modulo /</span> Agregar
</h4>
<!-- Content -->
<div class="card">
    <h5 class="card-header bg-primary text-white">
        Agregar nuevo
    </h5>
    <div class="card-body">
        <form action="<?= APP_URL .$this->Route('modulos/guardar') ?>" method="post" id="moduloguardar">
            <div class="container-fluid">
                <div class="row pb-2">
                    <div class="col-12">
                        <div class="row form-group">
                            <div class="col-lg-4">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="Modulo del Sistema" name="nombre">
                            </div>
                        </div>
                	</div>
                </div>
                <hr class="border-light m-0">
                <div class="text-right mt-3">
                    <input type="submit" class="btn btn-primary" value='Guardar Registro' />&nbsp;
                    <a href="<?= $this->Route('modulos') ?>" class="btn btn-outline-primary">Volver</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- / Content -->


<style>
    label.error {
        float: none;
        color: red;
        padding-left: .5em;
        vertical-align: middle;
        font-size: 14px;
    }
</style>