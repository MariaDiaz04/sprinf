<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div><span class="text-muted font-weight-light">Control de Permisos </span>/ </div>
      </h4>
    </div>
  </div>

  <div class="card">
    <h6 class="card-header bg-primary text-white">Panel de permisos</h6>
    <div class="card-body px-0 pt-0 table-responsive">
      <?php if ($roles) : ?>
        <table id="tablePermisos" class="table table-hover">
          <thead class="thead">
            <tr>
              <th>Id</th>
              <th>Rol</th>
              <th class="text-center">Opciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($roles as $rol) : ?>
              <tr class="CUser CU<?= $rol->id ?>" id="i<?= $rol->id ?>">
                <td><?= $rol->id ?></td>
                <td><?= $rol->nombre ?> </td>
                <td class="text-center">
                  <div class="demo-inline-spacing">
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow " data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bx bx-dots-vertical-rounded"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end " data-popper-placement="bottom-start" style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 41px);">
                       <li><a class="dropdown-item" href="<?=APP_URL.$this->Route("permisos/consultar/$rol->id") ?>"><i class="fas fa-user-edit"></i> Ver permisos</a></li>
                       <li><a class="dropdown-item" href="<?=APP_URL.$this->Route("permisos/crear/$rol->id") ?>"><i class="fas fa-user-edit"></i> Agregar permisos</a></li>
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