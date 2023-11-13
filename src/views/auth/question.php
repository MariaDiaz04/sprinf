<?php

 /* if (isset($_SESSION['token'])) {
    ob_start(); //this should be first line of your page
    header('location:/questions');
    ob_end_flush(); //this should be last line of your page
    exit();
}  */
?>
<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Configurar Preguntas </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/fonts/boxicons.css">

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/css/core.css" class="template-customizer-core-css">
    <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css">
    <link rel="stylesheet" href="<?= APP_URL ?>assets/css/demo.css">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css">

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/css/pages/page-auth.css">
    <!-- Helpers -->
    <script src="<?= APP_URL ?>assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= APP_URL ?>assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                <img src="<?= APP_URL ?>assets/img/illustrations/logoUptaeb.png" height="60" alt="View uptaeb" >

                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">SPRINF</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">Configura tus preguntas de seguridad?</h4>
                        <p class="mb-4">¡Si necesitas recuperar tu contraseña es importante que configures estas preguntas!</p>
                        <form id="formQuestions" class="mb-3" action="saveQuestions" method="POST">
                            <div class="mb-3">
                                <input type="hidden" class="form-control" id="usuario_id" name="usuario_id" value="<?=$usuario_id?>" />
                                <input type="hidden" class="form-control" id="pregunta_id0" name="respuestas[pregunta_id][0]" value="<?=1?>" />
                                <input type="hidden" class="form-control" id="pregunta_id1" name="respuestas[pregunta_id][1]" value="<?=2?>" />
                                <input type="hidden" class="form-control" id="pregunta_id2" name="respuestas[pregunta_id][2]" value="<?=3?>" />
                           
                            </div>
                            <div class="mb-3">
                                <label for="mascota" class="form-label">¿Cuál es el nombre de tu mascota?</label>
                                <input type="text" class="form-control" id="mascota" name="respuestas[respuesta][0]" placeholder="Mascota" autofocus />
                            </div>  <div class="mb-3">
                                <label for="estudio" class="form-label">¿Donde estudiaste?</label>
                                <input type="text" class="form-control" id="estudio" name="respuestas[respuesta][1]" placeholder="Estudiante" autofocus />
                            </div>  <div class="mb-3">
                                <label for="color" class="form-label">¿Color favorito?</label>
                                <input type="text" class="form-control" id="color" name="respuestas[respuesta][2]" placeholder="color" autofocus />
                            </div>
                            <button class="btn btn-primary d-grid w-100">Guardar respuestas</button>
                        </form>
                       <!--  <div class="text-center">
                            <a href="<?= APP_URL ?>" class="d-flex align-items-center justify-content-center">
                                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                Regresar a login
                            </a>
                        </div> -->
                    </div>
                </div>
                <!-- /Forgot Password -->
            </div>
        </div>
    </div>

    <!-- Core JS -->
    <!-- Core scripts -->
    <script src="<?= APP_URL ?>assets/vendor/libs/jquery/jquery.js"></script>
    <script src="<?= APP_URL ?>assets/vendor/libs/popper/popper.js"></script>
    <script src="<?= APP_URL ?>assets/vendor/js/bootstrap.js"></script>
    <script src="<?= APP_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="<?= APP_URL ?>assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= APP_URL ?>assets/js/main.js"></script>


    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>