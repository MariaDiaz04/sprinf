<!DOCTYPE html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Pagina no encontrada</title>
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
</head>

<body  onload="temporizadorDeRetraso() ">

  <div>
    <!-- Main Style -->
    <link rel="stylesheet" type="text/css" href="<?= APP_URL ?>assets/css/demo.css">
    <link rel="stylesheet" type="text/css" href="<?= APP_URL ?>assets/vendor/css/bootstrap.css">
    <!-- Start Content -->
    <div class="error section-padding">
      <div class="container">
        <div class="row justify-content-center mt-5 pt-5">
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
            <div class="error-content">
              <div class="error-message">
                <h4>Usuario invalido</h4>
                <h5><span>Ooooops!</span> Lo sentimos, no encontramos tus credenciales</h5>
              </div>
              <div class="description">
                <span>Volver a intentarlo <a href="<?= $_SESSION ? APP_URL . $this->Route('home') : APP_URL . $this->Route('') ?>">Pagina principal</a></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

</body>

<script>
  let identificadorTiempoDeEspera;

  function temporizadorDeRetraso() {
    identificadorTiempoDeEspera = setTimeout(funcionConRetraso, 1500);
  }

  function funcionConRetraso() {
    window.location.href = '/'
  }
</script>

</html>