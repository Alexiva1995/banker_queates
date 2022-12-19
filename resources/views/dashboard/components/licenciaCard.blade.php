<div class="col-sm-7 mb-2 d-flex align-items-stretch" >
    @if (isset($user_packages[0]->image))
    @if($user_packages[0]->image != null)
    <div class="card  gradient">
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
                <div class="col-sm-12">
                    <h3 class="card-title text-white">Tu licencia</h3>
                </div>
                
                    @if($user_packages[0]->image != null)
                    <div class="col-sm-6">
                        <div>
                            <div class=" d-flex justify-content-center align-items-star">
                                <img  src="{{ asset('images/licencias/Consultant.png') }}" height="200" width="220">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        {{-- Grafico  --}}
                        <div class="">
                            <div id="goal-overview-radial-bar-chart" style=""></div>
                        </div>
                    </div>
                    @endif
                @else
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4">
                            <div>
                                <div class=" d-flex justify-content-star align-items-star">
                                    <a href="{{route('market.licenses')}}">
                                    <img class="zoom" src="{{ asset('images/licencias/Consultant.png') }}" height="200" width="220">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div>
                                <div class=" d-flex justify-content-center align-items-center">
                                    <a href="{{route('market.licenses')}}">
                                    <img class="zoom" src="{{ asset('images/licencias/Golden.png') }}" height="200" width="220">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div>
                                <div class=" d-flex justify-content-end align-items-end">
                                    <a href="{{route('market.licenses')}}">
                                        <img  class="zoom" src="{{ asset('images/licencias/Banker.png') }}" height="200" width="220">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-center mt-2">
                            <a href="{{route('market.licenses')}}" class="btn btn-primary btn-lg gradient2 zoom">Comprar Licencia</a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
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
            let url = "{!! route('get.days.chart', 'replace_this') !!}";
            url = url.replace('replace_this', user_id);
            $.ajax({
                url: url,
                type: 'GET',
                datatype: 'json',
                success: (response) => {
                    let total_days = response[0];
                    let days_remaining = response[1];
                    let percentage = (total_days/365)*100 ;
                    console.log(percentage); 
                    let color_chart = "#05A5E9";
                    
                    daysChart(percentage, days_remaining, color_chart);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
  function daysChart(percentage, days_remaining, color_chart) {
    goalOverviewChartOptions = {
    chart: {
        height: 295,
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
    labels: ['Días Faltantes'],
    plotOptions: {
      radialBar: {
        offsetY: -10,
        startAngle: -150,
        endAngle: 150,
        hollow: {
          size: '70%'
        },
        track: {
          background: $strokeColor,
          strokeWidth: '50%'
        },
        dataLabels: {
            style: {
    colors: ['#F44336']
  },
                value: {
                    offsetY: -12,
                    fontSize: '40px',
                    color: '#DD0A56',
                    fontWeight: '900',
                    formatter: function(val) {
                        return parseInt(days_remaining);
                    },
                    
                },
                name: {
                    show: true,
                    offsetY: 30,
                    fontSize: '14px',
                    fontWeight: 600,
                    colors: '#DD0A56'
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
  

  

        function daysChart1(percentage, days_remaining, color_chart) {
            goalChartOptions = {
                chart: {
                    height: 280,
                    width: '100%',
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
                labels: ['Días Faltantes'],
                colors: [color_chart],
                grid: {
                    padding: {
                        bottom: 30
                    }
                },
                plotOptions: {
                    radialBar: {
                        // offsetY: 20,
                        startAngle: -150,
                        endAngle: 150,
                        hollow: {
                            size: '65%'
                        },
                        track: {
                            background: '#F2F4F5',
                            strokeWidth: '50%'
                        },
                        dataLabels: {
                            value: {
                                offsetY: -12,
                                color: '#F2F4F5',
                                fontSize: '40px',
                                fontWeight: '900',
                                formatter: function(val) {
                                    return parseInt(days_remaining);
                                }
                            },
                            name: {
                                show: true,
                                offsetY: 30,
                                fontSize: '14px',
                                fontWeight: 600,
                            },
                        }
                    }
                },
                fill: {
                    type: 'solid',
                },
                stroke: {
                    lineCap: 'round',
                },
            };

            var chart = new ApexCharts(document.querySelector("#chartDays"), goalChartOptions);
            chart.render();
        }

</script>