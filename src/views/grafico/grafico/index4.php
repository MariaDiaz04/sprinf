
<?php
     require_once('conexion.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Compras</title>

        <style type="text/css">

        </style>
    </head>
    <body>

<script src="libreria/code/highcharts.js"></script>
<script src="libreria/code/highcharts-3d.js"></script>
<script src="libreria/code/modules/exporting.js"></script>
<script src="libreria/code/modules/export-data.js"></script>

<img src="../img/logo.png" width="200px" height="200px">

<div id="container" style="height: 400px"></div>




        <script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Fechas con mas gastos'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Monto',
        data: [
        <?php 
         $sql=mysql_query("select fecha,MONTO_T FROM COMPRA");
         while($res=mysql_fetch_array($sql))
        {
        ?>
            ['<?php echo $res['fecha']; ?>' , <?php echo $res['MONTO_T']; ?>],
        <?php
         }
        ?>
        
        ]
    }]
});
        </script>
    </body>
</html>
