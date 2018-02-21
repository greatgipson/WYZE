


<?php
 $clientid = "";
 //$client_name = array();
 $data1= array();
 $data2= array();

 $taskid="";
 $meter_num="";

 $StartMonth = 10;
 include('config.php');

//echo $this->session->userdata('user_id')."<br>";
//echo $this->session->userdata('user_type')."<br>";
//echo $this->session->userdata('user_name')."<br>";
//echo $this->session->userdata('session_id')."<br>";
//echo $this->session->userdata('meter_number')."<br>";
//echo $this->session->userdata('meter_id')."<br>";
$clientid = $this->session->userdata('client_id');
$meter_number = $this->session->userdata('meter_number');
$taskid = $this->session->userdata('meter_id_num');

$client_names = $this->session->userdata('client_names');
$client_name_index = $this->session->userdata('client_name_index');




    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
		$clientid = $_POST['pid'];
		$taskid  = $_POST['tid'];

		$result = explode("-", $taskid);
		if(sizeof($result)==2){
			$meter_number=$result[1];

			$session_data = array(
			                    'client_id' => $clientid,
			                    'meter_id'   => $result[0],
			                    'meter_number' => $meter_number,
			                    'meter_id_num' => $taskid
			                );
            $this->session->set_userdata($session_data);
		}else{
			//echo "--------1----------".$clientid."------------".$taskid;
		}

		//$key = array_search($clientid, $client_name_index); // $key = 2;

		//echo "key:".$key."-Client Name:".$client_names[$key];

	}else{
		// echo "--------2----------".$clientid."------------".$taskid;
	}

?>
<div class="headerbar">
    <h1> <?php

    if(strlen($clientid)>0){
    	//echo print_r($client_name);
        //echo $client_name[$clientid];
    }

 ?> </h1>

</div>


<script type="text/javascript">
function popup(){
var url = "http://localhost:8080/EGSPortal/index.php/guest/quotes/status/open";
window.open(url,'ContactUs','width=1200,height=650,toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,copyhistory=yes');
}
</script>

<?php

function truncate_number( $number, $precision) {
    // Are we negative?
    $negative = $number / abs($number);
    // Cast the number to a positive to solve rounding
    $number = abs($number);
    // Calculate precision number for dividing / multiplying
    $precision = pow(10, $precision);
    // Run the math, re-applying the negative value to ensure returns correctly negative / positive
    return floor( $number * $precision ) / $precision * $negative;
}


function numberFormatPrecision( $number, $separator = '.', $format = 2 ){

    $response = '';
    $brokenNumber = explode( $separator, $number );
    $response = $brokenNumber[0] . $separator;
    $brokenBackNumber = str_split($brokenNumber[1]);

    if( $format < count($brokenBackNumber) ){

        for( $i = 1; $i <= $format; $i++ )
            $response .= $brokenBackNumber[$i];
    }

    return $response;
}
//echo strlen($clientid)."-----------------".$taskid;
if(strlen($clientid)>0 and strlen($taskid)>0){

//print_r($meter_datas);
$int = 1;
$kW="";
$kVA ="";
$kVADemandArray ="";
$PowerFactorArray ="";
$AvgPowerFactor =0;
$TotalPowerFactor =0;

$kWdaytotal = 0.0;
$kWnighttotal = 0.0;

$last4MonthsQry = "SELECT '".date('M(Y)', strtotime("first day of -".($StartMonth+1)." month")) ."' as showmonthyear,sum(fi_meter_data.activewh/1000) as sumkWh
FROM `fi_meter_data`
WHERE `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+1)." month"))." 00:30:00')
AND ('".date('Y-m-d', strtotime("first day of -".($StartMonth)." month"))." 00:00:00') AND meternum =".$meter_number."
UNION
SELECT '".date('M(Y)', strtotime("first day of -".($StartMonth+2)." month"))."'  as showmonthyear,sum(fi_meter_data.activewh/1000) as sumkWh
FROM `fi_meter_data`
WHERE `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+2)." month"))." 00:30:00')
AND ('".date('Y-m-d', strtotime("first day of -".($StartMonth+1)." month"))." 00:00:00')  AND meternum =".$meter_number."
UNION
SELECT '".date('M(Y)', strtotime("first day of -".($StartMonth+3)." month"))."'  as showmonthyear,sum(fi_meter_data.activewh/1000) as sumkWh
FROM `fi_meter_data`
WHERE `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+3)." month"))." 00:30:00')
AND ('".date('Y-m-d', strtotime("first day of -".($StartMonth+2)." month"))." 00:00:00')  AND meternum =".$meter_number."
UNION
SELECT '".date('M(Y)', strtotime("first day of -".($StartMonth+4)." month"))."'  as showmonthyear,sum(fi_meter_data.activewh/1000) as sumkWh
FROM `fi_meter_data`
WHERE `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+4)." month"))." 00:30:00')
AND ('".date('Y-m-d', strtotime("first day of -".($StartMonth+3)." month"))." 00:00:00') AND meternum =".$meter_number;

