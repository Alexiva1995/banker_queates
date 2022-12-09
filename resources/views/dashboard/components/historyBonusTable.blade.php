<div class="col-md-6 card-d">
 <div class="row">
    <div class=" col-sm-12">
        {{-- Grafico  --}}
        <div class="">
            <div id="chartAfiliados" style=""></div>
        </div>
    </div>
 </div>
</div>
<script>
     function afilliatesChart() {
        var options = {
          series: [44, 55],
          chart: {
          type: 'donut',
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: '150%',
              color_chart : "#05A5E9"
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#chartAfiliados"), options);
        chart.render();
        }
</script>