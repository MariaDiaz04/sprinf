<div>

  <div class="col-12 col-md-12 col-lg-12 mb-4">
    <div class="row">

      <div class="col-12 ">
        <figure class="highcharts-figure">
          <div id="municipios"></div>
          <!-- <p class="highcharts-description">
            Bar chart showing horizontal columns.
          </p> -->
        </figure>
      </div>
    </div>
  </div>
</div>
<script>

  Highcharts.chart('municipios', {
    chart: {
      type: 'column'
    },
    title: {
      text: 'Proyectos por municipios',
      align: 'left'
    },
    subtitle: {
      text: 'Fuente: <a target="_blank" ' +
        'href="">Base de datos Sprinf</a>',
      align: 'left'
    },
    xAxis: {
      categories: ['Municipios'],
      crosshair: true,
      accessibility: {
        description: 'proyectos'
      }
    },
    yAxis: {
      min: 0,
      title: {
        text: ''
      }
    },
    tooltip: {
      valueSuffix: ' Cantidades'
    },
    plotOptions: {
      column: {
        pointPadding: 0.2,
        borderWidth: 0
      }
    },
    series: [
      {
        name: 'Crespo',
        data: [<?=$Crespo?>]
      },
      {
        name: 'Irribarren',
        data: [<?=$Iribarren?>]
      },
      {
        name: 'Jimenez',
        data: [<?=$Jimenez?>]
      },
      {
        name: 'Moran',
        data: [<?=$Moran?>]
      },
      {
        name: 'Palavecino',
        data: [<?=$Palavecino?>]
      }, 
       {
        name: 'Simon planas',
        data: [<?=$SimonPlanas?>]
      },
      {
        name: 'Torres',
        data: [<?=$Torres?>]
      },
      {
        name: 'Urdaneta',
        data: [<?=$Urdaneta?>]
      } 
    ]
  });
</script>