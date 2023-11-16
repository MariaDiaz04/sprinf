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
      <table class="table table-striped">
        <tr>
          <th>Fase</th>
          <th>Ponderado</th>
        </tr>
        <tbody>

          <?php foreach ($fases as $fase) : ?>
            <tr>
              <td> <?= $fase->nombre_fase ?></td>
              <td><b><?= $fase->ponderado_baremos ?>%</b></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <table id="example" class="table table-striped" style="width:100%">
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
        pageLength: 10,
        order: [
          [2, 'desc']
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