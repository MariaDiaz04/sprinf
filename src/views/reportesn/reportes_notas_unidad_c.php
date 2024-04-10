<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light"> Reportes </span>/ Notas proyecto</div>

      
      </h4>
    </div>
  </div>

  <div class="modal-body">
            <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-3">
                      <label class="form-label" for="nombre">Periodo *</label>
                      <select class="form-select" name="periodo" id="periodos" onchange="muestraTrayectos();">
                        <option>Seleccione</option>
                        <?php foreach ($periodo as $p) : ?>
                          <option value="<?= $p->id ?>"><?= "$p->fecha_inicio / $p->fecha_cierre" ?></option>
                        <?php endforeach; ?>
                      </select>

                    </div>

                    <div class="col-lg-3">
                      <label class="form-label" for="Trayecto_id">Trayecto *</label>
                      <select class="form-select" name="Trayecto_id" id="trayectos" onchange="muestraSecciones();">
                      </select>


                    </div>

                    <div class="col-lg-3">
                      <label class="form-label" for="seccion">seccion *</label>
                      <select class="form-select" name="seccion" id="secciones" onchange="muestraSecciones_Trayecto();">
                      </select>
                    </div>

                  </div>
                  
                </div>
                <div class="col-12 pt-4">
                  <figure class="highcharts-figure">
                    <div id="cargar_grafica"></div>
                    <p class="highcharts-description"></p>
                  </figure> 
                </div>
              </div>
            </div>
          </div>

      
  </div>
  <script src="assets/vendor/js/all/js/all.min.js" crossorigin="anonymous"></script> 
<script src="assets/vendor/js/jquery/jquery.js" crossorigin="anonymous"></script>
  
  <script src="<?= APP_URL ?>assets/vendor/js/highcharts.js"></script>
  <script src="<?= APP_URL ?>assets/vendor/js/exporting.js"></script>
  <script src="<?= APP_URL ?>assets/vendor/js/export-data.js"></script>
  <script src="<?= APP_URL ?>assets/vendor/js/accessibility.js"></script>
  <script src="assets/vendor/js/reportes/reporte_nota_unidad.js"></script>

