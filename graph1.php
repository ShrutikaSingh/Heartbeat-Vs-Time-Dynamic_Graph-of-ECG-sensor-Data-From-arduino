<?php

$dataPoints1 = array();

$f = fopen("data1.csv", "r");
$fr = fread($f, filesize("data1.csv"));
fclose($f);
$lines = array();
$lines = explode("\n",$fr); // IMPORTANT the delimiter here just the "new line" \r\n, use what u need instead of... 

for($i=0;$i<count($lines);$i++)
{
	$cell = array();
  $cell = explode(",",$lines[$i]); // use the cell/row delimiter what u need!

  if (empty($cell[1]))
  	continue;

  //echo $cell[0] ." ". $cell[1] . "<br>";

  $voltage = array("x" => (int)$cell[0], "y" => (float)$cell[1]);
  array_push($dataPoints1, $voltage);

}

?>
<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Stats"
	},
	subtitles: [{
		text: "voltage wrt time",
		fontSize: 18
	}],
	axisY: {
		includeZero: true,
		prefix: ""
	},
	legend:{
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	toolTip: {
		shared: true
	},
	data: [
	{
		type: "line",
		name: "Voltage",
		showInLegend: "true",
		xValueType: "dateTime",
		xValueFormatString: "DD MMM YYYY",
		yValueFormatString: "#,##0.##",
		dataPoints: <?php echo json_encode($dataPoints1); ?>
	}
	]
});
 
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>
</head>
<body>
<div id="chartContainer" style="height: 450px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>
