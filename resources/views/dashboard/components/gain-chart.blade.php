<div class="col-sm-6 mt-2">
  <div class="card " style="width: 95%;">
    <div class="col-sm-12">
      <div class=" card-revenue-budget">
        <div class="row mx-0">
          <div class="col-md-7 col-12 revenue-report-wrapper">
            <div class="d-sm-flex justify-content-between align-items-center mb-3">
              <h4 class="card-title mb-50 mb-sm-0" style="color: #5E7382: font-weight: 700;">Ganancias</h4>
              <div class="d-flex align-items-center">
              </div>
            </div>
            <div id="revenue-report-chart"></div>
          </div>
          <div class="mt-5 col-md-5 col-12 budget-wrapper">
            <h1 class="" style="color:#02D6AC; font-weight: 700;">USD 874</h1>
            <div class="d-flex justify-content-center">
              <h5 style="color:#9892AA;">Ganancias Totales</h5>
            </div>
            <div id="budget-chart"></div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

<script>
  var $barColor = '#51e5a8';
  var $trackBgColor = '#51e5a8';
  var $textMutedColor = '#51e5a8';
  var $budgetStrokeColor2 = '#51e5a8';
  var $revenueReportChart = document.querySelector('#revenue-report-chart');
  var $budgetChart = document.querySelector('#budget-chart');

  function sesionChart(){

    revenueReportChartOptions = {
    chart: {
      height: 230,
      stacked: true,
      type: 'bar',
      toolbar: { show: false }
    },
    plotOptions: {
      bar: {
        columnWidth: '67%',
        endingShape: 'rounded'
      },
      distributed: true
    },
    colors: [window.colors.solid.primary, window.colors.solid.warning],
    series: [
      {
        name: 'Earning',
        data: [95, 177, 284, 256, 105, 63, 168, 218, 72]
      },
      
    ],
    dataLabels: {
      enabled: false
    },
    legend: {
      show: false
    },
    grid: {
      padding: {
        top: -20,
        bottom: -10
      },
      yaxis: {
        lines: { show: false }
      }
    },
    xaxis: {
      categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
      labels: {
        style: {
          colors: $textMutedColor,
          fontSize: '0.76rem'
        }
      },
      axisTicks: {
        show: false
      },
      axisBorder: {
        show: false
      }
    },
    yaxis: {
      labels: {
        style: {
          colors: $textMutedColor,
          fontSize: '0.86rem'
        }
      }
    }
  };
  revenueReportChart = new ApexCharts($revenueReportChart, revenueReportChartOptions);
  revenueReportChart.render();

  budgetChartOptions = {
    chart: {
      height: 80,
      toolbar: { show: false },
      zoom: { enabled: false },
      type: 'line',
      sparkline: { enabled: true }
    },
    stroke: {
      curve: 'smooth',
      dashArray: [0, 5],
      width: [2]
    },
    colors: [window.colors.solid.primary, $budgetStrokeColor2],
    series: [
      {
        data: []
      },
      {
        data: [20, 10, 30, 15, 23, 0, 25, 15, 20, 5, 27]
      }
    ],
    tooltip: {
      enabled: false
    }
  };
  budgetChart = new ApexCharts($budgetChart, budgetChartOptions);
  budgetChart.render();
}


</script>

