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
          <h5 class="modal-title" id="crearLabel"><b>Nuevo Proyecto</b></h5>

        </div>
        <div class="modal-body">
          <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardar">
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-3">
                      <label class="form-label" for="fase_id"><b>Trayecto *</b></label>
                      <select class="form-select" name="fase_id" id="selectFaseId" required>

                        <?php foreach ($fases as $fase) : ?>
                          <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-9">
                      <label class="form-label" for="nombre"><b>Nombre *</b></label>
                      <input type="text" class="form-control mb-1" placeholder="..." required name="nombre">
                    </div>
                  </div>
                </div>
                <div class="col-12 mb-3">
                  <div class="row form-group">
                    <div class="col-lg-6">
                      <label class="form-label" for="parroquia_id"><b>Parroquia *</b></label>
                      <select class="form-select" name="parroquia_id" id="selectParroquia" required>

                        <?php foreach ($parroquias as $parroquia) : ?>
                          <option value="<?= $parroquia->parroquia_id ?>"><?= "$parroquia->municipio_nombre - $parroquia->parroquia_nombre" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="resumen"><b>Dirección</b></label>
                      <textarea class="form-control" placeholder="..." required id="resumen" name="direccion" style="height: 50px"></textarea>
                    </div>


                    <div class="col-lg-6">
                      <label class="form-label" for="tutor_in"><b>Tutor Interno *</b></label>
                      <select class="form-select" name="tutor_in" id="selectFaseId">

                        <?php foreach ($profesores as $profesor) : ?>
                          <option value="<?= $profesor->codigo ?>"><?= "$profesor->cedula - $profesor->nombre $profesor->apellido" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-lg-6">
                      <label class="form-label" for="tutor_ex"><b>Nombre Completo Tutor Externo *</b></label>
                      <input type="text" class="form-control mb-1" placeholder="..." required name="tutor_ex">
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="comunidad"><b>Comunidad *</b></label>
                      <textarea class="form-control" placeholder="..." required id="comunidad" name="comunidad" style="height: 50px "></textarea>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="tlf_tex"><b>Telefono Tutor Externo *</b></label>
                      <input type="text" class="form-control mb-1" placeholder="..." required name="tlf_tex">
                    </div>



                    <div class="col-lg-12">
                      <label class="form-label" for="resumen"><b>Resumen *</b></label>
                      <textarea class="form-control" placeholder="..." required id="resumen" name="resumen" style="height: 50px"></textarea>
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
          <h5 class="modal-title font-weight-bold" id="historicoLabel"><b>Continuación de Proyecto - <?= $periodo->fecha_inicio ?> / <?= $periodo->fecha_cierre ?></b></h5>
        </div>
        <div class="modal-body">
          <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardarHistorico">
            <input type="hidden" name="estatus" value="1">
            <div class="container-fluid">
              <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group mb-3">
                    <div class="col-lg-9">
                      <label class="form-label" for="nombre"><b>Proyecto *</b></label>
                      <select class="form-select" name="id" id="selectProyecto" required>
                        <option disabled selected value> -- Seleccione un Proyecto -- </option>
                        <?php foreach ($historicoProyectos as $idProyecto => $proyecto) : ?>
                          <option value="<?= $idProyecto ?>" data-nombre="<?= $proyecto->nombre ?>" data-tlf_tex="<?= $proyecto->tlf_tex ?>" data-comunidad="<?= $proyecto->comunidad ?>" data-resumen="<?= $proyecto->resumen ?>" data-direccion="<?= $proyecto->direccion ?>" data-parroquia-id="<?= $proyecto->parroquia_id ?>" data-codigo-siguiente-trayecto="<?= $proyecto->codigo_siguiente_trayecto ?>" data-tutor_in="<?= $proyecto->tutor_in ?>" data-tutor_ex="<?= $proyecto->tutor_ex ?>">
                            <?= "$proyecto->display" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-3">
                      <label class="form-label" for="fase_id"><b>Trayecto A Ingresar *</b></label>
                      <select class="form-select" name="fase_id" id="selectTrayecto" required disabled>
                        <option disabled selected value> -- </option>
                        <?php foreach ($fases as $fase) : ?>
                          <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <div class="row form-group">

                    <div class="col-lg-4 d-flex align-items-end" style="margin-left: auto;">

                      <button class="btn btn-primary" id="cargarInformacion">Cargar Informacion</button>

                    </div>
                  </div>
                  <hr>
                  <div class="row form-group">
                    <div class="col-lg-12">
                      <label class="form-label" for="nombre"><b>Nombre *</b></label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="nombre" id="nombre" readonly required>
                    </div>
                  </div>
                  <div class="row form-group mb-2">
                    <div class="col-lg-12">
                      <label class="form-label" for="direccion"><b>Resumen *</b></label>
                      <textarea class="form-control" placeholder="..." id="resumen" name="resumen" style="height: 50px" readonly required></textarea>
                    </div>
                  </div>

                  <div class="row form-group mb-2">
                    <div class="col-lg-6">
                      <label class="form-label" for="parroquia_id"><b>Parroquia *</b></label>
                      <select class="form-select" name="parroquia_id" id="selectParroquia" required disabled>

                        <?php foreach ($parroquias as $parroquia) : ?>
                          <option value="<?= $parroquia->parroquia_id ?>"><?= "$parroquia->municipio_nombre - $parroquia->parroquia_nombre" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="direccion"><b>Dirección *</b></label>
                      <textarea class="form-control" placeholder="..." id="direccion" name="direccion" style="height: 50px" readonly required></textarea>
                    </div>
                  </div>
                  <div class="row form-group mb-2">
                    <div class="col-lg-6">
                      <label class="form-label" for="comunidad"><b>Comunidad *</b></label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="comunidad" id="comunidad" required readonly>
                    </div>


                    <div class="col-lg-6">
                      <label class="form-label" for="tutor_ex"><b>Tutor Externo *</b></label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="tutor_ex" id="tutor_ex" required>
                    </div>
                    <div class="col-lg-6">
                      <label class="form-label" for="tutor_in"><b>Tutor Interno *</b></label>
                      <select class="form-select" name="tutor_in" id="selectTutorIn">

                        <?php foreach ($profesores as $profesor) : ?>
                          <option value="<?= $profesor->codigo ?>"><?= "$profesor->cedula - $profesor->nombre $profesor->apellido" ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <div class="col-lg-6">
                      <label class="form-label" for="tlf_tex"><b>Telefono Tutor Externo *</b></label>
                      <input type="text" class="form-control mb-1" placeholder="..." name="tlf_tex" id="tlf_tex" required>
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
      rightTabNameText: "Integrantes",
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