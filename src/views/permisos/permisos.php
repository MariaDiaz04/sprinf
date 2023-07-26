<div>
   <div>
      <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
                <div><span class="text-muted font-weight-light">Control de Permisos </span>/ </div>
                <form method="POST" action="<?=$this->Route('permisosCrear')?>">
                <input type="hidden" name="rol" value="<?=$rol?>">
                <button class="btn btn-outline-primary btn-round d-block">
                <span class="ion ion-md-add"></span>&nbsp; Nuevo </button></form>
           </h4>
      </div>
    </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Panel de permisos</h6>
    <div class="card-body px-0 pt-0">
      <?php if ($permisos): ?>
        <table id="tablePermisos" class="table table-hover">
          <thead class="thead">
            <tr>
              <th>Id</th>
              <th>Usuario</th>
              <th>Modulo</th>
              <th>Consultar</th>
              <th>Registrar</th>
              <th>Actualizar</th>
              <th>Eliminar</th>
              <th class="text-center">Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($permisos as $objpermisos): ?>
              <tr class="CUser CU<?= $objpermisos->idpermisos ?>" id="i<?= $objpermisos->idpermisos ?>">
                <td><?= $objpermisos->idpermisos ?></td>
                <td><?= $objpermisos->nombre ?> <?= $objpermisos->apellido ?></td>
                <td><?= $objpermisos->nombmodulo ?></td>
                <td>
                  <?php if ($objpermisos->consultar == 1) :?>
                    <span class="badge badge-pill badge-success">Activo</span>
                  <?php else : ?>
                    <span class="badge badge-pill badge-danger">Inactivo</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if ($objpermisos->crear == 1) :?>
                    <span class="badge badge-pill badge-success">Activo</span>
                  <?php else : ?>
                    <span class="badge badge-pill badge-danger">Inactivo</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if ($objpermisos->actualizar == 1) :?>
                    <span class="badge badge-pill badge-success">Activo</span>
                  <?php else : ?>
                    <span class="badge badge-pill badge-danger">Inactivo</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if ($objpermisos->eliminar == 1) :?>
                    <span class="badge badge-pill badge-success">Activo</span>
                  <?php else : ?>
                    <span class="badge badge-pill badge-danger">Inactivo</span>
                  <?php endif; ?>
                </td>
                <td class="text-center"><button type="button" class="btn btn-outline-primary " data-toggle="dropdown" data-trigger="hover" aria-expanded="false"><i class="fas fa-user-cog"></i> </button>
                  <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; top: 38px; left: 0px; will-change: top, left;">
                    <a class="dropdown-item" href="<?=$this->Route('permisos/editar', ['permisos' => $objpermisos->idpermisos])?>"><i class="fas fa-user-edit"></i> Editar</a>
                    <a class="dropdown-item " href="javascript:void(0)" onClick="return eliminarpermisos(<?=$objpermisos->idpermisos?>)" id='<?=$objpermisos->idpermisos?>'><i class="fas fa-user-minus"></i>  Eliminar </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?>
          <div class="col-12 text-muted">
            <h4 class="text-center">No hay ningún Permiso registrado</h4>
          </div>
      <?php endif;?>
    </div>
  </div>  
</div>  

<script>
  function eliminarpermisos(idpermisos) { 
  swal.fire({
       title: "¿Estas seguro?",
       text: "¡No podras revertir este paso!",
       icon: "info",
       showCancelButton: true,
       confirmButtonColor: "#ca3333",
       cancelButtonColor: "#1c2730",
       confirmButtonText: "¡Si, eliminar!",
       cancelButtonText: "¡No, cancelar!",
       }).then((result) => {
           if (result.isConfirmed) {
             jQuery.get('?r=permisos/eliminar&idpermisos='+idpermisos, function(data) {
                   $('#i'+idpermisos).attr({ hidden: '', });
                   swalWithBootstrapButtons.fire(
               'Hecho!',
               'El Permiso ha sido eliminado.',
               'success'
             )
               });
            
           } else if (
             result.dismiss === Swal.DismissReason.cancel
           ) {
             swalWithBootstrapButtons.fire(
               'Cancelado',
               'El Permiso no ha sido eliminado :)',
               'error'
             )
           }
         })    
 };

 $(document).ready(function() {
    $('#tablePermisos').DataTable();
} );
 </script>

