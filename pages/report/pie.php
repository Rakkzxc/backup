<!-- Page specific script -->
<script>
	$(function () {
		//--------------
		//- PIE CHART -
		//--------------

		<?PHP
		// Fetch data from the database
		$educationalLevels = [
			"no schooling completed",
			"elementary level",
			"elementary graduate",
			"high school level",
			"high school graduate",
			"vocational",
			"college level",
			"college graduate",
			"post graduate"
		];

		$data = [];
		foreach ($educationalLevels as $level) {
			$q = mysqli_query($con, "SELECT * from tblresident where highestEducationalAttainment = '$level'");
			$numrow = mysqli_num_rows($q);
			$data[$level] = $numrow;
		}

		// Sort the data based on values
		arsort($data);

		// Prepare the labels and values based on the sorted data
		$labels = json_encode(array_map(function ($level) {
			return ' ' . $level;
		}, array_keys($data)));
		$values = json_encode(array_values($data));

		// Set dynamic colors based on the number of educational levels
		$maxAlpha = 1.0;
		$minAlpha = 0.2;
		$step = ($maxAlpha - $minAlpha) / count($data);
		$alpha = $maxAlpha;

		$pieChartColors = [];
		foreach ($data as $value) {
			$pieChartColors[] = "rgba(255,255,0,{$alpha})";
			$alpha -= $step;
		}
		$pieChartColors = json_encode($pieChartColors);
		?>

		var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
		var pieChartColors = <?php echo $pieChartColors; ?>;


		function setChartPosition() {
			var screenWidth = window.innerWidth;

			if (screenWidth > 768) {
				var pieChartOptions = {
					maintainAspectRatio: false,
					responsive: true,
					animation: {
						animateRotate: true, // Set to true to animate the rotation
						animateScale: true, // Set to true to animate scaling the chart
						duration: 1500, // Set the animation duration in milliseconds (2 seconds in this example)
						easing: 'easeOutQuart' // Set the easing function for the animation
					},
					legend: {
						display: true,
						position: 'left',
						labels: {
							fontColor: '#d6d6d6',
							fontSize: 14
						}
					},
					tooltips: {
						enabled: true,
						bodyFontSize: 14,
						backgroundColor: 'rgba(50, 50, 50, 0.7)',
						bodyFontColor: 'white',
						titleFontColor: 'white',
					},
					layout: {
						padding: {
							left: 240,
							right: 0,
							top: 10,
							bottom: 10,
						}
					},
					plugins: {
						datalabels: {
							color: '#fff',
							anchor: 'end',
							align: 'start',
							offset: 10,
							font: {
								weight: 'bold',
								size: 12,
							},
							formatter: function (value, context) {
								return context.chart.data.labels[context.dataIndex];
							}
						}
					}
				};
			} else {
				var pieChartOptions = {
					maintainAspectRatio: false,
					responsive: true,
					animation: {
						animateRotate: true, // Set to true to animate the rotation
						animateScale: true, // Set to true to animate scaling the chart
						duration: 1500, // Set the animation duration in milliseconds (2 seconds in this example)
						easing: 'easeOutQuart' // Set the easing function for the animation
					},
					legend: {
						display: true,
						position: 'bottom',
						labels: {
							fontColor: '#fff',
							fontSize: 12
						}
					},
					tooltips: {
						enabled: true,
						bodyFontSize: 14,
						backgroundColor: 'rgba(50, 50, 50, 0.7)',
						bodyFontColor: 'white',
						titleFontColor: 'white',
					},
					layout: {
						padding: {
							left: 0,
							right: 0,
							top: 0,
							bottom: 0,
						}
					},
					plugins: {
						datalabels: {
							color: '#fff',
							anchor: 'end',
							align: 'start',
							offset: 10,
							font: {
								weight: 'bold',
								size: 12,
							},
							formatter: function (value, context) {
								return context.chart.data.labels[context.dataIndex];
							}
						}
					},
					onResize: function (chart, size) {
						// Centering the chart while having the legend on the left
						var chartArea = chart.chartArea;
						var availableWidth = size.width - chartArea.left;
						chartArea.left = chartArea.left + (availableWidth - chartArea.right) / 2;
						chartArea.right = size.width - chartArea.left;
					}
				};
			}

			new Chart(pieChartCanvas, {
				type: 'pie',
				data: {
					labels: <?php echo $labels; ?>,
					datasets: [{
						data: <?php echo $values; ?>,
						backgroundColor: pieChartColors,
						borderWidth: 0,
						borderColor: '#000000',
					}]
				},
				options: pieChartOptions
			});
		}

		setChartPosition();
		$(window).on('resize', function () {
			setChartPosition();
		});
	});
</script>