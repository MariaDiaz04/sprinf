<div id="container" style="width: 800px; height: 400px; margin: 0 auto">
    

</div>

<form method="POST" action="<?=$this->Route('grafico')?>">
                      <input type="hidden" name="rol" value="<?=$rol?>">
                       <button class="btn btn-outline-primary btn-round d-block">
                      <span class="ion ion-md-arrow-back"></span>&nbsp;  Volver 
</button></form>

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
            text: 'ubicacion'
        },
        subtitle: {
            text: 'otro texto '
        },
        plotOptions: {
            column: {
                depth: 25
            }
        },
        xAxis: {
            categories: ['Estatus'],
            labels: {
                skew3d: true,
                style: {
                    fontSize: '16px'
                }
            },
            tickInterval: 1
        },
        yAxis: {
            title: {
                text: null
            },
            tickInterval: 1
        },
        series: [{
                name: 'Activos',
                data: [<?=$ubicacion?>]
            },
            

        ]
    });
</script>