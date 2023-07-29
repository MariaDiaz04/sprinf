<div>
   <div>
      <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
                <div><span class="text-muted font-weight-light">Modulos </span>/ </div>
                <form method="POST" action="<?=APP_URL .$this->Route('modulos/crear')?>">
                <input type="hidden" name="rol" value="<?=$rol?>">
                <button class="btn btn-outline-primary btn-round d-block">
                <span class="ion ion-md-add"></span>&nbsp; Nuevo </button></form>
           </h4>
      </div>
    </div>

 <div class="card">
  <h6 class="card-header bg-primary text-white">Modulos</h6>
  <div class="card-body px-0 pt-0">
  <?php if ($modulo): ?>
			<table id="tableModulo" class="table table-hover">
              <thead class="thead">
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
				          <th class="text-center">Opciones</th>
                </tr>
              </thead>
            <tbody>

			        <?php	foreach ($modulo as $objmodulo): ?>
                <tr class="CUser CU <?=$objmodulo->modulo_id?>" id="i<?=$objmodulo->modulo_id?>">
                <td><?=$objmodulo->modulo_id?></td>
                  <td><?=$objmodulo->nombre?></td>                 
				            <td class="text-center"><button type="button" class="btn btn-outline-primary " data-toggle="dropdown" data-trigger="hover" aria-expanded="false"><i class="fas fa-user-cog"></i> </button>
                      <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; top: 38px; left: 0px; will-change: top, left;">
                        <a class="dropdown-item" href="<?=$this->Route('modulo/editar', ['modulo' => $objmodulo->modulo_id])?>"><i class="fas fa-user-edit"></i> Editar</a>
                        <a class="dropdown-item " href="javascript:void(0)" onClick="return eliminarmodulo(<?=$objmodulo->modulo_id?>)" id='<?=$objmodulo->modulo_id?>'><i class="fas fa-user-minus"></i>  Eliminar </a>
                      </div>
                    </td>
                </tr>
				      <?php endforeach; ?>
        </tbody>
        <?php else: ?>
          <div class="col-12 text-muted">
					  <h4 class="text-center">No hay ningún Modulo registrado</h4>
				  </div>
  	  	<?php endif;?>
    </table>
  </div>
 </div>

		
</div>  

<script>
  function eliminarmodulo(modulo_id) { 
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
             jQuery.get('?r=modulo/eliminar&modulo_id='+modulo_id, function(data) {
                   $('#i'+modulo_id).attr({ hidden: '', });
                   swalWithBootstrapButtons.fire(
               'Hecho!',
               'El Modulo ha sido eliminado.',
               'success'
             )
               });
            
           } else if (
             result.dismiss === Swal.DismissReason.cancel
           ) {
             swalWithBootstrapButtons.fire(
               'Cancelado',
               'El Modulo no ha sido eliminado :)',
               'error'
             )
           }
         })    
 };

 $(document).ready(function() {
    $('#tableModulo').DataTable();
} );
 </script>

