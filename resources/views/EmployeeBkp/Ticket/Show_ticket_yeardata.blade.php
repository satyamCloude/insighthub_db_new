
                      <div class="row">
                        <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                          <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                            <h1 class="mb-0" id="TotalTicket">{{$TotalTicket}}</h1>
                            <p class="mb-0">Total Tickets</p>
                          </div>
                          <ul class="p-0 m-0">
                            <li class="d-flex gap-3 align-items-center pb-1">
                              <div class="badge rounded bg-label-success p-1"><i class="fa-solid fa-ticket"></i></div>
                              <div>
                                <h6 class="mb-0 text-nowrap">Open</h6>
                                <small class="text-muted">{{$Open}}</small>
                              </div>
                              &nbsp;
                              <div class="badge rounded bg-label-primary p-1"><i class="fa-solid fa-ticket"></i></div>
                              <div>
                                <h6 class="mb-0 text-nowrap">InProgress</h6>
                                <small class="text-muted">{{$InProgress}}</small>
                              </div>
                            </li>
                            <li class="d-flex gap-3 align-items-center pb-1">
                              <div class="badge rounded bg-label-danger p-1"><i class="fa-solid fa-ticket"></i></div>
                              <div>
                                <h6 class="mb-0 text-nowrap">OnHold</h6>
                                <small class="text-muted">{{$OnHold}}</small>
                              </div>
                              <div class="badge rounded bg-label-info p-1"><i class="fa-solid fa-ticket"></i></div>
                              <div>
                                <h6 class="mb-0 text-nowrap">Pending</h6>
                                <small class="text-muted">{{$Pending}}</small>
                              </div>
                            </li>
                            <li class="d-flex gap-3 align-items-center pb-1">
                              <div class="badge rounded bg-label-warning p-1"><i class="fa-solid fa-ticket"></i></div>
                              <div>
                                <h6 class="mb-0 text-nowrap">Closed</h6>
                                <small class="text-muted" id="Closed">{{$Closed}}</small>
                              </div>
                              <div class="badge rounded bg-label-secondary p-1"><i class="fa-solid fa-ticket"></i></div>
                              <div>
                                <h6 class="mb-0 text-nowrap">Resolved</h6>
                                <small class="text-muted">{{$Resolved}}</small>
                              </div>
                            </li>
                          </ul>
                        </div>
                        <div class="col-12 col-sm-8 col-md-12 col-lg-8">
                          <div id="supportTracker"></div>
                        </div>
                      </div>
<script>
  $(document).ready(function() {
    var totalticket = $('#TotalTicket').html();
    var closed = $('#Closed').html();
    totalticket = parseFloat(totalticket);
    closed = parseFloat(closed);

    if (!isNaN(totalticket) && !isNaN(closed)) {

       var completedtasks = (closed / totalticket) * 100;
    var formattedCompletedTasks = completedtasks.toFixed(2);

      const supportTrackerEl = document.querySelector('#supportTracker');

      // ApexCharts options
      const supportTrackerOptions = {
        series: [formattedCompletedTasks], // Pass completedtasks directly to the series
        labels: ['Completed Task'],
        chart: {
          height: 360,
          type: 'radialBar'
        },
        plotOptions: {
        radialBar: {
          offsetY: 10,
          startAngle: -140,
          endAngle: 130,
          hollow: {
            size: '65%'
          },
          track: {
            background: '#f0f0f0', // Add your desired background color
            strokeWidth: '100%'
          },
          dataLabels: {
            name: {
              offsetY: -20,
              color: '#333', // Add your desired label color
              fontSize: '13px',
              fontWeight: '400',
              fontFamily: 'Public Sans'
            },
            value: {
              offsetY: 10,
              color: '#555', // Add your desired value color
              fontSize: '38px',
              fontWeight: '500',
              fontFamily: 'Public Sans'
            }
          }
        }
      },
      colors: ['#4CAF50'], // Replace with your desired color
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'dark',
          shadeIntensity: 0.5,
          gradientToColors: ['#4CAF50'], // Replace with your desired color
          inverseColors: true,
          opacityFrom: 1,
          opacityTo: 0.6,
          stops: [30, 70, 100]
        }
      },
      stroke: {
        dashArray: 10
      },
      grid: {
        padding: {
          top: -20,
          bottom: 5
        }
      },
      states: {
        hover: {
          filter: {
            type: 'none'
          }
        },
        active: {
          filter: {
            type: 'none'
          }
        }
      },
      responsive: [
        {
          breakpoint: 1025,
          options: {
            chart: {
              height: 330
            }
          }
        },
        {
          breakpoint: 769,
          options: {
            chart: {
              height: 280
            }
          }
        }
      ]
      };

      // Check if the supportTracker element exists before rendering the chart
      if (typeof supportTrackerEl !== 'undefined' && supportTrackerEl !== null) {
        const supportTracker = new ApexCharts(supportTrackerEl, supportTrackerOptions);
        supportTracker.render();
      }
    }
  });


</script>
