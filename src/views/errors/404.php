<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>404 Error</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />


  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= APP_URL ?>assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/libs/apex-charts/apex-charts.css" />
  <!-- Responsive Style -->
  <script src="<?= APP_URL ?>assets/css/sweetalert.css"></script>


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
              <div class="description">
                <span>Ir de vuelta a <a href="<?= APP_URL ?>">Pagina principal</a></span>
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
        window.location.href = "<?= APP_URL ?>"
      }
    </script>


</body>

</html>