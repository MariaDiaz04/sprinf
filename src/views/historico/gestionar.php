<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Histórico</div>
      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white"><b>Histórico</b> </h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="table table-striped table-responsive">
        <thead class="thead-dark">
          <tr>
            <th>id</th>
            <th>id_proyecto</th>
            <th>consejo_comunal_id %</th>
            <th>Nombre</th>
            <th>Cedula</th>
            <th>Trayecto</th>
            <th>nombre proyecto</th>
            <th>comunidad</th>
            <th>Consejo Comunal</th>
            <th>Tutor Interno</th>
            <th>Tlf. Tutor Interno</th>
            <th>municipio</th>
            <th>parroquia</th>
            <th>Calificacion(%)</th>
            <th>estatus</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <script>
    $(document).ready(() => {
      let table = new DataTable('#example', {
        ajax: '<?= APP_URL . $this->Route('historico/ssp') ?><?= (!is_null($filtro)) ? $filtro : '' ?>',
        processing: true,
        serverSide: true,
        scrollX: true,
        scrollCollapse: true,
        responsive: true,
        pageLength: 10,
        columnDefs: [{
          visible: false,
          targets: [0, 1, 2, 8, 10, 12, 13]
        }, {
          data: null,
          render: function(data, type, row, meta) {
            return row[14] == 1 ? `<span class="badge rounded-pill bg-success">Aprobado - ${row[13]}%</span>` : '<span class="badge rounded-pill bg-secondary">Reprobado</span>';
          },
          targets: 14
        }]
      });


    })
  </script>