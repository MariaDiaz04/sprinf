<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>404 Error</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="assets/vendor/css/bootstrap.css">

  <!-- Responsive Style -->
  <script src="assets/js/sweetalert2.js"></script>

  </head>
  <body onload="temporizadorDeRetraso() ">

<div>
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Start Content -->
    <div class="error section-padding">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="error-content">
              <div class="error-message my-5">
                <h2>404</h2>
                <h3><span>Ooooops!</span> Algo salio mal...</h3>
              </div>
              <form class="form-error-search">
                <input type="search" name="search" class="form-control" placeholder="Buarcar aqui">
                <button class="btn btn-common btn-search" type="button">Buscar ahora</button>
              </form>
              <div class="description">
                <span>Ir de vuelta a <a href="#">Pagina principal</a></span>
              </div>
            </div>
          </div>
        </div>      
      </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
       <!-- Core scripts -->
       <script src="assets/vendor/libs/popper/popper.js"></script>
    
       <script src="assets/vendor/js/sidenav.js"></script>
   
       <!-- Libs -->
       <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
   
       <script>
          Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Algo esta mal !',
        footer: '<a href="/pnf-inf/public/?r=home">Lo sentimos, no encontramos la pagina solicitada</a>'
      })
      let identificadorTiempoDeEspera;

      function temporizadorDeRetraso() {
        identificadorTiempoDeEspera = setTimeout(funcionConRetraso, 1500);
      }

      function funcionConRetraso() {
        window.location.href = '/pnf-inf/public/?r=home'
      }
    </script>

      
  </body>
</html>