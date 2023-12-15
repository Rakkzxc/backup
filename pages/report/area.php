<!-- Page specific script -->
<script>
	$(function () {
		//--------------
		//- AREA CHART -
		//--------------

		<?php
		$puroks = [];
		$residents = [];
		$qry = mysqli_query($con, "SELECT *, COUNT(*) AS cnt FROM tblresident r GROUP BY r.purok ");
		while ($row = mysqli_fetch_array($qry)) {
			array_push($puroks, ucwords(strtolower($row['purok'])));
			array_push($residents, $row['cnt']);
		} ?>

		var areaChartCanvas = $('#areaChart').get(0).getContext('2d');
		var areaGradient = areaChartCanvas.createLinearGradient(0, 0, 0, 250);
		areaGradient.addColorStop(0, 'rgba(0,247,247,1)');
		areaGradient.addColorStop(1, 'rgba(0,247,247,0)');

		var areaChartData = {
			labels: <?php echo json_encode($puroks) ?>,
			datasets: [
				{
					label: ' Total Residents Living in this Purok',
					backgroundColor: areaGradient,
					borderColor: 'rgba(0,247,247,0.75)',
					borderWidth: 0,
					pointRadius: 5,
					pointBackgroundColor: 'rgb(255,255,255)',
					pointBorderColor: 'rgb(255,255,255)',
					pointBorderWidth: 0,
					pointHoverRadius: 7,
					pointHoverBackgroundColor: 'rgb(220,220,220)',
					pointHoverBorderColor: 'rgb(220,220,220)',
					pointHoverBorderWidth: 0,
					data: <?php echo json_encode($residents) ?>
				}
			]
		};

		var areaChartOptions = {
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
			},
			scales: {
				xAxes: [{
					gridLines: {
						display: false
					},
					ticks: {
						fontColor: '#d6d6d6'
					}
				}],
				yAxes: [{
					gridLines: {
						display: true,
						color: '#4f4f4f' // Line color for x-axis
					},
					ticks: {
						fontColor: '#d6d6d6',
						beginAtZero: true, // Start y-axis from zero
						stepSize: 1, // Specify the step size for y-axis labels
						padding: 20
					}
				}]
			}
		};

		new Chart(areaChartCanvas, {
			type: 'line',
			data: areaChartData,
			options: areaChartOptions
		});
	});
</script>