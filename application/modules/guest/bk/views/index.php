

<?php
 $clientid = "";
 //$client_name = array();
 $data1= array();
 $data2= array();

 $taskid="";
 $meter_num="";

$StartMonth = -1;
$currentday = -12; //-1
$yesterday = -11; //0

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

		if($clientid!=$this->session->userdata('client_id')){
			$taskid  = "";

			$session_data = array(
					'client_id' => $clientid,
					'meter_id'   => "",
					'meter_number' => "",
					'meter_id_num' => ""
				);
			$this->session->set_userdata($session_data);
		}

		//echo $clientid."----->".$taskid."----->".$this->session->userdata('client_id');

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
	}else{
		// echo "--------2----------".$clientid."------------".$taskid;
	}

?>
<div class="headerbar">
    <h1> <?php
    if(strlen($clientid)>0){
        $key = array_search($clientid, $client_name_index); // $key = 2;
		echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">".$client_names[$key]."</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">".$this->session->userdata('meter_number')."</span>)";
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
    if($number>0){
		$negative = $number / abs($number);
		// Cast the number to a positive to solve rounding
		$number = abs($number);
		// Calculate precision number for dividing / multiplying
		$precision = pow(10, $precision);
		// Run the math, re-applying the negative value to ensure returns correctly negative / positive
		$outputvalue= floor( $number * $precision ) / $precision * $negative;
		 return $outputvalue;
    }else{
		return 0;
    }
}


