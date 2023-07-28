<div>
   <div>
      <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
                <div><span class="text-muted font-weight-light">Sección </span>/ </div>
               
                        <form method="POST" action="<?= $this->Route('seccionCrear') ?>">
                        <input type="hidden" name="rol" value="<?= 2 ?>">
                        <button class="btn btn-outline-primary btn-round d-block">
                        <span class="ion ion-md-add"></span>&nbsp; Nuevo </button>
                        </form>

           </h4>
      </div>
    </div>

 <div class="card">
  <h6 class="card-header bg-primary text-white">Sección</h6>
  <div class="card-body px-0 pt-0">
  <?php if ($seccion): ?>
      <table id="tableUser" class="table table-hover">
              <thead class=" thead">
                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Trayecto</th>
                  <th>Cantidad de Estudiantes</th>
                  <th>Estatus</th>
                </tr>
              </thead>
            <tbody>
              <?php foreach ($seccion as $some): ?>
                <tr class="CUser CU<?=$some->id?>" id="i<?=$some->id?>">
                  <td scope="row"><strong><?=$some->id?></strong></td>     
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
                        <a class="dropdown-item" href="<?=$this->Route('seccion/editar', ['seccion' => $some->id])?>"><i class="fas fa-user-edit"></i> Editar</a>
                       <?php endif; ?>

                        <!--<a class="dropdown-item" href="<?//=$this->Route('usuario/permisos', ['usuario' => $some->usuarios_id])?>"><i class="fas fa-user-edit">d</i> Asignar Permisos</a>-->
             
                      </div>
                    </td>
                </tr>
              <?php endforeach;?>
        </tbody>
        <?php else: ?>
          <div class="col-12 mt-4 text-muted">
            <h4 class="text-center">No hay ninguna sección registrada</h4>
          </div>
        <?php endif;?>
    </table>
  </div>
 </div>