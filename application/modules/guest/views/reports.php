<div class="headerbar">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
		<h5>
<?php
	include('config.php');
	    $clientid = $this->session->userdata('client_id');
	    $client_names = $this->session->userdata('client_names');
	    $client_name_index = $this->session->userdata('client_name_index');
            if(strlen($clientid)>0){
	        $key = array_search($clientid, $client_name_index); 
		// $key = 2;
			echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">".$client_names[$key]."</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">".$this->session->userdata('meter_number')."</span>)";
	    }else{
			echo "&nbsp;&nbsp;&nbsp;Customer Name: <span style=\"font-size:15px;color:#00007d;font-family:verdana;bold;\">No Client Name Selected</span> (Meter Number: <span style=\"font-size:15px;color:#00007d;font-family:verdana;\">No Meter Number Selected</span>)";
	    }
?>
		</h5></li>
	</ol>
</div>
<?php

	


	function numberFormatPrecision( $number, $separator = '.', $format = 3 ){

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


	//echo $this->session->userdata('meter_number')."<br>";
	//echo $this->session->userdata('meter_id')."<br>";
	//echo $this->session->userdata('client_id')."<br>";

	//$MeterNumber=211423686;
	$MeterNumber=$this->session->userdata('meter_number');
	$main_query = array();

	$month_start_array = array();
	$month_end_array = array();

	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$varbmsid = $_POST['bmsid'];
		//echo $varbmsid."------------";
	   // echo '<pre>',print_r($_POST, TRUE),'</pre><br /><br /><br />';
	}else{
		$varbmsid = .5;
	}

	//echo "<pre>".$varbmsid."</pre>";

