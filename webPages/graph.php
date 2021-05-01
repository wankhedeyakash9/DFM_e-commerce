<!DOCTYPE HTML>
<html>
<head>  
<script type="text/javascript">

<?php

        include_once "dbConection.php";
        $i=1;
        $a[$i]=0;
        while($i<=12){

                
                $q="SELECT SUM(totalprice) FROM `orders` WHERE month(orderstamp)=$i";
                $r=mysqli_query($conn,$q);
                $row[0]=0;
                $row=mysqli_fetch_row($r);
                $a[$i]=$row[0];
                $i++; 
        }

?>

window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title:{
		text: "Estimate Vs Actual Sells(2019)"
	},
	axisY: {
		title: "Amount"
	},
	legend: {
		cursor:"pointer",
		itemclick : toggleDataSeries
	},
	toolTip: {
		shared: true,
		content: toolTipFormatter
	},
	data: [{
		type: "bar",
		showInLegend: true,
		name: "Actual",
		color: "Green",
		dataPoints: [
			{ y: <?php echo $a[1]; ?>, label: "Jan" },
			{ y: <?php echo $a[2]; ?>, label: "Feb" },
			{ y: <?php echo $a[3]; ?>, label: "Mar" },
			{ y: <?php echo $a[4]; ?>, label: "Apr" },
			{ y: <?php echo $a[5]; ?>, label: "May" },
			{ y: <?php echo $a[6]; ?>, label: "Jun" },
			{ y: <?php echo $a[7]; ?>, label: "July" },
            { y: <?php echo $a[8]; ?>, label: "Aug" },
            { y: <?php echo $a[9]; ?>, label: "Sept" },
            { y: <?php echo $a[10]; ?>, label: "Oct" },
            { y: <?php echo $a[11]; ?>,label: "Nov" },
            { y: <?php echo $a[12]; ?>, label: "Dec" }
		]
	},
	{
		type: "bar",
		showInLegend: true,
		name: "Estimate",
		color: "Red",
		dataPoints: [
			{ y: 2000000, label: "Jan" },
			{ y: 2000000, label: "Feb" },
			{ y: 2000000, label: "Mar" },
			{ y: 1500000, label: "Apr " },
			{ y: 1500000, label: "May" },
			{ y: 750000, label: "Jun" },
			{ y: 750000, label: "July" },
            { y: 750000, label: "Aug" },
            { y: 750000, label: "Sept" },
            { y: 2000000, label: "Oct" },
            { y: 2000000, label: "Nov" },
            { y: 2000000, label: "Dec" }
		]
	}]
});
chart.render();

function toolTipFormatter(e) {
	var str = "";
	var total = 0 ;
	var str3;
	var str2 ;
	for (var i = 0; i < e.entries.length; i++){
		var str1 = "<span style= \"color:"+e.entries[i].dataSeries.color + "\">" + e.entries[i].dataSeries.name + "</span>: <strong>"+  e.entries[i].dataPoint.y + "</strong> <br/>" ;
		total = e.entries[i].dataPoint3.y - total;
		str = str.concat(str1);
	}
	str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
    if(total < 0){
    str3 = "<span style = \"color:Green\">Total: </span><strong>" + total + "</strong><br/>";
    }
    else{
        str3 = "<span style = \"color:Red\">Total: </span><strong>" + total + "</strong><br/>";
    }
    return (str2.concat(str)).concat(str3);
}

function toggleDataSeries(e) {
	if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else {
		e.dataSeries.visible = true;
	}
	chart.render();
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 100%; width: 50%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>