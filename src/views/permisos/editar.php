<div>
          <!-- Content -->
        <div class="container-fluid flex-grow-1 container-p-y">
          <h4 class="font-weight-bold py-3 mb-4">
              <span class="text-muted font-weight-light">Permisos/</span> Editar
          </h4>
        </div>
        <div class="card">
            <h5 class="card-header bg-primary text-white">
              Editar permisos 
            </h5>
            <div class="card-body">
              <form action="<?=$this->Route('permisos/actualizar',['idpermisos'=> $permisos->idpermisos])?>" method="POST" id="permisoseditar">
                <div class="container-fluid">               
                  <div class="row pb-2">
                    <div class="col-12">
                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label class="form-label">Usuario</label>
                                <select class="custom-select" name="idusuario" id="idusuario">
                                  <option selcted readonly value="<?= $permisos->idusuario ?>" style="display:none;"><?= $permisos->idusuario ?></option>
                                    
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <input class="form-control" type="text" name="idmodulo" id="idusuario" value="" style="display: none;">                                  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pb-2">

                    <div class="col-3">
                         <div class="row form-group">
                           <div class="col-lg-12">
                             <label class="form-label">Consultar</label>
                                <select class="custom-select" name="consultar" id="consultar">
                                  <?php if($permisos->consultar == 1) : ?>
                                    <option selected value="1" style="display:none;">Si</option>
                                  <?php else : ?>
                                    <option selected value="2" style="display:none;">No</option>
                                  <?php endif; ?>
                                  <option value="1">Si</option>
                                  <option value="2">No</option>
                                </select>
                           </div>
                       </div>          
                    </div>
                    <div class="col-3">
                         <div class="row form-group">
                           <div class="col-lg-12">
                             <label class="form-label">Crear</label>
                                <select class="custom-select" name="crear" id="crear">
                                  <?php if($permisos->crear == 1) : ?>
                                    <option selected value="1" style="display:none;">Si</option>
                                  <?php else : ?>
                                    <option selected value="2" style="display:none;">No</option>
                                  <?php endif; ?>
                                  <option value="1">Si</option>
                                  <option value="2">No</option>
                                </select>
                           </div>
                       </div>          
                    </div>
                    <div class="col-3">
                        <div class="row form-group">
                           <div class="col-lg-12">
                             <label class="form-label">Actualizar</label>
                                <select class="custom-select" name="actualizar" id="actualizar">
                                  <?php if($permisos->actualizar == 1) : ?>
                                    <option selected value="1" style="display:none;">Si</option>
                                  <?php else : ?>
                                    <option selected value="2" style="display:none;">No</option>
                                  <?php endif; ?>
                                  <option value="1">Si</option>
                                  <option value="2">No</option>
                                </select>
                           </div>
                       </div>
                    </div>
                    <div class="col-3">
                        <div class="row form-group">
                           <div class="col-lg-12">
                             <label class="form-label">Eliminar</label>
                                <select class="custom-select" name="eliminar" id="eliminar">
                                  <?php if($permisos->eliminar == 1) : ?>
                                    <option selected value="1" style="display:none;">Si</option>
                                  <?php else : ?>
                                    <option selected value="2" style="display:none;">No</option>
                                  <?php endif; ?>
                                  <option value="1">Si</option>
                                  <option value="2">No</option>
                                </select>
                           </div>
                       </div>
                    </div>

                </div>
                <hr class="border-light m-0">
                <div class="text-right mt-3">
                    <input type="submit" class="btn btn-primary" value='Guardar Configuración' />&nbsp;
                    <a href="<?= $this->Route('permisos') ?>" class="btn btn-outline-primary">Volver</a>
                </div>


                </div>   
              </form>
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
   font-size: 14px; }
</style>

