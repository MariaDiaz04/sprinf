<!-- MODAL CREAR -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearLabel">Creación de Indicador</h5>

      </div>
      <form action="<?= APP_URL . $this->Route('indicador/guardar') ?>" method="post" id="guardar">
        <input type="hidden" name="dimension_id" value="<?= $idDimension ?>">
        <div class="modal-body">
          <!-- el action será tomado en la función que ejecuta el llamado asincrono -->
          <div class="container-fluid">
            <div class="row form-group align-items-start">
              <div class="alert alert-secondary" role="alert">
                Ingrese nombre y ponderación de cada indicador de la dimensión <span style="font-weight: bold;"><?= $dimension->nombre ?></span>. <br>
                Se dispone de <span style="font-weight: bold;"><?= $pendientePorPonderar ?>%</span> por ponderar en Baremos.
              </div>
              <div class="col-lg-9">
                <label class="form-label" for="nombreItem">Nombre Indicador *</label>
                <input type="text" class="form-control mb-1" name="nombre" aria-describedby="invalidNombreGuardar" placeholder="..." id="nombreItem" onkeyup="validar('guardar')" maxlength="255" require>
                <div id="invalidNombreGuardar" class="invalid-feedback">
                </div>
              </div>
              <div class="col-lg-3">
                <label class="form-label" for="ponderacionItem">Ponderación (%) *</label>
                <input type="text" inputmode="numeric" maxlength="5" class="form-control mb-1" min="0" step="0.01" aria-describedby="invalidPonderacionGuardar" name="ponderacion" placeholder="..." id="ponderacionItem" onkeyup="validar('guardar')" value="0" max="<?= $pendientePorPonderar ?>" require>
                <div id="invalidPonderacionGuardar" class="invalid-feedback">
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- footer de acciones -->
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" id="crearSubmit">Cancelar</button>
          <input type="submit" class="btn btn-primary" value="Guardar" id="guardarSubmit">
          <div id="loading">
            <div class="spinner-border text-primary" role="status">
              <span class="sr-only"></span>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>



<script>
  $(document).ready(function() {
    $('#guardar').submit(function(e) {
      e.preventDefault()

      let errores = validar('guardar')

      if (errores != null) {
        Swal.fire({
          position: "bottom-end",
          icon: "error",
          title: errores,
          showConfirmButton: false,
          toast: true,
          timer: 2000,
        });
        return false;
      }

      toggleLoading(true);

      url = $(this).attr('action');
      data = $(this).serializeArray();

      $.ajax({
        type: "POST",
        url: url,
        data: data,
        error: function(error, status) {
          toggleLoading(false)
          Swal.fire({
            position: "bottom-end",
            icon: "error",
            title: status + ": " + error.error.message,
            showConfirmButton: false,
            toast: true,
            timer: 2000,
          });

        },
        success: function(data, status) {
          var table = $('#example').DataTable();
          table.ajax.reload();
          // usar sweetalerts
          // document.getElementById("guardar").reset();
          // actualizar tabla
          Swal.fire({
            position: "bottom-end",
            icon: "success",
            title: "Creación Exitosa",
            showConfirmButton: false,
            toast: true,
            timer: 1000,
          }).then(() => location.reload());
          document.getElementById("guardar").reset()
          $('#crear').modal('hide')
          toggleLoading(false)
        },
      });
    })
  })
</script>