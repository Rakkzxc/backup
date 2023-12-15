<script>
  $(function () {
    //--------------
    //- BAR CHART -
    //--------------

    <?php
    $ages = [];
    $residents = [];
    $start = 0;
    while ($start != 100) {
      $qry = mysqli_query($con, "SELECT * from tblresident where age = '$start'");
      $cnt = mysqli_num_rows($qry);
      array_push($ages, $start);
      array_push($residents, $cnt);
      $start = $start + 1;
    }
    ?>

    var barChartCanvas = $('#barChart').get(0).getContext('2d');
    var barGradient = barChartCanvas.createLinearGradient(0, 0, 0, 250); // Gradient for the area fill
    barGradient.addColorStop(0, 'rgba(54, 255, 154, 1)');
    barGradient.addColorStop(1, 'rgba(54, 255, 154, 0.3)');

    var barChartData = {
      labels: <?php echo json_encode($ages) ?>,
      datasets: [
        {
          label: 'Total Residents with this Age',
          backgroundColor: barGradient,
          borderColor: 'rgba(0, 195, 255)',
          borderWidth: 0,
          data: <?php echo json_encode($residents) ?>
        }
      ]
    };

    var barChart;

    function createChart() {
      if (barChart) {
        barChart.destroy();
      }

      // Determine if the device is a mobile or has a small screen width
      var isMobile = window.innerWidth <= 768; // Adjust the width according to your needs

      // Update x-axis settings based on device type
      var xAxisSettings = {
        gridLines: {
          display: false, // Display grid lines on larger screens
        },
        ticks: {
          fontColor: '#d6d6d6',
          autoSkip: isMobile, // Enable auto skipping for mobile devices
          maxRotation: 0,
          minRotation: 0,
          maxTicksLimit: isMobile ? 5 : 10, // Adjust the limit based on the device
          callback: function (value, index, values) {
            var step = Math.ceil(values.length / (isMobile ? 5 : 15)); // Adjust based on the number of labels
            return index % step === 0 ? value : ''; // Show labels at every 'step' interval
          }
        }
      };

      // Redefine the chart options based on the device type
      var barChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        animation: {
          duration: 1500
        },
        legend: {
          display: false
        },
        tooltips: {
          enabled: true,
          bodyFontSize: 14,
          backgroundColor: 'rgba(50, 50, 50, 0.7)',
          bodyFontColor: 'white',
          titleFontColor: 'white',
          mode: 'index',
          intersect: false,
          callbacks: {
            label: function (tooltipItem, data) {
              var label = data.datasets[tooltipItem.datasetIndex].label || '';
              if (label) {
                label += ': ';
              }
              label += Math.round(tooltipItem.yLabel * 100) / 100; // Round to integer
              return label;
            }
          }
        },
        layout: {
          padding: {
            left: 10
          }
        },
        scales: {
          xAxes: [xAxisSettings],
          yAxes: [{
            gridLines: {
              display: true,
              color: '#4f4f4f' // Line color for x-axis
            },
            ticks: {
              fontColor: '#d6d6d6',
              beginAtZero: true,
              stepSize: 1,
              padding: 15
            }
          }]
        }
      };

      barChart = new Chart(barChartCanvas, {
        type: 'bar',
        data: barChartData,
        options: barChartOptions
      });
    }

    createChart(); // Create the chart initially

    // Redraw the chart on window resize for better responsiveness
    $(window).on('resize', function () {
      createChart();
    });
  });
</script>