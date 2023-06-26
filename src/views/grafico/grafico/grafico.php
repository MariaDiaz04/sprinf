<div>
   <div>
      <div class="d-flex justify-content-between align-items-center w-100 font-weight-bold mb-2">
            <h4 class="d-flex justify-content-between align-items-center w-100 font-weight-bold py-3 mb-4">
                <div><span class="text-muted font-weight-light">Graficos </span></div>
                <form method="POST" action="<?=$this->Route('grafico/crear')?>">
                <input type="hidden" name="rol" value="<?=$rol?>">
               </form>
           </h4>
      </div>
    </div>

 <div class="card">
              
               
                <button class="btn btn-outline-primary  d-block">
                <span class="ion ion-md-add"></span>&nbsp; Nuevo </button>
                
</div>


