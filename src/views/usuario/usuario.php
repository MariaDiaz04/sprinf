<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light"><?= $this->ROL->find($rol)->fillable['nombre'] ?> </span>/ </div>

        <form method="POST" action="<?= $this->Route('usuarioCrear') ?>">
          <input type="hidden" name="rol" value="<?= $this->ROL->find($rol)->fillable['id'] ?>">
          <button class="btn btn-outline-primary btn-round d-block">
            <span class="ion ion-md-add"></span>&nbsp; Nuevo </button>
        </form>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Usuarios</h6>
    <div class="card-body px-0 pt-0">
      <?php if ($persona) : ?>
        <table id="tableUser" class="table table-hover">
          <thead class=" thead">
            <tr>
              <th>Cedula</th>
              <th>Nombre</th>
              <th>Dirección</th>
              <th class="">Contacto</th>
              <th class="">Fecha natal</th>
              <th class="text-center">Estatus</th>
              <th class="text-center">Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($persona as $some) : ?>
              <tr class="CUser CU<?= $some->cedula ?>" id="i<?= $some->usuario_id ?>">
                <td scope="row"><strong><?= $some->cedula ?></strong></td>
                <td><?= $some->nombre . ' ' . $some->apellido ?></td>
                <td><?= $some->direccion ?></td>
                <td class="py-0">
                  <small class="d-block"><b><?= $some->email ?></b></small>
                  <small class="d-block"><b><?= $some->telefono ?></b></small>
                </td>
                <td class=""><?= $this->format($some->nacimiento) ?></td>
                <td class="text-center">
                  <?php if ($some->estatus) : ?>
                    <span class="badge bg-label-primary  mt-2 py-2">Activo</span>
                  <?php else : ?>
                    <span class="badge bg-label-dark ">Inactivo</span>
                  <?php endif ?>
                </td>
                <td class="text-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end " data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 41px);">
                      <li><a class="dropdown-item" href="<?= APP_URL . $this->Route("usuario/editar/$some->usuario_id") ?>"><box-icon name='edit'></box-icon> Editar</a></li>
                      <li>
                        <?php if ($this->ROL->find($rol)->fillable['id'] != 2 && $this->ROL->find($rol)->fillable['id'] != 3) : ?>
                          <a class="dropdown-item " href="javascript:void(0)" onClick="return eliminarprofesor(<?= $some->usuario_id ?>)" id='i<?= $some->usuario_id ?>'><i class="fas fa-user-minus"></i> Eliminar Agente</a>
                        <?php endif; ?>
                        <!-- <?php if ($this->ROL->find($rol)->fillable['id'] != 2 || $this->ROL->find($rol)->fillable['id'] != 3) : ?>
                            <a class="dropdown-item " href="javascript:void(0)" onClick="return eliminaranalista(<?= $some->usuario_id ?>)" id='i<?= $some->usuario_id ?>'><i class="fas fa-user-minus"></i> Eliminar </a>
                        <?php endif; ?> -->
                      </li>

                    </ul>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        <?php else : ?>
          <div class="col-12 mt-4 text-muted">
            <h4 class="text-center">No hay ningun <?= $this->ROL->find($rol)->fillable['nombre'] ?> registrado</h4>
          </div>
        <?php endif; ?>
        </table>
    </div>
  </div>



  <script>
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
});*/

    document.addEventListener('DOMContentLoaded', function() {
      $('#tableUser').DataTable();
    });
  </script>


</div>