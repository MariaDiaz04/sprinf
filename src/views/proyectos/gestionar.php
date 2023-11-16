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
      <table id="example" class="table table-striped" style="width:100%">
        <thead class="thead-dark">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Comunidad</th>
            <th>Trayecto</th>
            <th>Fase</th>
            <th>Integrantes</th>
            <th>Estatus</th>
            <th>Calificados</th>
            <th>Reprobados</th>
            <th>Acción</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <?php
  include 'modules/crear.php';
  include 'modules/historico.php';
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