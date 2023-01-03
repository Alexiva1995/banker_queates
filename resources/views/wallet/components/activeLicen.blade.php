<style>
    .gradient{
    background: rgb(2,0,36);
    background: linear-gradient(180deg, #03B5D5 0%, #02D6AC 100%);
}
g#SvgjsG1040 .apexcharts-text {
    fill: #FFFFFF !important;
    filter: none;
    left: 100px !important;
}
g#SvgjsG1165{
    
}
</style>
<div class="col-sm-12 " >
    @if (isset($user_packages[0]->image))
    @if($user_packages[0]->image != null)
    <div class="card  gradient" style="height: 10rem !important;">
    @else
    <div class="card py-2  gradient">
    @endif
    @else
    <div class="card py-2  gradient">
    @endif
        {{-- Sin Rango --}}
        <div class="card-body">
            <div class="row">
                
                <!-- Muestra tres rangos con su barra cuando rango es null -->
                @if (isset($user_packages[0]->image))
                    @if($user_packages[0]->image != null)
                    <div class="col-sm-6 d-flex justify-content-center align-items-star mt-2">
                        <div>
                            <h4 class="text-white">PAMM account balance</h4>
                            <h4 class="text-white">14,000 USDT</h4>
                        </div>
                        
                    </div>
                    <div class="col-sm-3">
                        {{-- Grafico  --}}
                            <div  id="goal-overview-radial-bar-chart"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class=" d-flex justify-content-end align-items-center">
                                <img  src="{{ asset('images/licencias/'.$user_packages[0]->image) }}" height="115" width="125">
                        </div>
                    </div>
                    @endif
                @else
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 d-flex justify-content-center mt-2">
                            <a href="{{route('market.licenses')}}" class="btn btn-primary btn-lg gradient2 zoom">Buy Licence</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
     window.onload = function () {
        getDaysChart();
        getDaysChart2();
     }
    
  var $barColor = '#ffff';
  var $trackBgColor = '#fff';
  var $textMutedColor = '#fff';
  var $budgetStrokeColor2 = '#fff';
  var $goalStrokeColor2 = '#51e5a8';
  var $strokeColor = '#fff';
  var $textHeadingColor = '#5e5873';
  var $earningsStrokeColor2 = '#28c76f66';
  var $earningsStrokeColor3 = '#28c76f33';
    //------------ Goal Overview Chart ------------
  //---------------------------------------------
  var $goalOverviewChart = document.querySelector('#goal-overview-radial-bar-chart');
  function getDaysChart() {
    axios.post('{{route("get.days.chartAxios")}}', {
    
  })
  .then(function (response) {
    console.log(response.data.value);
    let total_days = response.data.value.total_days;
    let days_remaining = response.data.value.daysRemaining;
    let percentage = (total_days/365)*100 ;
    let color_chart = "#05A5E9";
                    
    daysChart(percentage, days_remaining, color_chart);
  })
  .catch(function (error) {
    console.log(error);
  });
}
       
  function daysChart(percentage, days_remaining, color_chart) {

    goalOverviewChartOptions = {
    chart: {
        height: 138,
        type: 'radialBar',
        sparkline: {
        enabled: true
      },
      dropShadow: {
        enabled: false,
        blur: 3,
        left: 1,
        top: 1,
        opacity: 0.1
      }
    },
    series: [percentage],
    colors: [color_chart],
    labels: ['Remaining days'],
    plotOptions: {
      radialBar: {
        offsetY: -10,
        startAngle: -150,
        endAngle: 150,
        hollow: {
          size: '55%'
        },
        track: {
          background: $strokeColor,
          strokeWidth: '40%'
        },
        dataLabels: {
                value: {
                    offsetY: -12,
                    fontSize: '30px',
                    fontWeight: '700',
                    formatter: function(val) {
                        return parseInt(days_remaining);
                    },
                    
                },
                name: {
                    show: true,
                    offsetY: 15,
                    fontSize: '10px',
                    fontWeight: 300,
                },
         }
      }
    },
    fill: {
      type: 'gradient',
      gradient: {
        shade: 'dark',
        type: 'horizontal',
        shadeIntensity: 0.5,
        gradientToColors: [color_chart],
        inverseColors: true,
        opacityFrom: 1,
        opacityTo: 1,
        stops: [0, 100]
      }
    },
    
    stroke: {
      lineCap: 'round'
    },
    grid: {
      padding: {
        bottom: 30
      }
    }
  };
  goalOverviewChart = new ApexCharts($goalOverviewChart, goalOverviewChartOptions);
  goalOverviewChart.render();

  }
  

  

       

</script>