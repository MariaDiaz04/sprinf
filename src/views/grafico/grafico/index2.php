<?php
     require_once('conexion.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Producto mas Vendido</title>

        <style type="text/css">
#container {
    height: 400px; 
    min-width: 310px; 
    max-width: 800px;
    margin: 0 auto;
}
        </style>
    </head>
    <body>

<script src="libreria/code/highcharts.js"></script>
<script src="libreria/code/highcharts-3d.js"></script>
<script src="libreria/code/modules/exporting.js"></script>
<script src="libreria/code/modules/export-data.js"></script>

<div id="container" style="height: 400px"></div>


        <script type="text/javascript">

Highcharts.chart('container', {
    chart: {
        type: 'column',
        options3d: {
            enabled: true,
            alpha: 10,
            beta: 25,
            depth: 70
        }
    },
    title: {
        text: 'Venta de productos'
    },
    subtitle: {
        text: 'Cantidad de productos Vendidos'
    },
    plotOptions: {
        column: {
            depth: 25
        }
    },
    xAxis: {
        categories: Highcharts.getOptions(),
        labels: {
            skew3d: true,
            style: {
                fontSize: '16px'
            }
        }
    },
    yAxis: {
        title: {
            text: null
        }
    },
    series: [{
        name: 'Cantidad:',
        data: [
        
        <?php 
         $sql=mysql_query("SELECT producto.nom_producto,detalle_venta.cant_producto FROM `detalle_venta`,`producto` WHERE producto.cod_producto=detalle_venta.cod_producto");
         while($res=mysql_fetch_array($sql))
        {
        ?>
            ['<?php echo $res['nom_producto']; ?>' , <?php echo $res['cant_producto']; ?>],
        <?php
         }
        ?>
        
        ]
    }]
});
        </script>
    </body>
</html>
