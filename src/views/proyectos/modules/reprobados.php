<!-- Modal -->
<div class="modal fade" id="reprobadosModal" tabindex="-1" aria-labelledby="reprobadosModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reprobadosModalLabel">Gestionar Reprobados</h5>
      </div>
      <form action="<?= APP_URL . $this->Route('proyectos/aprobar') ?>" method="post" id="reprobadosActualizar">
        <div class="modal-body">
          <input type="hidden" name="id" id="idProyecto" value="1">
          <div class="container-fluid">
            <div class="row form-group" id="reprobadosContainer">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" value="Aprobar" id="submit">
        </div>
      </form>
    </div>
  </div>
</div>