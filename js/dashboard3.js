$(function() {
  //parfum
    if ($("#doughnutChart").length) {
      var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");

      // Fetch data from PHP endpoint using AJAX
      $.ajax({
        url: "chart/paiChart.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
          var labels = response.labels;
          var data = response.data;

          var doughnutPieData = {
            datasets: [{
              data:data,
              backgroundColor: [
                "#1F3BB3",
                "#FDD0C7",
                "#52CDFF",
                "#81DADA"
              ],
              borderColor: [
                "#1F3BB3",
                "#FDD0C7",
                "#52CDFF",
                "#81DADA"
              ],
            }],
            labels: labels,
          };

          var doughnutPieOptions = {
            cutoutPercentage: 50,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,
            maintainAspectRatio: true,
            showScale: true,
            legend: false,
            legendCallback: function(chart) {
              var text = [];
              text.push('<div class="chartjs-legend"><ul class="justify-content-center">');
              var data = chart.data;
              var datasets = data.datasets;
              var labels = data.labels;
              if (datasets.length) {
                for (var i = 0; i < chart.data.datasets[0].data.length; i++) {
                    text.push('<li><span style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '">');
                    text.push('</span>');
                    if (chart.data.labels[i]) {
                      text.push(chart.data.labels[i]);
                    }
                    text.push('</li>');
                  }
              }
              text.push('</div></ul>');
              return text.join("");
            },
            layout: {
              padding: {
                left: 0,
                right: 0,
                top: 0,
                bottom: 0
              }
            },
            tooltips: {
              callbacks: {
                title: function(tooltipItem, data) {
                  return data['labels'][tooltipItem[0]['index']];
                },
                label: function(tooltipItem, data) {
                  return data['datasets'][0]['data'][tooltipItem['index']];
                }
              },
              backgroundColor: '#fff',
              titleFontSize: 14,
              titleFontColor: '#0B0F32',
              bodyFontColor: '#737F8B',
              bodyFontSize: 11,
              displayColors: false
            }
          };

          var doughnutChart = new Chart(doughnutChartCanvas, {
            type: 'doughnut',
            data: doughnutPieData,
            options: doughnutPieOptions
          });

          document.getElementById('doughnut-chart-legend').innerHTML = doughnutChart.generateLegend();
        },
        error: function(error) {
          console.log(error);
        }
      });
    }   
    
    //PAKET LAUNDRY
    if ($("#leaveReport").length) {
      var leaveReportChart = document.getElementById("leaveReport").getContext('2d');
      
      $.ajax({
        url: "chart/barChart.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
          var labels = response.labels;
          var data = response.data;
          
          var leaveReportData = {
            labels: labels,
            datasets: [{
              // label: 'Last week',
              data: data,
              backgroundColor: "#52CDFF",
              borderColor: '#52CDFF',
              borderWidth: 0,
              fill: true,
            }]
          };
      
          var leaveReportOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              yAxes: [{
                gridLines: {
                  display: true,
                  drawBorder: false,
                  color: "rgba(255,255,255,.05)",
                  zeroLineColor: "rgba(255,255,255,.05)",
                },
                ticks: {
                  beginAtZero: true,
                  autoSkip: true,
                  maxTicksLimit: 5,
                  fontSize: 10,
                  color: "#6B778C"
                }
              }],
              xAxes: [{
                barPercentage: 0.5,
                gridLines: {
                  display: false,
                  drawBorder: false,
                },
                ticks: {
                  beginAtZero: false,
                  autoSkip: true,
                  maxTicksLimit: 7,
                  fontSize: 10,
                  color: "#6B778C"
                }
              }],
            },
            legend: false,
            elements: {
              line: {
                tension: 0.4,
              }
            },
            tooltips: {
              backgroundColor: 'rgba(31, 59, 179, 1)',
            }
          };
    
          var leaveReport = new Chart(leaveReportChart, {
            type: 'bar',
            data: leaveReportData,
            options: leaveReportOptions
          });
        }
      });
    }
  

    if ($("#marketingOverview").length) {
      var marketingOverviewChart = document.getElementById("marketingOverview").getContext('2d');
    
      $.ajax({
        url: "chart/barChart-P.php",
        type: "GET",
        dataType: "json",
        success: function(response) {
          var labels = response.labels;
          var earningsData = response.earningsData;
    
          var marketingOverviewData = {
            labels: labels,
            datasets: [{
              label: 'Total pendapatan ',
              data: earningsData,
              backgroundColor: "#52CDFF",
              borderColor: ['#52CDFF'],
              borderWidth: 0,
              fill: true
            }]
          };
    
          var marketingOverviewOptions = {
            responsive: true,
            maintainAspectRatio: false,
              scales: {
                  yAxes: [{
                      gridLines: {
                          display: true,
                          drawBorder: false,
                          color:"#F0F0F0",
                          zeroLineColor: '#F0F0F0',
                      },
                      ticks: {
                        beginAtZero: true,
                        autoSkip: true,
                        maxTicksLimit: 5,
                        fontSize: 10,
                        color:"#6B778C"
                      }
                  }],
                  xAxes: [{
                    stacked: true,
                    barPercentage: 0.35,
                    gridLines: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                      beginAtZero: false,
                      autoSkip: true,
                      maxTicksLimit: 12,
                      fontSize: 10,
                      color:"#6B778C"
                    }
                }],
              },
              legend:false,
              legendCallback: function (chart) {
                var text = [];
                text.push('<div class="chartjs-legend"><ul>');
                for (var i = 0; i < chart.data.datasets.length; i++) {
                  console.log(chart.data.datasets[i]); // see what's inside the obj.
                  text.push('<li class="text-muted text-small">');
                  text.push('<span style="background-color:' + chart.data.datasets[i].borderColor + '">' + '</span>');
                  text.push(chart.data.datasets[i].label);
                  text.push('</li>');
                }
                text.push('</ul></div>');
                return text.join("");
              },
              
              elements: {
                  line: {
                      tension: 0.4,
                  }
              },
              tooltips: {
                  backgroundColor: 'rgba(31, 59, 179, 1)',
              }
          }
    
          var marketingOverview = new Chart(marketingOverviewChart, {
            type: 'bar',
            data: marketingOverviewData,
            options: marketingOverviewOptions
          });
    
          document.getElementById('marketing-overview-legend').innerHTML = marketingOverview.generateLegend();
        },
        error: function(error) {
          console.log(error);
        }
      });
    }


    
    
    
    
});

 
