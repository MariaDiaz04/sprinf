<?php if ($permisos == null) : ?>
    <div class="col-12 text-muted py-5 my-5">
        <h4 class="text-center my-5">No tiene permisos para ver este modulo (contacte con soporte tecnico)</h4>
    </div>
<?php elseif ($permisos->consultar != 1) : ?>
    <div class="col-12 text-muted py-5 my-5">
        <h4 class="text-center my-5">No tiene permisos para ver este modulo (contacte con soporte tecnico) </h4>
    </div>
<?php elseif ($permisos->consultar == 1) : ?>



 <div>
   <div>
      <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
                <div><span class="text-muted font-weight-light"><?=$this->ROL->find($rol)->fillable['nombre']?> </span>/ </div>
               
                <?php if ($permisos->crear == 1) : ?>
                        <form method="POST" action="<?= $this->Route('usuario/crear') ?>">
                        <input type="hidden" name="rol" value="<?= $rol ?>">
                        <button class="btn btn-outline-primary btn-round d-block">
                        <span class="ion ion-md-add"></span>&nbsp; Nuevo </button>
                        </form>
                <?php endif; ?>

           </h4>
      </div>
    </div>

 <div class="card">
  <h6 class="card-header bg-primary text-white">Usuarios</h6>
  <div class="card-body px-0 pt-0">
  <?php if ($persona): ?>
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
              <?php foreach ($persona as $some): ?>
                <tr class="CUser CU<?=$some->cedula?>" id="i<?=$some->usuarios_id?>">
                  <td scope="row"><strong><?=$some->cedula?></strong></td>
                <td><?=$some->nombre.' '.$some->apellido?></td>
                  <td><?=$some->direccion?></td>
                  <td class="py-0">
                    <small class="d-block"><b><?=$some->email?></b></small>
                    <small class="d-block"><b><?=$some->telefono?></b></small>
                  </td>
                  <td class=""><?=$this->format($some->nacimiento)?></td>
                  <td class="text-center">
                    <?php  if ($some->estatus): ?>
                  <span class="badge badge-pill badge-primary  mt-2 py-2">Activo</span>
                   <?php else :?>
                   <span class="badge badge-pill badge-default ">Inactivo</span>
                   <?php endif?>
                   </td>
                    <td class="text-center"><button type="button" class="btn btn-outline-primary " data-toggle="dropdown" data-trigger="hover" aria-expanded="false"><i class="fas fa-user-cog"></i> </button>
                      <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; top: 38px; left: 0px; will-change: top, left;">
                        <?php if ($permisos->actualizar == 1) : ?>
                        <a class="dropdown-item" href="<?=$this->Route('usuario/editar', ['usuario' => $some->usuarios_id])?>"><i class="fas fa-user-edit"></i> Editar</a>
                       <?php endif; ?>

                        <!--<a class="dropdown-item" href="<?//=$this->Route('usuario/permisos', ['usuario' => $some->usuarios_id])?>"><i class="fas fa-user-edit">d</i> Asignar Permisos</a>-->
                       
                        <?php if ($this->ROL->find($rol)->fillable['id']==1): ?>
                        <?php if ($permisos->eliminar == 1) : ?>
                        <a class="dropdown-item " href="javascript:void(0)" onClick="return eliminaragente(<?=$some->usuarios_id?>)" id='i<?=$some->usuarios_id?>'><i class="fas fa-user-minus"></i>  Eliminar Agente</a>
                        <?php endif ?>
                        <?php endif; ?>

                        <?php if ($this->ROL->find($rol)->fillable['id']==1): ?>
                        <?php if ($permisos->eliminar == 1) : ?>
                        <a class="dropdown-item " href="javascript:void(0)" onClick="return eliminaranalista(<?=$some->usuarios_id?>)" id='i<?=$some->usuarios_id?>'><i class="fas fa-user-minus"></i>  Eliminar </a>
                        <?php endif ?>
                        <?php endif; ?>

                      </div>
                    </td>
                </tr>
              <?php endforeach;?>
        </tbody>
        <?php else: ?>
          <div class="col-12 mt-4 text-muted">
            <h4 class="text-center">No hay ningun <?=$this->ROL->find($rol)->fillable['nombre']?> registrado</h4>
          </div>
        <?php endif;?>
    </table>
  </div>
 </div>

  <script>

const swalWithBootstrapButtons = Swal.mixin({
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
} );
  </script>
    

</div>  
<?php endif; ?>