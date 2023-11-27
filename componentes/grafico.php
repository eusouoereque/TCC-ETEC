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
			width: 70%;
			margin-right: 14%;
			box-shadow: 3px 3px 7px rgba(0, 0, 0, 0.5);
			border-radius: 1000px;
		}
	</style>
</head>
<body>

<?php
include("chartadm.php");
?>

<center>

<div class="chartBox">
	<canvas id="myChart"></canvas>
</div>

</center>

<script>

const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'pie',
    data: {
    	labels: ['Enviados', 'Resolvidos', 'Abertos', 'Em aguardo'],

    	datasets: [{
            label: 'Tickets',
            backgroundColor: ['#41b8d5', '#2d8bba', '#2f5f98', '#31356e'],
            borderColor: 'rgba(255, 255, 255, 0)',
            data: [todosadm, resolvidoadm, abertoadm, emaguardoadm]
        }]
    },
    options: {
    	plugins: {
    		legend: {
    			display: false,
    		}
    	}
    }
        
});


</script>

<script src="js/app.js"></script>
</body>
</html>