//echo $last4MonthsQry;
$qry1 = mysql_query($last4MonthsQry);

$last4MonthsQry1 = "select * from (
(SELECT '".date('M(Y)', strtotime("first day of -".($StartMonth+1)." month"))."'  as showmonthyear,((fi_meter_data.activewh/1000)) as column1, (max(fi_meter_data.activeva)/1000) as column2, ((fi_meter_data.activevarh)/1000) as column3 FROM `fi_meter_data` WHERE `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+1)." month"))." 00:30:00')
AND ('".date('Y-m-d', strtotime("first day of -".($StartMonth)." month"))." 00:00:00') AND meternum =".$meter_number."
group by id   order by 3 desc LIMIT 1)) x
UNION ALL
select * from ((SELECT '".date('M(Y)', strtotime("first day of -".($StartMonth+2)." month"))."'  as showmonthyear,((fi_meter_data.activewh/1000)) as column1, (max(fi_meter_data.activeva)/1000) as column2, ((fi_meter_data.activevarh)/1000) as column3 FROM `fi_meter_data` WHERE `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+2)." month"))." 00:30:00')
AND ('".date('Y-m-d', strtotime("first day of -".($StartMonth+1)." month"))." 00:00:00')  AND meternum =".$meter_number."
group by id   order by 3 desc LIMIT 1))x1
UNION
select * from ((SELECT '".date('M(Y)', strtotime("first day of -".($StartMonth+3)." month"))."'  as showmonthyear,((fi_meter_data.activewh/1000)) as column1, (max(fi_meter_data.activeva)/1000) as column2, ((fi_meter_data.activevarh)/1000) as column3 FROM `fi_meter_data` WHERE `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+3)." month"))." 00:30:00')
AND ('".date('Y-m-d', strtotime("first day of -".($StartMonth+2)." month"))." 00:00:00') AND meternum =".$meter_number."
group by id  order by 3 desc LIMIT 1))x2
UNION
select * from ((SELECT '".date('M(Y)', strtotime("first day of -".($StartMonth+4)." month"))."' as showmonthyear,((fi_meter_data.activewh/1000)) as column1, (max(fi_meter_data.activeva)/1000) as column2, ((fi_meter_data.activevarh)/1000) as column3 FROM `fi_meter_data` WHERE `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+4)." month"))." 00:30:00')
AND ('".date('Y-m-d', strtotime("first day of -".($StartMonth+3)." month"))." 00:00:00') AND meternum =".$meter_number."
group by id  order by 3 desc LIMIT 1))x3";

//echo "<br>".$last4MonthsQry1;

$qry2 = mysql_query($last4MonthsQry1);

$datetime = new DateTime(date('Y-m-d', strtotime("first day of -".($StartMonth+1)." month")));
$datetime->modify('+1 day');