if(strlen($MeterNumber)>0){

	?>

	<script type="text/javascript">
		window.onload = function() {
		//alert("dddd");
			document.forms['myForm'].addEventListener('change', function() {
				this.submit();
			}, true);
		};

	</script>

	<?php
	function truncate_number( $number, $precision) {
		$negative = $number / abs($number);
		$number = abs($number);
		$precision = pow(10, $precision);
		return floor( $number * $precision ) / $precision * $negative;
	}

	$int = 1;
	$kW="";
	$kVA ="";
	$kVADemandArray ="";
	$PowerFactorArray ="";
	$AvgPowerFactor =0;
	$TotalPowerFactor =0;
	$kWdaytotal = 0.0;
	$kWnighttotal = 0.0;


	if($varbmsid>=3){
		//echo "<br>"."CALLED.3333..";

		$Query1="SELECT DATE_FORMAT(dates,'%Y') as showyear, DATE_FORMAT(dates,'%m')as showmonth ,count(default_value) as cnt FROM fi_meter_data where meternum=".$MeterNumber." GROUP BY 2 having (cnt>1000) order by dates desc Limit ";
		if($varbmsid==3){
			$Query1=$Query1."2";
		}else if($varbmsid==4){
			$Query1=$Query1."4";
		}

		$tMonth = 0;
		$tYear = 0;
		//echo "<br>".$Query1;
		$qry1 = mysql_query($Query1);
		$icnt = 0;
		while($rows1 = mysql_fetch_array($qry1))
		{
			$start_month = $rows1['showyear'].'-'.$rows1['showmonth'].'-1';
			$timestamp = strtotime ("+1 month",strtotime ($start_month));
			$nextMonth  =  date("Y-m-d",$timestamp);

			$month_start_array[$icnt]=$start_month;
			$month_end_array[$icnt]=$nextMonth;
			//echo "<br>".$nextMonth;


			if($icnt==0){
				$tMonth=$rows1['showmonth'];
				$tYear=$rows1['showyear'];
				$main_query[$icnt]= "select meternum, dates, ((fi_meter_data.activewh/1000)) as column1,(fi_meter_data.activeva/1000) as column2,(fi_meter_data.activevarh/1000) as column3 FROM fi_meter_data where  meternum=".$MeterNumber." and dates BETWEEN ('".$start_month." 00:30:00') and ('".$nextMonth." 00:00:00') order by dates";
			}else{
				$main_query[$icnt]= "select meternum, DATE_FORMAT(dates,'".$tYear."-".$tMonth."-%d %H:%i:00') as dates, ((fi_meter_data.activewh/1000)) as column1,(fi_meter_data.activeva/1000) as column2,(fi_meter_data.activevarh/1000) as column3 FROM fi_meter_data where  meternum=".$MeterNumber." and dates BETWEEN ('".$start_month." 00:30:00') and ('".$nextMonth." 00:00:00') order by dates";
			}


			//echo "<br>".$main_query[$icnt];
			$icnt++;
		}
	}

	if($varbmsid<=2){
		$Query1="SELECT
		DATE_ADD(dates, INTERVAL(2-DAYOFWEEK(dates)) DAY) as week_start,
		DATE_ADD(dates, INTERVAL(9-DAYOFWEEK(dates)) DAY) as week_end FROM fi_meter_data where  meternum=".$MeterNumber." GROUP BY YEAR(dates) + .01 * WEEK(dates) order by dates desc LIMIT ";


		if($varbmsid==.5){
			$Query1=$Query1."1";
		}else if($varbmsid==1){
			$Query1=$Query1."4";
		}else if($varbmsid==2){
			$Query1=$Query1."8";
		}

		//echo $Query1;
		$qry1 = mysql_query($Query1);

		$week_start_array = array();
		$week_end_array = array();

		$icnt = 0;
		if($varbmsid>0){
				while($rows1 = mysql_fetch_array($qry1))
				{
					$week_start_array[$icnt] = $rows1['week_start'];
					$week_end_array[$icnt] = $rows1['week_end'];
					$icnt++;
				}

			if(!empty($week_start_array)){
				$day_1= $week_start_array[0];
				$day_2 = (new DateTime($week_start_array[0]))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
				$day_3  =(new DateTime($day_2))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
				$day_4  =(new DateTime($day_3))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
				$day_5  =(new DateTime($day_4))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
				$day_6  =(new DateTime($day_5))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
				$day_7  =(new DateTime($day_6))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');
				$day_8  =(new DateTime($day_7))->add(new DateInterval("P1D"))->format('Y-m-d H:i:s');

				$hour = array("00","01","01","02","02","03","03","04","04","05","05","06","06","07","07","08","08","09","09","10","10","11","11","12","12","13","13","14","14","15","15","16","16","17","17","18","18","19","19","20","20","21","21","22","22","23","23");
				$minute = array("30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00","30","00");

				$date_array = array();
				$date_array_cnt = 0;
				$date_time = new DateTime($day_1);
				$year= $date_time->format('y').PHP_EOL;
				$month= $date_time->format('m').PHP_EOL;
				$day= $date_time->format('d').PHP_EOL;
				$max = sizeof($hour);
				for($i = 0; $i < $max;$i++)
				{
				   if($i==0){
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }else{
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }
				   $date_array_cnt ++;
				}

				$date_time = new DateTime($day_2);
				$year= $date_time->format('y').PHP_EOL;
				$month= $date_time->format('m').PHP_EOL;
				$day= $date_time->format('d').PHP_EOL;
				$max = sizeof($hour);
				for($i = 0; $i < $max;$i++)
				{
				   if($i==0){
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }else{
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }
				   $date_array_cnt++;
				}

				$date_time = new DateTime($day_3);
				$year= $date_time->format('y').PHP_EOL;
				$month= $date_time->format('m').PHP_EOL;
				$day= $date_time->format('d').PHP_EOL;
				$max = sizeof($hour);
				for($i = 0; $i < $max;$i++)
				{
				   if($i==0){
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }else{
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }
				   $date_array_cnt++;
				}

				$date_time = new DateTime($day_4);
				$year= $date_time->format('y').PHP_EOL;
				$month= $date_time->format('m').PHP_EOL;
				$day= $date_time->format('d').PHP_EOL;
				$max = sizeof($hour);
				for($i = 0; $i < $max;$i++)
				{
				   if($i==0){
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }else{
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }
				   $date_array_cnt++;
				}

				$date_time = new DateTime($day_5);
				$year= $date_time->format('y').PHP_EOL;
				$month= $date_time->format('m').PHP_EOL;
				$day= $date_time->format('d').PHP_EOL;
				$max = sizeof($hour);
				for($i = 0; $i < $max;$i++)
				{
				   if($i==0){
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }else{
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }

				   $date_array_cnt++;
				}

				$date_time = new DateTime($day_6);
				$year= $date_time->format('y').PHP_EOL;
				$month= $date_time->format('m').PHP_EOL;
				$day= $date_time->format('d').PHP_EOL;
				$max = sizeof($hour);
				for($i = 0; $i < $max;$i++)
				{
				   if($i==0){
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }else{
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }
				   $date_array_cnt++;
				}

				$date_time = new DateTime($day_7);
				$year= $date_time->format('y').PHP_EOL;
				$month= $date_time->format('m').PHP_EOL;
				$day= $date_time->format('d').PHP_EOL;
				$max = sizeof($hour);
				for($i = 0; $i < $max;$i++)
				{
				   if($i==0){
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }else{
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }
				   $date_array_cnt++;
				}

				$date_time = new DateTime($day_8);
				$year= $date_time->format('y').PHP_EOL;
				$month= $date_time->format('m').PHP_EOL;
				$day= $date_time->format('d').PHP_EOL;
				$max = sizeof($hour);
				for($i = 0; $i < 1;$i++)
				{
				   if($i==0){
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }else{
						$kW_S = "[Date.UTC(".$year.", ".($month-1).", ".($day-1).",".$hour[$i].",".$minute[$i].",00),~~]";
						$date_array[$date_array_cnt] = $kW_S;
				   }
				   $date_array_cnt++;
				}

				$main_query= array();
				$max = sizeof($week_start_array);
				//echo "MMMMMMAX:".$max;

				for($i = 0; $i < $max;$i++)
				{
					$date_time = new DateTime($week_start_array[$i]);
					$year= $date_time->format('y').PHP_EOL;
					$month= $date_time->format('m').PHP_EOL;
					$day= $date_time->format('d').PHP_EOL;

					$date_time1 = new DateTime($week_end_array[$i]);
					$year1= $date_time1->format('y').PHP_EOL;
					$month1= $date_time1->format('m').PHP_EOL;
					$day1= $date_time1->format('d').PHP_EOL;

					$main_query[$i]= "select meternum, dates, ((fi_meter_data.activewh/1000)) as column1,(fi_meter_data.activeva/1000) as column2,(fi_meter_data.activevarh/1000) as column3
					FROM fi_meter_data where  meternum=".$MeterNumber." and dates BETWEEN ('".trim($year)."-".trim($month)."-".trim($day)." 00:30:00')
					and ('".trim($year1)."-".trim($month1)."-".trim($day1)." 00:00:00') order by dates";



					//echo "<pre>".$main_query[$i]."</pre>";


				}

				}
			}
	   }


if(strlen($MeterNumber)>0 and !empty($main_query)){

				$graph_data= array();
				$graph_data_kwh_day=array();
				$graph_data_kwh_night=array();

				$temp_month = array();
				//$i$temp_cnt = 0;
				$max = sizeof($main_query);
				$k=0;
				for($i = 0; $i < $max;$i++)
				{
					//echo "<pre>".$varbmsid."-------------->".$main_query[$i]."</pre>";
					$int = 1;
					$kW  = "";
					$qry = mysql_query($main_query[$i]);
					$j = 0;
					while($rows = mysql_fetch_array($qry))
					{
						$my_sql_date = $rows['dates'];
						$date_time = new DateTime($my_sql_date);

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
							if($varbmsid==3 OR $varbmsid==4){
								$kW = "[[Date.UTC(".$year.", ".$month.", ".($day).",".$hour.",".$min.",00),".($rows['column1'])."]";
							}else{
								$kW = "[".str_replace( '~~', ($rows['column1']), $date_array[$int-1]);
							}

							$kVA = "[[Date.UTC(".$year.", ".($month-1).", ".$day.",".$hour.",".$min.",".$sec."),".$rows['column2']."]";
							$kVADemandArray  = "[[Date.UTC(".$year.", ".($month-1).", ".$day.",".$hour.",".$min.",".$sec."),".$kVADemand."]";
							if($PowerFactor>0){
								$PowerFactorArray  = "[[Date.UTC(".$year.", ".($month-1).", ".$day.",".$hour.",".$min.",".$sec."),".truncate_number($PowerFactor, 3)."]";
							}
							$TotalPowerFactor = $PowerFactor;

						}else{
							if($varbmsid==3 OR $varbmsid==4){
									$kW = $kW.",[Date.UTC(".$year.", ".$month.", ".($day).",".$hour.",".$min.",00),".($rows['column1'])."]";
							}else{
								if(sizeof($date_array)> $int){
									$kW = $kW.",".str_replace( '~~', ($rows['column1']), $date_array[$int-1]);
								}
							}
							$kVA = $kVA.",[Date.UTC(".$year.", ".($month-1).", ".$day.",".$hour.",".$min.",".$sec."),".$rows['column2']."]";
							$kVADemandArray  = $kVADemandArray.",[Date.UTC(".$year.", ".($month-1).", ".$day.",".$hour.",".$min.",".$sec."),".$kVADemand."]";
							if($PowerFactor>0){
								$PowerFactorArray  = $PowerFactorArray.",[Date.UTC(".$year.", ".($month-1).", ".$day.",".$hour.",".$min.",".$sec."),".truncate_number($PowerFactor, 3)."]";
							}
							$TotalPowerFactor += $PowerFactor;
						}
						$int++;
						$k++;
						$j++;
					}

					if($int==1){
						$kW = $kW."[]";
						$kVA = $kVA."[]";
					}else{
						$kW = $kW."]";
						$kVA = $kVA."]";
					}


					$graph_data[$i]=$kW;
					$graph_data_kwh_day[$i]=$kWdaytotal;
					$graph_data_kwh_night[$i]=$kWnighttotal;

					$kW  = "";
					$kWnighttotal="";
					$kWdaytotal="";

					$kVADemandArray = $kVADemandArray."]";
					$PowerFactorArray = $PowerFactorArray."]";
					if(!empty($TotalPowerFactor) OR !empty($TotalPowerFactor)){
						//$AvgPowerFactor = $TotalPowerFactor/($int-1);
					}
				}
				?>

				<?php
				$date1="";
				$date2="";
				$date3="";
				$date4="";
				$date5="";
				$date6="";
				$date7="";
				$date8="";
				if($varbmsid==.5){
					$date_time = new DateTime($week_start_array[0]);
					$date1=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
				}else if($varbmsid==1){
					if(isset($week_start_array[0])){
						$date_time = new DateTime($week_start_array[0]);
						$date1=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					if(isset($week_start_array[1])){
						$date_time = new DateTime($week_start_array[1]);
						$date2=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					
					if(isset($week_start_array[2])){
					$date_time = new DateTime($week_start_array[2]);
					$date3=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					if(isset($week_start_array[3])){
						$date_time = new DateTime($week_start_array[3]);
						$date4=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
				}else if($varbmsid==2){
					if(isset($week_start_array[0])){
						$date_time = new DateTime($week_start_array[0]);
						$date1=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					if(isset($week_start_array[1])){
						$date_time = new DateTime($week_start_array[1]);
						$date2=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					if(isset($week_start_array[2])){
						$date_time = new DateTime($week_start_array[2]);
						$date3=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					if(isset($week_start_array[3])){
						$date_time = new DateTime($week_start_array[3]);
						$date4=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					if(isset($week_start_array[4])){
						$date_time = new DateTime($week_start_array[4]);
						$date5=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					if(isset($week_start_array[5])){
						$date_time = new DateTime($week_start_array[5]);
						$date6=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					if(isset($week_start_array[6])){
						$date_time = new DateTime($week_start_array[6]);
						$date7=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
					if(isset($week_start_array[7])){
						$date_time = new DateTime($week_start_array[7]);
						$date8=trim($date_time->format('Y').PHP_EOL)."-".trim($date_time->format('M').PHP_EOL)."-".trim($date_time->format('d').PHP_EOL)."";
					}
			}

			$graph2 = "<script type=\"text/javascript\">
			$(function () {
				$('#container').egscharts({

					chart: {
						type: 'column'
					},

					title: {
						text: ";



						if($varbmsid==.5){
								$graph2 =$graph2."'Day vs Night Energy consumption for Last 1 Week'";
						}else if($varbmsid==1){
								$graph2 =$graph2."'Day vs Night Energy consumption for Last 4 Weeks'";
						}else if($varbmsid==2){
								$graph2 =$graph2."'Day vs Night Energy consumption for Last 8 Weeks'";
						}else if($varbmsid==3){
								$graph2 =$graph2."'Day vs Night Energy consumption for Last 2 Months'";
						}else if($varbmsid==4){
								$graph2 =$graph2."'Day vs Night Energy consumption for Last 4 Months'";
						}



					$graph2 =$graph2."},

					xAxis: {
						categories: [";

						if($varbmsid==.5){
							$graph2 = $graph2."'".$date1."']";
						}else if($varbmsid==1){
							$graph2 = $graph2."'".$date1."', '".$date2."', '".$date3."', '".$date4."']";
						}else if($varbmsid==2){
							$graph2 =$graph2."'".$date1."', '".$date2."', '".$date3."', '".$date4."', '".$date5."', '".$date6."', '".$date7."', '".$date8."']";
						}else if($varbmsid==3){
							if(!empty($month_start_array[1])){
								$graph2 = $graph2."'".$month_start_array[0]."', '".$month_start_array[1]."']";
							}else if(!empty($month_start_array[0])){
								$graph2 = $graph2."'".$month_start_array[0]."']";
							}
						}else if($varbmsid==4){
							if(!empty($month_start_array[3])){
								$graph2 =$graph2."'".$month_start_array[0]."', '".$month_start_array[1]."', '".$month_start_array[2]."', '".$month_start_array[3]."']";
							}else if(!empty($month_start_array[2])){
								$graph2 =$graph2."'".$month_start_array[0]."', '".$month_start_array[1]."', '".$month_start_array[2]."']";
							}else if(!empty($month_start_array[1])){
								$graph2 =$graph2."'".$month_start_array[0]."', '".$month_start_array[1]."']";
							}else if(!empty($month_start_array[0])){
								$graph2 =$graph2."'".$month_start_array[0]."']";
							}
						}

					$graph2 =$graph2."},

					yAxis: {
						allowDecimals: false,
						min: 0,
						title: {
							text: 'kWh'
						}
					},

					tooltip: {
						formatter: function () {
							return '<b>' + this.x + '</b><br/>' +
								this.series.name + ': ' + this.y + '<br/>' +
								'Total: ' + this.point.stackTotal + '<br>(<b>Day:</b> 6 AM to 21 PM, <b>Night:</b> 21 PM to 6 AM)';
						}
					},

					plotOptions: {
						column: {
							stacking: 'normal'
						}
					},

					series: [{
						name: 'Day kWh Consumtion',";

						if($varbmsid==.5){
							if(!empty($graph_data_kwh_day[0])){
									$graph2 = $graph2."data: [".$graph_data_kwh_day[0]."],";
							}
						}else if($varbmsid==1){
							if(!empty($graph_data_kwh_day[3])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2].", ".$graph_data_kwh_day[3]."],";
							}else if(!empty($graph_data_kwh_day[2])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2]."],";
							}else if(!empty($graph_data_kwh_day[1])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1]."],";
							}else if(!empty($graph_data_kwh_day[0])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0]."],";
							}
						}else if($varbmsid==2){
							if(!empty($graph_data_kwh_day[7])){
									$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2].", ".$graph_data_kwh_day[3].", ".$graph_data_kwh_day[4].", ".$graph_data_kwh_day[5].", ".$graph_data_kwh_day[6].", ".$graph_data_kwh_day[7]."],";
							}else if(!empty($graph_data_kwh_day[6])){
									$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2].", ".$graph_data_kwh_day[3].", ".$graph_data_kwh_day[4].", ".$graph_data_kwh_day[5].", ".$graph_data_kwh_day[6]."],";
							}else if(!empty($graph_data_kwh_day[5])){
									$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2].", ".$graph_data_kwh_day[3].", ".$graph_data_kwh_day[4].", ".$graph_data_kwh_day[5]."],";
							}else if(!empty($graph_data_kwh_day[4])){
									$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2].", ".$graph_data_kwh_day[3].", ".$graph_data_kwh_day[4]."],";
							}else if(!empty($graph_data_kwh_day[3])){
									$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2].", ".$graph_data_kwh_day[3]."],";
							}else if(!empty($graph_data_kwh_day[2])){
									$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2]."],";
							}else if(!empty($graph_data_kwh_day[1])){
									$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1]."],";
							}else if(!empty($graph_data_kwh_day[0])){
									$graph2 = $graph2."data: [".$graph_data_kwh_day[0]."],";
							}
						}else if($varbmsid==3){
							if(!empty($graph_data_kwh_day[1])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1]."],";
							}else if(!empty($graph_data_kwh_day[0])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0]."],";
							}
						}else if($varbmsid==4){
							if(!empty($graph_data_kwh_day[3])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2].", ".$graph_data_kwh_day[3]."],";
							}else if(!empty($graph_data_kwh_day[2])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1].",".$graph_data_kwh_day[2]."],";
							}else if(!empty($graph_data_kwh_day[1])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0].", ".$graph_data_kwh_day[1]."],";
							}else if(!empty($graph_data_kwh_day[0])){
								$graph2 = $graph2."data: [".$graph_data_kwh_day[0]."],";
							}
						}
						$graph2 = $graph2."stack: 'male'
					}, {
						name: 'Night kWh Consumtion',";

						if($varbmsid==.5){
							if(!empty($graph_data_kwh_night[0])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0]."],";
							}
						}else if($varbmsid==1 ){
							if(!empty($graph_data_kwh_night[3])){
									$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2].", ".$graph_data_kwh_night[3]."],";
							}else if(!empty($graph_data_kwh_night[2])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2]."],";
							}else if(!empty($graph_data_kwh_night[1])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1]."],";
							}else if(!empty($graph_data_kwh_night[0])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0]."],";
							}
						}else if($varbmsid==2 ){
							if(!empty($graph_data_kwh_night[7])){
									$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2].", ".$graph_data_kwh_night[3].", ".$graph_data_kwh_night[4].", ".$graph_data_kwh_night[5].", ".$graph_data_kwh_night[6].", ".$graph_data_kwh_night[7]."],";
							}else if(!empty($graph_data_kwh_night[6])){
									$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2].", ".$graph_data_kwh_night[3].", ".$graph_data_kwh_night[4].", ".$graph_data_kwh_night[5].", ".$graph_data_kwh_night[6]."],";
							}else if(!empty($graph_data_kwh_night[5])){
									$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2].", ".$graph_data_kwh_night[3].", ".$graph_data_kwh_night[4].", ".$graph_data_kwh_night[5]."],";
							}else if(!empty($graph_data_kwh_night[4])){
									$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2].", ".$graph_data_kwh_night[3].", ".$graph_data_kwh_night[4]."],";
							}else if(!empty($graph_data_kwh_night[3])){
									$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2].", ".$graph_data_kwh_night[3]."],";
							}else if(!empty($graph_data_kwh_night[2])){
									$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2]."],";
							}else if(!empty($graph_data_kwh_night[1])){
									$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1]."],";
							}else if(!empty($graph_data_kwh_night[0])){
									$graph2 = $graph2."data: [".$graph_data_kwh_night[0]."],";
							}

						}else
						if($varbmsid==3){
							if(!empty($graph_data_kwh_night[1])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1]."],";
							}else if(!empty($graph_data_kwh_night[0])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0]."],";
							}
						}else if($varbmsid==4){
							if(!empty($graph_data_kwh_night[3])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2].", ".$graph_data_kwh_night[3]."],";
							}else if(!empty($graph_data_kwh_night[2])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1].",".$graph_data_kwh_night[2]."],";
							}else if(!empty($graph_data_kwh_night[1])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0].", ".$graph_data_kwh_night[1]."],";
							}else if(!empty($graph_data_kwh_night[0])){
								$graph2 = $graph2."data: [".$graph_data_kwh_night[0]."],";
							}
						}

						$graph2 = $graph2."stack: 'male'
					}]
				});
			});

			</script>";

			echo $graph2;


			$graph1 = "<script type=\"text/javascript\">$(function () { $('#powerfactor4weeks1').egscharts({ chart: { type: 'spline' }, title: { text:";

			if($varbmsid==.5){
					$graph1 =$graph1."'Energy Consumption for Last 1 Week'";
			}else if($varbmsid==1){
					$graph1 =$graph1."'Energy Consumption for Last 4 Weeks'";
			}else if($varbmsid==2){
					$graph1 =$graph1."'Energy Consumption for Last 8 Weeks'";
			}else if($varbmsid==3){
					$graph1 =$graph1."'Energy Consumption for Last 2 Months'";
			}else if($varbmsid==4){
					$graph1 =$graph1."'Energy Consumption for Last 4 Months'";
			}
			$graph1 =$graph1."}, subtitle: { text: 'kWh' },xAxis: { type: 'datetime', dateTimeLabelFormats: {";

			if($varbmsid<=2){
				$graph1 = $graph1."hour:'%H:%M',day:'%a',week:'%a'";
			}else{
				$graph1 = $graph1."day: '%e'";
			}

			$graph1 = $graph1.",  }, title: { text: 'Date and Time'}},yAxis: { title: { text: 'kWh' }, min: 0 }, tooltip: { headerFormat: '<b>{series.name}</b><br>', pointFormat: '{point.x:";



			if($varbmsid<=2){
				$graph1 = $graph1."%H:%M";
			}else{
				$graph1 = $graph1."%e - %H:%M";
			}

			//$fff = "";
			$graph1 = $graph1."- Value}: {point.y:.2f}' },plotOptions: { spline: { marker: { enabled: false } } },
			series: [";
			if($varbmsid==.5){
				if(!empty($graph_data[0])){
					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."}";
				}
			}else if($varbmsid==1){

				if(!empty($graph_data[3])){
					//$graph1 = $graph1."{ name: \"$date2\",data: ".$graph_data[1]."},{ name: \"$date3\",data: ".$graph_data[2]."},{ name: \"$date4\",data: ".$graph_data[3]."}";


					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."},{ name: \"$date3\",data: ".$graph_data[2]."},{ name: \"$date4\",data: ".$graph_data[3]."}";
					//$fff = "<pre>---------------".$date1.">>>".$graph_data[0]."<<<"."</pre>";
					//$fff = $fff."<pre>---------------".$date2."---------------".$graph_data[1]."</pre>";
					//$fff = $fff."<pre>---------------".$date3."---------------".$graph_data[2]."</pre>";
					//$fff = $fff."<pre>---------------".$date4."---------------".$graph_data[3]."</pre>";
				}else if(!empty($graph_data[2])){
				$graph1 = $graph1."{ name: \"$date2\",data: ".$graph_data[1]."}";
					//$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."},{ name: \"$date3\",data: ".$graph_data[2]."}";
				}else if(!empty($graph_data[1])){
				$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."}";
					//$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."},";
				}else if(!empty($graph_data[0])){
				$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."}";
					//$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."}";
				}

			}else if($varbmsid==2){
				if(!empty($graph_data[7])){
					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."},{ name: \"$date3\",data: ".$graph_data[2]."},{ name: \"$date4\",data: ".$graph_data[3]."},{ name: \"$date5\",data: ".$graph_data[4]."},{ name: \"$date6\",data: ".$graph_data[5]."},{ name: \"$date7\",data: ".$graph_data[6]."},{ name: \"$date8\",data: ".$graph_data[7]."}";
				}else if(!empty($graph_data[6])){
					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."},{ name: \"$date3\",data: ".$graph_data[2]."},{ name: \"$date4\",data: ".$graph_data[3]."},{ name: \"$date5\",data: ".$graph_data[4]."},{ name: \"$date6\",data: ".$graph_data[5]."},{ name: \"$date7\",data: ".$graph_data[6]."}";
				}else if(!empty($graph_data[5])){
					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."},{ name: \"$date3\",data: ".$graph_data[2]."},{ name: \"$date4\",data: ".$graph_data[3]."},{ name: \"$date5\",data: ".$graph_data[4]."},{ name: \"$date6\",data: ".$graph_data[5]."}";
				}else if(!empty($graph_data[4])){
					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."},{ name: \"$date3\",data: ".$graph_data[2]."},{ name: \"$date4\",data: ".$graph_data[3]."},{ name: \"$date5\",data: ".$graph_data[4]."}";
				}else if(!empty($graph_data[3])){
					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."},{ name: \"$date3\",data: ".$graph_data[2]."},{ name: \"$date4\",data: ".$graph_data[3]."}";
				}else if(!empty($graph_data[2])){
					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."},{ name: \"$date3\",data: ".$graph_data[2]."}";
				}else if(!empty($graph_data[1])){
					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."},{ name: \"$date2\",data: ".$graph_data[1]."}";
				}else if(!empty($graph_data[0])){
					$graph1 = $graph1."{ name: \"$date1\",data: ".$graph_data[0]."}";
				}
			}else if($varbmsid==3){
				if(!empty($graph_data[1])){
					$graph1 = $graph1."{ name: \"$month_start_array[0]\",data: ".$graph_data[0]."},{ name: \"$month_start_array[1]\",data: ".$graph_data[1]."}";
				}else if(!empty($graph_data[0])){
					$graph1 = $graph1."{ name: \"$month_start_array[0]\",data: ".$graph_data[0]."}";
				}
			}else if($varbmsid==4){
				if(!empty($graph_data[3])){
					$graph1 = $graph1."{ name: \"$month_start_array[0]\",data: ".$graph_data[0]."},{ name: \"$month_start_array[1]\",data: ".$graph_data[1]."},{ name: \"$month_start_array[2]\",data: ".$graph_data[2]."},{ name: \"$month_start_array[3]\",data: ".$graph_data[3]."}";
				}else if(!empty($graph_data[2])){
					$graph1 = $graph1."{ name: \"$month_start_array[0]\",data: ".$graph_data[0]."},{ name: \"$month_start_array[1]\",data: ".$graph_data[1]."},{ name: \"$month_start_array[2]\",data: ".$graph_data[2]."}";
				}else if(!empty($graph_data[1])){
									$graph1 = $graph1."{ name: \"$month_start_array[0]\",data: ".$graph_data[0]."},{ name: \"$month_start_array[1]\",data: ".$graph_data[1]."}";
				}else if(!empty($graph_data[0])){
									$graph1 = $graph1."{ name: \"$month_start_array[0]\",data: ".$graph_data[0]."}";
				}
			}

			$graph1 = $graph1."]});});</script>";
			echo $graph1;

			//echo $fff;

	}
	?>

	<div class="container-fluid">
		<div class="row-fluid">
			<div class="card">		
			<div class="card-header">
				<div class="row">
					<div class="col-sm-5">
						<h5 class="card-title mb-0"><?php echo lang('graph_reports'); ?></h5>
					</div>
					<div class="col-sm-7 d-none d-md-block">
						<form id="myForm" method="POST">
						<div style="float:right" >
						<table>
						<tr>
						<td>
						<label>Select Options: </label>
						</td>
						<td>
						 <select class="form-control" id=bmsid name=bmsid onchange="document.forms['changebmsid'].submit()">

						<!--<?php if($varbmsid==5){ ?>
								<option value="5" selected>Last 1 Weeks</option>
						 <?php }else { ?>
								<option value="5">Last 1 Weeks</option>
						 <?php }?>

						<?php if($varbmsid==6){ ?>
								<option value="6" selected>Last 2 Weeks</option>
						 <?php }else { ?>
								<option value="6">Last 2 Weeks</option>
						 <?php }?>


						 <?php if($varbmsid==7){ ?>
								<option value="7" selected>Last 3 Weeks</option>
						 <?php }else { ?>
								<option value="7">Last 3 Weeks</option>
						 <?php }?>
						-->

						<?php if($varbmsid==.5){ ?>
								<option value=".5" selected>Last 1 Weeks</option>
						 <?php }else { ?>
								<option value=".5">Last 1 Weeks</option>
						 <?php }?>

						<?php if($varbmsid==1){ ?>
								<option value="1" selected>Last 4 Weeks</option>
						 <?php }else { ?>
								<option value="1">Last 4 Weeks</option>
						 <?php }?>

						<?php if($varbmsid==2){ ?>
								 <option value="2" selected>Last 8 Weeks</option>
						 <?php }else { ?>
								<option value="2">Last 8 Weeks</option>
						 <?php }?>

						<?php if($varbmsid==3){ ?>
								 <option value="3" selected>Last 2 Months</option>
						 <?php }else { ?>
								<option value="3">Last 2 Months</option>
						 <?php }?>

						<?php if($varbmsid==4){ ?>
								 <option value="4" selected>Last 4 Months</option>
						 <?php }else { ?>
								<option value="4">Last 4 Months</option>
						 <?php }?>
						</select>
						</td>
						</tr>
						</table>
					   </form>					
					</div>
				</div>	
			</div>		

	</div>

				   </div>


					<div id="powerfactor4weeks1"></div>
					<div id="container"></div>
				</div>
			</div>	
		</div>
	</div>
<?php } ?>

<?php

			echo "<br>Client ID:".$this->session->userdata('client_id');
			echo "<br>Meter Number:".$this->session->userdata('meter_number');
			echo "<br>Meter ID:".$this->session->userdata('meter_id_num');

?>