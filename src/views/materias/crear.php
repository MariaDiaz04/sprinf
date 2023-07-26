<h4 class="font-weight-bold py-3 mb-4">
            <span class="text-muted font-weight-light">Materias  /</span> Agregar
          </h4>
          <!-- Content -->
          <div class="card">
            <h5 class="card-header bg-primary text-white">
              Agregar nuevo
            </h5>
            <div class="card-body">
              <form action="<?= $this->Route('materias/guardar') ?>" method="post" id="materiasguardar">
                <div class="container-fluid">
                  <div class="row pb-2">
                    <div class="col-12">
                      <div class="row form-group">
                        <div class="col-lg-5">
                          <label class="form-label ">Nombre</label>
                          <input type="text" class="form-control mb-1" placeholder="INF0001" name="nombre" minlength="5" required >
                          <span id="nombre"></span>
                        </div>
                       </div>
                     </div>
                 </div>
             </div>

                  <hr class="border-light m-0">
                  <div class="text-right mt-3">
                    <input type="submit" class="btn btn-primary" value='Guardar Registro' />&nbsp;
                    <a href="<?= $this->Route('materias') ?>" class="btn btn-outline-primary">Volver</a>
                  </div>
                </div>
              </form>
            </div>
          </div>