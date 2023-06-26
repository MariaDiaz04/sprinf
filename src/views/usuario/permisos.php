<div>
  <!-- Content -->
  <div class="container-fluid flex-grow-1 container-p-y">
    <h4 class="font-weight-bold py-3 mb-4">
      <span class="text-muted font-weight-light"><?= $this->ROL->find($usuario->rol_id)->fillable['nombre'] ?>/</span> Asignar Permisos
    </h4>
  </div>
  


 <div class="card">
  <h6 class="card-header bg-primary text-white">Asignar </h6>
  <div class="card-body px-0 pt-0">
  <?php if ($usuario): ?>
      <table id="tableZona" class="table table-hover">
              <thead class=" thead">
                <tr>
                  <th>#</th>
                  <th>Modulo</th>
                  <th>Ver</th>
                  <th>Crear</th>
                  <th>Actualizar</th>
                  
                  
                </tr>
              </thead>
            <tbody>
      <?php foreach ($usuario as $some): ?>
        <tr class="CUser CU<?=$some->idusuario?>" id="i<?=$objzona->idzona?>">
                  <td>
       
                  </td>

                  
                  <td>
                    
                  </td>
                  <td>
      <div class="form-check">
       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" >
        
        </div>
                  </td>
                  <td>
        <div class="form-check">
       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        
        </div>
                  </td>
                  <td>
        <div class="form-check">
       <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        
        </div>
                  </td>
                  
                 
                    
                </tr>
              <?php endforeach;?>
        </tbody>
        <?php else: ?>
          <div class="col-12 text-muted">
            <h4 class="text-center">No hay ninguna zona registrada</h4>
          </div>
        <?php endif;?>
    </table>
  </div>

  <hr class="border-light m-0">
          <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">Guardar Registro</button>&nbsp;

            <a href="<?= $this->ROL->find($usuario->rol_id)->fillable['id'] == 2 ? $this->Route('analista') : $this->Route('analista') ?>" class="btn btn-outline-primary">Volver</a>
 </div>



    
  </div>
  <!-- / Content -->
</div>

<style>
  label.error {
    float: none;
    color: red;
    padding-left: .5em;
    vertical-align: middle;
    font-size: 14px;
  }
</style>

<script>
  $(document).ready(() => {

  });
  $('#status').on('change', function() {
    if ($('#status').val() == 1) {
      $('#status').val(0);
    } else {
      $('#status').val(1);
    }
  });

  jQuery.validator.addMethod("number",
    function(value, element) {
      return /^[0-9\d=#$%@_ -]+$/.test(value);
    },
    "Debe ingresar solo números"
  );
/*   jQuery.validator.addMethod("alpha", function(value, element) {
    return /^[A-Za-zñÑ\d=#$%@_ -]+$/.test(value);
  }, "Use solo letras"); */

  jQuery.validator.addMethod("alpha", function(value, element) {
    return /^[a-z A-Z ñÑ]*$/.test(value); },"Debe ingresar solo letras");
  [a - zA - Z] * $
  $(function() {

    $("#usuarioeditar").validate({
      rules: {
        nombre: {
          minlength: 3,
          required: true,
          alpha: true,
        },
        apellido: {
          minlength: 5,
          required: true,
          alpha: true,
        },
        cedula: {
          minlength: 7,
          required: true,
        },
        email: {
          minlength: 3,
          required: true,

        },
        telefono: {
          minlength: 3,
          number: true,
          required: true,

        },
        nacimiento: {
          minlength: 3,
          required: true,
        },
        contrasena: {
          minlength: 3,
          required: true,
        },

      },
      messages: {
        nombre: {
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          required: 'Complete este campo porfavor',
        },
        apellido: {
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          required: 'Complete este campo porfavor',
        },
        cedula: {
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          required: 'Complete este campo porfavor',
        },
        email: {
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          required: 'Complete este campo porfavor',
        },
        telefono: {
          required: 'Complete este campo porfavor',
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
          number: 'Solo numeros porfavor',
        },
        nacimiento: {
          required: 'Complete este campo porfavor',
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
        },
        password: {
          required: 'Complete este campo porfavor',
          minlength: jQuery.validator.format("Necesitamos por lo menos {0} caracteres"),
        },
      }
    });
  });
</script>