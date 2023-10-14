<div>
  <!-- Content -->
    <div class="container-fluid flex-grow-1 container-p-y">
      <h4 class="font-weight-bold py-3 mb-4">
          <span class="text-muted font-weight-light">Modulo/</span> Editar
      </h4>
    </div>
    <div class="card">
      <h5 class="card-header bg-primary text-white">
        Editar Modulo
      </h5>
      <div class="card-body">
        <form action="<?=APP_URL.$this->Route("modulos/actualizar/$modulo->id")?>" method="POST" id="moduloeditar">
          <div class="container-fluid">               
            <div class="row pb-2">
                <div class="col-12">
                  <div class="row form-group">
                    <div class="col-lg-4">
                      <label class="form-label ">Nombre</label>
                      <input type="text" class="form-control mb-1" name="nombre" value="<?=$modulo->nombre?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <hr class="border-light m-0">
          <div class="text-right mt-3">
            <button type="submit" class="btn btn-primary">Guardar Registro</button>&nbsp;   
            <a href="<?=APP_URL. $this->Route('modulos') ?>" class="btn btn-outline-primary">Volver</a>  
          </div>   
        </form>
      </div>
    </div>
  <!-- / Content -->
</div>
<?=$this->js('user/js/validate')?>

<style>
label.error {
   float: none; 
   color: red; 
   padding-left: .5em; 
   vertical-align: middle; 
   font-size: 14px; }
</style>