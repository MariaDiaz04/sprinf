<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Baremos </span>/ Gestión </div>
      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">
      Baremos

    </h6>
    <div class="card-body px-3 pt-3">
      <p class="d-flex justify-content-end">
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#verResumenBaremos" aria-expanded="false" aria-controls="notas-<?= $idMateria ?>">
          <i class='bx bx-search-alt'></i> Ver Resumen de Baremos
        </button>
      </p>
      <div class="collapse" id="verResumenBaremos">
        <h4 class="mb-4">Información Baremos</h4>
        <table class="table table-striped mb-4" id="resumenBaremos">
          <thead>
            <tr>
              <th>Fase</th>
              <th>Ponderado (%)</th>
            </tr>
          </thead>

          <tbody>

            <?php foreach ($fases as $fase) : ?>
              <tr>
                <td> <?= $fase->nombre_fase ?></td>
                <td><?= $fase->ponderado_baremos ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="1" style="text-align:right">Total:</th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="my-3"></div>
      <hr>
      <div class="my-3"></div>
      <table id="example" class="table table-striped table-responsive" style="width:100%">
        <thead class="thead-dark">
          <tr>
            <th>Unidad Curricular</th>
            <th>Fase</th>
            <th>Ponderado <b>(%)</b></th>
            <th>Código</th>
            <th>Acción</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <script>
    $(document).ready(() => {
      let tableResumen = new DataTable('#resumenBaremos', {
        footerCallback: function(row, data, start, end, display) {
          let api = this.api();

          // Remove the formatting to get integer data for summation
          let intVal = function(i) {
            console.log(i)
            return typeof i === 'string' ?
              i.replace(/[\$,]/g, '') * 1 :
              typeof i === 'number' ?
              i :
              0;
          };

          // Total over all pages
          total = api
            .column(1)
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

          // Total over this page
          pageTotal = api
            .column(1, {
              page: 'current'
            })
            .data()
            .reduce((a, b) => intVal(a) + intVal(b), 0);

          // Update footer
          api.column(1).footer().innerHTML =
            total + '%';
        }
      })
    })
  </script>

  <script>
    $(document).ready(() => {

      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      // let editBtn = "<button class=\"btn btn-outline-secondary btn-color btn-bg-color col-xs-6 mx-2 edit\">Editar</button>";
      // let deleteBtn = "<button class=\"btn btn-outline-danger btn-color btn-bg-color col-xs-6 mx-2 remove\">Eliminar</button>";
      let UrlGestionar = "<?= APP_URL . $this->Route('dimensiones/'); ?>";

      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('ssp/' . $idTrayecto) ?>',
        processing: true,
        serverSide: true,
        scrollX: true,
        scrollCollapse: true,
        responsive: true,
        pageLength: 10,
        order: [
          [1, 'asc']
        ],
        columnDefs: [{
          visible: false,
          targets: [3]
        }, {
          data: null,
          render: function(data, type, row, meta) {
            return `<a class="btn btn-primary my-1" href="${UrlGestionar + row[3]}"><i class="bx bx-pencil"></i></i></a>`;
          }, // combino los botons de acción
          targets: 4 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        }]
      });
    })
  </script>