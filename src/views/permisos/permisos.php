<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Control de Permisos </span>/ </div>
        <form method="POST" action="<?=APP_URL. $this->Route('permisos/crear') ?>">
          <input type="hidden" name="rol" value="<?= $rol ?>">
          <button class="btn btn-outline-primary btn-round d-block">
            <span class="ion ion-md-add"></span>&nbsp; Nuevo </button>
        </form>
      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Panel de permisos</h6>
    <div class="card-body px-0 pt-0 table-responsive">
      <?php if ($permisos) : ?>
        <table id="tablePermisos" class="table table-hover">
          <thead class="thead">
            <tr>
              <th>Id</th>
              <th>Rol</th>
              <th>Modulo</th>
              <th>Consultar</th>
              <th>Registrar</th>
              <th>Actualizar</th>
              <th>Eliminar</th>
              <th class="text-center">Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($permisos as $objpermisos) : ?>
              <tr class="CUser CU<?= $objpermisos->id ?>" id="i<?= $objpermisos->id ?>">
                <td><?= $objpermisos->id ?></td>
                <td><?= $objpermisos->nombre ?> </td>
                <td><?= $objpermisos->nombmodulo ?></td>
                <td>
                  <?php if ($objpermisos->consultar == 1) : ?>
                    <span class="badge rounded-pill bg-success">Activo</span>
                  <?php else : ?>
                    <span class="badge rounded-pill bg-danger">Inactivo</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if ($objpermisos->crear == 1) : ?>
                    <span class="badge rounded-pill bg-success">Activo</span>
                  <?php else : ?>
                    <span class="badge rounded-pill bg-danger">Inactivo</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if ($objpermisos->actualizar == 1) : ?>
                    <span class="badge rounded-pill bg-success">Activo</span>
                  <?php else : ?>
                    <span class="badge rounded-pill bg-danger">Inactivo</span>
                  <?php endif; ?>
                </td>
                <td>
                  <?php if ($objpermisos->eliminar == 1) : ?>
                    <span class="badge rounded-pill bg-success">Activo</span>
                  <?php else : ?>
                    <span class="badge rounded-pill bg-danger">Inactivo</span>
                  <?php endif; ?>
                </td>
                <td class="text-center">
                  <div class="demo-inline-spacing">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end " data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 41px);">
                        <li><a class="dropdown-item" href="<?=APP_URL.$this->Route("permisos/editar/$objpermisos->id") ?>"><i class="fas fa-user-edit"></i> Editar</a></li>
                        <li><a class="dropdown-item " href="javascript:void(0)" onClick="return eliminarpermisos(<?= $objpermisos->id ?>)" id='<?= $objpermisos->id?>'><i class="fas fa-user-minus"></i> Eliminar </a></li>
                      </ul>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else : ?>
        <div class="col-12 text-muted">
          <h4 class="text-center">No hay ningún Permiso registrado</h4>
        </div>
      <?php endif; ?>
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
        $.get('<?= APP_URL ?>permisos/eliminar', {
          idpermisos: idpermisos
        }, function(response) {
          $('#i' + idpermisos).attr({
            hidden: '',
          })
          swal.fire(
            'Hecho!',
            'El Permiso ha sido eliminado.',
            'success'
          )

        });

      } else if (
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swal.fire(
          'Cancelado',
          'El Permiso no ha sido eliminado :)',
          'error'
        )
      }
    })
  };

  document.addEventListener('DOMContentLoaded', function() {
    $('#tablePermisos').DataTable();
  });
</script>