 <!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>teste</title>
	<script src="./js/chart.min.js"></script>
	<style type="text/css">
		.chartBox{
			width: 30%;
			margin-top: 5%;
		}
	</style>
</head>
<body>

<?php
include("chart.php");
?>

<center>

<div class="chartBox">
	<canvas id="myChart"></canvas>
</div>

</center>

<script>

const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
    	labels: ['Enviados', 'Abertos', 'Em aguardo', 'Resolvidos'],

    	datasets: [{
            label: 'Tickets',
            backgroundColor: ['#41b8d5', '#2f5f98', '#31356e', '#2d8bba'],
            borderColor: 'rgba(255, 255, 255, 0)',
            data: [all, aberto, emaguardo, resolvido],
            borderRadius: 5,
        }]
    },
    options: {
    	plugins: {
    		legend: {
    			display: false,
    		}
    	},
		scales: {
			x: {
				grid: {
					display: false,
				}
			},
			y: {
				grid: {
					display: false,
				},
				ticks: {
					display: false,
				}
			}
		}

    }
        
});


</script>
<script src="js/app.js"></script>
</body>
</html>