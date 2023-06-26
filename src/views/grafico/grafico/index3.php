<?php
	 require_once('conexion.php');
?>

<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ventas del dia</title>

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
        text: 'Ventas diarias'
    },
    subtitle: {
        text: 'Ventas diarias'
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
        name: 'Evaluacion de ventas:',
        data: [
		
		<?php 
		 $sql=mysql_query("select * FROM factura where fecha_v=fecha_v");
		 while($res=mysql_fetch_array($sql))
		{
		?>
            ['<?php echo $res['num_factura']; ?>' , <?php echo $res['fecha_v']; ?>],
		<?php
		 }
		?>
		
		]
    }]
});
		</script>
	</body>
</html>

