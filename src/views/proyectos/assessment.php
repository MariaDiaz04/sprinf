<style>
  input[type=number] {
    -moz-appearance: textfield;
  }
</style>
<div>
  <div class="card mb-4">
    <h4 class="card-header"><b>Baremos <?= $fase->nombre_trayecto . ' - ' . $fase->nombre_fase . ' - ' . $fase->fecha_inicio . '/' . $fase->fecha_cierre ?></b></h4>
  </div>
  <?php if (!empty($errors->danger)) : ?>

    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Atención!</strong> Han ocurrido algunos errores críticos al generar baremos:
      <ul>
        <?php foreach ($errors->danger as $error) : ?>
          <li><?= $error->message ?> ( <a href="<?= $error->action ?>" target="_blank">Gestionar</a> )</li>
        <?php endforeach; ?>

      </ul>
    </div>
  <?php endif; ?>

  <?php if (!empty($errors->warning)) : ?>

    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
      <strong>Atención!</strong> El equipo de proyecto cuenta con las siguientes caracteristicas:
      <ul>
        <?php foreach ($errors->warning as $error) : ?>
          <li><?= $error->message ?> ( <a href="<?= $error->action ?>" target="_blank">Gestionar</a> )</li>
        <?php endforeach; ?>

      </ul>
    </div>
  <?php endif; ?>

  <div class="card mb-4">
    <h5 class="card-header bg-primary text-white mb-3" style="font-weight: bold;">Información de Proyecto</h5>
    <div class="card-body">
      <h5 class="card-title"><b>Titulo:</b> <?= $infoProyecto->nombre ?></h5>
      <h6 class="card-title"><b>Comunidad:</b> <?= $infoProyecto->comunidad ?></h6>
      <p class="card-text"> <?= $infoProyecto->resumen ?></p>
    </div>
  </div>

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
                          <td><input required type="number" pattern="^[0-9]+$" class="form-control mb-1" min="0" step="0.01" max="<?= $indicador->ponderacion ?>" placeholder="..." value="<?= property_exists($indicador, 'calificacion') ? $indicador->calificacion : 0 ?>" name="indicador_grupal[<?= $indicador->id ?>]" id="indicador_grupal[<?= $indicador->id ?>]"></td>
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
                            <td>
                              <input required type="number" aria-describedby="invalidCheck3Feedback" class="form-control" min="0" step="0.01" max="<?= $indicador->ponderacion ?>" placeholder="..." value="<?= property_exists($indicador, 'calificacion') && isset($indicador->calificacion->{$integrante->id}) ? $indicador->calificacion->{$integrante->id} : 0 ?>" name="indicador_individual[<?= $integrante->id ?>][<?= $indicador->id ?>]" data-max="<?= $indicador->ponderacion ?>">
                              <div id="invalidCheck3Feedback" class="invalid-feedback">
                                Max: <?= $indicador->ponderacion ?>%
                              </div>
                            </td>
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
  $('input[type="number"]').on('keydown', function(event) {
    const keyCode = event.keyCode;
    console.log(keyCode)
    // Comprueba si el código de la tecla presionada es un número
    if (isLetterOrSpecialCharacter(keyCode)) {
      // Acepta el valor
      event.preventDefault();

    }
  })
  $('input[type="number"]').on('keyup', function() {
    const value = $(this).val();

    console.log(value)
    if (value.length > 5 || (!value && !value.endsWith('.'))) {
      // Establece el valor en el límite
      // $(this).val(value.substring(0, 5));
      console.log('no pasa')
    }

    // Comprueba si el valor coincide con la expresión regular
    if (!/^\d+(\.\d{1,2})?$/.test(value) || value < 0 || value > $(this).data('max')) {
      // Si no coincide, muestra un mensaje de error
      $(this).addClass('is-invalid')

    } else {
      // Si coincide, elimina el mensaje de error
      $(this).removeClass('is-invalid')
    }
  });
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

  function isLetterOrSpecialCharacter(keyCode) {
    // Lista de keycodes de letras
    const lettersKeyCodes = [
      65, 66, 67, 68, 69, 70, 71, 72, 73, 74, 75, 76, 77, 78, 79, 80, 81, 82, 83, 84, 85, 86,
      87, 88, 89, 90,
    ];

    // Lista de keycodes de caracteres especiales
    const specialCharactersKeyCodes = [
      160, // á
      161, // é
      162, // í
      163, // ó
      164, // ú
      209, // ñ
      91, // [
      92, // \
      93, // ]
      96, // `
    ];

    // Devuelve true si el keycode es de una letra o caracter especial
    return lettersKeyCodes.includes(keyCode) || specialCharactersKeyCodes.includes(keyCode);
  }
</script>