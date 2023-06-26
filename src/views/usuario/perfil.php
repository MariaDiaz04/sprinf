<div>
    <div class="py-3">
      <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
          <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
              <div><span class="text-muted font-weight-light">Perfil </span>/ <?=$_SESSION['nombre']." ".$_SESSION['apellido']?></div>
          </h4>
    </div>
  </div>
    <div class="card mb-4 py-5">
      <div class="card-body row d-flex align-items-center">
          <img src="assets/img/fiboblanco.png" alt="" class="col-5 py-1" style="width:100px; height:350px; box-shadow: 1px 0 #0000001c;">
          <div class="col-7 py-1">
            <div class="mb-2 h4 py-1">
              <span class="">
                <strong>Nombre: </strong> 
              </span>
              <span><?= $_SESSION['nombre'].' '.$_SESSION['apellido']?></span>
            </div>
            <div class="mb-2 h4 py-1">
              <span class="">
                <strong>Fecha de nacimiento: </strong>
              </span>
              <span>&nbsp; <?=$this->format( $_SESSION['nacimiento']) ?></span>
            </div>
            <div class="mb-2 h4 py-1">
              <span class="">
                <strong>Cedula: </strong>
              </span>
              <span>&nbsp; <?= $_SESSION['cedula']?></span>
            </div>
            <div class="mb-4 h4 py-1">
              <span class="">
                <strong>Teléfono: </strong>
              </span>
              <span>&nbsp; <?= $_SESSION['telefono']?></span>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>