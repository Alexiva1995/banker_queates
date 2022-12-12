<div class="col-sm-6 card">
  <div class="row">
          {{-- Grafico  --}}
          <div class="col-sm-6">

          </div>
          <div class="col-sm-6">
              <div id="chartAfiliados" style=""></div>
          </div>
  </div>
</div>
<script>
     function afilliatesChart() {
        const options = {
          height: 260,
                width: '100%',
          series: [44, 55,  ],
          labels: ['', ''],
          chart: {
          type: 'donut',
          },
          plotOptions: {
            pie:{
              size: 200,
              donut: {
                labels: {
                  show: true,
                  total:{
                    show:true,
                    showAlways:true,
                    fontSize:"5px",
                    color:"#2787AB",
                    size:'2%'
                  }
                }
              }
            }
          },
          responsive: [{
            breakpoint: 80,
            options: {
              chart: {
                height: 260,
                width: '100%',
              },
              legend: {
                position: 'center'
              }
          }
        }]
        };
        var chart = new ApexCharts(document.querySelector("#chartAfiliados"), options);
        chart.render();
        }

        function afilliatesChart1(){
          goalChartOptions = {
            chart:{
              type: 'donut',
              series: [44, 55, 13, 33],
              labels: ['Apple', 'Mango', 'Orange', 'Watermelon'],
            },
            plotOptions: {
            pie:{
              donut: {
                labels: {
                  show: true,
                  total:{
                    show:true,
                    showAlways:true,
                    fontSize:"24px",
                    color:"#2787AB",
                    size:'2%'

                  }
                }
              }
            }
          },
          legend: {
              position: 'bottom'
            }
          }
          var chart = new ApexCharts(document.querySelector("#chartAfiliados"), goalChartOptions);
        chart.render();
        }
</script>