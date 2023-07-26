<div>
    <div>
        <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
                <div><span class="text-muted font-weight-light">Bitacora </span>/ </div>
               
            </h4>
        </div>
    </div>

    <div class="card">
        <h6 class="card-header bg-primary text-white">Bitacora</h6>
        <div class="card-body px-0 pt-0">
            <?php if ($bitacora) : ?>
                <table id="tablebitacora" class="table table-hover">
                    <thead class=" thead">
                        <tr>
                            <th>Id</th>
                            <th>Fecha de sesion</th>
                            <th>Navegador</th>
                            <th>Hora inicio</th>
                            <th>Hora cierre</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bitacora as $objbitacora) : ?>
                            <tr  id="i<?= $objbitacora->id ?>">
                                <td><?= $objbitacora->id ?></td>
                                <td><?= $objbitacora->fecha ?></td>
                                <td><?= substr($objbitacora->navegador,0,60) ?></td>
                                <td><?= $objbitacora->hora_inicio ?></td>
                                <td><?= $objbitacora->hora_cierre ?></td>
                                <td><?= $objbitacora->nombre." ".$objbitacora->apellido ?></td>
                             
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php else : ?>
                    <div class="col-12 text-muted">
                        <h4 class="text-center">No hay ninguna bitacora registrada</h4>
                    </div>
                <?php endif; ?>
                </table>
        </div>
    </div>

   <script>

  document.addEventListener('DOMContentLoaded', function () {
        $('#tablebitacora').DataTable();

} ); 
  </script>
 

</div>