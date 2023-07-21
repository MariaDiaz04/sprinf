<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Proyectos </span>/ Gestión</div>

        <a class="btn btn-outline-primary btn-round d-block" href="<?= $this->Route('proyectos/crear') ?>">
          <span class="ion ion-md-add"></span>&nbsp; Nuevo </a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Proyectos</h6>
    <div class="card-body px-0 pt-0">
      <?php if ($proyectos) : ?>
        <table id="tablaProyectos" class="table table-hover">
          <thead class=" thead">
            <tr>
              <th>id</th>
              <th>Trayecto</th>
              <th>Tutor</th>
              <th>Nombre</th>
              <th>area</th>
              <th>estatus</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($proyectos as $proyecto) : ?>

              <tr class="item-proyecto ip-<?= $proyecto->id ?>" id="i<?= $proyecto->id ?>">
                <td scope="row"><strong><?= $proyecto->id ?></strong></td>
                <td><?= $proyecto->nombre_trayecto ?></td>
                <td><?= $proyecto->nombre_tutor ?></td>
                <td><?= $proyecto->nombre ?></td>
                <td><?= $proyecto->area ?></td>
                <td class="text-center">
                  <?php if ($proyecto->estatus) : ?>
                    <span class="badge bg-label-primary  mt-2 py-2">Activo</span>
                  <?php else : ?>
                    <span class="badge bg-label-dark ">Inactivo</span>
                  <?php endif ?>
                </td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Opciones <box-icon name='cog'></box-icon>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="<?= APP_URL . $this->Route("proyectos/$proyecto->id") ?>"><box-icon name='edit'></box-icon> Ver Detalles</a></li>
                      <li><a class="dropdown-item" href="<?= APP_URL . $this->Route("proyectos/edit/$proyecto->id") ?>"><box-icon name='edit'></box-icon> Editar</a></li>

                    </ul>
                  </div>
                </td>
                <!-- TODO: CRUD OPTIONS -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        <?php else : ?>
          <div class="col-12 mt-4 text-muted">
            <h4 class="text-center">No hay ningun Proyecto registrado</h4>
          </div>
        <?php endif; ?>
        </table>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#tablaProyectos').DataTable();
    });
    /* const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

 function eliminaragente(id) {
  
   swal.fire({
        title: "¿Estas seguro?",
        text: "¡No podras revertir este paso!!",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#ca3333",
        cancelButtonColor: "#1c2730",
        confirmButtonText: "¡Si, eliminar!",
        cancelButtonText: "¡No, cancelar!",

        }).then((result) => {
            if (result.isConfirmed) {
              jQuery.get('?r=usuario/eliminaragente&id='+id, function(data) {
                    $('#i'+id).attr({ hidden: '', });
                    swalWithBootstrapButtons.fire(
                      'Hecho!',
                      'El usuario a sido eliminado.',
                      'success'
                    )
              });
             
            } else if (
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelado',
                'Tu usuario no ha sido eliminado :)',
                'error'
              )
            }
          })
       
};

function eliminaranalista(id) {
  
 swal.fire({
      title: "¿Estas seguro?",
      text: "¡No podras revertir este paso!!",
      icon: "info",
      showCancelButton: true,
      confirmButtonColor: "#ca3333",
      cancelButtonColor: "#1c2730",
      confirmButtonText: "¡Si, eliminar!",
      cancelButtonText: "¡No, cancelar!",

      }).then((result) => {
          if (result.isConfirmed) {
            jQuery.get('?r=usuario/eliminaranalista&id='+id, function(data) {
                  console.log(data);
                  $('#i'+id).attr({ hidden: '', });
                  swalWithBootstrapButtons.fire(
              'Hecho!',
              'El usuario a sido eliminado.',
              'success'
            )
              });
           
          } else if (
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Cancelado',
              'Tu usuario no ha sido eliminado :)',
              'error'
            )
          }
        })
     
};


$('#search').on('submit', function(event) {
    event.preventDefault();
    if ($("#dni").val().length!=0) {
        $('.CUser').attr({hidden:''});
        $('.CU'+$("#dni").val()).removeAttr('hidden');
        $("#dni").val('');
    }else{swal('Ayuda?','Debes ingrsar un DNI para buscarlo','info'); }

});

$("#dni").on('keyup', function(e) {
    if (e.keyCode==8 && $("#dni").val().length==0) {
        $('.CUser').removeAttr('hidden');
    }
});

$(document).ready(function() {
    $('#tableUser').DataTable();
} ); */
  </script>


</div>