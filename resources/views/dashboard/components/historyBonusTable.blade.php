<div class="col-sm-12 col-md-6 card mt-2 " >
  <div class="row">
          {{-- Grafico  --}}
          <div class="col-sm-6">
            <div class="container">
              <div class="row">
                <div class="col-sm-12 mt-2 mb-3">
                  <h4 style="font-weight: 700;
                   color: #5E7382;">
                   Members
                  </h4>
                </div>

                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-sm-12 mb-2">
                      <h1  style="font-weight: 600;  color: #04D99D;">
                        {{$allUsers}}
                      </h1>
                    </div>

                    <div class="col-sm-12  mb-2">
                      <h5 style="color: #5E7382;">
                        Users
                      </h5>
                    </div>

                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-sm-12 mb-2">
                          <h5 style="font-weight: 600; color:#5E7382;"><i class="fa-regular fa-circle" style=" color: #05A5E9 !important;"></i>Active Members {{$activeUsers}}</h5>
                        </div>

                        <div class="col-sm-12 mb-2">
                          <h5 style="font-weight: 600; color:#5E7382;"><i class="fa-regular fa-circle" style=" color: #DD0A56 !important;"></i> Inactive Members {{$inactiveUsers}}</h5>
                        </div>
                        
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            
          </div>
          <div class="col-sm-6 ">
              <div id="chartAfiliados">

              </div>
          </div>
  </div>
</div>
<script>
  function afilliatesChart()  { 
        $.ajax({
            url : "{!! route('usersChart') !!}",
            type : 'POST',
            datatype: 'json',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: response => {
                const { activeUsers, inactiveUsers} = response;
                usersChart(activeUsers, inactiveUsers);
            },
            error: error => {
                console.log('Hubo un error');
                console.log(error);
            }
        });
    }
     function usersChart(activeUsers, inactiveUsers) {
        const options = {
            chart: {
                type: 'donut',
                width: '100%',
                height: 290
            },
            dataLabels: {
              enabled: false,
            },
            plotOptions: {
                pie: {
                    customScale: 1.1,
                    donut: {
                      size: '80%',
                      labels: {
                      show: true,
                      total:{
                        show:true,
                        showAlways:true,
                        fontSize:"3px",
                        }
                      }
                    },
                    offsetY: 70,
                    offsetX: -10,
                },
                stroke: {
                    colors: undefined
                }
            },
            colors: ['#05A5E9','#DD0A56'],
            series: [activeUsers, inactiveUsers],
            labels: ['',''],
            legend: {
                position: 'bottom',
                offsetY: 100
            }
        }
        
        var chart = new ApexCharts(document.querySelector("#chartAfiliados"), options);
        chart.render();
        }


        
</script>