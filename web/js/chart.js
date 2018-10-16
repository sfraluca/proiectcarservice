function createPlateChart(data) {

    var series = [];
    series.push(data.data);

    squareChart = Highcharts.chart('containerStacked', {
        colors: ['#af4c4c'],
        chart: {
            type: 'column'
        },
        title: {
            text: data.chartTitle
        },
        subtitle: {
            text: data.chartSubTitle
        },
        xAxis: {
            categories: data.categories
        },
        yAxis: {
            min: 0,
            title: {
                text: data.yAxisTitle
            }
        },

        tooltip: {
            headerFormat: data.yAxisTitle + ' by {point.x}',
            pointFormat: ': {point.y} '
        },
        plotOptions: {
            column: {
                stacking: 'normal',
                dataLabels: {
                    enabled: true,
                    color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                }
            }
        },
        series: series
    });
}


