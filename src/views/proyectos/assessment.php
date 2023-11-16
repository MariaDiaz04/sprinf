<div>
  <div>
    <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
      <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
        <div>Baremos <?= $fase->nombre_trayecto . ' - ' . $fase->nombre_fase . ' - ' . $fase->fecha_inicio . '/' . $fase->fecha_cierre ?></div>


      </h4>
    </div>
  </div>
  <!-- <?php if (is_object($errors) && property_exists($errors, 'danger')) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Atención!</strong> Han ocurrido algunos errores críticos al generar baremos:
      <ul>
        <?php foreach ($errors->danger as $error) : ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>

      </ul>
    </div>
  <?php endif; ?>

  <?php if (is_object($errors) && property_exists($errors, 'warning')) : ?>

    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
      <strong>Atención!</strong> El equipo de proyecto cuenta con las siguientes caracteristicas:
      <ul>
        <?php foreach ($errors->warning as $error) : ?>
          <li><?= $error ?></li>
        <?php endforeach; ?>

      </ul>
    </div>
  <?php endif; ?> -->

  <?php foreach ($baremos as $materia) : ?>
    <div class="card mb-3">
      <h5 class="card-header bg-primary text-white " style="font-weight: bold;"><?= $materia->nombre ?> - <?= $materia->ponderado ?>%</h5>
      <form action="<?= APP_URL . $this->Route('proyectos/editarNotaBaremos') ?>" method="post" class="editarNotaBaremos">
        <input type="hidden" name="proyecto_id" value="<?= $proyecto_id ?>">
        <div class="card-body px-3 pt-3">
          <?php if (property_exists($materia, 'grupal') && !empty($materia->grupal)) : ?>
            <?php foreach ($materia->grupal as $dimension) : ?>
              <div class="container mb-5  ">


                <div class="row">

                  <table class="table table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col"><?= $dimension->nombre ?></th>
                        <th scope="col">Ponderación</th>
                        <th scope="col" style="width:  8.33%">Calificación</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($dimension->indicadores as $indicador) : ?>

                        <tr>
                          <th scope="row"><?= $indicador->nombre ?></th>
                          <td><b><?= $indicador->ponderacion ?> %</b></td>
                          <td><input required type="number" class="form-control mb-1" min="0" step="0.01" max="<?= $indicador->ponderacion ?>" placeholder="..." value="<?= property_exists($indicador, 'calificacion') ? $indicador->calificacion : 0 ?>" name="indicador_grupal[<?= $indicador->id ?>]" id="indicador_grupal[<?= $indicador->id ?>]"></td>
                        </tr>

                      <?php endforeach; ?>
                    </tbody>
                  </table>


                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>



          <?php if (property_exists($materia, 'individual') && !empty($materia->individual)) : ?>
            <div class="my-3"></div>
            <hr>
            <div class="my-3"></div>

            <?php foreach ($materia->individual as $dimension) : ?>
              <div class="container mb-3">

                <div class="row">

                  <table class="table table-hover">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col"><?= $dimension->nombre ?></th>
                        <th scope="col">Ponderación</th>

                        <?php foreach ($integrantes as $idIntegrante => $integrante) : ?>
                          <th scope="col"><?= $integrante->nombre ?></th>
                        <?php endforeach; ?>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($dimension->indicadores as $indicador) : ?>

                        <tr>
                          <th scope="row"><?= $indicador->nombre ?></th>
                          <td><b><?= $indicador->ponderacion ?> %</b></td>


                          <?php foreach ($integrantes as $idIntegrante => $integrante) : ?>
                            <td><input required type="number" class="form-control " min="0" step="0.01" max="<?= $indicador->ponderacion ?>" placeholder="..." value="<?= property_exists($indicador, 'calificacion') && isset($indicador->calificacion->{$integrante->integrante_id}) ? $indicador->calificacion->{$integrante->integrante_id} : 0 ?>" name="indicador_individual[<?= $integrante->integrante_id ?>][<?= $indicador->id ?>]"></td>
                          <?php endforeach; ?>
                        </tr>

                      <?php endforeach; ?>
                    </tbody>
                  </table>

                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
          <div class="text-right mt-3 d-flex justify-content-end">
            <input type="submit" class="btn btn-outline-primary submit" id="" value='Editar Notas' />&nbsp;
            <div class="loading">
              <div class="spinner-border text-primary" role="status">
                <span class="sr-only"></span>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  <?php endforeach; ?>
  <div class="mt-5"></div>
  <hr class="border-light m-0">
  <?php if (is_object($errors) && property_exists($errors, 'danger')) : ?>
    <p>
      No se podrá evaluar baremos hasta que se resuelvan los conflictos críticos
    </p>
  <?php else : ?>
    <form action="<?= APP_URL . $this->Route('proyectos/evaluar') ?>" method="post" id="evaluarProyecto">
      <input type="hidden" name="proyecto_id" value="<?= $proyecto_id ?>">
      <div class="text-end mt-3">
        <input type="submit" class="btn btn-primary" value='Evaluar Fase' />&nbsp;
      </div>
    </form>

  <?php endif; ?>
</div>

<script>
  let urlEvaluar = "<?= APP_URL . $this->Route('proyectos/subir-notas') ?>";
  $(document).ready(() => {

    toggleLoading(false)

    $('#evaluarProyecto').submit(function(e) {
      e.preventDefault()

      Swal.fire({
        title: '¿Seguro que desea evaluar baremos?',
        text: 'Al evaluar baremos su nota pasara al historico por lo que no podrá ser actualizado',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Continuar'
      }).then((result) => {
        if (result.value) {
          url = $(this).attr('action');
          data = $(this).serializeArray();

          $.ajax({
            type: "POST",
            url: url,
            data: data,
            error: function(error, status) {
              Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: error.responseText,
                showConfirmButton: false,
                toast: true,
                timer: 5000
              })

            },
            success: function(data, status) {
              Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                title: 'Proyecto Evaluado',
                showConfirmButton: false,
                toast: true,
                timer: 2000
              })
              window.location.replace("<?= APP_URL . $this->Route('proyectos') ?>");
            },
          });
        }
      });

    });

    $('.editarNotaBaremos').submit(function(e) {
      e.preventDefault();

      data = $(this).serializeArray();

      toggleLoading(true, this)

      $.ajax({
        type: "POST",
        url: urlEvaluar,
        data: data,
        error: function(error, status) {
          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: error.responseText,
            showConfirmButton: false,
            toast: true,
            timer: 2000
          })
        },
        success: function(data, status) {
          toggleLoading(false)
          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: 'Actualizacion Exitosa',
            showConfirmButton: false,
            toast: true,
            timer: 2000
          })
        },
      });
    })

    function toggleLoading(show, form) {
      if (!form) {
        $('.loading').hide()
        $('.submit').show()
      } else {

        if (show) {
          $(form).find('.loading').show()
          $(form).find('.submit').hide()
        } else {
          $(form).find('.loading').hide()
          $(form).find('.submit').show()
        }
      }

    }
  });
</script>