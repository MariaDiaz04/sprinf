<!-- MODAL CREAR -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearLabel">Creación de Dimensión</h5>

      </div>
      <form action="<?= APP_URL . $this->Route('dimensiones/guardar') ?>" method="post" id="guardar">
        <div class="modal-body">
          <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
          <div class="container-fluid">
            <div class="row pb-2">
              <div class="col-12">
                <div class="row form-group mb-3">
                  <input type="hidden" name="unidad_id" value="<?= $unidadCurricular->codigo ?>">

                  <div class="col-lg-12">
                    <label class="form-label" for="nombre">Nombre Dimensión *</label>
                    <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre" required>
                  </div>
                </div>
                <div class="row form-group mb-3">

                  <div class="col-lg-12 d-flex justify-content-start align-items-end">
                    <div class="form-check ">
                      <input class="form-check-input" type="checkbox" value="1" id="grupal" name="grupal">
                      <label class="form-check-label" for="grupal">
                        Evaluación Grupal
                      </label>
                    </div>
                  </div>
                </div>
                <hr>
                <div class="alert alert-secondary" role="alert">
                  Ingrese nombre y ponderación de cada indicador de esta dimensión.
                </div>
                <div class="row form-group align-items-end">
                  <div class="col-lg-5">
                    <label class="form-label" for="nombreItem">Nombre Indicador *</label>
                    <input type="text" class="form-control mb-1" placeholder="..." id="nombreItem">
                  </div>
                  <div class="col-lg-4">
                    <label class="form-label" for="ponderacionItem">Ponderación (%) *</label>
                    <input type="number" class="form-control mb-1" placeholder="..." id="ponderacionItem">
                  </div>
                  <div class="col-lg-3 align-middle">
                    <button class="btn btn-primary" id="anadirItem">Añadir</button>
                  </div>
                </div>

                <div class="row form-group justify-content-center">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Nombre Indicador</th>
                        <th scope="col">Ponderación (%)</th>
                        <th scope="col">Remover</th>
                      </tr>
                    </thead>
                    <tbody id="cuerpoTablaItems">

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- footer de acciones -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Guardar" id="guardarSubmit">
          <div id="guardarLoading">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only"></span>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>