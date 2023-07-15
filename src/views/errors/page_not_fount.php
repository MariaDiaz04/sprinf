<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Pagina no encontrada</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" type="text/css" href="assets/vendor/css/bootstrap.css">

  <!-- Responsive Style -->
  <script src="assets/js/sweetalert2.js"></script>


</head>
<!-- onload="temporizadorDeRetraso() " -->
<body >

  <div>
    <!-- Start Content -->
    <div class="error section-padding">
      <div class="container py-5">
        <div class="row justify-content-center">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="error-content">
              <div class="error-message">
                <h4>Not Fount</h4>
                <h5><span>Ooooops!</span> Lo sentimos, no encontramos la pagina solicitada</h5>
              </div>
              <div class="description">
                <span>Ir de vuelta a <a href="<?= $this->Route('home') ?>">Pagina principal</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->


    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Algo esta mal !',
        footer: '<a href="?r=home">Lo sentimos, no encontramos la pagina solicitada</a>'
      })

      let identificadorTiempoDeEspera;

      function temporizadorDeRetraso() {
        identificadorTiempoDeEspera = setTimeout(funcionConRetraso, 2500);
      }

      function funcionConRetraso() {
      
        window.location.href = '?r=home'
      }
    </script>
</body>

</html>