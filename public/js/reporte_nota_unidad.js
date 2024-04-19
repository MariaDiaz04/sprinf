$(document).ready(function () {
    grafica_torta(30,70);


function grafica_torta(aprobados, reprobados){
Highcharts.chart('container', {
chart: {
  plotBackgroundColor: null,
  plotBorderWidth: null,
  plotShadow: false,
  type: 'pie'
},
title: {
  text: 'Reporte Estadistico de Estudiantes aprobados y reprobados'
},
tooltip: {
  pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
},
accessibility: {
  point: {
    valueSuffix: '%'
  }
},
plotOptions: {
  pie: {
    allowPointSelect: true,
    cursor: 'pointer',
    dataLabels: {
      enabled: true,
      format: '<b>{point.name}</b>: {point.percentage:.1f} %'
    }
  }
},
series: [{
  name: 'Estudiantes',
  colorByPoint: true,
  data: [{
    name: 'Aprobados',
    y: aprobados,
    sliced: true,
    selected: true
  }, {
    name: 'Reprobados',
    y: reprobados
  }]
}]
});
}
})

