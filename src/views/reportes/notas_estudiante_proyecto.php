<?php ob_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>Example 1</title>
</head>

<style>
  .clearfix:after {
    content: "";
    display: table;
    clear: both;
  }

  a {
    color: #5D6975;
    text-decoration: underline;
  }

  body {
    position: relative;
    width: 18cm;
    height: 29.7cm;
    margin: 0 auto;
    color: #001028;
    background: #FFFFFF;
    font-family: Arial, sans-serif;
    font-size: 12px;
  }

  header {
    padding: 10px 0;
    margin-bottom: 30px;
  }

  #logo {
    text-align: center;
    margin-bottom: 10px;
  }

  #logo img {
    width: 90px;
  }

  h1 {
    border-top: 1px solid #5D6975;
    border-bottom: 1px solid #5D6975;
    color: #5D6975;
    font-size: 2.4em;
    line-height: 1.4em;
    font-weight: normal;
    text-align: center;
    margin: 0 0 20px 0;
    background: url(dimension.png);
  }

  h2 {
    border-top: 1px solid #5D6975;
    border-bottom: 1px solid #5D6975;
    color: #5D6975;
    font-size: 1.8em;
    font-weight: normal;
    text-align: center;
    margin: 0 0 20px 0;
    background: url(dimension.png);
  }

  h3 {
    border-bottom: 1px solid #5D6975;
    color: #5D6975;
    font-size: 1.5em;
    font-weight: normal;
    text-align: center;
    margin: 0 0 20px 0;
    background: url(dimension.png);
  }

  #project {
    float: left;
  }

  #project span {
    color: #5D6975;
    text-align: right;
    width: 52px;
    margin-right: 10px;
    display: inline-block;
    font-size: 0.8em;
  }

  #company {
    float: right;
    text-align: right;
  }

  #project div,
  #company div {
    white-space: nowrap;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px;
  }

  table tr:nth-child(2n-1) td {
    background: #015ABD1F;
  }

  table th,
  table td {
    text-align: center;
  }

  table th {
    padding: 5px 20px;
    color: #5D6975;
    border-bottom: 1px solid #E0EBF7;
    font-weight: bold;
    white-space: nowrap;
    font-weight: normal;
  }

  table .service,
  table .desc {
    text-align: left;
  }

  table td {
    padding: 20px;
    text-align: right;
  }

  table#info td {
    text-align: left;
    padding: 10px;
  }

  table td.service,
  table td.desc {
    vertical-align: top;
  }

  table td.unit,
  table td.qty,
  table td.total {
    font-size: 1.2em;
  }

  table td.grand {
    border-top: 1px solid #5D6975;
    ;
  }

  #notices .notice {
    color: #5D6975;
    font-size: 1.2em;
  }

  footer {
    color: #5D6975;
    width: 100%;
    height: 30px;
    position: absolute;
    bottom: 0;
    border-top: 1px solid #C1CED9;
    padding: 8px 0;
    text-align: center;
  }
</style>

<body>
  <header class="clearfix">
    <div id="logo">
      <img src="<?= APP_URL ?>assets/img/illustrations/logoUptaeb.png">
    </div>
    <h1>Información de integrante</h1>

    <table id="info">
      <tr>
        <th><span>PROYECTO</span></th>
        <td colspan="4"><?= $integrante['proyecto_nombre'] ?></td>
      </tr>
      <tr>
        <th><span>TUTOR</span></th>
        <td><?= $proyecto['tutor_in_nombre'] ?></td>
        <td>C.I.<?= $proyecto['tutor_in_cedula'] ?></td>
        <td><a href="mailto:<?= $proyecto['tutor_in_email'] ?>"><?= $proyecto['tutor_in_email'] ?></td>
        <td>+54<?= $proyecto['tutor_in_telefono'] ?></td>
      </tr>
      <tr>
        <th><span>ESTUDIANTE</span></th>
        <td><?= $integrante['nombre'] ?> <?= $integrante['apellido'] ?></td>
        <td>C.I. <?= $integrante['cedula'] ?></td>
        <td><a href="mailto:<?= $estudiante['email'] ?>"><?= $estudiante['email'] ?></a></td>
        <td>+54<?= $estudiante['telefono'] ?></td>


      </tr>


    </table>
    <!-- <div id="project">
      <!-- <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div> -->
    <!-- <div><span>DUE DATE</span> September 17, 2015</div>
    </div> -->
    <h3>Resumen de notas de baremos</h3>
    <table id="info">
      <thead>
        <tr>
          <th>Unidad Curricular</th>
          <th>Calificación</th>
        </tr>
      </thead>


    </table>
  </header>
  <main>
    <h2>Proyecto Sociotecnologico - 10%</h2>
    <h3>Desempeño Individual</h3>
    <table>
      <thead>
        <tr>
          <th>Aspectos a evaluar</th>
          <th>Ponderación Máxima</th>
          <th>Calificación</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="service">Creating a recognizable design solution based on the company's existing visual identity</td>
          <td class="desc">1%</td>
          <td class="total">0.4</td>
        </tr>

        <tr>
          <td colspan="2" class="grand total">TOTAL (%)</td>
          <td class="grand total">$6,500.00</td>
        </tr>
      </tbody>
    </table>
    <!-- <div id="notices">
      <div>NOTICE:</div>
      <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
    </div> -->
  </main>
  <!-- <footer>
    Invoice was created on a computer and is valid without the signature and seal.
  </footer> -->

</body>

</html>
<?php $htmlFormat  = ob_get_clean(); ?>