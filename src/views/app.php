<?php
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title><?= $_ENV['TITLE'] . ' | ' . $_ENV["NAME_APP"] ?></title>

  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge,chrome=1">
  <meta name="description" content="">

  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <!-- <link rel="icon" type="image/x-icon" href="favicon"> -->
  <!-- <script src="<?= APP_URL ?>js/jquery-3.7.1.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <!-- <script src="<?= APP_URL ?>js/jquery-4.4.0.min.js"></script> -->

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
  <link rel="stylesheet" href="<?= APP_URL ?>assets/css/jquery.transfer.css" />
  <link rel="stylesheet" type="text/css" href="assets/icon_font/css/icon_font.css" />




  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <link rel="stylesheet" href="<?= APP_URL ?>assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Page CSS -->



  <link href="https://cdn.datatables.net/v/bs4/dt-1.13.5/datatables.min.css" rel="stylesheet" />
  <!-- Helpers -->
  <script src="<?= APP_URL ?>assets/vendor/js/helpers.js"></script>

  <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
  <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
  <script src="<?= APP_URL ?>assets/js/config.js"></script>
  <link rel="stylesheet" href="<?= APP_URL ?>assets/css/sweetalert.css">

  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




  <!--   <script src="<?= APP_URL ?>assets/vendor/js/autoComplete.js"></script> -->

  <!-- JS HOME-->


</head>

<body class='font-family: "open sans", "Helvetica Neue", Helvetica, Arial, sans-serif;'>
  <div class="page-loader">
    <div class="col">
      <div class="sk-folding-cube sk-primary">
        <div class="sk-cube1 sk-cube"></div>
        <div class="sk-cube2 sk-cube"></div>
        <div class="sk-cube4 sk-cube"></div>
        <div class="sk-cube3 sk-cube"></div>
      </div>
    </div>
  </div>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?= $this->layout('menu') ?>
      <!-- Layout container -->
      <div class="layout-page">
        <?= $this->layout('navbar') ?>
        <div class="content-wrapper">
          <div class="container-fluid flex-grow-1 container-p-y">