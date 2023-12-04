<style>
  button.close {
    padding: 0;
    background-color: transparent;
    border: 0;
    -webkit-appearance: none;
  }

  .alert-dismissible .close {
    position: absolute;
    top: 0;
    right: 0;
    padding: .75rem 1.25rem;
    color: inherit;
  }

  .close {
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
    color: #000;
    text-shadow: 0 1px 0 #fff;
  }
</style>
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="crearLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="crearLabel"><b>Nuevo Proyecto</b></h5>

      </div>
      <div class="modal-body">
        <form action="<?= APP_URL . $this->Route('proyectos/guardar') ?>" method="post" id="proyectoGuardar">
          <input type="hidden" class="form-control" require value="Telecomunicaciones e informática" name="motor_productivo"></input>

          <input type="hidden" name="estatus" value="1">
          <div class="container-fluid">

            <div class="row form-group mb-3">

              <div class="col-lg-6">
                <label class="form-label" for="selectParroquia"><b>Municipio *</b></label>
                <select class="form-select" name="municipio_id" id="selectMunicipio" required>
                  <option value="" disabled="disabled" selected="selected" id="ningunMunicipio">-- Ninguna --</option>
                  <?php foreach ($municipios as $municipio) : ?>
                    <option value="<?= $municipio->id ?>" rel="municipio-<?= $municipio->id ?>"><?= "$municipio->nombre" ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-lg-6">
                <label class="form-label" for="selectParroquia"><b>Parroquia *</b></label>
                <select class="form-select" name="parroquia_id" id="selectParroquia" required>
                  <option value="" disabled="disabled" selected="selected" id="nigunaParroquia">-- Ninguna --</option>
                  <?php foreach ($parroquias as $parroquia) : ?>
                    <option value="<?= $parroquia->parroquia_id ?>" class="municipio-<?= $parroquia->municipio_id ?>" rel="parroquia-<?= $parroquia->parroquia_id ?>"><?= "$parroquia->parroquia_nombre" ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                  Si la comunidad no vincula a ningún consejo comunal, seleccione <strong>Comunidad Autónoma</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              </div>
            </div>
            <div class="row form-group mb-3">

              <div class="col-lg-4">
                <label class="form-label" for="selectParroquia"><b>Tipo de Comunidad</b></label>
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="1" id="comunidadAutonoma" name="comunidad_autonoma">
                  <label class="form-check-label" for="comunidadAutonoma">
                    Comunidad Autónoma
                  </label>
                </div>
              </div>
              <div class="col-lg-8 mb-3" id="seccionConsejoComunal">

                <label class="form-label" for="selectConsejoComunal"><b>Consejo Comunal</b></label>
                <select class="form-select" name="consejo_comunal_id" id="selectConsejoComunal">
                  <option value="" disabled="disabled" selected="selected" id="ningunConsejoComunal">-- Ninguno --</option>
                  <?php foreach ($consejosComunales as $consejoComunal) : ?>
                    <option value="<?= $consejoComunal->consejo_comunal_id ?>" class="parroquia-<?= $consejoComunal->parroquia_id ?>"><?= "$consejoComunal->consejo_comunal_nombre" ?></option>
                  <?php endforeach; ?>
                </select>
                <div class="alert alert-warning mt-3" role="alert" id="ccNoCreado">
                  <strong>No se ha registrado consejo comunal de la parroquia indicada.</strong>
                </div>
              </div>
            </div>
            <hr>
            <div class="row form-group mb-3">

              <div class="col-lg-3">
                <label class="form-label" for="fase_id"><b>Trayecto *</b></label>
                <select class="form-select" name="fase_id" id="selectFaseId" required>
                  <?php foreach ($fases as $fase) : ?>
                    <option value="<?= $fase->codigo_fase ?>"><?= "$fase->nombre_trayecto" ?></option>
                  <?php endforeach; ?>
                </select>
              </div>

              <div class="col-lg-9">
                <label class="form-label" for="nombre"><b>Nombre *</b></label>
                <input type="text" aria-describedby="creacionNombreValidation" class="form-control mb-1" placeholder="..." id="nombre" required name="nombre" maxlength="255">
                <div id="creacionNombreValidation" class="invalid-feedback">
                  Por favor proporcione un nombre válido
                </div>
              </div>
            </div>
            <div class="row form-group mb-3">
              <div class="col-lg-6">
                <label class="form-label" for="resumen"><b>Resumen *</b></label>
                <textarea class="form-control" placeholder="..." required id="resumen" name="resumen" style="height: 50px" maxlength="255"></textarea>
              </div>
              <div class="col-lg-6">
                <label class="form-label" for="tutor_in"><b>Tutor Interno *</b></label>
                <select class="form-select" name="tutor_in" id="selectFaseId">

                  <?php foreach ($profesores as $profesor) : ?>
                    <option value="<?= $profesor->codigo ?>"><?= "$profesor->cedula - $profesor->nombre $profesor->apellido" ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row form-group ">
              <div class="col-lg-6">
                <label class="form-label" for="comunidad"><b>Comunidad *</b></label>
                <input type="text" class="form-control " placeholder="..." required id="comunidad" name="comunidad" maxlength="255">
              </div>
              <div class="col-lg-6 mb-3">
                <label class="form-label" for="direccion"><b>Dirección</b></label>
                <textarea class="form-control" placeholder="..." required id="direccion" name="direccion" style="height: 50px" maxlength="255"></textarea>
              </div>
            </div>
            <div class="row form-group mb-3">
              <div class="col-lg-6">
                <label class="form-label" for="tutor_ex"><b>Nombre Completo Tutor Externo *</b></label>
                <input type="text" aria-describedby="creacionNombreTutorValidation" class="form-control mb-1" placeholder="..." id="tutor_ex" required name="tutor_ex" maxlength="255">
                <div id="creacionNombreTutorValidation" class="invalid-feedback">
                  Por favor, proporcione un nombre válido.
                </div>
              </div>
              <div class="col-lg-6">
                <label class="form-label" for="tlf_tex"><b>Telefono Tutor Externo</b></label>
                <input type="text" aria-describedby="creacionTelefonoValidation" inputmode="numeric" class="form-control mb-1" placeholder="0424XXXXXXX" id="tlf_tex" name="tlf_tex">
                <div id="creacionTelefonoValidation" class="invalid-feedback">
                  Por favor, proporcione un teléfono válido.
                </div>
              </div>
            </div>




            <div class="row form-group mb-3">

              <div class="col-lg-6">
                <label class="form-label" for="observaciones"><b>Observaciones </b></label>
                <textarea class="form-control" placeholder="..." id="observaciones" name="observaciones" style="height: 50px" maxlength="200"></textarea>
              </div>
            </div>
          </div>

          <hr class="border-light m-0">
          <div class="transferEstudiantes">

          </div>
          <hr class="border-light m-0">
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Guardar" id="submit">
            <div id="loading">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only"></span>
              </div>
            </div>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