$QueryString1 = "select meternum, dates,
((fi_meter_data.activewh/1000)) as column1,
(fi_meter_data.activeva/1000) as column2,
(fi_meter_data.activevarh/1000) as column3
from fi_meter_data
where `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+1)." month"))." 00:30:00')
AND ('".$datetime->format('Y-m-d')." 00:00:00') and
fi_meter_data.meternum =".$meter_number;

//echo $QueryString1;
$qry = mysql_query($QueryString1);



$data = array();
while($rows = mysql_fetch_array($qry))
{
	$my_sql_date = $rows['dates'];
	$date_time = new DateTime($my_sql_date);
	$date_time->modify('-1 month');
	$year= $date_time->format('Y').PHP_EOL;
	$month= $date_time->format('m').PHP_EOL;
	$day= $date_time->format('d').PHP_EOL;
	$hour= $date_time->format('H').PHP_EOL;
	$min= $date_time->format('i').PHP_EOL;
	$sec= $date_time->format('s');

	$kVADemand =(sqrt (($rows['column1']*$rows['column1'])+($rows['column3']*$rows['column3'])))*2;
		if($rows['column1']>0 and $kVADemand>0){
			$PowerFactor =($rows['column1']*2)/$kVADemand;
		}else{
			$PowerFactor=0;
		}

		if($hour >=1 AND $hour<=6){
			$kWnighttotal = $kWnighttotal + $rows['column1'];
		}else{
			$kWdaytotal= $kWdaytotal + $rows['column1'];
		}

		if($int==1){
			$kW = "[[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".$rows['column1']."]";
			$kVA = "[[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".$rows['column2']."]";
			$kVADemandArray  = "[[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".$kVADemand."]";
			if($PowerFactor>0){
				$PowerFactorArray  = "[[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".truncate_number($PowerFactor, 3)."]";
			}
			$TotalPowerFactor = $PowerFactor;
		}else{
			$kW = $kW.",[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".$rows['column1']."]";
			$kVA = $kVA.",[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".$rows['column2']."]";
			$kVADemandArray  = $kVADemandArray.",[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".$kVADemand."]";
			if($PowerFactor>0){
				$PowerFactorArray  = $PowerFactorArray.",[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".truncate_number($PowerFactor, 3)."]";
			}
			$TotalPowerFactor += $PowerFactor;
		}
		$int++;
	}
	$kW = $kW."]";
	$kVA = $kVA."]";

	$kVADemandArray = $kVADemandArray."]";
	$PowerFactorArray = $PowerFactorArray."]";
	if($TotalPowerFactor>0){
		$AvgPowerFactor = $TotalPowerFactor/($int-1);
	}
	if($AvgPowerFactor>0){
		$AvgPowerFactor = truncate_number($AvgPowerFactor, 3);
	}

$datakWhMonth = array();
$datakWh = array();

$iCnt = 0;
while($rows1 = mysql_fetch_array($qry1))
{
	$datakWhMonth[$iCnt] = $rows1['showmonthyear'];
	$datakWh[$iCnt] = $rows1['sumkWh'];
	$iCnt++;
}

$datakVa = array();
$dataPF = array();
$alldata = array();
$alldatavalues = array();
$datakVaMonth = array();

$iCnt = 0;
while($rows2 = mysql_fetch_array($qry2))
{
		$PowerFactor=0;
		$datakVaMonth[$iCnt] = $rows2['showmonthyear'];
		$kVADemand =(sqrt (($rows2['column1']*$rows2['column1'])+($rows2['column3']*$rows2['column3'])))*2;


		if($rows2['column1']>0 and $kVADemand>0){
			$PowerFactor=($rows2['column1']*2)/$kVADemand;
		}else{
			$PowerFactor=0;
		}
			//echo "<pre>".$datakVaMonth[$iCnt]."--".$kVADemand."--".$PowerFactor."</pre>";

		$datakVa[$iCnt] = $rows2['column2'];
		$dataPF[$iCnt] = $PowerFactor;
$iCnt++;

}

?>

<?php

$graph10 =
		"<script type=\"text/javascript\">
$(function () {
    $('#container10').egscharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Last 4 Monthly kWh'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [";

            $max = sizeof($datakWhMonth);
			for($i = 0; $i < $max;$i++)
			{
				if($i == ($max-1)){
					$graph10 = $graph10."'".$datakWhMonth[$i]."'";
				}else{
					$graph10 = $graph10."'".$datakWhMonth[$i]."',";
				}
			}
            $graph10 = $graph10."],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'kWh'
            }
        },
        tooltip: {
            headerFormat: '<span style=\"font-size:10px\">{point.key}</span><table>',
            pointFormat: '<tr><td style=\"color:{series.color};padding:0\">{series.name}: </td>' +
                '<td style=\"padding:0\"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'kWh',
            data: [";
        	$max = sizeof($datakWh);
			for($i = 0; $i < $max;$i++)
			{
				if($i == ($max-1)){
					$graph10 = $graph10.$datakWh[$i];
				}else{
					$graph10 = $graph10.$datakWh[$i].",";
				}
			}
            $graph10 = $graph10."]

        }]
    });
});
		</script>";

echo $graph10;





$graph22 = "<script type=\"text/javascript\">
$(function () {
    $('#container122').egscharts({
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Maximum kVa Per Month'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (egscharts.theme && egscharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [";


            $max = sizeof($datakVaMonth);
			for($i = 0; $i < $max;$i++)
			{
				if($i == ($max-1)){
					$graph22 = $graph22."'".$datakVaMonth[$i]."'";
				}else{
					$graph22 = $graph22."'".$datakVaMonth[$i]."',";
				}
			}
            $graph22 = $graph22."],
            plotBands: [{ // visualize the weekend
                from: 4.5,
                to: 6.5,
                color: 'rgba(68, 170, 213, .2)'
            }]
        },
        yAxis: {
            title: {
                text: 'kVa'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' '
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'kVa',
            data: [";

			$max = sizeof($datakVa);
			for($i = 0; $i < $max;$i++)
			{
				if($i == ($max-1)){
					$graph22 = $graph22.$datakVa[$i];
				}else{
					$graph22 = $graph22.$datakVa[$i].",";
				}
			}
            $graph22 = $graph22."]
        }]
    });
});
		</script>";

echo $graph22;



$graph22 = "<script type=\"text/javascript\">
$(function () {
    $('#container123').egscharts({
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Maximum PF Per Month'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (egscharts.theme && egscharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [";


            $max = sizeof($datakVaMonth);
			for($i = 0; $i < $max;$i++)
			{
				if($i == ($max-1)){
					$graph22 = $graph22."'".$datakVaMonth[$i]."'";
				}else{
					$graph22 = $graph22."'".$datakVaMonth[$i]."',";
				}
			}
            $graph22 = $graph22."],
            plotBands: [{ // visualize the weekend
                from: 4.5,
                to: 6.5,
                color: 'rgba(68, 170, 213, .2)'
            }]
        },
        yAxis: {
            title: {
                text: 'PF'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' '
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
            name: 'PF',
            data: [";

			$max = sizeof($dataPF);
			for($i = 0; $i < $max;$i++)
			{
				if($i == ($max-1)){
					$graph22 = $graph22.$dataPF[$i];
				}else{
					$graph22 = $graph22.$dataPF[$i].",";
				}
			}
            $graph22 = $graph22."]

        }]
    });
});
		</script>";

echo $graph22;

?>

<?php
$graph1 = "<script type=\"text/javascript\">$(function () { $('#powerfactor4weeks1').egscharts({ chart: { type: 'spline' }, title: { text: 'Daily Energy Consumption (Yesterday\'s Data)'}, subtitle: { text: '(kWh)' },xAxis: { type: 'datetime', dateTimeLabelFormats: { hour:'%b %e, %H:%M' }, title: { text: 'Date and Time'}},yAxis: { title: { text: 'kWh and kVA' }, min: 0 }, tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%A, %b %e, %H:%M - Value}: {point.y:.2f}' },plotOptions: { spline: { marker: { enabled: true } } },
series: [{ name: \"kWh\",data: ".$kW."}
]});});</script>";
echo $graph1;
?>

<?php
$graph12 = "<script type=\"text/javascript\">$(function () { $('#powerfactor4weeks2').egscharts({ chart: { type: 'spline' }, title: { text: ''}, subtitle: { text: '(kWh)' },xAxis: { type: 'datetime', dateTimeLabelFormats: { hour:'%b %e, %H:%M' }, title: { text: 'Date and Time'}},yAxis: { title: { text: 'kWh and kVA' }, min: 0 }, tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%A, %b %e, %H:%M - Value}: {point.y:.2f}' },plotOptions: { spline: { marker: { enabled: true } } },
series: [{ name: \"kWh\",data: ".$kW."},{ name: \"kVA\",data: ".$kVA."}
]});});</script>";
echo $graph12;
?>


<?php
$graph2 = "<script type=\"text/javascript\">
$(function () {
    $(document).ready(function () {
        $('#containergraph1').egscharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Nighttime vs Daytime Consumption (kWh)'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: \"kWh\",
                colorByPoint: true,
                data: [{
                    name: \"Nighttime (Total: $kWnighttotal kWh)\",
                    y: ".$kWnighttotal."
                }, {
                    name: \"Daytime (Total: $kWdaytotal kWh)\",
                    y: ".$kWdaytotal.",
                    sliced: true,
                    selected: true
                }]
            }]
        });
    });
});

</script>";

echo $graph2;

?>

<?php
$graph3 = "<script type=\"text/javascript\">$(function () { $('#containergraph2').egscharts({ chart: { type: 'spline' }, title: { text: 'Yesterday\'s Power Factor' }, subtitle: { text: 'Test' },xAxis: { type: 'datetime', dateTimeLabelFormats: { month: '%e. %b', year: '%b' }, title: { text: '---'}},yAxis: { title: { text: ' Power factor' }, min: 0 }, tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%e. %b}: {point.y:.2f} ' },plotOptions: { spline: { marker: { enabled: true } } },
series: [ {name: \"Power Factor\",data: ".$PowerFactorArray."}
]});});</script>";
echo $graph3;
?>

<?php
$graph4 = "<script type=\"text/javascript\">
$(function () {
    $('#containergraph').egscharts({
        chart: {
            type: 'gauge',
            plotBackgroundColor: null,
            plotBackgroundImage: null,
            plotBorderWidth: 0,
            plotShadow: false
        },

        title: {
            text: 'Average Yesterday\'s Power Factor'
        },

        pane: {
            startAngle: -150,
            endAngle: 150,
            background: [{
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#FFF'],
                        [1, '#333']
                    ]
                },
                borderWidth: 0,
                outerRadius: '109%'
            }, {
                backgroundColor: {
                    linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
                    stops: [
                        [0, '#333'],
                        [1, '#FFF']
                    ]
                },
                borderWidth: 1,
                outerRadius: '107%'
            }, {
                // default background
            }, {
                backgroundColor: '#DDD',
                borderWidth: 0,
                outerRadius: '105%',
                innerRadius: '103%'
            }]
        },

        // the value axis
        yAxis: {
            min: 0,
            max: 1.4,

            minorTickInterval: 'auto',
            minorTickWidth: 1,
            minorTickLength: 10,
            minorTickPosition: 'inside',
            minorTickColor: '#666',

            tickPixelInterval: 30,
            tickWidth: 2,
            tickPosition: 'inside',
            tickLength: 10,
            tickColor: '#666',
            labels: {
                step: 1,
                rotation: 'auto'
            },
            title: {
                text: 'kVA'
            },
            plotBands: [{
                from: 1,
                to: 1.5,
                color: '#55BF3B' // green
            }, {
                from: 0.0,
                to: 0.0,
                color: '#DDDF0D' // yellow
            }, {
                from: 0,
                to: 1,
                color: '#DF5353' // red
            }]
        },

        series: [{
            name: 'Power Factor',
            data: [".$AvgPowerFactor."],
            tooltip: {
                valueSuffix: ' kVa'
            }
        }]

    },
        // Add some life
        function (chart) {

        	// point.update(0.56);

        });
});

</script>";

echo $graph4;
?>

<?php
$graph5 = "<script type=\"text/javascript\">$(function () { $('#containergraph5').egscharts({ chart: { type: 'spline' }, title: { text: '' }, subtitle: { text: 'kVA Demand' },xAxis: { type: 'datetime', dateTimeLabelFormats: { month: '%e. %b', year: '%b' }, title: { text: 'Date'}},yAxis: { title: { text: ' Values...' }, min: 0 }, tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%e. %b}: {point.y:.2f} ' },plotOptions: { spline: { marker: { enabled: true } } },
series: [ {name: \"kVA Demand\",data: ".$kVADemandArray."}
]});});</script>";
echo $graph5;
?>

<div class="container-fluid">
    <div class="row-fluid">
		<div class="widget">
			<div class="widget-title">
				<h5><?php echo lang('dashboard'); ?></h5>
				<form name="client_meter" method="post">
					<table  style="float:right">
					  <tr>
						<td>Client Name:</td>
						<td>
						  <select name="pid" onchange="document.getElementById('clientmeterchanged').value = '1'; document.forms['client_meter'].submit();">
							  <option value=""></option>
							  <?php
								$QueryResults = "select client_id,client_name from fi_clients where client_id in (select client_id from fi_user_clients where user_id=".$this->session->userdata('user_id').")";
								$resultProject = mysql_query($QueryResults);
								$kcnt = 0;
								while ($row=mysql_fetch_array($resultProject)) {
								  $pid = $row["client_id"];
								  $data2[$kcnt] = $row["client_id"];
								  $value = $row["client_name"];
								  $data1[$kcnt] =  $row["client_name"];
								  $isSelected = ($clientid == $pid);
								  $kcnt++;
							  ?>
								<option value="<?php print $pid; ?>" <?php if($isSelected) print "selected"; ?>><?php print $value; ?></option>
							  <?php }
									$session_data = array(
														'client_names' => $data1
												     );
									$this->session->set_userdata($session_data);
							  ?>
						  </select>
						</td>
						<?php echo  '<pre>'.'Client Names: '.print_r($data1).'</pre>'; ?>
						<td>Meters:</td>
						<td>
						  <select name="tid" onchange="document.getElementById('clientmeterchanged').value = '1'; document.forms['client_meter'].submit();">
						  <option value=""></option>
						  <?php
							$sqlTask = "select id,description,meter_number from fi_meters where client_id= $clientid;";
							$resultTask=mysql_query($sqlTask);
							while ($row=mysql_fetch_array($resultTask)) {
							  $tid=$row["id"]."-".$row["meter_number"];
							  $value=$row["description"]."(".$row["meter_number"].")";
							  $isSelected = ($taskid == $tid);
							?>
							  <option value="<?php print $tid; ?>" <?php if($isSelected) print "selected"; ?>><?php print $value; ?></option>
							<?php } ?>
						  </select>
						</td>
					  </tr>
					  </table>
					  <input type="hidden" name="clientmeterchanged" id="clientmeterchanged" value="0" />
					  <input type="hidden" name="client_name_value" id="client_name_value" value="0" />

				  </form>

<?php if(strlen($clientid)>0 and strlen($taskid)>0){ ?>
				<div style="float:right">
					<a data-toggle="modal" href="#kWh-kVA-content" class="btn"><i class="icon-eye-open"> </i>Daily Compare kW vs kVA (Yesterday's)</a>
					<a data-toggle="modal" href="#power-factor-content" class="btn"><i class="icon-eye-open"> </i>Daily Power Factor (Yesterday's)</a>
					<a data-toggle="modal" href="#avg-power-factor-content" class="btn"><i class="icon-eye-open"> </i>Daily Average Power Factor  (Yesterday's)</a>
					<a data-toggle="modal" href="#kva-demand-content" class="btn"><i class="icon-eye-open"> </i>Daily kVA Demand  (Yesterday's)</a>
				</div>
		   </div>

	<div style="width: 50%; float:left">
	   <div id="powerfactor4weeks1"></div>
	</div>

	<div style="width: 50%; float:right">
	   <div id="containergraph1"></div>
	</div>
	<br>
	<div style="width: 40%; float:left">
	   <div id="container10"></div>
	</div>

	<div style="width: 30%; float:right">

	   <div id="container122"></div>
	</div>
	<div style="width: 30%; float:right">

	   <div id="container123"></div>
	</div>

<div id="power-factor-content" class="modal hide fade in" style="display: none;width:900px;left: 30%;">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">x</a>
			<h3>Daily Power Factor (Yesterday's)</h3>
		</div>
		<div class="modal-body">
				<div id="containergraph2" style="width: 850px; height: 400px; margin: 0 auto"></div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>
	</div>

	<div id="avg-power-factor-content" class="modal hide fade in" style="display: none;width:500px;left: 50%;align=center;">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">x</a>
			<h3>Daily Average Power Factor (Yesterday's)</h3>
		</div>
		<div class="modal-body">
				<div id="containergraph" style="width: 450px; height: 400px; margin: 0 auto"></div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>
	</div>

	<div id="kva-demand-content" class="modal hide fade in" style="display: none;width:900px;left: 30%;align=center;">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">x</a>
			<h3>Daily Average Power Factor (Yesterday's)</h3>
		</div>
		<div class="modal-body">
				<div id="containergraph5" style="width: 850px; height: 400px; margin: 0 auto" ></div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>
	</div>

	<div id="kWh-kVA-content" class="modal hide fade in" style="display: none;width:900px;left: 30%;align=center;">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">x</a>
			<h3>Daily Engery Consumption Comparison kWh vs kVA (Yesterday's)</h3>
		</div>
		<div class="modal-body">
				<div id="powerfactor4weeks2" style="width: 850px; height: 400px; margin: 0 auto"></div>
		</div>
		<div class="modal-footer">
			<a href="#" class="btn" data-dismiss="modal">Close</a>
		</div>
	</div>
	</div>

  </div>
 </div>



<!--

        <?php if ($overdue_invoices) { ?>
        <div class="widget">
            <div class="widget-title">
                <h5><?php echo lang('overdue_invoices'); ?></h5>
            </div>

            <table class="table table-striped no-margin">

                <thead>
                    <tr>
                        <th><?php echo lang('invoice'); ?></th>
                        <th><?php echo lang('created'); ?></th>
                        <th><?php echo lang('due_date'); ?></th>
                        <th><?php echo lang('client_name'); ?></th>
                        <th><?php echo lang('amount'); ?></th>
                        <th><?php echo lang('balance'); ?></th>
                        <th><?php echo lang('options'); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($overdue_invoices as $invoice) { ?>
                    <tr>
                        <td><a href="<?php echo site_url('guest/invoices/view/' . $invoice->invoice_id); ?>"><?php echo $invoice->invoice_number; ?></a></td>
                        <td><?php echo date_from_mysql($invoice->invoice_date_created); ?></td>
                        <td><span class="font-overdue"><?php echo date_from_mysql($invoice->invoice_date_due); ?></span></td>
                        <td><?php echo $invoice->client_name; ?></td>
                        <td><?php echo format_currency($invoice->invoice_total); ?></td>
                        <td><?php echo format_currency($invoice->invoice_balance); ?></td>
                        <td>
                            <a href="<?php echo site_url('guest/invoices/view/' . $invoice->invoice_id); ?>" class="btn btn-small">
                                <i class="icon-eye-open"></i> <?php echo lang('view'); ?>
                            </a>

                            <a href="<?php echo site_url('guest/invoices/generate_pdf/' . $invoice->invoice_id); ?>" class="btn btn-small">
                                <i class="icon-print"></i> <?php echo lang('pdf'); ?>
                            </a>

                            <?php if ($this->mdl_settings->setting('merchant_enabled') == 1 and $invoice->invoice_balance > 0) { ?><a href="<?php echo site_url('guest/payment_handler/make_payment/' . $invoice->invoice_url_key); ?>" class="btn btn-small btn-success"><i class="icon-white icon-ok"></i> <?php echo lang('pay_now'); ?></a><?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>

        </div>
        <?php } ?>

        <div class="widget">

            <div class="widget-title">
                <h5><?php echo lang('quotes_requiring_approval'); ?></h5>
            </div>

            <?php if ($open_quotes) { ?>
            <table class="table table-striped no-margin">

                <thead>
                    <tr>
                        <th><?php echo lang('quote'); ?></th>
                        <th><?php echo lang('created'); ?></th>
                        <th><?php echo lang('due_date'); ?></th>
                        <th><?php echo lang('client_name'); ?></th>
                        <th><?php echo lang('amount'); ?></th>
                        <th><?php echo lang('options'); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($open_quotes as $quote) { ?>
                    <tr>
                        <td><a href="<?php echo site_url('guest/quotes/view/' . $quote->quote_id); ?>" title="<?php echo lang('edit'); ?>"><?php echo $quote->quote_number; ?></a></td>
                        <td><?php echo date_from_mysql($quote->quote_date_created); ?></td>
                        <td><?php echo date_from_mysql($quote->quote_date_expires); ?></td>
                        <td><?php echo $quote->client_name; ?></td>
                        <td><?php echo format_currency($quote->quote_total); ?></td>
                        <td>
                            <a href="<?php echo site_url('guest/quotes/view/' . $quote->quote_id); ?>" class="btn btn-small">
                                <i class="icon-search"></i> <?php echo lang('view'); ?>
                            </a>
                            <a href="<?php echo site_url('guest/quotes/generate_pdf/' . $quote->quote_id); ?>" class="btn btn-small">
                                <i class="icon-print"></i> <?php echo lang('pdf'); ?>
                            </a>
                            <?php if (in_array($quote->quote_status_id, array(2,3))) { ?>
                            <a href="<?php echo site_url('guest/quotes/approve/' . $quote->quote_id); ?>" class="btn btn-success"><i class="icon-white icon-check"></i> <?php echo lang('approve'); ?></a>
                            <a href="<?php echo site_url('guest/quotes/reject/' . $quote->quote_id); ?>" class="btn btn-danger"><i class="icon-white icon-ban-circle"></i> <?php echo lang('reject'); ?></a>
                            <?php } elseif ($quote->quote_status_id == 4) { ?>
                            <a href="#" class="btn btn-success"><?php echo lang('approved'); ?></a>
                            <?php } elseif ($quote->quote_status_id == 5) { ?>
                            <a href="#" class="btn btn-danger"><?php echo lang('rejected'); ?></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
            <?php } else { ?>
            <div class="padded"><?php echo lang('no_quotes_requiring_approval'); ?></div>
            <?php } ?>

        </div>

        <div class="widget">

            <div class="widget-title">
                <h5><?php echo lang('open_invoices'); ?></h5>
            </div>

            <table class="table table-striped no-margin">

                <thead>
                    <tr>
                        <th><?php echo lang('invoice'); ?></th>
                        <th><?php echo lang('created'); ?></th>
                        <th><?php echo lang('due_date'); ?></th>
                        <th><?php echo lang('client_name'); ?></th>
                        <th><?php echo lang('amount'); ?></th>
                        <th><?php echo lang('balance'); ?></th>
                        <th><?php echo lang('options'); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($open_invoices as $invoice) { ?>
                    <tr>
                        <td><a href="<?php echo site_url('guest/invoices/view/' . $invoice->invoice_id); ?>"><?php echo $invoice->invoice_number; ?></a></td>
                        <td><?php echo date_from_mysql($invoice->invoice_date_created); ?></td>
                        <td><span class="<?php if ($invoice->is_overdue) { ?>font-overdue<?php } ?>"><?php echo date_from_mysql($invoice->invoice_date_due); ?></span></td>
                        <td><?php echo $invoice->client_name; ?></td>
                        <td><?php echo format_currency($invoice->invoice_total); ?></td>
                        <td><?php echo format_currency($invoice->invoice_balance); ?></td>
                        <td>
                            <a href="<?php echo site_url('guest/invoices/view/' . $invoice->invoice_id); ?>" class="btn btn-small">
                                <i class="icon-eye-open"></i> <?php echo lang('view'); ?>
                            </a>

                            <a href="<?php echo site_url('guest/invoices/generate_pdf/' . $invoice->invoice_id); ?>" class="btn btn-small">
                                <i class="icon-print"></i> <?php echo lang('pdf'); ?>
                            </a>

                            <?php if ($this->mdl_settings->setting('merchant_enabled') == 1 and $invoice->invoice_balance > 0) { ?><a href="<?php echo site_url('guest/payment_handler/make_payment/' . $invoice->invoice_url_key); ?>" class="btn btn-small btn-success"><i class="icon-white icon-ok"></i> <?php echo lang('pay_now'); ?></a><?php } ?>
                        </td>
                    </tr>
                    <?php } ?>



                </tbody>

            </table>

        </div>


    </div>

</div>
-->

<?php } ?>