<div>
   <div>
      <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
            <div><span class="text-muted font-weight-light">Materias </span>/ </div>
               
                        <form method="POST" action="<?= $this->Route('materiasCrear') ?>">
                        <input type="hidden" name="rol" value="<?= 2 ?>">
                        <button class="btn btn-outline-primary btn-round d-block">
                        <span class="ion ion-md-add"></span>&nbsp; Nuevo </button>
                        </form>

           </h4>
      </div>
    </div>

 <div class="card">
  <h6 class="card-header bg-primary text-white">Materias</h6>
  <div class="card-body px-0 pt-0">
  <?php if ($materias): ?>
      <table id="tableMaterias" class="table table-hover">
              <thead class=" thead">
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Tipo</th>
                  <th>Trayecto</th>
                </tr>
              </thead>
            <tbody>
              <?php foreach ($materias as $objmaterias): ?>
                <tr class="CUser CU<?=$objmaterias->id?>" id="i<?=$objmaterias->id?>">
                <td><?=$objmaterias->id?></td>
                <td><?=$objmaterias->nombre?></td>
                <td><?=$objmaterias->tipo?></td>
                <td><?=$objmaterias->trayecto?></td>
                <td>      <div class="btn-group">
                      <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end " data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 41px);">
                        <li><a class="dropdown-item" href="<?=APP_URL.$this->Route("materias/editar/$objmaterias->idmaterias") ?>"><i class="fas fa-user-edit"></i> Editar</a></li>
                        <li><a class="dropdown-item " href="javascript:void(0)" onClick="return eliminarpermisos(<?= $objmaterias->idmaterias ?>)" id='<?= $objmaterias->idmaterias ?>'><i class="fas fa-user-minus"></i> Eliminar </a></li>
                      </ul>
                    </div>
                  </div>
                </td>

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
 <div class="demo-inline-spacing">
                  
 <script>
    document.addEventListener('DOMContentLoaded', function () {
    $('#tableMaterias').DataTable();
} ); 
 </script>