<script>
  $(document).ready(function() {
    $('#ccNoCreado').hide()

    $('#proyectoGuardar #comunidadAutonoma').change(function() {
      if ($(this).is(':checked')) {
        $('#proyectoGuardar #seccionConsejoComunal').hide()
      } else {
        $('#proyectoGuardar #seccionConsejoComunal').show()
      }
    })

    let $municipios = $('#proyectoGuardar select[name=municipio_id]')
    let parroquias = $('#proyectoGuardar select[name=parroquia_id]')

    $municipios.change(function() {
      var $this = $(this).find(':selected'),
        rel = $this.attr('rel');


      // Hide all
      parroquias.find("option").hide();
      parroquias.find('#nigunaParroquia').show().first().prop('selected', true);

      $set = parroquias.find('option.' + rel);
      $set.show().first().prop('selected', true).trigger('change');
    })

    // select de cascada
    var $cat = $('#proyectoGuardar select[name=parroquia_id]'),
      $items = $('#proyectoGuardar select[name=consejo_comunal_id]');

    $cat.change(function() {

      var $this = $(this).find(':selected'),
        rel = $this.attr('rel');

      // Hide all
      $items.find("option").hide();
      $items.find('#ningunConsejoComunal').show().first().prop('selected', true);

      // Find all matching accessories
      // Show all the correct accesories
      // Select the first accesory
      $set = $items.find('option.' + rel);
      if ($set.show().first().length == 0) {
        // mostrar información de creación de consejo comunal
        $('#ccNoCreado').show()
      } else {
        $('#ccNoCreado').hide()

      }
      $set.show().first().prop('selected', true).trigger('change');

    });
  });
</script>