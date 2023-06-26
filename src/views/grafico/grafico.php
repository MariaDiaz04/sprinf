
<div>
   <div>
      <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
                <div><span class="text-muted font-weight-light">Graficos </span></div>
            
           </h4>
      
     <select id="status" action="index.php" name="status" onChange="mostrar(this.value);" class="select2-demo form-control" style="width: 100%" >
                  
        <option value="procedencia">Procedencia</option>
        <option value="personal">Personal</option>
        <option value="marketing">Marketing</option>
        <option value="clientes">Clientes</option>
        <option value="inmuebles">Inmuebles</option>
        <option value="negociacion">Negociacion</option>
      </select>
</div>

<!-- //////////////////////////////////////// -->

<div id="procedencia" action="index.php" style="display: none;">
  <h6 class="card-header bg-primary text-white">Procedencia</h6>
  <div class="card-body px-0 pt-0">
  <table id="tableUser" class="table table-hover">
              <thead class=" thead">
                <tr>

                  <th>Grafica</th>           
                  <th class="text-center">Opciones</th>
                </tr>

              </thead>
            <tbody>
             
               <!-- <tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Estatus</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoZona/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr> -->
        </tbody>
         
    </table>
</div>
</div>

<!-- //////////////////////////////////////// -->

<div id="personal" action="index.php" style="display: none;">
  <h6 class="card-header bg-primary text-white">Personal</h6>
  <div class="card-body px-0 pt-0">
  <table id="tableUser" class="table table-hover">
              <thead class=" thead">
                <tr>

                  <th>Grafica</th>           
                  <th class="text-center">Opciones</th>
                </tr>

              </thead>
            <tbody>
             
               <!-- <tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Otro</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoZona/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr> -->
        </tbody>
         
    </table>
</div>
</div>


<!-- //////////////////////////////////////// -->

 <!-- //////////////////////////////////////// -->

<div id="marketing" action="index.php" style="display: none;">
  <h6 class="card-header bg-primary text-white">Marketing</h6>
  <div class="card-body px-0 pt-0">
  <table id="tableUser" class="table table-hover">
              <thead class=" thead">
                <tr>

                  <th>Grafica</th>           
                  <th class="text-center">Opciones</th>
                </tr>

              </thead>
            <tbody>
             
               <tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Estatus redes sociales</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoRrss/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr>
                <tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Estatus contenido</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoZona/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr> 
        </tbody>
         
    </table>
</div>
</div>


<!-- //////////////////////////////////////// -->

 


<!-- //////////////////////////////////////// -->

<div id="clientes" action="index.php" style="display: none;">
  <h6 class="card-header bg-primary text-white">Clientes</h6>
  <div class="card-body px-0 pt-0">
  <table id="tableUser" class="table table-hover">
              <thead class=" thead">
                <tr>

                  <th>Grafica</th>           
                  <th class="text-center">Opciones</th>
                </tr>

              </thead>
            <tbody>
             
                <!--<tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Cliente vendedor</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoZona/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr> -->
                <!--<tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Cliente comprador</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoZona/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr> -->
        </tbody>
         
    </table>
</div>
</div>


<!-- //////////////////////////////////////// -->

 


<!-- //////////////////////////////////////// -->

<div id="inmuebles" action="index.php" style="display: none;">
  <h6 class="card-header bg-primary text-white">Inmuebles</h6>
  <div class="card-body px-0 pt-0">
  <table id="tableUser" class="table table-hover">
              <thead class=" thead">
                <tr>

                  <th>Grafica</th>           
                  <th class="text-center">Opciones</th>
                </tr>

              </thead>
            <tbody>
             
                <tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Inmuebles</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoZona/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr>
                <tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Estatus activos e inactivos de la zona</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoZona/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr>
                <tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Ubicación</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoUbicacion/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr>
        </tbody>
         
    </table>
</div>
</div>


<!-- //////////////////////////////////////// -->

 


<!-- //////////////////////////////////////// -->

<div id="negociacion" action="index.php" style="display: none;">
  <h6 class="card-header bg-primary text-white">Negociacion</h6>
  <div class="card-body px-0 pt-0">
  <table id="tableUser" class="table table-hover">
              <thead class=" thead">
                <tr>

                  <th>Grafica</th>           
                  <th class="text-center">Opciones</th>
                </tr>

              </thead>
            <tbody>
             
                <!--<tr class="CUser CU<?=$objzona->idzona?>" id="i<?=$objzona->idzona?>">
                  <td>Negociaciones</td>
                 
                   <td class="text-center">
                    
                      <center>
                        <form method="POST" action="<?=$this->Route('graficoZona/mostrar')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-add"></span>&nbsp; Mostrar </button></form>
                      </center>
                       
                      
                    </td>
                </tr>-->
        </tbody>
         
    </table>
</div>
</div>


<!-- //////////////////////////////////////// -->

 




</div>
</div>
<script type="text/javascript">
function mostrar(id) {
    if (id == "procedencia") {
        $("#procedencia").show();
        $("#personal").hide();
        $("#marketing").hide();
        $("#clientes").hide();
        $("#inmuebles").hide();
        $("#negociacion").hide();
        
    }

    if (id == "personal") {
        $("#procedencia").hide();
        $("#personal").show();
        $("#marketing").hide();
        $("#clientes").hide();
        $("#inmuebles").hide();
        $("#negociacion").hide();
        
    }
    if (id == "marketing") {
        $("#procedencia").hide();
        $("#personal").hide();
        $("#marketing").show();
        $("#clientes").hide();
        $("#inmuebles").hide();
        $("#negociacion").hide();
        
    }
   if (id == "clientes") {
        $("#procedencia").hide();
        $("#personal").hide();
        $("#marketing").hide();
        $("#clientes").show();
        $("#inmuebles").hide();
        $("#negociacion").hide();
        
    }
    if (id == "inmuebles") {
        $("#procedencia").hide();
        $("#personal").hide();
        $("#marketing").hide();
        $("#clientes").hide();
        $("#inmuebles").show();
        $("#negociacion").hide();
        
    }
if (id == "negociacion") {
        $("#procedencia").hide();
        $("#personal").hide();
        $("#marketing").hide();
        $("#clientes").hide();
        $("#inmuebles").hide();
        $("#negociacion").show();
        
    }
    
}


</script>

