<?php

	include("connect.php"); 	


	$result=$db->executeSelect("SELECT * FROM `tempLog` ORDER BY `timeStamp` DESC");
	$avgHumidity=$db->executeSelect("SELECT AVG(`humidity`)as avgHumid from tempLog GROUP BY `timeStamp`");
	$avgTempo = $db->executeSelect("SELECT AVG(`temperature`)as avgTempo from tempLog GROUP BY `timeStamp`");
	$resData=$db->executeSelect("SELECT DISTINCT(`timeStamp`) FROM `tempLog`");
	
	$dates ='[';
	$humidities = '[';
	$tempos ='[';
	for($i=0;$i<count($resData);$i++){
	    if($i == 0){
	        $dates = $dates .  "'" .$resData[$i]['timeStamp'] ."'";
	        $humidities = $humidities .  "'" .$avgHumidity[$i]['avgHumid'] ."'";
	        $tempos = $tempos .  "'" .$avgTempo[$i]['avgTempo'] ."'";

	    }else{
            $dates = $dates .  ",'" .$resData[$i]['timeStamp'] ."'";
            $humidities = $humidities . ",'" .$avgHumidity[$i]['avgHumid'] ."'";
	        $tempos = $tempos  . ",'" .$avgTempo[$i]['avgTempo'] ."'";

	    }
	}
	$dates =  $dates . "]";
	$humidities = $humidities . ']';
	$tempos = $tempos . ']';

?>

<html>
   <head>
      <title>Sensor Data</title>
   </head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <style>
        body{
         background: #D3CCE3;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #E9E4F0, #D3CCE3);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #E9E4F0, #D3CCE3); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
        .shadow{
            box-shadow: 10px 10px 5px 0px rgba(181,169,169,0.75);
-webkit-box-shadow: 10px 10px 5px 0px rgba(181,169,169,0.75);
-moz-box-shadow: 10px 10px 5px 0px rgba(181,169,169,0.75);
background-color: white;
margin: 5px;
        }
        .innerChart{
            width: 50%;text-align: center;  margin-left:auto; margin-right: auto;
        }
    </style>
<body>
   <h1 style="text-align: center;">Temperature / moisture sensor readings</h1>
   <div class="row">
	  <div class="column temperature">
		<div class="content">
		 <div class="shadow innerChart">
            <canvas id="myChart"  ></canvas>
        </div>
    
		</div>
		<div class="column humidite">
		<div class="content">
		  <div class="shadow innerChart">
         
        <canvas id="tempChart" ></canvas>
    </div>
    
		</div>
	  </div>	  
	  </div>
        
        
    
    
    </div>
   
  
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels:  <?=$dates ?>,
        datasets: [{
            label: 'AVG humidity',
            data: <?=$humidities ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

var ctx2 = document.getElementById('tempChart').getContext('2d');
var char2 = new Chart(ctx2, {
    type: 'bar',
    data: {
        labels:  <?=$dates ?>,
        datasets: [{
            label: 'AVG Temperature',
            data: <?=$tempos ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});



</script>
</body>
</html>