function numberFormatPrecision( $number, $separator = '.', $format = 3 ){

$response = '';
	if($number>0){

    $brokenNumber = explode( $separator, $number );
    $response = $brokenNumber[0] . $separator;
    if(!empty($brokenNumber[1])){
		$brokenBackNumber = str_split($brokenNumber[1]);

		if( $format < count($brokenBackNumber) ){

			for( $i = 1; $i <= $format; $i++ )
				$response .= $brokenBackNumber[$i];
		}
    }
    }

    return $response;
}
//echo strlen($clientid)."-----------------".$taskid;
if(strlen($clientid)>0 and strlen($taskid)>0){

//print_r($meter_datas);
$int = 1;
$kW="";
$kWh="";
$kVA ="";
$kW_Stack="";
$kWh_Stack="";
$kVA_Stack ="";
$kW_KVA_Stack="";

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
//$qry1 = mysql_query($last4MonthsQry);

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

//$qry2 = mysql_query($last4MonthsQry1);

//$datetime = new DateTime(date('Y-m-d', strtotime("first day of -".($StartMonth+1)." month")));



$main_query = array();
$query_period = array();
$query_period_data = array();

$StartMonth_4Month=$StartMonth;
$jCnt=0;
for($m = 1;$m <= 4; $m++)
{
$from_date = strtotime("first day of -".($StartMonth_4Month+$m)." month");
$to_date =   strtotime("first day of -".($StartMonth_4Month+($m-1))." month");



$monthName = date("F", mktime(0, 0, 0, date('m',$from_date) , 10));


$query_period[$jCnt] =  $monthName."(".date('Y',$from_date).")";

//echo "<br>".date('Y-m-d',$from_date)."--->".date('Y-m-d',$to_date)."-->".$query_period[$jCnt];

$main_query[$jCnt]= "select meternum,DATE_FORMAT(dates,'%Y-%m-%d')  as meter_date_format,DATE_FORMAT(dates,'%H:%i:%s') as meter_time_format, dates,
((fi_meter_data.activewh/1000)) as column1,(fi_meter_data.activeva/1000) as column2,(fi_meter_data.activevarh/1000) as column3
FROM fi_meter_data where  meternum=".$meter_number."  and `dates` BETWEEN ('".date('Y-m-d',$from_date)." 00:30:00')
AND ('".date('Y-m-d',$to_date)." 00:00:00')  order by dates";

//echo "<pre>".$main_query[$jCnt]."</pre>";
$jCnt++;

}

$max = sizeof($main_query);
//echo "MAX---->".$max.">>>>";
$k=0;
$daily_pf_data = array();

$combokWdaytotal = "";
$combokWnighttotal = "";
$combokWkey = "";
$kcnt = 0;
$table2 = "";
for($i = 0; $i < $max;$i++)
{
	//echo "<pre>"."---->".$main_query[$i]."<----</pre>";
	$int = 1;
	$kW  = 0;
	$kWh = 0;
	$kVAh = 0;
	$kVA = 0;
	$kWnighttotal  = 0;
	$kWdaytotal = 0;
	$PowerFactor=0;
	$PowerFactor_Date="";

	$qry = mysql_query($main_query[$i]);
	$j = 0;
	while($rows = mysql_fetch_array($qry))
	{
		$my_sql_date = $rows['dates'];
		$date_time = new DateTime($my_sql_date);

		$year= trim($date_time->format('Y').PHP_EOL);
		$month= trim($date_time->format('m').PHP_EOL);
		$day= trim($date_time->format('d').PHP_EOL);
		$hour= trim($date_time->format('H').PHP_EOL);
		$min= trim($date_time->format('i').PHP_EOL);
		$sec= trim($date_time->format('s'));

			//$kVADemand =(sqrt (($rows['column1']*$rows['column1'])+($rows['column3']*$rows['column3'])))*2;

			if($rows['column1']>0){
				$PowerFactor =($rows['column1']*2)/$rows['column2'];
				if($PowerFactor>0){
					$PowerFactor  = truncate_number($PowerFactor, 3);
				}
			}else{
				$PowerFactor=0;
			}


			$hour_min = trim($date_time->format('H:i:s').PHP_EOL);
			//echo "<3333----".$hour_min."--->";
			if($hour_min== "21:30:00" OR $hour_min== "22:00:00" OR $hour_min== "22:30:00" OR $hour_min== "23:00:00"
			OR $hour_min== "23:30:00" OR $hour_min== "00:00:00" OR $hour_min== "00:30:00" OR $hour_min== "01:00:00"
			OR $hour_min== "01:30:00" OR $hour_min== "02:00:00" OR $hour_min== "02:30:00" OR $hour_min== "03:00:00"
			OR $hour_min== "03:30:00" OR $hour_min== "04:00:00" OR $hour_min== "04:30:00" OR $hour_min== "05:00:00"
			OR $hour_min== "05:30:00" OR $hour_min== "06:00:00"){
			//echo "<1111----".$hour_min."--->";
				$kWnighttotal = $kWnighttotal + ($rows['column1']);
			}else{
			//echo "<2222----".$hour_min."--->";
				$kWdaytotal= $kWdaytotal + ($rows['column1']);
			}

			$kWh = $kWh + $rows['column1'];
			$kW  = $kW + ($rows['column1']*2);
			$kVAh = $kVAh + $rows['column3'];
			$kVA = $rows['column2'];
			$PowerFactor_Date = $year.'/'.$month.'/'.$day.' '.$hour.':'.$min.':'.$sec;

			$daily_pf_data[$rows['column2']] = $PowerFactor."~".$PowerFactor_Date."~".truncate_number($kVA,3);

	}//End While


	//$table2 =  "<pre>".$query_period[$i]."---->".$daily_pf_data[max(array_keys($daily_pf_data))]."</pre>";
	if(!empty($daily_pf_data)){
		$query_period_data[$i] = numberFormatPrecision($kWh)."~".$kVAh."~".$daily_pf_data[max(array_keys($daily_pf_data))];
		$max_pf_kva = array();
		$max_pf_kva = explode( '~', $query_period_data[$i] );
	}else{
		$query_period_data[$i] = numberFormatPrecision($kWh)."~".$kVAh."~"."";
		$max_pf_kva = array();
		$max_pf_kva = explode( '~', $query_period_data[$i] );

	}
	//echo "<pre>".$max_pf_kva[0]."--->".$max_pf_kva[1]."--->".$max_pf_kva[2]."--->".$max_pf_kva[3]."--->".$max_pf_kva[4]."</pre>";


	$daily_pf_data = array();
	//echo $table2;

}//ForLoop END




$todaydatetime = new DateTime(date('Y-m-d',strtotime("$currentday days")));
$tomorrowdatetime = new DateTime(date('Y-m-d',strtotime("$yesterday days")));


$QueryString1 = "select meternum, dates,
((fi_meter_data.activewh/1000)) as column1,
(fi_meter_data.activeva/1000) as column2,
(fi_meter_data.activevarh/1000) as column3
from fi_meter_data
where `dates` BETWEEN ('".$todaydatetime->format('Y-m-d')." 00:30:00')
AND ('".$tomorrowdatetime->format('Y-m-d')." 00:00:00') and


fi_meter_data.meternum =".$meter_number;

//where `dates` BETWEEN ('".date('Y-m-d', strtotime("first day of -".($StartMonth+1)." month"))." 00:30:00')
//AND ('".$datetime->format('Y-m-d')." 00:00:00') and

//echo $QueryString1;
$qry = mysql_query($QueryString1);

$vmonthly_data_data = array();
$vdaily_pf_data = array();

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

		$kVADemand =(sqrt (($rows['column1']*$rows['column1'])+($rows['column2']*$rows['column2'])))*2;

		if($rows['column1']>0 and $rows['column2']>0){
			$PowerFactor =($rows['column1']*2)/$rows['column2'];
		}else{
			$PowerFactor=0;
		}

		$hour_min = trim($date_time->format('H:i:s').PHP_EOL);
		//echo "<3333----".$hour_min."--->";
		if($hour_min== "21:30:00" OR $hour_min== "22:00:00" OR $hour_min== "22:30:00" OR $hour_min== "23:00:00"
		OR $hour_min== "23:30:00" OR $hour_min== "00:00:00" OR $hour_min== "00:30:00" OR $hour_min== "01:00:00"
		OR $hour_min== "01:30:00" OR $hour_min== "02:00:00" OR $hour_min== "02:30:00" OR $hour_min== "03:00:00"
		OR $hour_min== "03:30:00" OR $hour_min== "04:00:00" OR $hour_min== "04:30:00" OR $hour_min== "05:00:00"
		OR $hour_min== "05:30:00" OR $hour_min== "06:00:00"){
		//echo "<1111----".$hour_min."--->";
			$kWnighttotal = $kWnighttotal + ($rows['column1']);
		}else{
		//echo "<2222----".$hour_min."--->";
			$kWdaytotal= $kWdaytotal + ($rows['column1']);
		}

		if($int==1){
			$kW = "[[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".($rows['column1']*2)."]";
			$kWh = "[[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".($rows['column1'])."]";
			$kVA = "[[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".($rows['column2'])."]";

			$kW_Stack=($rows['column1']*2);
			$kWh_Stack=($rows['column1']);

			$kVA_Stack =$rows['column2'];
			$kW_KVA_Stack="Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec.")";

			$kVADemandArray  = "[[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".$kVADemand."]";
			if($PowerFactor>0){
				$PowerFactorArray  = "[[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".truncate_number($PowerFactor, 3)."]";
			}
			$TotalPowerFactor = $PowerFactor;
		}else{
			$kW = $kW.",[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".($rows['column1']*2)."]";
			$kWh = $kW.",[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".($rows['column1'])."]";

			$kVA = $kVA.",[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".($rows['column2'])."]";

			$kW_Stack=$kW_Stack.",".($rows['column1']*2);
			$kWh_Stack=$kW_Stack.",".($rows['column1']);

			$kVA_Stack =$kVA_Stack.",".$rows['column2'];
			$kW_KVA_Stack=$kW_KVA_Stack.","."Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec.")";

			$kVADemandArray  = $kVADemandArray.",[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".$kVADemand."]";
			if($PowerFactor>0){
				$PowerFactorArray  = $PowerFactorArray.",[Date.UTC(".$year.", ".$month.", ".$day.",".$hour.",".$min.",".$sec."),".truncate_number($PowerFactor, 3)."]";
			}
			$TotalPowerFactor += $PowerFactor;
		}
		$int++;
	}
	$kW = $kW."]";
	$kWh = $kWh."]";
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
/*while($rows1 = mysql_fetch_array($qry1))
{
	$datakWhMonth[$iCnt] = $rows1['showmonthyear'];
	$datakWh[$iCnt] = ($rows1['sumkWh']);
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
		$kVADemand =(sqrt (($rows2['column1']*$rows2['column1'])+($rows2['column2']*$rows2['column2'])))*2;

		if($rows2['column1']>0 and $rows2['column2']>0){
			$PowerFactor=($rows2['column1']*2)/$rows2['column2'];
		}else{
			$PowerFactor=0;
		}
			//echo "<pre>".$datakVaMonth[$iCnt]."--".$kVADemand."--".$PowerFactor."</pre>";

		$datakVa[$iCnt] = numberFormatPrecision($rows2['column2']);
		$dataPF[$iCnt] = numberFormatPrecision($PowerFactor);
$iCnt++;

}*/

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
            text: 'Consumption (kWh)'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [";

            $max = sizeof($query_period); //datakWhMonth

			for ($i = $max-1; $i >=0 ; $i--)
			//for($i = 0; $i < $max;$i++)
			{
				if($i == 0){
					$graph10 = $graph10."'".$query_period[$i]."'";
				}else{
					$graph10 = $graph10."'".$query_period[$i]."',";
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
        	$max = sizeof($query_period_data); //datakWh

			for ($i = $max-1; $i >=0 ; $i--)
			//for($i = 0; $i < $max;$i++)
			{
					$max_pf_kva = array();
					$max_pf_kva = explode( '~', $query_period_data[$i] );
					//echo "<pre>".$max_pf_kva[0]."--->".$max_pf_kva[1]."--->".$max_pf_kva[2]."--->".$max_pf_kva[3]."--->".$max_pf_kva[4]."</pre>";


				if($i == 0){
					$graph10 = $graph10.$max_pf_kva[0];
				}else{
					$graph10 = $graph10.$max_pf_kva[0].",";
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
            text: 'Demand (kVA)'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'bottom',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (egscharts.theme && egscharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [";


            $max = sizeof($query_period);
			for ($i = $max-1; $i >=0 ; $i--)
			//for($i = 0; $i < $max;$i++)
			{
				if($i == 0){
					$graph22 = $graph22."'".$query_period[$i]."'";
				}else{
					$graph22 = $graph22."'".$query_period[$i]."',";
				}
			}
            $graph22 = $graph22."],
            tickmarkPlacement: 'on',
            plotBands: [{ // visualize the weekend
                from: 4.5,
                to: 6.5,
                color: 'rgba(68, 170, 213, .2)'
            }]
        },
        yAxis: {
            title: {
                text: 'kVA'
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
            name: 'kVA',
            data: [";

			$max = sizeof($query_period_data);
			for ($i = $max-1; $i >=0 ; $i--)
			//for($i = 0; $i < $max;$i++)
			{
					$max_pf_kva = array();
					$max_pf_kva = explode( '~', $query_period_data[$i] );
					//echo "<pre>".$max_pf_kva[0]."--->".$max_pf_kva[1]."--->".$max_pf_kva[2]."--->".$max_pf_kva[3]."--->".$max_pf_kva[4]."</pre>";

			if(!empty($max_pf_kva[4])){
				if($i == 0){
					$graph22 = $graph22.$max_pf_kva[4];
				}else{
					$graph22 = $graph22.$max_pf_kva[4].",";
				}
			}else{
				if($i == 0){
					$graph22 = $graph22."";
				}else{
					$graph22 = $graph22."".",";
				}
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
            text: 'Power Factor (PF)'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'bottom',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (egscharts.theme && egscharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [";


            $max = sizeof($query_period);
			for ($i = $max-1; $i >=0 ; $i--)
			//for($i = 0; $i < $max;$i++)
			{
				if($i == 0){
					$graph22 = $graph22."'".$query_period[$i]."'";
				}else{
					$graph22 = $graph22."'".$query_period[$i]."',";
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

			$max = sizeof($query_period_data);
			for ($i = $max-1; $i >=0 ; $i--)
			//for($i = 0; $i < $max;$i++)
			{

					$max_pf_kva = array();
					$max_pf_kva = explode( '~', $query_period_data[$i] );
					//echo "<pre>".$max_pf_kva[0]."--->".$max_pf_kva[1]."--->".$max_pf_kva[2]."--->".$max_pf_kva[3]."--->".$max_pf_kva[4]."</pre>";

				if($i == 0){
					$graph22 = $graph22.$max_pf_kva[2];
				}else{
					$graph22 = $graph22.$max_pf_kva[2].",";
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
$graph1 = "<script type=\"text/javascript\">$(function () { $('#powerfactor4weeks1').egscharts({ chart: { type: 'area' }, title: { text: 'Energy Consumption'}, subtitle: { text: 'kWh' },xAxis: { type: 'datetime', dateTimeLabelFormats: { hour:'%b %e, %H:%M' }, title: { text: 'Date and Time'}},yAxis: { title: { text: 'kWh' }, min: 0 }, tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%A, %b %e, %H:%M - Value}: {point.y:.2f}' },plotOptions: { spline: { marker: { enabled: true } } },
series: [{ name: \"kWh\",data: ".$kWh."}
]});});</script>";
echo $graph1;
?>

<?php
$graph12 = "<script type=\"text/javascript\">$(function () { $('#powerfactor4weeks2').egscharts({ chart: { type: 'spline' }, title: { text: 'Energy Consumption'}, subtitle: { text: 'kW vs kVA' },xAxis: { type: 'datetime', dateTimeLabelFormats: { hour:'%b %e, %H:%M' },tickmarkPlacement: 'on', title: { text: 'Date and Time'}},yAxis: { title: { text: 'kW and kVA' }, min: 0 }, tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%b %e, %H:%M - Value}: {point.y:.2f}' },plotOptions: { area: { stacking: 'normal',  lineColor: '#666666',               lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            } },
series: [{ name: \"kW\",data: ".$kW."},{ name: \"kVA\",data: ".$kVA."}
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
                text: 'Day vs Night Consumption'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b> <br> (<b>Day:</b> 6:30 AM to 21:00 PM, <b>Night:</b> 21:30 PM to 6:00 AM)'
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
                    name: \"Day (Total: $kWdaytotal kWh)\",
                    y: ".$kWdaytotal.",
                    sliced: true,
                    selected: true
                },{
                    name: \"Night (Total: $kWnighttotal kWh)\",
                    y: ".$kWnighttotal."
                }]
            }]
        });
    });
});

</script>";

echo $graph2;

?>

<?php
$graph3 = "<script type=\"text/javascript\">$(function () { $('#containergraph2').egscharts({ chart: { type: 'area' }, title: { text: 'Power Factor (PF)' }, subtitle: { text: '' },xAxis: { type: 'datetime', dateTimeLabelFormats: { hour:'%b %e, %H:%M' },tickmarkPlacement: 'on', title: { text: 'Date and Time'}},yAxis: { title: { text: ' Power factor' }, min: 0 }, tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%e. %b}: {point.y:.2f} ' },plotOptions: { spline: { marker: { enabled: true } } },
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
            text: 'Daily Average Power Factor'
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
            max: 1.0,

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
                text: 'PF'
            },
            plotBands: [{
                from: 0.94,
                to: 1.0,
                color: '#55BF3B' // green
            }, {
                from: 0.0,
                to: 0.0,
                color: '#DDDF0D' // yellow
            }, {
                from: 0,
                to: 0.94,
                color: '#DF5353' // red
            }]
        },

        series: [{
            name: 'Power Factor',
            data: [".$AvgPowerFactor."],
            tooltip: {
                valueSuffix: ' PF'
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
$graph5 = "<script type=\"text/javascript\">$(function () { $('#containergraph5').egscharts({ chart: { type: 'area' }, title: { text: '' }, subtitle: { text: 'kVA Demand' },xAxis: { type: 'datetime', dateTimeLabelFormats: { hour:'%b %e, %H:%M' },tickmarkPlacement: 'on', title: { text: 'Date and Time'}},yAxis: { title: { text: ' Values...' }, min: 0 }, tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:%e. %b}: {point.y:.2f} ' },plotOptions: { spline: { marker: { enabled: true } } },
series: [ {name: \"kVA Demand\",data: ".$kVADemandArray."}
]});});</script>";
echo $graph5;

}
?>

<div class="container-fluid">
    <div class="row-fluid">


		<div class="widget">


			<div class="widget-title">
				<h5><?php echo lang('dashboard'); ?></h5>

				<form name="client_meter" method="post">
					<table  style="float:right">
					  <tr>
						<td>Customer Name: </td>
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
														'client_names' => $data1,
														'client_name_index' => $data2
												     );
									$this->session->set_userdata($session_data);
							  ?>
						  </select>
						</td>
						<?php //echo  '<pre>'.'Customer Name: '.print_r($data1).'</pre>'; ?>
						<td>Meter Name: </td>
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
					<a data-toggle="modal" href="#kWh-kVA-content" class="btn"><i class="icon-eye-open"> </i>Daily kWh</a>
					<a data-toggle="modal" href="#kva-demand-content" class="btn"><i class="icon-eye-open"> </i>Daily kVA Demand</a>
					<a data-toggle="modal" href="#power-factor-content" class="btn"><i class="icon-eye-open"> </i>Daily Power Factor</a>
					<a data-toggle="modal" href="#avg-power-factor-content" class="btn"><i class="icon-eye-open"> </i>Daily Average Power Factor</a>
				</div>
<?php } ?>
	</div>
<?php if(strlen($clientid)>0 and strlen($taskid)>0){ ?>
<table border=0 width="100%"><tr>
<td  width="70%">
	   <!--<div id="powerfactor4weeks1"></div>-->
	   <div id="powerfactor4weeks2"></div>
</td>
<td  width="30%">
	   <div id="containergraph1"></div>
</td>
</tr>
</table>

<table border=0 width="100%">
<tr>
  <td>
  	 <center><h3><u>Last 4 Month Usage/Trends</u><h3></center>
  </td>
</tr>
<tr>
   <td>
		<table border=0 width="100%">
		<tr>
				<td  width="40%">
				   <div id="container10"></div>
				</td>
				<td  width="30%">
				   <div id="container122" ></div>
				</td>
				<td  width="30%">
				   <div id="container123"></div>
				</td>
			</tr>
		</table>
	</td>
	</tr>
	</table>


	<div id="power-factor-content" class="modal hide fade in" style="display: none;width:900px;left: 30%;">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">x</a>
				<h3>Daily Power Factor</h3>
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
				<h3>Daily Average Power Factor</h3>
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
				<h3>Daily kVA Demand</h3>
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
				<h3>Daily Engery Consumption kWh</h3>
			</div>
			<div class="modal-body">
					<!--<div id="powerfactor4weeks2" style="width: 850px; height: 400px; margin: 0 auto"></div>-->
					<div id="powerfactor4weeks1" style="width: 850px; height: 400px; margin: 0 auto"></div>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn" data-dismiss="modal">Close</a>
			</div>

		</div>
	</div>
<!--
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
-->

<?php echo ""; ?>




 </div>
</div>

</div>
<?php }else{

echo "<br><br><br><br><br><center><h1>Welcome to EGS Metering Solution</h1> </br><font color=red><h3>Please select Customer Name and Meter Name</h3></font></center><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";



}?>

