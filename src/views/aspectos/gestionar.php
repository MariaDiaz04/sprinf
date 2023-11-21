<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Baremos </span>/ Gestión</div>

        <a class="btn btn-outline-primary btn-round d-block" href="<?= APP_URL . $this->Route('baremos/crear') ?>">
          <span class="ion ion-md-add"></span>&nbsp; Registrar</a>

      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Baremos</h6>
    <div class="card-body px-0 pt-0">
      <?php if ($aspectos) : ?>
        <table id="tablaBaremos" class="table table-hover">
          <thead class=" thead">
            <tr>
              <th>id</th>
              <th>Baremos</th>
              <th>Dimension</th>
              <th>Nombre</th>
              <th>Fase</th>
              <th>Tipo</th>
              <th>Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($aspectos as $aspecto) : ?>
              <tr class="item-proyecto ip-<?= $aspecto->id ?>" id="i<?= $aspecto->id ?>">
                <td scope="row"><strong><?= $aspecto->id ?></strong></td>
                <td><?= $aspecto->baremos ?></td>
                <td><?= $aspecto->dimension_id ?></td>
                <td><?= $aspecto->nombre ?></td>
                <td><?= $aspecto->fase ?></td>
                <td class="text-center">
                  <span class="badge bg-label-primary  mt-2 py-2"><?= $aspecto->tipo  ?></span>
                </td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                      Opciones <box-icon name='cog'></box-icon>
                    </button>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="<?= APP_URL . $this->Route("baremos/$aspecto->id") ?>"><box-icon name='edit'></box-icon> Ver Detalles</a></li>
                      <li><a class="dropdown-item" href="<?= APP_URL . $this->Route("baremos/edit/$aspecto->id") ?>"><box-icon name='edit'></box-icon> Editar</a></li>
                      <li>
                        <form action="<?= APP_URL . $this->Route('baremos/delete') ?>" method="post" id="eliminarProyecto">
                          <input type="hidden" name="id" value="<?= $aspecto->id ?>">
                          <button class="dropdown-item">Eliminar</button>
                        </form>
                      </li>

                    </ul>
                  </div>
                </td>
                <!-- TODO: CRUD OPTIONS -->
              </tr>
            <?php endforeach; ?>
          </tbody>
        <?php else : ?>
          <div class="col-12 mt-4 text-muted">
            <h4 class="text-center">No hay ningun Baremos registrado</h4>
          </div>
        <?php endif; ?>
        </table>
    </div>
  </div>
</div>