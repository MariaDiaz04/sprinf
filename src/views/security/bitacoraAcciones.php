<div>
    <div>
        <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
                <div><span class="text-muted font-weight-light">Bitacora acciones </span>/ </div>

            </h4>
        </div>
    </div>

    <div class="card">
        <h6 class="card-header bg-primary text-white">Bitacora Acciones</h6>
        <div class="card-body px-0 pt-0">
            <?php if ($bitacora_acciones) : ?>
                <table id="tablebitacora" class="table table-hover">
                    <thead class=" thead">
                        <tr>
                            <th>Id</th>
                            <th>Fecha de sesion</th>
                            <th>Navegador</th>
                            <th>Usuario</th>
                            <th>Modulo</th>
                            <th>Accion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bitacora_acciones as $accion) : ?>
                            <tr id="i<?= $accion->id ?>">
                                <td><?= $accion->id ?></td>
                                <td><?= $accion->fecha ?></td>
                                <td><?= substr($accion->navegador, 0, 60) ?></td>
                                <td><?= $accion->usuario_id ?></td>
                                <td><?= $accion->modulo_id ?></td>
                                <td><?= $accion->accion ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                <?php else : ?>
                    <div class="col-12 text-muted">
                        <h4 class="text-center">No hay ninguna bitacora de acciones registrada</h4>
                    </div>
                <?php endif; ?>
                </table>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#tablebitacora').DataTable();

        });
    </script>


</div>