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
      <table id="tableUser" class="table table-hover">
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
                 <!-- <?=$objmaterias->trayecto?></td> -->
                
                   
                    
                      <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; top: 38px; left: 0px; will-change: top, left;">
                        <?php if ($permisos->actualizar == 1) : ?>
                        <a class="dropdown-item" href="<?=$this->Route('materias/editar', ['materias' => $some->id])?>"><i class="fas fa-user-edit"></i> Editar</a>
                       <?php endif; ?>

                        <!--<a class="dropdown-item" href="<?//=$this->Route('usuario/permisos', ['usuario' => $some->usuarios_id])?>"><i class="fas fa-user-edit">d</i> Asignar Permisos</a>-->
             
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