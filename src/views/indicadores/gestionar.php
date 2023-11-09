<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Indicadores / Gestionar</div>
        <a class="btn btn-primary btn-round d-block" href="#" data-bs-toggle="modal" data-bs-target="#crear"><span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white"><b>Indicadores</b> </h6>
    <div class="card-body px-3 pt-3">
      <table id="example" class="display" style="width:100%">
        <thead>
          <tr>
            <th>id</th>
            <th>Nombre</th>
            <th>Ponderación %</th>
            <th>Acción</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
  <script>
    let deleteUrl = "<?= APP_URL . $this->Route('indicadores/delete') ?>";

    $(document).ready(() => {


      // DATATABLE CRUD

      // las acciones son definidas en la clase que contiene el botón, es decir,
      // si necesito editar, le añado la clase "edit"
      // luego en la función table.on(). verifico si la clase del boton en el que hice click
      // contiene el nombre de alguna acción que haya definido

      let table = new DataTable('#example', {
        ajax: '<?= $this->Route('ssp/' . $idDimension) ?>',
        processing: true,
        serverSide: true,
        pageLength: 30,

        // columnDefs: [{
        //     visible: false,
        //     targets: [0, 2, 5, 6]
        //   },
        //   {
        //     data: null,
        //     render: function(data, type, row, meta) {
        //       return (row[7]) ? row[7] : 'No evaluado';
        //     }, // combino los botons de acción
        //     targets: 7 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        //   }
        // ]

        columnDefs: [{
          data: null,
          render: function(data, type, row, meta) {
            return `<div class="dropdown show">
                      <button class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow" href="#" role="button" id="dropdown-${row[0]}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdown-${row[0]}">
                        <a class="dropdown-item" onClick="edit('${row[0]}')" href="#">Editar</a>
                        <a class="dropdown-item text-danger" onClick="remove('${row[0]}')" href="#">Eliminar</a>
                      </div>
                    </div>`;
          }, // combino los botons de acción
          targets: 3 // la columna que representa, empieza a contar desde 0, por lo que la columna de acciones es la 3ra
        }]
      });

    })
  </script>