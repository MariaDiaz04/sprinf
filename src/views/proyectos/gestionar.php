<style>
  .transfer-double {
    background-color: none !important;
    border: none !important;
    box-shadow: none !important;
    width: 100%;
  }

  .transfer-double-content {
    display: flex;
  }

  .transfer-double-content-right {
    flex-grow: 1;
  }

  .transfer-double-content-left {
    flex-grow: 1;
  }
</style>
<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Proyectos </span>/ Gestión</div>

        <div class="d-flex">
          <a class="btn btn-primary btn-round d-block d-inline-block " style="margin-right: 10px;" href="#" data-bs-toggle="modal" data-bs-target="#historico"><span class="ion ion-md-add" id="cargarHistoricoBtn"></span>&nbsp; Registrar Histórico </a>
          <a class="btn btn-primary btn-round d-block d-inline-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>
        </div>

      </h4>

    </div>
  </div>

  <?php


  if ($cerrarFase) : ?>
    <div class="alert alert-primary" role="alert">
      <p>Todos los proyectos han sido evaluados! 🥳</p>
      <p><a href="<?= APP_URL . $this->Route('configuracion/aperturar-periodo') ?>" class="btn btn-primary">aperturar un nuevo periodo</a></p>
    </div>
  <?php endif; ?>

  <div class="card">
    <div class="card-header bg-primary  d-flex justify-content-between  align-items-center">

      <h6 class="text-white pt-3 "><b>Proyectos</b> - <?= $periodo->fecha_inicio ?> / <?= $periodo->fecha_cierre ?> </h6>
      <form method="POST" action="<?= APP_URL . $this->Route('configuracion/excel')  ?>">
        <div>
          <select class="form-select" name="trayecto_id">
            <?php foreach ($trayectos as $trayecto) : ?>
              <option value="<?= $trayecto->codigo ?>"><?= $trayecto->nombre ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <button class="btn btn-primary btn-round d-block ">
          <span class="ion ion-md-add"></span>&nbsp; Matriz de proyecto </button>
      </form>
    </div>

    <div class="card-body px-3 pt-3">
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Comunidad</th>
            <th>Trayecto</th>
            <th>Fase</th>
            <th>Integrantes</th>
            <th>Estatus</th>
            <th>Calificados</th>
            <th>Acción</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <!-- MODAL CREAR -->
  <div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="crearLabel">Nuevo Proyecto</h5>

        </div>
        <div class="modal-body">
          <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardar">
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="fase_id">Fase *</label>
                      <select class="form-select" name="fase_id" id="selectFaseId">

                        <?php foreach ($fases as $fase) : ?>
                          <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="nombre">Nombre *</label>
                      <input type="text" class="form-control mb-1" placeholder="..." required name="nombre">
                    </div>
                  </div>
                </div>
                <div class="col-12 mb-3">
                  <div class="row form-group">
                    <div class="col-lg-3">
                      <label class="form-label" for="municipio">Municipio</label>
                      <input type="text" class="form-control mb-1" placeholder="..." required name="municipio">
                    </div>
                    <div class="col-lg-3">
                      <label class="form-label" for="parroquia">Parroquia</label>
                      <input type="text" class="form-control mb-1" placeholder="..." required name="parroquia">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="resumen">Dirección</label>
                      <textarea class="form-control" placeholder="..." required id="resumen" name="direccion" style="height: 50px"></textarea>
                    </div>


                    <div class="col-lg-6">
                      <label class="form-label" for="tutor_in">Tutor In *</label>
                      <select class="form-select" name="tutor_in" id="selectFaseId">

                        <?php foreach ($profesores as $profesor) : ?>
                          <option value="<?= $profesor->codigo ?>"><?= "$profesor->cedula - $profesor->nombre $profesor->apellido" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-lg-3">
                      <label class="form-label" for="tutor_ex">Tutor Externo</label>
                      <input type="text" class="form-control mb-1" placeholder="..." required name="tutor_ex">
                    </div>
                    <div class="col-lg-3">
                      <label class="form-label" for="motor_productivo">Motor Productivo</label>
                      <input type="text" class="form-control mb-1" placeholder="..." required name="motor_productivo">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="comunidad">Comunidad</label>
                      <textarea class="form-control" placeholder="..." required id="comunidad" name="comunidad" style="height: 50px "></textarea>
                    </div>

                    <div class="col-lg-6">
                      <label class="form-label" for="resumen">Resumen</label>
                      <textarea class="form-control" placeholder="..." required id="resumen" name="resumen" style="height: 50px "></textarea>
                    </div>

                  </div>
                </div>
                <hr class="border-light m-0">
                <div class="transferEstudiantes">

                </div>
                <hr class="border-light m-0">
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                  <input type="submit" class="btn btn-primary" value="Guardar" id="submit">
                  <div id="loading">
                    <div class="spinner-border text-primary" role="status">
                      <span class="sr-only"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="historico" role="dialog" aria-labelledby="historicoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-bold" id="historicoLabel">Nuevo Proyecto Histórico - <?= $periodo->fecha_inicio ?> / <?= $periodo->fecha_cierre ?></h5>
        </div>
        <div class="modal-body">
          <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardarHistorico">
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group mb-3">
                    <div class="col-lg-12">
                      <label class="form-label" for="nombre">Proyecto </label>
                      <select class="form-select" name="id" id="selectProyecto">
                        <?php foreach ($historicoProyectos as $idProyecto => $proyecto) : ?>
                          <option value="<?= $idProyecto ?>" data-nombre="<?= $proyecto->nombre ?>" data-comunidad="<?= $proyecto->comunidad ?>" data-motor_productivo="<?= $proyecto->motor_productivo ?>" data-resumen="<?= $proyecto->resumen ?>" data-direccion="<?= $proyecto->direccion ?>" data-municipio="<?= $proyecto->municipio ?>" data-parroquia="<?= $proyecto->parroquia ?>" data-tutor_in="<?= $proyecto->tutor_in ?>" data-tutor_ex="<?= $proyecto->tutor_ex ?>"><?= "$proyecto->display" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-4">
                      <label class="form-label" for="fase_id">Trayecto</label>
                      <select class="form-select" name="fase_id" id="selectTrayecto">

                        <?php foreach ($fases as $fase) : ?>
                          <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-4 d-flex align-items-end" style="margin-left: auto;">

                      <button class="btn btn-primary" id="cargarInformacion">Cargar Informacion</button>

                    </div>
                  </div>
                  <hr>
                  <div class="row form-group">
                    <div class="col-lg-12">
                      <label class="form-label" for="nombre">Nombre</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre" readonly>
                    </div>
                  </div>
                  <div class="row form-group mb-2">
                    <div class="col-lg-3">
                      <label class="form-label" for="motor_productivo">Motor Productivo</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="motor_productivo" id="motor_productivo" readonly>
                    </div>
                    <div class="col-lg-9">
                      <label class="form-label" for="direccion">Resumen</label>
                      <textarea class="form-control" placeholder="..." id="resumen" name="resumen" style="height: 50px" readonly></textarea>
                    </div>
                  </div>
                  <div class="row form-group">
                    <div class="col-lg-3">
                      <label class="form-label" for="parroquia">Municipio</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="municipio" id="municipio" readonly>
                    </div>
                    <div class="col-lg-3">
                      <label class="form-label" for="parroquia">Parroquia</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="parroquia" id="parroquia" readonly>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="comunidad">Comunidad</label>
                      <textarea class="form-control" placeholder="..." id="comunidad" name="comunidad" style="height: 50px " readonly></textarea>
                    </div>
                  </div>

                  <div class="row form-group mb-2">
                    <div class="col-lg-12">
                      <label class="form-label" for="direccion">Dirección</label>
                      <textarea class="form-control" placeholder="..." id="direccion" name="direccion" style="height: 50px" readonly></textarea>
                    </div>
                  </div>
                  <div class="row form-group mb-2">
                    <div class="col-lg-6">
                      <label class="form-label" for="tutor_in">Tutor Interno</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="tutor_in" id="tutor_in">
                    </div>

                    <div class="col-lg-6">
                      <label class="form-label" for="tutor_ex">Tutor Externo</label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="tutor_ex" id="tutor_ex">
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <hr>
            <div class="transfer">

            </div>
            <hr class="border-light m-0">
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
              <input type="submit" class="btn btn-primary" value="Guardar" id="submit">
              <div id="loading">
                <div class="spinner-border text-primary" role="status">
                  <span class="sr-only"></span>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php
  include 'modules/actualizar.php';
  ?>
  <script src="<?= APP_URL ?>assets/js/jquery.transfer.js"></script>
  <script>
    // select de historico de estudiantes
    var groupDataArray1 = <?= json_encode($historicoEstudiantes); ?>;
    var estudiantes = <?= json_encode($estudiantes); ?>;
    var proyectosSSP = '<?= $this->Route('proyectos/ssp') ?>';
    var obtenerProyectosURL = '<?= $this->Route('proyectos/') ?>';
    var urlEvaluar = "<?= APP_URL ?>proyectos/assessment/";
    let fetchStudentsUrl = "<?= APP_URL . $this->Route('proyectos/pending-students') ?>";
    let noteUrl = "<?= APP_URL . $this->Route('proyectnotes/pdf') ?>";
    let deleteUrl = "<?= APP_URL . $this->Route('proyectos/borrar') ?>";



    // GROUPABLE AND SEARCHABLE SELECTS
    var settings3 = {
      groupDataArray: groupDataArray1,
      groupItemName: "nombre",
      groupArrayName: "integrantes",
      itemName: "nombre",
      valueName: "value",
      rightTabNameText: "Estudiantes Seleccionados",
      tabNameText: "Estudiantes del Historico",
      searchPlaceholderText: "Buscar Estudiantes",
      callable: function(items) {
        console.dir(items);
      },
    };

    var transfer = $(".transfer").transfer(settings3);

    // select de estudiantes

    var estudiantesSettings = {
      itemName: "nombre",
      valueName: "value",
      rightTabNameText: "Integrantes",
      tabNameText: "Estudiantes",
      dataArray: estudiantes,
    };

    var transfer2 = $(".transferEstudiantes").transfer(estudiantesSettings);
  </script>
  <script src="<?= APP_URL ?>js/proyecto/index.js"></script>